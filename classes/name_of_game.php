<?php ## Название игры
class Name_of_game
{
    private static $title = ["S", "e", "a", "B", "a", "t", "t2", "l", "e", ">"];  // Название
    private static $ascii;                                                        // ASCII-буквы
    
//  ======.
//  Важно!==.
//  =======================================================
    private static $col   = 9;              // столбик   ==
    private static $font  = 1;              // шрифт     ==
//  =======================================================

    
    # Выводит название игры
    public static function result()
    {
        self::frame(95, '=', 1);
            
        for($i = 0; $i < count(self::$title); $i++)
        {
            switch (self::$font)
            {
                case 1:
                {
                    if (self::$title[$i] == "S")
                    {
                        self::$ascii[] = "                                 == =======================";
                        self::$ascii[] = "                                 == ==`          /$$$$$$ ";
                        self::$ascii[] = "                                 ==  ==`        /$\$__  $$";
                        self::$ascii[] = "                                 ==   ==`      | $$  \\__/";
                        self::$ascii[] = "                                 ==    ==`     |  $$$$$$ ";
                        self::$ascii[] = "                                 ==     ==`     \\____  $$";
                        self::$ascii[] = "                                 ==      ==`    /$$  \\ $$";
                        self::$ascii[] = "                                 ==       ==`  |  $$$$$$/";
                        self::$ascii[] = "                                 ==        ==`  \\______/ ";
                        
                    }
                    else if (self::$title[$i] == "e")
                    {
                        self::$ascii[] = "==========";
                        self::$ascii[] = "          ";
                        self::$ascii[] = "          ";
                        self::$ascii[] = "  /$$$$$$ ";
                        self::$ascii[] = " /$\$__  $$";
                        self::$ascii[] = "| $$$$$$$$";
                        self::$ascii[] = "| $\$_____/";
                        self::$ascii[] = "|  $$$$$$$";
                        self::$ascii[] = " \\_______/";
                    }
                    else if (self::$title[$i] == "a")
                    {
                        self::$ascii[] = "==========";
                        self::$ascii[] = "          ";
                        self::$ascii[] = "          ";
                        self::$ascii[] = "  /$$$$$$ ";
                        self::$ascii[] = " |____  $$";
                        self::$ascii[] = "  /$$$$$$$";
                        self::$ascii[] = " /$\$__  $$";
                        self::$ascii[] = "|  $$$$$$$";
                        self::$ascii[] = " \\_______/";
                    }
                    else if (self::$title[$i] == "B")
                    {
                        self::$ascii[] = "==========";
                        self::$ascii[] = " /$$$$$$$ ";
                        self::$ascii[] = "| $\$__  $$";
                        self::$ascii[] = "| $$  \\ $$";
                        self::$ascii[] = "| $$$$$$$ ";
                        self::$ascii[] = "| $\$__  $$";
                        self::$ascii[] = "| $$  \\ $$";
                        self::$ascii[] = "| $$$$$$$/";
                        self::$ascii[] = "|_______/ ";
                    }
                    else if (self::$title[$i] == "t")
                    {
                        self::$ascii[] = "========";
                        self::$ascii[] = "   /$$  ";
                        self::$ascii[] = "  | $$  ";
                        self::$ascii[] = " /$$$$$$";
                        self::$ascii[] = "|_  $\$_/";
                        self::$ascii[] = "  | $$   ";
                        self::$ascii[] = "  | $$ /$$";
                        self::$ascii[] = "  |  $$$$/";
                        self::$ascii[] = "   \\___/  ";
                    }
                    else if (self::$title[$i] == "t2")
                    {
                        self::$ascii[] = "==========";
                        self::$ascii[] = "   /$$    ";
                        self::$ascii[] = "  | $$    ";
                        self::$ascii[] = " /$$$$$$  ";
                        self::$ascii[] = "|_  $\$_/  ";
                        self::$ascii[] = " | $$    ";
                        self::$ascii[] = "| $$ /$$";
                        self::$ascii[] = "|  $$$$/";
                        self::$ascii[] = " \\___/  ";
                    }
                    else if (self::$title[$i] == "l")
                    {
                        self::$ascii[] = "====";
                        self::$ascii[] = " /$$";
                        self::$ascii[] = "| $$";
                        self::$ascii[] = "| $$";
                        self::$ascii[] = "| $$";
                        self::$ascii[] = "| $$";
                        self::$ascii[] = "| $$";
                        self::$ascii[] = "| $$";
                        self::$ascii[] = "|__/";
                    }
                    else if (self::$title[$i] == ">")
                    {
                        self::$ascii[] = " ";
                        self::$ascii[] = "==`";
                        self::$ascii[] = " ==`";
                        self::$ascii[] = "  ==`";
                        self::$ascii[] = "   ==`";
                        self::$ascii[] = "    ==`";
                        self::$ascii[] = "     ==`";
                        self::$ascii[] = "      ==`";
                        self::$ascii[] = "       ==`";
                    }
                }
            }
        }
        
        self::cout_ascii_charac_from_arr(count(self::$title), self::$ascii, self::$col);    // Выводим ASCII-символы из вектор
        
        self::frame(94, '=', 2);
        self::frame(92, '=', 3);
        
    }
    
    
    # Рамка из символов
    private static function frame($n, $ch, $line = 0)
    {
        if ($line != 1) echo "                                 ";
        if ($line == 1) echo "                                   ";
        
        switch ($line)
        {
            case 2: echo "== ======= " ; break;
            case 3: echo "== ======== "; break;
        }   
        
        for ($i = 0; $i < $n; $i++)
            echo $ch;
        
        echo "<br />";
    }
    
    
    # Выводим ASCII-символы из вектор
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
}
?>
