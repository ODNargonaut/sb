<?php
# Игрок - ПК
#

require_once "abstract_classes/abstract_play.php";   # Начать играть


class Pk extends Play
{
    public static $ps_pk_ships =                   // Позиции кораблей ПК
    [
        "3x3" =>
        [
            [["a1", "b1"],["b3", "c3"]],
            [["a1", "a2", "a3"], ["c1", "c2", "c3"]],
            [["a1", "a2"], ["c1", "c2"], ["b3"]],
            [["a1"], ["a3"], ["c1"], ["c3"]],
            [["a2", "b2"], ["b1", "c1"], ["b3", "c3"]],
            [["a1", "b2", "c3"], ["a3"], ["c1"]],
            [["a1", "b1"], ["a2", "b2"], ["c3"]],
            [["b2", "c2"], ["b3", "c3"], ["a1"]]
        ],
        "4x4" =>
        [
            [["a1", "a2"], ["c1", "c2"], ["c4", "d4"], ["a4"]],
            [["a1", "a2", "a3"], ["b1", "c1"], ["d2", "d3"], ["b4", "c4"]],
            [["a1", "b1"], ["d1", "d2"], ["b3", "b4"], ["d4"]],
            [["a3", "a4"], ["b1", "b2"], ["c3", "d3"], ["d1"]],
            [["a2"], ["b1"], ["c2"], ["b3"], ["d1"], ["d3"], ["c4", "d4"]],
            [["b2", "b3"], ["d1"]],
            [["a1"], ["c1"], ["c4"], ["a4"], ["b2", "b3"], ["d2", "d3"]],
            [["a1", "a2", "b1", "b2"], ["a3", "a4", "b3", "b4"], ["c1"], ["c4"], ["d2", "d3"]]
        ],
        "5x5" =>
        [
            [["a1", "a2"], ["c1"], ["d2"], ["c3"], ["b4"], ["e4"], ["d5", "e5"]],
            [["b1", "c1", "d1"], ["b5", "c5", "d5"], ["a1", "a2", "a3", "a4", "a5"], ["e1", "e2", "e3", "e4", "e5"], ["b2"], ["b4"], ["c3"], ["d2"], ["d4"]],
            [["a3", "a4"], ["c4", "c5"], ["d3", "e3"], ["c1", "d1", "e1"], ["a1"], ["e5"]],
            [["a3", "b3", "c3", "d3", "e3"], ["b2"], ["b4"], ["c1"], ["c5"], ["d2"], ["d4"]],
            [["a4"], ["d1"], ["d4"]],
            [["c2", "c3", "c4"], ["b3"], ["d3"]],
            [["a1", "a2"], ["a5", "b5"], ["d1", "e1"], ["e4", "e5"]],
            [["a1", "a2"], ["a5", "b5"], ["d1", "e1"], ["e4", "e5"], ["b2", "b3", "b4"], ["c2", "c3", "c4"], ["c2"], ["c4"]]
        ],
        "6x6" =>
        [
            [["b3", "b4", "b5"], ["d6", "e6", "f6"], ["a1", "b1"], ["e2", "e3"], ["f4"]],
            [["a1", "a2", "a3"], ["c1", "c2", "c3"], ["e1", "e2", "e3"], ["a5", "a6"], ["c5", "c6"], ["e5", "e6"], ["b4"], ["d4"]],
            [["a1", "a2", "a3"], ["c1", "c2", "c3"], ["e1", "e2", "e3"], ["a5", "a6"], ["c5", "c6"], ["e5", "e6"]],
            [["a1", "a2", "a3"], ["c1", "c2", "c3"], ["e1", "e2", "e3"], ["a6"], ["c6"], ["e6"]],
            [["a1", "a2"], ["c1", "c2"], ["e1", "e2"], ["a6"], ["c6"], ["e6"]],
            [["a1"], ["c1"], ["e1"], ["a6"], ["c6"], ["e6"]],
            [["a4", "a5", "a6", "b4", "b5", "b6"], ["d2", "d3", "d4", "e2", "e3", "e4"], ["a1", "a2", "b1", "b2"], ["f5", "f6", "e6"]],
            [["f4", "f5", "f6", "e5"], ["a4", "b4", "b5", "c5", "b6", "a6"], ["c2", "d1", "d2", "d3", "e1", "e3"], ["a1", "a2"]]
        ],
        "7x7" =>
        [
            [["f5", "f6", "f7"], ["a1", "b1"], ["a3", "b3"], ["a5", "b5"], ["b7", "c7"], ["d3", "e3"], ["f1", "g1"], ["d1"], ["d5"], ["g3"]],
            [["a2", "a3"], ["c7", "d7"], ["g3", "g4", "g5"], ["a7"], ["g7"], ["b1", "b5", "c2", "c3","c4", "d2", "d3", "d4", "e1", "e5"]],
            [["b5"], ["d5"], ["b2", "c2"], ["e3", "f3"], ["g5", "g6", "g7"]],
            [["f2", "g1"], ["d4", "e3", "f4"], ["a2", "b3", "c4"], ["c7", "d7", "e7"], ["a7"], ["g7"]],
            [["b2", "c3", "b4"], ["e5", "f6"], ["f2", "e3", "d4", "c5", "d6"]],
            [["c3", "c4", "c5", "d3", "d4", "d5", "e3", "e4", "e5"], ["b2"], ["a7"], ["g1"], ["f6"]],
            [["a1", "b2", "c3", "d4", "e5", "f6", "g7", "e3", "f2", "g1"], ["b5", "b6", "c6", "c7"]],
            [["d1", "d2", "d3", "e1", "e2", "e3"], ["b5", "b6"], ["d6", "e6"], ["g5", "g6"]],
        ]
    ];         
    
    
    # Поле-боя ПК
    public static function vm_turn()
    {
        echo "<div class='battlefield_pk'>";
        self::sb_play();
        echo "</div>";
    }
    
    
    # логика игры
    protected static function sb_play()
    {
        // Ширина/Высота поля-боя //
        $width  = $_SESSION['field']['width'];
        $height = $_SESSION['field']['height'];
        
        
        # Поле-боя с заданными параметрами (ширина/высота)
        if (!isset($_SESSION['field']['array_cl2']))
        {
            for ($tr = 0; $tr < $height; $tr++)
            {
                for ($td = 0; $td < $width; $td++)
                {
                    $_SESSION['field']['array_cl2'][] = self::$max_battlefield[$td+10*$tr];
                }
            }
        }
        
        if (self::pos_of_ships_battlefield())
        {
            # Более подробная позиция для ПК
            for ($i = 0; $i < count($_SESSION['pos_of_ships_cl2']); $i++)
            {
                for ($i2 = 0; $i2 < count($_SESSION['pos_of_ships_cl2'][$i]); $i2++)
                {
                    for ($i3 = 0; $i3 < count($_SESSION['field']['array_cl2']); $i3++)
                    {
                        if ($_SESSION['pos_of_ships_cl2'][$i][$i2] == $_SESSION['field']['array_cl2'][$i3][0])
                        {
                            $_SESSION['pos_of_ships_cl2'][$i][$i2] = $_SESSION['field']['array_cl2'][$i3];
                        }
                    }
                }
            }
            
            $_SESSION['ships_destruction_cl2'] = $_SESSION['pos_of_ships_cl2'];
        }
        
        
        $ps_pk;          // позиции названные пк
        $count = true;   // счетчик считает попадания в корабль и помагает опр. промох ПК +
        $field = ' ';                                                                   //+ помагает опр. если было попадание/уничтожение корабля,                                                                              //  то дается вторая попытка
                                                                                        
        if (!$_SESSION['the_end']['the_end']
            &&
            $_SESSION['second_try']['pk'] == false)   // если подбил/уничтожил корабль, то дается вторая попытка, а здесь блокировка происходит
        {
            $_SESSION['field']['array_cl2'] = array_values($_SESSION['field']['array_cl2']);   // преврощаем в обычный список
            $_SESSION['pos_of_ships_cl2']   = array_values($_SESSION['pos_of_ships_cl2']);   // преврощаем в обычный список
            
            // это нужно для того, чтобы в двухмерном массиве был список, а не ассоциативный массив!
            for ($i = 0; $i < count($_SESSION['pos_of_ships_cl2']); $i++)
            {
                $_SESSION['pos_of_ships_cl2'][$i] = array_values($_SESSION['pos_of_ships_cl2'][$i]);
            }
            
            
            // Попытка угадать, где находится корабль;
            // И, если он найден то нужно либо уничтожить его, либо подбить
            for($f_ps = 0; $f_ps < count($_SESSION['field']['array_cl2']); $f_ps++)
            {
                if ($_SESSION['field']['array_cl2'][$f_ps][0] == $_REQUEST['player_turn'])
                {
                    $field = $_SESSION['field']['array_cl2'][$f_ps]; 
                }
            }
                
            echo $field[0]."<br />";
                
            for ($y = 0; $y <= count($_SESSION['pos_of_ships_cl2']); $y++)
            {
                for ($i = 0; $i <= @count($_SESSION['pos_of_ships_cl2'][$y]); $i++)
                {                    
                    if ($field[0] == $_SESSION['pos_of_ships_cl2'][$y][$i][0])
                    {
                        if (count($_SESSION['pos_of_ships_cl2'][$y]) != 1)
                        {
                            //echo "Подбил<br />";
                            $_SESSION['second_try']['user'] = true;
                            self::ps_destruction($_SESSION['pos_of_ships_cl2'][$y][$i][0]);                // Запоминаем подбитое место у корабля
                            unset($_SESSION['pos_of_ships_cl2'][$y][$i]);  // Удаляем ту чать корабля, которую подбил
                        }
                        else
                        {
                            //echo "Убил!<br />";
                            $_SESSION['second_try']['user'] = true;
                            self::ps_destruction($_SESSION['pos_of_ships_cl2'][$y][$i][0]);                // Запоминаем подбитое место у корабля
                            unset($_SESSION['pos_of_ships_cl2'][$y]);  // Удаляем ту чать корабля, которую подбил
                        }
                            
                        $count = false;
                    }
                }
            }
            
            # если промазал, то отбирается вторая попытка
            if ($count)
            {
                $_SESSION['second_try']['user'] = false;
            }
                
            # Запоминаем позиции названные ПК 
            if ($count === true)
            {
                $_SESSION['ps_user'][] = $field;
            }
                
            $count = true;                  // возращаем в исходную
                
            for($f_ps = 0; $f_ps < count($_SESSION['field']['array_cl2']); $f_ps++)
            {
                if ($_SESSION['field']['array_cl2'][$f_ps][0] == $field[0])
                {
                    unset($_SESSION['field']['array_cl2'][$f_ps]);    // Удаляем позицию названную пк
                }
            }
                
            Battle_field::field($_SESSION['pos_of_ships_cl2'],
                                $_SESSION['ships_destruction_cl2'],
                                $_SESSION['ps_user'], false);         // Закрашиваем клетку на поле
            
            // Завершаем игру, если кораблей не осталось
            if (count($_SESSION['pos_of_ships_cl2']) == 0)
            {
                $_SESSION['the_end']['the_end'] = true;
                $_SESSION['the_end']['player']  = "User";
            }
        }
        else
        {
            Battle_field::field($_SESSION['pos_of_ships_cl2'],
                                $_SESSION['ships_destruction_cl2'],
                                $_SESSION['ps_user'], false);         // показываем поле чисто для вида
        }
    }
    
    
    # Позиции кораблей на поле-боя
    private static function pos_of_ships_battlefield()
    {
        foreach ($_SESSION['ships_destruction_cl2'] as $arr)
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
        for ($i = 0; $i < count($_SESSION['ships_destruction_cl2']); $i++)
        {
            for ($i2 = 0; $i2 < count($_SESSION['ships_destruction_cl2'][$i]); $i2++)
            {
                if ($_SESSION['ships_destruction_cl2'][$i][$i2][0] == $ps)
                {
                    $_SESSION['ships_destruction_cl2'][$i][$i2][0] = null;
                }
            }
        }
    }
}
?>
