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


}