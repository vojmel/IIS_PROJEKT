<?php
// source: C:\wamp64\www\IIS_PROJEKT\app\presenters/templates/Homepage/default.latte

class Template78c556c45baad294a6e18fcbbca1cb15 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('bcee3f12a6', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3111db4083_content')) { function _lb3111db4083_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>


<?php $_l->tmp = $_control->getComponent("basicDataGrid"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>



<?php $iterations = 0; foreach ($leky as $post) { ?>
        <div class="post">
            <h2><?php echo Latte\Runtime\Filters::escapeHtml($post->nazev, ENT_NOQUOTES) ?></h2>

            <h2><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Post:show", array($post->lekID)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->nazev, ENT_NOQUOTES) ?></a></h2>
        </div>
<?php $iterations++; } ?>

<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb7d49646492_title')) { function _lb7d49646492_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <h1>Leky</h1>
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