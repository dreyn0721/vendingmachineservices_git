<?php include("init/database.php"); ?>
<?php include("init/main-functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="assets/js/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">



	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<meta name="description" content="<?=$description;?>">
	<meta name="author" content="<?=$author;?>" />
	<title><?=$pagetitle;?></title>

</head>
<body>

	<?php if( logged_in() ): ?>

		<header class="container">
			<nav class="main-nav-container navbar navbar-expand-lg ">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">
						<img src="assets/img/logoipsum-410.png">
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse main-nav-menu " id="navbarNavDropdown">
						<ul class="navbar-nav">


							
							<li class="nav-item ">
								<a class="nav-link" href="<?=$base_url;?>/logout.php">Logout</a>
							</li>

							
						</ul>
					</div>
				</div>
			</nav>
		</header>
	<?php else: ?>
		<header class="container-fluid p-0 mb-5">

			<div class="logo text-center pt-4 pb-4 bg-white">
			  <a class="navbar-brand" href="#">
			    <img src="assets/img/logoipsum-410.png">
			  </a>
			</div>

		</header>
	<?php endif; ?>


	<style type="text/css">
		.navbar-brand img{
		    max-width: 150px;
		}

		.main-nav-container .main-nav-menu{
		    justify-content: flex-end;
		    padding-right: 1rem;
		    padding-left: 1rem;
		}
		.main-nav-container .main-nav-menu .dropdown-menu{
		    /*left: unset;
		    right: 0;*/
		}

		.main-nav-container .main-nav-menu .navbar-nav{
		    align-items: center;
		}

		.main-nav-container .main-nav-menu .navbar-nav .nav-item{
		    margin-left: 15px;
		    margin-right: 15px;
		}

		.main-nav-container .main-nav-menu .nav-item.active .nav-link
		{
		    border-bottom: solid 1px #002469;
		    color: #002469;
		    font-weight: 700;
		}

		.main-nav-container .main-nav-menu .nav-item .nav-link{
		    font-weight: 500;
		}

		.main-nav-container .main-nav-menu .navbar-nav .nav-item .btn-container{
		    padding-left: 80px;
		    padding-right: 80px;
		}
		footer{
		    background-color: #f0f0f0;
		    padding: 20px 0;
		}
		footer .footer-text{
		    font-size: 12px;
		    margin: 0;
		}
		main.main-content{
		    min-height: 650px;
		    padding-bottom: 50px;
		}









		.response-container{
		  display: none;
		}

		.response-container ul{
		  padding: 0;
		  margin: 0;
		}
		.response-container ul li{
		  list-style-type: none;
		  color: #fff;
		  background-color: #DB2122;
		  padding: 10px 30px;
		  margin-bottom: 10px;
		  border-radius: 10px;
		}

		.response-container p{
		  color: #fff;
		  background-color: #316300;
		  padding: 10px 30px;
		  margin-bottom: 10px;
		  border-radius: 10px;
		}


	</style>

	<main class="main-content">