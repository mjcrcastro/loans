<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Loan;
use App\Contact;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List all loans
        $loans = Loan::paginate(7);
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //attach the list of contacts to the loans creation form
        $contacts = Contact::orderBy('contacts.name','contacts.first_lastname','contacts.second_lastname')->get()
                ->lists('full_name','id');
        return view('loans.create', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validate returns an error message to the view.
        $this->validate($request,[
            'borrower_id'=>'required',
            'approval_date'=>'required|date',
            'fund_id'=>'required',
            'loan_category_id'=>'required',
            'guarantor_id'=>'required',
            'loan_status_id'=>'required',
            'agent_id'=>'required',
            'principal'=>'required|numeric|min:1',
            'term'=>'required|integer|min:1',
            'loan_rate'=>'required|numeric|min:0.01',
            'late_fee'=>'required|numeric|min:0.01',
            'guarantor_id'=>'required|integer',
            'status_id'=>'required|integer',
            'agent_id'=>'required|integer',
            'fund_id'=>'required|integer',
            'contract_URL'=>'required',
            ]
                );
        
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
        //
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
        //
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
