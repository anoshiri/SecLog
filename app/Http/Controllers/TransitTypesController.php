<?php
/**
 * Class is in the controllers namespace
 */
namespace App\Http\Controllers;

use App\Models\TransitType;
use Illuminate\Http\Request;

/** 
 * Transit-Types Controller 
 * 
 * @author Chuks Anoshiri <anoshiri@gmail.com>
 * 
 */
class TransitTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = TransitType::select('id', 'title', 'status')->get();

        $data = ['types' => $types];
        return view('transit-types', compact('data'));
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
        $request->validate (
            ['title' => 'required|min:3']
        );

        // save to db
        $model = new TransitType();
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
     * @param  \App\Models\TransitType $transit_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransitType $transit_type)
    {
        //
        $request->validate(
            [ 'title' => 'required' ]
        );

        $transit_type->update($request->only($transit_type->fillable));

        return response()->json(
            [ 
                'message' => 'Successful! Item was updated.',
                'item' => ['id' => $transit_type->id, 'title' => $transit_type->title, 'status' => $transit_type->status]
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransitType $transit_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransitType $transit_type)
    {
        // remove the selected item
        $transit_type->delete();
        return response()->json(
            [ 'message' => 'Successful! Item was deleted.']
        );
    }
}
