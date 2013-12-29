<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
?>
<tr>
	<th width="5">
		<?php echo JText::_('COM_XPOLL_XPOLL_HEADING_ID'); ?>
	</th>
	<th width="1%" class="hidden-phone">
		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
	</th>
	<th>
		<?php echo JText::_('COM_XPOLL_XPOLL_HEADING_TITLE'); ?>
	</th>
</tr>