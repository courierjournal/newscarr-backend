<?php

namespace App\Http\Controllers;

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

    public function getList(){
        return "Message from the controller - Partial list data goes here";
    }

    public function getFullRecord($id){
        return "Message from the controller - Full record goes here. Id is {$id}";
    }
}
