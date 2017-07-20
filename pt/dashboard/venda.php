<?php
  require_once("../../flags/only_loged.php");
  require_once("../../service_connect.php");
  $page = basename(__FILE__,".php");
  $alert = "";

  if(isset($_POST["insert_venda"])) {
    $post = array(
      "class" => "empresa",
      "method" => "select_produtos_disponiveis",
      "id_empresa" => $session->id_empresa
    );
    if(isset($session->id_vendedor))
      $post["id_vendedor"] = $session->id_vendedor;
    $json = call($post);
    $produtos = json_decode($json);
    $itens = array();
    $j = 0;
    for($i=0;$i<count($produtos);$i++) {
      if(isset($_POST["valor-".$produtos[$i]->id_produto])) {
        $itens[$j]["quantidade"] = $_POST["quantidade-".$produtos[$i]->id_produto];
        $itens[$j]["valor"] = $_POST["valor-".$produtos[$i]->id_produto];
        $itens[$j]["id_produto"] = $produtos[$i]->id_produto;
        $j++;
      }
    }
    if(count($itens) > 0) {
      $post = array(
        "class" => "empresa",
        "method" => "insert_venda",
        "id_empresa" => $session->id_empresa,
        "json_itens" => json_encode($itens)
      );
      if(isset($session->id_vendedor))
        $post["id_vendedor"] = $session->id_vendedor;
      $result = call($post);
      if($result == 0)
        $alert = "alert('Não foi possível registrar a venda, tente novamente!')";
      else
        header("location: venda.php");
    }
    else
      $alert = "alert('Selecione ao menos um produto!')";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../../assets/img/SysneDarkLogo.png" />
    <title>Sysne - Vendas</title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="../../assets/css/style.css" />
  </head>
  <body>
  <?php
    require_once("header.php");
    require_once("nav.php");
  ?>
    <main class="main">
      <h2 class="title">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Registrar venda
      </h2>
      <article class="content">
        <section class="horizontal-scroll">
        <?php
          $post = array(
            "class" => "empresa",
            "method" => "select_produtos_disponiveis",
            "id_empresa" => $session->id_empresa
          );
          $json = call($post);
          $produtos = json_decode($json);
          for($i=0;$i<count($produtos);$i++) {
            $produto = $produtos[$i];
            echo '<div class="card" style="width:auto">'.
                  '<div class="title">'.$produto->nome.'</div>'.
                  '<div style="display:block">R$ '.$produto->valor.' cada '.$produto->unidade_medida.'</div>'.
                  '<div style="display:block;'.$pouco.'">Estoque: '.$produto->quantidade.' '.$produto->unidade_medida.$plural.'</div>'.
                  '<div class="pull-left">'.
                    '<button class="btn little" id_produto='.$produto->id_produto.'><i class="fa fa-plus" style="margin: 0;"></i></button>'.
                    '<input type="hidden" id="produto'.$produto->id_produto.'" value=\''.(json_encode($produto)).'\'/>'.
                  '</div>'.
                '</div>';
          }
        ?>
        </section>
        <form id="cad-venda-form" method="post" action="#">
          <table class="table" id="inputs">
            <thead>
              <th id="total">Total: R$ 0</th>
              <th>Quantidade</th>
              <th>Valor</th>
              <th>Total</th>
            </thead>
          </table>
          <button class="btn primary" type="submit" name="insert_venda">Confirmar</button>
          <button class="btn" type="reset" data-close="modal">Cancelar</button>
        </form>
      </article>
    </main>

    <script type="text/javascript" src="../../assets/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
    <script type="text/javascript" src="venda.js"></script>
    <script type="text/javascript"><?php echo $alert; ?></script>
  </body>
</html>
