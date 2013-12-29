<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

foreach ($this->items as $i => $item): 
	$canEdit = JFactory::getUser()->authorise('core.edit', 'com_xpoll.xpoll.' . $item->id); ?>

	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->id; ?>
		</td>
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td>
			<?php if ($canEdit): ?>
				<a href="<?php echo JRoute::_('index.php?option=com_xpoll&task=xpoll.edit&id=' . (int)$item->id); ?>">
					<?php echo $item->title; ?>
				</a>
			<?php else: ?>
				<?php echo $item->title; ?>
			<?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>