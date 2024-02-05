<?php

namespace App\Http\Controllers;

use App\Models\Register_customer;
use Illuminate\Http\Request;

class RegisterCustomerController extends Controller
{
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
    public function store(Request $request)
    {
        Register_customer::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Register_customer $register_customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Register_customer $register_customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Register_customer $register_customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Register_customer $register_customer)
    {
        //
    }
}
