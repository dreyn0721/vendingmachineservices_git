<?php 
include("init/database.php");
include("init/main-functions.php"); 
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="assets/js/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">


	<link href="assets/main.css" rel="stylesheet" crossorigin="anonymous">

	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />


	<meta name="description" content="<?=$description;?>">
	<meta name="author" content="<?=$author;?>" />
	<title><?=$pagetitle;?></title>


	<style>
	:root{
	  --primary:#292824;
	  --secondary:#1863DC;
	}

	html{
	  scroll-behavior:smooth;
	}

	body{
	  font-family: Arial, sans-serif;
	}

	/* ===== Section Divider ===== */
	.section-divider{
	  position: relative;
	}
	.section-divider::after{
	  content:"";
	  display:block;
	  height:60px;
	  background:linear-gradient(135deg, transparent 75%, rgba(0,0,0,0.05) 75%);
	}

	/* ===== Navbar ===== */
	.navbar{
	  background:#fff;
	}
	.navbar-brand img{
	  max-height:60px;
	}

	/* ===== Hero Section ===== */
	.hero{
	  background:
	    linear-gradient(to right, var(--primary), transparent),
	    url("https://dummyimage.com/800x400/000/fff");
	  background-size:cover;
	  background-position:center;
	  padding:100px 0;
	}
	.hero-card{
	  background:#fff;
	  border-radius:15px;
	  padding:40px;
	  width:70%;
	  margin-left:auto;
	}
	.hero-card h1{
	  color:var(--primary);
	}
	.stars i{
	  color:#f5b301;
	}

	/* ===== Section Titles ===== */
	.section-title{
	  color:var(--primary);
	  font-weight:bold;
	  margin-bottom:30px;
	}

	/* ===== Buttons ===== */
	.btn-primary{
	  background:var(--secondary);
	  border:none;
	}
	.btn-primary:hover{
	  background:#0f4fb5;
	}

	/* ===== Footer ===== */
	footer{
	  background:var(--primary);
	  color:#fff;
	}
	footer a{
	  color:#ddd;
	  text-decoration:none;
	}
	footer a:hover{
	  color:#fff;
	}
	.footer-bottom{
	  background:#cfd0d1;
	  color:#000;
	  text-align:center;
	  padding:10px;
	}



	
	</style>


</head>
<body>


	<!-- ===== Header / Navbar ===== -->
	<nav class="navbar navbar-expand-lg fixed-top shadow-sm">
	  <div class="container">
	    <a class="navbar-brand" href="#">
	      <img src="https://dummyimage.com/200x80/000/fff&text=LOGO">
	    </a>

	    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
	      <span class="navbar-toggler-icon"></span>
	    </button>

	    <div class="collapse navbar-collapse" id="navMenu">
	      <ul class="navbar-nav ms-auto align-items-lg-center">
	        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>">Home</a></li>
	        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>/blog.php">Blog</a></li>

	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="<?php echo $base_url; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">About Us</a>
	          <ul class="dropdown-menu">
	            <li><a class="dropdown-item" href="<?php echo $base_url; ?>">Company</a></li>
	            <li><a class="dropdown-item" href="<?php echo $base_url; ?>">Services</a></li>
	          </ul>
	        </li>

	        
	        <?php if( logged_in() ): ?>
				<li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>/logout.php">Logout</a></li>
			<?php else: ?>
				<li class="nav-item">
					<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#authModal">
						Login
					</a>
				</li>
			<?php endif; ?>

	        <li class="nav-item ms-lg-3">
	          <a href="<?php echo $base_url; ?>#contactForm" class="btn btn-primary scroll-to-form">Reach Us Out</a>
	        </li>



	      </ul>
	    </div>
	  </div>
	</nav>

	<?php include("template-parts/auth-modal.php"); ?>
	<div style="height:90px"></div>