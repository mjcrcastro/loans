<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Department;
use App\Municipality;

class MunicipalitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list of all municipalities
        $municipalities = Municipality::paginate(7);
        return view('municipalities.index', compact('municipalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //attach the list of departments to the municipalities creation form
        //see department model for the accessor for country_department
        //usign an efficient query
       $departments = Department::orderBy('departments.description')->get()
                ->lists('country_department','id'); 
       //I get the same results with the query below but executes an additional query 
       //for every department within a country
        /*$departments = Department::with('country')->orderBy('departments.description')
                ->get()->lists('country_department','id');*/
        
        return view('municipalities.create', compact('departments'));
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
        $this->validate($request, [
            'department_id'=>'required',
            'description' => 'required|unique:municipalities,description,null,{{$id}},department_id,'.$request->department_id
            ]);

        $municipality = Municipality::create($request->all());
        //and return to the index
        return redirect()->route('municipalities.index')
                        ->with('status', 
                                'Municipality ' . $municipality->country_department_municipality . ' created');
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
        $municipality = Municipality::find($id); //the the department by the id
        if (is_null($municipality)) { //if no department is found
            return redirect()->route('municipalities.index'); //go to index
        }
        
        //otherwise display the shop editor view but before,
        //attach the list of countries to the department creation form
         //attach the list of departments to the municipalities creation form
        //see department model for the accessor for country_department
        //usign an efficient query
       $departments = Department::orderBy('departments.description')->get()
                ->lists('country_department','id'); 
        return view('municipalities.edit', compact('municipality','departments'));
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
        $this->validate($request, ['description' => 'required|unique:municipalities,description,null,{{$id}},department_id,'.$request->department_id],
                                  ['department_id'=>'required']);

        $municipality = Municipality::find($id);
        $municipality->fill($request->all());
        $municipality->save();
        //and return to the index
        return redirect()->route('municipalities.index')
                        ->with('status', 
                                'Municipality ' . $municipality->country_department_municipality . ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete the municipality
        $description = Municipality::find($id)->description;
        
        //check if there are child tables associated to this municipalities
        $municipalities = \App\Contact::where('municipality_id', '=', $id);
        
        if ($municipalities->count()) {
            return redirect()->route('municipalities.index')
                            ->with('warning', 'Department ' . $description . ' has contacts');
        } else {
            Municipality::find($id)->delete();
            return redirect()->route('municipalities.index')
                            ->with('status', 'Municipality ' . $description . ' deleted');
        }
    }
}
