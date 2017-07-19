<?php
  require_once("../../flags/only_loged.php");
  require_once("../../service_connect.php");
  $page = basename(__FILE__,".php");
  $alert = "";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../../assets/img/SysneDarkLogo.png" />
    <title>Sysne - Estatísticas</title>
    
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
      <h2 class="title"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;&nbsp;Estatísticas</h2>
      <article class="content">
        <section class="card">
          <div class="title">Kiwi verde</div>
          <div class="details">Kiwi verde</div>
        </section>
      </article>
    </main>

    <script type="text/javascript" src="../../assets/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
    <script type="text/javascript"><?php echo $alert; ?></script>
  </body>
</html>
