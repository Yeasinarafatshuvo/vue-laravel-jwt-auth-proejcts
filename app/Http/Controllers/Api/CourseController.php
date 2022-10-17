<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //COURSE ENROLLMENT API - POST
    public function courseEnrollment(Request $request)
    {
        //validation
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'total_videos' => 'required'
        ]);


        //save data 
        $course = new Course();
        $course->user_id = auth()->user()->id;
        $course->title  = $request->title;
        $course->description  = $request->description;
        $course->total_videos  = $request->total_videos;
        $course->save();

        //send reponse 
        return response()->json([
            'status' => 1,
            'message' => 'Course Enrolled Successfully',
        ]);

    }

    //TOTAL USER COURSES ENROLLMENT  API - GET
    public function totalCourses()
    {
        $id = auth()->user()->id;
        $courses = User::find($id)->courses;

        return response()->json([
            'statis' => 1,
            'message' => 'Total Courses Enrolled',
            'data' => $courses
        ], 201);

    }

    //DELETE COURSE FROM USER
    public function deleteCourses($id)
    {
        $user_id = auth()->user()->id;

        if(Course::where(['id' => $id, 'user_id' => $user_id ])->exists())
        {
            $course = Course::find($id);
            $course->delete();

            return response()->json([
                'statis' => 1,
                'message' => 'Course Deleted Successfully',
            ], 201);
        }else{
            return response()->json([
                'statis' => 0,
                'message' => 'Course Not Found',
            ], 404);
    
        }

    }
}
