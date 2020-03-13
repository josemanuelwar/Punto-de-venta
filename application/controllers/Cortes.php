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

	public function imprimir_corte($fecha=null,$numerodesemana=null)
	{
		if($fecha != 1){
			$Corte=$this->Cortesdeldia->cortedia($fecha);
			$Total=$this->Cortesdeldia->sumadeingresos($fecha);
		}elseif($numerodesemana != null){
			$Corte=$this->Cortesdeldia->cortenumerosemana($numerodesemana);
        	$Total=$this->Cortesdeldia->sumadeingresosnumerodesemana($numerodesemana);
		}
		$nombre_impresora = "Post";
        $connector = new WindowsPrintConnector($nombre_impresora);
        $printer = new Printer($connector);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
            /*imagen del la institucion*/
            // try{
            //     $logo = EscposImage::load("img/logo1.png", false);
            //     $printer->bitImage($logo);
            // }catch(Exception $e){/*No hacemos nada si hay error*/}
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("\n"."Instituto Tecnico de Mexico" . "\n");
        $printer->text("Direccion:" . "\n");
        $printer->text("Boulevard carlos camacho espíritu" . "\n");
        date_default_timezone_set("America/Mexico_City");
        $printer->text(date("Y-m-d H:i:s") . "\n");
        $printer->text("Corte \n");
        $printer->text("-----------------------------" . "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
			foreach ($Corte as $value) {
                $printer->text("Folio ".$value["foliodepagos"]."\n");
                $printer->text("Matricula  ".$value["id_alumno"]."\n");
                $printer->text("Colegiatura $".$value['colegiatura_alumno']."\n");
                if($value["incripcion_alumno"]!=0){
                    $printer->text("Incripcion".$value["incripcion_alumno"]."\n");
				}
			}
            $printer->text("-----------------------------"."\n");
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("TOTAL:\n");
            $printer->text("$".$Total[0]["SUM(totalpago)"]."\n");
            $printer->feed(3);
            $printer->cut();
			$printer->close();
		redirect('Cortes');
	}
}