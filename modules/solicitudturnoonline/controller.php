<?php
require_once "modules/solicitudturnoonline/view.php";
require_once "modules/solicitudturnoonline/model.php";
require_once "tools/PHPExcel/array2excel.php";


class SolicitudTurnoOnLineController {

	function __construct() {
		$this->model = new SolicitudTurnoOnLine();
		$this->view = new SolicitudTurnoOnLineView();
	}
  
  function guardar_turnoonline() {
    $fecha = filter_input(INPUT_POST, 'dia_solicitud');
    $hora = filter_input(INPUT_POST, 'hora');
    $documento = filter_input(INPUT_POST, 'documento');
    $apellido = strtoupper(filter_input(INPUT_POST, 'apellido'));
    $nombre = strtoupper(filter_input(INPUT_POST, 'nombre'));
    $fecha = str_replace("-", "", $fecha);
    $hora = str_replace(":", "", $hora);
    
    $matriculado = filter_input(INPUT_POST, 'matriculado');
    $this->model->apellido = filter_input(INPUT_POST, 'apellido');
    $this->model->nombre = filter_input(INPUT_POST, 'nombre');
    $this->model->documento = filter_input(INPUT_POST, 'documento');
    $this->model->telefono = filter_input(INPUT_POST, 'telefono');
    $this->model->email = filter_input(INPUT_POST, 'email');
    $this->model->gestion_id = filter_input(INPUT_POST, 'gestion_id');
    $this->model->areaturnoonline_id = filter_input(INPUT_POST, 'areaturnoonline_id');
    $this->model->fecha = filter_input(INPUT_POST, 'dia_solicitud');
    $this->model->hora = filter_input(INPUT_POST, 'hora');
    $this->model->usuario_id = 0;
    $this->model->estado = 0;
    $this->model->barcode = 0;
    if ($matriculado == 0) {
      $this->model->matricula = 0;
    } else {
      $letra = filter_input(INPUT_POST, 'letra');
      $matricula = filter_input(INPUT_POST, 'matricula');
      $this->model->matricula = "{$letra}{$matricula}";
    }
    
    $this->model->guardar();
    $solicitudturnoonline_id = $this->model->solicitudturnoonline_id;
    
    $this->model->solicitudturnoonline_id = $solicitudturnoonline_id;
    $this->model->barcode = "{$solicitudturnoonline_id}{$fecha}{$hora}";
    $this->model->actualiza_codebar();    
    $this->envia_email_turnoonline($solicitudturnoonline_id);    
    
    header("Location: http://cpcelr.org.ar/entrega_turno.php?turno={$solicitudturnoonline_id}");
  }
  
  function envia_email_turnoonline($solicitudturnoonline_id) {
		require_once "tools/mailhandling.php";
    $this->model->solicitudturnoonline_id = $solicitudturnoonline_id;
    $datos = $this->model->get();
    if (!empty($datos)) {
      if ($datos['email'] != ' ') {
        $emailHelper = new EmailHelper();
        $emailHelper->envia_email_turnoonline($datos);
      }
    }
  }
  
