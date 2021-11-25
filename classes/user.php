<?php
# Игрок - Пользователь
#

require_once "abstract_classes/abstract_play.php";   # Начать играть
require_once "verification_transmitted_data.php";    # Проверяет вводмые данные


class User extends Play
{  
    # Поле-боя User
    public static function player_turn()
    {
        $width = $_SESSION['field']['width'];
        ?><div style='position: absolute; margin-left: <?php echo 100*$width+300;?>px; color: #228B22;'><?php
        self::sb_play();
        ?></div><?php
    }
    
    
    # Расстановка кораблей/позиция игрока
    public static function position_on_field($str, $name, $max = null)
    {
        $width = $_SESSION['field']['width'];
        
        View::head("css/battlefield_user.css");
        echo "<pre>";
        ?>
        <style>
        .btn_exit
        {
            border: 0.5px solid white;
            background-color: black;
            color: white;
            position: absolute;
            font-size: 105%;
            cursor: pointer;
        
            /* убираем обводку */
            outline:none;
        }
        
        .btn_exit:hover
        {
            background-color: #FF4500;
        }
        
        .pos
        {
            background-color: black;
            color: white;
            position: absolute;
            margin-left: 100px;
            margin-top: 67px;
            font-size: 102%;
            cursor: pointer;
            
            /* убираем обводку */
            outline:none;
        }
        
        .inp_pos
        {
            border-top: none;
            border-left: none; 
            border-right: none;
            border-bottom: 1px solid white;
            background-color: black;
            color: white;
            font-size: 102%;
            
            /* убираем обводку */
            outline:none;
        }
        
        .block_form
        {
            position: absolute;
            margin-top: -100px;
        }
        
        .form1
        {
            position: absolute;
            margin-left: -120px;
            margin-top: 20px;
        }
        
        .form2
        {
            position: absolute;
            margin-left: 0px;
            margin-top: 90px;
            font-size: <?php
                        switch ($width)
                        {
                            case 7 : echo 110; break;
                            case 8 : echo 123; break;
                            case 9 : echo 133; break;
                            case 10: echo 145; break;
                            
                            default: echo 100;
                        }
            ?>%;
        }
        
        /* Вторая попытка */
        .second_try_pk
        {
            position: absolute;
            color: white;
            margin-left: -130px;
            margin-top: -95px;
            font-size: <?php
                        switch ($width)
                        {
                            case 7 : echo 118; break;
                            case 8 : echo 123; break;
                            case 9 : echo 133; break;
                            case 10: echo 145; break;
                            
                            default: echo 104;
                        }
            ?>%;
        }
        
        .error_pos
        {
            position: absolute; position: fixed;
            margin-left: 550px; margin-top: -65px;
            color: #FF4500;
            font-size: <?php
                        switch ($width)
                        {
                            case 7 : echo 118; break;
                            case 8 : echo 123; break;
                            case 9 : echo 133; break;
                            case 10: echo 145; break;
                            
                            default: echo 104;
                        }
            ?>%;
        }
        </style>
        <div class='block_form'>
            <form class='form1' action='/view/html/view_html.php' method='POST'>
                <button title='Завершить игру' class='btn_exit' type='submit' name='response' value='3'>Закончить</button>
            </form>
            <?php
            // не нужно больше отображать поле-ввода
            if (!$_SESSION['the_end']['the_end'])
            {
            ?>
            <form class='form2' action='#' method='POST' class='pos'>
                <?php echo $str.": "; ?><input name='<?php echo $name; ?>' <?php echo $max; ?> class='inp_pos' type='text' value='<?php
                                                                                                                                   echo isset($_SESSION['data_ps'])?$_SESSION['data_ps']:'';
                                                                                                                                   ?>' />
            </form>
            <?php } ?>
        </div>
        <br /><br /><br /><br /><br /><br /><br />
        <?php
    }
    
    
    # Позиции кораблей игрока
    public static function transferred_positions_user()
    {
        if ($_SESSION['count'])
        {
            $pos_ar = explode('; ', htmlspecialchars($_REQUEST['pos_of_ships'], ENT_NOQUOTES));
            $pos_ar_cl = [];
            foreach ($pos_ar as $v)
            {
                $pos_ar_cl[] = explode(' ', $v);
            }
            
            $_SESSION['pos_of_ships']      = $pos_ar_cl;
            $_SESSION['ships_destruction'] = $pos_ar_cl;
            $_SESSION['count'] = false; // позиции кораблей игрока под ключем
            
            header("Location: http://localhost:4000/view/html/battlefield_html.php");
        }
        // чтобы ПК не называл позицию дважды на поле-боя
        else
        {
            $_SESSION['key'] = true;  
        }
    }
    
    
    # логика игры
    protected static function sb_play()
    {
        // Ширина/Высота поля-боя //
        $width  = $_SESSION['field']['width'];
        $height = $_SESSION['field']['height'];
        
        
        # Поле-боя с заданными параметрами (ширина/высота)
        if (!isset($_SESSION['field']['array']))
        {
            for ($tr = 0; $tr < $height; $tr++)
            {
                for ($td = 0; $td < $width; $td++)
                {
                    $_SESSION['field']['array'][] = self::$max_battlefield[$td+10*$tr];
                }
            }
        }
        
        if (self::pos_of_ships_battlefield())
        {
            # Более подробная позиция для ПК
            for ($i = 0; $i < count($_SESSION['pos_of_ships']); $i++)
            {
                for ($i2 = 0; $i2 < count($_SESSION['pos_of_ships'][$i]); $i2++)
                {
                    for ($i3 = 0; $i3 < count($_SESSION['field']['array']); $i3++)
                    {
                        if ($_SESSION['pos_of_ships'][$i][$i2] == $_SESSION['field']['array'][$i3][0])
                        {
                            $_SESSION['pos_of_ships'][$i][$i2] = $_SESSION['field']['array'][$i3];
                        }
                    }
                }
            }
            
            $_SESSION['ships_destruction'] = $_SESSION['pos_of_ships'];
        }
        
        
        $ps_pk;          // позиции названные пк
        $count = true;   // счетчик считает попадания в корабль и помагает опр. промох ПК 
        
        if (!$_SESSION['the_end']['the_end']
            &&
            $_REQUEST['player_turn'] != false           // пока user не сделает ход, ПК не будет продолжать играть
            &&
            $_SESSION['second_try']['user'] == false    // если подбил/уничтожил корабль, то дается вторая попытка, а здесь блокировка происходит
            &&
            !$_SESSION['second_check'])                 // Проверка вводимых позиций для атаки
        {
            // Попытка угадать, где находится корабль;
            // И, если он найден то нужно либо уничтожить его, либо подбить
            shuffle($_SESSION['field']['array']);
            echo $_SESSION['field']['array'][0][0]."<br />";
            
            $_SESSION['pos_of_ships'] = array_values($_SESSION['pos_of_ships']);                       // преврощаем в обычный список
            
            // это нужно для того, чтобы в двухмерном массиве был список, а не ассоциативный массив!
            for ($i = 0; $i < count($_SESSION['pos_of_ships']); $i++)
            {
                $_SESSION['pos_of_ships'][$i] = array_values($_SESSION['pos_of_ships'][$i]);
            }
            
            for ($y = 0; $y <= count($_SESSION['pos_of_ships']); $y++)
            {
                for ($i = 0; $i <= count($_SESSION['pos_of_ships'][$y]); $i++)
                {
                    if ($_SESSION['field']['array'][0][0] == $_SESSION['pos_of_ships'][$y][$i][0])
                    {
                        if (count($_SESSION['pos_of_ships'][$y]) != 1)
                        {
                            //echo "Подбил<br />";
                            $_SESSION['second_try']['pk'] = true;
                            self::ps_destruction($_SESSION['pos_of_ships'][$y][$i][0]);                // Запоминаем подбитое место у корабля
                            unset($_SESSION['pos_of_ships'][$y][$i]);  // Удаляем ту чать корабля, которую подбил
                        }
                        else
                        {
                            //echo "Убил!<br />";
                            $_SESSION['second_try']['pk'] = true;
                            self::ps_destruction($_SESSION['pos_of_ships'][$y][$i][0]);                // Запоминаем подбитое место у корабля
                            unset($_SESSION['pos_of_ships'][$y]);  // Удаляем ту чать корабля, которую подбил
                        }
                            
                        $count = false;
                    }
                }
            }
            
            # если промазал, то отбирается вторая попытка
            if ($count)
            {
                $_SESSION['second_try']['pk'] = false;
            }
            
            # Предупреждаем игрока, что его ввод на время заблокирован!
            if ($_SESSION['second_try']['pk'] && count($_SESSION['pos_of_ships']) != 0)
            {
                echo "<span class='second_try_pk'>Вы заблокированны: введите в строке ввода команду \"s\"</span>";
            }   
            
            # Запоминаем позиции названные ПК 
            if ($count === true)
            {
                $_SESSION['ps_pk'][] = $_SESSION['field']['array'][0];
            }
                
            $count = true;                  // возращаем в исходную
                
            unset($_SESSION['field']['array'][0]);    // Удаляем позицию названную пк
                
                
            Battle_field::field($_SESSION['pos_of_ships'],
                                $_SESSION['ships_destruction'],
                                $_SESSION['ps_pk']);         // Закрашиваем клетку на поле
            
            
            // Завершаем игру, если кораблей не осталось
            if (count($_SESSION['pos_of_ships']) == 0)
            {
                $_SESSION['the_end']['the_end'] = true;
                $_SESSION['the_end']['player']  = "Pk";
            }
        }
        else
        {
            Battle_field::field($_SESSION['pos_of_ships'],
                                $_SESSION['ships_destruction'],
                                $_SESSION['ps_pk']);         // показываем поле чисто для вида
        }
    }
    
    
    # Позиции кораблей на поле-боя
    private static function pos_of_ships_battlefield()
    {
        foreach ($_SESSION['ships_destruction'] as $arr)
        {
            foreach ($arr as $v)
            {
                if (!is_array($v))
                {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    
    # Запоминает подбитые части корабля
    private static function ps_destruction($ps)
    {
        for ($i = 0; $i < count($_SESSION['ships_destruction']); $i++)
        {
            for ($i2 = 0; $i2 < count($_SESSION['ships_destruction'][$i]); $i2++)
            {
                if ($_SESSION['ships_destruction'][$i][$i2][0] == $ps)
                {
                    $_SESSION['ships_destruction'][$i][$i2][0] = null;
                }
            }
        }
    }
}
?>
