<?php


/**
 * Short description for class
 *
 * *PHP version 7.4
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   API
 * @package    REST_1
 * @author     Another Author <another@example.com>
 * @copyright  2021-2022 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 */ 
class Student
{
    //variable declaration
    public $fname;
    public $lname;
    public $email;
    public $phone;

    private $conn;
    private $tbl_name;

    public function __construct($db)
    {
        $this->conn=$db;
        $this->tbl_name="tbl_std";
    }
    public function create_data()
    {
        if ($this->isEmailUnique($this->email)) {
            $sql = "INSERT INTO " . $this->tbl_name . " SET fname = :fname, lname = :lname, email = :email, mobile = :phone";
            $data = $this->conn->prepare($sql);
    
            // Data sanitization
            $this->fname = htmlspecialchars(strip_tags($this->fname));
            $this->lname = htmlspecialchars(strip_tags($this->lname));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
    
            // Parameter binding
            $data->bindParam(':fname', $this->fname, PDO::PARAM_STR);
            $data->bindParam(':lname', $this->lname, PDO::PARAM_STR);
            $data->bindParam(':email', $this->email, PDO::PARAM_STR);
            $data->bindParam(':phone', $this->phone, PDO::PARAM_STR);
    
            // Try inserting data into the database
            if ($data->execute()) {
                return true;
            }else {
                throw new Exception("Failed to insert data into the database.");
            }
        } else {
            throw new Exception("Email already exists.");
        }
       
    }
     public function get_all_std(){
        $sql="Select * from ".$this->tbl_name;

        $lists=$this->conn->prepare($sql);
        $lists->execute();
        return $lists->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_single_std(){
        $sql="Select * from ".$this->tbl_name." where id= :id";
        $data=$this->conn->prepare($sql);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $data->bindParam(':id',$this->id, PDO::PARAM_INT);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
        
    }
    public function delite_std(){
        $sql="delete from ".$this->tbl_name." where id=:id";
        $delt_obj=$this->conn->prepare($sql);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $delt_obj->bindParam(':id',$this->id, PDO::PARAM_INT);
        if($delt_obj->execute()){
            return true;
        }else{
            return false;
        }


    }
    public function isEmailUnique($email)
    {
        $sql = "SELECT COUNT(*) as count FROM " . $this->tbl_name . " WHERE email = :email";
        $data = $this->conn->prepare($sql);
        $data->bindParam(':email', $email, PDO::PARAM_STR);
        $data->execute();
        $row = $data->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];

        return $count == 0; // Returns true if email is unique, false otherwise
    }
}



