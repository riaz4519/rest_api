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


    //receiving data from the post request

    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data) && !empty($data->name) && !empty($data->email) && !empty($data->mobile)){
        //submit data

        $student->name = $data->name;
        $student->email = $data->email;
        $student->mobile = $data->mobile;

        //create data

        if ($student->create_data()){

            //return code
            http_response_code(200);  //means we are returning ok value
            echo json_encode(array(
                "status" => 1,
                "message" => "student has been created"
            ));

        }else{

            //return code
            http_response_code(500);  //internal server error
            echo json_encode(array(
                "status" => 0,
                "message" => "failed to create student"
            ));
        }
    }
    else{
        //return code
        http_response_code(404);  //page not found
        echo json_encode(array(
            "status" => 0,
            "message" => "All values needed"
        ));
    }


}else{

    //return code
    http_response_code(503);  //means service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "access denied"
    ));

}

