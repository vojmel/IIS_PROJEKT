<?php
// source: N:\programy\wamp64\www\projectIIS\IIS_PROJEKT\vendor\mesour\datagrid\src\Extensions/templates/Filter/Filter.latte

class Templatecd1c8a4cf628d120874bb132e3e6a312 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8dca8ace22', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _filter
//
if (!function_exists($_b->blocks['_filter'][] = '_lb4181d4c7ac__filter')) { function _lb4181d4c7ac__filter($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('filter', FALSE)
?><div class="panel panel-default" data-grid="<?php echo Latte\Runtime\Filters::escapeHtml($control->parent->getName(), ENT_COMPAT) ?>">
	<div class="panel-heading"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Filter')), ENT_NOQUOTES) ?></div>
	<div class="panel-body data-grid-filter">
		<script>
			mesour.dataGrid.list[<?php echo Latte\Runtime\Filters::escapeJs($control->parent->getName()) ?>
].gridValues = <?php echo json_encode($control->parent->getDataSource()->fetchFullData($php_date)) ?>;
			mesour.dataGrid.list[<?php echo Latte\Runtime\Filters::escapeJs($control->parent->getName()) ?>
].phpFilterDate = <?php echo Latte\Runtime\Filters::escapeJs($php_date) ?>;
			mesour.dataGrid.list[<?php echo Latte\Runtime\Filters::escapeJs($control->parent->getName()) ?>
].jsFilterDate = <?php echo Latte\Runtime\Filters::escapeJs($js_date) ?>;
			mesour.dataGrid.translates = {
				months: {
					1: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('January'))) ?>,
					2: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('February'))) ?>,
					3: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('March'))) ?>,
					4: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('April'))) ?>,
					5: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('May'))) ?>,
					6: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('June'))) ?>,
					7: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('July'))) ?>,
					8: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('August'))) ?>,
					9: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('September'))) ?>,
					10: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('October'))) ?>,
					11: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('November'))) ?>,
					12: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('December'))) ?>

				},
				closeAll: <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('close all'))) ?>,
				'true': <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('true'))) ?>,
				'false': <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('false'))) ?>,
				'empty': <?php echo Latte\Runtime\Filters::escapeJs($template->translate(('empty'))) ?>

			};
		</script>
<?php $iterations = 0; foreach ($control->parent->getColumns() as $column) { if ($column->hasFiltering() === FALSE) continue ;if ($column instanceof \Mesour\DataGrid\Column\Filter) { if ($column instanceof \Mesour\DataGrid\Column\Date && $control->parent->getDataSource() instanceof \Mesour\DataGrid\ArrayDataSource) continue ;$_b->templates['8dca8ace22']->renderChildTemplate($column->getTemplateFile(), array('column' => $column) + $template->getParameters()) ;} $iterations++; } ?>
		<a href="#" name="_reset" class="btn btn-danger button red float-l full-reset"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Reset')), ENT_NOQUOTES) ?></a>
		<input type="hidden" class="apply-filter" data-href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("applyDefaultFilter!", array('settings' => array())), ENT_COMPAT) ?>">
		<div class="grid-filter modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Close')), ENT_NOQUOTES) ?></span></button>
					<h4 class="modal-title"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Custom filter')), ENT_NOQUOTES) ?></h4>
				</div>
				<div class="modal-body">
					<form class="form-inline">
						<p><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Show rows where')), ENT_NOQUOTES) ?>:</p>
						<div class="form-group">
							<label class="sr-only" for="grid-how-1"></label>
							<select id="grid-how-1" class="form-control">
								<option></option>
								<option value="equal_to"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Equal to')), ENT_NOQUOTES) ?></option>
								<option value="not_equal_to"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not equal to')), ENT_NOQUOTES) ?></option>
								<option value="bigger"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Is greater than')), ENT_NOQUOTES) ?></option>
								<option value="not_bigger"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Is no greater than')), ENT_NOQUOTES) ?></option>
								<option value="smaller"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Is smaller than')), ENT_NOQUOTES) ?></option>
								<option value="not_smaller"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Is no smaller than')), ENT_NOQUOTES) ?></option>
								<option value="start_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Starts with')), ENT_NOQUOTES) ?></option>
								<option value="not_start_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not starts with')), ENT_NOQUOTES) ?></option>
								<option value="end_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Ends with')), ENT_NOQUOTES) ?></option>
								<option value="not_end_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not ends with')), ENT_NOQUOTES) ?></option>
								<option value="equal"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Contains')), ENT_NOQUOTES) ?></option>
								<option value="not_equal"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not contains')), ENT_NOQUOTES) ?></option>
							</select>
						</div>
						<div class="form-group">
							<label class="sr-only" for="grid-value-1"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Value')), ENT_NOQUOTES) ?></label>
							<div class="input-group date" id="grid-datepicker1">
								<input type="text" class="form-control" data-date-format="<?php echo Latte\Runtime\Filters::escapeHtml($js_date, ENT_COMPAT) ?>
" id="grid-value-1" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Value')), ENT_COMPAT) ?>">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<br>
						<div class="form-group grid-operators">
							<input type="radio" name="operator" id="grid-operator-and" value="and" checked="checked"> <label for="grid-operator-and"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('and')), ENT_NOQUOTES) ?></label>
							<input type="radio" name="operator" id="grid-operator-or" value="or"> <label for="grid-operator-or"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('or')), ENT_NOQUOTES) ?></label>
						</div>
						<br>
						<div class="form-group">
							<label class="sr-only" for="grid-how-2"></label>
							<select id="grid-how-2" class="form-control">
								<option></option>
								<option value="equal_to"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Equal to')), ENT_NOQUOTES) ?></option>
								<option value="not_equal_to"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not equal to')), ENT_NOQUOTES) ?></option>
								<option value="bigger"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Is greater than')), ENT_NOQUOTES) ?></option>
								<option value="not_bigger"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Is no greater than')), ENT_NOQUOTES) ?></option>
								<option value="smaller"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Is smaller than')), ENT_NOQUOTES) ?></option>
								<option value="not_smaller"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Is no smaller than')), ENT_NOQUOTES) ?></option>
								<option value="start_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Starts with')), ENT_NOQUOTES) ?></option>
								<option value="not_start_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not starts with')), ENT_NOQUOTES) ?></option>
								<option value="end_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Ends with')), ENT_NOQUOTES) ?></option>
								<option value="not_end_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not ends with')), ENT_NOQUOTES) ?></option>
								<option value="equal"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Contains')), ENT_NOQUOTES) ?></option>
								<option value="not_equal"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not contains')), ENT_NOQUOTES) ?></option>
							</select>
						</div>
						<div class="form-group">
							<label class="sr-only" for="grid-value-2"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Value')), ENT_NOQUOTES) ?></label>
							<div class="input-group date" id="grid-datepicker2">
								<input type="text" class="form-control" data-date-format="<?php echo Latte\Runtime\Filters::escapeHtml($js_date, ENT_COMPAT) ?>
" id="grid-value-2" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Value')), ENT_COMPAT) ?>">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-sm save-custom-filter"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Ok')), ENT_NOQUOTES) ?></button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Storno')), ENT_NOQUOTES) ?></button>
				</div>
				<input type="hidden" data-name="">
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
		<input type="hidden" data-filter-values="here" value='<?php echo !empty($settings) ? json_encode($settings) : '' ?>'>
	</div>
</div>
<?php
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
<div id="<?php echo $_control->getSnippetId('filter') ?>"><?php call_user_func(reset($_b->blocks['_filter']), $_b, $template->getParameters()) ?>
</div><?php
}}