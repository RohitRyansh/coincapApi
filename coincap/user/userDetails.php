<?php
session_start();
include '../validation/validation.php';
include '../data/database.php';
global $error;
$error=array();
class user extends validation
{
    private $conn;
    public $data;
    function __construct($data=null)
    {  
        $this->conn=new db();
        $this->conn = $this->conn->dbConn;
        $this->data=$data;
    }
    function signUp()
    {
        if(!empty($this->data['submit']))
        {
            global $error;
            $email=$this->data['EMAIL'];
            $check=$this->conn->query("SELECT EMAIL FROM USER WHERE EMAIL ='$email'");
            $check=$check->fetchAll(PDO::FETCH_ASSOC);
            $error=$this->Validate($this->data,$check);
            if(empty($error))
            {
                $name=$this->data['NAME'];
                $pass=$this->data['PASSWORD'];
                $check=$this->conn->exec("INSERT INTO USER (NAME,EMAIL,PASSWORD) VALUES ('$name','$email','$pass')");
                echo "<h3 class=\"message\">Account Created Successfully!</h3>";
            }
        }
    }
    function login()
    {
        if(!empty($this->data['submit']))
        {   
            global $error;
            $error=$this->Validate($this->data,null);  
            $email=$this->data['EMAIL'];
            $password=$this->data['PASSWORD'];
            if(empty($error))
            {
                $check=$this->conn->query("SELECT * FROM USER WHERE EMAIL ='$email' AND PASSWORD = '$password'");
                $check=$check->fetchAll(PDO::FETCH_ASSOC);
                if($check)
                {
                    $_SESSION['userLogged']=true;
                    $_SESSION['userId']=$check[0]['USERID'];
                    header('location:../dataView.php?search='.$_SESSION['coinId']);
                }
                else
                {
                    echo "<h3 class=\"message1\">Wrong ID and Password!</h3>";
                }         
            }
        }
    }
    function wallet($money)
    {
        $uid=$_SESSION['userId'];
        $sql1=$this->conn->query("SELECT * FROM WALLET WHERE user_id='$uid'");
        $sql1=$sql1->fetchAll(PDO::FETCH_ASSOC);
        if(! $sql1)
        {
            $check=$this->conn->query("INSERT INTO WALLET (user_id,balance) VALUES('$uid','$money')");
            echo "<h3 class=\"msg\">Money Added Successfully!</h3>";
        }
        else
        {
            $previousBalance=$sql1[0]['balance'];
            $money=$money+$previousBalance;
            $check=$this->conn->exec("UPDATE WALLET SET balance='$money'  WHERE user_id='$uid'");
            echo "<h3 class=\"msg\">Money Added Successfully!</h3>";
        }
    }
    function profile()
    {
        $uid=$_SESSION['userId'];
        $sql1=$this->conn->query("SELECT balance FROM WALLET WHERE user_id='$uid'");
        $sql1=$sql1->fetch(PDO::FETCH_ASSOC);
        $sql2=$this->conn->query("SELECT coin_id,NO_COIN,PRICE FROM COINS WHERE user_id='$uid'");
        $sql2=$sql2->fetchAll(PDO::FETCH_ASSOC);
        $sql2['balance']=$sql1['balance'];
        return $sql2;
    }
}   

?>