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
use App\Models\Loja;
use App\Models\Moto;
use App\Models\Parcela;
use App\Models\Venda;
use Exception;
use Illuminate\Support\Facades\DB;

class LojaController extends Controller
{
    public function index(){
        $lojas = Loja::all();
        $vendedores = User::where('function', 'Vendedor')->get();
        return view('vendedor', compact('lojas', 'vendedores'));
    }

    public function salvarVendedor(Request $request){
        try {
            $vendedor = new User();
            $vendedor->name = $request->nome;
            $vendedor->email = $request->email;
            $vendedor->function = 'Vendedor';
            $vendedor->password = Hash::make($request->senha);
            $vendedor->user_id = $request->user_id;
            $vendedor->loja_id = $request->loja;

            $vendedor->save();
            return redirect('/vendedor')->with('success', 'Vendedor cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect('/vendedor')->with('error', 'Erro ao cadastrar vendedor: ' . $e->getMessage(). '. Por favor, tente novamente.');
        }

        return view('vendedor', compact('lojas'));
    }

    public function salvarLoja(Request $request){
        try {
            $loja = new Loja();
            $loja->loja = $request->loja;
            $loja->save();
            return redirect('/vendedor')->with('success', 'Loja salva com sucesso.');
        } catch (\Exception $e) {
            return redirect('/vendedor')->with('error', 'Erro ao salvar loja: ' . $e->getMessage(). '. Por favor, tente novamente.');
        }

        return view('vendedor', compact('lojas'));
    }

    public function venda(Request $request){
        // dd($request->all());
        DB::beginTransaction();
        $moto = Moto::find($request->moto);
        try {
            
            $venda = new Venda();
            $venda->user_id = $request->user_id;
            $venda->loja_id = $request->loja;
            $venda->moto_id = $request->moto;
            $venda->forma_pagamento = $request->pagamento;

            $venda->cliente = $request->nome;
            $venda->cpf = $request->cpf;

            if($request->pagamento == 'vista'){
                $venda->valor_total = $request->valorTotal;
                $venda->lucro_estimado = $request->valorTotal - $moto->valor_compra;
                $venda->valor_pago = $request->valorTotal;
                $venda->status = 'pago';
                $teste = $venda->save();
                
            }
            else {
                $venda->valor_total = $request->valorTotalParcelado;
                $venda->parcelas = $request->parcelas;
                $venda->valor_pago = $request->entrada;
                $venda->lucro_estimado = $request->valorTotalParcelado - $moto->valor_compra;
                $venda->status = 'aberto';
                $teste1 = $venda->save();

                $value = ($request->valorTotalParcelado - $request->entrada)/$request->parcelas;

                for ($i=1; $i <= $request->parcelas; $i++) { 
                    $parcela = new Parcela();
                    $parcela->valor = $value;
                    $parcela->n_parcela = $i;
                    $parcela->status = 'aberto';
                    $parcela->venda_id = $venda->id;
                    $teste2 = $parcela->save();
                }
            }

            $moto->status = 'vendida';
            $teste3 = $moto->save();


            if(isset($teste1) && isset($teste2) && isset($teste3)){
                DB::commit();
                return redirect('/motos')->with('success', 'Venda Realizada com sucesso.');
            }elseif(isset($teste)){
                DB::commit();
                return redirect('/motos')->with('success', 'Venda Realizada com sucesso.');
            }
            else{
                DB::rollBack();                
            }
        } catch (Exception $e) {
                DB::rollBack();
            return redirect('/motos')->with('error', 'Erro ao realizar venda: ' . $e->getMessage(). '. Por favor, tente novamente.');
        }

        // return $msg;
    }
}
