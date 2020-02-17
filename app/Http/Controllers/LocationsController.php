<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index()
    {
        //
        $locations = Location::select('id', 'title', 'status')->get();

        $data = ['locations' => $locations];
        return view('locations', compact('data'));
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
        $request->validate(
            [ 'title' => 'required' ]
        );

        // save to db
        $model = new Location();
        $model->fill($request->only($model->fillable));
        $model->save();

        // send response to user
        return response()->json(
            [
                'message' => 'Successful! Item was saved.', 
                'item' => ['id' => $model->id, 'title' => $model->title, 'status' => $model->status]
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
        $request->validate(
            [ 'title' => 'required' ]
        );

        $location->update($request->only($location->fillable));

        return response()->json(
            [ 
                'message' => 'Successful! Item was updated.',
                'item' => ['id' => $location->id, 'title' => $location->title, 'status' => $location->status]
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        // remove the selected item
        $location->delete();
        return response()->json(
            [ 'message' => 'Successful! Item was deleted.']
        );
    }
}
