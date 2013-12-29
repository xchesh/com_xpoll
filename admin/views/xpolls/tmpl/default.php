<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Загружаем тултипы.
JHtml::_('bootstrap.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_xpoll'); ?>" method="post" name="adminForm" id="adminForm">
<?php if (!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
	<?php else: ?>
	<div id="j-main-container">
	<?php endif;?>
		<table class="table table-striped">
			<thead><?php echo $this->loadTemplate('head');?></thead>
			<tbody><?php echo $this->loadTemplate('body');?></tbody>
			<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
		</table>
		<div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</div>
</form>