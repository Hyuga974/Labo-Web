<?php
    session_start();
?>
<!DOCTYPE html>

<html lang="en" >
    <head>
        <title>Connection</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
    </head>
    <body>
        <H1>
            <?php echo nl2br("Hello World \n");?>
        </H1>
        
        <h2>
            <?php
                date_default_timezone_set('Europe/Paris');
                echo date('l jS \of F Y h:i:s A').PHP_EOL;
                $hours=(new DateTime())->format('H');
                if ($hours >=7 && $hours<=19){
            ?>
            <link rel="stylesheet" type="text/css" href="./light.css"/>
            <?php 
                } else {
            ?>
            <link rel="stylesheet" type="text/css" href="./dark.css"/>
            <?php } ?>
        </h2>

        <form  method="post">
            
            <div>
                <label>Please enter your name:</label>
                <input type="text" id="name" name="name">
            </div>
            <br>
            <div>
                <label>Please enter your password:</label>
                <input type="password" id="mdp" name="mdp">
            </div>
            <div>
                <input type="submit" value="Send">
            </div>
            <?php
                $name="admin";
                $password="coucou";
                if (isset($_POST['name']) && isset($_POST['mdp'])){
                    if ($_POST['name']==$name && $_POST['mdp']==$password){
                        echo 'Bonjour Mister How are you?';

                        $_SESSION['name']=$_POST['name'];
                        $_SESSION['mdp']=$_POST['mdp'];

                        header('location: /');
                    }else{
                        echo "T ki à l'heure qui l'est";
                    }
                    
                }
            ?>
        </form>


    </body>
</html>
    