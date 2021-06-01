<?php


class CapacitacionesView extends View{
  function panel($capacitaciones) {
		$gui = file_get_contents("static/modules/capacitaciones/panel.html");
		$gui_tbl_capacitaciones = file_get_contents("static/modules/capacitaciones/tbl_capacitaciones.html");
		$menu = file_get_contents("static/menu.html");
    
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
		$dict = array("{titulo}"=>"Gestión de Capacitaciones");
    
    if(!is_array($capacitaciones))$capacitaciones=array();
		$gui_tbl_capacitaciones = $this->render_regex("repetir", $gui_tbl_capacitaciones, $capacitaciones);
    $render = str_replace('{tbl_capacitaciones}', $gui_tbl_capacitaciones, $gui);
		$render = $this->render($dict, $render);
		print $this->render_template($menu, $render);
	}
  
  function capacitaciones($capacitaciones) {
		$gui = file_get_contents("static/modules/capacitaciones/capacitaciones.html");
		$gui_tbl_capacitaciones = file_get_contents("static/modules/capacitaciones/tbl_capacitaciones_matriculado.html");
		$menu = file_get_contents("static/menu.html");
    
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
		$dict = array("{titulo}"=>"Espacio de Capacitación");
    
    if(!is_array($capacitaciones))$capacitaciones=array();
		$gui_tbl_capacitaciones = $this->render_regex("repetir", $gui_tbl_capacitaciones, $capacitaciones);
    $render = str_replace('{tbl_capacitaciones}', $gui_tbl_capacitaciones, $gui);
		$render = $this->render($dict, $render);
		print $this->render_template($menu, $render);
	}
  
  function traer_form_editar_capacitacion_ajax($capacitacion) {
		$gui = file_get_contents("static/modules/capacitaciones/form_editar_capacitacion_ajax.html");
    
    $capacitacion = $this->set_dict($capacitacion);
		$gui = $this->render($capacitacion, $gui);
		$gui = str_replace('{app_name}', APP_NAME, $gui);
    print $gui;
	}
  
  function consultar_capacitacion_ajax($capacitacion) {
		$gui = file_get_contents("static/modules/capacitaciones/consultar_capacitacion_ajax.html");
    
    $capacitacion = $this->set_dict($capacitacion);
		$gui = $this->render($capacitacion, $gui);
		$gui = str_replace('{app_name}', APP_NAME, $gui);
    print $gui;
	}
  
	function agregar() {
		$gui = file_get_contents("static/modules/capacitaciones/agregar.html");
		$menu = file_get_contents("static/menu.html");
		
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
    $dict = array("{titulo}"=>"Agregar Evento a Agenda");
    
		$render = $this->render($dict, $gui);
		print $this->render_template($menu, $render);
	}
	
	function editar($capacitacion, $array_msj) {
		$gui = file_get_contents("static/modules/capacitaciones/editar.html");
		$menu = file_get_contents("static/menu.html");
		
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
    $dict = array("{titulo}"=>"Actualización de Evento");
    
    $capacitacion = $this->set_dict($capacitacion);
		$render = $this->render($capacitacion, $gui);
    $render = $this->render($array_msj, $render);
		$render = $this->render($dict, $render);
		print $this->render_template($menu, $render);
	}
  
  function consultar($capacitacion) {
		$gui = file_get_contents("static/modules/capacitaciones/consultar.html");
		$menu = file_get_contents("static/menu.html");
		
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
    $dict = array("{titulo}"=>"Consultar Evento");
    $capacitacion = $this->set_dict($capacitacion);
		$render = $this->render($capacitacion, $gui);
		$render = $this->render($dict, $render);
		print $this->render_template($menu, $render);
	}
  
  function ver($capacitacion) {
		$gui = file_get_contents("static/modules/capacitaciones/ver.html");
		$menu = file_get_contents("static/menu.html");
		
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
    $dict = array("{titulo}"=>"Espacio de Capacitación");
    $capacitacion = $this->set_dict($capacitacion);
		$render = $this->render($capacitacion, $gui);
		$render = $this->render($dict, $render);
		print $this->render_template($menu, $render);
	}
  
  function inicio_capacitaciones($array_msj) {
		$gui = file_get_contents("static/modules/capacitaciones/inicio_capacitaciones.html");
		$menu = file_get_contents("static/menu.html");
		
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
    $dict = array("{titulo}"=>"Espacio de Capacitación");
    $render = $this->render($dict, $gui);
    $render = $this->render($array_msj, $render);
		print $this->render_template($menu, $render);
	}
}
?>