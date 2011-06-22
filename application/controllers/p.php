<?php
if ( ! defined('BASEPATH')) exit('¿Que hubule, inyectar scripts de nuevo, trucos sucios viejo? no más');
class P extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this -> load -> library('form_validation');
	}

	function index()
	{
		// $this->load->view('welcome_message');
		$data = array();
		$this -> load -> model('listado');
		$this -> load -> library('pagination');
		$per_page = 10;
		$total = $this -> listado -> count_temas();
			

			
		// echo $this -> uri -> segment(4);
			
		$temas = $this -> listado -> temas($per_page, (int)$this -> uri -> segment(3));
			
		if($temas)
		{
			foreach($temas as $cl)
			{
				$tms[] = array('id' => $cl -> id,
				'tema' => $cl -> tema_foro,
				'descripcion' => $cl -> descripcion_tema,
				'imagen' => $cl -> imagen_foro,
				'fecha' => $cl -> tema_fecha,
				'status' => $cl -> tema_status,
				'texto' => $cl -> texto_foro);
					
				$resp = $this -> listado -> count_respuestas($cl -> id);
					
				$rspts = $this -> listado -> respuestasDetalle($cl -> id);
				if($rspts)
				{
					foreach ($rspts as $resptsa):
					
					$respDetalle[] = array( 
					'id' => $resptsa -> id,
					'nuevo_foro_id' => $resptsa -> nuevo_foro_id,  
					'nombre' => $resptsa -> nombre,
					'email' => $resptsa -> email,
					'aprobado' => $resptsa -> aprobado,
					'respuesta' => $resptsa -> respuesta,
					'fecha' => $resptsa -> fecha_respuesta
					); 
						
					endforeach;
				}			

			}
				
				$data['respuestas'] = $resp;
				$data['respuestasDetalle'] = @$respDetalle;
				
				$data['temas'] = $tms;
				$config['base_url'] = BASE_URL . 'foro/p/';
				$config['total_rows'] = $total;
				$config['per_page'] = $per_page;


			
				$this -> pagination -> initialize($config);
		}
		
		
		$this -> load -> view('foro_view_index', $data);
	}
	
	
	function p()
	{
		// $this->load->view('welcome_message');
		$data = array();
		$this -> load -> model('listado');
		$this -> load -> library('pagination');
		$per_page = 10;
		$total = $this -> listado -> count_temas();
			

			
		// echo $this -> uri -> segment(4);
			
		$temas = $this -> listado -> temas($per_page, (int)$this -> uri -> segment(3));
			
		if($temas)
		{
			foreach($temas as $cl)
			{
				$tms[] = array('id' => $cl -> id,
				'tema' => $cl -> tema_foro,
				'descripcion' => $cl -> descripcion_tema,
				'imagen' => $cl -> imagen_foro,
				'fecha' => $cl -> tema_fecha,
				'status' => $cl -> tema_status,
				'texto' => $cl -> texto_foro);
					
				$resp = $this -> listado -> count_respuestas($cl -> id);
					
				$rspts = $this -> listado -> respuestasDetalle($cl -> id);
				if($rspts)
				{
					foreach ($rspts as $resptsa):
					
					$respDetalle[] = array( 
					'id' => $resptsa -> id,
					'nuevo_foro_id' => $resptsa -> nuevo_foro_id,  
					'nombre' => $resptsa -> nombre,
					'email' => $resptsa -> email,
					'aprobado' => $resptsa -> aprobado,
					'respuesta' => $resptsa -> respuesta,
					'fecha' => $resptsa -> fecha_respuesta
					); 
						
					endforeach;
				}			

			}
				
				$data['respuestas'] = $resp;
				$data['respuestasDetalle'] = @$respDetalle;
				
				$data['temas'] = $tms;
				$config['base_url'] = BASE_URL . 'foro/p/';
				$config['total_rows'] = $total;
				$config['per_page'] = $per_page;


			
				$this -> pagination -> initialize($config);
		}
		
		
		$this -> load -> view('foro_view_index', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>
