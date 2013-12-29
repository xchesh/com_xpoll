<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
 
// Загружаем тултипы.
JHtml::_('bootstrap.tooltip');
// Загружаем проверку формы.
JHtml::_('behavior.formvalidation');
// Загружаем украшательства формы.
JHtml::_('formbehavior.chosen', 'select');
 
// Получаем параметры из формы.
$params = $this->form->getFieldsets('params');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'xpoll.cancel' || document.formvalidator.isValid(document.id('xpoll-form'))) {
			Joomla.submitform(task, document.getElementById('xpoll-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_xpoll&layout=edit&id='.(int)$this->item->id); ?>" method="post" name="adminForm" id="xpoll-form" class="form-validate">
	<div class="row-fluid">
		<div class="span12 form-horizontal">
			<ul class="nav nav-tabs">
				<li class="active">
                                    <a href="#general" data-toggle="tab">
                                        <?php echo JText::_('COM_XPOLL_XPOLL_DETAILS');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#media2" data-toggle="tab">
                                        <?php echo JText::_('COM_XPOLL_XPOLL_HEADING_ANSWER');?>
                                    </a>
                                </li>
				<?php foreach ($params as $name => $fieldset): ?>
					<li><a href="#params-<?php echo $name;?>" data-toggle="tab"><?php echo JText::_($fieldset->label);?></a></li>
				<?php endforeach; ?>
				<?php if ($this->canDo->get('core.admin')): ?>
					<li><a href="#permissions" data-toggle="tab"><?php echo JText::_('COM_XPOLL_FIELDSET_RULES');?></a></li>
				<?php endif ?>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="general">
					<fieldset>
                                            <?php foreach ($this->form->getFieldset('details') as $field): ?>
                                                <div class="control-group">
                                                    <?php 
                                                    if ($field->fieldname!='answer'){
                                                        echo $field->label;
                                                        echo '<div class="controls">'.$field->input.'</div>'; 
                                                    }?>
                                                </div>
                                            <?php endforeach; ?>
                                        </fieldset>
				</div>
                                <div class="tab-pane" id="media2">
                                    <?php echo $this->form->getInput('answer'); ?>
                                </div>
				<?php foreach ($params as $name => $fieldset): ?>
					<div class="tab-pane" id="params-<?php echo $name;?>">
						<?php if (isset($fieldset->description) && trim($fieldset->description)): ?>
							<p class="tip"><?php echo $this->escape(JText::_($fieldset->description));?></p>
						<?php endif;
						foreach ($this->form->getFieldset($name) as $field) : ?>
							<div class="control-group">
								<?php echo $field->label; ?>
								<div class="controls">
									<?php echo $field->input; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>

				<?php if ($this->canDo->get('core.admin')): ?>
					<div class="tab-pane" id="permissions">
						<fieldset>
							<?php echo $this->form->getInput('rules'); ?>
						</fieldset>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div>
			<input type="hidden" name="task" value="xpoll.edit" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</div>
</form>