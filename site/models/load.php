<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку modelitem Joomla.
jimport('joomla.application.component.modelitem');

/**
 * Модель сообщения компонента Xpoll.
 */
class XpollModelLoad extends JModelItem
{
	/**
	 * Сообщение.
	 *
	 * @var object
	 */
	protected $item;

	/**
	 * Возвращает ссылку на объект таблицы.
	 *
	 * @param	type		Тип таблицы
	 * @param	string		Префикс имени класса таблицы. Необязателен.
	 * @param	array		Конифгурационный массив для таблицы. Необязателен.
	 * 
	 * @return	JTable	Объект таблицы.
	 */
//	public function getTable($type = 'Xpoll', $prefix = 'XpollTable', $config = array()) 
//	{
//		return JTable::getInstance($type, $prefix, $config);
//	}

	/**
	 * Получаем сообщение.
	 * 
	 * @return object Сообщение, которое отображается пользователю.
	 */
	public function getItem() 
	{
		if (!isset($this->item)) 
		{
                    $id = $this->getState('xpoll.id');
                    $poll = $this->getState('xpoll.poll');
                    if ($poll){
                        $this->_db->setQuery($this->_db->getQuery(true)
                                ->update('#__xpoll_answers')
                                ->set('count=count+1')
                                ->where('id='.$poll));
                        $this->_db->query();
                    }
                    $this->_db->setQuery($this->_db->getQuery(true)
                            ->select('*')
                            ->from('#__xpoll_answers')
                            ->where('pid='.(int)$id));
                    if (!$this->item = $this->_db->loadObjectList()) 
                    {
                        $this->setError($this->_db->getError());
                    }
                }
		return $this->item;
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
		$id = $app->input->getInt('id');
                $poll = $app->input->getInt('poll');
		// Добавляем Id сообщения в состояние модели.
		$this->setState('xpoll.id', $id);
                $this->setState('xpoll.poll', $poll);
		parent::populateState();
	}
}