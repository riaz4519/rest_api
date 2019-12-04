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

        $student_data = $student->get_single_student();

        if (!empty($student_data)){

            http_response_code(200);
            echo json_encode(array(
                "status" =>1,
                'data'=>$student_data,
            ));
        }else{
            http_response_code(404);//data not found
            echo json_encode(array(

                "status" => 0,
                "message" => "Data not found"

            ));

        }
    }


}else{

    http_response_code('503'); //service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access Denied",
    ));


}




