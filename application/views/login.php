<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1" />
	<title>Inicio de sesión</title>
	<link rel="stylesheet" href="<?=base_url()?>css/normalize.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>css/style-login.css">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 divLogin">
				<div class="iconLogin">
					<span class="glyphicon glyphicon-user spnUser" aria-hidden="true"></span>
				</div>
				<p>LOGIN DE USUARIOS</p>
				<div class="col-xs-6 col-xs-offset-3">
					<form action="<?=base_url()?>login/checkLogin" method="post">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								</div>
								<input type="text" name="txtUser" class="form-control" placeholder="usuario" required />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
								</div>
								<input type="password" name="txtPass" class="form-control" placeholder="contraseña" required />
							</div>
						</div>
						<div class="form-group col-xs-offset-2 col-sm-offset-4">
							<input type="submit" class="btn btn-lg btnSubmit" value="Validar usuario" />
						</div>
						<div class="form-group">
							<div class="col-xs-12 divMsj">
								<?=validation_errors()?>
								<?=$msj?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>