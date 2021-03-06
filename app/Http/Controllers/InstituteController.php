<?php

namespace App\Http\Controllers;

use App\Usecase\InstituteUsecase;
use Illuminate\Http\Request;
use App\Events\SendMail;
use Event;

class InstituteController extends Controller
{
    /**
     * @var InstituteUsecase
     */
    private $InstituteUsecase;

    /**
     * Dependence Injection
     * @param InstituteUsecase $InstituteUsecase
     */
    public function __construct(InstituteUsecase $InstituteUsecase)
    {
        $this->InstituteUsecase = $InstituteUsecase;
    }

    /**
     * Register student to the system
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createStudent(Request $request)
    {
        // validate input data
        $request->validate([
            'name' => 'required|unique:students,name',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:students,email',
            'password' => 'required',
            'status' => 'required'
        ],[
            'email.regex' => 'Invalid email address format',
        ]);

        $data = $request->all();
        $res = $this->InstituteUsecase->createStudent($data);

        if($res){
            $this->sendWelcomeEmailToStudent($data['email']);
        }

        return response()->json(['message' => 'Student Successfully Registered'], 201);

    }


    /**
     * Send welcome registration email to the student
     * Use events to fire mails
     *
     * @param $email
     * @return void
     */
    private function sendWelcomeEmailToStudent($email){

        try {

            $subject = "Welcome you to our institute";
            $to = $email;
            $body = "<p>Dear Student,</p>";
            $body .= "<p>We are delighted to welcome you to our institute and excited by the return of our vibrant campus life! Whether you are beginning or continuing your educational journey with us, we look forward to learning, exploring, and growing together.</p>";
            $body .= "<p>Sincerely, <br />Henry T. Fernando <br />Course Coordinator</p>";

            // use event to fire email
            event(new SendMail($to, $subject, $body));

        }catch (\Exception $ex) {
            Log::error("Error in mail send: ", (array)$ex);
        }

    }


    /**
     * Create Course
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCourse(Request $request)
    {
        // validate input data
        $request->validate([
            'code' => 'required|unique:courses,code',
            'name' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $this->InstituteUsecase->createCourse($data);

        return response()->json(['message' => 'Course Successfully Registered'], 201);
    }

    /**
     * Course Enrollment to the student
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCourseEnrollment(Request $request)
    {
        // validate input data
        $request->validate([
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
        ]);

        $data = $request->all();
        $this->InstituteUsecase->createCourseEnrollment($data);

        return response()->json(['message' => 'Course Enrollment Successfully Done'], 201);
    }

    /**
     * List all students information
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStudents(Request $request)
    {
        $data = $this->InstituteUsecase->getStudents();
        return response()->json(['data' => $data], 200);
    }


    /**
     * List all course information
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getcourses(Request $request)
    {
        $data = $this->InstituteUsecase->getcourses();
        return response()->json(['data' => $data], 200);
    }


    /**
     * Get all course enrollment to the student
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getstudentCoursesById(Request $request, $id=0)
    {
        $data = $this->InstituteUsecase->getstudentCoursesById($id);
        return response()->json(['data' => $data], 200);
    }

}
