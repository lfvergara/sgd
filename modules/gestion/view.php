<?php


class GestionView extends View{
  function panel($gestiones) {
		$gui = file_get_contents("static/modules/gestion/panel.html");
		$gui_tbl_gestiones = file_get_contents("static/modules/gestion/tbl_gestiones.html");
		$menu = file_get_contents("static/menu.html");
    
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
		$dict = array("{titulo}"=>"Gestión de Trámites");
    
    if(!is_array($gestiones))$gestiones=array();
		$gui_tbl_gestiones = $this->render_regex("repetir", $gui_tbl_gestiones, $gestiones);
    $render = str_replace('{tbl_gestiones}', $gui_tbl_gestiones, $gui);
		$render = $this->render($dict, $render);
		print $this->render_template($menu, $render);
	}
  
  function traer_form_editar_gestion_ajax($gestion) {
		$gui = file_get_contents("static/modules/gestion/form_editar_gestion_ajax.html");
    
    $gestion = $this->set_dict($gestion);
		$gui = $this->render($gestion, $gui);
		$gui = str_replace('{app_name}', APP_NAME, $gui);
    print $gui;
	}
  
  function consultar_gestion_ajax($gestion) {
		$gui = file_get_contents("static/modules/gestion/consultar_gestion_ajax.html");
    
    $gestion = $this->set_dict($gestion);
		$gui = $this->render($gestion, $gui);
		$gui = str_replace('{app_name}', APP_NAME, $gui);
    print $gui;
	}
}
?>