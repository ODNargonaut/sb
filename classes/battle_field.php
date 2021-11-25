<?php
# Поле боя
#

class Battle_field
{
    public static function field($ps_ships = null, $ships_destr = null, $ps = null, $hidden = true)
    {
        $width       = $_SESSION['field']['width'];
        $height      = $_SESSION['field']['height'];
        
        $ps_ships    = $ps_ships;       // Позиции расставленных кораблей игрока
        $ships_destr = $ships_destr;    // Запоминаем подбитое место у корабля
        
        $ps          = $ps;             // Запоминаем позиции названные ПК 
        
        $ascii       = [];   // АSCII цифры
    
    //  ======.
    //  Важно!==.
    //  =======================================================
        $col = 8;                               // столбик   ==
    //  =======================================================
    
        for ($n = 0; $n < $width; $n++)
        {
            if ($n == 0)
            {
                // визуальных эффект не тот, т.е. криво вначале смотрятся цифры :(
                if (empty($_SESSION['pos_of_ships'][0]) && empty($_SESSION['pos_of_ships'][1])
                    &&
                    empty($_SESSION['ships_destruction'][0]) && empty($_SESSION['ships_destruction'][1]))
                    $ascii[] = "                          /$$       ";
                else
                    $ascii[] = "                                  /$$       ";
                $ascii[] = "                                /$$$$       ";
                $ascii[] = "                               |_  $$       ";
                $ascii[] = "                                 | $$       ";          
                $ascii[] = "                                 | $$       ";
                $ascii[] = "                                 | $$       ";
                $ascii[] = "                                /$$$$$$     ";
                $ascii[] = "                               |______/     ";
            }
            else if ($n == 1)
            {
                $ascii[] = "  /$$$$$$      ";
                $ascii[] = " /$\$__  $$     ";
                $ascii[] = "|__/  \\ $$    ";
                $ascii[] = "  /$$$$$$/     ";        
                $ascii[] = " /$\$____/      ";
                $ascii[] = "| $$           ";
                $ascii[] = "| $$$$$$$$    ";
                $ascii[] = "|________/     ";
            }
            else if ($n == 2)
            {
                $ascii[] = " /$$$$$$   ";
                $ascii[] = "/$\$__  $$  ";
                $ascii[] = "|__/  \\ $$  ";
                $ascii[] = "  /$$$$$/  ";
                $ascii[] = " |___  $$  ";        
                $ascii[] = "/$$  \\ $$  ";
                $ascii[] = "|  $$$$$$/  ";
                $ascii[] = "\\______/   ";
            }
            else if ($n == 3)
            {
                $ascii[] = "   /$$   /$$ ";
                $ascii[] = "  | $$  | $$ ";
                $ascii[] = "  | $$  | $$ ";
                $ascii[] = "  | $$$$$$$$ ";
                $ascii[] = "  |_____  $$ ";         
                $ascii[] = "        | $$ ";
                $ascii[] = "        | $$ ";
                $ascii[] = "        |__/ ";
            }
            else if ($n == 4)
            {
                $ascii[] = "     /$$$$$$$  ";
                $ascii[] = "    | $\$____/  ";
                $ascii[] = "    | $$       ";
                $ascii[] = "    | $$$$$$$  ";
                $ascii[] = "    |_____  $$ ";
                $ascii[] = "     /$$  \\ $$ ";         
                $ascii[] = "    |  $$$$$$/ ";
                $ascii[] = "     \\______/  ";
            }
            else if ($n == 5)
            {
                $ascii[] = "     /$$$$$$   ";
                $ascii[] = "    /$\$__  $$  ";
                $ascii[] = "   | $$  \\__/  ";
                $ascii[] = "   | $$$$$$$   ";           
                $ascii[] = "   | $\$__  $$  ";
                $ascii[] = "   | $$  \\ $$  ";
                $ascii[] = "   |  $$$$$$/  ";
                $ascii[] = "    \\______/   ";
            }
            else if ($n == 6)
            {
                $ascii[] = "   /$$$$$$$$ ";
                $ascii[] = "  |_____ $$/ ";
                $ascii[] = "       /$$/  ";
                $ascii[] = "      /$$/   ";
                $ascii[] = "     /$$/    ";
                $ascii[] = "    /$$/     ";           
                $ascii[] = "   /$$/      ";
                $ascii[] = "  |__/       ";
            }
            else if ($n == 7)
            {
                $ascii[] = "    /$$$$$$   ";
                $ascii[] = "   /$\$__  $$  ";
                $ascii[] = "  | $$  \\ $$  ";
                $ascii[] = "  |  $$$$$$/  ";        
                $ascii[] = "   >$\$__  $$  ";
                $ascii[] = "  | $$  \\ $$  ";
                $ascii[] = "  |  $$$$$$/  ";
                $ascii[] = "   \\______/   ";
            }
            else if ($n == 8)
            {
                $ascii[] = "    /$$$$$$   ";
                $ascii[] = "   /$\$__  $$  ";
                $ascii[] = "  | $$  \\ $$ ";
                $ascii[] = "  |  $$$$$$$  ";
                $ascii[] = "   \\____  $$ ";        
                $ascii[] = "   /$$  \\ $$ ";
                $ascii[] = "  |  $$$$$$/  ";
                $ascii[] = "   \\______/  ";
            }
            else if ($n == 9)
            {
                $ascii[] = "   /$$   /$$$ ";
                $ascii[] = "  /$$$  /$$ $$";
                $ascii[] = "  |_ $$ | $$ $$";
                $ascii[] = "   |$$ | $$\\$$";
                $ascii[] = "    |$$ | $$ $$";        
                $ascii[] = "    |$$ | $$ $$";
                $ascii[] = "  /$$$$|  $$$/";
                $ascii[] = "  !____/ \\___/ ";
            }
        }
            
                
        self::cout_ascii_charac_from_arr($width, $ascii, $col);    // Выводим ASCII-символы из массива
        
        
        $ascii = [];   //  обнуляем массив
    
    
    
        // Рисуем и подписываем клетку(и)
        //
        //
            
    //  ======.
    //  Важно!==.
    //  =======================================================
        $col = 6;                               // столбик   ==
    //  =======================================================
        
        // Выводим потолок клетки
        echo "                            ";
        for ($i = 0; $i < 14*$width; $i++)
            echo '_';
        echo "<br />";
        
        // Дорисовываем клетку и называем ее
        for ($tr = 0; $tr < $height; $tr++)       // печатает ряды
        {
            if ($tr == 0)
            {
                $ascii[] = "                 "; $ascii[] = "  /$$$$$$  "; 
                $ascii[] = "                 "; $ascii[] = " |____  $$ ";
                $ascii[] = "                 "; $ascii[] = "  /$$$$$$$ "; 
                $ascii[] = "                 "; $ascii[] = " /$\$__  $$ ";
                $ascii[] = "                 "; $ascii[] = "|  $$$$$$$ ";
                $ascii[] = "                 "; $ascii[] = " \\_______/ ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$  "; 
                //$ascii[] = "->"; $ascii[] = " |____  $$ ";
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = " /$\$__  $$ ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = " \\_______/ ";
            }
            else if ($tr == 1)
            {
                $ascii[] = "                 "; $ascii[] = " /$$       ";
                $ascii[] = "                 "; $ascii[] = "| $$       ";
                $ascii[] = "                 "; $ascii[] = "| $$$$$$$  ";     
                $ascii[] = "                 "; $ascii[] = "| $$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$$$$$$/ ";
                $ascii[] = "                 "; $ascii[] = "|_______/  ";
                
                //$ascii[] = "->"; $ascii[] = " /$$       ";
                //$ascii[] = "->"; $ascii[] = "| $$       ";
                //$ascii[] = "->"; $ascii[] = "| $$$$$$$  ";     
                //$ascii[] = "->"; $ascii[] = "| $$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$$$$$$/ ";
                //$ascii[] = "->"; $ascii[] = "|_______/  ";
            }
            else if ($tr == 2)
            {
                $ascii[] = "                 "; $ascii[] = "  /$$$$$$$ ";
                $ascii[] = "                 "; $ascii[] = " /$\$_____/ ";
                $ascii[] = "                 "; $ascii[] = "| $$       ";               
                $ascii[] = "                 "; $ascii[] = "| $$       ";
                $ascii[] = "                 "; $ascii[] = "|  $$$$$$$ ";
                $ascii[] = "                 "; $ascii[] = " \\_______/ ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = " /$\$_____/ ";
                //$ascii[] = "->"; $ascii[] = "| $$       ";               
                //$ascii[] = "->"; $ascii[] = "| $$       ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = " \\_______/ ";
            }
            else if ($tr == 3)
            {
                $ascii[] = "                  "; $ascii[] = "      /$$ ";
                $ascii[] = "                  "; $ascii[] = "     | $$ ";
                $ascii[] = "                  "; $ascii[] = " /$$$$$$$ ";
                $ascii[] = "                  "; $ascii[] = "|$$  | $$ ";
                $ascii[] = "                  "; $ascii[] = "| $$$$$$$ ";
                $ascii[] = "                  "; $ascii[] = "\\_______/ ";
                
                //$ascii[] = "->"; $ascii[] = "      /$$ ";
                //$ascii[] = "->"; $ascii[] = "     | $$ ";
                //$ascii[] = "->"; $ascii[] = " /$$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = "|$$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = "\\_______/ ";
            }
            else if ($tr == 4)
            {
                $ascii[] = "                 "; $ascii[] = "  /$$$$$$  ";
                $ascii[] = "                 "; $ascii[] = " /$\$__  $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$$$$$$$ ";
                $ascii[] = "                 "; $ascii[] = "| $\$_____/ ";         
                $ascii[] = "                 "; $ascii[] = "|  $$$$$$$ ";
                $ascii[] = "                 "; $ascii[] = " \\_______/ ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$  ";
                //$ascii[] = "->"; $ascii[] = " /$\$__  $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = "| $\$_____/ ";         
                //$ascii[] = "->"; $ascii[] = "|  $$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = " \\_______/ ";
            }
            else if ($tr == 5)
            {
                $ascii[] = "                  "; $ascii[] = "  /$$$$$  ";
                $ascii[] = "                  "; $ascii[] = " /$\$_ $$$ ";
                $ascii[] = "                  "; $ascii[] = "| $$  \\_/ ";            
                $ascii[] = "                  "; $ascii[] = "| $$$$    ";
                $ascii[] = "                  "; $ascii[] = "| $$      ";
                $ascii[] = "                  "; $ascii[] = "|__/      ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$  ";
                //$ascii[] = "->"; $ascii[] = " /$\$_ $$$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  \\_/ ";            
                //$ascii[] = "->"; $ascii[] = "| $$$$    ";
                //$ascii[] = "->"; $ascii[] = "| $$      ";
                //$ascii[] = "->"; $ascii[] = "|__/      ";
            }
            else if ($tr == 6)
            {
                $ascii[] = "                  "; $ascii[] = " /$$$$$$  ";
                $ascii[] = "                  "; $ascii[] = "|$$ |  $$ ";
                $ascii[] = "                  "; $ascii[] = " \\$$$$$$$ ";
                $ascii[] = "                  "; $ascii[] = "$$   \\ $$ ";
                $ascii[] = "                  "; $ascii[] = "|$$$$$$$/ ";
                $ascii[] = "                  "; $ascii[] = " \\______/ ";
                
                //$ascii[] = "->"; $ascii[] = " /$$$$$$  ";
                //$ascii[] = "->"; $ascii[] = "|$$ |  $$ ";
                //$ascii[] = "->"; $ascii[] = " \\$$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = "$$   \\ $$ ";
                //$ascii[] = "->"; $ascii[] = "|$$$$$$$/ ";
                //$ascii[] = "->"; $ascii[] = " \\______/ ";
            }
            else if ($tr == 7)
            {
                $ascii[] = "                 "; $ascii[] = " /$$       ";
                $ascii[] = "                 "; $ascii[] = "| $$       ";
                $ascii[] = "                 "; $ascii[] = "| $$$$$$$  ";
                $ascii[] = "                 "; $ascii[] = "| $\$__  $$ "; 
                $ascii[] = "                 "; $ascii[] = "| $$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "|__/  |__/ ";
                
                //$ascii[] = "->"; $ascii[] = " /$$       ";
                //$ascii[] = "->"; $ascii[] = "| $$       ";
                //$ascii[] = "->"; $ascii[] = "| $$$$$$$  ";
                //$ascii[] = "->"; $ascii[] = "| $\$__  $$ "; 
                //$ascii[] = "->"; $ascii[] = "| $$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "|__/  |__/ ";
            }
            else if ($tr == 8)
            {
                $ascii[] = "                       "; $ascii[] = " /$$ ";
                $ascii[] = "                       "; $ascii[] = "|__/ ";
                $ascii[] = "                       "; $ascii[] = " /$$ ";
                $ascii[] = "                       "; $ascii[] = "| $$ ";
                $ascii[] = "                       "; $ascii[] = "| $$ ";
                $ascii[] = "                       "; $ascii[] = "|__/ ";
                
                //$ascii[] = "->"; $ascii[] = " /$$ ";
                //$ascii[] = "->"; $ascii[] = "|__/ ";
                //$ascii[] = "->"; $ascii[] = " /$$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ ";
                //$ascii[] = "->"; $ascii[] = "|__/ ";
            }
            else if ($tr == 9)
            {
                $ascii[] = "                  "; $ascii[] = "      /$$ ";
                $ascii[] = "                  "; $ascii[] = "     |__/ ";
                $ascii[] = "                  "; $ascii[] = "      /$$ ";
                $ascii[] = "                  "; $ascii[] = " /$$ | $$ ";
                $ascii[] = "                  "; $ascii[] = "|  $$$$$/ ";
                $ascii[] = "                  "; $ascii[] = " \\______/ ";
                
                //$ascii[] = "->"; $ascii[] = "      /$$ ";
                //$ascii[] = "->"; $ascii[] = "     |__/ ";
                //$ascii[] = "->"; $ascii[] = "      /$$ ";
                //$ascii[] = "->"; $ascii[] = " /$$ | $$ ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$/ ";
                //$ascii[] = "->"; $ascii[] = " \\______/ ";
            }
            else if ($tr == 10)
            {
                $ascii[] = "                 "; $ascii[] = " /$$   /$$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  /$$/ ";
                $ascii[] = "                 "; $ascii[] = "| $$$$$$/  ";
                $ascii[] = "                 "; $ascii[] = "| $\$_  $$  ";
                $ascii[] = "                 "; $ascii[] = "| $$ \\  $$ ";
                $ascii[] = "                 "; $ascii[] = "|__/  \\__/ ";
                
                //$ascii[] = "->"; $ascii[] = " /$$   /$$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  /$$/ ";
                //$ascii[] = "->"; $ascii[] = "| $$$$$$/  ";
                //$ascii[] = "->"; $ascii[] = "| $\$_  $$  ";
                //$ascii[] = "->"; $ascii[] = "| $$ \\  $$ ";
                //$ascii[] = "->"; $ascii[] = "|__/  \\__/ ";
            }
            else if ($tr == 11)
            {
                 
                $ascii[] = "                       "; $ascii[] = " /$$ ";
                $ascii[] = "                       "; $ascii[] = "| $$ ";
                $ascii[] = "                       "; $ascii[] = "| $$ ";
                $ascii[] = "                       "; $ascii[] = "| $$ ";
                $ascii[] = "                       "; $ascii[] = "| $$ ";
                $ascii[] = "                       "; $ascii[] = "|__/ ";
                
                //$ascii[] = "->"; $ascii[] = " /$$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ ";
                //$ascii[] = "->"; $ascii[] = "|__/ ";
            }
            else if ($tr == 12)
            {
                $ascii[] = "             "; $ascii[] = " /$$$$$$/$$$$  ";
                $ascii[] = "             "; $ascii[] = "| $\$_  $\$_  $$ ";
                $ascii[] = "             "; $ascii[] = "| $$ \\ $$ \\ $$ ";
                $ascii[] = "             "; $ascii[] = "| $$ | $$ | $$ "; 
                $ascii[] = "             "; $ascii[] = "| $$ | $$ | $$ ";
                $ascii[] = "             "; $ascii[] = "|__/ |__/ |__/ ";
                
                //$ascii[] = "->"; $ascii[] = " /$$$$$$/$$$$  ";
                //$ascii[] = "->"; $ascii[] = "| $\$_  $\$_  $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ \\ $$ \\ $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ | $$ | $$ "; 
                //$ascii[] = "->"; $ascii[] = "| $$ | $$ | $$ ";
                //$ascii[] = "->"; $ascii[] = "|__/ |__/ |__/ ";
            }
            else if ($tr == 13)
            {
                $ascii[] = "                 "; $ascii[] = " /$$$$$$$  ";
                $ascii[] = "                 "; $ascii[] = "| $\$__  $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  \\ $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "|__/  |__/ ";
                
                //$ascii[] = "->"; $ascii[] = " /$$$$$$$  ";
                //$ascii[] = "->"; $ascii[] = "| $\$__  $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  \\ $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "|__/  |__/ ";
            }
            else if ($tr == 14)
            {
                $ascii[] = "                 "; $ascii[] = "  /$$$$$$  ";
                $ascii[] = "                 "; $ascii[] = " /$\$__  $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  \\ $$ "; 
                $ascii[] = "                 "; $ascii[] = "| $$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "|  $$$$$$/ ";
                $ascii[] = "                 "; $ascii[] = " \\______/  ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$  ";
                //$ascii[] = "->"; $ascii[] = " /$\$__  $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  \\ $$ "; 
                //$ascii[] = "->"; $ascii[] = "| $$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$$/ ";
                //$ascii[] = "->"; $ascii[] = " \\______/  ";
            }
            else if ($tr == 15)
            {
                $ascii[] = "                 "; $ascii[] = "  /$$$$$$  ";
                $ascii[] = "                 "; $ascii[] = " /$$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$$$$$$/ ";
                $ascii[] = "                 "; $ascii[] = "| $\$____/  ";
                $ascii[] = "                 "; $ascii[] = "| $$       ";
                $ascii[] = "                 "; $ascii[] = "|__/       ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$  ";
                //$ascii[] = "->"; $ascii[] = " /$$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$$$$$$/ ";
                //$ascii[] = "->"; $ascii[] = "| $\$____/  ";
                //$ascii[] = "->"; $ascii[] = "| $$       ";
                //$ascii[] = "->"; $ascii[] = "|__/       ";
            }
            else if ($tr == 16)
            {
                $ascii[] = "                 "; $ascii[] = "  /$$$$$$  ";
                $ascii[] = "                 "; $ascii[] = " /$$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "|  $$$$$$$ "; 
                $ascii[] = "                 "; $ascii[] = " \\____  $$ ";
                $ascii[] = "                 "; $ascii[] = "      | $$ ";
                $ascii[] = "                 "; $ascii[] = "      |__/ ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$  ";
                //$ascii[] = "->"; $ascii[] = " /$$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$$$ "; 
                //$ascii[] = "->"; $ascii[] = " \\____  $$ ";
                //$ascii[] = "->"; $ascii[] = "      | $$ ";
                //$ascii[] = "->"; $ascii[] = "      |__/ ";
            }
            else if ($tr == 17)
            {
                $ascii[] = "                 "; $ascii[] = "  /$$$$$$  ";
                $ascii[] = "                 "; $ascii[] = " /$\$__  $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  \\__/ ";     
                $ascii[] = "                 "; $ascii[] = "| $$       ";
                $ascii[] = "                 "; $ascii[] = "| $$       ";
                $ascii[] = "                 "; $ascii[] = "|__/       ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$  ";
                //$ascii[] = "->"; $ascii[] = " /$\$__  $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  \\__/ ";     
                //$ascii[] = "->"; $ascii[] = "| $$       ";
                //$ascii[] = "->"; $ascii[] = "| $$       ";
                //$ascii[] = "->"; $ascii[] = "|__/       ";
            }
            else if ($tr == 18)
            {
                $ascii[] = "                 "; $ascii[] = "  /$$$$$$$ ";
                $ascii[] = "                 "; $ascii[] = " /$\$_____/ ";
                $ascii[] = "                 "; $ascii[] = "|  $$$$$$  ";       
                $ascii[] = "                 "; $ascii[] = " \\____  $$ ";
                $ascii[] = "                 "; $ascii[] = " /$$$$$$$/ ";
                $ascii[] = "                 "; $ascii[] = "|_______/  ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = " /$\$_____/ ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$$  ";       
                //$ascii[] = "->"; $ascii[] = " \\____  $$ ";
                //$ascii[] = "->"; $ascii[] = " /$$$$$$$/ ";
                //$ascii[] = "->"; $ascii[] = "|_______/  ";
            }
            else if ($tr == 19)
            {
                $ascii[] = "                 "; $ascii[] = "  /$$      ";
                $ascii[] = "                 "; $ascii[] = " /$$$$$$   ";
                $ascii[] = "                 "; $ascii[] = "|_  $\$_/   ";     
                $ascii[] = "                 "; $ascii[] = "  | $$ /$$ ";
                $ascii[] = "                 "; $ascii[] = "  |  $$$$/ ";
                $ascii[] = "                 "; $ascii[] = "   \\____/  ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$      ";
                //$ascii[] = "->"; $ascii[] = " /$$$$$$   ";
                //$ascii[] = "->"; $ascii[] = "|_  $\$_/   ";     
                //$ascii[] = "->"; $ascii[] = "  | $$ /$$ ";
                //$ascii[] = "->"; $ascii[] = "  |  $$$$/ ";
                //$ascii[] = "->"; $ascii[] = "   \\____/  ";
            }
            else if ($tr == 20)
            {
                $ascii[] = "                 "; $ascii[] = " /$$   /$$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "|  $$$$$$/ ";
                $ascii[] = "                 "; $ascii[] = " \\______/  ";
                
                //$ascii[] = "->"; $ascii[] = " /$$   /$$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$$/ ";
                //$ascii[] = "->"; $ascii[] = " \\______/  ";
            }
            else if ($tr == 21)
            {
                $ascii[] = "                "; $ascii[] = " /$$    /$$ ";
                $ascii[] = "                "; $ascii[] = "|  $$  /$$/ ";
                $ascii[] = "                "; $ascii[] = " \\  $$/$$/  ";
                $ascii[] = "                "; $ascii[] = "  \\  $$$/   ";     
                $ascii[] = "                "; $ascii[] = "   \\  $/    ";
                $ascii[] = "                "; $ascii[] = "    \\_/     ";
                
                //$ascii[] = "->"; $ascii[] = " /$$    /$$ ";
                //$ascii[] = "->"; $ascii[] = $$  /$$/ ";
                //$ascii[] = "->"; $ascii[] = " \\  $$/$$/  ";
                //$ascii[] = "->"; $ascii[] = "  \\  $$$/   ";     
                //$ascii[] = "->"; $ascii[] = "   \\  $/    ";
                //$ascii[] = "->"; $ascii[] = "    \\_/     ";
            }
            else if ($tr == 22)
            {
                $ascii[] = "             "; $ascii[] = " /$$  /$$  /$$ ";
                $ascii[] = "             "; $ascii[] = "| $$ | $$ | $$ ";
                $ascii[] = "             "; $ascii[] = "| $$ | $$ | $$ ";  
                $ascii[] = "             "; $ascii[] = "| $$ | $$ | $$ ";
                $ascii[] = "             "; $ascii[] = "|  $$$$$/$$$$/ ";
                $ascii[] = "             "; $ascii[] = " \\_____/\\___/  ";
                
                //$ascii[] = "->"; $ascii[] = " /$$  /$$  /$$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ | $$ | $$ ";
                //$ascii[] = "->"; $ascii[] = "| $$ | $$ | $$ ";  
                //$ascii[] = "->"; $ascii[] = "| $$ | $$ | $$ ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$/$$$$/ ";
                //$ascii[] = "->"; $ascii[] = " \\_____/\\___/  ";
            }
            else if ($tr == 23)
            {
                $ascii[] = "                 "; $ascii[] = " /$$   /$$ ";
                $ascii[] = "                 "; $ascii[] = "|  $$ /$$/ ";
                $ascii[] = "                 "; $ascii[] = " \\  $$$$/  "; 
                $ascii[] = "                 "; $ascii[] = "  >$$  $$  ";
                $ascii[] = "                 "; $ascii[] = " /$$/\\  $$ ";
                $ascii[] = "                 "; $ascii[] = "|__/  \\__/ ";
                
                //$ascii[] = "->"; $ascii[] = " /$$   /$$ ";
                //$ascii[] = "->"; $ascii[] = "|  $$ /$$/ ";
                //$ascii[] = "->"; $ascii[] = " \\  $$$$/  "; 
                //$ascii[] = "->"; $ascii[] = "  >$$  $$  ";
                //$ascii[] = "->"; $ascii[] = " /$$/\\  $$ ";
                //$ascii[] = "->"; $ascii[] = "|__/  \\__/ ";
            }
            else if ($tr == 24)
            {
                $ascii[] = "                 "; $ascii[] = " /$$   /$$ ";
                $ascii[] = "                 "; $ascii[] = "| $$  | $$ ";
                $ascii[] = "                 "; $ascii[] = "|  $$$$$$$ ";  
                $ascii[] = "                 "; $ascii[] = " \\____  $$ ";
                $ascii[] = "                 "; $ascii[] = "|  $$$$$$/ ";
                $ascii[] = "                 "; $ascii[] = " \\______/  ";
                
                //$ascii[] = "->"; $ascii[] = " /$$   /$$ ";
                //$ascii[] = "->"; $ascii[] = "| $$  | $$ ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$$$ ";  
                //$ascii[] = "->"; $ascii[] = " \\____  $$ ";
                //$ascii[] = "->"; $ascii[] = "|  $$$$$$/ ";
                //$ascii[] = "->"; $ascii[] = " \\______/  ";
            }
            else if ($tr == 25)
            {
                $ascii[] = "                "; $ascii[] = "  /$$$$$$$$ ";
                $ascii[] = "                "; $ascii[] = " |____ /$$/ ";
                $ascii[] = "                "; $ascii[] = "   /$$$$/   ";
                $ascii[] = "                "; $ascii[] = "  /$\$__/    ";
                $ascii[] = "                "; $ascii[] = " /$$$$$$$$  ";
                $ascii[] = "                "; $ascii[] = "|________/  ";
                
                //$ascii[] = "->"; $ascii[] = "  /$$$$$$$$ ";
                //$ascii[] = "->"; $ascii[] = " |____ /$$/ ";
                //$ascii[] = "->"; $ascii[] = "   /$$$$/   ";
                //$ascii[] = "->"; $ascii[] = "  /$\$__/    ";
                //$ascii[] = "->"; $ascii[] = " /$$$$$$$$  ";
                //$ascii[] = "->"; $ascii[] = "|________/  ";
            }
            
            for ($tr2 = 0; $tr2 < $col; $tr2++)           // печатает строки
            {
                for ($td = 0; $td < $width; $td++)        // печатает столбы
                {
                    $ascii[] = "|";
                    if ($tr2 != $col-1)
                    {
                        # Позиции названные ПК 
                        if (self::PK_and_user_ps($ps, $td, $tr))
                        {
                                $ascii[] = "#############";
                        }
                        # Закрашиваем синим цветом раставленные корабли или нет
                        else if (self::pos_of_ships_battlefield($ps_ships, $td, $tr) && $hidden)
                        {
                            $ascii[] = "<span style='color: #00FFFF; background-color: #4682B4;'>.............</span>";
                        }
                        # Закрашивает подбитую часть корабля в красный цвет
                        else if (self::pos_of_wrecked_ships_battlefield($ships_destr, $td, $tr))
                        {
                            $ascii[] = "<span style='color: #FF0000; background-color: #FF6347;'>.............</span>";
                        }
                        # Закрашиваем серым цветом полностью потонувший корабль
                        else if (self::pos_of_wrecked_ships_battlefield($ships_destr, $td, $tr, true))
                        {
                            $ascii[] = "<span style='color: #696969; background-color: #696969;'>.............</span>";
                        }
                        else
                            $ascii[] = "             ";
                        //$ascii[] = "*";
                        if ($td == $width-1)
                            $ascii[] = "|<br />";
                    }
                    else 
                    {
                        $ascii[] = "_____________";
                        if ($td == $width-1)
                            $ascii[] = "|";
                    }
                }
                
                if ($tr2 == $col-1)
                    $ascii[] = "<br />";   // <br />
            }
        }
        
        
        
        //echo "count(\$ascii) = ".count($ascii)."<br />";
        //
        //for ($i = 0; $i < count($ascii); $i++)
        //{
        //    echo $ascii[$i];
        //    if ($i != count($ascii)-1)
        //        echo ", ";
        //}
        //
        //echo "<br />";
        
        
        // Выводим ASCII-символы из массива
        $count        = 0;                          // счетчик
        $width_check  = 0;
        $height_check = 0;
        for ($tr = 0; $tr < $height; $tr++)           // печатает клеточные-строки
        {
            for ($td = 0; $td < $col; $td++)          // печатает столбы
            {
                for ($i2 = 0; $i2 < $width; $i2++)
                {
                    $width_check  = 2*$i2;
                    $height_check = 12*$i2*$tr;
                }
                
                self::outputs_signed_cells($td, $ascii, $col, $count, $width_check, (31*$tr)+$height_check);  
                
                $count += $width_check+3;
                
                if ($td >= $col-1)
                    $count = 0;       // обнуляем счетчик
            }
        }
        
        
           /*
            *
            * Цель:
                                     /$$         /$$$$$$       /$$$$$$     /$$   /$$$
                                   /$$$$        /$$__  $$     /$$__  $$   /$$$  /$$ $$
                                  |_  $$       |__/  \ $$    |__/  \ $$  |_ $$ | $$ $$
                                    | $$         /$$$$$$/       /$$$$$/    |$$ | $$\$$
                                    | $$        /$$____/       |___  $$    |$$ | $$ $$
                                    | $$       | $$           /$$  \ $$    |$$ | $$ $$
                                   /$$$$$$     | $$$$$$$$    |  $$$$$$/   /$$$$|  $$$/
                                  |______/     |________/     \______/   !____/ \___/            
                               ________________________________________________________
                      /$$$$$$ |             |             |             |             |
                     |___  $$ |             |             |             |             |
                     /$$$$$$$ |             |             |             |             |
                    /$$__  $$ |             |             |             |             |
                   |  $$$$$$$ |             |             |             |             |
                    \_______/ |_____________|_____________|_____________|_____________| 
                          /$$ |             |             |             |
                         | $$ |             |             |             |
                     /$$$$$$$ |             |             |             |
                    |$$  | $$ |             |             |             |
                    |$$$$$$$$ |             |             |             |
                    \______/  |_____________|_____________|_____________|
                              |             |             |             |
                     /$$$$$$$ |             |             |             |
                    /$$_____/ |             |             |             |
                   | $$       |             |             |             |
                   |  $$$$$$$ |             |             |             |
                    \_______/ |_____________|_____________|_____________|
           
           
           */
        
    }
    
    
    # Выводим ASCII-символы из массив
    private static function cout_ascii_charac_from_arr($width, $ascii, $col)
    {
        for ($i = 0; $i < (count($ascii) / $width); $i++)
        {
            for ($k = 0; $k < $width; $k++)
            {
                echo $ascii[($col*$k)+$i];
            }
            
            echo "<br />";
        }
    }
    
    
    # Выводит подписанные клетки поля по вертикали
    private static function outputs_signed_cells($r, $ascii, $col, $count, $width, $key)
    {
        echo $ascii[$r*2+$key].$ascii[$r*2+$key+1];
    
        for ($v = 0; $v < 3+$width; $v++)  
        {
            if ($r < $col-1)
                echo $ascii[$col*2+$key+$count+$v];
            else if ($r == $col-1)
            {
                echo $ascii[$col*2+$key+$count+$v];
                if ($v == 3+$width-1)
                    echo $ascii[$col*2+$key+$count+$v+1];
            }
        }
    }
    
    
    # Позиции названные ПК / user
    private static function PK_and_user_ps($ps, $td, $tr) 
    {
        if ($ps != null)
        {
            foreach ($ps as $v)
            {
                if ($td === $v[1] && $tr === $v[2])
                {
                    return true;
                }
            }
            
            return false;
        }
    }
    
    
    # Позиции кораблей на поле-боя
    private static function pos_of_ships_battlefield($ps_ships, $td, $tr)
    {
        if ($ps_ships != null)
        {
            foreach ($ps_ships as $arr)
            {
                foreach ($arr as $v)
                {
                    if ($td === $v[1] && $tr === $v[2])
                    {
                        return true;
                    }
                }
            }
            
            return false;
        }
    }
    
    
    # Позиции подбитых/затонувших кораблей поле боя
    private static function pos_of_wrecked_ships_battlefield($ships_destr, $td, $tr, $killed = false)
    {
        if ($ships_destr != null)
        {
            foreach ($ships_destr as $arr)
            {
                if (self::was_the_ship_sunk($arr, $killed))
                {
                    foreach ($arr as $v)
                    {
                        if ($v[0] == null && $td === $v[1] && $tr === $v[2])
                        {
                            return true;
                        }
                    }
                }
            }
            
            return false;
        }
    }
    
    
    # Проверяем - был ли корабль уничтожен
    private static function was_the_ship_sunk($elems, $kelled)
    {
        $count = 0;         // счетчик
        for ($i = 0; $i < count($elems); $i++)
        {
            if ($elems[$i][0] == null)
            {
                $count++;
            }
        }
        
        // корабль был полностью уничтожен
        if (count($elems) == $count)
        {
            return $kelled ? true :false;
        }
        // какие-то части корабля еще целы
        else
        {
            return true;
        }
    }
}
?>
