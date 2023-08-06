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
    fieldset.scheduler-border {
        border: 1px solid gray;
        width: 500px;
        padding: 50px 50px 30px 50px;
        border-radius: 20px;
        margin-bottom: 70px;
    }

    #input2,
    #input1 {
        height: 45px;
        border-radius: 20px;

    }

    #input1:hover {
        border: 1px solid gold;
        box-shadow: -2px -2px 3px gold,
            2px 2px 3px gold;
    }

    #input1:focus {
        border: 1px solid gold;
        box-shadow: -2px -2px 3px gold,
            2px 2px 3px gold;
    }

    #input2:focus {
        border: 1px solid gold;
        box-shadow: -2px -2px 3px gold,
            2px 2px 3px gold;
    }

    #input {
        border-radius: 20px;
    }
</style>

<body class='bg-light'>

    <?php
    session_start();
    include_once('nav.php');

    if (!isset($_SESSION['user'])) {
        header('location: connexion.php');
    }        ?>

    <form method="post" class="container ">
        <h1 class="h1 display-3  text-center mt-5">Contact</h1>
        <fieldset class="scheduler-border mt-5 mx-auto">



            <div class="mb-3">
                <input type="email" id="input2" class="form-control" id="exampleFormControlInput1" placeholder="  Enter your email">
            </div>
            <div class="mb-3">
                <textarea style="height: 100px;" id="input1" class="form-control" id="exampleFormControlTextarea1" rows="30" cols="10" placeholder="  Enter your message"></textarea>
            </div>
            <button type="submit" name="connexion" id="input" class=" w-100 btn btn-warning mb-2">Send</button>

        </fieldset>

    </form>

</body>

</html>
<?php include_once('footer.php') ?>