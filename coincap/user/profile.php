<link rel="stylesheet" href="../css/style2.css">
<?php
include 'userDetails.php';
if(isset($_SESSION['userLogged']))
{
    $obj= new user();
    $data=$obj->profile();
    if(isset($data['balance']))
    {
        echo "<h1>Balance = $".number_format($data['balance'],2)."</h1>";
    }
    if(empty($data[0]))
    {
        echo "<h1>No Record Found</h1>";
        die;
    }
    echo "<table cellspacing=0 class='profileTable'>";
    echo "<tr> <th>Coin</th> <th>Number of Coins</th> <th>Price</th> </tr>";
    foreach($data as $key=>$value)
    {
        if($key=='balance')
        {
            break;
        }
        echo "<tr>";    
        echo "<td>".$value['coin_id']."</td>";
        echo "<td>".$value['NO_COIN']."</td>";
        echo "<td> $".number_format($value['PRICE'],2)."</td>";
    }
    echo "<a href=\"../index.php\" id=\"button2\">back</a>";
}
else
{
    header('location:login.php');
} 
?>