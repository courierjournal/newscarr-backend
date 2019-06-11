<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{

    public function __construct()
    {
        config(["database.connections.mysql" => [
            "database" => "contacts"
        ]]);
    }

    /**
     * Get an initial list for table
     *
     * @return Array
     */
    public function getList(Request $request)
    {
        $query = 'SELECT incidents.id, incidents.address, incidents.date, incidents.narrative, COUNT(victims.incident_id) as victimCount FROM incidents LEFT JOIN victims ON incidents.id=victims.incident_id GROUP BY incidents.id ORDER BY incidents.date DESC';
        $list = DB::select($query);
        foreach ($list as $index => $row) {
            if (strlen($row->narrative) > 50) {
                $list[$index]->narrative = substr($row->narrative, 0, self::MAXNARRATIVE) . "...";
            }
        }
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
