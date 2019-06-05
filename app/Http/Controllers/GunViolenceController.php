<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GunViolenceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getList()
    {
        return "Message from the controller - Partial list data goes here";
    }

    public function getFullRecord($id)
    {
        return "Message from the controller - Full record goes here. ID is {$id}";
    }

    public function upsertIncident(Request $request)
    {
        return "Message from the controller - Full body is here " . json_encode($request->post());
    }

    public function upsertSuspect()
    { }

    public function upsertVictim()
    { }

    public function deleteRecord()
    { }
}
