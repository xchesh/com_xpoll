<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
 
/**
 * Хелпер Xpoll компонента.
 */
abstract class XpollHelper
{
	/**
	 * Конфигурируем субменю.
	 *
	 * @param string Активный пункт меню.
	 *
	 * @return void
	 */
	public static function addSubmenu($submenu) 
	{
		JHtmlSidebar::addEntry(JText::_('COM_XPOLL_SUBMENU_XPOLLS'),
									'index.php?option=com_xpoll', $submenu == 'xpolls');
		JHtmlSidebar::addEntry(JText::_('COM_XPOLL_SUBMENU_CATEGORIES'),
									'index.php?option=com_categories&view=categories&extension=com_xpoll',
									$submenu == 'categories');

		// Устанавливаем глобальные свойства.
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-xpoll ' .
										'{background-image: url(../media/com_xpoll/images/hello-48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_XPOLL_ADMINISTRATION_CATEGORIES'));
		}
	}

	/**
	 * Получаем доступы для действий.
	 *
	 * @param  int  Id сообщения.
	 *
	 * @return object 
	 */
	public static function getActions($xpollId = 0)
	{
		// Подключаем библиотеку доступов.
		jimport('joomla.access.access');
		
		// Определяем имя ассета (ресурса).
		if (empty($xpollId)) 
		{
			$assetName = 'com_xpoll';
		}
		else 
		{
			$assetName = 'com_xpoll.xpoll.' . (int)$xpollId;
		}

		// Получаем список доступных действий для компонента.
		$actions = JAccess::getActions('com_xpoll', 'component');

		// Получаем объект пользователя.
		$user = JFactory::getUser();

		$result = new JObject;
		foreach ($actions as $action)
		{
			// Устанавливаем доступы пользователя для действий.
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}

		return $result;
	}
}