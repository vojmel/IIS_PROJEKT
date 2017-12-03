<?php
// source: N:\programy\wamp64\www\projectIIS\IIS_PROJEKT\app\presenters\Administrace/templates/Column/_pojistovnaName.latte

class Template452cfecdc0c3a0c78af78f3b07e71b1f extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('fa9a9d3f84', 'html')
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