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


    public function upsertRecord(Request $request)
    {
        $body = $request->json()->all();
        if ($body['id'] === null) {
            unset($body['id']);
            $query = 'INSERT into bookmarks (category, name, url, notes) values (:category, :name, :url, :notes)';
            $count = $this->db->insert($query, $body);
        } else {
            $query = 'UPDATE bookmarks SET category=:category, name=:name, url=:url, notes=:notes WHERE id = :id';
            $count = $this->db->update($query, $body);
        }
        $res = ($count === 1) ? ['ok' => true] : ['ok' => false];
        return response()->json($res);
    }

    public function deleteRecord(Request $request)
    {
        $id = $request->input('id');
        $query = 'DELETE from bookmarks WHERE id=:id';
        $count = $this->db->delete($query, ['id' => $id]);
        $res = ($count === 1) ? ['ok' => true] : ['ok' => false];
        return response()->json($res);
    }
}
