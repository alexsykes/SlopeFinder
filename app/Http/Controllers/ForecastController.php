<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreforecastRequest;
use App\Http\Requests\UpdateforecastRequest;
use App\Models\Forecast;

class ForecastController extends Controller
{
    public function __construct($data) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreforecastRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Forecast $forecast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forecast $forecast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateforecastRequest $request, Forecast $forecast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forecast $forecast)
    {
        //
    }
}
