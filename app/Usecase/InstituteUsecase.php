<?php

/*
 *  Business logic handle here
 */

namespace App\Usecase;

use App\Repository\Contracts\InstituteRepositoryInterface;

class InstituteUsecase
{

    /**
     * @var InstituteRepositoryInterface
     */
    private $InstituteRepository;

    /**
     * Dependence Injection
     * @param InstituteRepositoryInterface $InstituteRepository
     */
    public function __construct(InstituteRepositoryInterface $InstituteRepository)
    {

        $this->InstituteRepository = $InstituteRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createStudent($data)
    {
        return $this->InstituteRepository->createStudent($data);
    }


    /**
     * @param $data
     * @return mixed
     */
    public function createCourse($data)
    {
        return $this->InstituteRepository->createCourse($data);
    }


    /**
     * @param $data
     * @return mixed
     */
    public function createCourseEnrollment($data)
    {
        return $this->InstituteRepository->createCourseEnrollment($data);
    }


    /**
     * @return mixed
     */
    public function getStudents()
    {
        return $this->InstituteRepository->getStudents();
    }


    /**
     * @return mixed
     */
    public function getcourses()
    {
        return $this->InstituteRepository->getcourses();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getstudentCoursesById($id)
    {
        return $this->InstituteRepository->getstudentCoursesById($id);
    }

}
