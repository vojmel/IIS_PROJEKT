<?php
// source: C:\wamp64\www\IIS_PROJEKT\app\presenters\Administrace/templates/Column/_pojistovnaName.latte

class Template47eadd20679805966b73ebd34d2e2f4d extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('126a08e3cf', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
echo Latte\Runtime\Filters::escapeHtml($nazev, ENT_NOQUOTES) ?> (<?php echo Latte\Runtime\Filters::escapeHtml($pojistovnaID, ENT_NOQUOTES) ?>
)<?php
}}