<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{

    public function __construct()
    {
        config(['database.connections.privatedb.database' => 'contacts']);
    }

    /**
     * Get an initial list for table
     *
     * @return Array
     */
    public function getList(Request $request)
    {
        $query = 'SELECT * FROM contacts ORDER BY category ASC, contact_person ASC';
        $list = DB::connection('privatedb')->select($query);
        return response()->json($list);
    }


    public function upsertRecord(Request $request)
    {
        //Upsert incident
        DB: insert('INSERT INTO incidents (id, date, time, address, city, state, zip, lat, lng, narrative, notes, guns, source, story) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        //Upsert victims
        foreach ($victim as $request->post->victims) { }
        //Upsert suspects
        foreach ($suspect as $request->post->suspects) { }

        return "Message from the controller - Full body is here " . json_encode($request->post());
    }

    public function deleteRecord()
    { }
}
