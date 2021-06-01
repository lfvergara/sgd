<?php


class Capacitaciones {

	function __construct() {
		$this->capacitacion_id = 0;
		$this->denominacion = ''; 
		$this->detalle = ''; 
		$this->url = ''; 
		$this->fecha = ''; 
	}
  
  function guardar() {
		if($this->capacitacion_id == 0){
			$sql = "INSERT INTO capacitaciones (denominacion, detalle, url, fecha) VALUES (?, ?, ?, ?)";
			$datos = array($this->denominacion, 
			               $this->detalle,
			               $this->url,
			               $this->fecha);
			$this->capacitacion_id = execute_query($sql, $datos);
		} else {
			$sql = "UPDATE capacitaciones SET denominacion = ?, detalle = ?, url = ?, fecha = ? WHERE capacitacion_id = ?";
			$datos = array($this->denominacion,
										 $this->detalle,
										 $this->url,
                     $this->fecha,
										 $this->capacitacion_id);
			execute_query($sql, $datos);
		}
	}
  
  function cargar_modelo() {
		$sql = "SELECT
							c.capacitacion_id,
              c.denominacion,
              c.detalle,
              c.url,
              c.fecha
						FROM 
              capacitaciones c
						WHERE
							c.capacitacion_id = ?";
		$datos = array($this->capacitacion_id);
		$rst = execute_query($sql, $datos);
    foreach ($rst[0] as $clave=>$valor) $this->$clave = $valor;
	}
  
  function traer_capacitaciones() {
    $sql = "SELECT 
              c.capacitacion_id as capacitacion_id,
              c.denominacion as denominacion,
              c.detalle as detalle,
              c.url as url,
              date_format(c.fecha, '%d/%m/%Y') as fecha_modificada,
              c.fecha as fecha
            FROM 
              capacitaciones c
            ORDER BY
              c.fecha DESC";
		$rst = execute_query($sql);
    if(!is_array[$rst]) $rst = array();
		return $rst;
  }
  
  function get() {
		$sql = "SELECT
							c.capacitacion_id as capacitacion_id,
              c.denominacion as denominacion,
              c.detalle as detalle,
              c.url as url,
              c.fecha as fecha
						FROM 
              capacitaciones c
						WHERE
							c.capacitacion_id = ?";
		$datos = array($this->capacitacion_id);
		$rst = execute_query($sql, $datos);
		return $rst[0];
	}
  
  function eliminar() {
    $sql = "DELETE FROM capacitaciones WHERE capacitacion_id = ?";
		$datos = array($this->capacitacion_id);
    execute_query($sql, $datos);
  }
}
?>