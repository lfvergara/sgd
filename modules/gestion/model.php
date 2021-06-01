<?php


class Gestion {

	function __construct() {
		$this->gestion_id = 0;
		$this->denominacion = ''; 
		$this->estado = 0; 
	}
  
  function guardar() {
		if($this->gestion_id == 0){
			$sql = "INSERT INTO gestion (denominacion, estado) VALUES (?, ?)";
			$datos = array($this->denominacion,
			               $this->estado);
			$this->gestion_id = execute_query($sql, $datos);
		} else {
			$sql = "UPDATE gestion SET denominacion = ?, estado = ? WHERE gestion_id = ?";
			$datos = array($this->denominacion,
										 $this->estado,
										 $this->gestion_id);
			execute_query($sql, $datos);
		}
	}
  
  function cargar_modelo() {
		$sql = "SELECT
							g.gestion_id,
              g.denominacion,
              g.estado
						FROM 
              gestions g
						WHERE
							g.gestion_id = ?";
		$datos = array($this->gestion_id);
		$rst = execute_query($sql, $datos);
    foreach ($rst[0] as $clave=>$valor) $this->$clave = $valor;
	}
  
  function traer_gestiones() {
    $sql = "SELECT 
              g.gestion_id as gestion_id,
              g.denominacion as denominacion,
              g.estado as estado,
              CASE g.estado WHEN 0 THEN 'danger' ELSE 'success' END as class_estado,
              CASE g.estado WHEN 0 THEN 'times' ELSE 'check' END as icon_estado,
              CASE g.estado WHEN 0 THEN 'Activar' WHEN 1 THEN 'Desactivar' END AS label_estado,
              CASE g.estado WHEN 0 THEN 'activar' WHEN 1 THEN 'desactivar' END AS url_estado
            FROM 
              gestion g
            ORDER BY
              g.denominacion ASC";
		$rst = execute_query($sql);
    if(!is_array[$rst]) $rst = array();
		return $rst;
  }
  
  function get() {
		$sql = "SELECT
							g.gestion_id as gestion_id,
              g.denominacion as denominacion,
              g.estado as estado
						FROM 
              gestion g
						WHERE
							g.gestion_id = ?";
		$datos = array($this->gestion_id);
		$rst = execute_query($sql, $datos);
		return $rst[0];
	}
  
  function eliminar() {
    $sql = "DELETE FROM gestion WHERE gestion_id = ?";
		$datos = array($this->gestion_id);
    execute_query($sql, $datos);
  }
  
  function activar() {
			$sql = "UPDATE gestion SET estado = ? WHERE gestion_id = ?";
			$datos = array(1, $this->gestion_id);
			execute_query($sql, $datos);
	}
  
  function desactivar() {
			$sql = "UPDATE gestion SET estado = ? WHERE gestion_id = ?";
			$datos = array(0, $this->gestion_id);
			execute_query($sql, $datos);
	}
}
?>