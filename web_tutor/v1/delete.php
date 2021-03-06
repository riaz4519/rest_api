<?php

/*include headers*/
//setting origin - it means we can allow from any origin
header("Access-Control-Allow-Origin: *");

//allowing methods
header("Access-Control-Allow-Methods: GET");

/*end of headers*/
// include database.php
include_once("../config/Database.php");
//include student.php
include_once("../class/Student.php");

//create object for database

$db = new Database();

$connection = $db->connect();

//create object for student

$student = new Student($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET"){

    $student_id = isset($_GET['id']) ? intval($_GET['id']) : "";

    if (!empty($student_id)){

        $student->id = $student_id;

        if ($student->delete_student()){

            http_response_code(200);
            echo json_encode(array(

                "status" => 1,
                "message" => "Student Deleted Successfully"

            ));


        }else{
            http_response_code(500);
            echo json_encode(array(
                "status"=>0,
                "message" =>"Failed to delete student",
            ));

        }

    }else{
        http_response_code(404);
        echo json_encode(array(
            "status"=>0,
            "message"=>"All data needed"
        ));
    }



}else{

    http_response_code('503'); //service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access Denied",
    ));


}




