
<form action="<?php echo $action;?>" method="POST" accept-charset="UTF-8" role="form">
	<fieldset>
		<div class="form-group">
			<input class="form-control" placeholder="<?php echo UTF8::ucfirst(__('username'));?>" name="username" type="text" value="<?php echo $username;?>">
		</div>
		<div class="form-group">
			<input class="form-control" placeholder="<?php echo UTF8::ucfirst(__('email'));?>" name="email" type="email" value="<?php echo $email;?>">
		</div>
		<div class="form-group">
			<input class="form-control" placeholder="<?php echo UTF8::ucfirst(__('password'));?>" name="password" type="password" value="">
		</div>
		<div class="form-group">
			<input class="form-control" placeholder="<?php echo UTF8::ucfirst(__('password confirm'));?>" name="password_confirm" type="password" value="">
		</div>
		<?php if($captcha_view):?>
		<div class="form-group input-group">
			<span class="input-group-addon"><?php echo $captcha_view;?></span>
			<input class="form-control" placeholder="<?php echo UTF8::ucfirst(__('answer'));?>" name="captcha" type="text" value="">
		</div>
		<?php endif;?>
		<?php echo Form::hidden('csrf', $csrf);?>
		<button type="submit" class="btn btn-primary btn-block"><?php echo UTF8::ucfirst(__('sign up'));?></button>
	</fieldset>
</form>
