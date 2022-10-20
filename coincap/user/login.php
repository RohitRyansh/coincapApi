<?php
include 'userDetails.php';
$obj=new user($_POST);
$obj->login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style1.css">
</head>
<body>
    <div class="main">
        <div class="mainDetails">
            <div>
                <img src="../images/LOGIN.jpg" alt="not found" width="350px">
            </div>
            <div class="loginDetails">
                <h1>LOGIN</h1>
                <form action="login.php" method="post">
                    <section>
                        <input type="text" name="EMAIL" placeholder="Email">
                        <?php
                            if(!empty($error['EMAIL']))
                            {
                                echo $error['EMAIL'];
                            }
                        ?>
                    </section>
                    <section>
                        <input type="password" name="PASSWORD" placeholder="Password">
                        <?php
                            if(!empty($error['PASSWORD']))
                            {
                                echo $error['PASSWORD'];
                            }
                        ?>
                    </section>
                    <input type="submit" value="LOGIN" name="submit" class="button">
                    <a href="../index.php" class="button1">back</a>
                </form>
                <a href="signup.php">create your account</a>
            </div>
        </div>
    </div>
</body>
</html>