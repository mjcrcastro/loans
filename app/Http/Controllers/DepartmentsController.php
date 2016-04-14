<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department;
use App\Country;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list of all departments
        $departments = Department::paginate(7);
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //attach the list of countries to the department creation form
        $countries = Country::lists('description', 'id');
        return view('departments.create', compact('countries'));
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
        $this->validate($request, ['description' => 'required|unique:departments,description,null,{{$id}},country_id,'.$request->country_id],
                                  ['country_id'=>'required']);

        $department = Department::create($request->all());
        //and return to the index
        return redirect()->route('departments.index')
                        ->with('status', 'Department ' . $department->country_department . ' created');
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
        $department = Department::find($id); //the the department by the id
        if (is_null($department)) { //if no department is found
            return redirect()->route('departments.index'); //go to index
        }
        
        //otherwise display the shop editor view but before,
        //attach the list of countries to the department creation form
        $countries = Country::lists('description', 'id');
        return view('departments.edit', compact('department','countries'));
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
        $this->validate($request, ['description' => 'required|unique:departments,description,null,{{$id}},country_id,'.$request->country_id],
                                  ['country_id'=>'required']);

        $department = Department::find($id);
        $department->fill($request->all());
        $department->save();
        //and return to the index
        return redirect()->route('departments.index')
                        ->with('status', 'Department ' . $department->description . ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete the department
        $description = Department::find($id)->description;
        
        $municipalities = \App\Municipality::where('department_id','=',$id);
        //check if there are municipalities within the department first
        if($municipalities->count()) {
            return redirect()->route('departments.index')
                ->with('warning', 'Department ' . $description . ' has municipalities');
        }else{
        Department::find($id)->delete();
        return redirect()->route('departments.index')
                ->with('status', 'Department ' . $description . ' deleted');
    }
    }
}
