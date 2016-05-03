<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Loan;
use App\Contact;

class LoansController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //List all loans
        $loans = Loan::paginate(7);
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //attach the list of contacts to the loans creation form
        $contacts = Contact::orderBy('contacts.name', 'contacts.first_lastname', 'contacts.second_lastname')->get()
                ->lists('full_name', 'id');
        $funds = \App\Fund::orderBy('description')->get()
                ->lists('description', 'id');
        $loan_statuses = \App\LoanStatus::orderBy('description')->get()
                ->lists('description', 'id');
        $loan_categories = \App\LoanCategory::orderBy('description')->get()
                ->lists('description', 'id');
        $terms = ['1' => 'Days', '2' => 'Weeks', '3' => 'Months', '4' => 'Years'];
        return view('loans.create', compact('contacts', 'funds', 'loan_statuses', 'loan_categories', 'terms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //$this->validate returns an error message to the view.
        $this->validate($request, [
            'borrower_id' => 'required',
            'approval_date' => 'required|date',
            'fund_id' => 'required',
            'loan_category_id' => 'required',
            'guarantor_id' => 'required',
            'loan_status_id' => 'required',
            'agent_id' => 'required',
            'principal' => 'required|numeric|min:1',
            'term_id' => 'required|integer',
            'term_value' => 'required|integer|min:1',
            'loan_rate' => 'required|numeric|min:0.01',
            'late_fee' => 'required|numeric|min:0.01',
            'guarantor_id' => 'required|integer',
            'loan_status_id' => 'required|integer',
            'agent_id' => 'required|integer',
            'fund_id' => 'required|integer',
            'contract_URL' => 'required',
                ]
        );

        $loan = Loan::create($request->all());
        //and return to the index
        return redirect()->route('loans.index')
                        ->with('message', 'Loan created');
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
        //Actual code to execute
        $loan = Loan::find($id); //the the country by the id
        if (is_null($loan)) { //if no country is found
            return redirect()->route('loans.index'); //go to previous page
        } else {
            //attach the list of contacts and other lists to the loans editing form
            $contacts = Contact::orderBy('contacts.name', 'contacts.first_lastname', 'contacts.second_lastname')->get()
                    ->lists('full_name', 'id');
            $funds = \App\Fund::orderBy('description')->get()
                    ->lists('description', 'id');
            $loan_statuses = \App\LoanStatus::orderBy('description')->get()
                    ->lists('description', 'id');
            $loan_categories = \App\LoanCategory::orderBy('description')->get()
                    ->lists('description', 'id');
            $terms = ['1' => 'Days', '2' => 'Weeks', '3' => 'Months', '4' => 'Years'];
            return view('loans.edit', compact('loan', 'contacts', 'funds', 'loan_statuses', 'loan_categories', 'terms'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        //$this->validate returns an error message to the view.
        $this->validate($request, [
            'borrower_id' => 'required', 'approval_date' => 'required|date',
            'fund_id' => 'required', 'loan_category_id' => 'required',
            'guarantor_id' => 'required', 'loan_status_id' => 'required',
            'agent_id' => 'required', 'principal' => 'required|numeric|min:1',
            'term_id' => 'required|integer', 'term_value' => 'required|integer|min:1',
            'loan_rate' => 'required|numeric|min:0.01',
            'late_fee' => 'required|numeric|min:0.01',
            'guarantor_id' => 'required|integer', 'loan_status_id' => 'required|integer',
            'agent_id' => 'required|integer', 'fund_id' => 'required|integer',
            'contract_URL' => 'required',
                ]
        );

        $loan = Loan::find($id);
        $loan->fill($request->all());
        $loan->save();

        //and return to the index
        return redirect()->route('loans.index')
                        ->with('message', 'Loan updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //TODO check for orphans of this loan before deleting
        Loan::find($id)->delete();
        return redirect()->route('loans.index')
                        ->with('status', 'Loan deleted');
    }

}
