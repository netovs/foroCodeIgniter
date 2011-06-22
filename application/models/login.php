<?php
/**
 * @param nombre de usuario
 * @param password
 * @author Néstor Velázquez
 * @access Base de datos bufetena_abogados
 **/

class Login extends CI_Model
{
	function verifica($username, $password)
	{
		$this -> db -> select('usu_nomb, usu_codi');
		$this -> db -> from('usuarios');

		$this -> db -> where("usu_mail = '" . $username ."'");
		$this -> db -> where("usu_clav = '" . $password . "'");
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() == 1)
		{
			return $query -> result();
		}
		else
		{
			return false;
		}
	}
}
?>