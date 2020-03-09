<?php
class Cursos extends CI_Controller {
	function __construct(){
		parent::__construct();	
		if (($this->session->userdata('itm')['Rol'] == 1) or ($this->session->userdata('itm')['Rol'] == 2)) {
		header( 'X-Content-Type-Options: nosniff' );
	  	header( 'X-Frame-Options: SAMEORIGIN' );
	  	header( 'X-XSS-Protection: 1;mode=block' );
	  	$this->load->library('Bcrypt');
	  	$this->load->model('Personal');
	  	$this->load->model('Alumno');
		$this->load->model('Cortesdeldia');
		$this->load->model('Curso');
		$this->load->library('form_validation');
		$this->load->library('Bcrypt');
	  	$this->load->database();
	  	date_default_timezone_set('America/Mexico_City');
	  	}else{
	    redirect('Login/Login');
		}
    }

    public function index()
    {
		$data['Cursos']=$this->Curso->Cursoget();
        $this->load->view('common/boostrap');
        $this->load->view('navbar/usuario');
        $this->load->view('Login/Cursos',$data);
	}

	public function GuardarCursos()
	{
		$this->form_validation->set_rules('Cursos', 'Cursos', 'required|trim|xss_clean');
		$this->form_validation->set_rules('fecha_creasion','fecha_creasion','required|trim|xss_clean');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error',"Todos los campos son requeridos");
			redirect("Cursos");
		}else{
			$validando=$this->Curso->cursoss($this->input->post('Cursos'));
			if ($validando == null) {
				$data=array("NOMBRE_CURSO"=>$this->input->post('Cursos'),
							"FECHEDECRACIONCURSO"=> $this->input->post('fecha_creasion'));
				$curso=$this->Curso->insertarcurso($data);
				if($curso){
					$this->session->set_flashdata('ok',"Se han guardado correctamente su datos");
					redirect('Cursos');
				}else{
					$this->session->set_flashdata('error',"Erro al guardar tus datos");
					redirect("Cursos");
				}
			}else{
				$this->session->set_flashdata('error',"Erro el curso ya existe");
				redirect("Cursos");
			}
		}
	}
	public function Eliminar_curso($id_curso)
	{
		$dato = array('ELIMINAR_CURSO' => 0, );
		$eliminar=$this->Curso->Eliminar_curso($id_curso,$dato);
		if ($eliminar) {
			$this->session->set_flashdata('ok',"Se ha Eliminado");
			redirect('Cursos');
		}else{
			$this->session->set_flashdata('error',"Erro no se puede eliminar");
			redirect("Cursos");
		}
	}
	public function Actulizar(Type $var = null)
	{
		$this->form_validation->set_rules('id_curso', 'id_curso', 'required|trim|xss_clean');
		$this->form_validation->set_rules('curso','curso','required|trim|xss_clean');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error',"Todos los campos son requeridos");
		}else{
			$id_curso=$this->input->post('id_curso');
			$curso=$this->input->post('curso');
			$fecha=date('y-m-d');
			$dato = array('NOMBRE_CURSO' => $curso,
						'FECHEDECRACIONCURSO'=>$fecha );
			/**actulizamos el curso se se equibocan */
			$eliminar=$this->Curso->Eliminar_curso($id_curso,$dato);
		if ($eliminar) {
			$this->session->set_flashdata('ok',"Se ha Actulizado correctamente");
			//redirect('Cursos');
		}else{
			$this->session->set_flashdata('error',"Erro no se puede Actulizado");
			//redirect("Cursos");
		}
		}
	}
	public function listadeusuarios($id_usurio=null)
	{
		$data['usuario']=$this->Curso->lista_usuarios();
		if($id_usurio != null){
		$data["usser"]=$this->Curso->usuario($id_usurio);
		$data["id"]=$id_usurio;
		}
        $this->load->view('common/boostrap');
        $this->load->view('navbar/usuario');
        $this->load->view('Login/usuarios',$data);
	}
	public function Actulizarusuario($id)
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'required|trim|xss_clean');
		$this->form_validation->set_rules('correo','correo','required|trim|xss_clean');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error',"Todos los campos son requeridos");
			redirect('Cursos/listadeusuarios');
		}else{
			$passwor=$this->input->post('contraseña');
			//**definimos la tablas para actulizar */
			$tabla='personal_institutional';
			$key='PERSONAL_ID';
			$id_usuario=$id;
			if ($passwor == null) {
				$dato = array('NOMBRE_PERSONA' => $this->input->post('nombre'),
								'CORREO_PERSONA' => $this->input->post('correo'));
				$iactuliz=$this->Curso->Actulizar($tabla,$key,$id_usuario,$dato);
				if (iactuliz) {
					$this->session->set_flashdata('ok',"Se ha Actulizado correctamente");
					redirect('Cursos/listadeusuarios');
				}else{
					$this->session->set_flashdata('error',"No se ha Actulizado correctamente");
					redirect('Cursos/listadeusuarios');
				}
			}else {
				$dato = array('NOMBRE_PERSONA' => $this->input->post('nombre'),
								'CORREO_PERSONA' => $this->input->post('correo'),
								'CONTRASENA_PERSONA'=>$this->bcrypt->hash_password($this->input->post('contraseña')));
				$iactuliz=$this->Curso->Actulizar($tabla,$key,$id_usuario,$dato);
				if (iactuliz) {
					$this->session->set_flashdata('ok',"Se ha Actulizado correctamente");
					redirect('Cursos/listadeusuarios');
				}else{
					$this->session->set_flashdata('error',"No se ha Actulizado correctamente");
					redirect('Cursos/listadeusuarios');
				}
			}
		}
	}
}