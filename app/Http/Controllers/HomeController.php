<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\Loan;
use App\Models\User;
use App\Models\Region;
use App\Models\LoanInstallment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if( Auth::user()->function == 'Administrator'){
            $loans = Loan::all();
            // dd($loans->region());
            return view('home', compact('loans'));
        }
        else {
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
            $loansFinished = Loan::where('status', 'paid')->where('region_id', $region->id)->get();
            // dd('aaaa', $loans);
            
            return view('loans', compact('consumers','collaborator', 'region', 'loans', 'loansFinished'));
        }
        
    }
}
