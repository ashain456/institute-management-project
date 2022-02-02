<?php

namespace App\Repository\Contracts;

use Illuminate\Database\Eloquent\Model;


interface InstituteRepositoryInterface
{

    /**
     * @return mixed
     */
    public function createStudent($data);

    /**
     * @return mixed
     */
    public function createCourse($data);

    /**
     * @return mixed
     */
    public function createCourseEnrollment($data);

    /**
     * @return mixed
     */
    public function getStudents();

    /**
     * @return mixed
     */
    public function getcourses();

    /**
     * @param $id
     * @return mixed
     */
    public function getstudentCoursesById($id);

}
