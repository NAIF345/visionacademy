<?php

namespace App\Http\Controllers\API\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CourseController extends Controller
{

    public function create()
    {
        if (!Gate::allows('teacher-only')) {
            return Response::json([
                'status' => 'error',
                'message' => 'You dont have the right permission to perform this action.'
            ], 401);
        }
        return Response::json(Auth::user()->courses);
    }
}
