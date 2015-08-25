<?php
/* @var $this SiteController */
?>
<h1><?= Yii::t('app', 'Administration') ?></h1>

<ul>

<li><a href="<?php echo $this->createUrl('/transfers') ?>">Заявки на перенос</a>
<ul>
	<li>Просмотр, изменение и удаление заявок.</li>
	<li>Создание персонажей.</li>
	<li>Просмотр lua-дампов</li>
</ul>
</li>

<li><a href="<?php echo $this->createUrl('/tconfigs/index'); ?>">Конфигурации переноса</a>
<ul>
	<li>Просмотр конфигураций переноса.</li>
</ul>
</li>

<li><a href="<?php echo $this->createUrl('/configs'); ?>">Настройка</a>
<ul>
	<li><a href="<?php echo $this->createUrl('/configs/app'); ?>">Приложение</a></li>
	<li><a href="<?php echo $this->createUrl('/configs/service'); ?>">Связь с сервисом</a></li>
	<li><a href="<?php echo $this->createUrl('/configs/toptions'); ?>"><?= Yii::t('app', 'Transfer options') ?></a></li>
	<li><a href="<?php echo $this->createUrl('/configs/remoteservers') ?>">Удаленные сервера</a></li>
</ul>
</li>

</ul>