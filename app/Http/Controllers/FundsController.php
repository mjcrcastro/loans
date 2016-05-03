<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fund;

class FundsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = Fund::paginate(7);
        return view('funds.index', compact('funds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('funds.create');
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
        $this->validate($request, ['description' => 'required|unique:funds,description']);

        $fund = Fund::create($request->all());
        //and return to the index
        return redirect()->route('funds.index')
                        ->with('status', 'Country ' . $fund->description . ' created');
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
        $fund = Fund::find($id); //the the country by the id
        if (is_null($fund)) { //if no country is found
            return redirect()->route('funds.index'); //go to previous page
        }
        //otherwise display the shop editor view
        return view('funds.edit', compact('fund'));
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
        $this->validate($request, ['description' => 'required|unique:funds,description,{{$id}}']);

        $fund = Fund::find($id);
        $fund->fill($request->all());
        $fund->save();
        //and return to the index
        return redirect()->route('funds.index')
                        ->with('status', 'Fund ' . $fund->description . ' updated');
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
        $description = Fund::find($id)->description;
        //check for existing departments that belong to this country
        $loans = \App\Loan::where('fund_id','=',$id);
        if ($loans->count()) {
            return redirect()->route('funds.index')
                ->with('warning', 'Fund ' . $description . ' has loans');
        }
        else{
        Fund::find($id)->delete();
        return redirect()->route('funds.index')
                ->with('status', 'Fund ' . $description . ' deleted');
        }
    }
}
