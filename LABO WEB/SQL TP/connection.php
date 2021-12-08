<?php
    session_start();

    $dsn = "mysql:host=localhost:3306;dbname=todo";
    $username = "root";
    $password = "";

    try{
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e){
        echo "ERROR";
        echo $e->getMessage();
        die();
    }
?>
<!DOCTYPE html>

<html lang="en" >
    <head>
        <title>Connection</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="./stylesheet.css"/>
        
    </head>
    <body>
        <H1>toDo - Connection</H1>

        <form  method="post">
            
            <div>
                <label>Please enter your name:</label>
                <input type="text" id="name" name="name">
            </div>
            <br>
            <div>
                <label>Please enter your password:</label>
                <input type="password" id="pw" name="pw">
            </div>
            <br>
            <div>
                <input type="submit" value="Send">        
                <input type="button" onclick="document.location='./register.php'" value="Don't have account"/>

            </div>
        </form>

        <?php

                    if (isset($_POST['name']) && isset($_POST['pw'])){
                    // select 
                        $query = "SELECT * FROM user";

                        $results = $pdo->prepare($query);
                        $results->execute();
                
                        $users=$results->fetchAll(mode:PDO::FETCH_ASSOC);
                        
                        foreach ($users as $user){
                            if ($user['userName'] == $_POST['name']){  
                                if ($user['passWord'] == md5($_POST['pw'])){
                                    $_SESSION['name']=$user['userName'];
                                    $_SESSION['admin']=$user['admin'];
                                    $_SESSION['id']=$user['id'];
                                    
                                    header("Location:./");
                                }else{
                                    echo "Wrong password. Please try again";
                                }
                            }

                        }
                    } 
            ?>

    </body>
</html>
    