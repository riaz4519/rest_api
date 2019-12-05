<?php
                    /*Headers*/
//allow request from
header("Access-Control-Allow-Origin: *");
//request type accept
header("Access-Control-Allow-Methods: POST");
//content type
header("Content-type:application/json; charset: UTF-8");

                    /*Headers*/

                /*//include files */

include_once('../config/Database.php');

include_once ('../classes/Users.php');

                /*//include files */

//objects
$db = new Database();

$connection = $db->connect();

$users_obj = new Users($connection);

//check for post request type
if ($_SERVER['REQUEST_METHOD'] == "POST"){


    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->name) &&!empty($data->email) &&!empty($data->password)){
        
        $users_obj->name = $data->name;
        $users_obj->email = $data->email;
        $users_obj->password = password_hash($data->password,PASSWORD_DEFAULT);

        //calling creating function for creating user

        if ($users_obj->create_user()){

            http_response_code(200);//ok
            echo json_encode(array(
               "status" => 1,
               "message" => "User has been created",
            ));

        }else{

            http_response_code(500);

            echo json_encode(array(

                "status" => 0,
                "message" => "Failed to save user",

            ));

        }

        

    }else{

        http_response_code(500);
        echo json_encode(array(

            "status" => 0,
            "message" => "All data needed",
        ));

    }

}else{

    http_response_code(503);
    echo json_encode(array(

        "status" => 0,
        "message" => "Access Denied",

    ));

}
