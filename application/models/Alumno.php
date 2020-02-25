<?php

class Alumno extends CI_Model {

	public function RegistraAlumno($data){
		if (!$this->db->insert('ALUMNOS',$data)) 
		{
			return false;
		}
		return $this->db->insert_id();

	}

	public function MostrarAlumnos($matricula){
		$has=$this->db->select('*')
						->from('ALUMNOS')
						->where('id_alumno',$matricula)
						->get()
						->row_array();
		return $has;
	}

	public function Actulizardatos($matricula,$data){
		$this->db->where('id_alumno',$matricula);
			return $this->db->update('ALUMNOS',$data);
	}

	public function verificasion($maricula){
		$has=$this->db->select('*')
						->from('pagosalumnos')
						->where('iddealumnos_fk',$maricula)
						->where('pago_año',date('y'))
						->order_by('ultimasemanadepago','DESC')
						->order_by('fechadepago','DESC')
						->get()
						->row_array();
		return $has;
	}

	public function guadarpagos($data){
		if (!$this->db->insert('pagosalumnos',$data))
		{
			return false;
		}
		return $this->db->insert_id();
	}
	public function insertarcolegitura($datos){
		if (!$this->db->insert('Colegituras',$datos)) 
		{
			return false;
		}
		return true;
	}
	public function Matricula(){
		$matricula=$this->db->select('id_alumno')
							->from('alumnos')
							->order_by('id_alumno','DESC')
							->get()
							->row_array();
		return $matricula;
	}

}