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
}
