<?php


class AuditorView extends View{

	function listar($auditorias) {
		$gui = file_get_contents("static/modules/auditor/listar.html");
		$tbl_listar = file_get_contents("static/modules/auditor/tbl_listar.html");
		$menu = file_get_contents("static/menu.html");
    
		$restricciones = $this->genera_menu();
		$menu = $this->render($restricciones, $menu);
		
		$dict = array("{titulo}"=>"Sistema de Gestión de Documentación");
		$tbl_listar = $this->render_regex("repetir", $tbl_listar, $auditorias);
		$render = str_replace('{tbl_listar}', $tbl_listar, $gui);
    	$render = $this->render($dict, $render);
		print $this->render_template($menu, $render);
	}
}
?>
