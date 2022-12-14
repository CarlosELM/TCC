<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%" id='notempty'>
    <strong>Informação!</strong> Se o problema não é relacionado ao pedido, o ID do Pedido vai ser 0.
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
</div>
<style>
    .btn-danger-gradiant {
        background: linear-gradient(to right, #ff4d7e 0%, #ff6a5b 100%);
    }

    .btn-danger-gradiant:hover {
        background: linear-gradient(to right, #ff6a5b 0%, #ff4d7e 100%);
    }
</style>
<div style="margin-right: 32px;display: table;margin-left: auto;">
<button type="button" class="btn btn-danger-gradiant text-white border-0 py-2 px-3 mx-2" data-toggle="modal" data-target="#history"><span> HISTÓRICO <i class="ti-arrow-right"></i></span></button>
</div>
<div class="container-fluid" id='empty'>	
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12 text-center">
                    <thead style="background-color: #EEAD2D;">
                        <tr>
                            <th>ID do Contato</th>
                            <th>Usuário</th>
                            <th>Email</th>
                            <th>Número de Telefone</th>
                            <th>ID do Pedido</th>
                            <th>Mensagem</th>
                            <th>Data</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "select * from contact as c inner join users as u on u.id = c.userId;"; 
                            $result = mysqli_query($conn, $sql);
                            $count = 0;
                            while($row=mysqli_fetch_assoc($result)) {
                                $contactId = $row['contactId'];
                                $username = $row['username'];
                                $email = $row['email'];
                                $phoneNo = $row['phoneNo'];
                                $orderId = $row['orderId'];
                                $message = $row['message'];
                                $time = $row['time'];
                                $count++;

                                echo '<tr>
                                        <td>' .$contactId. '</td>
                                        <td>' .$username. '</td>
                                        <td>' .$email. '</td>
                                        <td>' .$phoneNo. '</td>
                                        <td>' .$orderId. '</td>
                                        <td>' .$message. '</td>
                                        <td>' .$time. '</td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-warning" type="button" data-toggle="modal" data-target="#reply' .$contactId. '"><b>Responder </b></button>
                                        </td>
                                    </tr>';
                            }
                            if($count==0) {
                              ?><script> document.getElementById("notempty").innerHTML = '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> Você ainda não recebeu mensagens!	</div>';
                              document.getElementById("empty").innerHTML = '';
                              </script> <?php
                            }
                        ?>
                        
                    </tbody>
		        </table>
			</div>
		</div>
	</div>
</div>

    <?php 
        $contactsql = "SELECT * FROM `contact`";
        $contactResult = mysqli_query($conn, $contactsql);
        while($contactRow = mysqli_fetch_assoc($contactResult)){
            $contactId = $contactRow['contactId'];
            $Id = $contactRow['userId'];
    ?>

    <!-- Reply Modal -->
    <div class="modal fade" id="reply<?php echo $contactId; ?>" tabindex="-1" role="dialog" aria-labelledby="reply<?php echo $contactId; ?>" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #EEAD2D;">
            <h5 class="modal-title" id="reply<?php echo $contactId; ?>">Resposta (ID do Contato: <?php echo $contactId; ?>)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="partials/_contactManage.php" method="post">
                <div class="text-left my-2">
                    <b><label for="message">Mensagem: </label></b>
                    <textarea class="form-control" id="message" name="message" rows="2" required minlength="5"></textarea>
                </div>
                <input type="hidden" id="contactId" name="contactId" value="<?php echo $contactId; ?>">
                <input type="hidden" id="userId" name="userId" value="<?php echo $Id; ?>">
                <button type="submit" class="btn btn-warning" name="contactReply"><b>Responder</b></button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php
        }
    ?>

    <!-- history Modal -->
    <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="history" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #EEAD2D;">
              <h5 class="modal-title" id="history">Suas Respostas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="notReply">
            <table class="table-striped table-bordered col-md-12 text-center">
                <thead style="background-color: #EEAD2D;">
                    <tr>
                        <th>ID do Contato</th>
                        <th>Resposta</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $sql = "SELECT * FROM `contactreply`"; 
                    $result = mysqli_query($conn, $sql);
                    $totalReply = 0;
                    while($row=mysqli_fetch_assoc($result)) {
                        $contactId = $row['contactId'];
                        $message = $row['message'];
                        $datetime = $row['datetime'];
                        $totalReply++;

                        echo '<tr>
                                <td>' .$contactId. '</td>
                                <td>' .$message. '</td>
                                <td>' .$datetime. '</td>
                              </tr>';
                    }    

                    if($totalReply==0) {
                      ?><script> document.getElementById("notReply").innerHTML = '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> Você ainda não respondeu nenhuma mensagem!	</div>';</script> <?php
                    }   

                ?>
                </tbody>
		    </table>
            </div>
          </div>
        </div>
    </div>