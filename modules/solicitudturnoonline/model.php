<?php


class SolicitudTurnoOnLine {

	function __construct() {
		$this->solicitudturnoonline_id = 0;
		$this->fecha = ''; 
		$this->hora = ''; 
		$this->apellido = ''; 
		$this->nombre = ''; 
		$this->documento = ''; 
		$this->matricula = ''; 
		$this->telefono = ''; 
		$this->email = ''; 
		$this->barcode = ''; 
		$this->estado = 0;
		$this->usuario_id = 0; 
		$this->gestion_id = 0; 
		$this->areaturnoonline_id = 0; 
		$this->hora_desde = ''; 
		$this->hora_hasta = ''; 
	}
  
  function guardar() {
		if($this->solicitudturnoonline_id == 0){
			$sql = "INSERT INTO solicitudturnoonline (fecha, hora, apellido, nombre, documento, matricula, telefono, email, barcode, estado, usuario_id, gestion_id, areaturnoonline_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$datos = array($this->fecha,
			               $this->hora,
			               $this->apellido,
			               $this->nombre,
			               $this->documento,
			               $this->matricula,
			               $this->telefono,
			               $this->email,
			               $this->barcode,
			               $this->estado,
			               $this->usuario_id,
			               $this->gestion_id,
			               $this->areaturnoonline_id);
			$this->solicitudturnoonline_id = execute_query($sql, $datos);
		} else {
			$sql = "UPDATE solicitudturnoonline SET fecha = ?, hora = ?, apellido = ?, nombre = ?, documento = ?, matricula = ?, telefono = ?, email = ?, barcode = ?, estado = ?, usuario_id = ?, gestion_id = ?, areaturnoonline_id = ? WHERE solicitudturnoonline_id = ?";
			$datos = array($this->fecha,
			               $this->hora,
			               $this->apellido,
			               $this->nombre,
			               $this->documento,
			               $this->matricula,
			               $this->telefono,
			               $this->email,
			               $this->barcode,
			               $this->estado,
			               $this->usuario_id,
			               $this->gestion_id,
			               $this->areaturnoonline_id,
										 $this->solicitudturnoonline_id);
			execute_query($sql, $datos);
		}
	}
  
  function cargar_modelo() {
		$sql = "SELECT
							sto.solicitudturnoonline_id,
              sto.fecha,
              sto.hora,
              sto.apellido,
              sto.nombre,
              sto.documento,
              sto.matricula,
              sto.telefono,
              sto.email,
              sto.barcode,
              sto.estado,
              sto.usuario_id,
              sto.gestion_id,
              sto.areaturnoonline_id
						FROM 
              solicitudturnoonline sto
						WHERE
							sto.solicitudturnoonline_id = ?";
		$datos = array($this->solicitudturnoonline_id);
		$rst = execute_query($sql, $datos);
    foreach ($rst[0] as $clave=>$valor) $this->$clave = $valor;
	}
  
  function traer_solicitudesturnosonline() {
    $sql = "SELECT 
              sto.solicitudturnoonline_id as solicitudturnoonline_id,
              sto.fecha as fecha,
              sto.hora as hora,
              date_format(sto.fecha, '%d/%m/%Y') as fecha_modificada,
              date_format(sto.hora, '%H:%i:%s') as hora_modificada,
              sto.apellido as apellido,
              sto.nombre as nombre,
              sto.documento as documento,
              sto.matricula as matricula,
              sto.telefono as telefono,
              sto.email as email,
              sto.barcode as barcode,
              sto.usuario_id as usuario_id,
              sto.gestion_id as gestion_id,
              g.denominacion as gestion,
              CASE sto.estado WHEN 0 THEN 'danger' ELSE 'success' END as class_estado,
              CASE sto.estado WHEN 0 THEN 'times' ELSE 'check' END as icon_estado,
              sto.estado as estado,
              CASE sto.estado
                WHEN 0 THEN 'inline-block'
                WHEN 1 THEN 'none'
              END AS display_activar
            FROM 
              solicitudturnoonline sto INNER JOIN
              gestion g ON sto.gestion_id = g.gestion_id INNER JOIN
              areaturnoonline ato ON sto.areaturnoonline_id = ato.areaturnoonline_id
            ORDER BY
              sto.fecha DESC, sto.hora DESC";
		$rst = execute_query($sql);
    if(!is_array[$rst]) $rst = array();
		return $rst;
  }
  
  function get() {
		$sql = "SELECT
							sto.solicitudturnoonline_id as solicitudturnoonline_id,
              sto.fecha as fecha,
              sto.hora as hora,
              date_format(sto.fecha, '%d/%m/%Y') as fecha_modificada,
              date_format(sto.hora, '%H:%i:%s') as hora_modificada,
              sto.apellido as apellido,
              sto.nombre as nombre,
              sto.documento as documento,
              sto.matricula as matricula,
              sto.telefono as telefono,
              sto.email as email,
              sto.barcode as barcode,
              sto.gestion_id as gestion_id,
              g.denominacion as gestion,
              sto.areaturnoonline_id as areaturnoonline_id,
              ato.denominacion as areaturnoonline,
              sto.estado as estado
						FROM 
              solicitudturnoonline sto INNER JOIN
              gestion g ON sto.gestion_id = g.gestion_id INNER JOIN
              areaturnoonline ato ON sto.areaturnoonline_id = ato.areaturnoonline_id
						WHERE
							sto.solicitudturnoonline_id = ?";
		$datos = array($this->solicitudturnoonline_id);
		$rst = execute_query($sql, $datos);
		return $rst[0];
	}
  
  function traer_solicitudturnoonline() {
		$sql = "SELECT
							sto.solicitudturnoonline_id as solicitudturnoonline_id,
              sto.fecha as fecha,
              sto.hora as hora,
              date_format(sto.fecha, '%d/%m/%Y') as fecha_modificada,
              date_format(sto.hora, '%H:%i:%s') as hora_modificada,
              sto.apellido as apellido,
              sto.nombre as nombre,
              sto.documento as documento,
              sto.matricula as matricula,
              sto.telefono as telefono,
              sto.email as email,
              sto.barcode as barcode,
              sto.gestion_id as gestion_id,
              g.denominacion as gestion,
              sto.areaturnoonline_id as areaturnoonline_id,
              ato.denominacion as areaturnoonline,
              sto.estado as estado
						FROM 
              solicitudturnoonline sto INNER JOIN
              gestion g ON sto.gestion_id = g.gestion_id INNER JOIN
              areaturnoonline ato ON sto.areaturnoonline_id = ato.areaturnoonline_id
						WHERE
							sto.barcode = ?";
		$datos = array($this->barcode);
		$rst = execute_query($sql, $datos);
		return $rst[0];
	}
  
  function eliminar() {
    $sql = "DELETE FROM solicitudturnoonline WHERE solicitudturnoonline_id = ?";
		$datos = array($this->solicitudturnoonline_id);
    execute_query($sql, $datos);
  }
  
  function cambiar_estado() {
			$sql = "UPDATE solicitudturnoonline SET estado = ? WHERE solicitudturnoonline_id = ?";
			$datos = array($this->estado, $this->solicitudturnoonline_id);
			execute_query($sql, $datos);
	}
  
  function actualiza_codebar() {
			$sql = "UPDATE solicitudturnoonline SET barcode = ? WHERE solicitudturnoonline_id = ?";
			$datos = array($this->barcode, $this->solicitudturnoonline_id);
			execute_query($sql, $datos);
	}
  
  function atender_solicitudturnoonline() {
			$sql = "UPDATE solicitudturnoonline SET usuario_id = ?, estado = ? WHERE solicitudturnoonline_id = ?";
			$datos = array($this->usuario_id, 1, $this->solicitudturnoonline_id);
			execute_query($sql, $datos);
	}
  
  function cant_atendidos_usuario_fecha() {
    $sql = "SELECT u.denominacion as usuario, COUNT(sto.usuario_id) as cant_usuario FROM solicitudturnoonline sto INNER JOIN usuarios u ON sto.usuario_id = u.usuario_id WHERE sto.fecha = ? AND sto.estado = 1 GROUP BY sto.usuario_id";
    $datos = array($this->fecha);
    $rst = execute_query($sql, $datos);
		return $rst;
  }
  
  function cant_estado_fecha() {
    $sql = "SELECT 
              SUM(IF(sto.estado = 0 And ? > sto.hora, 1, 0)) as ausentes, 
              SUM(IF(sto.estado = 0 And ? < sto.hora, 1, 0)) as pendientes, 
              SUM(IF(sto.estado = 1, 1, 0)) as atendidos 
            FROM 
              solicitudturnoonline sto 
            WHERE 
              sto.fecha = ?";
    $datos = array($this->hora, $this->hora, $this->fecha);
    $rst = execute_query($sql, $datos);
		return $rst[0];
  }
  
  function cant_atendidos_areaturnoonline_fecha() {
    $sql = "SELECT ato.denominacion as area, count(sto.areaturnoonline_id) as cant_area FROM solicitudturnoonline sto INNER JOIN areaturnoonline ato ON sto.areaturnoonline_id = ato.areaturnoonline_id WHERE sto.fecha = ? AND sto.estado = 1 GROUP BY sto.areaturnoonline_id";
    $datos = array($this->fecha);
    $rst = execute_query($sql, $datos);
		return $rst;
  }
  
  function cant_atendidos_gestion_fecha() {
    $sql = "SELECT g.denominacion as gestion, count(sto.gestion_id) as cant_gestion FROM solicitudturnoonline sto INNER JOIN gestion g ON sto.gestion_id = g.gestion_id WHERE sto.fecha = ? AND sto.estado = 1 GROUP BY sto.gestion_id";
    $datos = array($this->fecha);
    $rst = execute_query($sql, $datos);
		return $rst;
  }
  
  function descargar_por_fecha() {
    $sql = "SELECT 
              date_format(sto.fecha, '%d/%m/%Y') AS FECHA,
              date_format(sto.hora, '%H:%i') AS HORA,
              UPPER(CONCAT(sto.apellido, ' ', sto.nombre)) AS PERSONA,
              sto.documento AS DOC,
              IF(sto.matricula IS NULL, '-', sto.matricula) AS MATRICULA,
              UPPER(g.denominacion) AS GESTION,
              UPPER(ato.denominacion) As AREA,
              IF(sto.estado = 0, 'SOLICITADO', 'ATENDIDO') AS ESTADO,
              UPPER(IF(sto.usuario_id = 0, 'SIN ATENDER', u.denominacion)) AS USUARIO
            FROM	
              solicitudturnoonline sto INNER JOIN
              gestion g ON sto.gestion_id = g.gestion_id INNER JOIN
              areaturnoonline ato ON sto.areaturnoonline_id = ato.areaturnoonline_id  LEFT JOIN
              usuarios u ON sto.usuario_id = u.usuario_id
            WHERE
              sto.fecha = ?
            ORDER BY
              sto.fecha ASC, sto.hora ASC";
    $datos = array($this->fecha);
    $rst = execute_query($sql, $datos);
		return $rst;
  }
  
  function descargar_por_fecha_hora() {
    $sql = "SELECT 
              date_format(sto.fecha, '%d/%m/%Y') AS FECHA,
              date_format(sto.hora, '%H:%i') AS HORA,
              UPPER(CONCAT(sto.apellido, ' ', sto.nombre)) AS PERSONA,
              sto.documento AS DOC,
              IF(sto.matricula IS NULL, '-', sto.matricula) AS MATRICULA,
              UPPER(g.denominacion) AS GESTION,
              UPPER(ato.denominacion) As AREA,
              IF(sto.estado = 0, 'SOLICITADO', 'ATENDIDO') AS ESTADO,
              UPPER(IF(sto.usuario_id = 0, 'SIN ATENDER', u.denominacion)) AS USUARIO
            FROM	
              solicitudturnoonline sto INNER JOIN
              gestion g ON sto.gestion_id = g.gestion_id INNER JOIN
              areaturnoonline ato ON sto.areaturnoonline_id = ato.areaturnoonline_id  LEFT JOIN
              usuarios u ON sto.usuario_id = u.usuario_id
            WHERE
              sto.fecha = ? AND
              sto.hora between ? AND ?
            ORDER BY
              sto.fecha ASC, sto.hora ASC";
    $datos = array($this->fecha, $this->hora_desde, $this->hora_hasta);
    $rst = execute_query($sql, $datos);
		return $rst;
  }
}
?>