<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Проверка доступа.
if (!JFactory::getUser()->authorise('core.manage', 'com_xpoll')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 404);
}

// Подключаем хелпер.
JLoader::register('XpollHelper', dirname(__FILE__) . '/helpers/xpoll.php');

// Подключаем библиотеку контроллера Joomla.
jimport('joomla.application.component.controller');

// Получаем экземпляр контроллера с префиксом Xpoll.
$controller = JControllerLegacy::getInstance('Xpoll');

// Исполняем задачу task из Запроса.
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
 
// Перенаправляем, если перенаправление установлено в контроллере.
$controller->redirect();