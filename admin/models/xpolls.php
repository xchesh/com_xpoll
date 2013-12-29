<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку modellist Joomla.
jimport('joomla.application.component.modellist');

/**
 * Модель списка сообщений компонента Xpoll.
 */
class XpollModelXpolls extends JModelList
{
	/**
	 * Метод для построения SQL запроса для загрузки списка данных.
	 *
	 * @return string SQL запрос.
	 */
	protected function getListQuery()
	{
		// Создаем новый query объект.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Выбераем поля.
		$query->select('id, title');

		// Из таблицы xpoll.
		$query->from('#__xpoll');

		return $query;
	}
}