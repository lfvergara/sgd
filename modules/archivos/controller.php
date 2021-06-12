<?php
require_once "modules/archivos/view.php";
require_once "modules/archivos/model.php";
require_once "tools/PHPExcel/array2excel.php";
require_once "tools/array2pdf.php";

class ArchivosController {

	function __construct() {
		$this->model = new Archivos();
		$this->view = new ArchivosView();
    $this->comprobante = 0;
	}

	function ingresar($argumentos) {
		SessionHandling::check();
    SessionHandling::actualizar();
		switch($argumentos[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"Sólo se admiten archivos PDF.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"El archivo es demasiado grande. El límite de subida es 20MB.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 4:
				$array_msj = array("{mensaje}"=>"El documento se ha subido correctamente. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"block");
        break;
      case 5:
				$array_msj = array("{mensaje}"=>"El número de CUIT es incorrecto, por favor modifique el mismo. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
      case 9:
				$array_msj = array("{mensaje}"=>"Ha ocurrido un error, pruebe nuevamente por favor. Disculpe las molestias, muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
		}
		
		$this->model->tipo = 1;
		$tipos_trabajo = $this->model->listar_tipos_trabajo();
		$entidades = $this->model->listar_entidades();
		$cuentas = $this->model->listar_cuentas();
		$this->view->mostrar_formulario_ingresar($tipos_trabajo, $entidades, $cuentas, $array_msj);
	}
  
  
  function ingresar_con_ajuste($argumentos) {
		SessionHandling::check();

    SessionHandling::actualizar();
		switch($argumentos[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"Sólo se admiten archivos PDF.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"El archivo es demasiado grande. El límite de subida es 20MB.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 4:
				$array_msj = array("{mensaje}"=>"El documento se ha subido correctamente. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"block");
        break;
      case 5:
				$array_msj = array("{mensaje}"=>"El número de CUIT es incorrecto, por favor modifique el mismo. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
      case 9:
				$array_msj = array("{mensaje}"=>"Ha ocurrido un error, pruebe nuevamente por favor. Disculpe las molestias, muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
		}
		
		$this->model->tipo = 1;
		$tipos_trabajo = $this->model->listar_tipos_trabajo();
		$entidades = $this->model->listar_entidades();
		$cuentas = $this->model->listar_cuentas();
		$cantidad_pendientes = $this->model->cantidad_pendientes();
		$this->view->mostrar_formulario_ingresar_con_ajuste($tipos_trabajo, $entidades, $cuentas, $array_msj, $cantidad_pendientes);
	}
	  
	function ingresar_certificacion($argumentos) {
		SessionHandling::check();
    SessionHandling::actualizar();
		switch($argumentos[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"Sólo se admiten archivos PDF.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"El archivo es demasiado grande. El límite de subida es 20MB.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 4:
				$array_msj = array("{mensaje}"=>"El documento se ha subido correctamente. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"block");
        break;
      case 5:
				$array_msj = array("{mensaje}"=>"El número de CUIT es incorrecto, por favor modifique el mismo. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
      case 9:
				$array_msj = array("{mensaje}"=>"Ha ocurrido un error, pruebe nuevamente por favor. Disculpe las molestias, muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
		}
    
		$this->model->tipo = 2;
		$tipos_trabajo = $this->model->listar_tipos_trabajo();
		$entidades = $this->model->listar_entidades();
		$cuentas = $this->model->listar_cuentas();
    $cantidad_pendientes = $this->model->cantidad_pendientes();
		$this->view->mostrar_formulario_ingresar_certificacion($tipos_trabajo, $entidades, $cuentas, $array_msj, $cantidad_pendientes);
	}
	
	function guardar() {
		SessionHandling::check();
		$tipo_id = filter_input(INPUT_POST, "tipo_id");
		$array_temp = array(1,2,34,35,36,37,39);
    $documento = filter_input(INPUT_POST, 'documento');
    
    $matricula = $_SESSION["sesion.matricula"];
    if ($matricula == '') header("Location: /" . APP_NAME . "/archivos/{$redirect}/9");      
    if (is_null($matricula)) header("Location: /" . APP_NAME . "/archivos/{$redirect}/9");      
    if (empty($matricula)) header("Location: /" . APP_NAME . "/archivos/{$redirect}/9");  
      
    
    if (in_array($tipo_id, $array_temp)) {
		  $redirect = "ingresar";
		  $txt_tipo = "Ingresar Documento: EECC";
      $tmp_detalle = "Razón Social: " . $_POST['denominacion'] . "<br> CUIT: " . $documento . "<br> Ejercicio: " . $_POST['ejercicio'];
    } else {
		  $redirect = "ingresar_certificacion";
		  $txt_tipo = "Ingresar Documento: Otros";      
      $tmp_detalle = "Razón Social: " . $_POST['denominacion'] . "<br> CUIT: " . $documento;
    }
    
		$mimes_permitidos = "application/pdf";
    //$bandera_cuit = $this->verificar_cuit_guardar($_POST["documento"]);
    
      if($_FILES['archivo']['error']==0 AND $_FILES['comprobante_pago']['error']==0) {
        $archivo = $_FILES['archivo'];
        $formato = $archivo['type'];
        $tamano = $archivo['size'];

        $comprobante_pago = $_FILES['comprobante_pago'];
        $formato_comprobante_pago = $comprobante_pago['type'];
        $limite_filesize = 20 * 1048576;

        if($formato == $mimes_permitidos) {
          if ($formato_comprobante_pago == $mimes_permitidos) {
            if ($tamano < $limite_filesize) {
              foreach ($_POST as $nombre => $valor) $this->model->$nombre = $valor;
              $this->model->guardar_archivo();		
              
              $archivo_id = $this->model->archivo_id;
              $detalle = "ID: " . $this->model->archivo_id . "<br>";
              $archivo_id = $this->model->archivo_id;
              $detalle = $detalle . $tmp_detalle;
              $detalle_email = $tmp_detalle;
              $this->model->estado_id = 1; # pendiente de ingreso
              $this->model->guardar_seguimiento();

              FileHandler::save_file($archivo, $this->model->archivo_id, $this->model->seguimiento_id);
              FileHandler::save_file($comprobante_pago, $this->model->archivo_id, 'comprobante_pago');
              $auditor_id = Array2Auditor()->saveAuditor($txt_tipo, "Documentos", $detalle);
              $comprobante = "{$archivo_id}-{$documento}-{$auditor_id}";
              $_SESSION["sesion.comprobante_ingreso"] = $comprobante;
              # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
              //$this->envia_email_estado_documento('Pendiente de Ingreso', $detalle_email, $archivo_id);  
              header("Location: /sgd/archivos/{$redirect}/4");
            } else {
              header("Location: /sgd/archivos/{$redirect}/3");	
            }
          } else {
            header("Location: /sgd/archivos/{$redirect}/2");	
          }
        } else {
          header("Location: /sgd/archivos/{$redirect}/2");	
        }
      } else {
        header("Location: /sgd/archivos/{$redirect}/9");	
      }    
  }
	
	function actualizar() {
		SessionHandling::check();
    $detalle = "Razón Social: " . $_POST['denominacion'] . "<br> CUIT: " . $_POST['documento'] . "<br> Ejercicio: " . $_POST['ejercicio'];
		foreach ($_POST as $nombre => $valor) $this->model->$nombre = $valor;
		$this->model->guardar_archivo();		
		Array2Auditor()->saveAuditor('Editar Documento', 'Documentos', $detalle);
		header("Location: /sgd/archivos/ingresar/1");
	}
	
	function ver($argumentos) {
		SessionHandling::check();
    SessionHandling::actualizar();
		$this->model->archivo_id = $argumentos[0];
		$this->model->estado_id = $argumentos[1];
		
		switch ($this->model->estado_id) {
			case 1:
        SessionHandling::checkGrupo(4);
				$html = "evaluar";
				break;
			case 2:
        SessionHandling::checkGrupo(3);
				$html = "autorizar";
				break;
			case 3:
				$html = "autorizar";
				break;
			case 4:
				$html = "corregir";
				break;
			case 7:
				$html = "reingresar";
				break;
      case 8:
				$html = "ver";
				break;
			case 9:
				$html = "legalizar";
				break;
			default:
				$html = "ver";
				break;
		}
		
		$archivo = $this->model->get();
		$seguimiento = $this->model->ver_detalle();
		$this->view->mostrar_detalle($archivo, $seguimiento, $html);
	}
  
  function ver_detalle_autorizar($argumentos) {
		SessionHandling::check();
    SessionHandling::actualizar();
    SessionHandling::checkGrupo(3);
		$this->model->archivo_id = $argumentos[0];
		$this->model->estado_id = $argumentos[1];
    $archivo = $this->model->get();
		$seguimiento = $this->model->ver_detalle();
    $matriculado = $this->model->traer_matriculado($archivo['matricula']);
    $this->view->mostrar_detalle_autorizar($archivo, $seguimiento, $matriculado);
	}
	
	function editar($argumentos) {
		SessionHandling::check();
    SessionHandling::actualizar();
		$archivo_id = $argumentos[0];
		$this->model->archivo_id = $archivo_id;
		$archivo = $this->model->get();
		$this->model->tipo = $archivo["tipo"];
		$tipos_trabajo = $this->model->listar_tipos_trabajo();
		$entidades = $this->model->listar_entidades();
		$cuentas = $this->model->listar_cuentas();
		$this->view->mostrar_formulario_editar($archivo, $tipos_trabajo, $entidades, $cuentas);
	}
	
	function eliminar_pendiente($argumentos) {
		SessionHandling::check();
		$archivo_id = filter_input(INPUT_POST,"archivo_id");
		$motivo = filter_input(INPUT_POST,"motivo");
		$this->model->archivo_id = $archivo_id;
    $array_archivo = $this->model->get();
    $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"] . "<br>Motivo: " . $motivo;
		$this->model->eliminar_pendiente();
		FileHandler::delete_files($archivo_id);
    Array2Auditor()->saveAuditor('Eliminar Documento Pendiente de Ingreso', 'Documentos', $detalle);
		header("Location: /sgd/archivos/buscar");
	}
	
	function reingreso() {
		SessionHandling::check();
		
		$archivo_id = filter_input(INPUT_POST, "archivo_id");
		$this->model->archivo_id = $archivo_id;
    $array_archivo = $this->model->get();
    $documento = $array_archivo["documento"];
    $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $documento . "<br>Ejercicio: " . $array_archivo["ejercicio"];
    $detalle_email = "Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $documento . "<br>Ejercicio: " . $array_archivo["ejercicio"];
    $this->model = new Archivos();
		$this->model->archivo_id = $archivo_id;
		$mimes_permitidos = array("application/pdf");
    $limite_filesize = 20 * 1048576;
		if($_FILES['archivo']['error']==0) {
			$archivo = $_FILES['archivo'];
			$formato = $archivo['type'];
			$tamano = $archivo['size'];
			
			if (in_array($formato, $mimes_permitidos)) {
				if ($tamano < $limite_filesize) {
					$this->model->comentario = filter_input(INPUT_POST, "comentario");
					$this->model->estado_id = 1; # pendiente de ingreso
					$this->model->guardar_seguimiento();
          
					FileHandler::save_file($archivo, $this->model->archivo_id, $this->model->seguimiento_id);
          $auditor_id = Array2Auditor()->saveAuditor('Reingresa Documento', 'Documentos', $detalle);
          $comprobante = "{$archivo_id}-{$documento}-{$auditor_id}";
          $_SESSION["sesion.comprobante_ingreso"] = $comprobante;
					if($_FILES['comprobante_pago']['error']==0) {
						$comprobante_pago = $_FILES['comprobante_pago'];
						$formato_comprobante_pago = $comprobante_pago['type'];
						if (in_array($formato_comprobante_pago, $mimes_permitidos)) {
							FileHandler::save_file($comprobante_pago, $this->model->archivo_id, 'comprobante_pago');
						}
					}
          
          # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
          //$this->envia_email_estado_documento('Documento Reingresado', $detalle_email, $archivo_id);
					header("Location: /sgd/archivos/reingresar_documento/4");
				} else {
					header("Location: /sgd/archivos/reingresar_documento/3");	
				}
			} else {
				header("Location: /sgd/archivos/reingresar_documento/2");	
			}
		} else {
			header("Location: /sgd/archivos/reingresar_documento/9");
		}
	}
	
	function autorizar($argumentos) {
		SessionHandling::check();
    SessionHandling::checkGrupo(3);		
    
    switch($argumentos[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"Sólo se admiten archivos PDF.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"El archivo es demasiado grande. El límite de subida es 20MB.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 4:
				$array_msj = array("{mensaje}"=>"El documento se ha observado correctamente. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"block");
        break;
      case 5:
				$array_msj = array("{mensaje}"=>"El documento se ha aceptado correctamente. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"block");
        break;
      case 9:
				$array_msj = array("{mensaje}"=>"Ha ocurrido un error, pruebe nuevamente por favor. Disculpe las molestias, muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
      default:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
		}
    
    
		$datos = $this->model->listar_autorizacion();
		$estado = "Pendiente evaluación";
		$this->view->mostrar_listado_autorizacion($datos, $estado, $array_msj);
	}
  
  function autorizar_usuario() {
		SessionHandling::check();
		$datos = $this->model->listar_autorizacion_usuario();
		$estado = "Pendiente evaluación";
		$this->view->mostrar_listado_autorizacion_usuario($datos, $estado);
	}
  
  function reingresar_documento($argumentos) {
		SessionHandling::check();
    SessionHandling::actualizar();
    switch($argumentos[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"Sólo se admiten archivos PDF.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"El archivo es demasiado grande. El límite de subida es 20MB.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 4:
				$array_msj = array("{mensaje}"=>"El documento se ha reingresado correctamente. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"block");
        break;
      case 9:
				$array_msj = array("{mensaje}"=>"Ha ocurrido un error, pruebe nuevamente por favor. Disculpe las molestias, muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
		}
		
    $this->model->estado_id = 4;
		$datos1 = $this->model->listar_estado_usuario();
    if(!is_array($datos1)) $datos1 = array();
    $this->model->estado_id = 7;
		$datos2 = $this->model->listar_estado_usuario();
    if(!is_array($datos2)) $datos2 = array();
    $datos = array_merge($datos1, $datos2);
    $estado = "Documentos pendientes";
		$this->view->mostrar_listado_documentos_pendientes($datos, $estado, $array_msj);
	}
  
 	function corregir($argumentos) {
		SessionHandling::check();
    SessionHandling::actualizar();
    switch($argumentos[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"Sólo se admiten archivos PDF.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"El archivo es demasiado grande. El límite de subida es 20MB.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 4:
				$array_msj = array("{mensaje}"=>"El documento se ha reingresado correctamente. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"block");
        break;
      case 9:
				$array_msj = array("{mensaje}"=>"Ha ocurrido un error, pruebe nuevamente por favor. Disculpe las molestias, muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
		}
		$this->model->estado_id = 4;
		$datos = $this->model->listar_estado_usuario();
		$estado = "Observado";
		$this->view->mostrar_listado_corregir($datos, $estado, $array_msj);
	}
	
	function reingresar($argumentos) {
		SessionHandling::check();
    SessionHandling::actualizar();
    switch($argumentos[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"Sólo se admiten archivos PDF.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"El archivo es demasiado grande. El límite de subida es 20MB.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
				break;
			case 4:
				$array_msj = array("{mensaje}"=>"El documento se ha reingresado correctamente. Muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"block");
        break;
      case 9:
				$array_msj = array("{mensaje}"=>"Ha ocurrido un error, pruebe nuevamente por favor. Disculpe las molestias, muchas gracias.",
													 "{display}"=>"show",
                           "{btn_comprobante_display}"=>"none");
        break;
		}
		$this->model->estado_id = 7;
		$datos = $this->model->listar_estado_usuario();
		$estado = "Rechazado";
		$this->view->mostrar_listado_reingresar($datos, $estado, $array_msj);
	}
	
	function pendientes_usuario() {
		SessionHandling::check();
    SessionHandling::actualizar();
		$this->model->estado_id = 1;
		$datos = $this->model->listar_estado_usuario();
		$estado = "Pendientes de ingreso";
		$this->view->mostrar_pendientes($datos, $estado);
	}
	
	function evaluar() {
		SessionHandling::check();
		SessionHandling::checkGrupo(4);
    $datos = $this->model->listar_evaluacion();
    
    foreach ($datos as $clave=>$valor) {
      $archivo_id = $valor['archivo_id'];
      $rechazo = $this->model->verificar_rechazo($archivo_id);
      $datos[$clave]['class_icon'] = $rechazo;
    }
    
		$estado = "Pendiente de ingreso";
		$this->view->mostrar_listado_evaluar($datos, $estado);
	}
	
	function aprobados() {
		SessionHandling::check();
    SessionHandling::actualizar();
		$this->model->estado_id = 6;
		$datos = $this->model->listar_estado_usuario();
		$this->view->aprobados($datos);
	}
	
	function legalizar() {
		SessionHandling::check();
    SessionHandling::checkGrupo('3,5');
		$this->model->estado_id = 9;
		$estado = "Legalizar";
		$datos = $this->model->listar_estado();
		$this->view->mostrar_listado_legalizar($datos, $estado);
	}
  
  function legalizar_usuario() {
		SessionHandling::check();
		$this->model->estado_id = 9;
		$estado = "Legalizar";
		$datos = $this->model->listar_estado_usuario_legalizar();
		$this->view->mostrar_listado_legalizar_usuario($datos, $estado);
	}
  
  function listar_validar($argumentos) {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);		
    
    switch($argumentos[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"El documento fue validado correctamente!",
													 "{display}"=>"show");
				break;
			default:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none");
				break;
		}
    
		$datos = $this->model->listar_validacion();
		$estado = "Pendiente validación";
		$this->view->mostrar_listado_validacion($datos, $estado, $array_msj);
	}
	
	function validar_documento($argumentos) {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);
		
    $archivo_id = $argumentos[0];
		$this->model->archivo_id = $archivo_id;
    $archivo = $this->model->get();
    $tipo_id = $archivo['tipo_id'];
		$tipo_trabajo = $this->model->verificar_tipo_archivo($tipo_id);
    
    $this->model->tipo = $tipo_trabajo;
		$tipos_trabajo = $this->model->listar_tipos_trabajo();
    
    if($tipo_trabajo == 1) {
      $tipo_id = $archivo["tipo_id"];
		  $documento = $archivo["documento"];
      $fecha_inicio = str_replace("-", "", $archivo["fecha_editar_inicio"]);
      $fecha_cierre = str_replace("-", "", $archivo["fecha_editar_cierre"]);
      $fecha_informe = str_replace("-", "", $archivo["fecha_editar_informe"]);
      $ejercicio = $archivo["ejercicio"];
      $activo_corriente = $archivo["activo_corriente"];
      $activo_corriente = $activo_corriente * 100;
      $activo_nocorriente = $archivo["activo_nocorriente"];
      $activo_nocorriente = $activo_nocorriente * 100;
      $pasivo_corriente = $archivo["pasivo_corriente"];
      $pasivo_corriente = $pasivo_corriente * 100;
      $pasivo_nocorriente = $archivo["pasivo_nocorriente"];
      $pasivo_nocorriente = $pasivo_nocorriente * 100;
      $patrimonio_neto = $archivo["patrimonio_neto"];
      $patrimonio_neto = $patrimonio_neto * 100;
      $bienes_uso = $archivo["bienes_uso"];
      $bienes_uso = $bienes_uso * 100;
      $venta_neta = $archivo["venta_neta"];
      $venta_neta = $venta_neta * 100;
      $resultado_final = $archivo["resultado_final"];
      $resultado_final = $resultado_final * 100;
      
      $codigo_barras = $tipo_id . $documento . $fecha_inicio . $fecha_cierre . $fecha_informe . $ejercicio . $activo_corriente . $activo_nocorriente . $pasivo_corriente . $pasivo_nocorriente;
      $codigo_barras .= $patrimonio_neto . $bienes_uso . $venta_neta . $resultado_final;
		  $codigo_barras = hash(md5, $codigo_barras);
      
      $this->model->actualizar_codigo_barras($codigo_barras, $archivo_id);
      $array_verificar = array("{verificar-archivo_id}"=>$archivo_id,
                               "{verificar-tipo_id}"=>$tipo_id,
                               "{verificar-documento}"=>$documento,
                               "{verificar-fecha_inicio}"=>$archivo["fecha_editar_inicio"],
                               "{verificar-fecha_cierre}"=>$archivo["fecha_editar_cierre"],
                               "{verificar-fecha_informe}"=>$archivo["fecha_editar_informe"],
                               "{verificar-ejercicio}"=>$ejercicio,
                               "{verificar-activo_corriente}"=>$archivo["activo_corriente"],
                               "{verificar-activo_nocorriente}"=>$archivo["activo_nocorriente"],
                               "{verificar-pasivo_corriente}"=>$archivo["pasivo_corriente"],
                               "{verificar-pasivo_nocorriente}"=>$archivo["pasivo_nocorriente"],
                               "{verificar-patrimonio_neto}"=>$archivo["patrimonio_neto"],
                               "{verificar-bienes_uso}"=>$archivo["bienes_uso"],
                               "{verificar-venta_neta}"=>$archivo["venta_neta"],
                               "{verificar-resultado_final}"=>$archivo["resultado_final"],
                               "{verificar-codigo_barras}"=>$codigo_barras);      
      
      $this->view->mostrar_formulario_validar_tipo1($tipos_trabajo, $archivo, $array_verificar);
    } else {
      $tipo_id = $archivo["tipo_id"];
		  $documento = $archivo["documento"];
      $fecha_inicio = str_replace("-", "", $archivo["fecha_editar_inicio"]);
      $fecha_cierre = str_replace("-", "", $archivo["fecha_editar_cierre"]);
      $fecha_informe = str_replace("-", "", $archivo["fecha_editar_informe"]);
      
      $codigo_barras = $tipo_id . $documento . $fecha_inicio . $fecha_cierre . $fecha_informe;
      $codigo_barras = hash(md5, $codigo_barras);
      
      $this->model->actualizar_codigo_barras($codigo_barras, $archivo_id);
      $array_verificar = array("{verificar-archivo_id}"=>$archivo_id,
                               "{verificar-tipo_id}"=>$tipo_id,
                               "{verificar-documento}"=>$documento,
                               "{verificar-fecha_inicio}"=>$archivo["fecha_editar_inicio"],
                               "{verificar-fecha_cierre}"=>$archivo["fecha_editar_cierre"],
                               "{verificar-fecha_informe}"=>$archivo["fecha_editar_informe"],
                               "{verificar-codigo_barras}"=>$codigo_barras);     
      
		  $this->view->mostrar_formulario_validar_tipo2($tipos_trabajo, $archivo, $array_verificar);
    }
	}
  
  function guardar_validacion_tipo1() {
		SessionHandling::check();
		SessionHandling::checkGrupo(4);
		$archivo_id = filter_input(INPUT_POST, "archivo_id");
		$tipo_id = filter_input(INPUT_POST, "tipo_id");
		$documento = filter_input(INPUT_POST, "documento");
		$fecha_inicio = str_replace("-", "", filter_input(INPUT_POST, "fecha_inicio"));
		$fecha_cierre = str_replace("-", "", filter_input(INPUT_POST, "fecha_cierre"));
		$fecha_informe = str_replace("-", "", filter_input(INPUT_POST, "fecha_informe"));
		$ejercicio = filter_input(INPUT_POST, "ejercicio");
		$activo_corriente = filter_input(INPUT_POST, "activo_corriente");
		$activo_corriente = $activo_corriente * 100;
		$activo_nocorriente = filter_input(INPUT_POST, "activo_nocorriente");
		$activo_nocorriente = $activo_nocorriente * 100;
		$pasivo_corriente = filter_input(INPUT_POST, "pasivo_corriente");
		$pasivo_corriente = $pasivo_corriente * 100;
		$pasivo_nocorriente = filter_input(INPUT_POST, "pasivo_nocorriente");
		$pasivo_nocorriente = $pasivo_nocorriente * 100;
		$patrimonio_neto = filter_input(INPUT_POST, "patrimonio_neto");
		$patrimonio_neto = $patrimonio_neto * 100;
		$bienes_uso = filter_input(INPUT_POST, "bienes_uso");
		$bienes_uso = $bienes_uso * 100;
		$venta_neta = filter_input(INPUT_POST, "venta_neta");
		$venta_neta = $venta_neta * 100;
		$resultado_final = filter_input(INPUT_POST, "resultado_final");
		$resultado_final = $resultado_final * 100;
		$codigo_barras = filter_input(INPUT_POST, "codigo_barras");
		
		$this->model->archivo_id = $archivo_id;
    $array_archivo = $this->model->get();
    $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
    $detalle_email = "Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
		$this->model->comentario = "Validado por {$_SESSION['sesion.denominacion']}";
		$this->model->estado_id = 9; # Validado
		$this->model->guardar_seguimiento();
		$cod_mensaje = 2;
    Array2Auditor()->saveAuditor('Guarda Validación de Documento', 'Documentos', $detalle);
    # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
    //$this->envia_email_estado_documento('Documento Validado', $detalle_email, $archivo_id);
		header("Location: /sgd/archivos/listar_validar/{$cod_mensaje}");
	}
  
  function guardar_validacion_tipo2() {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);
		$archivo_id = filter_input(INPUT_POST, "archivo_id");
		$tipo_id = filter_input(INPUT_POST, "tipo_id");
		$documento = filter_input(INPUT_POST, "documento");
		$fecha_inicio = str_replace("-", "", filter_input(INPUT_POST, "fecha_inicio"));
		$fecha_cierre = str_replace("-", "", filter_input(INPUT_POST, "fecha_cierre"));
		$fecha_informe = str_replace("-", "", filter_input(INPUT_POST, "fecha_informe"));
		$codigo_barras = filter_input(INPUT_POST, "codigo_barras");
		
		$code_bar = $tipo_id . $documento . $fecha_inicio . $fecha_cierre . $fecha_informe;
		$code_bar = hash(md5, $code_bar);
		$code_bar_modificado = "*" . strtoupper($code_bar) . "*";
		
		$this->model->archivo_id = $archivo_id;
    $array_archivo = $this->model->get();
    $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
    $detalle_email = "Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
    $this->model = new Archivos;
    $this->model->archivo_id = $archivo_id;
    $this->model->comentario = "Validado por {$_SESSION['sesion.denominacion']}";
    $this->model->estado_id = 9; # Validado
    $this->model->guardar_seguimiento();
    $cod_mensaje = 2;
    Array2Auditor()->saveAuditor('Guarda Validación de Certificación', 'Documentos', $detalle);
    # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
    //$this->envia_email_estado_documento('Documento Validado', $detalle_email, $archivo_id);
		header("Location: /sgd/archivos/listar_validar/{$cod_mensaje}");
	}
  
  function validar($arg) {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);
		switch($arg[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"El documento fue validado correctamente!",
													 "{display}"=>"show");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"Existen incosistencias en los datos cargados. Por favor verifiquelos.",
													 "{display}"=>"show");
				break;
		}
		
		$this->model->tipo = 1;
		$tipos_trabajo = $this->model->listar_tipos_trabajo();
		$this->view->mostrar_formulario_validar($tipos_trabajo, $array_msj);
	}
	
	function validar_certificacion($arg) {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);
		switch($arg[0]) {
			case 1:
				$array_msj = array("{mensaje}"=>"",
													 "{display}"=>"none");
				break;
			case 2:
				$array_msj = array("{mensaje}"=>"El documento fue validado correctamente!",
													 "{display}"=>"show");
				break;
			case 3:
				$array_msj = array("{mensaje}"=>"Existen incosistencias en los datos cargados. Por favor verifiquelos.",
													 "{display}"=>"show");
				break;
		}
		
		$this->model->tipo = 2;
		$tipos_trabajo = $this->model->listar_tipos_trabajo();
		$this->view->mostrar_formulario_validar_certificacion($tipos_trabajo, $array_msj);
	}
	
	function consultar($argumentos) {
		SessionHandling::check();
		$this->model->archivo_id = $argumentos[0];
		$this->model->estado_id = $argumentos[1];
		$archivo = $this->model->get();
		$seguimiento = $this->model->ver_detalle();
		$this->view->consultar($archivo, $seguimiento, $argumentos[1]);
	}
  
  function consultar_control_admin($argumentos) {
		SessionHandling::check();
		$this->model->archivo_id = $argumentos[0];
		$this->model->estado_id = $argumentos[1];
		$archivo = $this->model->get();
		$seguimiento = $this->model->ver_detalle();
		$this->view->consultar_control_admin($archivo, $seguimiento, $argumentos[1]);
	}
	
	function guardar_validacion() {
		SessionHandling::check();
		SessionHandling::checkGrupo(4);
		$tipo_id = filter_input(INPUT_POST, "tipo_id");
		$documento = filter_input(INPUT_POST, "documento");
		$fecha_inicio = str_replace("-", "", filter_input(INPUT_POST, "fecha_inicio"));
		$fecha_cierre = str_replace("-", "", filter_input(INPUT_POST, "fecha_cierre"));
		$fecha_informe = str_replace("-", "", filter_input(INPUT_POST, "fecha_informe"));
		$ejercicio = filter_input(INPUT_POST, "ejercicio");
		$activo_corriente = filter_input(INPUT_POST, "activo_corriente");
		$activo_corriente = $activo_corriente * 100;
		$activo_nocorriente = filter_input(INPUT_POST, "activo_nocorriente");
		$activo_nocorriente = $activo_nocorriente * 100;
		$pasivo_corriente = filter_input(INPUT_POST, "pasivo_corriente");
		$pasivo_corriente = $pasivo_corriente * 100;
		$pasivo_nocorriente = filter_input(INPUT_POST, "pasivo_nocorriente");
		$pasivo_nocorriente = $pasivo_nocorriente * 100;
		$patrimonio_neto = filter_input(INPUT_POST, "patrimonio_neto");
		$patrimonio_neto = $patrimonio_neto * 100;
		$bienes_uso = filter_input(INPUT_POST, "bienes_uso");
		$bienes_uso = $bienes_uso * 100;
		$venta_neta = filter_input(INPUT_POST, "venta_neta");
		$venta_neta = $venta_neta * 100;
		$resultado_final = filter_input(INPUT_POST, "resultado_final");
		$resultado_final = $resultado_final * 100;
		$codigo_barras = filter_input(INPUT_POST, "codigo_barras");
		
		$code_bar = $tipo_id . $documento . $fecha_inicio . $fecha_cierre . $fecha_informe . $ejercicio . $activo_corriente . $activo_nocorriente . $pasivo_corriente . $pasivo_nocorriente . $patrimonio_neto . $bienes_uso . $venta_neta . $resultado_final;
		$code_bar = hash(md5, $code_bar);
		$code_bar_modificado = "*" . strtoupper($code_bar) . "*";
		//print_r($code_bar_modificado);exit;
		if($code_bar_modificado == $codigo_barras) {
			$this->model->codigo_barras = $code_bar;
			$archivo_id = $this->model->verifica_codigo_barras();
			
			$this->model->archivo_id = $archivo_id;
      $array_archivo = $this->model->get();
      $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
      $detalle_email = "Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
			$this->model->comentario = "Validado por {$_SESSION['sesion.denominacion']}";
			$this->model->estado_id = 9; # Validado
			$this->model->guardar_seguimiento();
			$cod_mensaje = 2;
      Array2Auditor()->saveAuditor('Guarda Validación de Documento', 'Documentos', $detalle);
      # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
      //$this->envia_email_estado_documento('Documento Validado', $detalle_email, $archivo_id);
		} else {
			$cod_mensaje = 3;      
		}
    	 
		header("Location: /sgd/archivos/validar/{$cod_mensaje}");
	}
	
	function guardar_validacion_certificacion() {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);
		$tipo_id = filter_input(INPUT_POST, "tipo_id");
		$documento = filter_input(INPUT_POST, "documento");
		$fecha_inicio = str_replace("-", "", filter_input(INPUT_POST, "fecha_inicio"));
		$fecha_cierre = str_replace("-", "", filter_input(INPUT_POST, "fecha_cierre"));
		$fecha_informe = str_replace("-", "", filter_input(INPUT_POST, "fecha_informe"));
		$codigo_barras = filter_input(INPUT_POST, "codigo_barras");
		
		$code_bar = $tipo_id . $documento . $fecha_inicio . $fecha_cierre . $fecha_informe;
		$code_bar = hash(md5, $code_bar);
		$code_bar_modificado = "*" . strtoupper($code_bar) . "*";
		
		if($code_bar_modificado == $codigo_barras) {
			$this->model->codigo_barras = $code_bar;
			$archivo_id = $this->model->verifica_codigo_barras();
			
			$this->model->archivo_id = $archivo_id;
      $array_archivo = $this->model->get();
      $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
      $detalle_email = "Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
      $this->model = new Archivos;
			$this->model->archivo_id = $archivo_id;
			$this->model->comentario = "Validado por {$_SESSION['sesion.denominacion']}";
			$this->model->estado_id = 9; # Validado
			$this->model->guardar_seguimiento();
			$cod_mensaje = 2;
      Array2Auditor()->saveAuditor('Guarda Validación de Certificación', 'Documentos', $detalle);
      # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
      //$this->envia_email_estado_documento('Documento Validado', $detalle_email, $archivo_id);
		} else {
			$cod_mensaje = 3;
		}
		header("Location: /sgd/archivos/validar_certificacion/{$cod_mensaje}");
	}
	
	function reenviar() {
		SessionHandling::check();
		
		$archivo_id = filter_input(INPUT_POST, "archivo_id");
		$this->model->archivo_id = $archivo_id;
    $array_archivo = $this->model->get();
    $documento = $array_archivo["documento"];
    $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $documento . "<br>Ejercicio: " . $array_archivo["ejercicio"];
    $detalle_email = "Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $documento . "<br>Ejercicio: " . $array_archivo["ejercicio"];
		$this->model->comentario = filter_input(INPUT_POST, "comentario");
		$this->model->estado_id = 2; # pendiente de revision
		if($_FILES['archivo']['error'] == 0){
			$archivo = $_FILES['archivo'];
			$formato = $archivo['type'];
			$mimes_permitidos = array("application/pdf");
			if (in_array($formato, $mimes_permitidos)) {
				if ($tamano < 2*MB) {
					$this->model->guardar_seguimiento();
					FileHandler::save_file($archivo, $this->model->archivo_id, $this->model->seguimiento_id);
          $auditor_id = Array2Auditor()->saveAuditor('Se Reenvía Documento', 'Documentos', $detalle);
          $comprobante = "{$archivo_id}-{$documento}-{$auditor_id}";
          $_SESSION["sesion.comprobante_ingreso"] = $comprobante;
          # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
          //$this->envia_email_estado_documento('Documento Pendiente de Revisión', $detalle_email, $archivo_id);
					header("Location: /sgd/archivos/reingresar_documento/4");
				} else {
					header("Location: /sgd/archivos/reingresar_documento/3");	
				}
			} else {
				header("Location: /sgd/archivos/reingresar_documento/2");	
			}
		} else {
			/*
      $this->model->guardar_seguimiento();
			header("Location: /sgd/archivos/ver/{$archivo_id}/4");
      */
			header("Location: /sgd/archivos/reingresar_documento/9");
		}
	}
	
	function leer($argumentos) {
		$carpeta = $argumentos[0];
		$archivo = $argumentos[1];
		FileHandler::get_file($carpeta."/".$archivo);
	}
	
	function revisar($argumentos) {
		SessionHandling::check();
    $session_grupo_id = $_SESSION['sesion.grupo_id'];
     
    if ($session_grupo_id == 3) {
      $carpeta = $argumentos[0];
      $archivo_id = $argumentos[0];
      $archivo = $argumentos[1];
      $this->model->archivo_id = $argumentos[0];
      $array_archivo = $this->model->get();
      $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
      $detalle_email = "Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
      $this->model->seguimiento_id = $argumentos[1];
      $this->model->verificar_estado();
      if($this->model->estado_id == 2){
        $this->model->comentario = "Documento en revisión.";
        $this->model->estado_id = 3; # En revisión
        $this->model->guardar_seguimiento();	
        Array2Auditor()->saveAuditor('Documento en Revisión', 'Documentos', $detalle);
        # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
        //$this->envia_email_estado_documento('Documento en Revisión', $detalle_email, $archivo_id);
      }
      
      FileHandler::get_file($carpeta."/".$archivo);
    } else {
			print_r("<h2><center>Sólo los usuarios AUTORIZADORES pueden realizar esta acción!</h2></center>");exit;
    }
    
	}
  
  function ver_archivo_blank($argumentos) {
     $carpeta = $argumentos[0];
     $archivo = $argumentos[1];
     FileHandler::get_file($carpeta."/".$archivo);
  }

	function confirmar() {
		SessionHandling::check();
    SessionHandling::checkGrupo(3);
    $archivo_id = filter_input(INPUT_POST, 'archivo_id');
		$this->model->archivo_id = $archivo_id;
    $array_archivo = $this->model->get();
    $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
    $detalle_email = "Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
		$this->model->estado_id = filter_input(INPUT_POST, 'estado_id');
		if($this->model->estado_id == 6 AND $_POST['comentario']=='') {
      #FIXME SI IN HERE IF IS NECESSARY A BAR CODE
			$this->model->comentario = "Aceptado por {$_SESSION['sesion.denominacion']}";
      Array2Auditor()->saveAuditor('Documento Aceptado', 'Documentos', $detalle);
		  $this->model->guardar_seguimiento();
      //$this->envia_email_estado_documento('Documento Aceptado', $detalle_email, $archivo_id);HOLA
      header("Location: /sgd/archivos/autorizar/5");
		} elseif($this->model->estado_id == 6) {
      #FIXME SI IN HERE IF IS NECESSARY A BAR CODE
			$this->model->comentario = filter_input(INPUT_POST, 'comentario');
		  $this->model->guardar_seguimiento();
      Array2Auditor()->saveAuditor('Documento Aceptado', 'Documentos', $detalle);
      //$this->envia_email_estado_documento('Documento Aceptado', $detalle_email, $archivo_id);HOLA
      header("Location: /sgd/archivos/autorizar/5");
		} else {
      
      $this->model->comentario = filter_input(INPUT_POST, 'comentario');
      $this->model->guardar_seguimiento();
      Array2Auditor()->saveAuditor('Documento Observado', 'Documentos', $detalle);
      if($_FILES['archivo']['error']==0) {
			  $archivo = $_FILES['archivo'];
			  $formato = $archivo['type'];
			  $tamano = $archivo['size'];
      
        $limite_filesize = 20 * 1048576;
        if ($tamano < $limite_filesize) {
          FileHandler::save_file($archivo, $archivo_id, $this->model->seguimiento_id);  
        } 
		  } 
			  
      //$this->envia_email_estado_documento('Documento Observado', $detalle_email, $archivo_id);HOLA
      header("Location: /sgd/archivos/autorizar/4");
		}
  }
	
  
  function confirmar_evaluacion() {
		SessionHandling::check();
		SessionHandling::checkGrupo(0);
    
		$estado_id = filter_input(INPUT_POST, 'estado_id');
		$numero_protocolo = filter_input(INPUT_POST, "numero_protocolo");
		$archivo_id = filter_input(INPUT_POST, 'archivo_id');
		$this->model->archivo_id = $archivo_id;
    $archivo = $this->model->get();
    $detalle = "ID: " . $archivo["archivo_id"] . "<br>Razón Social: " . $archivo["nombre"] . "<br>CUIT: " . $archivo["documento"] . "<br>Ejercicio: " . $archivo["ejercicio"];
    $detalle_email = "Razón Social: " . $archivo["nombre"] . "<br>CUIT: " . $archivo["documento"] . "<br>Ejercicio: " . $archivo["ejercicio"];
		if($_POST['comentario']=='') {
			if ($estado_id == 2 ) {
				$comentario = "Ingresado por {$_SESSION['sesion.denominacion']}";	
        Array2Auditor()->saveAuditor('Documento Ingresado', 'Documentos', $detalle);
        # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
        //$this->envia_email_estado_documento('Documento Ingresado', $detalle_email, $archivo_id);
			} else {
        Array2Auditor()->saveAuditor('Documento Legalizado', 'Documentos', $detalle);
				$comentario = "Legalizado por {$_SESSION['sesion.denominacion']}";
        # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
        //$this->envia_email_estado_documento('Documento Legalizado', $detalle_email, $archivo_id);
			}
		} else {
      if ($estado_id == 2 ) {
				$comentario = "Ingresado por {$_SESSION['sesion.denominacion']}";	
        Array2Auditor()->saveAuditor('Documento Ingresado', 'Documentos', $detalle);
        # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
        //$this->envia_email_estado_documento('Documento Ingresado', $detalle_email, $archivo_id);
			} elseif ($estado_id == 7) {
        Array2Auditor()->saveAuditor('Documento Rechazado', 'Documentos', $detalle);
			  $comentario = filter_input(INPUT_POST, 'comentario');
        //$this->envia_email_estado_documento('Documento Rechazado', $detalle_email, $archivo_id);HOLA
      } else {
        Array2Auditor()->saveAuditor('Documento Legalizado', 'Documentos', $detalle);
				$comentario = "Legalizado por {$_SESSION['sesion.denominacion']}";
        # ANULO ENVÍO DE CORREO INFORMANDO ESTADO DE DOCUMENTO
        //$this->envia_email_estado_documento('Documento Legalizado', $detalle_email, $archivo_id);
      }
		}
		
    $this->model = new Archivos();
		$this->model->archivo_id = $archivo_id;
		$this->model->numero_protocolo = $numero_protocolo;
		$this->model->estado_id = $estado_id;
		$this->model->comentario = $comentario;
		$this->model->guardar_seguimiento();
		switch($estado_id) {
			case '8':
				$this->model->guardar_protocolo();
				header("Location: /sgd/archivos/legalizar");
				break;
			default:
				header("Location: /sgd/archivos/evaluar");
				break;
		}
	}
  
  function reportes() {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);
    $busqueda = 0; 
    if($_POST) {
			$tipo_reporte = filter_input(INPUT_POST, 'tipo_reporte');
			$desde = filter_input(INPUT_POST, 'desde');
			$hasta = filter_input(INPUT_POST, 'hasta');
			$estado_id = filter_input(INPUT_POST, 'estado_id');
      switch($tipo_reporte) {
        case 1:
          $this->model->estado_id = $estado_id;
          $datos = $this->model->listar_estado_reporte();
          break;
        case 2:
          $this->model->estado_id = $estado_id;
          $this->model->desde = $desde;
          $this->model->hasta = $hasta;
          $datos = $this->model->listar_estado_reporte_fecha();
          break;
      }
      
		}
    
    $contador_estados = $this->model->contador_estados();
    $estados = $this->model->listar_estados_seguimiento();
		$this->view->reportes($estados, $datos, $estado_id, $contador_estados);
	}
  
  function reportes_grafico() {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);
    $busqueda = 0; 
    if($_POST) {
			$tipo_reporte = filter_input(INPUT_POST, 'tipo_reporte');
			$desde = filter_input(INPUT_POST, 'desde');
			$hasta = filter_input(INPUT_POST, 'hasta');
			$estado_id = filter_input(INPUT_POST, 'estado_id');
      switch($tipo_reporte) {
        case 1:
          $this->model->estado_id = $estado_id;
          $datos = $this->model->listar_estado_reporte();
          break;
        case 2:
          $this->model->estado_id = $estado_id;
          $this->model->desde = $desde;
          $this->model->hasta = $hasta;
          $datos = $this->model->listar_estado_reporte_fecha();
          break;
      }
      
		}
    
    $graph_desde = filter_input(INPUT_POST, 'graph_desde');
    $graph_hasta = filter_input(INPUT_POST, 'graph_hasta');
    $this->model->desde = $graph_desde;
    $this->model->hasta = $graph_hasta;
    $contador_estados = $this->model->contador_estados_fecha();
    $estados = $this->model->listar_estados_seguimiento();
		$this->view->reportes($estados, $datos, $estado_id, $contador_estados);
	}
  
  function reporte_seguimientos_fecha() {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);
    
    $desde = filter_input(INPUT_POST, 'desde');
    $hasta = filter_input(INPUT_POST, 'hasta');
    $mod_date = strtotime($hasta."+ 1 days");
    $nuevo_hasta = date("Y-m-d",$mod_date);
    
    $datos = $this->model->listar_seguimientos_archivos_fecha($desde, $nuevo_hasta);
    $array_encabezados = array('DOCUMENTO ID', 'DENOMINACIÓN', 'ESTADO', 'FECHA', 'COMENTARIO');
		$array_exportacion = array();
		$array_exportacion[] = $array_encabezados;
		foreach ($datos as $clave=>$valor) {
			$array_temp = array();
			$array_temp = array(
						  $valor["archivo_id"]
						, $valor["denominacion"]
						, $valor["estado"]
						, $valor["fecha"]
						, $valor["comentario"]);
			$array_exportacion[] = $array_temp;
		}
    
    ExcelReport()->extraer_informe($array_exportacion, "Reporte por estado");
	}

	function buscar() {
		SessionHandling::check();
    SessionHandling::actualizar();
		if($_POST) {
			$busqueda = filter_input(INPUT_POST, 'palabra');
			$busqueda = "%{$busqueda}%";
			$datos = $this->model->search($busqueda);
		}

		if(!is_array($datos)) $datos = array();
		$this->view->mostrar_form_buscar($datos);
	}
  
  function admin_control_archivos() {
		SessionHandling::check();
    SessionHandling::checkGrupo(4);
    
    $busqueda = "% %";
    $datos = $this->model->search($busqueda);
		
		if(!is_array($datos)) $datos = array();
		$this->view->mostrar_admin_control($datos);
	}
	
	function descarga_txt_eecc($argumentos) {
		$this->model->archivo_id = $argumentos[0];
		$datos = $this->model->exportar_eecc();
		
		$datos["importe"] = str_replace(".",",",$datos["importe"]);
		$datos["activo_corriente"] = str_replace(".",",",$datos["activo_corriente"]);
		$datos["activo_nocorriente"] = str_replace(".",",",$datos["activo_nocorriente"]);
		$datos["activo"] = str_replace(".",",",$datos["activo"]);
		$datos["pasivo_corriente"] = str_replace(".",",",$datos["pasivo_corriente"]);
		$datos["pasivo_nocorriente"] = str_replace(".",",",$datos["pasivo_nocorriente"]);
		$datos["pasivo"] = str_replace(".",",",$datos["pasivo"]);
		$datos["patrimonio_neto"] = str_replace(".",",",$datos["patrimonio_neto"]);
		$datos["venta_neta"] = str_replace(".",",",$datos["venta_neta"]);
		$datos["bienes_uso"] = str_replace(".",",",$datos["bienes_uso"]);
		$datos["resultado_final"] = str_replace(".",",",$datos["resultado_final"]);
		$datos["resultado_reexpresion_bienes_uso"] = str_replace(".",",",$datos["resultado_reexpresion_bienes_uso"]);
		$filecontent = "";
		foreach ($datos as $clave=>$valor) $filecontent .= "{$valor};";
    
    Array2Auditor()->saveAuditor('Exporta EECC', 'Documentos');
		
		$downloadfile = "archivo_siap.txt";
		header("Content-disposition: attachment; filename=$downloadfile");
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".strlen($filecontent));
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $filecontent;
	}
	
	function descarga_txt_otros($argumentos) {
		$this->model->archivo_id = $argumentos[0];
		$datos = $this->model->exportar_otros();
    $array_archivo = $this->model->get();
    $detalle = "ID: " . $array_archivo["archivo_id"] . "<br>Razón Social: " . $array_archivo["nombre"] . "<br>CUIT: " . $array_archivo["documento"] . "<br>Ejercicio: " . $array_archivo["ejercicio"];
		$datos["importe"] = str_replace(".",",",$datos["importe"]);
		$filecontent = "";
		foreach ($datos as $clave=>$valor) $filecontent .= "{$valor};";
    Array2Auditor()->saveAuditor('Exporta Otros', 'Documentos', $detalle);
		
		$downloadfile = "archivo_siap.txt";
		header("Content-disposition: attachment; filename=$downloadfile");
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".strlen($filecontent));
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $filecontent;
	}
  
  function exportar($argumentos) {
		$this->model->estado_id = $argumentos[0];
    $datos = $this->model->listar_estado_reporte();
    $array_encabezados = array('DENOMINACIÓN', 'DOCUMENTO', 'MATRÍCULA', 'USUARIO', 'FECHA', 'AUTORIZADOR', 'COMENTARIO');
		$array_exportacion = array();
		$array_exportacion[] = $array_encabezados;
		foreach ($datos as $clave=>$valor) {
			$array_temp = array();
			$array_temp = array(
						  $valor["nombre"]
						, $valor["documento"]
						, $valor["matricula"]
						, $valor["denominacion"]
						, $valor["fecha"]
						, $valor["autorizador"]
						, $valor["comentario"]);
			$array_exportacion[] = $array_temp;
		}
    
    Array2Auditor()->saveAuditor('Exporta Reporte', 'Documentos');
    ExcelReport()->extraer_informe($array_exportacion, "Reporte por estado");
  }
	
  function genera_comprobante() {
    Array2PDF()->createPDF($_SESSION["sesion.comprobante_ingreso"]);    
  }
  
	function verificar_ejercicio($argumentos) {
		SessionHandling::check();
		$this->model->ejercicio = $argumentos[0];
		$this->model->documento = $argumentos[1];
		$this->model->fecha_inicio = $argumentos[2];
		$this->model->fecha_cierre = $argumentos[3];
		$rst = $this->model->verificar_ejercicio();
		print $rst;
	}
  
  function info() {
    //print phpinfo();
  }
	
	function verificar_cuit($argumentos) {
		SessionHandling::check();
		$cuit = $argumentos[0];
		$cuit = str_replace("-", "", $cuit);
		
		$cadena = str_split($cuit);
		$result = $cadena[0]*5;
		$result += $cadena[1]*4;
		$result += $cadena[2]*3;
		$result += $cadena[3]*2;
		$result += $cadena[4]*7;
		$result += $cadena[5]*6;
		$result += $cadena[6]*5;
		$result += $cadena[7]*4;
		$result += $cadena[8]*3;
		$result += $cadena[9]*2;
		
		$div = intval($result/11);
		$resto = $result - ($div*11);
		
		if ($resto==0) {
			if ($resto==$cadena[10]) {
				print "Si";
      } else {
				print "No";
      }
    } else if ($resto==1) {
			if ($cadena[10] == 9 AND $cadena[0] == 2 AND $cadena[1] == 3) {
				print "Si";
			} else if ($cadena[10]==4 AND $cadena[0]==2 AND $cadena[1]==3) {
				print "Si";
      }
		} elseif ($cadena[10] == (11-$resto)) {
			print "Si";
    } else {
			print "No";
    }
		
	}
  
  function verificar_cuit_guardar($argumentos) {
		SessionHandling::check();
		$cuit = $argumentos[0];
		$cuit = str_replace("-", "", $cuit);
		
		$cadena = str_split($cuit);
		$result = $cadena[0]*5;
		$result += $cadena[1]*4;
		$result += $cadena[2]*3;
		$result += $cadena[3]*2;
		$result += $cadena[4]*7;
		$result += $cadena[5]*6;
		$result += $cadena[6]*5;
		$result += $cadena[7]*4;
		$result += $cadena[8]*3;
		$result += $cadena[9]*2;
		
		$div = intval($result/11);
		$resto = $result - ($div*11);
		
		if ($resto==0) {
			if ($resto==$cadena[10]) {
				return "Si";
      } else {
				return "No";
      }
    } else if ($resto==1) {
			if ($cadena[10] == 9 AND $cadena[0] == 2 AND $cadena[1] == 3) {
				return "Si";
			} else if ($cadena[10]==4 AND $cadena[0]==2 AND $cadena[1]==3) {
				return "Si";
      }
		} elseif ($cadena[10] == (11-$resto)) {
			return "Si";
    } else {
			return "No";
    }		
	}
  
  function envia_email_estado_documento($estado, $documento_detalle, $archivo_id) {
		SessionHandling::check();
    require_once "tools/mailhandling.php";
    $session_grupo_id = $_SESSION['sesion.grupo_id'];
    $session_usuario_id = $_SESSION['sesion.usuario_id'];
    //if ($session_grupo_id == 99 || $session_usuario_id == 994) {
      $datos_matriculado = $this->model->traer_correo_matriculado_archivo_id($archivo_id);
      if (!empty($datos_matriculado)) {
        if ($datos_matriculado[0]['correoelectronico'] != ' ') {
          $emailHelper = new EmailHelper();
          //$emailHelper->envia_email_estado_documento($datos_matriculado, $documento_detalle, $estado);HOLA
        }
      }
  }
}
?>