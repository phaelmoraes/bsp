<?php

namespace App\Http\Controllers;

// use App\Models\Address;

use App\Models\Fabricante;
use App\Models\Foto;
use App\Models\Moto;
use App\Models\MotoFoto;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fabricantes = Fabricante::all();
        return view('shop', compact('fabricantes'));
    }

    public function salvarFabricante(Request $request)
    {
        try {
            $fabricante = new Fabricante();
            $fabricante->fabricante = $request->fabricante;
            $fabricante->save();
            return redirect('/shop')->with('success', 'Fabricante salvo com sucesso.');
        } catch (\Exception $e) {
            return redirect('/shop')->with('error', 'Erro ao salvar fabricante: ' . $e->getMessage(). '. Por favor, tente novamente.');
        }

    }

    public function salvarMoto(Request $request)
    {
        // dd($request->all());
        try {
            $moto = new Moto();
            $moto->fabricante_id = $request->manufacturer;
            $moto->modelo = $request->model;
            $moto->ano = $request->ano;
            $moto->km = $request->km;
            $moto->cilindrada = $request->cld;
            $moto->valor_compra = $request->valor_compra;
            $moto->valor_vista = $request->valor_vista;
            $moto->valor_credito = $request->valor_credito;
            $moto->ex_proprietario = $request->ex_proprietario;
            $moto->data_compra = $request->data_compra;
            $moto->placa = $request->placa;
            $moto->chassi = $request->chassi;
            $moto->loja_id = $request->loja_id;
            $moto->status = 'venda';
            // dd($moto);
            $moto->save();

            if (!empty($request->file[0])) {
                foreach ($request->file as $uploadedFile) {
                    $caminhoImagem = $uploadedFile->store('img', 'public');
            
                    $novaFoto = new Foto();
                    $novaFoto->caminho = $caminhoImagem;
                    $novaFoto->save();
            
                    $fotoRef = new MotoFoto();
                    $fotoRef->moto_id = $moto->id;
                    $fotoRef->foto_id = $novaFoto->id;
                    $fotoRef->save();
                }
            }

            return redirect('/shop')->with('success', 'Moto salva com sucesso.');
        } catch (\Exception $e) {
            return redirect('/shop')->with('error', 'Erro ao salvar Moto: ' . $e->getMessage() . '. Por favor, tente novamente.');
        }
    }

    public function motos(){
        $motos = Moto::where('status', 'venda')->get();
        return view('motos', compact('motos'));
    }

    public function verMoto($id){
        $moto = Moto::find($id);
        $fotos = $moto->fotos;
        // dd($moto);
        return view('verMotos', compact('moto', 'fotos'));
    }


}
