<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */
function smarty_function_homebanner_data($params, $smarty){
	$modelTemplate = $smarty->tpl_vars['modelTemplate']->value instanceof frontend_model_template ? $smarty->tpl_vars['modelTemplate']->value : new frontend_model_template();
	$homebanner = new plugins_homebanner_public($modelTemplate);
	$assign = isset($params['assign']) ? $params['assign'] : 'homebanner';
	$smarty->assign($assign,$homebanner->getSlides($params));
}