<?php
/*include headers*/
//setting origin - it means we can allow from any origin
header("Access-Control-Allow-Origin: *");

//defining te content type
header("Content-type: application/json; charset: UTF-8");

//allowing methods
header("Access-Control-Allow-Methods: POST");

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


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->name) &&!empty($data->email) &&!empty($data->mobile) &&!empty($data->id) ){

        $student->name = $data->name;
        $student->email = $data->email;
        $student->mobile = $data->mobile;
        $student->id = $data->id;

        if ($student->update_student()){
            http_response_code(200);//server error
            echo json_encode(array(
                "status" =>1,
                "message" => "Student data successfully updated"
            ));
        }else{
            http_response_code(500);//server error
            echo json_encode(array(
                "status" =>0,
                "message" => "Failed to update data"
            ));
        }


    }else{

        http_response_code(404);//server error
        echo json_encode(array(
            "status" =>0,
            "message" => "All Data needed!!"
        ));


    }




}else{

    http_response_code(503);//service unavailable
    echo json_encode(array(

        "status" => 0,
        "message" => "Access Denied"

    ));

}

