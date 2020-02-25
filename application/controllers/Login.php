<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		header( 'X-Content-Type-Options: nosniff' );
      	header( 'X-Frame-Options: SAMEORIGIN' );
      	header( 'X-XSS-Protection: 1;mode=block' );
      	$this->load->library('Bcrypt');
      	$this->load->model('Personal');
      	$this->load->library('form_validation');
      	$this->load->database();
     }
	public function index(){
			$this->load->view("Login/Bienvenido");
	}

	public function login(){
		$this->load->view('common/boostrap');
		$this->load->view('Login/Login');
	}

	public function secion(){
		$this->form_validation->set_rules('USUARIO_EMAIL', 'USUARIO_EMAIL', 'required|trim|xss_clean');
        $this->form_validation->set_rules('USUARIO_PASSWORD', 'USUARIO_PASSWORD', 'required|trim|xss_clean');
        if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('Login/login');
        } else {
        	$admi=$this->Personal->iniciosecion($this->input->post('USUARIO_EMAIL'),$this->input->post('USUARIO_PASSWORD'));

        	if ($admi) {
        		$dato=array('is_logued_in' => true,
        					'id_usuario' => $admi['PERSONAL_ID'],
        					'Nombre' => $admi['NOMBRE_PERSONA'],
        					'correo' => $admi['CORREO_PERSONA'],
                            'Rol' => $admi['PERSONAL_Rol'],
        					);
        		$this->session->set_userdata('itm', $dato);
        		
        		redirect('RegistroAlumnos');
        	}
        }


	}

	public function Registrodeusuarios(){
		$this->load->view('common/boostrap');
		$this->load->view('navbar/usuario');
		$this->load->view("Login/Registro");
	}

	public function GuardarUsuariobase(){
		 $this->form_validation->set_rules('USUARIO_USERNAME', 'USUARIO_USERNAME', 'required|trim|xss_clean');
		  $this->form_validation->set_rules('USUARIO_EMAIL', 'USUARIO_EMAIL', 'required|trim|xss_clean');
        $this->form_validation->set_rules('USUARIO_PASSWORD', 'USUARIO_PASSWORD', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('/');
        } else {
        	
        	$usuario=$this->Personal->Verificandousuario($this->input->post('USUARIO_EMAIL'));
        	if ($usuario != null) {
        		$this->session->set_flashdata('error',"El usuario ya se encuentra registrado");
        	}else{
        		$registro=$this->Personal->Registrarusuario($this->input->post('USUARIO_USERNAME'),$this->input->post('USUARIO_EMAIL'),$this->input->post('USUARIO_PASSWORD'));
        		if ($registro) {
        			$this->session->set_flashdata('ok',"usuario dado de alta exitosamente");
        		}else{
        			$this->session->set_flashdata('error',"ocurrio un erro contacta el administrador o intentelo mas tarde");
        		}

        	}
        	
        	redirect('Login/Registrodeusuarios');
        }
	}

	public function cerrarsecion(){

        $this->session->set_userdata('itm', $datos);

        $this->session->sess_destroy();
        $this->load->view('common/boostrap');
        redirect('Login');
	}

}