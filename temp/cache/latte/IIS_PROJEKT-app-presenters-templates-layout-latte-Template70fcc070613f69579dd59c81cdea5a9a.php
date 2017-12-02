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


	<!-- jquery + bootstrap.js + jquery-ui -->
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery-ui.min.js"></script>


	<!-- Bootstrap + theme-->
	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/bootstrap-theme.min.css">
</head>

<body>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>	<div class="alert alert-dismissable alert-<?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
 fade in" style="position: absolute; z-index: 1000; width: 100%;"><strong><?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_NOQUOTES) ?>
</strong> <?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>

	<nav class="navbar navbar-light" style="background-color: #e6eaf2;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:default"), ENT_COMPAT) ?>
">Administrace</a>
			</div>
			<ul class="nav navbar-nav">
<?php $iterations = 0; foreach ($menuItems as $item => $link) { ?>
					<li <?php if ($_presenter->isLinkCurrent($link)) { ?>class="active"<?php } ?>
 ><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link($link), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($item, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; } ?>
			</ul>
		</div>
	</nav>



	<div id="content">
<?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?>
	</div>

	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/netteForms.js"></script>
	<script type="text/javascript">
		function getBasePath() {
			return <?php echo Latte\Runtime\Filters::escapeJs($basePath) ?>;
        }
	</script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/main.js"></script>
</body>
</html>
<?php
}}