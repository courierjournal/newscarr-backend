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

    public function upsertRecord(Request $request)
    {
        $body = $request->json()->all();
        if ($body['id'] === null) {
            unset($body['id']);
            $query = 'INSERT into contacts (category, name, contact_person, phone, phone_ext, alt_phone, email, notes) values (:category, :name, :contactPerson, :phone, :ext, :altPhone, :email, :notes)';
            $count = $this->db->insert($query, $body);
        } else {
            $query = 'UPDATE contacts SET category=:category, name=:name, contact_person=:contactPerson, phone=:phone, phone_ext=:ext, alt_phone=:altPhone, email=:email, notes=:notes WHERE id = :id';
            $count = $this->db->update($query, $body);
        }
        $res = ($count === 1) ? ['ok' => true] : ['ok' => false];
        return response()->json($res);
    }

    public function deleteRecord(Request $request)
    {
        $id = $request->input('id');
        $query = 'DELETE from contacts WHERE id=:id';
        $count = $this->db->delete($query, ['id' => $id]);
        $res = ($count === 1) ? ['ok' => true] : ['ok' => false];
        return response()->json($res);
    }
}
