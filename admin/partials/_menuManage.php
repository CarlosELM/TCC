<?php
    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['createItem'])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $categoryId = $_POST["categoryId"];
        $price = $_POST["price"];

        $sql = "INSERT INTO `produto` (`produtoName`, `produtoPrice`, `produtoDesc`, `produtoCategorieId`, `produtoPubDate`) VALUES ('$name', '$price', '$description', '$categoryId', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        $produtoId = $conn->insert_id;
        if ($result){
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                
                $newName = 'produto-'.$produtoId;
                $newfilename=$newName .".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/tcc/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    echo "<script>alert('Criado com Sucesso!');
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>alert('Falha ao criar! Tente novamente.');
                            window.location=document.referrer;
                        </script>";
                }

            }
            else{
                echo '<script>alert("Por favor selecione uma imagem para atualizar.");
                        window.location=document.referrer;
                    </script>';
            }
        }
        else {
            echo "<script>alert('Falha ao criar! Tente novamente.');
                    window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['removeItem'])) {
        $produtoId = $_POST["produtoId"];
        $sql = "DELETE FROM `produto` WHERE `produtoId`='$produtoId'";   
        $result = mysqli_query($conn, $sql);
        $filename = $_SERVER['DOCUMENT_ROOT']."/tcc/img/produto-".$produtoId.".jpg";
        if ($result){
            if (file_exists($filename)) {
                unlink($filename);
            }
            echo "<script>alert('Removido com Sucesso!');
                window.location=document.referrer;
            </script>";
        }
        else {
            echo "<script>alert('Remoção falhou! Tente novamente.');
            window.location=document.referrer;
            </script>";
        }
    }
    if(isset($_POST['updateItem'])) {
        $produtoId = $_POST["produtoId"];
        $produtoName = $_POST["name"];
        $produtoDesc = $_POST["desc"];
        $produtoPrice = $_POST["price"];
        $produtoCategorieId = $_POST["catId"];

        $sql = "UPDATE `produto` SET `produtoName`='$produtoName', `produtoPrice`='$produtoPrice', `produtoDesc`='$produtoDesc', `produtoCategorieId`='$produtoCategorieId' WHERE `produtoId`='$produtoId'";   
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "<script>alert('Atualizado com Sucesso!');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('Atualização falhou! Tente novamente.');
                window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['updateItemPhoto'])) {
        $produtoId = $_POST["produtoId"];
        $check = getimagesize($_FILES["itemimage"]["tmp_name"]);
        if($check !== false) {
            $newName = 'produto-'.$produtoId;
            $newfilename=$newName .".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/tcc/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['itemimage']['tmp_name'], $uploadfile)) {
                echo "<script>alert('Atualizada com sucesso!');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('Atualização falhou! Tente novamente.');
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>alert("Por favor selecione uma imagem para atualizar.");
            window.location=document.referrer;
                </script>';
        }
    }
}
?>