<?php
require_once "modules/capacitaciones/view.php";
require_once "modules/capacitaciones/model.php";
require_once "modules/usuarios/model.php";


class CapacitacionesController {

	function __construct() {
		$this->model = new Capacitaciones();
		$this->view = new CapacitacionesView();
	}
  
	function panel() {
    SessionHandling::check();
    SessionHandling::checkGrupo('1,99');
		$capacitaciones = $this->model->traer_capacitaciones();
    $this->view->panel($capacitaciones);
	}
  
  function capacitaciones($argumentos) {
    SessionHandling::check();
    $mensaje_id = $argumentos[0];
    switch($mensaje_id) {
			case 0:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none");
				break;
			case 1:
				$array_msj = array("{mensaje}"=>"Usuario y/o clave incorrectos, por favor intente nuevamente. Muchas gracias.",
													 "{display}"=>"show");
        break;
		}
    
    if ($_SESSION["sesion.inicio_capacitaciones"] == 0) {
      $this->view->inicio_capacitaciones($array_msj);
    } else {
      $capacitaciones = $this->model->traer_capacitaciones();
      $this->view->capacitaciones($capacitaciones);
    }
	}	
  
  function traer_form_editar_capacitacion_ajax($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $capacitacion_id = $argumentos[0];
    
    $this->model->capacitacion_id = $capacitacion_id;
		$capacitacion = $this->model->get();
    $this->view->traer_form_editar_capacitacion_ajax($capacitacion);
  }
  
  function consultar_capacitacion_ajax($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $capacitacion_id = $argumentos[0];
    
    $this->model->capacitacion_id = $capacitacion_id;
		$capacitacion = $this->model->get();
    $this->view->consultar_capacitacion_ajax($capacitacion);
  }
  
  function guardar() {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $this->model->denominacion = filter_input(INPUT_POST, 'denominacion');
    $this->model->detalle = filter_input(INPUT_POST, 'detalle');
    $this->model->url = filter_input(INPUT_POST, 'url');
    $this->model->fecha = filter_input(INPUT_POST, 'fecha');
    $this->model->guardar();
    header("Location: /" . APP_NAME . "/capacitaciones/panel");
  }
  
  function actualizar() {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $capacitacion_id = filter_input(INPUT_POST, 'capacitacion_id');
    $this->model->capacitacion_id = $capacitacion_id;
    $this->model->cargar_modelo();
    $this->model->denominacion = filter_input(INPUT_POST, 'denominacion');
    $this->model->detalle = filter_input(INPUT_POST, 'detalle');
    $this->model->url = filter_input(INPUT_POST, 'url');
    $this->model->fecha = filter_input(INPUT_POST, 'fecha');
    $this->model->guardar();
    header("Location: /" . APP_NAME . "/capacitaciones/panel");
  }
  
  function eliminar($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $capacitacion_id = $argumentos[0];
    $this->model->capacitacion_id = $capacitacion_id;
    $this->model->eliminar();
    header("Location: /" . APP_NAME . "/capacitaciones/panel");
  }
  
  function editar($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $capacitacion_id = $argumentos[0];
    $mensaje_id = $argumentos[1];
    
    switch($mensaje_id) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 5:
				$array_msj = array("{mensaje}"=>"Ha ocurrido un error, pruebe nuevamente por favor. Disculpe las molestias, muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
		}
    
    $this->model->capacitacion_id = $capacitacion_id;
		$capacitacion = $this->model->get();    
    $this->view->editar($capacitacion, $array_msj);
	}	
  
  function consultar($argumentos) {
    SessionHandling::check();
    $capacitacion_id = $argumentos[0];
    
    $this->model->capacitacion_id = $capacitacion_id;
		$capacitacion = $this->model->get();   
    
    $this->view->consultar($capacitacion);
	}
  
  function ver($argumentos) {
    SessionHandling::check();
    $capacitacion_id = $argumentos[0];
    
    $this->model->capacitacion_id = $capacitacion_id;
		$capacitacion = $this->model->get();   
    
    $this->view->ver($capacitacion);
	}	
  
  function verificar() {
		$um = new Usuarios();
    $um->denominacion = filter_input(INPUT_POST, "denominacion");
		$um->clave = filter_input(INPUT_POST, "clave");
    
    $evaluacion = $um->evaluar();
    if($evaluacion == 0) {
      header("Location: /" . APP_NAME . "/capacitaciones/capacitaciones/1");
    } else if($evaluacion == 2) {
      $_SESSION["sesion.inicio_capacitaciones"] = 1;
      header("Location: /" . APP_NAME . "/capacitaciones/capacitaciones/0");
    }
	}
}
?>