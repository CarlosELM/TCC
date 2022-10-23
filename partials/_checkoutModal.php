<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="checkoutModal">Colocar seus detalhes:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="partials/_manageCart.php" method="post">
                <div class="form-group">
                    <b><label for="mesa">Mesa:</label></b>
                    <input class="form-control col-md-3" id="mesa" name="mesa" type="tel" required pattern="[0-9]" maxlength="2"> 
                    
                </div>
    
                <div class="form-row">
                    <div class="form-group col-md-6 mb-0">
                        <b><label for="phone">Número de Telefone:</label></b>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon">+55</span>
                        </div>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="xxxxxxxxxxx" required pattern="[0-9]{11}" maxlength="11">
                        </div>
                    </div>
                  
                </div>
                <div class="form-group">
                    <b><label for="password">Senha:</label></b>    
                    <input class="form-control" id="password" name="password" placeholder="Coloque a sua Senha" type="password" required minlength="4" maxlength="21" data-toggle="password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="hidden" name="amount" value="<?php echo $totalPrice ?>">
                    <button type="submit" name="checkout" class="btn btn-success">Pedir</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>