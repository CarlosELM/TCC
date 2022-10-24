<div class="container-fluid" style="margin-top:98px">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
				<div class="card mb-3">
					<div class="card-header" style="background-color: #EEAD2D;">
						<b>Criar Novo Produto</b>
				  	</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">Nome: </label>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="form-group">
								<label class="control-label">Descrição: </label>
								<textarea cols="30" rows="3" class="form-control" name="description" required></textarea>
							</div>
                            <div class="form-group">
								<label class="control-label">Preço</label>
								<input type="number" class="form-control" name="price" required min="1">
							</div>	
							<div class="form-group">
								<label class="control-label">Categoria </label>
								<select name="categoryId" id="categoryId" class="custom-select browser-default" required>
								<option hidden disabled selected value>Nenhuma</option>
                                <?php
                                    $catsql = "SELECT * FROM `categories`"; 
                                    $catresult = mysqli_query($conn, $catsql);
                                    while($row = mysqli_fetch_assoc($catresult)){
                                        $catId = $row['categorieId'];
                                        $catName = $row['categorieName'];
                                        echo '<option value="' .$catId. '">' .$catName. '</option>';
                                    }
                                ?>
								</select>
							</div>
							
							<div class="form-group">
								<label for="image" class="control-label">Imagem</label>
								<input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
								<small id="Info" class="form-text text-muted mx-3">Faça upload do arquivo .jpg</small>
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="mx-auto">
								<button type="submit" name="createItem" class="btn btn-warning btn-primary"> <b>Criar</b> </button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover mb-0">
							<thead style="background-color: #EEAD2D;">
								<tr>
									<th class="text-center" style="width:7%;">Categoria</th>
									<th class="text-center">Imagem</th>
									<th class="text-center" style="width:58%;">Detalhes do Produto</th>
									<th class="text-center" style="width:18%;">Ações</th>
								</tr>
							</thead>
							<tbody>
                            <?php
                                $sql = "select * from produto as p inner join categories as c on c.categorieid = p.produtoCategorieId;";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $produtoId = $row['produtoId'];
                                    $produtoName = $row['produtoName'];
                                    $produtoPrice = $row['produtoPrice'];
                                    $produtoDesc = $row['produtoDesc'];
                                    $categorieName = $row['categorieName'];

                                    echo '<tr>
                                            <td class="text-center">' .$categorieName. '</td>
                                            <td>
                                                <img src="/tcc/img/produto-'.$produtoId. '.jpg" alt="image for this item" width="150px" height="150px">
                                            </td>
                                            <td>
                                                <p>Nome: <b>' .$produtoName. '</b></p>
                                                <p>Descrição : <b class="truncate">' .$produtoDesc. '</b></p>
                                                <p>Preço: <b>R$' .$produtoPrice. '</b></p>
                                            </td>
                                            <td class="text-center">
												<div class="row mx-auto" style="width:112px">
													<button class="btn btn-sm btn-warning" type="button" data-toggle="modal" data-target="#updateItem' .$produtoId. '"><b>Edit</b></button>
													<form action="partials/_menuManage.php" method="POST">
														<button name="removeItem" class="btn btn-sm btn-danger" style="margin-left:6px;">Delete</button>
														<input type="hidden" name="produtoId" value="'.$produtoId. '">
													</form>
												</div>
                                            </td>
                                        </tr>';
                                }
                            ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	
</div>

<?php 
    $produtosql = "SELECT * FROM `produto`";
    $produtoResult = mysqli_query($conn, $produtosql);
    while($produtoRow = mysqli_fetch_assoc($produtoResult)){
        $produtoId = $produtoRow['produtoId'];
        $produtoName = $produtoRow['produtoName'];
        $produtoPrice = $produtoRow['produtoPrice'];
        $produtoCategorieId = $produtoRow['produtoCategorieId'];
        $produtoDesc = $produtoRow['produtoDesc'];
?>

<!-- Modal -->
<div class="modal fade" id="updateItem<?php echo $produtoId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateItem<?php echo $produtoId; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #EEAD2D;">
        <h5 class="modal-title" id="updateItem<?php echo $produtoId; ?>">ID do Produto: <b><?php echo $produtoId; ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
		    <div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
		   		<div class="form-group col-md-8">
					<b><label for="image">Image</label></b>
					<input type="file" name="itemimage" id="itemimage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('itemPhoto').src = window.URL.createObjectURL(this.files[0])">
					<small id="Info" class="form-text text-muted mx-3">Faça upload do arquivo .jpg</small>
					<input type="hidden" id="produtoId" name="produtoId" value="<?php echo $produtoId; ?>">
					<button type="submit" class="btn btn-warning my-1" name="updateItemPhoto"><b>Atualizar Imagem</b></button>
				</div>
				<div class="form-group col-md-4">
					<img src="/tcc/img/produto-<?php echo $produtoId; ?>.jpg" id="itemPhoto" name="itemPhoto" alt="item image" width="100" height="100">
				</div>
			</div>
		</form>
		<form action="partials/_menuManage.php" method="post">
            <div class="text-left my-2">
                <b><label for="name">Nome</label></b>
                <input class="form-control" id="name" name="name" value="<?php echo $produtoName; ?>" type="text" required>
            </div>
			<div class="text-left my-2 row">
				<div class="form-group col-md-6">
                	<b><label for="price">Preço</label></b>
                	<input class="form-control" id="price" name="price" value="<?php echo $produtoPrice; ?>" type="number" min="1" required>
				</div>
				<div class="form-group col-md-6">
					<b><label for="catId">ID da Categoria</label></b>
                	<input class="form-control" id="catId" name="catId" value="<?php echo $produtoCategorieId; ?>" type="number" min="1" required>
				</div>
            </div>
            <div class="text-left my-2">
                <b><label for="desc">Descrição</label></b>
                <textarea class="form-control" id="desc" name="desc" rows="2" required minlength="6"><?php echo $produtoDesc; ?></textarea>
            </div>
            <input type="hidden" id="produtoId" name="produtoId" value="<?php echo $produtoId; ?>">
            <button type="submit" class="btn btn-warning" name="updateItem"><b>Atualizar</b></button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
	}
?>