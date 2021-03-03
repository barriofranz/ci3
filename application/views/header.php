<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Site title</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
<!--

	<link href="<?= base_url('/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('/css/custom/custom.css') ?>" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" rel="stylesheet">

	<script src="<?= base_url('/js/bootstrap.min.js') ?>" /></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" ></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>


	jQuery Modal
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />



	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>


<body>

	<header id="site-header">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">

						<a class="navbar-brand" href="<?= base_url() ?>">Home</a>
						-

						<?php if (isset($_SESSION['username']) && ($_SESSION['logged_in'] === true)  && $_SESSION['loginMode'] == 0 ) : ?>

							<a href="<?= base_url('viewOrders') ?>">View Transactions</a></li> -
							<a href="<?= base_url('logout') ?>">Logout</a></li>
						<?php elseif (isset($_SESSION['username']) && ($_SESSION['logged_in'] === true)  && $_SESSION['loginMode'] == 1 ) : ?>
							<a href="<?= base_url('adminProducts') ?>">Products</a></li> -
							<a href="<?= base_url('adminCustomers') ?>">Customer</a></li> -
							<a href="<?= base_url('adminOrders') ?>">Transactions</a></li> -
							<a href="<?= base_url('logout') ?>">Logout</a></li>
						<?php else : ?>
							<a href="<?= base_url('register') ?>">Register</a></li> -
							<a href="<?= base_url('login') ?>">Login</a></li> -
							<a href="<?= base_url('login') ?>?admin=1">Admin</a></li>
						<?php endif; ?>

				</div><!-- .navbar-collapse -->
			</div><!-- .container-fluid -->
		</nav><!-- .navbar -->
	</header><!-- #site-header -->

	<main id="site-content" role="main">

		<?php if (isset($_SESSION)) : ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php //var_dump($_SESSION); ?>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		<?php endif; ?>
