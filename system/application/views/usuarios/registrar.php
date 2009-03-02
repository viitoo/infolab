<fieldset>
	<legend>Registrar usuario</legend>
	<form action="index.php/usuarios/registrar" method="post">
    	<label for="nick">Nick</label>
    	<input type="text" name="nick" id="nick" />
        <br />
    	<label for="mail">Mail</label>
    	<input type="text" name="mail" id="mail" />
        <br />
    	<label for="clave">Clave</label>
    	<input type="password" name="clave" id="clave" />
        <br />
    	<label for="r_clave">Repetir clave</label>
    	<input type="password" name="r_clave" id="r_clave" />
        <br />
    	<label for="submit"></label>
    	<input type="submit" name="submit" id="submit" value="Registrar" />
    </form>
</fieldset>