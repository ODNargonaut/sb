<?php
session_start();

require_once "/home/clebicko/SB/view/view.php";             # HTML-страница
require_once "/home/clebicko/SB/classes/battle_field.php";  # Поле боя
require_once "/home/clebicko/SB/classes/pk.php";            # Игрок - ПК
require_once "/home/clebicko/SB/classes/user.php";          # Игрок - Пользователь

if (!isset($_SESSION['pos_of_ships']) && !isset($_SESSION['ships_destruction']) && !isset($_SESSION['count']) && !isset($_SESSION['key'])
    &&
    !isset($_SESSION['pos_of_ships_cl2']) && !isset($_SESSION['ships_destruction_cl2']) && !isset($_SESSION['the_end'])
    &&
    !isset($_SESSION['second_try'])
    &&
    !isset($_SESSION['first_check']) && !isset($_SESSION['second_check'])
    &&
    !isset($_SESSION['player_turn']))
{
                // игрок user //
    $_SESSION['pos_of_ships']      = [];
    $_SESSION['ships_destruction'] = [];
    
                // игрок ПК //
    switch ($_SESSION['field']['width']."x".$_SESSION['field']['height'])
    {
        case "3x3": $ps = Pk::$ps_pk_ships["3x3"]; break;
        case "4x4": $ps = Pk::$ps_pk_ships["4x4"]; break;
        case "5x5": $ps = Pk::$ps_pk_ships["5x5"]; break;
        case "6x6": $ps = Pk::$ps_pk_ships["6x6"]; break;
        case "7x7": $ps = Pk::$ps_pk_ships["7x7"]; break;
    }
    
    shuffle($ps);
    
    $_SESSION['pos_of_ships_cl2']      = $ps[4];
    $_SESSION['ships_destruction_cl2'] = $ps[4];
    
    $_SESSION['count']              = true;   // не дает затерять позиции кораблей игрока
    $_SESSION['key']                = false;  // чтобы ПК не называл позицию дважды на поле-боя
    
    $_SESSION['first_check']        = true;   // Проверка вводимых позиций для растановки кораблей
    $_SESSION['second_check']       = true;   // Проверка вводимых позиций для атаки
    
    $_SESSION['second_try']['pk']   = false;  // |если подбил/уничтожил корабль, то дается вторая попытка
    $_SESSION['second_try']['user'] = false;  // |
    
    $_SESSION['player_turn']        = [];     // будет сохранять ходы, которые называл user
    
    $_SESSION['the_end']['the_end'] = false;  // конец игры
}

// если игра кончилась, то проверять вдодные данные не надо!
if (!$_SESSION['the_end']['the_end'])
{
    $CE_pos = new Verification_transmitted_data();
    $result = $CE_pos->check_entered_positions();
}

if (!isset($_REQUEST['pos_of_ships']) && $_SESSION['count'] == true || $_SESSION['first_check'])
{
    User::position_on_field("Расставить корабли",
                             "pos_of_ships");      // Расстановка кораблей
    echo $result;
    
    Battle_field::field();
}
else
{
    User::transferred_positions_user();                                       # позиции кораблей игрока
    if ($_SESSION['key'])
    {
        User::position_on_field("Ваш ход", "player_turn", "maxlength='3'");   # ход игрока
        
        Pk::vm_turn();        // Поле-боя ПК
        User::player_turn();  // Поле-боя User
        
        echo "<span class='num_of_ships'>Осталось кораблей у ПК - ".count($_SESSION['pos_of_ships_cl2'])."</span>";  // сколько кораблей противника ост. уничтожить
        echo $result;
        
        if ($_SESSION['the_end']['the_end'])
        {
            echo "<span class='the_end'>Победил ".$_SESSION['the_end']['player'].".</span>";     // уточняем кто именно победил или завершил игру
        }
    }
}

?>
<style>
    .res_arr
    {
        position: absolute;
        margin-top: 600px;
    }
    
</style>
<div class='res_arr'>
<?php

echo "</pre>";
View::end_body();
?>
