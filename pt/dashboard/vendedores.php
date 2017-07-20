<?php
	require_once("../../flags/only_loged.php");
	require_once("../../flags/only_empresa.php");
	require_once("../../service_connect.php");
	$page = basename(__FILE__,".php");
	$alert = "";

	function img_resize($target,$newcopy,$ext,$w=720,$h=480)
	{
	    list($w_orig, $h_orig) = getimagesize($target);
	    $scale_ratio = $w_orig / $h_orig;
	    if (($w / $h) > $scale_ratio) {
	           $w = $h * $scale_ratio;
	    } else {
	           $h = $w / $scale_ratio;
	    }
	    $img = "";
	    $ext = strtolower($ext);
	    if($ext =="png"){ 
	        $img = imagecreatefrompng($target);
	    } else { 
	        $img = imagecreatefromjpeg($target);
	    }
	    $tci = imagecreatetruecolor($w, $h);
	    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
	    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
	    imagejpeg($tci, $newcopy, 80);
	}

	if(isset($_POST["insert_vendedor"])) {
		$post = array(
			"class" => "empresa",
			"method" => "insert_vendedor",
			"id_empresa" => $session->id_empresa,
			"nome" => $_POST["nome"],
			"email" => $_POST["email"],
			"senha" => $_POST["senha"]
		);
		$id = call($post);
		if($id == 0)
			$alert = "alert('Não foi possível cadastrar o vendedor, tente novamente.')";
		else
			header("location: vendedores.php");
	}
	elseif(isset($_POST["update_vendedor"])) {
		$post = array(
			"class" => "empresa",
			"method" => "update_vendedor",
			"id_vendedor" => $_POST["id_vendedor"],
			"nome" => $_POST["nome"],
			"email" => $_POST["email"]
		);
		$result = call($post);
		echo $result;
		if($result == 0)
			$alert = "alert('Este email já está cadastrado em outra conta!')";
		else
			header("location: vendedores.php");
	}
	elseif(isset($_POST["bloquear_vendedor"])) {
		$post = array(
			"class" => "empresa",
			"method" => "bloquear_vendedor",
			"id_vendedor" => $_POST["id_vendedor"]
		);
		$result = call($post);
		if($result == 0)
			$alert = "alert('Não foi possível bloquear o vendedor, tente novamente.')";
		else
			header("location: vendedores.php");
	}
	elseif(isset($_POST["desbloquear_vendedor"])) {
		$post = array(
			"class" => "empresa",
			"method" => "desbloquear_vendedor",
			"id_vendedor" => $_POST["id_vendedor"]
		);
		$result = call($post);
		if($result == 0)
			$alert = "alert('Não foi possível desbloquear o vendedor, tente novamente.')";
		else
			header("location: vendedores.php");
	}

	if(isset($_GET["reload"]))
		header("location: vendedores.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../../assets/img/SysneDarkLogo.png" />
    <title>Sysne - Vendedores</title>
    
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
			<i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Vendedores
			<div class="options pull-right">
				<button class="btn" data-toggle="modal" data-target="cad-vendedor"><i class="fa fa-plus" style="margin: 0;"></i>&nbsp;&nbsp;Cadastrar vendedor</button>
			</div>
		</h2>
		<article id="produtos" class="content">
		<?php
			$post = array(
		      "class" => "empresa",
		      "method" => "select_vendedores",
		      "id_empresa" => $session->id_empresa
		    );
		    $json = call($post);
		    $vendedores = json_decode($json);
		    if(count($vendedores) == 0)
		    	echo '<p>Nenhum vendedor cadastrado. <a href="#" data-toggle="modal" data-target="cad-vendedor">Clique aqui para cadastrar!</a></p>';
		    else {
		?>
		<table class="table">
            <thead>
              <th>Nome</th>
              <th>Email</th>
              <th>Opções</th>
            </thead>
        <?php
			    for($i=0;$i<count($vendedores);$i++) {
			    	$vendedor = $vendedores[$i];
			    	$bloquear = "bloquear";
			    	$bloquear_icon = "unlock";
			    	if($vendedor->estado == 1) {
			    		$bloquear = "desbloquear";
			    		$bloquear_icon = "lock";
			    	}
			    	echo '<tr class="vendedor">'.
				            '<td>'.$vendedor->nome.'</td>'.
				            '<td>'.$vendedor->email.'</td>'.
				            '<td>'.
				            	'<input type="hidden" id="vendedor'.$vendedor->id_vendedor.'" value=\''.(json_encode($vendedor)).'\' />'.
						    	'<button class="btn little" data-toggle="modal" data-target="edit-vendedor" id_vendedor='.$vendedor->id_vendedor.'><i class="fa fa-pencil" style="margin: 0;"></i></button>'.
						    	'<button class="btn little" data-toggle="modal" data-target="'.$bloquear.'-vendedor" id_vendedor='.$vendedor->id_vendedor.'><i class="fa fa-'.$bloquear_icon.'" style="margin: 0;"></i></button>'.
					    	'</td>'.
			            '</tr>';
			    }
		?>
		</table>
		<?php
			}
		?>
		</article>
    </main>

    <div class="modal" id="bloquear-vendedor">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Bloquear vendedor</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="bloquear-vendedor-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-1">
                <input type="hidden" name="id_vendedor" required />
                <p>Se você bloquear este vendedor, ele não poderá fazer login e nem realizar operações. Todos os vendedores podem ser desbloqueados.</p>
                <p>Deseja fazer isso?</p>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="bloquear_vendedor">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
       	  </div>
        </form>
      </div>
    </div>

    <div class="modal" id="desbloquear-vendedor">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Desbloquear vendedor</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="desbloquear-vendedor-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-1">
                <input type="hidden" name="id_vendedor" required />
                <p>Se você desbloquear este vendedor, ele poderá fazer login e realizar operações. Todos os vendedores podem ser bloqueados.</p>
                <p>Deseja fazer isso?</p>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="desbloquear_vendedor">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
       	  </div>
        </form>
      </div>
    </div>

    <div class="modal" id="cad-vendedor">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Novo vendedor</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="cad-vendedor-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-2">
              <div>
          		<input type="text" name="nome" minlength="6" placeholder="Nome do vendedor" required />
                <input type="email" name="email" placeholder="Email do vendedor" required />
          		<input type="password" name="senha" minlength="6" placeholder="Digite uma senha para o vendedor" required />
          		<input type="password" name="senha2" minlength="6" placeholder="Redigite a senha" required />
              </div>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="insert_vendedor">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
       	  </div>
        </form>
      </div>
    </div>

    <div class="modal" id="edit-vendedor">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Editar vendedor</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="edit-vendedor-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-2">
              <div>
                <input type="hidden" name="id_vendedor" required />
                <input type="text" name="nome" minlength="6" placeholder="Nome do vendedor" required />
                <input type="email" name="email" placeholder="Email do vendedor" required />
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="update_vendedor">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
       	  </div>
        </form>
      </div>
    </div>

    <script type="text/javascript" src="../../assets/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
    <script type="text/javascript" src="vendedores.js"></script>
    <script type="text/javascript"><?php echo $alert; ?></script>
  </body>
</html>