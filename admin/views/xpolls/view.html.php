<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку представления Joomla.
jimport('joomla.application.component.view');

/**
 * HTML представление списка сообщений компонента Xpoll.
 */
class XpollViewXpolls extends JViewLegacy
{
	/**
	 * Сообщения.
	 *
	 * @var array 
	 */
	protected $items;

	/**
	 * Постраничная навигация.
	 *
	 * @var object
	 */
	protected $pagination;

	/**
	 * Доступы пользователя.
	 *
	 * @var object
	 */
	protected $canDo;

	/**
	 * Отображает список сообщений.
	 *
	 * @return void
	 */
	public function display($tpl = null) 
	{
		// Получаем данные из модели.
		$this->items = $this->get('Items');

		// Получаем объект постраничной навигации.
		$this->pagination = $this->get('Pagination');

		// Есть ли ошибки.
		if (count($errors = $this->get('Errors'))) 
		{
			JFactory::getApplication()->enqueueXpoll(implode('<br />', $errors), 'error');
		}

		// Получаем доступы пользователя.
		$this->canDo = XpollHelper::getActions();

		// Устанавливаем панель инструментов.
		$this->addToolBar();

		// Устанавливаем боковую панель.
		$this->sidebar = JHtmlSidebar::render();
 
		// Отображаем представление.
		parent::display($tpl);
	}

	/**
	 * Устанавливает панель инструментов.
	 *
	 * @return void
	 */
	protected function addToolBar() 
	{
		JToolBarHelper::title(JText::_('COM_XPOLL_MANAGER_XPOLLS'), 'xpoll');
		if ($this->canDo->get('core.create'))
		{
			JToolBarHelper::addNew('xpoll.add');
		}
		if ($this->canDo->get('core.edit'))
		{
			JToolBarHelper::editList('xpoll.edit');
		}
		if ($this->canDo->get('core.delete'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::deleteList('', 'xpolls.delete');
		}
		if ($this->canDo->get('core.admin'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_xpoll');
		}
	}
}