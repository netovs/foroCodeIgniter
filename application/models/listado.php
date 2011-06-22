<?php
class Listado extends CI_Model
{
	function temas($limit = NULL, $offset = NULL)
	{
		$this -> db -> select('*');
		$this -> db -> from('nuevo_foro');
		$this -> db -> limit($limit, $offset);
		$query = $this -> db -> get();
		
		return $query -> result();
		
	}
	
	function censuraRespuesta($_id)
	{
		$this -> db -> where('id', $_id);
		$dato = array('aprobado' => 0);
		$this -> db -> update('nuevo_foro_respuestas', $dato);
	}
	
	function apruebaRespuesta($_id)
	{
		$this -> db -> where('id', $_id);
		$dato = array('aprobado' => 1);
		$this -> db -> update('nuevo_foro_respuestas', $dato);
	}
	
	function eliminaRespuesta($_id)
	{
		$this -> db -> where('id', $_id);
		// $dato = array('aprobado' => 1);
		$this -> db -> delete('nuevo_foro_respuestas');
	}
	
	function saveTema($_id, $datos)
	{
		$this -> db -> where('id', $_id);
		$this -> db -> update('nuevo_foro', $datos);
	}
	
	function stop($id)
	{
		$dato = array('tema_status' => 0);
		$this -> db -> where('id', $id);
		$this -> db -> update('nuevo_foro', $dato);
	}
	
	function play($id)
	{
		$dato = array('tema_status' => 1);
		$this -> db -> where('id', $id);
		$this -> db -> update('nuevo_foro', $dato);
	}
	
	function publicaHoy($fecha)
	{
		$dato = array('tema_status' => 1);
		$this -> db -> where('tema_fecha', $fecha);
		$this -> db -> update('nuevo_foro', $dato);
	}
	
	function guardaTema($datos)
	{
		$this->db->insert('nuevo_foro', $datos);
	}
	
	function registraRespuesta($datos)
	{
		$this->db->insert('nuevo_foro_respuestas', $datos);
	}
	
	function count_temas()
	{
		return $this -> db -> count_all_results('nuevo_foro');
	}
	
	function count_respuestas($_idTema)
	{
		$this -> db -> where('nuevo_foro_id', $_idTema);
		$this -> db -> from('nuevo_foro_respuestas');
		$respuestasTema = $this -> db -> count_all_results();
		return $respuestasTema;
	}
	
	function respuestasDetalle($_idTema)
	{
		$this -> db -> select('*');
		$this -> db -> from('nuevo_foro_respuestas');
		$this -> db -> where('nuevo_foro_id', $_idTema);
		
		$query = $this -> db -> get();
		
		return $query -> result();

		
	}
	
	function temaDetalle($tema_id)
	{
		$this -> db -> select('*');
		$this -> db -> from('nuevo_foro');
		$this -> db -> where('id', $tema_id);
		
		$query = $this -> db -> get();
		
		return $query -> result();
		
	}
	
	
}
?>