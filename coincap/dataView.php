<?php
session_start();
$_SESSION['check']=false;
include 'main.php';
include 'coins/coinInsert.php';
$_SESSION['coinId']=$_GET['search'];

if(isset($_POST['search']))
{
    header('location:dataView.php?search='.($_POST['search']));
}
if(isset($_POST['buy']))
{
    $obj1=new coinInsert($_POST['coin1']);
    $obj1->buyCoins();
}
if(isset($_POST['sell']))
{
    $obj1=new coinInsert($_POST['coin2']);
    $obj1->sellCoins();
}
$obj1=new coinApi($_SESSION['coinId']);
if(is_string($obj1->response))
{
    echo "<h1>".$obj1->response."</h1>";
    die;
}
if(!empty($_SESSION['coinId']))
{
    if(isset($obj1->response['data']))
    {
        echo" <div class=\"content1\">";
        echo "<ul class=\"view1\"><div class=\"nameSymbol\"><div class=\"nameSymbol1\"></div><div class=\"nameSymbol2\">";
        echo "<li><h1 class=\"rank\">".$obj1->response['data']['rank']."<h1></li>";
        echo "<li><p>RANK</p></li></div></div>";
        echo "<li><h1>".$obj1->response['data']['name']."(".$obj1->response['data']['symbol'].")</h1>";
        echo "<ul><li><h2>$".number_format($obj1->response['data']['priceUsd'],2)." </h2></li>";
        if($obj1->response['data']['changePercent24Hr']>0)
        {
            echo"<li class=\"green\"> ".numCheck($obj1->response['data']['changePercent24Hr'])."%<i class=\"fa-solid fa-caret-up\"></i></li>";
        }
        else
        {
            echo"<li class=\"red\">".numCheck($obj1->response['data']['changePercent24Hr'])."%<i class=\"fa-solid fa-caret-up\"></i></li>";
        }
        echo "</ul></li>";
        echo "<li>Market Cap<ul><li><h3>$".numCheck($obj1->response['data']['marketCapUsd'])."</h3></li></ul></li>";
        echo "<li>Volume(24hr)<ul><li><h3>$".numCheck($obj1->response['data']['volumeUsd24Hr'])."</h3></li></ul></li>";
        echo "<li>Supply<ul class=\"view3\"><li><h3>".numCheck($obj1->response['data']['supply'])."</h3></li><li><h3> ".$obj1->response['data']['symbol']."</h3></li></ul></li>";
        echo "</div>";
        echo "<div class=\"content3\">";
        echo "<div class=\"logo\">";
        echo "<img src='https://assets.coincap.io/assets/icons/".strtolower($obj1->response['data']['symbol'])."@2x.png' alt=not found>";
        echo "</div>";
        echo "<div class=\"logo2\">";
        echo "<h3>".$obj1->response['data']['name']."(".$obj1->response['data']['symbol'].")</h3>";
        echo "<div>";
        echo "DATE";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"prices\">";
        echo "<ul>";
        echo "<li>HIGH<span>$19,685.33</span></li>";
        echo "<li>AVERAGE<span>$19,685.33</span></li>";
        echo "<li>LOW<span>$19,685.33</span></li>";
        echo "<li>CHANGE";
        if($obj1->response['data']['changePercent24Hr']>0)
        {
            echo"<span class=\"green\"> ".numCheck($obj1->response['data']['changePercent24Hr'])."%<i class=\"fa-solid fa-caret-up\"></i></span></li>";
        }
        else
        {
            echo"<span class=\"red\">".numCheck($obj1->response['data']['changePercent24Hr'])."%<i class=\"fa-solid fa-caret-up\"></i></span></li>";
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        ?>
        <div class="mainContainer">
            <div class="img">
                <?php
                    if($obj1->response['data']['changePercent24Hr']>0)
                    {
                ?>
                <img src="images/bar.png" alt=" not found" width="750px" height="500px">
                <?php
                    }
                    else
                    {
                ?>
                <img src="images/redBar.png" alt=" not found" width="750px" height="500px">
                <?php
                    }
                ?>
            </div>
            <div class="sellBuyContainer">
            <div>
                <h2>
                    BUY/SELL
                </h2>
            </div>
            <form action="" method="post">
                <ul>
                    <li><label for="buy">BUY</label></li>
                    <li><input type="number" name="coin1" id="" min="1"></li>
                    <?php
                    if(!empty($error['buy']))
                    {
                        print_r($error['buy']);
                    }
                    ?>
                    <li><input type="submit" value="BUY" name="buy"></li> 
                    <li><label for="sell">SELL</label></li>
                    <li><input type="number" name="coin2" id="" min="1"></li>
                    <?php
                    if(!empty($error['sell']))
                    {
                        print_r($error['sell']);
                    }
                    ?>
                    <li><input type="submit" value="SELL" name="sell"></li> 
                </ul>
            </form>
        </div>
    </div>
    <?php
    }
}
else
{
    header('location:index.php');
}
include 'footer.php';
?>