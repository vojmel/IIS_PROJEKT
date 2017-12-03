<?php
// source: C:\wamp64\www\IIS_PROJEKT\app\presenters/templates/Lek/edit.latte

class Template7abb09cf2ab1be3b2cefb397f0f03155 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5851908adf', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb88a99f06df_content')) { function _lb88a99f06df_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Editace leku: <?php echo Latte\Runtime\Filters::escapeHtml($lek->nazev, ENT_NOQUOTES) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($lek->lekID, ENT_NOQUOTES) ?>)</h1>

<?php $_l->tmp = $_control->getComponent("postForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
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