<nav class="nav">
<?php
	if(isset($page)) {
		if($page == "index")
			echo '<a class="unselectable active" href="#"><i class="fa fa-bank" aria-hidden="true"></i>&nbsp;&nbsp;Vendas</a>';
		else
			echo '<a class="unselectable" href="index.php"><i class="fa fa-bank" aria-hidden="true"></i>&nbsp;&nbsp;Vendas</a>';
		if($page == "venda")
			echo '<a class="unselectable active" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Registrar venda</a>';
		else
			echo '<a class="unselectable" href="venda.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Registrar venda</a>';
		if(!isset($session->id_vendedor)) {
			if($page == "estoque" )
				echo '<a class="unselectable active" href="#"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Estoque</a>';
			else
				echo '<a class="unselectable" href="estoque.php"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Estoque</a>';
			if($page == "vendedores")
				echo '<a class="unselectable active" href="#"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Vendedores</a>';
			else
				echo '<a class="unselectable" href="vendedores.php"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Vendedores</a>';
		}
	}
?>
</nav>