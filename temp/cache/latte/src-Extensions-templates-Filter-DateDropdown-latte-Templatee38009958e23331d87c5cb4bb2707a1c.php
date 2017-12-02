<?php
// source: N:\programy\wamp64\www\projectIIS\IIS_PROJEKT\vendor\mesour\datagrid\src\Extensions/templates/Filter/DateDropdown.latte

class Templatee38009958e23331d87c5cb4bb2707a1c extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('77c8c08ec0', 'html')
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
<div class="dropdown filter-dropdown" data-filter="<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>" data-type="date">
	<button class="btn btn-default dropdown-toggle" type="button">
		<span class="glyphicon glyphicon-ok"></span>
		<?php echo Latte\Runtime\Filters::escapeHtml($column->getHeader(), ENT_NOQUOTES) ?>

		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<li class="dropdown-submenu">
			<span>
				<button type="button" class="btn btn-success btn-xs reset-filter" title="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Reset filter")), ENT_COMPAT) ?>"><span class="glyphicon glyphicon-ok"></span><span class="glyphicon glyphicon-remove"></span></button>
				<button type="button" class="btn btn-primary btn-xs open-modal edit-filter" title="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Edit filter")), ENT_COMPAT) ?>"><span class="glyphicon glyphicon-pencil"></span></button>
				<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Date filters")), ENT_NOQUOTES) ?>

			</span>
			<ul class="dropdown-menu">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="equal_to"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Equal to")), ENT_NOQUOTES) ?></a></li>
				<li role="presentation" class="divider"></li>
				<li class="dropdown-submenu">
					<span tabindex="-1"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Time period")), ENT_NOQUOTES) ?></span>
					<ul class="dropdown-menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="last_week_start" data-second-value="last_week_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Last week")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="this_week_start" data-second-value="this_week_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("This week")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="next_week_start" data-second-value="next_week_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Next week")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation" class="divider"></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="last_month_start" data-second-value="last_month_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Last month")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="this_month_start" data-second-value="this_month_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("This month")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="next_month_start" data-second-value="next_month_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Next month")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation" class="divider"></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="last_quarter_start" data-second-value="last_quarter_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Last quarter")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="this_quarter_start" data-second-value="this_quarter_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("This quarter")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="next_quarter_start" data-second-value="next_quarter_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Next quarter")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation" class="divider"></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="last_year_start" data-second-value="last_year_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Last year")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="this_year_start" data-second-value="this_year_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("This year")), ENT_NOQUOTES) ?></a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller" data-first-value="next_year_start" data-second-value="next_year_end"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Next year")), ENT_NOQUOTES) ?></a></li>
					</ul>
				</li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="equal_to" data-first-value="yesterday"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Yesterday")), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="equal_to" data-first-value="today"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Today")), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="equal_to" data-first-value="tommorow"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Tomorrow")), ENT_NOQUOTES) ?></a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-first-value="this_year_start"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Beginning of the year")), ENT_NOQUOTES) ?></a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="smaller"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Before")), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("After")), ENT_NOQUOTES) ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal" data-type-first="bigger" data-type-second="smaller"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Between")), ENT_NOQUOTES) ?></a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="open-modal"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Custom filter")), ENT_NOQUOTES) ?></a></li>
			</ul>
		</li>
		<li role="presentation" class="divider"></li>
		<li role="presentation">
			<div class="inline-box">
				<div class="search">
					<input type="text" class="form-control search-input" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("Search...")), ENT_COMPAT) ?>">
				</div>
				<div class="box-inner">
					<ul>
						<li class="all-select-li">
							<input type="checkbox" class="select-all" id="select-all-<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>">
							<label for="select-all-<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("(Select all)")), ENT_NOQUOTES) ?></label>
						</li>
						<li class="all-select-searched-li">
							<input type="checkbox" class="select-all-searched" id="selected-<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>">
							<label for="selected-<?php echo Latte\Runtime\Filters::escapeHtml($column->getId(), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(("(Select all searched)")), ENT_NOQUOTES) ?></label>
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