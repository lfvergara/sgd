<?php


class TurnoOnLineView extends View {
  function panel($turnoonline) {
		$gui = file_get_contents("static/modules/turnoonline/panel.html");
		$menu = file_get_contents("static/menu.html");
    
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
		$dict = array("{titulo}"=>"Gestión de Turnos OnLine");
    
    $turnoonline = $this->set_dict($turnoonline);
    $render = $this->render($dict, $gui);
    $render = $this->render($turnoonline, $render);
		print $this->render_template($menu, $render);
	}
  
  function configurar_gestores($turnoonline, $areasturnoonline) {
		$gui = file_get_contents("static/modules/turnoonline/configurar_gestores.html");
		$gui_tbl_areaturnoonline = file_get_contents("static/modules/turnoonline/tbl_areaturnoonline.html");
		$menu = file_get_contents("static/menu.html");
    
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
		$dict = array("{titulo}"=>"Gestión de Turnos OnLine");
    
    $turnoonline = $this->set_dict($turnoonline);
    if(!is_array($areasturnoonline))$areasturnoonline=array();
		$gui_tbl_areaturnoonline = $this->render_regex("repetir", $gui_tbl_areaturnoonline, $areasturnoonline);
    
    $render = str_replace('{tbl_areasturnoonline}', $gui_tbl_areaturnoonline, $gui);
    $render = $this->render($turnoonline, $render);
		$render = $this->render($dict, $render);
		print $this->render_template($menu, $render);
	}
}
?>