<?php
// source: N:\programy\wamp64\www\projectIIS\IIS_PROJEKT\vendor\mesour\datagrid\src\Extensions/templates/Filter/NumberDropdown.latte

class Template675b2fd3de5ec80ff7927da0a22ddc47 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('fcc2a97464', 'html')
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
				<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Number filters')), ENT_NOQUOTES) ?>

			</span>
			<ul class="dropdown-menu">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="equal_to"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Equal to')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="not_equal_to"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Not equal to')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Bigger than')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="equal_to" data-operator="or"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Bigger than or equal')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="smaller"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Smaller than')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="smaller" data-type-second="equal_to" data-operator="or"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Smaller than or equal')), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(('Between')), ENT_NOQUOTES) ?></a></li>
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