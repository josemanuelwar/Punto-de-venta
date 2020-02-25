<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
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
	  	$this->load->model('Producto');
	  	$this->load->library('form_validation');
	  	$this->load->database();
	  	date_default_timezone_set('America/Mexico_City');
	  	 $this->request = json_decode(file_get_contents('php://input'));
	  	}else{
	    redirect('Login/Login');
		}
		
	}

	public function index(){
		$this->load->view('common/boostrap');
     	$this->load->view('navbar/usuario');
     	$this->load->view('productos/Registrodeproductos');
	}

	public function registraproductosvue(){
		
		$data=array(
			'proeducto_persona_fk' =>$this->session->userdata('itm')['Rol'],
			'nombredelproducto' =>$this->request->nombre,
			'productocontidad' =>$this->request->cantidad,
			'precio_producto' =>$this->request->precio,			 );
		$agregado=$this->Producto->Registraproductos($data);
		echo json_encode($agregado);

	}

	public function recupearproductos(){
		$productos=$this->Producto->recuperarArticulos();
		echo json_encode($productos);
	}

	public function Actualizarproducto(){
		$data=array(
			'proeducto_persona_fk' =>$this->session->userdata('itm')['Rol'],
			'nombredelproducto' =>$this->request->nombre,
			'productocontidad' =>$this->request->cantidad,
			'precio_producto' =>$this->request->precio,			 );
		$id_producto=$this->request->seleccion;
		$produc=$this->Producto->Actulizarproducto($id_producto,$data);
		echo json_encode($produc);
	}

	public function Actulizarcantidad(){
		$id_producto=$this->request->seleccion;
		$catidad=$this->request->cantidad;
		
		$producto=$this->Producto->selectArticulos($id_producto);
		$suma=(integer)$producto[0]["productocontidad"]+(integer)$catidad;
		$data=array(
			'proeducto_persona_fk' =>$this->session->userdata('itm')['Rol'],
			'productocontidad' =>$suma,
						 );
		$produc=$this->Producto->Actulizarproducto($id_producto,$data);
		echo json_encode($produc);
	}

	public function ventasdeproductos(){
		$this->load->view('common/boostrap');
     	$this->load->view('navbar/usuario');
     	$productos['producto']=$this->Producto->recuperarArticulos();
     	$productos['ventas']=$this->Producto->ventas();
       	$this->load->view('productos/ventasdeproductos',$productos);
	}

	public function ventaproduc(){
		$this->form_validation->set_rules('productos', 'productos', 'required|trim|xss_clean');
		$this->form_validation->set_rules('numero', 'numero', 'required|trim|xss_clean');
		if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error',"Todos los campos son requeridos");
            redirect('Productos/ventasdeproductos');
        } else {
        	$producto=$this->Producto->selectArticulos($this->input->post('productos'));
        	if ($producto < 0) {
        		$resta=(integer)$producto[0]["productocontidad"]-(integer)$this->input->post('numero');
        		$tota=(integer)$producto[0]["precio_producto"]*(integer)$this->input->post('numero');
        		$fecha=date('y-m-d');
        		$semana=date('W');
        		$mes=date('m');
        		/********arreglo de insert********/
        		$data=array('totaldeventas' => $tota,
        					'cantidadproducto' =>$this->input->post('numero'),
        					'fechadeventa' =>$fecha,
        					'semanadeventa'=>$semana,
        					'mesventa'=>$mes,
        					'personavendedor'=>$this->session->userdata('itm')['Rol'],
        					 );
        		$folio=$this->Producto->registrodeventa1($data);
	        		if ($folio) {
		        		/****arreglo de udate****/
		        		$dato=array('proeducto_persona_fk'=>$this->session->userdata('itm')['Rol'],
		        			'productocontidad' =>$resta , );
		        		$actulizando=$this->Producto->Actulizarproducto($producto[0]["producto_id"],$dato);
		        		/*********arreglo de relacion***********/
		        		$productos= array('id_folioregistroventa' =>$folio ,
		        			'id_productos_fk' => $producto[0]["producto_id"]
		        		 );
		        		$insertandorelacion=$this->Producto->registrodeventa2($productos);
		        	$this->session->set_flashdata('ok',"venta realizada corectamenta");

	           		}
            	}else{
            		$this->session->set_flashdata('error',"Revise el numero de productos existentes");
            	}

		}
		redirect('Productos/ventasdeproductos');
	}

	public function canselaraxaj(){
		$folio_producto=$this->input->post('id_folio');
		$eliminar=$this->Producto->eliminarproducto($folio_producto);
		$producto=$this->Producto->selectArticulos($eliminar[0]['id_productos_fk']);
		$suma=(integer)$eliminar[0]['cantidadproducto']+(integer)$producto[0]['productocontidad'];
	$pro= array('productocontidad' =>$suma , );
	$this->Producto->Actulizarproducto($eliminar[0]['id_productos_fk'],$pro);
	$elimonar=array('Eliminarproducto' => 1, );
	$this->Producto->Actulizarventa($folio_producto,$elimonar);
	echo json_encode($elimonar);
	}
}