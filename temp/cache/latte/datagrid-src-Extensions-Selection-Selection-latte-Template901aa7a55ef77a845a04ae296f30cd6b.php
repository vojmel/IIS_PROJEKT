<?php
// source: C:\wamp64\www\IIS_PROJEKT\vendor\mesour\datagrid\src\Extensions\Selection/Selection.latte

class Template901aa7a55ef77a845a04ae296f30cd6b extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('f0139f30d8', 'html')
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
<div class="btn-group checkbox-button" style="cursor: not-allowed;">
	<button class="btn btn-default dropdown-toggle disabled" type="button" data-toggle="dropdown">
		<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Selected')), ENT_NOQUOTES) ?>

		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu">
<?php $iterations = 0; foreach ($links as $name => $link) { ?>		<li><a<?php if ($link->getConfirm()) { ?>
 data-confirm="<?php echo Latte\Runtime\Filters::escapeHtml($link->getConfirm(), ENT_COMPAT) ?>
"<?php } if ($link->isAjax()) { ?> class="is-ajax"<?php } ?> href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("onSelect!", array($link->getFixedName())), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($link->getName(), ENT_NOQUOTES) ?></a></li>
<?php $iterations++; } ?>	</ul>
</div><?php
}}