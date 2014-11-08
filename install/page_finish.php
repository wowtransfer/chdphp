<?php

$template->clearSubmitedFields();

if (isset($_POST['submit']))
{
	$template->removeDir();
	$template->saveInstallStatus();
	// get prevent dir... get chdphp dir...
	header('Location: /chdphp');
	// $template->addError('Не удалось удалить папку install')
	exit;
}
?>

<div class="alert alert-success">
	Установка успешно завершена.
</div>

<div class="alert alert-danger">
	Необходимо удалить папку <i>install</i>.
</div>

<div class="alert alert-warning">
	<?php $template->errorSummary(); ?>

	<p>Настройте файлы конфигурации приложения:</p>
	<ul>
		<li>/protected/config/main.php - общая конфигурация.</li>
		<li>/protected/config/backend.php - конфигурация для пользовательской части.</li>
		<li>/protected/config/frontend.php - конфигурация для админской части.</li>
	</ul>
</div>

<form action="" method="post">


	<button class="btn btn-primary" type="submit" name="submit">Удалить папку <i>install</i> и перейди к авторизации</button>

</form>