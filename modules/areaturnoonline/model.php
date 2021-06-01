<?php


class AreaTurnoOnLine {

	function __construct() {
		$this->areaturnoonline_id = 0;
		$this->denominacion = ''; 
		$this->cantidad_gestores = 0; 
		$this->turnoonline_id = 0; 
	}
  
  function guardar() {
		if($this->areaturnoonline_id == 0){
			$sql = "INSERT INTO areaturnoonline (denominacion, cantidad_gestores, turnoonline_id) VALUES (?, ?, ?)";
			$datos = array($this->denominacion,
			$datos = array($this->cantidad_gestores,
			               $this->turnoonline_id);
			$this->areaturnoonline_id = execute_query($sql, $datos);
		} else {
			$sql = "UPDATE areaturnoonline SET denominacion = ?, cantidad_gestores = ?, turnoonline_id = ? WHERE areaturnoonline_id = ?";
			$datos = array($this->denominacion,
										 $this->cantidad_gestores,
										 $this->turnoonline_id,
										 $this->areaturnoonline_id);
			execute_query($sql, $datos);
		}
	}
  
  function cargar_modelo() {
		$sql = "SELECT
							ato.areaturnoonline_id,
              ato.denominacion,
              ato.cantidad_gestores,
              ato.turnoonline_id
						FROM 
              areaturnoonline ato
						WHERE
							ato.areaturnoonline_id = ?";
		$datos = array($this->areaturnoonline_id);
		$rst = execute_query($sql, $datos);
    foreach ($rst[0] as $clave=>$valor) $this->$clave = $valor;
	}
  
  function traer_areasturnoonline() {
    $sql = "SELECT 
              ato.areaturnoonline_id,
              ato.denominacion,
              ato.cantidad_gestores,
              ato.turnoonline_id
            FROM 
              areaturnoonline ato
            ORDER BY
              ato.denominacion ASC";
		$rst = execute_query($sql);
    if(!is_array[$rst]) $rst = array();
		return $rst;
  }
  
  function get() {
		$sql = "SELECT
							ato.areaturnoonline_id,
              ato.denominacion,
              ato.cantidad_gestores,
              ato.turnoonline_id
						FROM 
              areaturnoonline ato
						WHERE
							ato.areaturnoonline_id = ?";
		$datos = array($this->areaturnoonline_id);
		$rst = execute_query($sql, $datos);
		return $rst[0];
	}
  
  function eliminar() {
    $sql = "DELETE FROM areaturnoonline WHERE areaturnoonline_id = ?";
		$datos = array($this->areaturnoonline_id);
    execute_query($sql, $datos);
  }
}
?>