<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <style>
    .inp{
        width: 40px;
        height: 40px;
        border-style: none;
        border-radius: 100px;
        background-image: url('icons/icons8-modify-40.png');
    }
    .inp2{
        width: 40px;
        height: 40px;
        border-style: none;
        border-radius: 100px;
        background-image: url('icons/icons8-supprimer-40.png');
    }
</style>
</head>
<body class="bg-light">
    <?php 
       session_start();
        if(!isset($_SESSION['user'])){
            header('location: connexion.php');
        }        
        include_once("nav.php");
        require_once("db.php");
    
        if(isset($_GET['search'])){
            $val = $_GET['value'];

            $sqlst = $pdo -> prepare("SELECT * FROM PRODUIT WHERE TITRE = ?");
            $sqlst -> execute([$val]);
            $res = $sqlst -> fetchAll(PDO:: FETCH_OBJ);
            $countsqlst = $pdo-> prepare('select count(*) as "count" from produit WHERE TITRE = ?');
            $countsqlst -> execute([$val]);
            $count = $countsqlst->fetch(PDO::FETCH_OBJ);
           ?>

     
    <h1 class="display-6 my-5 text-center">Produits <span class="">(<?php echo $count-> count ?>)</span></h1>
    <?php if($count -> count == 0){ ?>
        <h1 class="h1 my-5 text-center">Aucun produit à afficher, réssayer à nouveau</h1>
        <div class="text-center">
            <img src="icons/icons8-jumelles-120.png" alt="">
        </div>
            <?php
            }
         ?>
    <section style="margin: 20px 50px;">
        <div class="row">
            <?php  
            foreach($res as $item){ ?>
            
            <div class="col-4 card mb-5">
                <form class="text-center" method="POST">
                    <span class="float-end mt-3 mb-1"><input class="inp" name="modifier"  type="submit" value="" formaction="modifier.php"/></span>
                    <input type="hidden" name="id" class="mx-auto mt-3" value="<?php echo $item ->id ?>">
                    <span class="float-start mt-3 mb-1"><input class="inp2" type="submit"  value="" formaction="supprimer.php" onclick="return confirm('Voulez-vous vraiment supprimer le produit <?php echo $item -> titre ?>')"/></span>
                </form>
                
                <?php
                    if(!empty($item->image)){ ?> 
                        <img class="card-img-top" src="img/<?php echo $item->image?>" alt="Card image cap">
                <?php 
                    }else{ 
                        ?>
                        <img class="card-img-top w-50 mx-auto" src="img/icons8-déballage-100.png" alt="Card image cap">
                    <?php 
                    } 
                    ?>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold"><?php echo $item -> titre ?></h5>
                    <p class="card-text"><?php echo $item -> description ?></p>
                    <div class='badges'>
                        <?php 
                            $solde = $item -> solde;
                            $percent = $solde / 100;
                            if(empty($solde)){ ?>
                                <span class="badge rounded-pill bg-secondary float-start" ><?php echo $item -> prix, ' DHS' ?></span>
                            <?php
                            }else{ ?>
                                <span class="badge rounded-pill bg-secondary float-start" ><?php echo ($item -> prix) - ($item -> prix * $percent) , ' DHS' ?></span>
                                <span class="badge rounded-pill text-danger text-decoration-line-through float-start" ><?php echo $item -> prix, ' DHS' ?></span>
                                <span class="badge rounded-pill bg-warning float-start" ><?php echo "- ",$solde, ' %' ?></span>
                            <?php
                            }
                        ?>
                      
                        <?php 
                        $enstock = $item -> en_stock;
                            if($enstock == 1){
                        ?>
                        <span class="badge rounded-pill bg-success float-end">En Stock</span>
                        <a href="#" class="btn btn-warning w-100 mt-3">Buy</a>
                            <?php 
                            }else{ ?>

                        <span class="badge rounded-pill bg-danger float-end">Out Of Stock</span>
                        <a href="#" class="btn btn-warning w-100 mt-3 disabled">Buy</a>

                            <?php } ?>
                    </div>
                  
                </div>
            </div>
            <?php } ?>
        </div>
    </section>   
    <?php  }     include_once('footer.php');?>
</body>