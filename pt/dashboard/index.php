<?php
  require_once("../../flags/only_unloged.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../assets/img/SysneDarkLogo.png" />
    <title>Sysne - Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="../../assets/css/dashboard.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <header class="header">
      <div class="logo"></div>
      <div class="title">Sysne</div>
      <div class="options pull-right">
        <a href="../login" class="btn">Login</a>
        <a href="../cadastro" class="btn secondary">Cadastre-se</a>
      </div>
    </header>

    <main class="main">
      <section class="section">
        <div class="image invert col-3" style="background-image: url('../../assets/img/vendas.jpeg');">
          <div class="box">
            Gerencie seu negócio de qualquer lugar com Sysne, o mais novo assistente de vendas e estoque!<br/>
            <a href="cadastro.php" class="btn primary big" back-color="red" style="margin-top: 40px">Cadastre-se agora!</a>
          </div>
        </div>
        
      </section>
      <section class="section" back-color="red">
        
      </section>
    </main>

    <script type="text/javascript" src="main.js"></script>
  </body>
</html>
