<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * undocumented class
 *
 * @package default
 * @author /bin/bash: niutil: command not found
 **/
class Noticias extends Controller {


	function Noticias()
	{
		parent::Controller();
		log_message('debug', 'classname Controller Initialized');
		$this->load->scaffolding('noticias');
		
		// code...
	}


	function Index()
	{
		
	}
	function Leer()
	{  	 
	  $this->load->view('cabezera');
      $variables['numero'] = $this->uri->segment(3);
	  $this->load->view('/noticias/leer', $variables);
      $this->load->view('barraderecha');
      $this->load->view('pie');
	}

}
?>