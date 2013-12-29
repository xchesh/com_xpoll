<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку представления Joomla.
jimport('joomla.application.component.view');

/**
 * HTML представление сообщения компонента Xpoll.
 */
class XpollViewLoad extends JViewLegacy
{
	/**
	 * Сообщение.
	 *
	 * @var object 
	 */
	protected $item;

	/**
	 * Переопределяем метод display класса JViewLegacy.
	 * 
	 * @return void
	 */
	public function display($tpl = null) 
	{
		// Получаем сообщение.
		$this->item = $this->get('Item');

		// Есть ли ошибки.
		if (count($errors = $this->get('Errors')))
		{
			foreach ($errors as $error)
			{
				JLog::add($error, JLog::ERROR, 'com_xpoll');
			}
		}

		$max_count = 1;
                echo '<div class="wrap_answer">';
                foreach($this->item as $answer)
                {
                    if ($max_count<$answer->count)
                    {
                        $max_count=$answer->count;
                    }
                }
                foreach($this->item as $answer){
                    echo '<div class="one_answer">';
                    echo '<p>'.$answer->title.'</p>';
                    echo '<div class="bar_answer" style="width:'.(100/$max_count*$answer->count).'%"><span>'.$answer->count.'</span></div>';
                    echo '</div>';
                }
                echo '</div>';
	}

}