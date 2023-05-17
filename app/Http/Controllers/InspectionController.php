<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\User;
use App\Models\Loan;
use App\Models\LoanInstallment;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // dd('aaaa');
        $nRegions = Loan::where("status", "!=", "cancelled")->distinct()->get('region_id');
        $nRegions = json_decode (json_encode ($nRegions), FALSE);

        // dd($nRegions);

        $info    = [];
        foreach($nRegions as $region){
            $loans = Loan::select('id')->where("region_id", "=", $region->region_id)->where("status", "!=", "cancelled")->get();
            foreach($loans as $loan){
                $data['region_id'] = $region->region_id;
                $data['id'] = $loan->id;

                array_push($info, $data);
            }
        }

        // dd($info);
        
        $info = json_decode (json_encode ($info), FALSE);

        // foreach($info as $inf){
        //     $n = $inf->rota;
        //     $i = $inf->id;
        //     // dd($inf);
        // }


        $regions = Loan::select( Loan::raw('region_id, sum( total_price ) as total_value, sum( price ) as value') )
        ->where("status", "!=", "cancelled")
        ->groupBy("region_id")
        ->get();
        
        // dd($regions);
        
        $loanInstallments = [];

        // foreach($nRegions as $rotas){
        //     echo intval($rotas->region_id);
        // }

        foreach($nRegions as $region){

            $total_value = 0;

            foreach($info as $inf){
                // dd($info->id);
                // dd($rotas->region_id, $info->rota, $info->id, ($rotas->region_id == $info->rota));
                    $route = $inf->region_id;
                    $id = $inf->id;
                    if($route == $region->region_id){
                        $installment = LoanInstallment::select( LoanInstallment::raw('sum( amount_paid ) as total_value') )
                        ->where('loan_id', '=', $id)
                        ->where('status', 'paid')
                        ->get();
                        $total_value = $total_value + $installment[0]->total_value;
                    }

            }

            $dados['region_id']= $region->region_id;
            $dados['total_price']= $total_value;

            array_push($loanInstallments, $dados);
        }

        $regions = json_decode (json_encode ($regions), FALSE);
        $loanInstallments = json_decode (json_encode ($loanInstallments), FALSE);

        // dd($regions, $loanInstallments);

        $content = $this->getContent($regions, $loanInstallments);

        // dd($content);
        return view('inspection', compact('content'));
    }

    public function week(){
        // dd('aaaa');

        // $usersemanal = DB::table('clientes')->whereRaw('`created_at` > (NOW() - INTERVAL 1 WEEK)')->count();
        $nRegions = Loan::where("status", "!=", "cancelled")->whereRaw('`created_at` > (NOW() - INTERVAL 1 WEEK)')->distinct()->get('region_id');
        // dd($nRegions);
        $nRegions = json_decode (json_encode ($nRegions), FALSE);

        $info    = [];
        foreach($nRegions as $region){
            $loans = Loan::select('id')->whereRaw('`created_at` > (NOW() - INTERVAL 1 WEEK)')->where("region_id", "=", $region->region_id)->where("status", "!=", "cancelled")->get();
            foreach($loans as $loan){
                $data['region_id'] = $region->region_id;
                $data['id'] = $loan->id;

                array_push($info, $data);
            }
        }
        
        $info = json_decode (json_encode ($info), FALSE);

        // foreach($info as $inf){
        //     $n = $inf->rota;
        //     $i = $inf->id;
        //     // dd($inf);
        // }


        $regions = Loan::select( Loan::raw('region_id, sum( total_price ) as total_value, sum( price ) as value') )
        ->whereRaw('`created_at` > (NOW() - INTERVAL 1 WEEK)')
        ->where("status", "!=", "cancelled")
        ->groupBy("region_id")
        ->get();
        
        
        
        $loanInstallments = [];

        // foreach($nRegions as $rotas){
        //     echo intval($rotas->region_id);
        // }

        foreach($nRegions as $region){

            $total_value = 0;

            foreach($info as $inf){
                // dd($info->id);
                // dd($rotas->region_id, $info->rota, $info->id, ($rotas->region_id == $info->rota));
                    $route = $inf->region_id;
                    $id = $inf->id;
                    if($route == $region->region_id){
                        $installment = LoanInstallment::select( LoanInstallment::raw('sum( amount_paid ) as total_value') )
                        ->whereRaw('`created_at` > (NOW() - INTERVAL 1 WEEK)')
                        ->where('loan_id', '=', $id)
                        ->where('status', 'paid')
                        ->get();
                        $total_value = $total_value + $installment[0]->total_value;
                    }

            }

            $dados['region_id']= $region->region_id;
            $dados['total_price']= $total_value;

            array_push($loanInstallments, $dados);
        }

        $regions = json_decode (json_encode ($regions), FALSE);
        $loanInstallments = json_decode (json_encode ($loanInstallments), FALSE);

        $content = $this->getContent($regions, $loanInstallments);

        // dd($regions, $loanInstallments);
        return view('inspection', compact('content'));
    }

    public function month(){
        // dd('aaaa');
        $month = date("m");
        $nRegions = Loan::where("status", "!=", "cancelled")->whereMonth("created_at",$month)->distinct()->get('region_id');
        // dd($nRegions);
        $nRegions = json_decode (json_encode ($nRegions), FALSE);

        $info    = [];
        foreach($nRegions as $region){
            $loans = Loan::select('id')->where("region_id", "=", $region->region_id)->whereMonth("created_at",$month)->where("status", "!=", "cancelled")->get();
            foreach($loans as $loan){
                $data['region_id'] = $region->region_id;
                $data['id'] = $loan->id;

                array_push($info, $data);
            }
        }
        
        $info = json_decode (json_encode ($info), FALSE);

        // foreach($info as $inf){
        //     $n = $inf->rota;
        //     $i = $inf->id;
        //     // dd($inf);
        // }


        $regions = Loan::select( Loan::raw('region_id, sum( total_price ) as total_value, sum( price ) as value') )
        ->whereMonth("created_at",$month)
        ->where("status", "!=", "cancelled")
        ->groupBy("region_id")
        ->get();
        
        
        
        $loanInstallments = [];

        // foreach($nRegions as $rotas){
        //     echo intval($rotas->region_id);
        // }

        foreach($nRegions as $region){

            $total_value = 0;

            foreach($info as $inf){
                // dd($info->id);
                // dd($rotas->region_id, $info->rota, $info->id, ($rotas->region_id == $info->rota));
                    $route = $inf->region_id;
                    $id = $inf->id;
                    if($route == $region->region_id){
                        $installment = LoanInstallment::select( LoanInstallment::raw('sum( amount_paid ) as total_value') )
                        ->whereMonth("created_at",$month)
                        ->where('loan_id', '=', $id)
                        ->where('status', 'paid')
                        ->get();
                        $total_value = $total_value + $installment[0]->total_value;
                    }

            }

            $dados['region_id']= $region->region_id;
            $dados['total_price']= $total_value;

            array_push($loanInstallments, $dados);
        }

        $regions = json_decode (json_encode ($regions), FALSE);
        $loanInstallments = json_decode (json_encode ($loanInstallments), FALSE);

        $content = $this->getContent($regions, $loanInstallments);

        // dd($regions, $loanInstallments);
        return view('inspection', compact('content'));
    }

    public function year(){
        // dd('aaaa');
        $year = date("Y");
        // dd($year);
        $nRegions = Loan::where("status", "!=", "cancelled")->whereYear("created_at", $year)->distinct()->get('region_id');
        // dd($nRegions);
        $nRegions = json_decode (json_encode ($nRegions), FALSE);

        $info    = [];
        foreach($nRegions as $region){
            $loans = Loan::select('id')->where("region_id", "=", $region->region_id)->whereYear("created_at",$year)->where("status", "!=", "cancelled")->get();
            foreach($loans as $loan){
                $data['region_id'] = $region->region_id;
                $data['id'] = $loan->id;

                array_push($info, $data);
            }
        }
        
        $info = json_decode (json_encode ($info), FALSE);

        // foreach($info as $inf){
        //     $n = $inf->rota;
        //     $i = $inf->id;
        //     // dd($inf);
        // }


        $regions = Loan::select( Loan::raw('region_id, sum( total_price ) as total_value, sum( price ) as value') )
        ->whereYear("created_at",$year)
        ->where("status", "!=", "cancelled")
        ->groupBy("region_id")
        ->get();
        
        
        
        $loanInstallments = [];

        // foreach($nRegions as $rotas){
        //     echo intval($rotas->region_id);
        // }

        foreach($nRegions as $region){

            $total_value = 0;

            foreach($info as $inf){
                // dd($info->id);
                // dd($rotas->region_id, $info->rota, $info->id, ($rotas->region_id == $info->rota));
                    $route = $inf->region_id;
                    $id = $inf->id;
                    if($route == $region->region_id){
                        $installment = LoanInstallment::select( LoanInstallment::raw('sum( amount_paid ) as total_value') )
                        ->whereYear("created_at",$year)
                        ->where('loan_id', '=', $id)
                        ->where('status', 'paid')
                        ->get();
                        $total_value = $total_value + $installment[0]->total_value;
                    }

            }

            $dados['region_id']= $region->region_id;
            $dados['total_price']= $total_value;

            array_push($loanInstallments, $dados);
        }

        $regions = json_decode (json_encode ($regions), FALSE);
        $loanInstallments = json_decode (json_encode ($loanInstallments), FALSE);

        $content = $this->getContent($regions, $loanInstallments);

        // dd($regions, $loanInstallments);
        return view('inspection', compact('content'));
    }

    public function getContent($regions, $loanInstallments){
        $data = [];
        foreach($regions as $region){

            $content['region_id'] = $region->region_id;
            $content['region_name'] = $this->nameRegion($region->region_id);
            $content['total_value'] = $region->total_value;
            $content['value'] = $region->value;
            $content['fees'] = $region->total_value- $region->value;

            foreach($loanInstallments as $installment){
                if($installment->region_id == $region->region_id){
                    $content['total_raised'] = $installment->total_price;
                }
            }

            $content['amount_receivable'] = $content['total_value'] - $content['total_raised'];
            
            array_push($data, $content);
        }

        $data = json_decode (json_encode ($data), FALSE);
        return $data;

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

    public function nameRegion($id){
        $name = Region::find($id);
        return $name->name;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Regions  $regions
     * @return \Illuminate\Http\Response
     */
    public function show(Regions $regions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Regions  $regions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Regions  $regions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function strToHex($int){
        $int = (int)$int;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Regions  $regions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regions $regions)
    {
        //
    }
}
