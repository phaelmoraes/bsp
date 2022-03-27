<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\Contact;
use App\Models\Address;

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
    public function store(Request $request) {
        
        $contactsJSON = $request->contacts;
        $contacts = json_decode($contactsJSON);

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
        // dd($request->all(), strlen($request->cpf_cnpj), $consumer);

        $consumer->gender = $request->gender;
        $consumer->email = $request->email;
        $consumer->note = $request->note;
        $consumer->birthday = $request->birth;

        $consumer->save();

        
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
        

        $address = new Address();
        $address->street = $request->street;
        $address->neighborhood = $request->neighborhood;
        $address->building_number = $request->building_number;
        $address->complement = $request->complement;
        $address->city = $request->city;
        $address->state = $request->state; 
        $address->consumer_id = $consumer->id;

        $address->save();


        $consumers = Consumer::all();

        return view('consumers', compact('consumers'));
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
        $consumer = Consumer::find($id);
        $contacts = $consumer->contacts;
        $address = $consumer->address;

        // dd($address);


        return view('consumer', compact('consumer', 'contacts', 'address'));
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


        return view('consumer', compact('consumer', 'contacts', 'address'));

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
