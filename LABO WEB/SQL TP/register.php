<?php
    $dsn = "mysql:host=localhost:3306;dbname=todo";
    $username = "root";
    $password = "";

    try{
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e){
        echo $e->getMessage();
        die();
    }
?>


<!DOCTYPE html>

<html lang="en" >
    <head>
        <title>Register</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="./stylesheet.css"/>
        
            
    <script>
            function displayCheck() {
                let checkBox = document.getElementById("adminCheck");
                let really = document.getElementById("adminReallyCheck");
                let text = document.getElementById("adminReallyText");
                console.log(text);
                if (checkBox.checked == true){
                    really.style.display = "";
                    text.style.display = "";
                } else {
                    really.style.display = "none";
                    text.style.display = "none";
                }
            }
            function displayTextCheck() {
                let checkBox = document.getElementById("adminReallyCheck");
                let text = document.getElementById("adminOkeyCheck");

                if (checkBox.checked == true){
                    text.style.display = "";
                } else {
                    text.style.display = "none";
                }
            }
        </script>
    </head>
    <body>
        <H1>toDo - Register</H1>

        <form method="post">
            
            <div>
                <label>Please enter your name:</label>
                <input type="text" id="name" name="name">
            </div>
            <br>
            <div>
                <label>Please enter your password:</label>
                <input type="password" id="pw" name="pw">
            </div>
            <div>
                <label>Confirm password:</label>
                <input type="password" id="pwCheck" name="pwCheck">
            </div>
            <br>
            <div> 
                <label>Are you an admin </label>
                <input type="checkbox" id="adminCheck" onclick="displayCheck()"/>
                <div>
                    <label id=adminReallyText style="display:none">Really?</label>
                    <input type="checkbox" name="admin" id="adminReallyCheck" style="display:none" onclick="displayTextCheck()"/>    
                </div>

                <label id="adminOkeyCheck" style="display:none">Okey I trust you XD</label>
            </div>
            <br>
            <div>
                <input type="submit" value="Send">
            </div>
            <?php
            $error=false;
                if ($_POST['name']=='') {
                    ?>
                    <label>Required User Name please</label>
                <?php
                }else if (isset($_POST['name']) && isset($_POST['pw'])){
                    session_start();
                    if ($_POST['pw']==$_POST['pwCheck']){
                        $name = $_POST['name'];
                        $pw = $_POST['pw'];
                        $admin= $_POST['admin'] ?? 0;
                    
                    
                    ?> 
                    <br>
                    
                    <?php 

                    try{
                        $queryString = "INSERT INTO user (userName, passWord, admin) VALUES (:userName, :passWord, :admin)";
                        
                        $data = [
                            'userName' => $name,
                            'passWord' => password_hash($pw,PASSWORD_BCRYPT),
                            'admin' => (bool) $admin
                        ];

                        $query = $pdo->prepare($queryString);
                        $query->execute($data);

                    
                        $queryString = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
                        $query = $pdo->prepare($queryString);
                        $query->execute();
                        $user=$query->fetchALl();

                        var_dump(count($user));
                        foreach($user as $u){
                            $_SESSION['name'] = $u['userName'];
                            $_SESSION['id'] = $u['id'];
                            $_SESSION['admin']=$u['admin'];
                            var_dump($_SESSION['name']);
                        }
                        header("Location:./index.php");
                    }catch (PDOException $e){
                        $error=true;
                        ?>
                        <label>This User already exist</label>
                        <?php
                    }
                }else{
                    ?>
                    <label>Both password are not the same</label>
                <?php
                }
            }?>
                
                    



        </form>

        
    </body>
</html>
    
