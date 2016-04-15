<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contact;
use App\Municipality;
use App\Occupation;

class ContactsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $contacts = Contact::paginate(7);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //see Municipality model for the definition of get
        $municipalities = Municipality::orderBy('municipalities.description')->get()
                ->lists('country_department_municipality','id');
        $occupations = Occupation::orderBy('occupations.description')->get()
                ->lists('description','id');
        $employers = Contact::orderBy('contacts.name','contacts.first_lastname','contacts.second_lastname')->get()
                ->lists('full_name','id');
        return view('contacts.create',compact('municipalities','occupations','employers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
       //$this->validate returns an error message to the view.
        $this->validate($request,['identification'=>'required|unique:contacts,identification,{{$id}}',
            'birthdate'=>'required|date']);
        
        $contact = Contact::create($request->all());
            //and return to the index
        return  redirect()->route('contacts.index')
                            ->with('message', 'Contact ' . $contact->name . ' created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //see Municipality model for the definition of get
        $municipalities = Municipality::orderBy('municipalities.description')->get()
                ->lists('country_department_municipality','id');
        $occupations = Occupation::orderBy('occupations.description')->get()
                ->lists('description','id');
        $employers = Contact::orderBy('contacts.name','contacts.first_lastname','contacts.second_lastname')
                ->where('contacts.id','<>',$id)->get() //to avoid listing himself as the employer
                ->lists('full_name','id');
        $contact = Contact::find($id);
        if (is_null($contact)) { //if no contact is found
            return redirect()->route('contacts.index'); //go to previous page
        }
        return view('contacts.edit',compact('contact','municipalities','occupations','employers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //$this->validate returns an error message to the view.
        $this->validate($request,['identification'=>'required|unique:contacts,identification,'.$id,
            'birthdate'=>'required|date']);

        $contact = Contact::find($id);
        $contact->fill($request->all());
        $contact->save();
        //and return to the index
        return redirect()->route('contacts.index')
                        ->with('status', 'Contact ' . $contact->description . ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
         //delete the contact
        $description = Contact::find($id)->description;
        
        //check if there are child tables associated to this municipalities
        
        
        if (FALSE) { //TODO check for childs to this contact
            return redirect()->route('contacts.index')
                            ->with('warning', 'Contact ' . $description . ' has Contracts');
        } else {
            Contact::find($id)->delete();
            return redirect()->route('contacts.index')
                            ->with('status', 'Contact ' . $description . ' deleted');
        }
    }

}
