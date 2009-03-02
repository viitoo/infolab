<?php
	if(!defined('BASEPATH')) 
		exit('No direct script access allowed');
		
	class Centinela
	{		
		var $_id = 0;
		var $_nick = "";
		var $_clave = "";
		var $_nivel = "";
					
		var $_auth = FALSE;
		
		function Centinela($auto = TRUE)
		{
			if($auto)
			{
				$CI =& get_instance();
				
				if($this->login($CI->session->userdata('nick'), $CI->session->userdata('clave')))
				{
					$this->_id = $CI->session->userdata('id');
					$this->_nick = $CI->session->userdata('nick');
					$this->_clave = $CI->session->userdata('clave');
					$this->_nivel = $CI->session->userdata('nivel');				
					$this->_sesion = $CI->session->userdata('sesion');				
					$this->_last = $CI->session->userdata('last');				
				}
			}
		}
		
		//--------------------------------------//
		
		function getId(){return $this->_id;}
		function getNick(){return $this->_nick;}
		function getClave(){return $this->_clave;}
		function getNivel(){return $this->_nivel;}
		
		//--------------------------------------//		
		
		function login($nick = "", $clave = "")
		{
			if(empty($nick)||empty($clave))
				return FALSE;
			
			$CI =& get_instance();		
				
			$sql = "SELECT * FROM `usuarios` WHERE `nick`=? AND `clave`=?";
			$query = $CI->db->query($sql, array($nick, $clave));
			
			//login ok
			if($query->num_rows()==1)
			{	
				$row = $query->row();
				
				$CI->session->set_userdata('id', $row->id);
				$this->_id = $row->id; 
				$CI->session->set_userdata('nick', $nick);
				$this->_nick = $nick;
				$CI->session->set_userdata('clave', $clave);
				$this->_clave = $row->clave;
				$CI->session->set_userdata('nivel', $row->nivel);				
				$this->_nivel = $row->nivel;
				
				$this->_auth = TRUE;
				
				return TRUE;
			}
			else
			{
				$this->_auth = FALSE;
				$this->logout();
				
				return FALSE;
			}
		}
		
		function logout()
		{
			$CI =& get_instance();
			$CI->session->sess_destroy();
			$this->_auth = FALSE;			
		}
		
		//--------------------------------------//
		
		function check($nivel = 0, $estricto = TRUE)
		{
			if(!$this->_auth)
				return FALSE;
				
			if($estricto)
			{
				if($nivel == $this->_nivel)
					return TRUE;
				else
					return FALSE;
			}
			else
			{
				if($nivel <= $this->_nivel)
					return TRUE;
				else
					return FALSE;				
			}
		}				
	}
?>