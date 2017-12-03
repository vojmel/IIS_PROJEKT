<?php
// source: C:\wamp64\www\IIS_PROJEKT\app\presenters\Administrace/../templates/Column/_bool.latte

class Templatea64482344876e0544357b6508ce1028f extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('786304dbb7', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($state == 1) { ?>
    Ano
<?php } else { ?>
    Ne
<?php } 
}}