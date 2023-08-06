<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<style>
    body{
        background-image: url("img/store2.jpg");
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        background-repeat: no-repeat;
        background-size: cover;
        min-height: 100vh;
        backdrop-filter: blur(2px);
       
    } 
    fieldset.scheduler-border {
        border: 1px solid gray;
        width: 500px;
        padding: 50px 50px 30px 50px;
        border-radius: 20px;
    }
    .form-control{
        height: 45px;
        
    }
    .form-control:hover{
        border: 1px solid gold;
        box-shadow: -2px -2px 3px gold,
        2px 2px 3px gold;
    }
    .form-control:focus{
        border: 1px solid gold;
        box-shadow: -2px -2px 3px gold,
        2px 2px 3px gold;
}
    .form-control, .btn{
        border-radius: 20px;
    }
</style>
<body>
<?php 
    session_start();
?>
    <form method="post" class="container ">
        <h1 class="h1 display-3  text-center mt-5" >Welcome</h1>
    <fieldset class="scheduler-border mt-5 mx-auto">
    <?php 

    if (isset($_POST['connexion'])){
        require_once("db.php");
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password)){
            $sqlst = $pdo -> prepare("SELECT * FROM usercompte WHERE email = ? AND password = ?");
            $res = $sqlst -> execute([$email,$password]);

            $count = $sqlst -> rowCount();
            if($count >= 1){
                $data = $sqlst -> fetch(PDO::FETCH_ASSOC);
                $_SESSION['user'] = $data;  
                header('location: Acceuil.php');
            }else{
                ?>
                <div class="alert alert-danger" role="alert">   
                    Incorrect email or password!
                </div>
                <?php
            }
        }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    All fields are mandatory!
                </div>
                <?php
        }
    }
    ?>
        <div class="form-group mb-4">

            <input type="email" name="email" class="form-control w-100" placeholder="  Email@gmail.com">
        </div>
        <div class="form-group mb-4">
            <input type="password" class="form-control w-100" name="password" placeholder="  Enter your password">
        </div>
        <button type="submit" name="connexion" class="w-100 btn btn-warning mb-2">Connexion</button>
        <span class="text-center d-block">Vous n'avez pas un compte!    <input type="submit" formaction="inscription.php" class="bg-transparent text-primary border-0" value="S'inscrire" /></span>

    </fieldset>
        
    </form>
</body>
</html>