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
use App\Models\Fabricante;
use App\Models\Loja;
use App\Models\Moto;
use App\Models\Parcela;
use App\Models\Venda;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LojaController extends Controller
{
    public function removeMask($value){
        $number = str_replace(".", "", $value);
        $number = str_replace(",", ".", $number);

        return $number;
    }

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
            // dd($venda);

            if($request->pagamento == 'vista'){
                $venda->valor_total = $this->removeMask($request->valorTotal);
                $venda->lucro_estimado = $this->removeMask($request->valorTotal) - $this->removeMask($moto->valor_compra);
                $venda->valor_pago = $this->removeMask($request->valorTotal);
                $venda->status = 'pago';
                $teste = $venda->save(); 
                
            }
            else {
                $venda->valor_total = $this->removeMask($request->valorTotalParcelado);
                $venda->parcelas = $request->parcelas;
                $venda->valor_pago = $this->removeMask($request->entrada);
                $venda->lucro_estimado = $this->removeMask($request->valorTotalParcelado) - $this->removeMask($moto->valor_compra);
                $venda->status = 'aberto';
                $teste1 = $venda->save();

                $value = ($this->removeMask($request->valorTotalParcelado) - $this->removeMask($request->entrada))/$request->parcelas;

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
                return redirect()->route('buscar_motos', ['loja' => $moto->loja_id, 'fabricante' => 0])->with('success', 'Venda Realizada com sucesso.');

                return redirect()->route('buscar_motos', ['loja' => $moto->loja_id, 'fabricante' => 0])->with('success', 'Venda Realizada com sucesso.');
            }elseif(isset($teste)){
                DB::commit();
                return redirect()->route('buscar_motos', ['loja' => $moto->loja_id, 'fabricante' => 0])->with('success', 'Venda Realizada com sucesso.');
            }
            else{
                DB::rollBack();                
            }
        } catch (Exception $e) {
                DB::rollBack();
            return redirect()->route('buscar_motos', ['loja' => $moto->loja_id, 'fabricante' => 0])->with('error', 'Erro ao realizar venda: ' . $e->getMessage(). '. Por favor, tente novamente.');
        }

        // return $msg;
    }

    public function buscar_motos($loja, $fabricante){
        // dd($fabricante, $loja);
        $fabricantes = Fabricante::all();
        $lojas = Loja::all();

        $motosQuery = Moto::where('status', 'venda');

        if ($loja) {
            $motosQuery->where('loja_id', $loja);
        }

        if ($fabricante) {
            $motosQuery->where('fabricante_id', $fabricante);
        }
        $motos = $motosQuery->get();
        $sql = $motosQuery->toSql(); // Obtém a string SQL

        // dd($sql);

        return view('motos', compact('motos', 'fabricantes', 'lojas'));
    }

    public function vendas(){
        $vendas  = Venda::where('loja_id', Auth::user()->loja_id)->where('status', 'aberto')->get();

        return view('vendas', compact('vendas'));
    }

    public function show_vendas($id){
        $venda = Venda::find($id);

        return view('show_vendas', compact('venda'));
    }
}
