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
			"valor" => $_POST["valor"]
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
		<input id="filtro" type="text" style="display:inline-block;" placeholder="Pesquisar">
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
		    	echo '<section class="card product">'.
					    '<div class="title">'.$produto->nome.'</div>'.
					    '<div class="image" style="background-image:url(../../assets/img/upload/'.$produto->imagem.')"></div>'.
					    '<div class="col-1">'.
						    '<div class="details" style="margin-bottom:5px">'.$produto->descricao.'</div>'.
						    '<div style="display:block">R$ '.$produto->valor.'</div>'.
						    '<div style="display:block">Disponível: '.$produto->quantidade.'</div>'.
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
              </div>
              <label class="image-upload">
                <input type="file" name="imagem" accept='image/*'/>
                <image class="preview" src="../../assets/img/upload.png" />
              </label>
            </setion>
            <footer class="modal-footer">
              <button class="btn primary" type="submit" name="insert_produto">Criar produto</button>
              <button class="btn" type="reset" data-close="modal">Cancelar</button>
            </footer>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="../../assets/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../../assets/js/main.js"></script>
    <script type="text/javascript" src="estoque.js"></script>
    <script type="text/javascript"><?php echo $alert; ?></script>
  </body>
</html>