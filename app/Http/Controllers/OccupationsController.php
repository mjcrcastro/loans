<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Occupation;

class OccupationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $occupations = Occupation::paginate(7);
        return view('occupations.index', compact('occupations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        
        return view('occupations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //$this->validate returns an error message to the view.
        $this->validate($request, ['description' => 'required|unique:occupations,description']);

        $occupation = Occupation::create($request->all());
        //and return to the index
        return redirect()->route('occupations.index')
                        ->with('status', 'Occupation ' . $occupation->description . ' created');
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
        $occupation = Occupation::find($id); //the the country by the id
        if (is_null($occupation)) { //if no country is found
            return redirect()->route('occupations.index'); //go to previous page
        }
        //otherwise display the shop editor view
        return view('occupations.edit', compact('occupation'));
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
        $this->validate($request, ['description' => 'required|unique:occupations,description,{{$id}}']);

        $occupation = Occupation::find($id);
        $occupation->fill($request->all());
        $occupation->save();
        //and return to the index
        return redirect()->route('occupations.index')
                        ->with('status', 'Occupation ' . $occupation->description . ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $description = Occupation::find($id)->description;
        //check for existing contacts having this occupation
        $contacts = \App\Contact::where('occupation_id','=',$id);
        if ($contacts->count()) {
            return redirect()->route('occupations.index')
                ->with('warning', 'Occupation ' . $description . ' has contacts');
        }
        else{
        Occupation::find($id)->delete();
        return redirect()->route('occupations.index')
                ->with('status', 'Occupation ' . $description . ' deleted');
        }
    }
}
