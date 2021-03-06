<?php


class Student
{

    //declare variables

    public $name ;
    public $email;
    public $mobile;
    public $id;

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

    public function get_all_data(){


        $sql = "SELECT * from ".$this->table_name;

        $std_obj = $this->conn->prepare($sql);

        //execute query

        $std_obj->execute();

        return $std_obj->get_result();


    }

    //single student data

    public function get_single_student(){

        $sql_query = "SELECT * from ".$this->table_name." WHERE id = ?";

        //prepare statement
        $obj = $this->conn->prepare($sql_query);

        $obj->bind_param("i",$this->id);//bind parameters with prepare statement

        $obj->execute();

        $data = $obj->get_result();

        return $data->fetch_assoc();


    }
    
    //update student information

    public function update_student()
    {

        //query
        $update_query = "UPDATE ".$this->table_name." set name = ?,email = ?, mobile = ? WHERE id = ?";

        //prepare statement

        $query_object = $this->conn->prepare($update_query);


        //sanitize input variable =>basically removes extra character like special symbols

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $query_object->bind_param("sssi",$this->name,$this->email,$this->mobile,$this->id);
        //execute
        if ($query_object->execute()){


            return true;

        }else{
            return false;
        }
        
    }

    //delete student
    public function delete_student(){

        $delete_query = "DElETE FROM ".$this->table_name." WHERE id = ?";

        //prepare statement

        $delete_obj = $this->conn->prepare($delete_query);
        //sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind parameter
        $delete_obj->bind_param("i",$this->id);

        //executing query

        if ($delete_obj->execute()){

            return true;
        }else{

            return false;
        }

    }


}