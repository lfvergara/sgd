<?php


class TurnoOnLine {

	function __construct() {
		$this->turnoonline_id = 0;
		$this->denominacion = ''; 
		$this->cantidad_gestores = 0; 
		$this->fecha_desde = ''; 
		$this->fecha_hasta = ''; 
		$this->hora_desde = ''; 
		$this->hora_hasta = ''; 
		$this->duracion_turno = 0; 
		$this->estado = 0; 
		$this->areaturnoonline_id = 0;
	}
  
  function guardar() {
		if($this->turnoonline_id == 0){
			$sql = "INSERT INTO turnoonline (denominacion, fecha_desde, fecha_hasta, hora_desde, hora_hasta, duracion_turno, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$datos = array($this->denominacion, 
			               $this->fecha_desde,
			               $this->fecha_hasta,
			               $this->hora_desde,
			               $this->hora_hasta,
			               $this->duracion_turno,
			               $this->estado);
			$this->turnoonline_id = execute_query($sql, $datos);
		} else {
			$sql = "UPDATE turnoonline SET denominacion = ?, fecha_desde = ?, fecha_hasta = ?, hora_desde = ?, hora_hasta = ?, duracion_turno = ?, estado = ? WHERE turnoonline_id = ?";
			$datos = array($this->denominacion, 
			               $this->fecha_desde,
			               $this->fecha_hasta,
			               $this->hora_desde,
			               $this->hora_hasta,
			               $this->duracion_turno,
			               $this->estado,
										 $this->turnoonline_id);
			execute_query($sql, $datos);
		}
	}
  
  function cargar_modelo() {
		$sql = "SELECT
							ton.turnoonline_id,
              ton.denominacion,
              ton.fecha_desde,
              ton.fecha_hasta,
              ton.hora_desde,
              ton.hora_hasta,
              ton.duracion_turno,
              ton.estado
						FROM 
              turnoonline ton
						WHERE
							ton.turnoonline_id = ?";
		$datos = array($this->turnoonline_id);
		$rst = execute_query($sql, $datos);
    foreach ($rst[0] as $clave=>$valor) $this->$clave = $valor;
	}
  
  function traer_turnosonline() {
    $sql = "SELECT 
              ton.turnoonline_id as turnoonline_id,
              ton.denominacion as denominacion,
              date_format(ton.fecha_desde, '%d/%m/%Y') as fecha_desde_modificada,
              date_format(ton.fecha_hasta, '%d/%m/%Y') as fecha_hasta_modificada,
              date_format(ton.hora_desde, '%H:%i:%s') as hora_desde_modificada,
              date_format(ton.hora_hasta, '%H:%i:%s') as hora_hasta_modificada,
              ton.duracion_turno as duracion_turno,
              CASE ton.estado WHEN 0 THEN 'danger' ELSE 'success' END as class_estado,
              CASE ton.estado WHEN 0 THEN 'times' ELSE 'check' END as icon_estado,
              ton.estado as estado,
              CASE ton.estado
                WHEN 0 THEN 'inline-block'
                WHEN 1 THEN 'none'
              END AS display_activar
            FROM 
              turnoonline ton
            ORDER BY
              ton.fecha_desde DESC, ton.fecha_hasta DESC";
		$rst = execute_query($sql);
    if(!is_array[$rst]) $rst = array();
		return $rst;
  }
  
  function get() {
		$sql = "SELECT
							ton.turnoonline_id as turnoonline_id,
              ton.denominacion as denominacion,
              ton.fecha_desde as fecha_desde,
              ton.fecha_hasta as fecha_hasta,
              ton.hora_desde as hora_desde,
              ton.hora_hasta as hora_hasta,
              date_format(ton.fecha_desde, '%d/%m/%Y') as fecha_desde_modificada,
              date_format(ton.fecha_hasta, '%d/%m/%Y') as fecha_hasta_modificada,
              date_format(ton.hora_desde, '%H:%i:%s') as hora_desde_modificada,
              date_format(ton.hora_hasta, '%H:%i:%s') as hora_hasta_modificada,
              ton.duracion_turno as duracion_turno,
              ton.estado as estado
						FROM 
              turnoonline ton
						WHERE
							ton.turnoonline_id = ?";
		$datos = array($this->turnoonline_id);
		$rst = execute_query($sql, $datos);
		return $rst[0];
	}
  
  function eliminar() {
    $sql = "DELETE FROM turnoonline WHERE turnoonline_id = ?";
		$datos = array($this->turnoonline_id);
    execute_query($sql, $datos);
  }
  
  function activar_configuracion() {
    $sql = "UPDATE turnoonline SET estado = ? WHERE turnoonline_id = ?";
    $datos = array(1, $this->turnoonline_id);
    execute_query($sql, $datos);
	}
  
  function desactivar_configuraciones() {
    $sql = "UPDATE turnoonline SET estado = ?";
    $datos = array(0);
    execute_query($sql, $datos);
	}
  
  function traer_areasturnoonline() {
    $sql = "SELECT 
              aton.areaturnoonline_id as areaturnoonline_id,
              aton.denominacion as denominacion,
              aton.cantidad_gestores as cantidad_gestores,
              aton.turnoonline_id as turnoonline_id
            FROM 
              areaturnoonline aton
            WHERE
              aton.turnoonline_id = ?
            ORDER BY
              aton.denominacion ASC";
    $datos = array($this->turnoonline_id);
		$rst = execute_query($sql, $datos);
    if(!is_array[$rst]) $rst = array();
		return $rst;
  }
  
  function guardar_area() {		
    $sql = "INSERT INTO areaturnoonline (denominacion, cantidad_gestores, turnoonline_id) VALUES (?, ?, ?)";
    $datos = array($this->denominacion, 
                   $this->cantidad_gestores,
                   $this->turnoonline_id);
    $this->areaturnoonline_id = execute_query($sql, $datos);
	}
  
  function eliminar_area() {
    $sql = "DELETE FROM areaturnoonline WHERE areaturnoonline_id = ?";
		$datos = array($this->areaturnoonline_id);
    execute_query($sql, $datos);
  }
}
?>