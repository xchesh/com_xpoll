<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку контроллера Joomla.
jimport('joomla.application.component.controller');

/**
 * Общий контроллер компонента Hello World.
 */
class XpollController extends JControllerLegacy
{
	/**
	 * Задача по отображению.
	 *
	 * @return void
	 */
	public function display($cachable = false, $urlparams = array()) 
	{
		// Устанавливаем представление по умолчанию, если оно не было установлено.
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'Xpolls'));

		// Устанавливаем подменю.
		XpollHelper::addSubmenu('xpolls');

		parent::display($cachable);
	}
}