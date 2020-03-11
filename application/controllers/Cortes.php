<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cortes extends CI_Controller {
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
	  	$this->load->library('form_validation');
	  	$this->load->database();
	  	date_default_timezone_set('America/Mexico_City');
	  	}else{
	    redirect('Login/Login');
		}
		
	}


	public function index(){
			$Corte['cortes']=$this->Cortesdeldia->cortedia(date('y-m-d'));
			$Corte['Total']=$this->Cortesdeldia->sumadeingresos(date('y-m-d')); 
			$Corte['fecha']=date('y-m-d');
			$this->load->view('common/boostrap');
			$this->load->view('navbar/usuario');
			$this->load->view('Cortes/IngresoporColeguituras',$Corte);
	}

	public function cortefecha(){
		$this->form_validation->set_rules('fecha', 'fecha', 'required|trim|xss_clean');
		if ($this->form_validation->run() == false) {
		$this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('Cortes');
        } else {
			$Corte['cortes']=$this->Cortesdeldia->cortedia($this->input->post('fecha'));
        	$Corte['fecha']=$this->input->post('fecha');
        	$Corte['Total']=$this->Cortesdeldia->sumadeingresos($this->input->post('fecha'));
	        $this->load->view('common/boostrap');
	     	$this->load->view('navbar/usuario');
	     	$this->load->view('Cortes/IngresoporColeguituras',$Corte);

        }
	}

	public function numerodesemana(){
		$this->form_validation->set_rules('numerosemana', 'numerosemana', 'required|trim|xss_clean');
	 	if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('Cortes');
        } else {
			$Corte['cortes']=$this->Cortesdeldia->cortenumerosemana($this->input->post('numerosemana'));
        	$Corte['Total']=$this->Cortesdeldia->sumadeingresosnumerodesemana($this->input->post('numerosemana'));
        	$Corte['numero']=$this->input->post('numerosemana');
	        $this->load->view('common/boostrap');
	     	$this->load->view('navbar/usuario');
	     	$this->load->view('Cortes/IngresoporColeguituras',$Corte);
        }
	}

	public function canselar(){
		$folio=$this->input->post('id_folio');
		$verificasion=$this->Cortesdeldia->folios($folio);
		if ($verificasion[0]["incripcionpago"] != null){
			$alumnos=$this->Cortesdeldia->historial($verificasion[0]["iddealumnos_fk"]);
			$suma=(integer)$verificasion[0]["incripcionpago"]+(integer)$alumnos[0]["incripcion_alumno"];
			$data=array("incripcion_alumno"=>$suma,);
			if ($this->Cortesdeldia->actulizarcoleguiatura($verificasion[0]["iddealumnos_fk"],$data)) {
				echo "correcto";
			}else{
				echo json_encode(0);
			}
		}
		$data=array('Eliminarpagos' => 1, );
		if ($this->Cortesdeldia->eliminar($folio,$data)){
			echo  json_encode(1);
		}else{
			echo json_encode(0);
		}

	}

	public function historialcrediticia(){
		$this->load->view('common/boostrap');
		if ($this->input->post('Matricula')==null) {
			$this->load->view('navbar/usuario');
			$this->load->view('Cortes/historialcrediticia');
		}else{
			$histori['hitoria']=$this->Cortesdeldia->historial($this->input->post('Matricula'));
			$this->load->view('navbar/usuario');
			$this->load->view('common/boostrap');
			$this->load->view('Cortes/historialcrediticia',$histori);

		}
	}

	public function historialajax(){
	}

}