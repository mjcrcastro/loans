<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LoanCategory;

class LoanCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loan_categories = LoanCategory::paginate(7);
        return view('loan_categories.index', compact('loan_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        //
        return view('loan_categories.create');
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
        $this->validate($request, ['description' => 'required|unique:loan_categories,description']);

        $loan_category = LoanCategory::create($request->all());
        //and return to the index
        return redirect()->route('loan_categories.index')
                        ->with('status', 'Loan category ' . $loan_category->description . ' created');
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
        $loan_category = LoanCategory::find($id); //find the loan category by the id
        if (is_null($loan_category)) { //if no loan category is found
            return redirect()->route('loan_categories.index'); //go to previous page
        }
        //otherwise display the editor view
        return view('loan_categories.edit', compact('loan_category'));
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
        $this->validate($request, ['description' => 'required|unique:loan_categories,description,{{$id}}']);

        $loan_category = LoanCategory::find($id);
        $loan_category->fill($request->all());
        $loan_category->save();
        //and return to the index
        return redirect()->route('loan_categories.index')
                        ->with('status', 'Loan category ' . $loan_category->description . ' updated');
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
        $description = LoanCategory::find($id)->description;
        //check for existing departments that belong to this country
        $loans = \App\Loan::where('loan_category_id','=',$id);
        if ($loans->count()) {
            return redirect()->route('loan_categories.index')
                ->with('warning', 'Loan categories ' . $description . ' has loans');
        }
        else{
        LoanCategory::find($id)->delete();
        return redirect()->route('loan_categories.index')
                ->with('status', 'Loan categories ' . $description . ' deleted');
        }
    }
}
