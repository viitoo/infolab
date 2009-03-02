<?php 
	$centinela = new Centinela();
	if(!$centinela->check(0, FALSE)): 
?>
<p>Lo siento, esta secci&oacute;n es para usuarios registrados.</p>
<?php else: ?>
<p>Hola <?=$centinela->getNick()?>!<br />Esto es una secci&oacute;n privada de la web.</p>
<?php endif; ?>