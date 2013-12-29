<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку modelitem Joomla.
jimport('joomla.application.component.modelitem');

/**
 * Модель сообщения компонента Xpoll.
 */
class XpollModelXpoll extends JModelItem
{
	/**
	 * Сообщение.
	 *
	 * @var object
	 */
	protected $items;

	/**
	 * Возвращает ссылку на объект таблицы.
	 *
	 * @param	type		Тип таблицы
	 * @param	string		Префикс имени класса таблицы. Необязателен.
	 * @param	array		Конифгурационный массив для таблицы. Необязателен.
	 * 
	 * @return	JTable	Объект таблицы.
	 */
	public function getTable($type = 'Xpoll', $prefix = 'XpollTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Получаем сообщение.
	 * 
	 * @return object Сообщение, которое отображается пользователю.
	 */
	public function getItems() 
	{
		if (!isset($this->items)) 
		{
			$catid = $this->getState('xpoll.catid');

			// Конструируем SQL запрос.
			$this->_db->setQuery($this->_db->getQuery(true)
					->select('h.*, c.title as category')
					->from('#__xpoll as h')
					->leftJoin('#__categories as c ON h.catid=c.id')
					->where('h.catid='.(int)$catid));

			if (!$this->items = $this->_db->loadObjectList()) 
			{
                            $this->setError($this->_db->getError());
			}else
                        {
                            foreach ($this->items as &$poll){
                                $this->_db->setQuery($this->_db->getQuery(true)
					->select('*')
					->from('#__xpoll_answers')
					->where('pid='.(int)$poll->id));
                                if (!$poll->answer = $this->_db->loadObjectList()) 
                                {
                                    $this->setError($this->_db->getError());
                                }
                            }
                            unset($poll);
                        }
		}

		return $this->items;
	}

	/**
	 * Метод для авто-заполнения состояния модели.
	 * 
	 * Заметка. Вызов метода getState в этом методе приведет к рекурсии.
	 *
	 * @return void
	 */
	protected function populateState() 
	{
		$app = JFactory::getApplication();

		// Получаем Id сообщения из Запроса.
		$catid = $app->input->getInt('catid');

		// Добавляем Id сообщения в состояние модели.
		$this->setState('xpoll.catid', $catid);

		// Загружаем глобальные параметры.
//		$params = $app->getParams();
//
//		// Добавляем параметры в состояние модели.
//		$this->setState('params', $params);

		parent::populateState();
	}
}