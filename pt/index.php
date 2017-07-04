<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sysne - Painel</title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../assets/css/reset.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <header class="header" back-color="dark-blue">
      <div class="btn-nav"><i class="fa fa-bars" aria-hidden="true"></i></div>
      <div class="logo light"></div>
      <div class="title">Sysne</div>
    </header>

    <nav class="nav">
      <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;&nbsp;Home</a>
      <a href="#"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Estoque</a>
      <a href="#"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Vendedores</a>
      <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Vendas</a>
    </nav>

    <main class="main">
      <section class="card">
        <form method="post" action="#">
          <input type="text" name="title" placeholder="Título do lembrete" required />
          <input type="text" name="details" placeholder="Detalhes do lembrete" />
          <button class="btn" type="submit" name="new">Salvar lembrete</button>
        </form>
      </section>
    </main>

    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>
