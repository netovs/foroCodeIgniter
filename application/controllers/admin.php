<?php if ( ! defined('BASEPATH')) exit('¿Que hubule, inyectar scripts de nuevo, trucos sucios viejo? no más');
class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this -> load -> library('form_validation');
	}
	
	function index()
	{
		$this -> load -> helper('form');
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$this -> load -> model('listado');
			$fecha = @date(Y.'-'.m.'-'-d);
			$this -> listado -> publicaHoy($fecha);
			redirect('admin/listado', 'refresh');
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		} 
	}
	
	function eliminaRespuesta($_id)
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$this -> load -> model('listado');
			$this -> listado -> eliminaRespuesta($_id);
			redirect('admin/listado', 'refresh');
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		} 
	}
	
	function censuraRespuesta($_id)
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$this -> load -> model('listado');
			$this -> listado -> censuraRespuesta($_id);
			redirect('admin/listado', 'refresh');
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		} 
	}
	
	function seliminaRespuesta($_id)
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$this -> load -> model('listado');
			$this -> listado -> censuraRespuesta($_id);
			redirect('admin/listado', 'refresh');
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		}
	}

	
	function apruebaRespuesta($_id)
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$this -> load -> model('listado');
			$this -> listado -> apruebaRespuesta($_id);
			redirect('admin/listado', 'refresh');
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		} 
	}
	
	
	function editaTema($_id)
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$this -> load -> model ('listado');
			$data = array();
			$tms = array();
			$data['title'] = 'Editar tema de foro';
			$data['javascript'] = 1;
			$data['jquery'] = BASE_URL . 'static/javascript/jquery.js';
			$data['tinyMce'] = BASE_URL . 'static/javascript/tinymce/tiny_mce.js';
			$data['tinyMceJquery'] = BASE_URL . 'static/javascript/tinymce/jquery.tinymce.js';
			$data['uicore'] = BASE_URL . 'static/javascript/ui.core.js';
			$data['uiwidget'] = BASE_URL . 'static/javascript/uiwidget.js';
			$data['datepicker'] = BASE_URL . 'static/javascript/datepicker.js';
			
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
			}
			$data['temas'] = $tms;
			
			
			$this -> load -> view('admin/editaTema', $data);
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		} 
	}
	
	function saveTema($_id)
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$this -> load -> model ('listado');
			$titulo = $this -> input -> post('titulo');
			$descripcion = $this -> input -> post('descripcion');
			$fecha = $this -> input -> post('fecha');
			$detalle = $this -> input -> post('detalle');
			
			$datos = array(
				'tema_foro' => $titulo, 
				'descripcion_tema' => $descripcion, 
				'texto_foro' => $detalle, 
				'tema_fecha' => $fecha
			);
			
			$this -> listado -> saveTema($_id, $datos);
			redirect('admin/listado', 'refresh');
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		}
	}
	
	function detienePublicacion($_id)
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$this -> load -> model ('listado');
			// echo $_id;
			$this -> listado -> stop($_id);
			redirect('admin/listado', 'refresh');
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		} 
	}
	
	function publicTema($_id)
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$this -> load -> model ('listado');
			// echo $_id;
			$this -> listado -> play($_id);
			redirect('admin/listado', 'refresh');
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		} 
	}
	
	function guardaNuevo()
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$data = array();
			$this -> load -> model ('listado');
			$titulo = $this -> input -> post('titulo');
			$descripcion = $this -> input -> post('descripcion');
			$detalle = $this -> input -> post('detalle');
			$fecha = $this -> input -> post('fecha');
			
			$this -> load -> library('form_validation');
			$this -> form_validation -> set_rules('titulo', 'titulo', 'required');

			
		
			if($this -> form_validation -> run() == FALSE)
			{
				$data['error'] = 'El tit&uacute;lo es obligatorio';
				$this -> load -> view('admin/nuevo', $data);
			}
			else
			{
				$hoy = @date(Y.'-'.m.'-'.d);
				if($fecha == $hoy)
				{
					$status = 1;
					$fecha = $fecha ; 
				}
				else
				{
					$status = 0;
					$fecha = $hoy ;
				}
				
				$datos = array(
				'tema_foro' => $titulo, 
				'descripcion_tema' => $descripcion, 
				'texto_foro' => $detalle, 
				'tema_status'=> $status,
				'tema_fecha' => $fecha
				);
				
				$this -> listado -> guardaTema($datos);
			}
			redirect('admin/listado', 'refresh');
			
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		} 
		
	}
	
	function nuevo()
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$data = array();
			$data['title'] = 'Nuevo tema de foro';
			$data['javascript'] = 1;
			$data['jquery'] = BASE_URL . 'static/javascript/jquery.js';
			$data['tinyMce'] = BASE_URL . 'static/javascript/tinymce/tiny_mce.js';
			$data['tinyMceJquery'] = BASE_URL . 'static/javascript/tinymce/jquery.tinymce.js';
			$data['uicore'] = BASE_URL . 'static/javascript/ui.core.js';
			$data['uiwidget'] = BASE_URL . 'static/javascript/uiwidget.js';
			$data['datepicker'] = BASE_URL . 'static/javascript/datepicker.js';

			$this -> load -> view('admin/nuevo', $data);
		
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		}
	}
	
	function listado()
	{
		$session_id = $this -> session -> userdata('logged_in');
		if($session_id)
		{
			$data = array();
			$data['title'] = 'Listado de temas del foro';
			$this -> load -> model('listado');
			$this -> load -> library('pagination');
			$data['javascript'] = 1;
			$data['jquery'] = BASE_URL . 'static/javascript/jquery.js';
			$data['ddaccordion'] = BASE_URL . 'static/javascript/ddaccordion.js';
			
			$data['tinyMce'] = BASE_URL . 'static/javascript/tinymce/tiny_mce.js';
			$data['tinyMceJquery'] = BASE_URL . 'static/javascript/tinymce/jquery.tinymce.js';
			$data['uicore'] = BASE_URL . 'static/javascript/ui.core.js';
			$data['uiwidget'] = BASE_URL . 'static/javascript/uiwidget.js';
			$data['datepicker'] = BASE_URL . 'static/javascript/datepicker.js';
			
			
			
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
				$config['base_url'] = BASE_URL . 'admin/listado/';
				$config['total_rows'] = $total;
				$config['per_page'] = $per_page;


			
				$this -> pagination -> initialize($config);
				

				
			}
			else
			{
				$data['sinTemas']  = 'Actualmente no existen temas registrados.';
			}
			
			$this -> load -> view('admin/listado', $data);
			
		}
		else
		{
			$this -> load -> view('admin/index', 'refresh');
		} 
		
	}
	
	function verify()
	{
		$this-> load -> helper('form');
		$this -> load -> model('login');
		$data = array();
		$data['title'] = 'Foro.';
		if($this -> input -> post('username'))
		{ // Verificamos si llega mediante post el username

			$rules = array(
			array('field'=>'username','label'=>'username','rules'=>'required'),
			array('field'=>'password','label'=>'password','rules'=>'required')
			);//Reglas de validación en este caso solo es requerido que los campos tengan contenido


			$this -> form_validation -> set_rules($rules); // Establecemos las reglas de validacion

			if($this -> form_validation->run() == FALSE)
			{ //Si la informacion no fue correctamente enviada
				$this -> load -> view('admin/index'); //Carga la vista de login
			}
			else
			{
				$username = $this -> input -> post('username');
				$password = $this -> input -> post('password');
				$result = $this -> login -> verifica($username, $password);
				//Llamamos a la función login dentro del modelo common mandando los argumentos password y username

				if($result)
				{ //login exitoso
					$sess_array = array();
					foreach($result as $row)
					{

						$sess_array = array(
						'id' => $row -> usu_codi,
						'nombre' => $row -> usu_nomb
						);

						$this -> session -> set_userdata('logged_in', $sess_array); //Iniciamos una sesión con los datos obtenidos de la base.
					}
					redirect('admin/listado', 'refresh');
				}
				else
				{ // La validación falla
					$data['error'] = 'Nombre de usuario / Password Incorrecto.'; //Error que será enviado a la vista en forma de arreglo
					$this -> load -> view('admin/index', $data); //Cargamos el mensaje de error en la vista.
				}
			}
		}
		else
		{
			$this -> load -> view('admin/index'); 
		}
		
	}
	
}
