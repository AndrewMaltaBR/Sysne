<?php
  require_once("../../flags/only_loged.php");
  require_once("../../service_connect.php");
  $page = basename(__FILE__,".php");
  $alert = "";

  if(isset($_POST["confirmar_venda"])) {
    $post = array(
      "class" => "empresa",
      "method" => "confirmar_venda",
      "id_venda" => $_POST["id_venda"]
    );
    $result = call($post);
    if($result == 0)
      $alert = "alert('Não foi possível confirmar a venda, tente novamente.')";
    else
      header("location: index.php");
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
        <i class="fa fa-bank" aria-hidden="true"></i>&nbsp;&nbsp;Vendas
        <div class="options pull-right">
          <a href="venda.php" class="btn"><i class="fa fa-plus" style="margin: 0;"></i>&nbsp;&nbsp;Registrar venda</a>
        </div>
      </h2>
      <article class="content">
      <?php
        $post = null;
        if(!isset($session->id_vendedor))
          $post = array(
            "class" => "empresa",
            "method" => "select_vendas",
            "id_empresa" => $session->id_empresa
          );
        else
          $post = array(
            "class" => "empresa",
            "method" => "select_vendas_disponiveis",
            "id_vendedor" => $session->id_vendedor
          );
        $json = call($post);
        $venda = json_decode($json);
        if(count($venda) == 0)
          echo '<p>Nenhuma venda registrada. <a href="venda.php">Clique aqui para registrar!</a></p>';
        for($i=0;$i<count($venda);$i++) {
          $confirmado = '<i class="fa fa-check" style="margin: 0;"></i>&nbsp;Confirmada';
          if($venda[$i]->data_con == null) {
            if(!isset($session->id_vendedor))
              $confirmado = '<button class="btn primary little" style="margin:-3px -6px" data-toggle="modal" data-target="confirmar-venda" id_venda='.$venda[$i]->id_venda.'><i class="fa fa-check" style="margin: 0;"></i>&nbsp;Confirmar</button>';
            else
              $confirmado = '<i class="fa fa-times" style="margin: 0;"></i>&nbsp;Não confirmado';
          }
          $vendedor = "Registrada pela empresa ".$session->nome;
          if(isset($venda[$i]->vendedor))
            $vendedor = "Registrada pelo vendedor ".$venda[$i]->vendedor->nome." &#60;".$venda[$i]->vendedor->email."&#62;";
          echo '<section class="accordion">'.
                '<div class="accordion-header">'.
                  $venda[$i]->data_exp.' - R$ '.$venda[$i]->total.
                  '<div class="pull-right">'.$confirmado."</div>".
                '</div>'.
                '<div class="accordion-inner">'.
                  '<h3 style="margin-bottom:5px">'.$vendedor.'</h3>'.
                  '<table class="table">'.
                    '<thead>'.
                      '<th>Nome</th>'.
                      '<th>Quantidade</th>'.
                      '<th>Valor</th>'.
                      '<th>Total</th>'.
                    '</thead>';

          $item = $venda[$i]->item;
          for($j=0;$j<count($item);$j++) {
            $unidade = $item[$j]->unidade_medida.'s';
            if($item[$j]->quantidade == 1)
              $unidade = $item[$j]->unidade_medida;
            echo '<tr>'.
                    '<td>'.$item[$j]->nome.'</td>'.
                    '<td>'.$item[$j]->quantidade.' '.$unidade.'</td>'.
                    '<td>R$ '.$item[$j]->valor.'</td>'.
                    '<td>R$ '.number_format((float)($item[$j]->quantidade*$item[$j]->valor), 2, '.', '').'</td>'.
                  '</tr>';
          }
          echo '</table></div></section>';
        }
      ?>
      </article>
    </main>

    <div class="modal" id="confirmar-venda">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Confirmar venda</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="confirmar-venda-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-1">
                <input type="hidden" name="id_venda" required />
                <p>Se você confirmar essa venda, será feita a baixa no estoque e isso não poderá ser revertido.</p>
                <p>Deseja fazer isso?</p>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="confirmar_venda">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
          </div>
        </form>
      </div>
    </div>

    <script type="text/javascript" src="../../assets/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
    <script type="text/javascript" src="vendas.js"></script>
    <script type="text/javascript"><?php echo $alert; ?></script>
  </body>
</html>
