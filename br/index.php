<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lembrador</title>
    <link rel="stylesheet" href="../assets/css/reset.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
  </head>
  <body>
    <header class="header" back-color="dark-blue">
      <div class="title">Lembrador</div>
      <form method="post" action="#" style="float: right">
        <button type="submit" name="clear" class="btn" style="color: var(--light-font)">Limpar tudo</button>
      </form>
      <button class="btn"  style="color: var(--light-font)" onclick='alert(`<?php if(isset($_SESSION["json_lembrador"])) echo $_SESSION["json_lembrador"]; else echo "[]"; ?>`)'>Ver json</button>
    </header>

    <main class="content">
      <article class="profile">
        <section class="card">
          <form method="post" action="#">
            <input type="text" name="title" placeholder="Título do lembrete" required />
            <input type="text" name="details" placeholder="Detalhes do lembrete" />
            <button class="btn" type="submit" name="new">Salvar lembrete</button>
          </form>
        </section>
      </article>
    </main>
  </body>
</html>
