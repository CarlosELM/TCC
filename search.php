<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Home</title>
    <link rel = "icon" href ="img/logo.png" type = "image/x-icon">
    <style>
    #cont {
        min-height : 515px;
    }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>

    <div class="container my-3">
        <h2 class="py-2">Sua pesquisa por <em>"<?php echo $_GET['search']?>"</em> :</h2>
        <h3><span id="cat" class="py-2"></span></h3>
        <div class="row">
        <?php 
            $noResult = true;
            $query = $_GET["search"];
            $sql = "SELECT * FROM `categories` WHERE MATCH(categorieName, categorieDesc) against('$query')";
 
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                ?><script> document.getElementById("cat").innerHTML = "Categorias: ";</script> <?php 
                $noResult = false;
                $catId = $row['categorieId'];
                $catname = $row['categorieName'];
                $catdesc = $row['categorieDesc'];
                
                echo '<div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/card-'.$catId. '.jpg" class="card-img-top" alt="image for this produto" width="249px" height="270px">
                        <div class="card-body">
                            <h5 class="card-title"><a href="viewprodutoList.php?catid=' . $catId . '" style="color: #EEAD2D">' . $catname . '</a></h5>
                            <p class="card-text">' . substr($catdesc, 0, 29). '...</p>
                            <a href="viewprodutoList.php?catid=' . $catId . '" class="btn btn-warning"><b>Ver Tudo</b></a>
                        </div>
                    </div>
                </div>';
            }
        ?>
        </div>
    </div>

    <div class="container my-3" id="cont">
        <h3><span id="iteam" class="py-2"></span></h3>
        <div class="row">
        <?php 
            $query = $_GET["search"];
            $sql = "SELECT * FROM `produto` WHERE MATCH(produtoName, produtoDesc) against('$query')"; 
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                ?><script> document.getElementById("iteam").innerHTML = "Produtos: ";</script> <?php
                $noResult = false;
                $produtoId = $row['produtoId'];
                $produtoName = $row['produtoName'];
                $produtoPrice = $row['produtoPrice'];
                $produtoDesc = $row['produtoDesc'];
                $produtoCategorieId = $row['produtoCategorieId'];
                
                echo '<div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/produto-'.$produtoId. '.jpg" class="card-img-top" alt="image for this produto" width="249px" height="270px">
                        <div class="card-body">
                            <h5 class="card-title">' . substr($produtoName, 0, 20). '...</h5>
                            <h6 style="color: #ff0000">Rs. '.$produtoPrice. '/-</h6>
                            <p class="card-text">' . substr($produtoDesc, 0, 29). '...</p>
                            <div class="row justify-content-center">';
                                if($loggedin){
                                    $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE produtoId = '$produtoId' AND `userId`='$userId'";
                                    $quaresult = mysqli_query($conn, $quaSql);
                                    $quaExistRows = mysqli_num_rows($quaresult);
                                    if($quaExistRows == 0) {
                                        echo '<form action="partials/_manageCart.php" method="POST">
                                              <input type="hidden" name="itemId" value="'.$produtoId. '">
                                              <button type="submit" name="addToCart" class="btn btn-warning mx-2"><b>Comprar</b></button>';
                                    }else {
                                        echo '<a href="viewCart.php"><button class="btn btn-warning mx-2"><b>Ir ao Carrinho</b></button></a>';
                                    }
                                }
                                else{
                                    echo '<button class="btn btn-warning mx-2" data-toggle="modal" data-target="#loginModal"><b>Comprar</b></button>';
                                }
                                echo '</form>
                                <a href="viewproduto.php?produtoid=' . $produtoId . '"><button class="btn btn-info">Ver Mais</button></a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            if($noResult == true) {
                echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1>Sua pesquisa por - <em>"' .$_GET['search']. '"</em> - N??o teve resultados.</h1>
                        <p class="lead"> Sugest??es: <ul>
                            <li>Tenha certeza que digitou corretamente.</li>
                            <li>Tente outras palavras.</li>
                            <li>Tente palavras parecidas.</li></ul>
                        </p>
                    </div>
                </div> ';
            }
        ?>
        </div>
    </div>

    <?php require 'partials/_footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>