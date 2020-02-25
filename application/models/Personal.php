<?php

class Personal extends CI_Model {

	public function Registrarusuario($nombre,$correo,$contraseña){

		$password=$this->bcrypt->hash_password($contraseña);
		$datos=array('NOMBRE_PERSONA' => $nombre, 
						'CORREO_PERSONA' => $correo, 
						'CONTRASENA_PERSONA' => $password,);

		if (!$this->db->insert('Personal_institutional',$datos)) {
				return false;
		}
		return true;
	}

	public function Verificandousuario($correo){
		$this->db->select('*');
		$this->db->from('Personal_institutional');
		$this->db->where('CORREO_PERSONA',$correo);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function iniciosecion($correo,$contrasena){
		$has=$this->db->select('*')
						->from('Personal_institutional')
						->where('CORREO_PERSONA',$correo)
						->get()
						->row_array();
		
		$pas=$this->bcrypt->check_password($contrasena, $has['CONTRASENA_PERSONA']);
		if($pas){
			return $has;
		}else{
            $this->session->set_flashdata('error',"Por favor verifica que tu usuario y contraseña están escritos correctamente");
			 redirect('Login/login');
		}
	}
}