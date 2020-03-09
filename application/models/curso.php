<?php

class Curso extends CI_Model {

    public function Cursoget()
    {
        $cursos=$this->db->select('*')
                    ->from('cursos')
                    ->where('ELIMINAR_CURSO',1)
                    ->get()
                    ->result_array();
        return $cursos;
    }

    public function insertarcurso($data)
    {
        if (!$this->db->insert('cursos',$data))
		{
			return false;
		}
		return $this->db->insert_id();
    }

    public function cursoss($cusrso)
    {
        $cursos=$this->db->select('*')
                    ->from('cursos')
                    ->where('NOMBRE_CURSO',$cusrso)
                    ->where('ELIMINAR_CURSO',1)
                    ->get()
                    ->result_array();
        return $cursos;
    }

    public function Eliminar_curso($id_curso,$data)
    {
        $this->db->where('ID_CURSO',$id_curso);
		return $this->db->update('cursos',$data);
    }

    public function lista_usuarios()
    {
        $usuario=$this->db->select()
                        ->from('personal_institutional')
                        ->where('PERSONAL_ELIMINAR',1)
                        ->where('PERSONAL_Rol',1)
                        ->get()
                        ->result_array();
        return $usuario;
    }

    public function usuario($id_usuario)
    {
        $usuario=$this->db->select()
                        ->from('personal_institutional')
                        ->where('PERSONAL_ID',$id_usuario)
                        ->where('PERSONAL_ELIMINAR',1)
                        ->where('PERSONAL_Rol',1)
                        ->get()
                        ->result_array();
        return $usuario;
    }

    public function Actulizar($tabla,$key_de_latabla,$id_acomparar,$data)
    {
        $this->db->where($key_de_latabla,$id_acomparar);
		return $this->db->update($tabla,$data);
    }
}