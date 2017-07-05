<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../assets/img/SysneDarkLogo.png" />
    <title>Sysne - Cadastro</title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="../assets/css/style.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body style="background: url('../assets/img/vendas.jpeg') center / cover no-repeat fixed">

    <main class="main without-nav">
      <form>
        <section class="card col-2" style="padding: 20px;">
          <table class="table invert">
            <h2 class="title" style="text-align: center;">Escolha um plano</h2>
            <thead>
              <th id="pt_nome1">Gratuito</th>
              <th id="pt_nome2">Professional</th>
              <th id="pt_nome3">Enterprise</th>
            </thead>
            <tr>
              <td id="pt_descricao1"></td>
              <td id="pt_descricao2"></td>
              <td id="pt_descricao3"></td>
            </tr>
            <tr>
              <td id="produtos1"></td>
              <td id="produtos2"></td>
              <td id="produtos3"></td>
            </tr>
            <tr>
              <td id="vendedores1"></td>
              <td id="vendedores2"></td>
              <td id="vendedores3"></td>
            </tr>
            <tr>
              <td id="valor1"></td>
              <td id="valor2"></td>
              <td id="valor3"></td>
            </tr>
          </table>
          <div class="">
            <h2 class="title" style="text-align: center;">Dados de usuário</h2>
            <input type="text" name="username" placeholder="Username" />
            <input type="text" name="username" placeholder="Nome de identificação" />
            <input type="email" name="email" placeholder="Email de contato" />
            <input type="password" name="senha1" placeholder="Digite sua senha" />
            <input type="password" name="senha2" placeholder="Redigite sua senha" />
          </div>

        </section>
      </form>
    </main>

    <script type="text/javascript" src="../assets/js/exclusive/cadastro.js"></script>
  </body>
</html>
