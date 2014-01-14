
<form action="<?php echo $action;?>" method="POST" accept-charset="UTF-8" role="form">
	<fieldset>
		<div class="form-group">
			<input class="form-control" placeholder="<?php echo UTF8::ucfirst(__('login').' or '.__('email'));?>" name="login" type="text" value="<?php echo $login;?>">
		</div>
		<div class="form-group">
			<input class="form-control" placeholder="<?php echo UTF8::ucfirst(__('password'));?>" name="password" type="password" value="">
		</div>
		<?php if($captcha_view):?>
		<div class="form-group input-group">
			<span class="input-group-addon"><?php echo $captcha_view;?></span>
			<input class="form-control" placeholder="<?php echo UTF8::ucfirst(__('answer'));?>" name="captcha" type="text" value="">
		</div>
		<?php endif;?>
		<div class="checkbox">
			<label>
				<?php echo Form::checkbox('remember', '1', $remember);?> <?php echo UTF8::ucfirst(__('remember me'));?>
			</label>
		</div>
		<?php echo Form::hidden('csrf', $csrf);?>
		<button type="submit" class="btn btn-primary btn-block"><?php echo UTF8::ucfirst(__('login'));?></button>
	</fieldset>
</form>
