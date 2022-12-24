<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function searchInfo($data)
    {
        $searchText = $data ?? '';
        $result = [];
        if (!empty($searchText)) {
            $res = User::where('first_name', 'LIKE', '%' . $searchText . '%')
            ->orWhere('last_name', 'LIKE', '%' . $searchText . '%')
            ->orWhere('email', 'LIKE', '%' . $searchText . '%')
            ->select('first_name','last_name','email',
            DB::raw("CONCAT(first_name,' ',last_name) AS full_name")
            )
            ->get();
            $result['item'] = $res;
            return $result;
        }else {
            return 'Type some data for search';
        }
    }
    public function thirdHighestMark()
    {

        $results = DB::select( DB::raw("SELECT student_id
        FROM student_marks
        ORDER BY mark DESC
        LIMIT 3, 1"));

        return $results;
    }
}
