<?php

namespace App\Http\Controllers;

use Model\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request) {
        $q = $request->q;
        $start = (int) $request->page;
        $start = $start ? $start - 1 : 0;
        $limit = (int) $request->limit ? (int) $request->limit : 10;

        $where = Mahasiswa::where('nama', 'like', '%' . $q . '%');
        $count = $where->count();
        $result = $where->offset($start * $limit)->limit($limit)->get();

        $options = [];
        foreach($result as $row) {
            $options[] = ['id' => $row->id, 'text' => $row->nama];
        }

        return response()->json(['items' => $options, 'total_count' => $count, 'limit' => $limit]);
    }
}
