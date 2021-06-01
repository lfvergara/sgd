<?php
require_once "modules/gestion/view.php";
require_once "modules/gestion/model.php";


class GestionController {

	function __construct() {
		$this->model = new Gestion();
		$this->view = new GestionView();
	}
  
	function panel() {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
		$gestiones = $this->model->traer_gestiones();
    $this->view->panel($gestiones);
	}
  
  function guardar() {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $this->model->denominacion = filter_input(INPUT_POST, 'denominacion');
    $this->model->estado = 0;
    $this->model->guardar();
    header("Location: /" . APP_NAME . "/gestion/panel");
  }
  
  function activar($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $gestion_id = $argumentos[0];
    $this->model->gestion_id = $gestion_id;
    $this->model->activar();
    header("Location: /" . APP_NAME . "/gestion/panel");
  }
  
  function desactivar($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $gestion_id = $argumentos[0];
    $this->model->gestion_id = $gestion_id;
    $this->model->desactivar();
    header("Location: /" . APP_NAME . "/gestion/panel");
  }
  
  function traer_form_editar_gestion_ajax($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $gestion_id = $argumentos[0];    
    $this->model->gestion_id = $gestion_id;
		$gestion = $this->model->get();
    $this->view->traer_form_editar_gestion_ajax($gestion);
  }
  
  function consultar_gestion_ajax($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $gestion_id = $argumentos[0];    
    $this->model->gestion_id = $gestion_id;
		$gestion = $this->model->get();
    $this->view->consultar_gestion_ajax($gestion);
  }
  
  function actualizar() {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $gestion_id = filter_input(INPUT_POST, 'gestion_id');
    $this->model->gestion_id = $gestion_id;
    $this->model->cargar_modelo();
    $this->model->denominacion = filter_input(INPUT_POST, 'denominacion');
    $this->model->guardar();
    header("Location: /" . APP_NAME . "/gestion/panel");
  }
  
  function eliminar($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $gestion_id = $argumentos[0];
    $this->model->gestion_id = $gestion_id;
    $this->model->eliminar();
    header("Location: /" . APP_NAME . "/gestion/panel");
  }
  
  function consultar($argumentos) {
    SessionHandling::check();
    $gestion_id = $argumentos[0];    
    $this->model->gestion_id = $gestion_id;
		$gestion = $this->model->get();    
    $this->view->consultar($gestion);
	}
}
?>