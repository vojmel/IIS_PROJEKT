<?php
// source: N:\programy\wamp64\www\projectIIS\IIS_PROJEKT\vendor\mesour\datagrid\src\Grid/Grid.latte

class Template0610da7fb4d7eaafc3f8401cd49fe651 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('edda8b0843', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _dataGrid
//
if (!function_exists($_b->blocks['_dataGrid'][] = '_lb06f80b3137__dataGrid')) { function _lb06f80b3137__dataGrid($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('dataGrid', FALSE)
?>	<div class="data-grid<?php if ($control instanceof \Mesour\DataGrid\GridTree) { ?>
 data-grid-tree<?php } ?> lang-<?php echo Latte\Runtime\Filters::escapeHtml($locale, ENT_COMPAT) ?>
" data-mesour-grid="<?php echo Latte\Runtime\Filters::escapeHtml($control->getName(), ENT_COMPAT) ?>">
		<div id="<?php echo $_l->dynSnippetId = $_control->getSnippetId($control->getGridName()) ?>
"><?php ob_start() ?>

			<script>
				var mesour = !mesour ? { dataGrid: {}} : mesour;
                mesour.dataGrid = !mesour.dataGrid ? {} : mesour.dataGrid;
                mesour.dataGrid.list = mesour.dataGrid.list ? mesour.dataGrid.list : {};
				mesour.dataGrid.list[<?php echo Latte\Runtime\Filters::escapeJs($control->getName()) ?>] = {};
				mesour.dataGrid.version = '2.0.7';
			</script>
			<?php if (isset($script)) { echo $script ;} ?>

<?php if (isset($control['filter']) && $control['filter']->isAdvanced()) { ?>			<script>mesour.dataGrid.list[<?php echo Latte\Runtime\Filters::escapeJs($control->getName()) ?>
].filterValues = <?php echo json_encode($control['filter']->settings) ?>;</script>
<?php } if (\Mesour\DataGrid\Grid::$js_draw) { ?>			<script><?php echo file_get_contents($grid_dir . '/../../public/mesourGrid.js') ?></script>
<?php } if (\Mesour\DataGrid\Grid::$css_draw) { ?>			<style><?php echo file_get_contents($grid_dir . '/../../public/mesourGrid.css') ?></style>
<?php } ?>
			<?php \Mesour\DataGrid\Grid::disableJsDraw() ;\Mesour\DataGrid\Grid::disableCssDraw() ?>

			<div class="data-grid"<?php if (isset($control['editable'])) { ?> data-editable-link="<?php echo Latte\Runtime\Filters::escapeHtml($control['editable']->link('editCell!'), ENT_COMPAT) ?>
"<?php } ?>>
<?php if (isset($control['filter'])) { $_l->tmp = $_control->getComponent("filter"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;} ?>
				<?php echo $content->create() ?>

			</div>
			<div class="datagrid-bottom">
<?php if ($control['selection']->isEnabled()) { $_l->tmp = $_control->getComponent("selection"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;} if ($control['pager']->isEnabled()) { $_l->tmp = $_control->getComponent("pager"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;} if (isset($control['export'])) { $_l->tmp = $_control->getComponent("export"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;} ?>
			</div>
			<hr style="clear:both;border:none;">
<?php $_l->dynSnippets[$_l->dynSnippetId] = ob_get_flush() ?>
</div>
	</div>
<?php if (isset($_l->dynSnippets)) return $_l->dynSnippets; 
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
<div id="<?php echo $_control->getSnippetId('dataGrid') ?>"><?php call_user_func(reset($_b->blocks['_dataGrid']), $_b, $template->getParameters()) ?>
</div><?php
}}