<?php
# Проверяет вводмые данные
#
#

require_once "/home/clebicko/SB/classes/trait_classe/trait_max_battlefield.php";   # Максимальное поле-боя


class Verification_transmitted_data
{
    public $WARNING_SIZE_BATTLEFIELD = "ПРЕДУПРЕЖДЕНИЕ: такой размер поля-боя не доступен!";
    private $span = "<span class='error_pos'>";
    
    use BattleField;
    
    
    # Проверяет доступно ли такое поле-боя
    public function check_size_battlefield($width, $height)
    {
        // доступные поля боя
        $field = ["3x3", "4x4", "5x5", "6x6", "7x7"];
        
        foreach ($field as $v)
        {
            if ($width."x".$height == $v)
            {
                return true;
            }
        }
        
        return false;
    }
    
    
    # Проверка вводимых позиций, чтобы они не выходили за пределы поля
    public function check_entered_positions()
    {
        if (!empty($_REQUEST['pos_of_ships']))
        {
            $array  = $this->add_more_detailed_pos($_REQUEST['pos_of_ships']);            // Изменяем на более подробные позиции
            $result = $this->displays_err_message($array, "first_check", "pos_of_ships"); // Отображает сообщение с недопустимыми позициями
            $_SESSION['player_turn'] = [];  // обнуляем
            return $result;
        }
        else if (!empty($_REQUEST['player_turn']))
        {
            $array = $this->add_more_detailed_pos($_REQUEST['player_turn']);           // Изменяем на более подробные позиции
            return $this->displays_err_message($array, "second_check", "player_turn"); // Отображает сообщение с недопустимыми позициями
        }
    }
    
    
    # Изменяем на более подробные позиции
    private function add_more_detailed_pos($request)
    {
        // Ширина/Высота поля-боя //
        $width  = $_SESSION['field']['width'];
        $height = $_SESSION['field']['height'];
        
        $field  = [];      // поле-боя
        
        $err_pos    = [];  // будем запоминать недопустимые позиции
        $cage_ships = 0;   // Корабли из клеток
        $count      = 0;   // счетчик допустимых позиций
        
        
        $pos_ar = explode('; ', htmlspecialchars($request, ENT_NOQUOTES));
        $ps_ar = [];
        foreach ($pos_ar as $v)
        {
            $ps_ar[] = explode(' ', $v);
        }
            
            
        # Поле-боя с заданными параметрами (ширина/высота)
        for ($tr = 0; $tr < $height; $tr++)
        {
            for ($td = 0; $td < $width; $td++)
            {
                $field[] = self::$max_battlefield[$td+10*$tr];
            }
        }
            
        # Более подробная позиция для ПК
        for ($i = 0; $i < count($ps_ar); $i++)
        {
            for ($i2 = 0; $i2 < count($ps_ar[$i]); $i2++)
            {
                for ($i3 = 0; $i3 < count($field); $i3++)
                {
                    if ($ps_ar[$i][$i2] == $field[$i3][0])
                    {
                        $ps_ar[$i][$i2] = $field[$i3];
                    }
                }
            }
        }
            
        foreach ($ps_ar as $ar)
        {
            $cage_ships += count($ar);    // счетчик: считает сколько всего позиций было задано под корабли
            foreach ($ar as $v)
            {
                if (count($v) == 3)
                {
                    if ($v[1] <= $width && $v[2] <= $height)
                    {
                        // Проверяем была ли эта позиция названа до этого
                        if (!in_array($v[0], $_SESSION['player_turn']))
                        {
                            $_SESSION['player_turn'][] = $v[0];
                            $count++;
                        }
                        else
                        {
                            return array("000" => $v[0]);
                        }
                    }
                }
                else
                {
                    $err_pos[] = $v;
                }
            }
        }
        
        // обычные массив для передачи трех переменных сразу
        $array = [];
        array_push($array, $cage_ships, $count, $err_pos);
        
        return $array;
    }
    
    
    # Отображает сообщение с недопустимыми позициями
    private function displays_err_message($array, $check, $request_name)
    {
        // нет ли, недопустимых позиций                                        
        if (($array[0] == $array[1] || $array[2][0] == "s") && !isset($array["000"]))                                            
        {
            $_SESSION[$check] = false;    // Проверка прошла успешно               
            unset($_SESSION['data_ps']);  // эти данные не надо запоминать!           
        }
        // повторяющаяся позиция
        else if (isset($array["000"]))
        {
            $_SESSION[$check] = true;  // Найдены недопустимые позиции            
            $_SESSION['data_ps'] = $_REQUEST[$request_name];
            
            return $this->span."Такая позиция уже имеется => ".$array['000']."</span>";
        }
        else                                                                    
        {                                                                           
            $_SESSION[$check] = true;  // Найдены недопустимые позиции            
            $_SESSION['data_ps']     = $_REQUEST[$request_name];
                
            $err = "ERROR: недопустимая(ые) позиция(и) => ";
                
            for ($i = 0; $i < count($array[2]); $i++)
            {
                $err .= $array[2][$i];
                if ($i != count($array[2])-1)
                $err .= ", ";
            }
                    
            return $this->span.$err."</span>";
        }
    }
}
?>
