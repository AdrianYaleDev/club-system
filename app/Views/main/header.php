<!doctype html>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta name="description" content="Our first page">
<meta name="keywords" content="html tutorial template">
</head>
<header class="bg-light">

	<?php echo $css; ?>

	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light ">
			<a class="navbar-brand" href="/">
				<img src="/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="Bootstrap">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
		
					<li class="nav-item">
						<a class="nav-link" href="pricing">Pricing</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="product">Product</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="register">Register</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact-us">Contact Us</a>
					</li>
					<!-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown link
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li> -->
				</ul>
			</div>
		</nav>
	</div>	
</header>