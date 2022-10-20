<?php
include './validation/validation.php';
include './data/database.php';
include 'data/api.php';
class coinInsert extends validation
{
    public $data;
    private $conn;
    function __construct($data=null)
    {  
        $this->conn=new db();
        $this->conn = $this->conn->dbConn;
        $this->data=$data;
    }
    function buyCoins()
    { 
        global $error;
        $error=$this->checkCoin($this->data,'buy');
        if(empty($error))
        {
            if(isset($_SESSION['userLogged']))
            {
                $uid=$_SESSION['userId'];
                $coinid=$_SESSION['coinId'];
                $sql1=$this->conn->query("SELECT user_id,NO_COIN FROM COINS WHERE user_id='$uid' AND coin_id='$coinid'");
                $sql1=$sql1->fetchAll(PDO::FETCH_ASSOC);
                $sql2=$this->conn->query("SELECT * FROM WALLET WHERE user_id='$uid'");
                $sql2=$sql2->fetchAll(PDO::FETCH_ASSOC);
                $obj=new coinApi($_SESSION['coinId']);
                $price=$obj->response['data']['priceUsd'];
                $no_coins=$this->data;
                $price=$price*$no_coins;
                $totalBalance=$sql2[0]['balance']-$price;
                if($sql2)
                {
                    if(!$sql1)
                    {
                        if($totalBalance<0)
                        {   
                            echo $error['buy']="<span class=\"errorMessage1\">insufficent balance</span>";
                        }
                        else
                        {
                            $check=$this->conn->query("INSERT INTO COINS (user_id,coin_id,NO_COIN,PRICE) VALUES('$uid','$coinid','$no_coins','$price')");
                            $check=$this->conn->exec("UPDATE WALLET SET balance='$totalBalance' WHERE user_id='$uid'"); 
                            echo $error['buy']="<span class=\"errorMessage1\">successfully buy ".$this->data." coins</span>";
                        }
                    }
                    else
                    {
                        if($totalBalance<0)
                        {   
                            echo $error['buy']="<span class=\"errorMessage1\">insufficent balance</span>";
                        }
                        else
                        {
                            $previousCoins=$sql1[0]['NO_COIN'];
                            $no_coins=$this->data+$previousCoins;
                            $price=$price*$no_coins;
                            $check=$this->conn->exec("UPDATE COINS SET NO_COIN='$no_coins',PRICE='$price' WHERE user_id='$uid' AND coin_id='$coinid'"); 
                            $check=$this->conn->exec("UPDATE WALLET SET balance='$totalBalance' WHERE user_id='$uid'"); 
                            echo $error['buy']="<span class=\"errorMessage1\">successfully buy ".$this->data." coins</span>";
                        }
                    }
                } 
                else
                {
                    echo $error['buy']="<span class=\"errorMessage1\">insufficent balance</span>";
                } 
            }
            else
            {
                $error['buy']="<a href=\"./user/login.php\"><span class=\"errorMessage\">please  login !</span></a>";
            }
        }
    }
    function sellCoins()
    {
        global $error;
        $error=$this->checkCoin($this->data,'sell');
        if(empty($error))
        {
            if(isset($_SESSION['userLogged']))
            {
                $uid=$_SESSION['userId'];
                $coinid=$_SESSION['coinId'];
                $sql1=$this->conn->query("SELECT user_id,NO_COIN,PRICE FROM COINS WHERE user_id='$uid' AND coin_id='$coinid'");
                $sql1=$sql1->fetchAll(PDO::FETCH_ASSOC);
                $sql2=$this->conn->query("SELECT * FROM WALLET WHERE user_id='$uid'");
                $sql2=$sql2->fetchAll(PDO::FETCH_ASSOC);
                $obj=new coinApi($_SESSION['coinId']);
                $price=$obj->response['data']['priceUsd'];
                if($sql2)
                {
                    if(! $sql1)
                    {
                        echo $error['sell']="<span class=\"errorMessage\">please buy a coins !</span>";
                    }
                    else
                    {
                        $price=$price*$this->data;
                        $previousCoins=$sql1[0]['NO_COIN'];
                        $no_coins=$previousCoins-$this->data;
                        if($no_coins<0)
                        {
                            echo $error['sell']="<span class=\"errorMessage\">insufficent coins</span>";
                        }
                        else
                        {
                            $check=$this->conn->exec("UPDATE COINS SET NO_COIN='$no_coins',PRICE='$price' WHERE user_id='$uid' AND coin_id='$coinid'");      
                            $totalBalance=$sql2[0]['balance']+$price;
                            $check=$this->conn->exec("UPDATE WALLET SET balance='$totalBalance' WHERE user_id='$uid'"); 
                            echo $error['sell']="<span class=\"errorMessage1\">successfully sell ".$this->data." coins</span>";
                        }
                    }
                } 
                else
                {
                    echo $error['sell']="<span class=\"errorMessage1\">insufficent coins</span>";
                }  
            }
            else
            {
                $error['sell']="<a href=\"./user/login.php\"><span class=\"errorMessage\">please  login !</span></a>";
            }
        }
    }
}
?>