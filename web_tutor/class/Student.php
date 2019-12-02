<?php


class Student
{

    //declare variables

    public $name ;
    public $email;
    public $mobile;

    private $conn;
    private $table_name;


    public function __construct($db)
    {
        $this->conn = $db;
        $this->table_name = "tbl_students";

    }

    public function create_data(){

        //sql query to insert data

        $query = "INSERT INTO ".$this->table_name." 
        SET name= ?,email =?,mobile=?";

        //prepare the sql
        $obj = $this->conn->prepare($query);

        //sanitize input variable =>basically removes extra character like special symbols

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));

        //prepare our values

        $obj->bind_param("sss",$this->name,$this->email,$this->mobile);

        //execute

        if ($obj->execute()){

            return true;

        }

        return false;


    }


}