<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <style>
        body {
            background-image: url("img/store2.jpg");
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
            backdrop-filter: blur(3px);
        }

        fieldset.scheduler-border {
            border: 1px solid gray;
            width: 500px;
            padding: 50px 50px 30px 50px;
            border-radius: 20px;
        }

        .form-control {
            height: 45px;
        }

        .form-control:hover {
            box-shadow: 3px 1px yellow;
        }

        .form-control,
        .btn {
            border-radius: 20px;
        }

        .form-control:hover {
            border: 1px solid gold;
            box-shadow: -2px -2px 3px gold,
                2px 2px 3px gold;
        }

        .form-control:focus {
            border: 1px solid gold;
            box-shadow: -2px -2px 3px gold,
                2px 2px 3px gold;
        }
    </style>
</head>

<body>


    <form method="POST" class="container">
        <h1 class="h1 display-4  text-center my-5">Sign Up</h1>
        <fieldset class="scheduler-border mx-auto">
            <?php
            if (isset($_POST['inscription'])) {
                $nom = $_POST['nom'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (!empty($nom) && !empty($email) && !empty($password)) {
                    require_once('db.php');
                    $sqlst = $pdo->prepare("INSERT INTO usercompte values(null,?,?,?)");
                    $res = $sqlst->execute([$nom, $email, $password]);
                    if ($res == true) {
                        header("location: Acceuil.php");
                    }
                } else {
            ?>
                    <div class="alert alert-danger" role="alert">
                        All fields are mandatory
                    </div>
            <?php
                }
            }
            ?>
            <div class="form-group mb-4">

                <input type="text" name="nom" class="form-control w-100" placeholder="  Enter your name">
            </div>
            <div class="form-group mb-4">

                <input type="email" name="email" class="form-control w-100" placeholder="  Email@gmail.com">
            </div>
            <div class="form-group mb-4">

                <input type="password" class="form-control w-100" name="password" placeholder="  Enter your password">
            </div>
            <button type="submit" name="inscription" class="w-100 btn btn-warning mb-2">Inscription</button>
            <span class="text-center d-block">Vous avez dèja un compte!<input type="submit" formaction="connexion.php" class="bg-transparent text-primary border-0" value="Se connecter" /></span>
        </fieldset>

    </form>
</body>

</html>