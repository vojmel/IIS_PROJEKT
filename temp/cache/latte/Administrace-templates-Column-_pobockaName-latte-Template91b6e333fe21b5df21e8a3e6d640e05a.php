<?php
// source: C:\wamp64\www\IIS_PROJEKT\app\presenters\Administrace/templates/Column/_pobockaName.latte

class Template91b6e333fe21b5df21e8a3e6d640e05a extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('a8a3bd8395', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
echo Latte\Runtime\Filters::escapeHtml($pobockaID, ENT_NOQUOTES) ;
}}