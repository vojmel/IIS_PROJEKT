<?php
// source: N:\programy\wamp64\www\projectIIS\IIS_PROJEKT\app\presenters\Administrace/templates/general/selectItem.latte

class Template74c190eab6a622490b62216f96cb3d35 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('823531ee27', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb8d3d138b6d_content')) { function _lb8d3d138b6d_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>
<button onclick="sendDataToParent(<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeJs($site), ENT_COMPAT) ?>)">Vybrat</button>
<?php $_l->tmp = $_control->getComponent("selectDatagrid"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb1a2dd33b2a_title')) { function _lb1a2dd33b2a_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1><?php echo Latte\Runtime\Filters::escapeHtml($nadpis, ENT_NOQUOTES) ?></h1>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start(function () {});}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}