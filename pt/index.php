<?php
  require_once("../flags/only_loged.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../assets/img/SysneDarkLogo.png" />
    <title>Sysne</title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/modal.css" />

    <script type="text/javascript" src="../assets/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.validate.min.js"></script>
  </head>
  <body>
    <header class="header" back-color="dark-blue">
      <div class="btn-nav"><i class="fa fa-bars" aria-hidden="true"></i></div>
      <div class="logo light"></div>
      <div class="title">Sysne</div>
      <div class="options pull-right">
        <button class="btn" refresh><i class="fa fa-refresh" aria-hidden="true" style="margin: 0;"></i></button>
        <a href="../session/logout.php" class="btn secondary"><i class="fa fa-sign-out" style="margin: 0;"></i>&nbsp;&nbsp;Sair</a>
      </div>
    </header>

    <nav class="nav">
      <a class="unselectable" page="estatisticas"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;&nbsp;Estatísticas</a>
      <a class="unselectable" page="estoque"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Estoque</a>
      <a class="unselectable" page="vendedores"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Vendedores</a>
      <a class="unselectable" page="vendas"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Vendas</a>
    </nav>

    <main class="main">

    </main>

    <div class="modal" id="cad-produto">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Novo produto</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="cad-produto-form" method="post" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-2">
              <input type="hidden" name="class" value="empresa" />
              <input type="hidden" name="method" value="insert_produto" />

              <input type="text" name="nome" minlength="6" placeholder="Nome do produto" required />
              <input type="text" name="descricao" minlength="6" placeholder="Descrição do produto" required />
              <input type="number" name="valor" placeholder="Valor do produto" required />
              <label class="image-upload">
                <input type="file" name="imagem" accept='image/*'/>
                <image class="preview" src="../assets/img/upload.png" />
              </label>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary">Criar produto</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="../assets/js/main.js"></script>
    <script type="text/javascript" src="forms/cad-produto.js"></script>
  </body>
</html>
