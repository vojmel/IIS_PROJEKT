<?php
// source: C:\wamp64\www\test\app\presenters/templates/Dashboard/default.latte

class Templatef2a2b7b716e45eae60dbf0ec2ee63d50 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('a598616409', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb23909f7216_content')) { function _lb23909f7216_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>

<p><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("add"), ENT_COMPAT) ?>
">Add new album</a></p>

<table class="grid">
<tr>
	<th>Title</th>
	<th>Artist</th>
	<th>&nbsp;</th>
</tr>

<?php $iterations = 0; foreach ($albums as $album) { ?>
<tr>
	<td><?php echo Latte\Runtime\Filters::escapeHtml($album->title, ENT_NOQUOTES) ?></td>
	<td><?php echo Latte\Runtime\Filters::escapeHtml($album->artist, ENT_NOQUOTES) ?></td>
	<td>
		<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array($album->id)), ENT_COMPAT) ?>
">Edit</a>
		<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete", array($album->id)), ENT_COMPAT) ?>
">Delete</a>
	</td>
</tr>
<?php $iterations++; } ?>
</table>
<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb982a323f56_title')) { function _lb982a323f56_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>My Albums</h1>
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
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}