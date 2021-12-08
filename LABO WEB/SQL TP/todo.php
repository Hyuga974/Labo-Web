<?php session_start();
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

$query = 'SELECT * FROM todolist WHERE id_user='.$_SESSION['id'];
$results = $pdo->prepare($query);
$results->execute();

$todoList=$results->fetchAll();

function changeToDo(int $id){
    global $todoList, $pdo;
    foreach($todoList as $todo){
        $check=($_POST["todo_".$todo['id']]==''?0:1);
        if ($check != $todo['done']){
            echo "HERE";
            $queryString = "UPDATE todolist SET done=".!$todo['done']." WHERE id=".$todo['id'];
            $query = $pdo->prepare($queryString);
            $query->execute();
        }
        
    }
    header("Location:./index.php");
}
?>

<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./stylesheet.css">
    <title>ToDoo - Home</title>
</head>

<body>
    <div>
        
    <form method="post" action="">
        
        <?php
            if ($_SESSION['id'] != ''){?>
                

                <h2>You are Connected ! HEllo <strong><?= $_SESSION['name'] ?></strong> !</h2>
                <input type="button" onclick="document.location='./logout.php'" value="Logout"/>  
                <H1>Your toDo List:</H1>

                
                <div>
                    <input type="text"  minlength="10" maxlength="255" size="100" id="newToDo" name="newToDo" placeholder="New toDo ...">                    
                    <button type=submit name="add">add</button>
                </div>
                <?php
                if (count($todoList)>0){
                    foreach($todoList as $toDo){
                        echo $todo['done'];
                        ?>
                            <div>
                                <label for="">
                                    <?=$toDo['content']?>
                                    <input type="checkbox" value="check" name="todo_<?=$todo['id']?>" <?php echo ($todo['done']==1 ? 'checked' : '');?>>
                                    
                                </label>
                            </div>
                        <?php
                    }
                    ?>
                    <div>
                        <input type="submit" value="saveChange" name="saveChange">
                    </div>
                    <?php
                }

                if ($_POST['newToDo']!=''){
                        
                        $content = $_POST['newToDo'];
                    ?>
                    <br>
                    
                    <?php 

                    $queryString = "INSERT INTO todolist (content, id_user) VALUES (:content, :id_user)";
                    
                    $data = [
                        'content' => $content,
                        'id_user' => $_SESSION['id'],
                    ];

                    $query = $pdo->prepare($queryString);
                    $query->execute($data);
                }else if (isset($_POST['saveChange'])){
                    foreach($todoList as $todo){
                        $check=($_POST["todo_".$todo['id']]==''?0:1);
                        echo "CHECK: $check". "-".$todo['done'];
                        if ($check != $todo['done']){
                            echo "HERE";
                            $queryString = "UPDATE todolist SET done=".!$todo['done']." WHERE id=".$todo['id'];
                            $query = $pdo->prepare($queryString);
                            $query->execute();
                        }
                    
                    }
                }
            }else{
            echo "HERRRRRRe!";
            ?>
                <div>  
                <input type="button" onclick="document.location='./register.php'" value="Register"/>  
                <input type="button" onclick="document.location='./connection.php'" value="Login"/>
                </div>
            <?php }
        ?>
    </div>
    
</body>
</html>