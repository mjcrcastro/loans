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
        $this->validate($request, ['description' => 'required|unique:municipalities,description,null,{{$id}},department_id,'.$request->department_id],
                                  ['department_id'=>'required']);

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
