<div class="col-md-8">
	<header class="menu-new">
		<nav>
			<ul>
				<li>
					<a href="#">Inicio</a>
				</li>
				<li>
					<a href="#">Productos <span class="glyphicon glyphicon-triangle-bottom"></span></a>
					<ul>
						<?php foreach ($secciones->result() as $row) 
						{?>
							<li>
								<a href="#"> <?=$row->seccion?></a>
							</li>
						<?php }?>
					</ul>
				</li>
				<li>
					<a href="#">Marcas <span class="glyphicon glyphicon-triangle-bottom"></span></a>
					<ul>
						<?php foreach ($marcas->result() as $row) {?>
							<li>
								<a href="#"><?=$row->marca?></a>
							</li>
						<?php }?>
					</ul>
				</li>
				<li>
					<a href="#">Contacto</a>
				</li>
				<li>
					<a href="#">
						Cart
					</a>
				</li>
			</ul>
		</nav>
	</header>
</div>