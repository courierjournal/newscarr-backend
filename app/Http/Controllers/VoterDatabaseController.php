<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoterDatabaseController extends Controller
{
    private $db;

    public function __construct()
    {
        config(['database.connections.privatedb.database' => 'voterdb']);
        $this->db = DB::connection('privatedb');
    }

    /**
     * Search for entries in the voter db
     *
     * @return Array
     */
    public function search(Request $request)
    {
        $exact = $request->input('exact') ? "" : "%";
        $queryItems = [
            "FIRST_NAME" => 'firstName',
            "LAST_NAME" => 'lastName',
            "GENDER" => 'gender',
            "PARTY" => 'party',
            "STREET" => 'street',
            "CITY" => 'city',
            "ZIP" => 'zip',
            "COUNTY" => 'county'
        ];
        $searchQuery = "";
        foreach ($queryItems as $key => $item) {
            if ($request->input($item)) {
                $searchQuery .= "{$key} LIKE '{$exact}{$request->input($item)}{$exact}' AND ";
            }
        }

        $searchQuery = substr($searchQuery,0,-4);
        //$query = "SELECT ID as id, LAST_NAME as lastName, FIRST_NAME as firstName, MIDDLE_NAME as middleName, GENDER as gender, PARTY as party, ADDRESS_RESIDENCE as addressResidence, CITY_RESIDENCE as cityResidence, STATE_RESIDENCE as stateResidence, ZIP_RESIDENCE as zipResidence, ADDRESS_MAILING as addressMailing, CITY_MAILING as cityMailing, STATE_MAILING as stateMailing, ZIP_MAILING as zipMailing, DOB as dob, REGISTRATION_DATE as registrationDate, H_YR1_LABEL as  FROM list WHERE {$searchQuery} LIMIT 0,100";
        $query = "SELECT * FROM list WHERE {$searchQuery} LIMIT 0,100";
        $list = $this->db->select($query);
        return response()->json($list);
    }
}
