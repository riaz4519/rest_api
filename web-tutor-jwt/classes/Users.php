<?php

class Users{

    //define properties
    public $name;
    public $email;
    public $password;
    public $user_id;
    public $project_name;
    public $description;
    public $status;

    private $conn;
    private $users_tbl;
    private $projects_tbl;


    public function __construct($db)
    {

        $this->conn = $db;
        $this->users_tbl = "tbl_users";
        $this->projects_tbl = "tbl_projects";


    }

    public function create_user(){

        $user_query = "INSERT INTO ".$this->users_tbl." SET name = ?,email = ?,password = ?";

        //prepare statement

        $user_obj = $this->conn->prepare($user_query);

        //bind parameters

        $user_obj->bind_param('sss',$this->name,$this->email,$this->password);

        //execute query

        if ($user_obj->execute()){

            return true;

        }else{

            return false;

        }

    }


}