  function cargar_turno($argumentos) {
    SessionHandling::check();
    SessionHandling::checkGrupo('1,3,4,5,99');
    
    switch($argumentos[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"El turno solicitado no se encuentra registrado.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"El turno solicitado no corresponde a la fecha actual.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
		}
    
    $this->view->cargar_turno($array_msj);
	}
  
  function ingresar_turno() {
    SessionHandling::check();
    SessionHandling::checkGrupo('1,3,4,5,99');
    
    $barcode = filter_input(INPUT_POST, 'barcode');
    $this->model->barcode = str_replace("*", '', $barcode);
    $datos = $this->model->traer_solicitudturnoonline();
    
    if (!is_array($datos)) {
      header("Location: /sgd/solicitudturnoonline/cargar_turno/2");	
    } else {
      $fecha = $datos['fecha'];
      if ($fecha != date('Y-m-d')) {
        header("Location: /sgd/solicitudturnoonline/cargar_turno/3");	
      } else {
        $usuario_id = $_SESSION["sesion.usuario_id"];
        $solicitudturnoonline_id = $datos['solicitudturnoonline_id'];
        $this->model->usuario_id = $usuario_id;
        $this->model->solicitudturnoonline_id = $solicitudturnoonline_id;
        $this->model->atender_solicitudturnoonline();
        $this->view->datos_turno($datos);
      } 
    }  
	}
  
  function reportes() {
    SessionHandling::check();
    SessionHandling::checkGrupo('1, 99');
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    //$fecha = '2020-05-28';
    $this->model->fecha = $fecha;
    $this->model->hora = $hora;
    $cant_estado_solicitud = $this->model->cant_estado_fecha();
    $cant_usuario_solicitud = $this->model->cant_atendidos_usuario_fecha();
    $cant_area_solicitud = $this->model->cant_atendidos_areaturnoonline_fecha();
    $cant_gestion_solicitud = $this->model->cant_atendidos_gestion_fecha();
    
    $this->view->reportes($cant_usuario_solicitud, $cant_estado_solicitud, $cant_area_solicitud, $cant_gestion_solicitud);
  }
  
  function descargar_por_fecha() {
    SessionHandling::check();
    SessionHandling::checkGrupo('1, 99');
    $fecha = filter_input(INPUT_POST, 'fecha');
    $this->model->fecha = $fecha;
    $datos = $this->model->descargar_por_fecha();
    if (!is_array($datos)) $datos = array();
      
    $array_encabezados = array('FECHA', 'HORA', 'PERSONA', 'DOCUMENTO', 'MATRÍCULA', 'GESTIÓN', 'SECTOR', 'ESTADO', 'USUARIO');
		$array_exportacion = array();
		$array_exportacion[] = $array_encabezados;
		foreach ($datos as $clave=>$valor) {
			$array_temp = array();
			$array_temp = array(
						  $valor["FECHA"]
						, $valor["HORA"]
						, $valor["PERSONA"]
						, $valor["DOC"]
						, $valor["MATRICULA"]
						, $valor["GESTION"]
						, $valor["AREA"]
						, $valor["ESTADO"]
						, $valor["USUARIO"]);
			$array_exportacion[] = $array_temp;
		}
    
    ExcelReport()->extraer_informe($array_exportacion, "Reporte por estado");
  }
  
  function descargar_por_fecha_hora() {
    SessionHandling::check();
    SessionHandling::checkGrupo('1, 99');
    $fecha = filter_input(INPUT_POST, 'fecha');
    $hora_desde = filter_input(INPUT_POST, 'hora_desde');
    $hora_hasta = filter_input(INPUT_POST, 'hora_hasta');
    $this->model->fecha = $fecha;
    $this->model->hora_desde = $hora_desde;
    $this->model->hora_hasta = $hora_hasta;
    $datos = $this->model->descargar_por_fecha_hora();
    if (!is_array($datos)) $datos = array();
      
    $array_encabezados = array('FECHA', 'HORA', 'PERSONA', 'DOCUMENTO', 'MATRÍCULA', 'GESTIÓN', 'SECTOR', 'ESTADO', 'USUARIO');
		$array_exportacion = array();
		$array_exportacion[] = $array_encabezados;
		foreach ($datos as $clave=>$valor) {
			$array_temp = array();
			$array_temp = array(
						  $valor["FECHA"]
						, $valor["HORA"]
						, $valor["PERSONA"]
						, $valor["DOC"]
						, $valor["MATRICULA"]
						, $valor["GESTION"]
						, $valor["AREA"]
						, $valor["ESTADO"]
						, $valor["USUARIO"]);
			$array_exportacion[] = $array_temp;
		}
    
    ExcelReport()->extraer_informe($array_exportacion, "Reporte por estado");
  }
}
?>