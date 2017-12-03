<?php
// source: C:\wamp64\www\IIS_PROJEKT\vendor\mesour\datagrid\src\Columns/Template.latte

class Template7bcc8176cd52b2f0e037ce1e28d5ffdc extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('bf407fea69', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_block !== FALSE) { ob_start(function () {}); $_g->includingBlock = isset($_g->includingBlock) ? ++$_g->includingBlock : 1; $_b->templates['bf407fea69']->renderChildTemplate($_template_path, get_defined_vars()); $_g->includingBlock--; echo rtrim(ob_get_clean()) ?>

<?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, $_block, $template->getParameters()) ;} else { $_b->templates['bf407fea69']->renderChildTemplate($_template_path, $template->getParameters()) ;} 
}}