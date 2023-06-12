<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\Contact;
use App\Models\Address;
use App\Models\Spend;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;



use Illuminate\Support\Facades\Auth;

class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumers = Consumer::all();
        $contacts = Contact::all();

        return view('consumers', compact('consumers', 'contacts'));
    }

    public function accepted($id)
    {
        $spend = Spend::find($id);
        $user = User::find($spend->user_id);

        // dd($spend->collaborator($user->id));

        $spend->status = "accepted";
        $spend->save();

        $user->balance = $user->balance - $spend->price;
        $user->save();

        return redirect()->route('spend');
    }

    public function denied($id)
    {
        // dd('negado', $id);

        $spend = Spend::find($id);
        $spend->status = "denied";
        $spend->save();
        // dd($spend);
        return redirect()->route('spend');
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

    public function spend()
    {
        $id = Auth::id();

        // dd($id);
        $analyze = Spend::where('status', 'analyze')->where('user_id', $id)->get();
        $spend = Spend::where('status','!=', 'analyze')->where('user_id', $id)->get();
        $allSpend = Spend::where('status', 'analyze')->get();

        // dd($analyze);
        return view('spend', compact('analyze', 'spend', 'allSpend'));
    }

    public function spendAdd(Request $request)
    {   
        $user = User::find($request->id);
        
        $spend = new Spend();
        $spend->price = $this->removeMask($request->price);
        $spend->description = $request->desc;
        $spend->status = 'analyze';
        $spend->user_id = $request->id;
        $spend->region_id = $user->region_id;

        $spend->save();
        // dd($spend);
        return redirect()->route('spend');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $contactsJSON = $request->contacts;
        $contacts = json_decode($contactsJSON);

        //começa
        DB::beginTransaction();
        try {
            
            $consumer = new Consumer();

            $consumer->name = $request->name;
            
            if(strlen($request->cpf_cnpj) >= 15) {
                $consumer->type = "PJ";
                $consumer->cnpj = $request->cpf_cnpj;
            }
            else {
                $consumer->type = "PF";
                $consumer->cpf = $request->cpf_cnpj;
            }

            $consumer->gender = $request->gender;
            $consumer->email = $request->email;
            $consumer->note = $request->note;
            $consumer->birthday = $request->birth;

            $teste = $consumer->save();

            if($contacts){
                foreach($contacts as $newContact){
                    $contact = new Contact();
                    
                    if($newContact->type == "WHATSAPP"){
                        $contact->type = $newContact->type;
                        $contact->phone = $newContact->number;
                    }
                    if($newContact->type == "PHONE"){
                        $contact->type = $newContact->type;
                        $contact->phone = $newContact->number;            
                    }
                    if($newContact->type == "CELL_PHONE"){
                        $contact->type = $newContact->type;
                        $contact->phone = $newContact->number;            
                    }
        
                    $contact->consumer_id = $consumer->id;
                    $teste2 = $contact->save();
                }
            }
            
    
            $address = new Address();
            $address->street = $request->street;
            $address->neighborhood = $request->neighborhood;
            $address->building_number = $request->building_number;
            $address->complement = $request->complement;
            $address->city = $request->city;
            $address->state = $request->state; 
            $address->consumer_id = $consumer->id;
    
            $teste3 = $address->save();

            // dd($teste, $teste2, $teste3);

            if(isset($teste) && isset($teste) && isset($teste)){
                DB::commit();
                $msg = 'Criado com Sucesso';
            }
            else{
                DB::rollBack();                
            }
        } catch (Exception $exception) {
            // $msg = $exception->getMessage();
            $msg = 'Erro ao criar, Instabilidade no Banco de Dados.';
            // return $msg;
        }

        // $msg = 'Criado com Sucesso';
        // return $msg;
        //termina

    //     $consumer = new Consumer();

    //     $consumer->name = $request->name;
        
    //     if(strlen($request->cpf_cnpj) >= 15) {
    //         $consumer->type = "PJ";
    //         $consumer->cnpj = $request->cpf_cnpj;
    //     }
    //     else {
    //         $consumer->type = "PF";
    //         $consumer->cpf = $request->cpf_cnpj;
    //     }
    //     // dd($request->all(), strlen($request->cpf_cnpj), $consumer);

    //     $consumer->gender = $request->gender;
    //     $consumer->email = $request->email;
    //     $consumer->note = $request->note;
    //     $consumer->birthday = $request->birth;

    //     $consumer->save();

        
    //     if($contacts){
    //         foreach($contacts as $newContact){
    //             $contact = new Contact();
                
    //             if($newContact->type == "WHATSAPP"){
    //                 $contact->type = $newContact->type;
    //                 $contact->phone = $newContact->number;
    //             }
    //             if($newContact->type == "PHONE"){
    //                 $contact->type = $newContact->type;
    //                 $contact->phone = $newContact->number;            
    //             }
    //             if($newContact->type == "CELL_PHONE"){
    //                 $contact->type = $newContact->type;
    //                 $contact->phone = $newContact->number;            
    //             }
    
    //             $contact->consumer_id = $consumer->id;
    //             $contact->save();
    //         }
    //     }
        

    //     $address = new Address();
    //     $address->street = $request->street;
    //     $address->neighborhood = $request->neighborhood;
    //     $address->building_number = $request->building_number;
    //     $address->complement = $request->complement;
    //     $address->city = $request->city;
    //     $address->state = $request->state; 
    //     $address->consumer_id = $consumer->id;

    //     $address->save();


        $consumers = Consumer::all();

        return view('consumers', compact('consumers', 'msg'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {
        $consumer = Consumer::find($id);
        $contacts = $consumer->contacts;
        $address = $consumer->address;

        // dd($address);


        return view('consumer', compact('consumer', 'contacts', 'address'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        $consumer = Consumer::find($id);
        $contact = $consumer->contacts;
        $address = $consumer->address;

        $contactsJSON = $request->contacts;
        $contacts = json_decode($contactsJSON);

        $consumer->name = $request->name;
        
        if(strlen($request->cpf_cnpj) >= 15) {
            $consumer->type = "PJ";
            $consumer->cnpj = $request->cpf_cnpj;
        }
        else {
            $consumer->type = "PF";
            $consumer->cpf = $request->cpf_cnpj;
        }

        $consumer->gender = $request->gender;
        $consumer->email = $request->email;
        $consumer->note = $request->note;
        $consumer->birthday = $request->birth;

        $consumer->save();

        $address->street = $request->street;
        $address->neighborhood = $request->neighborhood;
        $address->building_number = $request->building_number;
        $address->complement = $request->complement;
        $address->city = $request->city;
        $address->state = $request->state; 
        $address->consumer_id = $consumer->id;

        $address->save();

        if($contacts){
            foreach($contacts as $newContact){
                $contact = new Contact();
                
                if($newContact->type == "WHATSAPP"){
                    $contact->type = $newContact->type;
                    $contact->phone = $newContact->number;
                }
                if($newContact->type == "PHONE"){
                    $contact->type = $newContact->type;
                    $contact->phone = $newContact->number;            
                }
                if($newContact->type == "CELL_PHONE"){
                    $contact->type = $newContact->type;
                    $contact->phone = $newContact->number;            
                }
    
                $contact->consumer_id = $consumer->id;
                $contact->save();
            }
        }
        

        $consumer = Consumer::find($id);
        $contacts = $consumer->contacts;
        $address = $consumer->address;

        // dd($address);


        return view('consumer', compact('consumer', 'contacts', 'address', 'msg'));

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
}
