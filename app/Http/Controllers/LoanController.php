<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\User;
use App\Models\Region;
use App\Models\LoanInstallment;

use Illuminate\Support\Facades\Auth;


class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumers = Consumer::all();
        $id = Auth::id();
        $collaborator = User::find($id);
        $region = Region::find($collaborator->region_id);
        

        if (empty($region)){
            $users = User::simplePaginate(5);
            $regions = Region::simplePaginate(5);
            return view('collaborators', compact('users', 'regions'));
        }
        if (count($consumers)==0){
            $users = User::simplePaginate(5);
            $regions = Region::simplePaginate(5);
            $consumers = Consumer::simplePaginate(5);
            return view('consumers', compact('users', 'regions', 'consumers'));
        }

        $loans = Loan::where('status', 'opened')->where('region_id', $region->id)->get();
        // dd('aaaa', $loans);
        
        return view('loans', compact('consumers','collaborator', 'region', 'loans'));

    }


    public function removeMask($value){
        $number = str_replace(".", "", $value);
        $number = str_replace(",", ".", $number);

        return $number;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->user_id);
        $consumer = Consumer::find($request->consumer);

        $total_price = (($request->fees/100)+1) *$this->removeMask($request->price);

        $loan = new Loan();
        $loan->price = $this->removeMask($request->price);
        $loan->total_price = $total_price;
        $loan->fees = $request->fees;
        $loan->period = $request->period;
        $loan->status = "opened";
        $loan->installments = $request->installments; 
        $loan->balance = 0;
        $loan->consumer_id = $consumer->id;
        $loan->user_id = $user->id;
        $loan->region_id = $user->region_id;
        // dd($loan);
        $loan->save();

        
        $price = $loan->total_price / $loan->installments;

        for ($i = 1; $i <= $loan->installments; $i++) {

            $loan_installments = new LoanInstallment();
            $loan_installments->price = $price;
            $loan_installments->number_installment = $i;
            $loan_installments->status = "opened";
            $loan_installments->amount_paid = 0;
            $loan_installments->loan_id = $loan->id;

            $loan_installments->save();
            // echo $i;
        }

        $consumers = Consumer::all();
        $id = Auth::id();
        $collaborator = User::find($id);
        $region = Region::find($collaborator->region_id);
        $loans = Loan::where('status', 'opened')->where('region_id', $region->id)->get();
        // dd($loans);
        return view('loans', compact('consumers','collaborator', 'region', 'loans'));

        // dd($price, $loan, $loan_installments);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan = Loan::find($id);
        $loan_installments = LoanInstallment::where('loan_id', $id)->get();
        
        $amount_paid = $loan_installments->sum('amount_paid');
        $newPrice = $loan->total_price - $amount_paid;

        return view('loan', compact('loan', 'loan_installments', 'newPrice', 'amount_paid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $installment = LoanInstallment::find($id);
        $loan = Loan::find($installment->loan_id);

        if($installment->status != 'paid'){
            if($request->status){

                $installment->status = 'delayed';
                $installment->updated_at = date("Y-m-d H:i:s");
                $installment->save();
    
                $loan_installments = LoanInstallment::where('loan_id', $installment->loan_id)->get();
                $amount_paid = $loan_installments->sum('amount_paid');
                $newPrice = $loan->total_price - $amount_paid;

                return view('loan', compact('loan', 'loan_installments', 'newPrice', 'amount_paid'));
    
            }
    
            if($request->balance){
                $installment->amount_paid = $this->removeMask($request->value) + $loan->balance;
                if($installment->amount_paid >= $installment->price){
                    $loan->balance = $installment->amount_paid - $installment->price;
                    // dd('aaaa');
                    $loan->save();
                    $installment->amount_paid =  $this->removeMask($request->value);
                }
                else {
                    $loan->balance = $installment->amount_paid - $installment->price;
                    $loan->save();
                    $installment->amount_paid = $this->removeMask($request->value);
                }
                $installment->updated_at = now();
                $installment->status = 'paid';
    
                if(empty($installment->amount_paid)){
                    $installment->amount_paid = 0;
                }
                $installment->save();
    
                // dd($installment, $loan);
    
                $loan_installments = LoanInstallment::where('loan_id', $installment->loan_id)->get();
                $amount_paid = $loan_installments->sum('amount_paid');
                $newPrice = $loan->total_price - $amount_paid;

                return view('loan', compact('loan', 'loan_installments', 'newPrice', 'amount_paid'));   
            }
    
            $installment->amount_paid = $this->removeMask($request->value);
            $installment->updated_at = now();
            $installment->status = 'paid';
            // dd($installment->amount_paid);
            if(empty($installment->amount_paid)){
                $installment->amount_paid = 0;
            }
    
            $installment->save();
    
            if($installment->amount_paid != $installment->price){
                $loan->balance = $loan->balance + ($installment->amount_paid - $installment->price);
                $loan->save();
            }  
        }
        
        
        

        $loan_installments = LoanInstallment::where('loan_id', $installment->loan_id)->get();
        // $teste = $loan_installments->sum('amount_paid');
        // dd($teste);

        $amount_paid = $loan_installments->sum('amount_paid');
        $newPrice = $loan->total_price - $amount_paid;

        return view('loan', compact('loan', 'loan_installments', 'newPrice', 'amount_paid'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
    public function cancel($id)
    {
        // dd('cancel', $id);
        $loan = Loan::find($id);
        $loan->status = 'cancelled';
        $loan->save();
        
        return redirect()->route('loan');


    }

    public function renegotiate(Request $request, $id)
    {
        // dd($request->all());
        $loan = Loan::find($id);
        $loan->status = 'renegotiated';
        $loan->save();

        $newLoan = new Loan();
        $user = User::find($request->user_id);
        $consumer = Consumer::find($request->consumer);

        $total_price = (($request->fees/100)+1) * $this->removeMask($request->price);

        $newLoan = new Loan();
        $newLoan->price = $this->removeMask($request->price);
        $newLoan->total_price = $total_price;
        $newLoan->fees = $request->fees;
        $newLoan->period = $request->period;
        $newLoan->status = "opened";
        $newLoan->installments = $request->installments; 
        $newLoan->balance = 0;
        $newLoan->consumer_id = $consumer->id;
        $newLoan->user_id = $user->id;
        $newLoan->region_id = $user->region_id;

        $newLoan->save();

        
        $price = $newLoan->total_price / $newLoan->installments;

        for ($i = 1; $i <= $newLoan->installments; $i++) {

            $loan_installments = new LoanInstallment();
            $loan_installments->price = $price;
            $loan_installments->number_installment = $i;
            $loan_installments->status = "opened";
            $loan_installments->amount_paid = 0;
            $loan_installments->loan_id = $newLoan->id;
            // dd($loan_installments);
            $loan_installments->save();
            // echo $i;
        }

        return redirect()->route('loan');


        // dd('renegotiate', $request->all(), $id, $loan, $newLoan, $loan_installments);
    }

    public function finish($id)
    {
        // dd('finish', $id);
        $loan = Loan::find($id);
        $loan->status = 'paid';
        $loan->save();
        
        return redirect()->route('loan');

    }


}
