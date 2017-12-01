<?php
// source: C:\wamp64\www\IIS_PROJEKT\app\presenters/templates/@layout.latte

class Template70fcc070613f69579dd59c81cdea5a9a extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8421b82c44', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lbe19acaebbc_title')) { function _lbe19acaebbc_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<?php if (isset($robots)) { ?>	<meta name="robots" content="<?php echo Latte\Runtime\Filters::escapeHtml($robots, ENT_COMPAT) ?>">
<?php } ?>

	<title><?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
ob_start(function () {}); call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars()); echo $template->trim($template->striptags(ob_get_clean()))  ?> | Nette example</title>

	<link rel="stylesheet" media="screen" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/site.css">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/nette.ajax.js"></script>
</head>

<body>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>	<div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>

	<div id="content">
<?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?>
	</div>

	<script src="//nette.github.com/resources/js/netteForms.js"></script>

    <script type="javascript">
        $(function () {
            $.nette.init();
        });
    </script>
</body>
</html>
<?php
}}