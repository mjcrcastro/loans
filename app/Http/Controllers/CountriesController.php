<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Country; //Include Countries model within this controller

class CountriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $countries = Country::paginate(7);
        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //$this->validate returns an error message to the view.
        $this->validate($request, ['description' => 'required|unique:countries,description,'.$request->all()->id]);

        $country = Country::create($request->all());
        //and return to the index
        return redirect()->route('countries.index')
                        ->with('status', 'Country ' . $country->description . ' created');
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
        $country = Country::find($id); //the the country by the id
        if (is_null($country)) { //if no country is found
            return redirect()->route('countries.index'); //go to previous page
        }
        //otherwise display the shop editor view
        return view('countries.edit', compact('country'));
        // End of actual code to execute
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
        $this->validate($request, ['description' => 'required|unique:countries,description,{{$id}}']);

        $country = Country::find($id);
        $country->fill($request->all());
        $country->save();
        //and return to the index
        return redirect()->route('countries.index')
                        ->with('status', 'Country ' . $country->description . ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $description = Country::find($id)->description;
        //check for existing departments that belong to this country
        $departments = \App\Department::where('country_id','=',$id);
        if ($departments->count()) {
            return redirect()->route('countries.index')
                ->with('warning', 'Country ' . $description . ' has departments');
        }
        else{
        Country::find($id)->delete();
        return redirect()->route('countries.index')
                ->with('status', 'Country ' . $description . ' deleted');
        }
    }

}
