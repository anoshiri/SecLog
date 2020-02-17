<?php

/**
* Class in controllers namespace
*/
namespace App\Http\Controllers;

use App\Models\Transit;
use Illuminate\Http\Request;

/**
 * Transits Controller.
 */
class TransitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('transits');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transit  $transit
     * @return \Illuminate\Http\Response
     */
    public function show(Transit $transit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transit $transit
     * @return \Illuminate\Http\Response
     */
    public function edit(Transit $transit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Transit $transit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transit $transit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transit  $transit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transit $transit)
    {
        //
    }
}
