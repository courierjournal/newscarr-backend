<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    private $db;

    public function __construct()
    {
        config(['database.connections.privatedb.database' => 'contacts']);
        $this->db = DB::connection('privatedb');
    }

    /**
     * Get an initial list for table
     *
     * @return Array
     */
    public function getList(Request $request)
    {
        $query = 'SELECT id, category, name, contact_person AS contactPerson, phone, phone_ext AS ext, alt_phone AS altPhone, email, notes FROM contacts ORDER BY category ASC, contactPerson ASC';
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
