<?php
session_start();

require_once "/home/clebicko/SB/view/view.php";                        # HTML-страница
require_once "/home/clebicko/SB/classes/name_of_game.php";             # Выводит название игры
require_once "/home/clebicko/SB/classes/pick_size_battlefield.php";    # Позволяет задать размер поля-боя

View::head();
echo "<pre>";

switch ($_REQUEST['response'])
{
    case 0;
    {   Name_of_game::result();
        echo "<br />";
        Pick_size_battlefield::sise_field(); // Выбрать размер поля-боя
        
        if (!empty($_SESSION['field']['width']) && !empty($_SESSION['field']['height']))
        {
            ?>
            <style>
                .btn_start
                {
                    border: 1px solid white;
                    background-color: black;
                    color: white;
                    position: absolute;
                    margin-left: -100px;
                    margin-top: -67px;
                    font-size: 102%;
                    cursor: pointer;
        
                    /* убираем обводку */
                    outline:none;
                }
            </style>
            <form action='battlefield_html.php' method='POST'> 
                <input class='btn_start' type='submit' name='play' value='ВПЕРЁД' />
            </form>
            <?php
        }
        break;
    }
    case 1;
        echo "<br />Инструкция:<br />
              1) что нужно знать - как правильно расстовлять корабли на поле-боя в начале игры!<br />
                  - к примеру, пишешь в поле ввода следующие позиции: a1 a2 (обязательно нужно поставить пробел
                    между позициями) - это один корабль, если нужно расставить несколько кораблей, то между
                    каждым кораблем нужно поставаить символы - ;  (т.е. точка с запятой и пробел!),
                    а иначе ничего не получится.
                
                  - при расстановке кораблей не надо учитывать правила как в оригинальной игре Морской-Бой, можно
                    расстовлять как душе угодно (по горизонтали, по вертикали, наискосок или просто раскидать части
                    корабля по всему полю и указть, что это единый корабль, например узорчиком).
                
                  - Главное - это победить ПК!
              
              2) user всегда начинает игру первым;
              
              3) чтобы атаковать противника нужно ввести позицию в поле-ввода \"Ваш ход: \";
              
              4) если высвечивается вот такая строка <span style='color: red;'>Вы заблокированны: введите в строке ввода команду \"s\"</span> - это
                 значит что ПК подбил твой корабль и ты не можешь больше вводить позиции, пока не введешь в поле-ввода
                 букву s.
                      
                      Примечание: поскольку вся игра написана на php, надо просто помочь ПК
                                  сделать ход повторно, пока ты как игрок заблокирован.
                                  Тебе нужно просто ввести букву s в строку-ввода и
                                  нажать на enter. И ожидать того, что следующий ход
                                  будет твоим.
              
              
              5) если подбил или уничтожил корабль, то дается вторая попытка.";
        break;
    case 2;
        echo "<br />Рекорды: Данный раздел еще в разработке!";
        break;
    case 3:
    {
        # Удаляем ненужные данные #
        unset($_SESSION['field']);
        unset($_SESSION['pos_of_ships']);
        unset($_SESSION['ships_destruction']);
        unset($_SESSION['pos_of_ships_cl2']);
        unset($_SESSION['ships_destruction_cl2']);
        unset($_SESSION['ps_pk']);
        unset($_SESSION['ps_user']);
        unset($_SESSION['count']);
        unset($_SESSION['key']);
        unset($_SESSION['second_try']);
        unset($_SESSION['the_end']);
        unset($_SESSION['check']);
        unset($_SESSION['data_ps']);
        unset($_SESSION['first_check']);
        unset($_SESSION['second_check']);
        unset($_SESSION['player_turn']);
        View::message_before_exit();
        break;
    }
    default:
    {
        echo "<br />Error: Переданные данные не корректны!";
    }
}

echo "</pre>";
View::end_body();
?>
