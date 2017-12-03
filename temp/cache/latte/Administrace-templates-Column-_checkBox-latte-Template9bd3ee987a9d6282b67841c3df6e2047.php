<?php
// source: C:\wamp64\www\IIS_PROJEKT\app\presenters\Administrace/templates/Column/_checkBox.latte

class Template9bd3ee987a9d6282b67841c3df6e2047 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('ef381604ea', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<label class="form-check-label">
    <input class="form-check-input" type="checkbox" value="" id="checkBoxId<?php echo Latte\Runtime\Filters::escapeHtml($id, ENT_COMPAT) ?>" onchange="changeStateOn(this.id)">
</label><?php
}}