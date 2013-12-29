<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

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
?>
