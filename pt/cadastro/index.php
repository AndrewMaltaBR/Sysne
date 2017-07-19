<?php
  require_once("../../flags/only_unloged.php");
  require_once("../../service_connect.php");

  $alert = "";

  if(isset($_POST["cadastro"])) {
    $post = array(
      "class" => "empresa",
      "method" => "insert",
      "email" => $_POST["email"],
      "nome" => $_POST["nome"],
      "senha" => $_POST["senha"]
    );
    $json = call($post);
    $session = json_decode($json);
    if(isset($session->id_login)){
      session_start();
      $_SESSION["session"] = $json;
      header("location: ../../");
    }
    else{
      $alert = "alert('Já exite uma conta com este email!')";
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../assets/img/SysneDarkLogo.png" />
    <title>Sysne - Cadastro</title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="../../assets/css/style.css" />
  </head>
  <body style="background: url('../../assets/img/vendas.jpeg') center / cover no-repeat fixed">

    <main class="main without-nav">
      <div class="card" style="max-width:500px;margin: auto;display: block;padding: 30px;">
        <h2 class="title" style="text-align: center; margin-bottom: 30px;">
          <div style="max-width:100px;height:100px;margin:auto;">
            <div class="logo dark" style="width:100%;height:100%;"></div>
          </div>
          <p>Crie sua conta Sysne agora!</p>
        </h2>

        <form id="cadastro" method="post" action="#">
          <input type="email" name="email" placeholder="Email de contato" required autofocus />
          <input type="text" name="nome" minlength="6" placeholder="Nome de identificação" required />
          <input type="password" name="senha" minlength="6" placeholder="Digite sua senha" required />
          <input type="password" name="senha2" minlength="6" placeholder="Redigite sua senha" required />
          <div style="max-width:220px;margin:auto;margin-top:20px;">
            <button class="btn secondary" type="submit" name="cadastro">Cadastrar</button>
            <a href="../login" class="btn" type="submit">Login</a>
          </div>
        </form>
      </div>
    </main>

    <script type="text/javascript" src="../../assets/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="cadastro.js"></script>
    <script type="text/javascript"><?php echo $alert; ?></script>
  </body>
</html>
