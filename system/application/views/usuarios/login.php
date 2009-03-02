<?php if($this->uri->segment(3)=="error_ok"): ?>
<p>Login erroneo.</p>
<?php endif; ?>
<fieldset>
	<legend>Login</legend>
	<form action="index.php/usuarios/login" method="post">
    	<label for="nick">Nick</label>
    	<input type="text" name="nick" id="nick" />
        <br />
    	<label for="clave">Clave</label>
    	<input type="password" name="clave" id="clave" />
        <br />
    	<label for="submit"></label>
    	<input type="submit" name="submit" id="submit" value="Login" />
    </form>
</fieldset>