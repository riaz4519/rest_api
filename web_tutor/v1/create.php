<?php
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


    //submit data

    $student->name = "fahim";
    $student->email = "riaz.i3216@gmail.com";
    $student->mobile = "8801681562828";

    //create data

    if ($student->create_data()){

        echo "student has been created";
    }else{

        echo "Failed to insert data";
    }
}else{

    echo "Access Denied";

}

