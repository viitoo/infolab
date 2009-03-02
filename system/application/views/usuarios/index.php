<?php if($this->uri->segment(3)=="reg_ok"): ?>
<p>Usuarios reigstrado correctamente.</p>
<?php endif; ?>
<?php if($this->uri->segment(3)=="log_ok"): ?>
<p>Has sido logueado correctamente.</p>
<?php endif; ?>
<?php if($this->uri->segment(3)=="reg_off"): ?>
<p>Has sido deslogueado correctamente</p>
<?php endif; ?>

<h3>Listado de usuarios</h3>
<?php if($query->num_rows()>0): ?>
	<ul>
	<?php foreach($query->result() as $row): ?>
		<li><?=$row->nick?></li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
<p>No hay ning&uacute;n usuario registrado.</p>
<?php endif; ?>
