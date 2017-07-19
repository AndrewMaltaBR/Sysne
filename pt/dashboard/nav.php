<nav class="nav">
<?php
	if(isset($page)) {
		if($page == "index")
			echo '<a class="unselectable active" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Vendas</a>';
		else
			echo '<a class="unselectable" href="index.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Vendas</a>';
		if(!isset($session->id_vendedor)) {
			if($page == "estoque" )
				echo '<a class="unselectable active" href="#"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Estoque</a>';
			else
				echo '<a class="unselectable" href="estoque.php"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Estoque</a>';
			if($page == "vendedores")
				echo '<a class="unselectable active" href="#"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Vendedores</a>';
			else
				echo '<a class="unselectable" href="vendedores.php"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Vendedores</a>';
			if($page == "estatisticas")
				echo '<a class="unselectable active" href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;&nbsp;Estatísticas</a>';
			else
				echo '<a class="unselectable" href="estatisticas.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;&nbsp;Estatísticas</a>';
		}
	}
?>
</nav>