<?php
class Usuarios extends Controller 
{
	function Usuarios()
	{
		parent::Controller();	
	}
	/*
		CREATE TABLE `usuarios` (
		  `id` int(11) NOT NULL auto_increment,
		  `nick` varchar(50) NOT NULL,
		  `clave` varchar(50) NOT NULL,
		  `mail` varchar(50) NOT NULL,
		  `nivel` tinyint(1) NOT NULL,  
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 ;	
	*/
	function index()
	{
		$this->load->view("cabecera");
		$datos['query'] = $this->db->get('usuarios');
		$this->load->view("usuarios/index", $datos);
		$this->load->view("pie");		
	}
	
	function registrar()
	{
		//cargo la libreria
		$this->load->library('validation');	
	
		//aplicamos reglas
		$reglas['nick']			="trim|required|callback__check_user";
		$reglas['mail']			="trim|required|valid_email";		
		$reglas['clave']		="trim|required|matches[r_clave]";
		$reglas['r_clave']		="trim|required";
		
		
		$this->validation->set_rules($reglas);
		
		//damos nombres
		$campos['nick']			="Nick";
		$campos['mail']			="Mail";
		$campos['clave']		="Clave";
		$campos['r_clave']		="Repetir clave";
		
		$this->validation->set_fields($campos);				
		
		//delimitadores
		$this->validation->set_error_delimiters('<span class="error">', '</span><br />');
		
		//si hay error o es la primera vez que ejecutamos
		if(!$this->validation->run())
		{
			$this->load->view("cabecera");
			$this->load->view('usuarios/registrar');	
			$this->load->view("pie");
		}
		//todo correcto
		else
		{
			$this->db->query("INSERT INTO `usuarios` (`nick`, `clave`, `mail`, `nivel`) VALUES (?,?,?,'1')", array($_POST['nick'], sha1($_POST['clave']), $_POST['mail']));
			redirect("usuarios/index/reg_ok");			
		}	
	}
	
			//Callback comprobacion de usuario
			function _check_user($nick)
			{
				//comprobar que exista
				$this->db->where('nick', $nick);
				$q = $this->db->get('usuarios');
				
				//devuelve error
				if ($q->num_rows() == 1)
				{
					$this->validation->set_message('_check_user', 'El usuario %s esta elegido, elige otro.');
					return FALSE;
				}
				else
				{
					return TRUE;
				}			
			}	
	
	function login()
	{
		//cargo la libreria
		$this->load->library('validation');		
		//aplicamos reglas
		$reglas['nick']			="trim|required";
		$reglas['clave']		="trim|required";
		
		$this->validation->set_rules($reglas);
		
		//damos nombres
		$campos['nick']			="Nick";
		$campos['clave']		="Clave";
		
		$this->validation->set_fields($campos);				
		
		//delimitadores
		$this->validation->set_error_delimiters('<span class="error">', '</span><br />');
		
		//si hay error o es la primera vez que ejecutamos
		if(!$this->validation->run())
		{
			$this->load->view('cabecera');
			$this->load->view('usuarios/login');	
			$this->load->view('pie');
		}
		//todo correcto
		else
		{
			$nick = $_POST['nick'];
			$password = sha1($_POST['clave']);
			$recordar = FALSE;
			$centinela = new Centinela(FALSE);
			if($centinela->login($nick, $password, $recordar))
				redirect('usuarios/index/log_ok');
			else
				redirect('usuarios/login/error_ok');
		}
	
	}
	
	function logout()
	{
		$centinela = new Centinela(FALSE);
		$centinela->logout();
		redirect("usuarios/index/log_off");
	}
	
	function privado()
	{
		$this->load->view('cabecera');
		$this->load->view('usuarios/privado');	
		$this->load->view('pie');	
	}
}
?>