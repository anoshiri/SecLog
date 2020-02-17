<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        //
        $employees = Employee::with('location')->paginate();
        $locations = Location::isActive()->select('id', 'title')->get();

        $data = ['employees' => $employees, 'locations' => $locations];
        return view('employees', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response json
     */
    public function store(Request $request)
    {
        // validate input
        $request->validate($this->rules());

        // save to db
        $model = new Employee();
        $model->fill($request->only($model->fillable));
        $model->save();

        // send response to user
        return response()->json(
            [
                'message' => 'Successful! Item was saved.', 
                'item' => $model
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $request->validate($this->rules());

        $employee->update($request->only($employee->fillable));

        return response()->json(
            [ 
                'message' => 'Successful! Item was updated.',
                'item' => $employee
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        // remove the selected item
        $employee->delete();

        return response()->json(
            [ 'message' => 'Successful! Item was deleted.']
        );
    }

    private function rules() 
    {
        return [ 
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email',
        ];
    }
}
