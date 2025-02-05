<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\User;
use App\Models\Region;
use App\Models\Loan;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use App\Models\LoanInstallment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        $users = User::where('function', '!=', 'vendedor')->get();

        $regions = Region::all();
        return view('collaborators', compact('users', 'regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        //zerarBalance
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $collaborator = new User();
        $collaborator->name = $request->name;
        $collaborator->email = $request->email;
        $collaborator->function = $request->function;
        $collaborator->region_id = $request->region;
        $collaborator->password = Hash::make($request->password);
        $collaborator->user_id = $request->user_id;

        // dd($collaborator);

        $collaborator->save();

        $users = User::where('function', '!=', 'vendedor')->get();
        $regions = Region::all();
        
        return view('collaborators', compact('users', 'regions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collaborator = User::find($id);
        $regions = Region::all();
        
        
        return view('collaborator', compact('collaborator', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $collaborator = User::find($id);
        $collaborator->name = $request->name;
        $collaborator->email = $request->email;
        $collaborator->function = $request->function;
        $collaborator->region_id = $request->region;
        $collaborator->password = Hash::make($request->password);
        $collaborator->edit_user_id = $request->user_id;

        // dd($collaborator);

        $collaborator->save();

        $users = User::where('function', '!=', 'vendedor')->get();
        $regions = Region::all();
        return view('collaborators', compact('users', 'regions'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function balance()
    {
        $users = User::where('function', '!=', 'vendedor')->get();
        
        $results = DB::table('loan_installments as li')
            ->select(DB::raw('SUM(li.amount_paid) as total_paid, l.region_id, r.name'))
            ->join('loans as l', 'l.id', '=', 'li.loan_id')
            ->join('regions as r', 'r.id', '=', 'l.region_id')
            ->where('li.amount_paid', '>', 0)
            ->whereDate('li.updated_at', Carbon::now()->toDateString()) 
            ->where('l.status', '!=', 'cancelled')
            ->groupBy('l.region_id', 'r.name')
            ->get();

        return view('balance', compact('users', 'results'));
    }

    public function addBalance(Request $request)
    {
        
        $user = User::find($request->collaborator);
        $user->balance = $user->balance + $this->removeMask($request->value);
        $user->save();

        return redirect()->route('balance');
    }

    public function zerarBalance($id)
    {
        $user = User::find($id);
        $user->balance = 0.00;
        $user->save();
        // dd($user);

        return redirect()->route('balance');
    }

    public function removeMask($value){
        $number = str_replace(".", "", $value);
        $number = str_replace(",", ".", $number);

        return $number;
    }

    public function historico(){
        return view('historico');
    }

    public function detalhes(Request $request){
        $loans = Loan::where('consumer_id', $request->consumer)->get();

        return view('detalhesLoan', compact('loans'));
    }

    public function detalheParcela($id){
        $parcelas = LoanInstallment::where('loan_id', $id)->get();

        return view('detalhesParcela', compact('parcelas'));
    }

    
    
}
