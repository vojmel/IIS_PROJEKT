<?php
// source: C:\wamp64\www\IIS_PROJEKT\vendor\mesour\datagrid\src\Extensions/templates/Filter/TextDropdown.latte

class Template72adfc2c45374c8cba3c525050745495 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3ed32523e5', 'html')
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
<div class="dropdown filter-dropdown" data-filter="<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>">
	<button class="btn btn-default dropdown-toggle" type="button">
		<span class="glyphicon glyphicon-ok"></span>
		<?php echo Latte\Runtime\Filters::escapeHtml($column->getHeader(), ENT_NOQUOTES) ?>

		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<li class="dropdown-submenu">
			<span>
				<button type="button" class="btn btn-success btn-xs reset-filter" title="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Reset filter')), ENT_COMPAT) ?>"><span class="glyphicon glyphicon-ok"></span><span class="glyphicon glyphicon-remove"></span></button>
				<button type="button" class="btn btn-primary btn-xs open-modal edit-filter" title="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Edit filter')), ENT_COMPAT) ?>"><span class="glyphicon glyphicon-pencil"></span></button>
				<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Text filters')), ENT_NOQUOTES) ?>

			</span>
			<ul class="dropdown-menu">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="equal_to"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Equal to')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="not_equal_to"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not equal to')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="equal"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Contains')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="not_equal"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not contains')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="start_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Starts with')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="end_with"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Ends with')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Custom filter')), ENT_NOQUOTES) ?></a></li>
			</ul>
		</li>
		<li role="presentation" class="divider"></li>
		<li role="presentation">
			<div class="inline-box">
				<div class="search">
					<input type="text" class="form-control search-input" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Search...')), ENT_COMPAT) ?>">
				</div>
				<div class="box-inner">
					<ul>
						<li class="all-select-li">
							<input type="checkbox" class="select-all" id="select-all-<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>">
							<label for="select-all-<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('(Select all)')), ENT_NOQUOTES) ?></label>
						</li>
						<li class="all-select-searched-li">
							<input type="checkbox" class="select-all-searched" id="selected-<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>">
							<label for="selected-<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('(Select all searched)')), ENT_NOQUOTES) ?></label>
						</li>
					</ul>
				</div>
			</div>
		</li>
		<li role="presentation" class="divider"></li>
		<li role="presentation" class="with-buttons">
			<div class="buttons">
				<button type="button" class="btn btn-danger btn-sm close-filter"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Close')), ENT_NOQUOTES) ?></button>
			</div>
		</li>
	</ul>
</div><?php
}}