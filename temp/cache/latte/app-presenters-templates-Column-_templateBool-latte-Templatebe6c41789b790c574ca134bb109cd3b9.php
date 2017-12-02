<?php
// source: C:\wamp64\www\IIS_PROJEKT\app\presenters/templates/Column/_bool.latte

class Templatebe6c41789b790c574ca134bb109cd3b9 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9c848e6c4d', 'html')
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