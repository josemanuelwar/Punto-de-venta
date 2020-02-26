<?php

class Cortesdeldia extends CI_Model {

	public function cortedia($Fecha){
		$has=$this->db->select('*')
						->from('ALUMNOS,pagosalumnos,	Personal_institutional	')
						->where('fechadepago',$Fecha)
						->where('idpersonadepago_fk=PERSONAL_ID')
						->where('iddealumnos_fk=id_alumno')
						->get()
						->result_array();
		return $has;
	}

	public function cortenumerosemana($numerodesemana){
		$has=$this->db->select('*')
						->from('ALUMNOS,pagosalumnos,Personal_institutional	')
						->where('semandepago',$numerodesemana)
						->where('idpersonadepago_fk=PERSONAL_ID')
						->where('iddealumnos_fk=id_alumno')
						->where('pago_año',date('y'))
						->get()
						->result_array();
		return $has;
	}

	public function eliminar($folio,$data){
		$this->db->where('foliodepagos',$folio);
		return $this->db->update('pagosalumnos',$data);
	}

	public function sumadeingresos($Fecha){
		$total=$this->db->select('SUM(totalpago)')
						->from('pagosalumnos')
						->where('fechadepago',$Fecha)
						->where('Eliminarpagos',0)
						->get()
						->result_array();
		return $total;
	}

	public function sumadeingresosnumerodesemana($numero){
		$total=$this->db->select('SUM(totalpago)')
						->from('pagosalumnos')
						->where('semandepago',$numero)
						->where('Eliminarpagos',0)
						->where('pago_año',date('y'))
						->get()
						->result_array();
		return $total;
	}

	public function historial($matricula){
		$has=$this->db->select('*')
						->from('ALUMNOS,pagosalumnos,Personal_institutional')
						->where('id_alumno',$matricula)
						->where('id_alumno=iddealumnos_fk')
						->where('idpersonadepago_fk=PERSONAL_ID')
						->where('Eliminarpagos',0)
						->get()
						->result_array();
		return $has;
	}

	public function colegiaturas($folios){
		$has=$this->db->select('*')
						->from('Colegituras')
						->where('folio_fk_id',$folios)
						->get()
						->result_array();
		return $has;
	}

	public function exel($Fecha){
		$has=$this->db->select('id_alumno,nombre_alumno,colegiatura_alumno,	NOMBRE_PERSONA,foliodepagos,	colegiatura_alumno,fechadepago,semanaspagadas')
						->from('ALUMNOS,pagosalumnos,	Personal_institutional,Colegituras')
						->where('fechadepago',$Fecha)
						->where('idpersonadepago_fk=PERSONAL_ID')
						->where('iddealumnos_fk=id_alumno')
						->where('foliodepagos=folio_fk_id')
						->where('Eliminarpagos',0)
						->order_by('semanaspagadas','ASC')
						->get()
						->result_array();
		return $has;
	}
	public function exel1($Fecha){
		$has=$this->db->select('id_alumno,nombre_alumno,colegiatura_alumno,	NOMBRE_PERSONA,foliodepagos,colegiatura_alumno,fechadepago,semanaspagadas')
						->from('ALUMNOS,pagosalumnos,	Personal_institutional,Colegituras')
						->where('semandepago',$Fecha)
						->where('idpersonadepago_fk=PERSONAL_ID')
						->where('iddealumnos_fk=id_alumno')
						->where('foliodepagos=folio_fk_id')
						->where('Eliminarpagos',0)
						->where('pago_año',date('y'))
						->order_by('semanaspagadas','ASC')
						->get()
						->result_array();
		return $has;
	}

	public function folios($id_folios)
	{
		$folios=$this->db->select('*')
						->from('pagosalumnos')
						->where('foliodepagos',$id_folios)
						->get()
						->result_array();
		return $folios;
	}

	public function actulizarcoleguiatura($id_alumno,$data){
		$this->db->where('id_alumno',$id_alumno);
		return $this->db->update('alumnos',$data);
	}

	public function datosdelrsivo($value)
	{
		$has=$this->db->select("*")
						->from('pagosalumnos,alumnos,colegituras')
						->where('foliodepagos',$value)
						->where('iddealumnos_fk=id_alumno')
						->where('foliodepagos=folio_fk_id')
						->get()
						->result_array();
		return $has;
	}

}