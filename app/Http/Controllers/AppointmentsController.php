<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        //
        $appointments = Appointment::isPending()->with('employee')->paginate();
        $employees = Employee::isActive()->select('id', 'first_name', 'last_name')->get();

        $data = ['appointments' => $appointments, 'employees' => $employees];
        return view('appointments', compact('data'));
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
        $model = new Appointment();
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
     * @param  \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
        $request->validate($this->rules());

        $appointment->update($request->only($appointment->fillable));

        return response()->json(
            [ 
                'message' => 'Successful! Item was updated.',
                'item' => $appointment
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        // remove the selected item
        $appointment->delete();

        return response()->json(
            [ 'message' => 'Successful! Item was deleted.']
        );
    }

    private function rules() 
    {
        return [ 
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }
}
