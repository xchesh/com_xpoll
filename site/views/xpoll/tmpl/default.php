<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

//print_r($this->items);

echo '<div class="polls">';
echo '<h1>'.$this->items[0]->category.'</h1>';
if (!empty($this->items))
{
    
    foreach ($this->items as $poll)
    {
        $max_count = 1;
        echo '<div class="wrap_poll">';
        echo '<div class="title_poll">';
        echo '<p>'.$poll->title.'</p>';
        echo '</div>';
        echo '<div class="wrap_answer">';
        foreach($poll->answer as $answer)
        {
            if ($max_count<$answer->count)
            {
                $max_count=$answer->count;
            }
        }
        foreach($poll->answer as $answer){
            echo '<div class="one_answer">';
            echo '<p>'.$answer->title.'</p>';
            echo '<div class="bar_answer" style="width:'.(100/$max_count*$answer->count).'%"><span>'.$answer->count.'</span></div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
}
echo '</div>';
?>