<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookmarksController extends Controller
{
    private $db;

    public function __construct()
    {
        config(['database.connections.privatedb.database' => 'bookmarks']);
        $this->db = DB::connection('privatedb');
    }

    /**
     * Get an initial list for table
     *
     * @return Array
     */
    public function getList(Request $request)
    {
        $query = 'SELECT * FROM bookmarks ORDER BY category ASC, name ASC';
        $list = $this->db->select($query);
        return response()->json($list);
    }

    public function getFullList(Request $request){

    }


    public function upsertRecord(Request $request)
    {

    }

    public function deleteRecord()
    { }
}
