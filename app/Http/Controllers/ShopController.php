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
        $uploadedFiles = [];

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName(); // Usando timestamp para garantir nomes únicos
                $file->storeAs('img', $filename, 'public'); // Armazenando com um nome único na pasta public/img
                $uploadedFiles[] = $filename;
            }
        }
    
        dd($request->all(), $uploadedFiles);



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
            // dd($moto);
            $moto->save();

            if (!empty($request->photos[0])) {
                foreach ($request->photos as $nomeArquivo) {
                    // Constrói o caminho completo para o arquivo
                    $caminhoImagem = 'img/' . $nomeArquivo;

                    // Cria o diretório se não existir
                    File::makeDirectory(public_path('img'), 0755, true, true);

                    // Cria o arquivo vazio no diretório especificado
                    file_put_contents(public_path($caminhoImagem), '');

                    // Salva o caminho da imagem no banco de dados
                    $novaFoto = new Foto();
                    $novaFoto->caminho = $caminhoImagem;
                    $novaFoto->save();

                    // Cria a relação entre a moto e a foto na tabela pivot
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
        $motos = Moto::all();
        return view('motos', compact('motos'));
    }

    public function verMoto($id){
        $moto = Moto::find($id);
        $fotos = $moto->fotos;
        // dd($fotos);
        return view('verMotos', compact('moto', 'fotos'));
    }


}
