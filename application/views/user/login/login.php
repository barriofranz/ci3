<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<br/>
<div class="container">
	<div class="row">
		<?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="col-md-12">

			<form action="<?= base_url('login') ?><?= ($loginMode ? '?admin=' . $loginMode : '') ?> " method="post" accept-charset="utf-8">

				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Your username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Your password">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Login">
				</div>
				<input type="hidden" value="<?= $loginMode ?>" name="loginMode">
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->
