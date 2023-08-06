<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <style>
         input[type=range] {
            margin: 20px 0;
            width: 100%;
        }
        input[type=range]:focus {
            outline: none;
        }
        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 4px;
            cursor: pointer;
            animation-duration: 0.2s;
            background: #03a9f4;
            border-radius: 25px;
        }
        input[type=range]::-webkit-slider-thumb {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 0 4px 0 rgba(0,0,0, 1);
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -8px;
        }
        input[type=range]:focus::-webkit-slider-runnable-track {
         background: #03a9f4;
        }
        .range-wrap{
            width: 500px;
            position: relative;
            margin: 0 auto;
        }
        .range-value{
            position: absolute;
            top: -60%;
        }
        .range-value span{
            width: 50px;
            height: 50px;
            padding-top: 12px;
            line-height: 24px;
            text-align: center;
            background: #03a9f4;
            color: #fff;
            font-size: 15px;
            display: block;
            position: absolute;
            left: 50%;
            transform: translate(-50%, 0);
            border-radius: 25px;
        }
        .range-value span:before{
            content: "";
            position: absolute;
            width: 0;
            height: 0;
            border-top: 10px solid #03a9f4;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            margin-top: -1px;
        }
    </style>
</head>
<body class="bg-light">
<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header('location: connexion.php');
    }      
    if(!isset($_POST['id'])){
        header('location: Acceuil.php');
    }
    require_once('db.php');

    $id = $_POST['id'];
    $sqlst = $pdo -> prepare("SELECT * FROM PRODUIT WHERE id = ?");
    $sqlst -> execute([$id]);
    $res = $sqlst->fetch(PDO::FETCH_OBJ);

    ?>
    <form method="POST" class="container m-auto" enctype="multipart/form-data">
    
        <h1 class="display-6 my-4 text-center">Modifier un produit </h1>
        <?php
    if(isset($_POST['modifier2'])){
        $id = $_POST['id'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $enstock = @$_POST['enstock'];
        $solde = $_POST['range'];
        $imgfile = $_FILES['img'];
        $imgfilename = time().basename($imgfile['name']);
        if(!empty($imgfilename)){
            move_uploaded_file($imgfile['tmp_name'], 'img/'.$imgfilename); 
        }
      
        if(!empty($titre) || !empty($description) || !empty($prix) || !empty($enstock) || !empty($solde)){
            echo $id, $titre, $description, $prix;
            $sqlst2 = $pdo->prepare("UPDATE PRODUIT SET titre = ?,description = ?, prix = ?, en_stock = ?, image = ?, solde = ? WHERE id = ? ");
            $res2 = $sqlst2->execute([$titre,$description,$prix, $enstock,$imgfilename,$solde,$id]);
    
            if($res2 == true){
                header('location: Acceuil.php');
            }
        
            
    }else{  ?>
            <div class="alert alert-danger" role="alert">
                les champs: Titre, Description, Prix sont obligatoires!
            </div>
            <?php
            
        }
    } ?> 
        <input type="hidden" name="id" value="<?php echo $res -> id ?>">
        <div class=" form-group mb-3">
            <label class="form-label">Titre :</label>
            <input type="text" name="titre" class="form-control" aria-describedby="emailHelp" placeholder="Titre de produit " value="<?php echo $res -> titre ?>">
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Description :</label>
            <textarea name="description" class="form-control" placeholder="Description de produit"><?php echo $res -> description ?></textarea>
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Prix :</label>
            <input type="number" name="prix" class="form-control" placeholder="Prix de produit" value="<?php echo $res -> prix ?>">
        </div><br><br>
        <label class="form-label">Solde :</label>
        <div class="range-wrap">
            <div class="range-value" id="rangeV"></div>
            <input id="range" name="range" type="range" min="0" max="100" value="<?php echo $res -> solde ?>" step="1">
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Image de produit: </label><br>
            <input type="file" name="img" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" name="enstock" type="checkbox">
            <label class="form-check-label" type="checkbox">En Stock</label>
        </div>
        <button type="submit" name="modifier2" class="w-100 btn btn-warning">Modifier</button><br><br><br>
    </form>
    <script>
        range = document.getElementById('range'),
        rangeV = document.getElementById('rangeV'),
        setValue = ()=>{
            const newValue = Number( (range.value - range.min) * 100 / (range.max - range.min) ),
            newPosition = 10 - (newValue * 0.2);
            rangeV.innerHTML = `<span>${range.value+" %"}</span>`;
            rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
        };
        document.addEventListener("DOMContentLoaded", setValue);
        range.addEventListener('input', setValue);
    </script>
        <?php  include_once('footer.php'); ?>
</body>
</html>