<?
/**
 * @var $page array
 * @var $stepCount int
 */
?>

<div id="header">
	<div class="clearfix">
		<div class="progress" style="margin: 0;">
			<div class="progress-bar progress-bar-success" role="progressbar"
				aria-valuenow="<?= $stepPercent; ?>" aria-valuemin="0"
				aria-valuemax="100" style="width: <?= $stepPercent; ?>%;">
				<?= $stepPercent; ?>%
			</div>
		</div>
	</div>
	<div style="font-size: large;">
		Шаг <?= $page['step']; ?> из <?= $stepCount; ?>: <?= $view->getPageTitle() ?>.
	</div>
</div>

<!-- menu -->
<?
	$glyphicon = 'glyphicon-ok';
?>
<div id="menu">
	<ul>
	<? foreach ($pages as $name => $menuPage): ?>
<?
		$current = $name === $pageName;
		if ($current) {
			$glyphicon = 'glyphicon-arrow-right';
		}
?>
		<li class="<? if ($name === $pageName) echo 'active'; ?>">
			<span class="glyphicon <?= $glyphicon; ?>"></span>
			<?= $menuPage['title']; ?>
		</li>
<?
		if ($current) {
			$glyphicon = 'glyphicon-remove';
		}
?>
	<? endforeach ?>
	</ul>
</div><!-- menu -->


<div id="content" class="well">
	<h1 style="margin: 5px 5px 10px;"><?= $page['title']; ?></h1>

	<?= $content ?>

</div>

<div class="clearfix"></div>
<? if ($page['step']): ?>
	<div class="alert alert-warning">
		При возникновении проблем с установкой, пожалуйста, посетите наш
		<a href="http://forum.wowtransfer.com?from=install" title="wowtransfer.com forum">форум</a>
		или
		<a href="http://wowtransfer.com/contact/?from=install" title="wowtransfer.com - Contact us">напишите нам</a>!
	</div>
<? endif; ?>
