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


class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
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
        //
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

        //dd($collaborator);

        $collaborator->save();

        $users = User::all();
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

        

        $collaborator->save();

        $users = User::all();
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
        $users = User::all();

        return view('balance', compact('users'));
    }

    public function addBalance(Request $request)
    {
        
        $user = User::find($request->collaborator);
        $user->balance = $user->balance + $this->removeMask($request->value);
        $user->save();

        return redirect()->route('balance');
    }

    public function removeMask($value){
        $number = str_replace(".", "", $value);
        $number = str_replace(",", ".", $number);

        return $number;
    }
}
