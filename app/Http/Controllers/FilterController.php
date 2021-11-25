<?php

namespace App\Http\Controllers;

use App\Models\filter;
use Illuminate\Http\Request;
use App\Imports\ExcelImport;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('TBL_3G')->get();

        return view('filterindex')->with([
            'products' => $products,
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function show(filter $filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(filter $filter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, filter $filter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function destroy(filter $filter)
    {
        //
    }
}
