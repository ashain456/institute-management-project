<?php

namespace App\Repository\Mysql;

use App\Models\CourseModel;
use App\Models\StudentCourseModel;
use App\Models\StudentModel;
use App\Repository\Contracts\InstituteRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class InstituteRepository implements InstituteRepositoryInterface
{

    public function createStudent($data)
    {
        try{
            $data['password'] = Hash::make($data['password']);
            return StudentModel::create($data);
        }catch (\Exception $ex) {
            Log::error("Error in query: ", (array)$ex);
            throw $ex;
        }
    }

    public function createCourse($data)
    {
        try{
            return CourseModel::create($data);
        }catch (\Exception $ex) {
            Log::error("Error in query: ", (array)$ex);
            throw $ex;
        }
    }

    public function createCourseEnrollment($data)
    {
        try{
            return StudentCourseModel::create($data);
        }catch (\Exception $ex) {
            Log::error("Error in query: ", (array)$ex);
            throw $ex;
        }
    }

    public function getStudents()
    {
        try{
            return StudentModel::all();
        }catch (\Exception $ex) {
            Log::error("Error in query: ", (array)$ex);
            throw $ex;
        }
    }

    public function getcourses()
    {
        try{
            return CourseModel::all();
        }catch (\Exception $ex) {
            Log::error("Error in query: ", (array)$ex);
            throw $ex;
        }
    }

    public function getstudentCoursesById($id)
    {

        try{
            return StudentCourseModel::join('courses', 'courses.id', '=', 'student_courses.course_id')
                ->where('student_courses.student_id', '=', $id)
                ->get(['courses.code',
                       'courses.name',
                       'courses.description']);

        }catch (\Exception $ex) {
            Log::error("Error in query: ", (array)$ex);
            throw $ex;
        }
    }


}
