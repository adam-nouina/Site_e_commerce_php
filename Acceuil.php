<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
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
<body class="bg-light">
        <?php 
        session_start();
        include_once('nav.php');
        if(!isset($_SESSION['user'])){
            header('location: connexion.php');
        }        ?>
        <?php
        include_once('db.php');
        $sqlst = $pdo->prepare('select * from produit order by titre');
        $sqlst->execute();
        $produit = $sqlst->fetchAll(PDO::FETCH_OBJ);
        $countsqlst = $pdo->query('select count(*) as "count" from produit');
        $count = $countsqlst->fetch(PDO::FETCH_OBJ);


    ?>  
    <h1 class="display-6 my-5 text-center">Produits <span class="">(<?php echo $count-> count ?>)</span></h1>
    <section style="margin: 20px;">
        <div class="row d-flex justify-content-center">
            <?php  
            foreach($produit as $pro){ ?>
            
            <div class="col-3 card mx-4 mb-5 ">
                <form class="text-center" method="POST">
                    <span class="float-end mt-3 mb-1"><input class="inp" name="modifier"  type="submit" value="" formaction="modifier.php"/></span>
                    <input type="hidden" name="id" class="mx-auto mt-3" value="<?php echo $pro ->id ?>">
                    <span class="float-start mt-3 mb-1"><input class="inp2" type="submit"  value="" formaction="supprimer.php" onclick="return confirm('Voulez-vous vraiment supprimer le produit <?php echo $pro -> titre ?>')"/></span>
                </form>
                
                <?php
                    if(!empty($pro->image)){ ?> 
                        <img class="card-img-top" src="img/<?php echo $pro->image?>" alt="Card image cap">
                <?php 
                    }else{ 
                        ?>
                        <img class="card-img-top w-50 mx-auto" src="img/icons8-déballage-100.png" alt="Card image cap">
                    <?php 
                    } 
                    ?>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold"><?php echo $pro -> titre ?></h5>
                    <p class="card-text"><?php echo $pro -> description ?></p>
                    <div class='badges'>
                        <?php 
                            $solde = $pro -> solde;
                            $percent = $solde / 100;
                            if(empty($solde)){ ?>
                                  <div class="text-center">
                                     <span class="badge rounded-pill bg-secondary " ><?php echo $pro -> prix, ' DHS' ?></span>
                                  </div>
                            <?php
                            }else{ ?>
                                  <div class="text-center">
                                    <span class="badge rounded-pill bg-secondary " ><?php echo ($pro -> prix) - ($pro -> prix * $percent) , ' DHS' ?></span>
                                    <span class="badge rounded-pill text-danger text-decoration-line-through " ><?php echo $pro -> prix, ' DHS' ?></span>
                                    <span class="badge rounded-pill bg-warning"><?php echo "- ",$solde, ' %' ?></span>
                                  </div><br>
                            <?php
                            }
                        ?>
                      
                        <?php 
                        $enstock = $pro -> en_stock;
                            if($enstock == 1){
                        ?>
                        <div class="text-center">
                        <span class="badge rounded-pill bg-success">En Stock</span>
                        </div>
                      
                        <a href="#" class="btn btn-warning w-100 mt-3">Buy</a>
                            <?php 
                            }else{ ?>
                        <div class="text-center">
                             <span class="badge rounded-pill bg-danger">Out Of Stock</span>
                        </div>
                        <a href="#" class="btn btn-warning w-100 mt-3 disabled">Buy</a>

                            <?php } ?>
                    </div>
                  
                </div>
            </div>
            <?php }
        ?>
        </div>
    </section>



    <?php 
        include_once('footer.php');
    ?>
</body>
</html>