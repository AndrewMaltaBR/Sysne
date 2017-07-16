<?php
  require_once("../../flags/only_unloged.php");
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

        <form id="cadastro" method="post" action="../../session/login.php">
          <input type="hidden" name="class" value="empresa" />
          <input type="hidden" name="method" value="insert" />
          <input type="hidden" name="return" value='0' />

          <input type="text" name="username" placeholder="Nome de usuário" required />
          <input type="text" name="nome" placeholder="Nome de identificação" required />
          <input type="email" name="email" placeholder="Email de contato" required />
          <input type="password" name="senha" placeholder="Digite sua senha" required />
          <input type="password" name="senha2" placeholder="Redigite sua senha" required />
          <div style="max-width:220px;margin:auto;margin-top:20px;">
            <button class="btn secondary" type="submit">Cadastrar</button>
            <a href="../login" class="btn" type="submit">Login</a>
          </div>
        </form>
      </div>
    </main>

    <script type="text/javascript" src="main.js"></script>
  </body>
</html>
