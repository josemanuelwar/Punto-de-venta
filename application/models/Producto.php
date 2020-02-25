<?php

class Producto extends CI_Model {

	public function Registraproductos($data){
			
			if (!$this->db->insert('PRODUCTOS',$data)) 
			{
				return false;
			}
			return $this->db->insert_id();

	}
	public function recuperarArticulos(){
		$has=$this->db->select('*')
						->from('PRODUCTOS')
						->get()
						->result();
		return $has;
	}
	public function selectArticulos($idproducto){
		$has=$this->db->select('*')
						->from('PRODUCTOS')
						->where('producto_id',$idproducto)
						->get()
						->result_array();
		return $has;
	}
	public function Actulizarproducto($idproducto,$data){
		$this->db->where('producto_id',$idproducto);
		return $this->db->update('PRODUCTOS',$data);
	}

	public function registrodeventa1($data){
			
			if (!$this->db->insert('RegistroDeventas',$data)) 
			{
				return false;
			}
			return $this->db->insert_id();

	}

	public function registrodeventa2($data){
			
			if (!$this->db->insert('productosvendidos',$data)) 
			{
				return false;
			}
			return $this->db->insert_id();

	}
	public function ventas(){
		$has=$this->db->select('*')
						->from('RegistroDeventas,productosvendidos,Personal_institutional,PRODUCTOS')
						->where('Registroventa_id=id_folioregistroventa')
						->where('personavendedor=PERSONAL_ID')
						->where('Eliminarproducto',0)
						->where('id_productos_fk=producto_id')

						->get()
						->result_array();
		return $has;
	}
	
	public function eliminarproducto($id){
		$has=$this->db->select('*')
						->from('RegistroDeventas,productosvendidos,Personal_institutional,PRODUCTOS')
						->where('Registroventa_id',$id)
						->where('Registroventa_id=id_folioregistroventa')
						->where('personavendedor=PERSONAL_ID')
						->where('Eliminarproducto',0)
						->where('id_productos_fk=producto_id')

						->get()
						->result_array();
		return $has;
	}
	public function Actulizarventa($idproducto,$data){
		$this->db->where('Registroventa_id',$idproducto);
		return $this->db->update('RegistroDeventas',$data);
	}
	
	
	
}