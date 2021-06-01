<?php
require_once "modules/turnoonline/view.php";
require_once "modules/turnoonline/model.php";


class TurnoOnLineController {

	function __construct() {
		$this->model = new TurnoOnLine();
		$this->view = new TurnoOnLineView();
	}
  
	function panel() {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
		$this->model->turnoonline_id = 2;
		$turnoonline = $this->model->get();
    $this->view->panel($turnoonline);
	}
  
  function guardar() {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $this->model->turnoonline_id = filter_input(INPUT_POST, 'turnoonline_id');
    $this->model->denominacion = filter_input(INPUT_POST, 'denominacion');
    $this->model->fecha_desde = filter_input(INPUT_POST, 'fecha_desde');
    $this->model->fecha_hasta = filter_input(INPUT_POST, 'fecha_hasta');
    $this->model->hora_desde = filter_input(INPUT_POST, 'hora_desde');
    $this->model->hora_hasta = filter_input(INPUT_POST, 'hora_hasta');
    $this->model->duracion_turno = filter_input(INPUT_POST, 'duracion_turno');
    $this->model->estado = filter_input(INPUT_POST, 'estado');
    $this->model->guardar();
    header("Location: /" . APP_NAME . "/turnoonline/panel");
  }
  
  function activar($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $turnoonline_id = $argumentos[0];
    $this->model->turnoonline_id = $turnoonline_id;
    $this->model->estado = 1;
    $this->model->desactivar_configuraciones();
    $this->model->activar_configuracion();
    header("Location: /" . APP_NAME . "/turnoonline/panel");
  }  
  
  function configurar_gestores($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $turnoonline_id = $argumentos[0];
    $this->model->turnoonline_id = $turnoonline_id;
    $turnoonline = $this->model->get();
    $areasturnoonline = $this->model->traer_areasturnoonline();
    $this->view->configurar_gestores($turnoonline, $areasturnoonline);
  }
  
  function guardar_area() {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $turnoonline_id = filter_input(INPUT_POST, 'turnoonline_id');
    $this->model->denominacion = filter_input(INPUT_POST, 'denominacion');
    $this->model->cantidad_gestores = filter_input(INPUT_POST, 'cantidad_gestores');
    $this->model->turnoonline_id = $turnoonline_id;
    $this->model->guardar_area();
    header("Location: /" . APP_NAME . "/turnoonline/configurar_gestores/{$turnoonline_id}");
  }
  
  function eliminar_area($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('99');
    $turnoonline_id = $argumentos[0];
    $areaturnoonline_id = $argumentos[1];
    $this->model->areaturnoonline_id = $areaturnoonline_id;
    $this->model->eliminar_area();
    header("Location: /" . APP_NAME . "/turnoonline/configurar_gestores/{$turnoonline_id}");
  }
  
  function guardar_turnoonline() {
    print_r($_POST);exit;
    $this->model->areaturnoonline_id = $areaturnoonline_id;
    $this->model->eliminar_area();
    header("Location: /" . APP_NAME . "/turnoonline/configurar_gestores/{$turnoonline_id}");
  }
}
?>