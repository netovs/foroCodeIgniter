<?php
if ( ! defined('BASEPATH')) exit('¿Que hubule, inyectar scripts de nuevo, trucos sucios viejo? no más');
class Foro extends CI_Controller {

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
	
	function registraRespuesta($_id)
	{
		if(@IS_AJAX)
		{
			$this -> load -> model ('listado');
			$nombre = $this -> input -> post('nombre');
			$respuesta = $this -> input -> post('opinion');
			$email = $this -> input -> post('email');
			
			$captcha = $this -> session -> userdata('captcha');
			
			// echo $captcha;
			
			$this -> form_validation -> set_rules('nombre', 'Nombre', 'required|trim');
    		$this -> form_validation -> set_rules('email', 'Correo electr&oacute;nico', 'required|trim|valid_email');
    		
    		// $this -> form_validation -> set_rules('cvesp', 'Valor de seguridad', 'required|callback_checaSuma');
    		
    		$this -> form_validation -> set_error_delimiters('<div class="error">', '</div>');
    		
			if($this->form_validation->run() == FALSE)
			{
	            echo validation_errors();
            }
            else
            {
				$hoy = @date(Y.'-'.m.'-'.d);
				
				$datos = array(
				'nuevo_foro_id' => $_id,
				'nombre' => strip_tags($nombre),
				'email' => strip_tags($email),
				'aprobado' => 0,
				'respuesta' => strip_tags($respuesta),
				'fecha_respuesta' => $hoy
				);
				
				$this -> listado -> registraRespuesta($datos);
				echo '<div class="ok" style="width: 200% !important;">Gracias, su comentario espera moderaci&oacute;n</div>';
            }
            
            

            }
            else
            {
				echo "¿inyectar scripts de nuevo, trucos sucios viejo? no más";
			}
	}
	

	
	function detalleTema($_id)
	{
			$this -> load -> model ('listado');
			$data = array();
			$tms = array();
			$data['title'] = 'Tema de foro';
			

			$valor1 = rand(0,9);
			$valor2 = rand(0,9);
			
			$data['valor1'] = $valor1;
			$data['valor2'] = $valor2;
			
			$resp = $valor1 + $valor2;
			
			$data['resp'] = $resp;
			

			$temas = $this -> listado -> temaDetalle($_id);
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
			
			
			$this -> load -> view('tema', $data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>
