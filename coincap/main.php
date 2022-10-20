<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COINCAP</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/d6a87bb342.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        
        <nav>
            <div class="navbar">
                <div class="left-container">
                <ul>
                    <li>Coin</li>
                    <li>
                        <a href="user/wallet.php">Wallet</a>
                    </li>
                        <a href="user/profile.php">Profile</a>
                    </li>
                </ul>
                </div>
                <div>
                    <ul>
                        <li>
                            <img src="https://coincap.io/static/logos/black.svg" class="ui tiny image" width="100px" height="60px">
                        </li>
                    </ul>       
                </div>
                <form action="" method="post">
                <div class="right-container">
                    <div class="search-box">
                        <input type="search" name="search" id="" placeholder="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                        <a href="index.php" class="button1"><i class="fa-solid fa-house"></i></a>
                        <a href="" class="button1">Refresh</a>
                        <?php
                    if(isset($_SESSION['userLogged']))
                    {
                        ?>
                            <a href="user/logout.php" class="button1">LogOut</a>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </form>
        </nav>
        <section>
        <?php
            if($_SESSION['check']==true)
            {
            ?>
            <div class="content1">
                <ul>
                    <li>MARKET CAP
                        <p>$1.14T</p>
                    </li>
                    <li>EXCHANGE VOL
                        <p>
                            $70.55B
                        </p>
                    </li>
                    <li>ASSETS
                        <p>
                            2,295
                        </p>
                    </li>
                    <li>EXCHANGES
                        <p>
                            73
                        </p>
                    </li>
                    <li>MARKETS
                        <p>
                            13,810
                        </p>
                    </li>
                    <li>BTC DOM INDEX
                        <p>
                            33.5%
                        </p>
                    </li>
                </ul>
            </div>
            <?php
                }
            ?>
        </section>
    </main>
</body> 
</html>