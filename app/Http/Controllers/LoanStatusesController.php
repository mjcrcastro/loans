<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LoanStatus;

class LoanStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loan_statuses = LoanStatus::paginate(7);
        return view('loan_statuses.index', compact('loan_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        //
        return view('loan_statuses.create');
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
        $this->validate($request, ['description' => 'required|unique:loan_statuses,description']);

        $loan_status = LoanStatus::create($request->all());
        //and return to the index
        return redirect()->route('loan_statuses.index')
                        ->with('status', 'Loan status ' . $loan_status->description . ' created');
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
        //Actual code to execute
        $loan_status = LoanStatus::find($id); //the the country by the id
        if (is_null($loan_status)) { //if no country is found
            return redirect()->route('loan_statuses.index'); //go to previous page
        }
        //otherwise display the shop editor view
        return view('loan_statuses.edit', compact('loan_status'));
        // End of actual code to execute
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
        //$this->validate returns an error message to the view.
        $this->validate($request, ['description' => 'required|unique:loan_statuses,description,{{$id}}']);

        $loan_status = LoanStatus::find($id);
        $loan_status->fill($request->all());
        $loan_status->save();
        //and return to the index
        return redirect()->route('loan_statuses.index')
                        ->with('status', 'Loan status ' . $loan_status->description . ' updated');
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
        $description = LoanStatus::find($id)->description;
        //check for existing departments that belong to this country
        $loans = \App\Loan::where('loan_status_id','=',$id);
        if ($loans->count()) {
            return redirect()->route('loan_statuses.index')
                ->with('warning', 'Loan status ' . $description . ' has loans');
        }
        else{
        LoanStatus::find($id)->delete();
        return redirect()->route('loan_statuses.index')
                ->with('status', 'Loan status ' . $description . ' deleted');
        }
    }
}
