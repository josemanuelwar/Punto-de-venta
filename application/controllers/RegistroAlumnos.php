<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include'C:/xampp/htdocs/Punto-de-venta/public/ticket/autoload.php';
#include'/var/www/html/Punto-de-venta/public/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
class RegistroAlumnos extends CI_Controller {

	function __construct(){
		parent::__construct();	
		if (($this->session->userdata('itm')['Rol'] == 1)  Or  ($this->session->userdata('itm')['Rol'] == 2)) {
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
     	
     	$this->load->view('common/boostrap');
     	$this->load->view('navbar/usuario');
     	$this->load->view('Alumno/AltaAlumno');
     }
     public function RegistraAlumnos(){

     	$this->form_validation->set_rules('USUARIO_USERNAME', 'USUARIO_USERNAME', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('FECHADENACIMIENTO', 'FECHADENACIMIENTO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('NOMBREDELPADRE', 'NOMBREDELPADRE', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('DIRECCION', 'DIRECCION', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('TELEFONO', 'TELEFONO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('HORARIO', 'HORARIO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('FECHADEINICIO', 'FECHADEINICIO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('SEMANADEINICIO', 'SEMANADEINICIO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('colegiatura', 'colegiatura', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('Inscripción', 'Inscripción', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('Cursos', 'Cursos', 'required|trim|xss_clean');

     	if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('RegistroAlumnos');
        } else {
        	$data= array('nombre_alumno' => $this->input->post('USUARIO_USERNAME'),
        					'fechadenacimiento_alumno' =>$this->input->post('FECHADENACIMIENTO') ,
        					'tutorResponsable_alumno' => $this->input->post('NOMBREDELPADRE'),
        					'direccion_alumno' => $this->input->post('DIRECCION'),
        					'telefono_alumno' => $this->input->post('TELEFONO'),
        					'curso_alumno' => $this->input->post('Cursos'),
        					'horario_alumno' => $this->input->post('HORARIO'),
        					'fechadeinicio_alumno' => $this->input->post('FECHADEINICIO'),
        					'semanadeincio' => $this->input->post('SEMANADEINICIO'),
        					'colegiatura_alumno' =>$this->input->post('colegiatura'), 
        					'incripcion_alumno' =>$this->input->post('Inscripción') ,
        					'Fechadeincripcion' => date('y-m-d'),
        					'semanadeincripcion'=>date('W'),
        					'id_personaalumno' => $this->session->userdata('itm')['id_usuario'],
        					 );
        	$alum=$this->Alumno->RegistraAlumno($data);
        	if($alum){
        		$this->session->set_flashdata('ok',"Alumno Registrado Matricula".$alum);
        	}else{
        		$this->session->set_flashdata('error',"ocurrio un erro contacta el administrador o intentelo mas tarde");
        	}
        	redirect('RegistroAlumnos');
        }

     }

     public function Actulizar(){
     	$this->load->view('common/boostrap');
     	$this->load->view('navbar/usuario');
     	$this->load->view('Alumno/ActulizarAlumnos');
     }

     public function BuscarAlumno(){
     		$this->form_validation->set_rules('Matricula', 'Matricula', 'required|trim|xss_clean');
     		if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('RegistroAlumnos/Actulizar');
        } else {
        	$Actulizar['matricula']=$this->input->post('Matricula');
        	$Actulizar['alumno']=$this->Alumno->MostrarAlumnos($this->input->post('Matricula'));
        	if ($Actulizar != null) {
		        $this->load->view('common/boostrap');
		     	$this->load->view('navbar/usuario');
		     	$this->load->view('Alumno/ActulizarAlumnos',$Actulizar);
        	}else{
        		$this->session->set_flashdata('error',"Matricula esta mal o el usuario no exite");
        		redirect('RegistroAlumnos/Actulizar');
        	}
        }

     }

     public function Actulizardatos($Matricula){
     	$id_aalumno=base64_decode($Matricula);
     	$this->form_validation->set_rules('USUARIO_USERNAME', 'USUARIO_USERNAME', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('FECHADENACIMIENTO', 'FECHADENACIMIENTO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('NOMBREDELPADRE', 'NOMBREDELPADRE', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('DIRECCION', 'DIRECCION', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('TELEFONO', 'TELEFONO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('HORARIO', 'HORARIO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('FECHADEINICIO', 'FECHADEINICIO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('SEMANADEINICIO', 'SEMANADEINICIO', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('colegiatura', 'colegiatura', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('Inscripción', 'Inscripción', 'required|trim|xss_clean');

     	$this->form_validation->set_rules('Curso', 'Curso', 'required|trim|xss_clean');

     	if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('RegistroAlumnos/Actulizar');
        } else {
        	$data= array('nombre_alumno' => $this->input->post('USUARIO_USERNAME'),
        					'fechadenacimiento_alumno' =>$this->input->post('FECHADENACIMIENTO') ,
        					'tutorResponsable_alumno' => $this->input->post('NOMBREDELPADRE'),
        					'direccion_alumno' => $this->input->post('DIRECCION'),
        					'telefono_alumno' => $this->input->post('TELEFONO'),
        					'curso_alumno' => $this->input->post('Curso'),
        					'horario_alumno' => $this->input->post('HORARIO'),
        					'fechadeinicio_alumno' => $this->input->post('FECHADEINICIO'),
        					'semanadeincio' => $this->input->post('SEMANADEINICIO'),
        					'colegiatura_alumno' =>$this->input->post('colegiatura'), 
        					'incripcion_alumno' =>$this->input->post('Inscripción') ,
        					'Fechadeincripcion' => date('y-m-d'),
        					'semanadeincripcion'=>date('W'),
							'id_personaalumno' => $this->session->userdata('itm')['id_usuario'],
							'registro_año' => date('y'),
        					 );
        	
        	$actilizado=$this->Alumno->Actulizardatos($id_aalumno,$data);
        	if ($actilizado) {
        		$this->session->set_flashdata('ok',"datos Actulizanod correctamente");
        	}else{
        	$this->session->set_flashdata('error',"ocurrio un error contacte con el alministrador");	
        	}
        	redirect('RegistroAlumnos/Actulizar');
        }

     }
    public function pagosdeAlumnos(){
    	$this->load->view('common/boostrap');
     	$this->load->view('navbar/usuario');
     	$this->load->view('Alumno/pagodeAlumnos');
    }

    public function buscardeuda(){
    	$this->form_validation->set_rules('Matricula', 'Matricula', 'required|trim|xss_clean');
     		if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('RegistroAlumnos/pagosdeAlumnos');
        } else {
        	$Actulizar['matricula']=$this->input->post('Matricula');
			$Actulizar['alumno']=$this->Alumno->MostrarAlumnos($this->input->post('Matricula'));
        	if ($Actulizar != null) {
		        $this->load->view('common/boostrap');
				 $this->load->view('navbar/usuario');
				 /**verificamos la ultima semana de pago del alumno */
				 $Actulizar['semanas']=$this->Alumno->verificasion($this->input->post('Matricula'));
		     	$this->load->view('Alumno/pagodeAlumnos',$Actulizar);
        	}else{
        		$this->session->set_flashdata('error',"Matricula esta mal o el usuario no exite");
        		redirect('RegistroAlumnos/pagodeAlumnos');
        	}
        }
    }

    public function pagarincricolegitura($matricula){
    	$id_alumno=base64_decode($matricula);
    	$this->form_validation->set_rules('Inscripcion', 'Inscripcion', 'required|trim|xss_clean');
		$this->form_validation->set_rules('Colegitura', 'Colegitura', 'required|trim|xss_clean');
		if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('RegistroAlumnos/pagosdeAlumnos');
        } else {
			$vrificador=$this->Alumno->verificasion($id_alumno);
			$alumnos=$this->Alumno->MostrarAlumnos($id_alumno);
			if ($vrificador == null) {
				if ($alumnos != null) {
					$incrip=$this->input->post('Inscripcion');
					$cole=$this->input->post('Colegitura');
					$totalparcial=$incrip+$cole;
					$resta=$alumnos['incripcion_alumno']-$incrip;
					$dato= array('idpersonadepago_fk'=>$this->session->userdata('itm')['id_usuario'],
								'iddealumnos_fk'=>$id_alumno,
									'incripcionpago' => $incrip,
									'colegiaturapago' => $cole,
									'totalpago' => $totalparcial,
									'fechadepago' => date('y-m-d'),
									'semandepago' =>date('W'),
									'ultimasemanadepago' => $alumnos['semanadeincio'],
									'pago_año' => date('y'),
								);
					$folio=$this->Alumno->guadarpagos($dato);
					if ($folio==null) {
							$this->session->set_flashdata('error',"ocurrio un error contacte con el alministrador");
					}else{
					if ($alumnos['incripcion_alumno'] != 0) {
					$data= array('incripcion_alumno' => $resta, 
								'id_personaalumno' => $this->session->userdata('itm')['id_usuario'],
									'Fechadeincripcion'=>date('y-m-d'),
									'semanadeincripcion'=> date('W') ,
									);
					$actulizar=$this->Alumno->Actulizardatos($id_alumno,$data);
					}
					$datos= array('folio_fk_id' => $folio,
									'semanaspagadas'=>  $alumnos['semanadeincio']);
					$colegitura=$this->Alumno->insertarcolegitura($datos);
						if ($colegitura) {
							$this->session->set_flashdata('ok',"datos guardados correctamente");
						}else{
							$this->session->set_flashdata('error',"ocurrio un error contacte con el alministrador");
						}
					}
				}
			}else{
					$incrip=$this->input->post('Inscripcion');
					$cole=$this->input->post('Colegitura');
					$totalparcial=$incrip+$cole;
					$resta=$alumnos['incripcion_alumno']-$incrip;
				if ($resta<0) {
					$this->session->set_flashdata('error',"verifica estas cobrando de mas en la incripcion");
				}elseif ($cole>$alumnos['colegiatura_alumno']) {
					$this->session->set_flashdata('error',"verifica estas cobrando de mas en la colegitura");
				}else{
					$suma=(integer)$vrificador['ultimasemanadepago']+1;
					$dato= array('idpersonadepago_fk'=>$this->session->userdata('itm')['id_usuario'],
								'iddealumnos_fk'=>$id_alumno,
									'incripcionpago' => $incrip,
									'colegiaturapago' => $cole,
									'totalpago' => $totalparcial,
									'fechadepago' => date('y-m-d'),
									'semandepago' =>date('W') ,
									'ultimasemanadepago' =>$suma ,
									'pago_año' => date('y'),
								);
					$folio=$this->Alumno->guadarpagos($dato);
					if ($folio==null) {
							$this->session->set_flashdata('error',"ocurrio un error contacte con el alministrador");
					}else{
					if ($alumnos['incripcion_alumno']!=0) {
					$data= array('incripcion_alumno' => $resta,
								'id_personaalumno' => $this->session->userdata('itm')['id_usuario'],
									'Fechadeincripcion'=>date('y-m-d'),
									'semanadeincripcion'=> date('W') ,
									);
					$actulizar=$this->Alumno->Actulizardatos($id_alumno,$data);
					}
					$datos= array('folio_fk_id' => $folio,
									'semanaspagadas'=> $suma);
					$colegitura=$this->Alumno->insertarcolegitura($datos);
						if ($colegitura) {
							$this->session->set_flashdata('ok',"datos guardados correctamente");
						}else{
							$this->session->set_flashdata('error',"ocurrio un error contacte con el alministrador");
						}
					}
				}
			}
		}
		redirect('RegistroAlumnos/pagosdeAlumnos');
    }

    public function adelantarcolegitura($matricula){
    	$id_alumno=base64_decode($matricula);
    	$this->form_validation->set_rules('Adelantar', 'Adelantar', 'required|trim|xss_clean');
		if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('RegistroAlumnos/pagosdeAlumnos');
        } else {
        	$adelantar=$this->input->post('Adelantar');
        	
			$alumnos=$this->Alumno->MostrarAlumnos($id_alumno);
        	$vrificador=$this->Alumno->verificasion($id_alumno);
        	
        	$cole=(integer)$alumnos['colegiatura_alumno']*$adelantar;
        	$suma=(integer)$vrificador['ultimasemanadepago']+(integer)$adelantar;
        	if($suma > 52 ){
        		$this->session->set_flashdata('error',"Favor si va adelantar semanas porfavor de redondear a 52 semanas");
        	}else{
					$dato= array('idpersonadepago_fk'=>$this->session->userdata('itm')['id_usuario'],
								'iddealumnos_fk'=>$id_alumno,
									'colegiaturapago' => $cole,
									'totalpago' => $cole,
									'fechadepago' => date('y-m-d'),
									'semandepago' =>date('W') ,
									'ultimasemanadepago' =>$suma ,
									'pago_año' => date('y'),
								);
			$folio=$this->Alumno->guadarpagos($dato);
			if($adelantar==1){
				$datos= array('folio_fk_id' => $folio,
									'semanaspagadas'=> $suma);
					$colegitura=$this->Alumno->insertarcolegitura($datos);
			}else{
				$j=1;
				for ($i=0; $i <(integer)$adelantar; $i++) {
					$datos= array('folio_fk_id' => $folio,
									'semanaspagadas'=> (integer)$vrificador['ultimasemanadepago']+$j);
					$colegitura=$this->Alumno->insertarcolegitura($datos);
					$j++;
				}
			}
			$this->session->set_flashdata('ok',"Se han guardado corectamente su datos");
			$resutado=self::imprimirtickets($folio);
		}
        }
        redirect('RegistroAlumnos/pagosdeAlumnos');
    }

    public function generarexelfecha($fecha=null,$numero=null){
        if($fecha!=1){
            $exl=$this->Cortesdeldia->exel($fecha);
        }
        if ($numero != null) {
            $exl=$this->Cortesdeldia->exel1($numero);
        }
        if (count($exl) > 0) {
        //Cargamos la librería de excel.
            $this->load->library('excel'); 
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle('Reporte Actividades');
            $contador = 1;
        //Le aplicamos ancho las columnas.
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        //Le aplicamos negrita a los títulos de la cabecera.
            $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
        //Definimos los títulos de la cabecera.
            $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Folio');
            $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Matricula');
            $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Nombre del Alumno');
            $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Fecha de cobro');
            $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'semanas pagadas');
            $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Mensualidad');
            $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Cajero');
            //Definimos la data del cuerpo.
                foreach($exl as $l){
                   //Incrementamos una fila más, para ir a la siguiente.
                	$contador++;
                   //Informacion de las filas de la consulta.
                	$this->excel->getActiveSheet()->setCellValue("A{$contador}", $l['foliodepagos']);
                	$this->excel->getActiveSheet()->setCellValue("B{$contador}", $l['id_alumno']);
                	$this->excel->getActiveSheet()->setCellValue("C{$contador}", $l['nombre_alumno']);
                	$this->excel->getActiveSheet()->setCellValue("D{$contador}", $l['fechadepago']);
                	$this->excel->getActiveSheet()->setCellValue("E{$contador}", $l['semanaspagadas']);
                	$this->excel->getActiveSheet()->setCellValue("F{$contador}", $l['colegiatura_alumno']);
                	$this->excel->getActiveSheet()->setCellValue("G{$contador}", $l['NOMBRE_PERSONA']);

                }
                //Le ponemos un nombre al archivo que se va a generar.
                $archivo = "Reporte del Elaborador.xls";
                header('Content-Type: application/vnd.ms-excel;charset=utf-8');
                header('Content-Disposition: attachment;filename="'.$archivo.'"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                //Hacemos una salida al navegador con el archivo Excel.
                $objWriter->save('php://output');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
	}
	public function condonar($id_matricula){
		$matricula=base64_decode($id_matricula);
		$alumnos=$this->Alumno->MostrarAlumnos($matricula);
		$N_semana=$this->input->post('Semana');
		$Descripcion=$this->input->post('Descripcion');
		$dato= array('idpersonadepago_fk'=>$this->session->userdata('itm')['id_usuario'],
								'iddealumnos_fk'=>$matricula,
									'colegiaturapago' => $alumnos['colegiatura_alumno'],
									'totalpago' => $alumnos['colegiatura_alumno'],
									'fechadepago' => date('y-m-d'),
									'semandepago' =>date('W') ,
									'ultimasemanadepago' =>$N_semana,
									'pago_año' => date('y'),
									'Descripciondecondonacion' => $Descripcion,
								);
			$folio=$this->Alumno->guadarpagos($dato);
		if ($folio != null) {
			$datos= array('folio_fk_id' => $folio,
						'semanaspagadas'=> $N_semana,);
			$colegitura=$this->Alumno->insertarcolegitura($datos);
			if ($colegitura) {
				$this->session->set_flashdata('ok',"Se han guardado corectamente su datos");
				redirect('RegistroAlumnos/pagosdeAlumnos');
			}
			else{
				$this->session->set_flashdata('error',"Favor si va adelantar semanas porfavor de redondear a 52 semanas");
				redirect('RegistroAlumnos/pagosdeAlumnos');
			}
		}
	}

	public function imprimirtickets($id_folios)
	{
		$folios=$this->Cortesdeldia->datosdelrsivo($id_folios);
        //$colegiatura=$this->Cortesdeldia->colegiaturas($id_folios);
		var_dump($folios);
		die;
		/**
        **imprimiendo ticket de compras de productos
        **
        **/
        $nombre_impresora = "imprciontickes"; 
        $connector = new WindowsPrintConnector($nombre_impresora);
        $printer = new Printer($connector);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
            /*imagen del la institucion*/
                // try{
                //       $logo = EscposImage::load("img/logo1.png", false);
                //        $printer->bitImage($logo);
                // }catch(Exception $e){/*No hacemos nada si hay error*/}
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("\n"."Instituto Tecnico de Mexico" . "\n");
        $printer->text("Direccion:" . "\n");
        $printer->text("Boulevard carlos camacho espíritu" . "\n");
        $printer->text("Tel: 2222800926" . "\n");
        $printer->text("Responsable del Cobro \n");
        $printer->text($this->session->userdata('itm')['Nombre']."\n");
        date_default_timezone_set("America/Mexico_City");
        $printer->text(date("Y-m-d H:i:s") . "\n");
        $printer->text("N° Folio \n");
        $printer->text($id_folios);
        $printer->text("\n");
        $printer->text("-----------------------------" . "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Matricula \n");
        $printer->text($folios[0]["id_alumno"]."\n");
        $printer->text("Nombre de Alumno \n");
        $printer->text($folios[0]["nombre_alumno"]."\n");
        $printer->text("-----------------------------" . "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        if (($folios[0]["incripcionpago"] != null) or ($folios[0]["incripcionpago"] != 0)) {
            $printer->text("Inscripción".$folios[0]["incripcionpago"]."\n");
        }else{
			foreach ($folios as $key => $value) {
				$printer->text("Numero de semana ".$value["semanaspagadas"]. " $".$folios[0]["colegiatura_alumno"]."\n");
			}

		}
        $printer->text("-----------------------------"."\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("TOTAL:\n");
        $printer->text("$".$folios[0]["totalpago"]."\n");
        $printer->text("\n \n");
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("-----------------------------"."\n");
        $printer->text("Muchas gracias\n");
        $printer->text("Siempre y de forma inmediata le deben entregar su comprobante de pago \n");
        $printer->text("y debe coincidir con el concepto de pago realizado por usted \n");
        $printer->text("Si no se lo entregan o el concepto de pago es distinto, favor de reportarlo al 2222 800 926 \n");
        $printer->text("y se le bonificara Gratis una colegiatura");
        $printer->feed(3);
        $printer->cut();
        $printer->close();
	}

}
