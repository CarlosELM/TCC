<?php
    include '_dbconnect.php';
    session_start();
    $userId = $_SESSION['userId'];
    
    
    if(isset($_POST["updateProfilePic"])){
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $newfilename = "person-".$userId.".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/OnlinePizzaDelivery/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                echo "<script>alert('Imagem Atualizada.');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('A atualização falhou, tente novamente.');
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>alert("Por favor, selecione uma imagem para atualizar.");
                window.history.back(1);
            </script>';
        }
    }

    if(isset($_POST["updateProfileDetail"])){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password =$_POST["password"];

        $passSql = "SELECT * FROM users WHERE id='$userId'"; 
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);
        if (password_verify($password, $passRow['password'])){ 
            $sql = "UPDATE `users` SET `firstName` = '$firstName', `lastName` = '$lastName', `email` = '$email', `phone` = '$phone' WHERE `id` ='$userId'";   
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<script>alert("Atualizado com sucesso.");
                        window.history.back(1);
                    </script>';
            }else{
                echo '<script>alert("A atualização falhou, tente novamente.");
                        window.history.back(1);
                    </script>';
            } 
        }
        else {
            echo '<script>alert("Senha Incorreta.");
                        window.history.back(1);
                    </script>';
        }
    }
    
    if(isset($_POST["removeProfilePic"])){
        $filename = $_SERVER['DOCUMENT_ROOT']."/OnlinePizzaDelivery/img/person-".$userId.".jpg";
        if (file_exists($filename)) {
            unlink($filename);
            echo "<script>alert('Foto removida.');
                window.location=document.referrer;
            </script>";
        }
        else {
            echo "<script>alert('Nenhuma foto disponível.');
                window.location=document.referrer;
            </script>";
        }
    }
    
?>