<?php
// source: C:\wamp64\www\IIS_PROJEKT\app\presenters/templates/Column/_numberOfItems.latte

class Templateb07e28f398a74671dce77dbb2902972f extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('959cdfdaf3', 'html')
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
<div class="input-group number-spinner" style="width: 120px;">
    <span class="input-group-btn">
        <button class="btn btn-default" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
    </span>
    <input type="text" class="form-control text-center" value="1" id="numberOfItems<?php echo Latte\Runtime\Filters::escapeHtml($id, ENT_COMPAT) ?>">
    <span class="input-group-btn">
        <button class="btn btn-default" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
    </span>
</div><?php
}}