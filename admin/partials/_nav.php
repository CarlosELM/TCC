<?php include '_dbconnect.php';?>
<?php 
            $sql = "SELECT * FROM users WHERE id='$userId'"; 
            $result = mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);

            ?>
 <header class="header" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>


        <div class="header__img">
            <img class="rounded-circle mb-3 bg-dark" src="../img/person-<?php echo $userId; ?>.jpg" onError="this.src = '../img/profilePic.jpg'" style="width:40px; height:40px">
          </div>

      
    </header>

    <div class="l-navbar" id="nav-bar" >
        <nav class="nav">
            <div>
                <a href="index.php" class="nav__logo">
                    <i class='bx bx-layer nav__logo-icon'></i>
                    <span class="nav__logo-name">Way-Tech</span>
                </a>

                <div class="nav__list">
                    <a href="index.php" class="nav__link nav-home">
                      <i class='bx bx-grid-alt nav__icon' ></i>
                      <span class="nav__name">Home</span>
                    </a>
                    <a href="index.php?page=orderManage" class="nav-orderManage nav__link ">
                      <i class='bx bx-bar-chart-alt-2 nav__icon' ></i>
                      <span class="nav__name">Pedidos</span>
                    </a>
                    <a href="index.php?page=categoryManage" class="nav__link nav-categoryManage">
                      <i class='bx bx-folder nav__icon' ></i>
                      <span class="nav__name">Categorias</span>
                    </a>
                    <a href="index.php?page=menuManage" class="nav__link nav-menuManage">
                      <i class='bx bx-message-square-detail nav__icon' ></i>
                      <span class="nav__name">Produtos</span>
                    </a>
                    <a href="index.php?page=contactManage" class="nav__link nav-contactManage">
                      <i class="fas fa-hands-helping"></i>
                      <span class="nav__name">Contatos</span>
                    </a>
                    <a href="index.php?page=userManage" class="nav__link nav-userManage">
                      <i class='bx bx-user nav__icon' ></i>
                      <span class="nav__name">Usuários</span>
                    </a>
                    <a href="index.php?page=siteManage" class="nav__link nav-siteManage">
                      <i class="fas fa-cogs"></i>
                      <span class="nav__name">Configurações</span>
                    </a>
                </div>
            </div>
            <a href="partials/_logout.php" class="nav__link">
              <i class='bx bx-log-out nav__icon' ></i>
              <span class="nav__name">Sair</span>
            </a>
        </nav>
    </div>  
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
	  $('.nav-<?php echo $page; ?>').addClass('active')
</script>
   