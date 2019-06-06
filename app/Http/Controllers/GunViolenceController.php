<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GunViolenceController extends Controller
{
    //Truncate narratives greater than this length with an ellipsis
    private const MAXNARRATIVE = 50;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        config(["database.connections.mysql" => [
            "database" => "gun_violence_database"
        ]]);
    }

    /**
     * Get an initial list for table
     *
     * @return Array
     */
    public function getList()
    {
        $list = DB::select('SELECT incidents.id, incidents.address, incidents.date, incidents.narrative, COUNT(victims.incident_id) as victimCount FROM incidents LEFT JOIN victims ON incidents.id=victims.incident_id GROUP BY incidents.id ORDER BY incidents.date DESC');
        foreach ($list as $index => $row) {
            if (strlen($row->narrative) > 50) {
                $list[$index]->narrative = substr($row->narrative, 0, self::MAXNARRATIVE) . "...";
            }
        }
        return response()->json($list);
    }

    public function getFullRecord($id)
    {
        $incident = DB::select('SELECT * FROM incidents WHERE id = ?', [$id]);
        $victims = DB::select('SELECT * FROM victims WHERE incident_id = ?', [$id]);;
        $suspects = DB::select('SELECT * FROM suspects WHERE incident_id = ?', [$id]);;
        $output = $incident[0];
        $output->victims = $victims;
        $output->suspects = $suspects;
        return response()->json($output);
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
