<?php
// source: C:\wamp64\www\IIS_PROJEKT\vendor\mesour\datagrid\src\Extensions/templates/Pager/Pager.latte

class Template57d2dc12718ad6bec7da8ab77d3d1c5a extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('f7bc161baf', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _pager
//
if (!function_exists($_b->blocks['_pager'][] = '_lb4994a26a16__pager')) { function _lb4994a26a16__pager($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('pager', FALSE)
;if ($paginator->getPageCount() > 1) { ?><div class="pagination-outer">
	<ul class="pagination">
		<li<?php if ($_l->tmp = array_filter(array($paginator->isFirst() ? 'disabled' : NULL))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><a class="arrow first<?php if (!$paginator->isFirst()) { ?> mesour-ajax<?php } ?>
"<?php if (!$paginator->isFirst()) { ?> href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("changePage!", array('settings' => array('page' => 0))), ENT_COMPAT) ?>
"<?php } ?>><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('first')), ENT_NOQUOTES) ?></a></li>
		<li<?php if ($_l->tmp = array_filter(array($paginator->isFirst() ? 'disabled' : NULL))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><a class="arrow prev<?php if (!$paginator->isFirst()) { ?> mesour-ajax<?php } ?>
"<?php if (!$paginator->isFirst()) { ?> href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("changePage!", array('settings' => array('page' => $paginator->getPage()-1))), ENT_COMPAT) ?>
"<?php } ?>><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('prev')), ENT_NOQUOTES) ?></a></li>
<?php for ($x = 1; $x <= $paginator->getPageCount(); $x++) { ?>		<li<?php if ($_l->tmp = array_filter(array($paginator->getPage() == $x ? 'active' : NULL))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>>
			<a <?php if ($paginator->getPage() != $x) { ?>class="mesour-ajax" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("changePage!", array('settings' => array('page' => $x))), ENT_COMPAT) ?>
"<?php } ?>><?php echo Latte\Runtime\Filters::escapeHtml($x, ENT_NOQUOTES) ?></a>
		</li>
<?php } ?>
		<li<?php if ($_l->tmp = array_filter(array($paginator->isLast() ? 'disabled' : NULL))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><a class="arrow next<?php if (!$paginator->isLast()) { ?> mesour-ajax<?php } ?>
"<?php if (!$paginator->isLast()) { ?> href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("changePage!", array('settings' => array('page' => $paginator->getPage()+1))), ENT_COMPAT) ?>
"<?php } ?>><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('next')), ENT_NOQUOTES) ?></a></li>
		<li<?php if ($_l->tmp = array_filter(array($paginator->isLast() ? 'disabled' : NULL))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><a class="arrow last<?php if (!$paginator->isLast()) { ?> mesour-ajax<?php } ?>
"<?php if (!$paginator->isLast()) { ?> href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("changePage!", array('settings' => array('page' => $paginator->getLastPage()))), ENT_COMPAT) ?>
"<?php } ?>><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('last')), ENT_NOQUOTES) ?></a></li>
	</ul>
</div>
<?php } 
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); } ?>
<div id="<?php echo $_control->getSnippetId('pager') ?>"><?php call_user_func(reset($_b->blocks['_pager']), $_b, $template->getParameters()) ?>
</div><?php
}}