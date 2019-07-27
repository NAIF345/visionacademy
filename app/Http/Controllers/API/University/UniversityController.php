<?php

namespace App\Http\Controllers\API\University;

use App\Http\Controllers\Controller;
use App\University;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class UniversityController extends Controller
{

    public function getAllUniversities()
    {
        $universities = University::OrderBy('id', 'asc')->get();
        return Response::json($universities);
    }

    public static  function getUniversity(Request $request)
    {
        $request->validate([
            'university_id' => 'required|numeric',
        ]);
        $university = University::find($request->university_id);
        if ($university == null)
            return Response::json([
                'status' => 'error',
                'message' => 'The required university not found!'
            ]);
        return Response::json($university);
    }
}
