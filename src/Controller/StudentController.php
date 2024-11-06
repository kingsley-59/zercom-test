<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Model\StudentModel;

class StudentController extends BaseController
{
    private $studentModel;
    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    public function findAllWithCenterNames()
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $this->studentModel->getStudentsWithCenterNames();
        return $response;
    }

    public function findStudentsBasedOncategory($categoryId) {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $this->studentModel->getStudentsByCategory($categoryId);
        return $response;
    }
}
