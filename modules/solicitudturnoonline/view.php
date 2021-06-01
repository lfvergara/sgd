<?php


class SolicitudTurnoOnLineView extends View{
  
  function cargar_turno($array_msj) {
		$gui = file_get_contents("static/modules/solicitudturnoonline/cargar_turno.html");
		$menu = file_get_contents("static/menu.html");
		
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
    $dict = array("{titulo}"=>"Atención Turno OnLine");
    
		$render = $this->render($dict, $gui);
    $render = $this->render($array_msj, $render);
		print $this->render_template($menu, $render);
	}
  
  function datos_turno($solicitudturnoonline) {
    $gui = file_get_contents("static/modules/solicitudturnoonline/datos_turno.html");
		$menu = file_get_contents("static/menu.html");
    
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
		$dict = array("{titulo}"=>"Atención Turno OnLine");
    
    $solicitudturnoonline = $this->set_dict($solicitudturnoonline);
    $render = $this->render($solicitudturnoonline, $gui);
		$render = $this->render($dict, $render);
		print $this->render_template($menu, $render);
  }
  
  function reportes($cant_usuario_solicitud, $cant_estado_solicitud, $cant_area_solicitud, $cant_gestion_solicitud) {
    $gui = file_get_contents("static/modules/solicitudturnoonline/reporte.html");
    $tbl_cantidad_gestion = file_get_contents("static/modules/solicitudturnoonline/tbl_cantidad_gestion.html");
    $tbl_cantidad_area = file_get_contents("static/modules/solicitudturnoonline/tbl_cantidad_area.html");
    $graf_usuario_solicitud = file_get_contents("static/modules/solicitudturnoonline/graf_usuario_solicitud.html");
		$menu = file_get_contents("static/menu.html");
    
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
		$dict = array("{titulo}"=>"Reportes de Turnos OnLine");
    
    $array_colores = array('#ff8789', '#87ffc2', '#8a92ff', '#fa5457', '#bfff87', '#fa87ff', '#e3ff87', '#ff989b', '#ffec85', '#ffa088', '#8a92ff', '#ffc887');
    $i = 0;
    foreach ($cant_usuario_solicitud as $clave=>$valor) {
      $cant_usuario_solicitud[$clave]['color'] = $array_colores[$i]; 
      $i = $i + 1;
    }
    
    $cant_estado_solicitud = $this->set_dict($cant_estado_solicitud);
    $tbl_cantidad_gestion = $this->render_regex("repetir", $tbl_cantidad_gestion, $cant_gestion_solicitud); 
    $tbl_cantidad_area = $this->render_regex("repetir", $tbl_cantidad_area, $cant_area_solicitud); 
    $graf_usuario_solicitud = $this->render_regex("repetir", $graf_usuario_solicitud, $cant_usuario_solicitud); 
    $graf_usuario_solicitud = str_replace('<!--repetir-->', '', $graf_usuario_solicitud);
    
    $render = str_replace('{tbl_cantidad_gestion}', $tbl_cantidad_gestion, $gui);
    $render = str_replace('{tbl_cantidad_area}', $tbl_cantidad_area, $render);
    $render = str_replace('{graf_usuario_solicitud}', $graf_usuario_solicitud, $render);
    $render = $this->render($cant_estado_solicitud, $render);
		$render = $this->render($dict, $render);
    $render = str_replace('{theme_path}', THEME_PATH, $render);
		print $this->render_template($menu, $render);
  }
}
?>