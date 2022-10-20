<?php
session_start();
$_SESSION['check']=true;
include 'main.php';
include 'data/api.php';
include 'validation/validation.php';
$obj=new coinApi();
if(is_string($obj->response))
    {
        echo "<h1>".$obj->response."</h1>";
        die;
    }
if(isset($_POST['search']))
{
    header('location:dataView.php?search='.($_POST['search']));
}
    echo" <div class=\"content2\">";
    echo "<table cellspacing=0 > <tr> <th>Rank</th> <th>Name</th> <th>Price</th> <th>Market Cap</th>  <th>VWAP(24Hr)</th> 
    <th>Supply</th> <th>Volume(24Hr)</th> <th>Change(24Hr)</th></tr>";
    foreach($obj->response as $val)
    {
        if(is_array($val))
        {
            foreach($val as $val1)
            {
                echo "<tr>";
                echo "<td>{$val1['rank']}</td>";                
                echo "<td><div class=\"name\"><div><img src='https://assets.coincap.io/assets/icons/".strtolower($val1['symbol'])."@2x.png' alt=not found></div>";
                echo"<div class=\"name1\"><h4><a href=\"dataView.php?search=".$val1['id']."\">{$val1['name']}</a></h4><a href=\"dataView.php?search=".$val1['id']."\"><p>{$val1['symbol']}</p></a></div></div></td>";
                echo "<td>$".numCheck($val1['priceUsd'])."</td>";
                echo "<td>$".numCheck($val1['marketCapUsd'])."</td>";
                echo "<td>$".numCheck($val1['vwap24Hr'])."</td><td>".numCheck($val1['supply'])."</td>";
                echo "<td>$".numCheck($val1['volumeUsd24Hr'])."</td>";
                if($val1['changePercent24Hr']>0)
                {
                    echo"<td class=\"green\">".numCheck($val1['changePercent24Hr'])."%</td>";
                }
                else
                {
                    echo"<td class=\"red\">".numCheck($val1['changePercent24Hr'])."%</td>";
                }
                echo "</tr>";
            }
        }
    }
    echo"</table></div>";
include 'footer.php';
?>