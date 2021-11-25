<?php
# Начать играть
#

require_once "/home/clebicko/SB/classes/trait_classe/trait_max_battlefield.php";   # Максимальное поле-боя

abstract class Play
{
    use BattleField;
    
    
    # логика игры
    abstract protected static function sb_play();
}
?>
