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

	if(isset($_POST["insert_produto"])) {
		$post = array(
			"class" => "empresa",
			"method" => "insert_produto",
			"id_empresa" => $session->id_empresa,
			"nome" => $_POST["nome"],
			"descricao" => $_POST["descricao"],
			"valor" => $_POST["valor"],
			"unidade_medida" => $_POST["unidade_medida"]
		);
		$id = call($post);
		if($id > 0) {
			$caminho = $_SERVER['DOCUMENT_ROOT'].'/sysne/assets/img/upload/';
			$imagem = $_FILES['imagem'];
	        $extension = pathinfo($imagem["name"], PATHINFO_EXTENSION);
	        $imagem["name"] = 'produto'.$id.'.'.$extension;
	        move_uploaded_file($imagem['tmp_name'],$caminho.$imagem["name"]);
			var_dump($caminho.$imagem["name"]);
	        img_resize($caminho.$imagem["name"],$caminho.$imagem["name"],$extension);
	        chmod($caminho.$imagem["name"],0777);

	        $post = array(
				"class" => "empresa",
				"method" => "update_imagem",
				"id_produto" => $id,
				"imagem" => $imagem["name"]
			);
			call($post);
			header("location: estoque.php");
		}
		else
			$alert = "alert('Não foi possível criar o produto, tente novamente.')";
	}
	elseif(isset($_POST["update_produto"])) {
		$post = array(
			"class" => "empresa",
			"method" => "update_produto",
			"id_produto" => $_POST["id_produto"],
			"nome" => $_POST["nome"],
			"descricao" => $_POST["descricao"],
			"valor" => $_POST["valor"],
			"unidade_medida" => $_POST["unidade_medida"]
		);
		$result = call($post);
		if($result == 1) {
			if(isset($_POST["mudar_imagem"]) && isset($_FILES['imagem'])) {
				$id = $_POST["id_produto"];
				$caminho = $_SERVER['DOCUMENT_ROOT'].'/sysne/assets/img/upload/';
				$imagem = $_FILES['imagem'];
		        $extension = pathinfo($imagem["name"], PATHINFO_EXTENSION);
		        $imagem["name"] = 'produto'.$id.'.'.$extension;
		        move_uploaded_file($imagem['tmp_name'],$caminho.$imagem["name"]);
				var_dump($caminho.$imagem["name"]);
		        img_resize($caminho.$imagem["name"],$caminho.$imagem["name"],$extension);
		        chmod($caminho.$imagem["name"],0777);

		        $post = array(
					"class" => "empresa",
					"method" => "update_imagem",
					"id_produto" => $id,
					"imagem" => $imagem["name"]
				);
				call($post);
			header("location: estoque.php");
			}
		}
		else
			$alert = "alert('Não foi possível editar o produto, tente novamente.')";
	}
	elseif(isset($_POST["entrada_produto"])) {
		$post = array(
			"class" => "empresa",
			"method" => "entrada_produto",
			"id_produto" => $_POST["id_produto"],
			"quantidade" => $_POST["quantidade"]
		);
		$result = call($post);
		if($result == 0)
			$alert = "alert('Não foi possível editar o produto, tente novamente.')";
		else
			header("location: estoque.php");
	}
	elseif(isset($_POST["bloquear_produto"])) {
		$post = array(
			"class" => "empresa",
			"method" => "bloquear_produto",
			"id_produto" => $_POST["id_produto"]
		);
		$result = call($post);
		if($result == 0)
			$alert = "alert('Não foi possível bloquear o produto, tente novamente.')";
		else
			header("location: estoque.php");
	}
	elseif(isset($_POST["desbloquear_produto"])) {
		$post = array(
			"class" => "empresa",
			"method" => "desbloquear_produto",
			"id_produto" => $_POST["id_produto"]
		);
		$result = call($post);
		if($result == 0)
			$alert = "alert('Não foi possível desbloquear o produto, tente novamente.')";
		else
			header("location: estoque.php");
	}

	if(isset($_GET["reload"]))
		header("location: estoque.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../../assets/img/SysneDarkLogo.png" />
    <title>Sysne - Estoque</title>
    
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
			<i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Estoque
			<div class="options pull-right">
				<button class="btn" data-toggle="modal" data-target="cad-produto"><i class="fa fa-plus" style="margin: 0;"></i>&nbsp;&nbsp;Criar produto</button>
			</div>
		</h2>
		<article id="produtos" class="content col-4">
		<?php
			$post = array(
		      "class" => "empresa",
		      "method" => "select_produtos",
		      "id_empresa" => $session->id_empresa
		    );
		    $json = call($post);
		    $produtos = json_decode($json);
		    if(count($produtos) == 0)
		    	echo '<p>Nenhum produto cadastrado. <a href="#" data-toggle="modal" data-target="cad-produto">Clique aqui para cadastrar!</a></p>';
		    for($i=0;$i<count($produtos);$i++) {
		    	$produto = $produtos[$i];
		    	$pouco = "";
		    	$plural = "";
		    	$bloquear = "bloquear";
		    	$bloquear_icon = "unlock";
		    	if($produto->quantidade < 10)
		    		$pouco = 'color:var(--red)';
		    	if($produto->quantidade > 1 || $produto->quantidade == 0)
		    		$plural = 's';
		    	if($produto->estado == 1) {
		    		$bloquear = "desbloquear";
		    		$bloquear_icon = "lock";
		    	}
		    	echo '<section class="card product">'.
					    '<div class="title">'.$produto->nome.'</div>'.
					    '<div class="image" style="background-image:url(../../assets/img/upload/'.$produto->imagem.')"></div>'.
					    '<div class="col-1">'.
						    '<div class="details" style="margin-bottom:5px">'.$produto->descricao.'</div>'.
						    '<div style="display:block">R$ '.$produto->valor.' cada '.$produto->unidade_medida.'</div>'.
						    '<div style="display:block;'.$pouco.'">Estoque: '.$produto->quantidade.' '.$produto->unidade_medida.$plural.'</div>'.
						    '<div class="pull-left">'.
						    	'<button class="btn little" data-toggle="modal" data-target="entrada-produto" id_produto='.$produto->id_produto.'><i class="fa fa-plus" style="margin: 0;"></i></button>'.
						    	'<button class="btn little" data-toggle="modal" data-target="edit-produto" id_produto='.$produto->id_produto.'><i class="fa fa-pencil" style="margin: 0;"></i></button>'.
						    	'<button class="btn little"  data-toggle="modal" data-target="'.$bloquear.'-produto" id_produto='.$produto->id_produto.'><i class="fa fa-'.$bloquear_icon.'" style="margin: 0;"></i></button>'.
						    	'<input type="hidden" id="produto'.$produto->id_produto.'" value=\''.(json_encode($produto)).'\'/>'.
						    '</div>'.
						'</div>'.
					  '</section>';
		    }
		?>
		</article>
    </main>

    <div class="modal" id="cad-produto">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Novo produto</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="cad-produto-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-2">
              <div>
                <input type="text" name="nome" minlength="6" placeholder="Nome do produto" required />
                <input type="text" name="descricao" minlength="6" placeholder="Descrição do produto" required />
                <input type="number" name="valor" placeholder="Valor do produto" required />
                <input type="text" name="unidade_medida" placeholder="Unidade de medida (Kg, unidade, etc)" required />
              </div>
              <label class="image-upload">
                <input type="file" name="imagem" accept='image/*' required />
                <image class="preview" src="../../assets/img/upload.png" />
              </label>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="insert_produto">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
          </div>
        </form>
      </div>
    </div>

    <div class="modal" id="edit-produto">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Editar produto</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="edit-produto-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-2">
              <div>
                <input type="hidden" name="id_produto" required />
                <input type="text" name="nome" minlength="6" placeholder="Nome do produto" required />
                <input type="text" name="descricao" minlength="6" placeholder="Descrição do produto" required />
                <input type="number" name="valor" placeholder="Valor do produto" required />
                <input type="text" name="unidade_medida" placeholder="Unidade de medida (Kg, unidade, etc)" required />
                <label>
                	<input type="checkbox" name="mudar_imagem" />&nbsp;&nbsp;Mudar imagem
                </label>
              </div>
              <label class="image-upload">
                <input type="file" name="imagem" accept='image/*'/>
                <image class="preview" src="../../assets/img/upload.png" />
              </label>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="update_produto">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
          </div>
        </form>
      </div>
    </div>

    <div class="modal" id="entrada-produto">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Registrar entrada de produtos</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="entrada-produto-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-1">
              <div>
                <input type="hidden" name="id_produto" required />
                <input type="number" name="quantidade" placeholder="Quantidade a dar entrada" required />
              </div>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="entrada_produto">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
          </div>
        </form>
      </div>
    </div>

    <div class="modal" id="bloquear-produto">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Bloquear produto</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="bloquear-produto-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-1">
                <input type="hidden" name="id_produto" required />
                <p>Se você bloquear este produto, ele ficará indisponível para vendas. Todos os produtos podem ser desbloqueados.</p> <p>Deseja fazer isso?</p>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="bloquear_produto">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
          </div>
        </form>
      </div>
    </div>

    <div class="modal" id="desbloquear-produto">
      <div class="window">
        <header class="modal-header">
          <div class="modal-title">Desbloquear produto</div>
          <button class="btn pull-right" data-close="modal"><i class="fa fa-times"></i></button>
        </header>
        <form id="desbloquear-produto-form" method="post" action="#" enctype="multipart/form-data">
          <div class="modal-inner">
            <setion class="modal-body col-1">
                <input type="hidden" name="id_produto" required />
                <p>Se você desbloquear este produto, ele ficará disponível para vendas. Todos os produtos podem ser bloqueados.</p> <p>Deseja fazer isso?</p>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="desbloquear_produto">Confirmar</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
          </div>
        </form>
      </div>
    </div>

    <script type="text/javascript" src="../../assets/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
    <script type="text/javascript" src="estoque.js"></script>
    <script type="text/javascript"><?php echo $alert; ?></script>
  </body>
</html>