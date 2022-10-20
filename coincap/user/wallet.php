<?php
include 'userDetails.php';
if(isset($_SESSION['userLogged']))
{
    if(isset($_POST['submit']))
    {
    $obj= new user();
    $obj->wallet($_POST['addMoney']);
    }         
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Money</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <main>
        <article>
            <section>
                <div class="wallet">
                    <form action="wallet.php" method="post" class="wallet1">
                        <h2>
                            ADD MONEY
                        </h2>      
                        <section >
                            <input type="number" name="addMoney" id="name" placeholder="add money" min="1">
                        </section>
                        <input type="submit" value="Add" name="submit" class="submit">
                        <a href="../index.php" class="button1">back</a>
                    </form> 
                </div>
            </section>
        </article>
    </main>
</body>
</html>
<?php
}
else
{
    header('location:login.php');
}
?>