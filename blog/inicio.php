<?php
    /*
	En esta página el usuario que esté registrado podra acceder al contenido del blog

	Ademas podrá acceder a una zona de administrador utilizando la cuanta asociada al mail 'admin@prueba.com'

	*/
    session_start();
    
    if (!isset($_SESSION['loggedin'])) {//Si no tienes sesion iniciada te devulve a la pagina de inicio
        header('Location: /index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Loged in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="/styles/forumStyles.css">

</head>
<body>
	<header>
		<h1 class="display-1">Bienvenido a nuestro blog</h1>
	</header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark	">
		<div class="container-fluid">
			<a class="navbar-brand text-info" href="#"><i class="bi bi-house"></i> Página principal</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active " aria-current="page" href="#">Post Campamento</a>
			
					</li>
					<li class="nav-item">
						<a class="nav-link active " aria-current="page" href="#">Post Campus</a>
					</li>
				</ul>
				<ul class="navbar-nav mb-2 mb-lg-0 navbar-right">
					
					<a class="nav-link active text-danger" href="../logout.php">Salir <i class="bi bi-box-arrow-right"></i></a>

					<?php 

					if ($_SESSION['name'] == 'admin@prueba.com' && $_SESSION['loggedin']) {//Posible acceso a la zona de Admin
					echo '<a class="nav-link active text-info" href="../../adminArea/mainAdminArea.php">Admin</a>';
                	}
                	?>

				</ul>
			</div>
		</div>
	</nav>

	<br><br>

	<div class="card mb-6" style="margin:50px 50px">
		<div class="row g-0">
			<div class="col-md-4">
			<img src="../img/example.png" alt="primer dia!" class="rounded img-fluid">
			</div>
			<div class="col-md-8">
			<div class="card-body">
				<h5 class="card-title text-primary">POST 1</h5>
				<p class="card-text-1">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!

				</p>
				<p class="card-text" style="position: absolute;bottom: 0;margin: 10px 10px;;"><small class="text-muted">27 de Julio</small></p>
			</div>
			</div>
		</div>
	</div>

	<div class="card mb-6" style="margin:50px 50px">
		<div class="row g-0">
			<div class="col-md-4">
			<img src="../img/example.png" alt="primer dia!" class="rounded img-fluid">
			</div>
			<div class="col-md-8">
			<div class="card-body">
				<h5 class="card-title text-primary">POST 4</h5>
				<p class="card-text-1">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!

				</p>
				<p class="card-text" style="position: absolute;bottom: 0;margin: 10px 10px;;"><small class="text-muted">27 de Julio</small></p>
			</div>
			</div>
		</div>
	</div>

	<div class="card mb-6" style="margin:50px 50px">
		<div class="row g-0">
			<div class="col-md-4">
			<img src="../img/example.png" alt="primer dia!" class="rounded img-fluid">
			</div>
			<div class="col-md-8">
			<div class="card-body">
				<h5 class="card-title text-primary">POST 3</h5>
				<p class="card-text-1">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ducimus tempora ratione nemo officia enim. 
					Saepe, ut iste ex recusandae error quod tempore cum eos molestiae ab quos, dolorum quidem!

				</p>
				<p class="card-text" style="position: absolute;bottom: 0;margin: 10px 10px;;"><small class="text-muted">27 de Julio</small></p>
			</div>
			</div>
		</div>
	</div>

		
	</div>
	<br>
	<nav aria-label="Navegacion entre post">
		<ul class="pagination justify-content-center">
		  <li class="page-item disabled">
			<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
		  </li>
		  <li class="page-item"><a class="page-link" href="#">1</a></li>
		  <li class="page-item"><a class="page-link" href="#">2</a></li>
		  <li class="page-item"><a class="page-link" href="#">3</a></li>
		  <li class="page-item">
			<a class="page-link" href="#">Siguiente</a>
		  </li>
		</ul>
	  </nav>

</body>
</html>