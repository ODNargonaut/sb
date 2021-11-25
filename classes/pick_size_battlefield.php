<?php
# Класс позволяет задать размер поля-боя
#

require_once "verification_transmitted_data.php";  # Проверяет вводмые данные

class Pick_size_battlefield
{
    public static function sise_field()
    {
        if (!isset($_SESSION['field']))
            $_SESSION['field'] = [];
        
        $wh = '';    // Хранит заданную ширину/высоту поля-боя
        
        echo "============================<br />";
        echo "                  \\   |   ==<br />"
             ."                   | 3x3  ==<br />"
             ."Доступные поля-боя | 4x4  ==<br />"
             ."                   | 5x5  ==<br />"
             ."                   | 6x6  ==<br />"
             ."                   | 7x7  ==<br />";
        echo "                  /   |   ==<br />";
        echo "============================ <br /><br />";
        echo "Выберите доступное поле (Пример, 3x3\\r): ";
        ?>
        <style>
            .btn_s
            {
                border: none;
                background-color: black;
                color: white;
                position: absolute;
                margin-left: 230px;
                margin-top: -47px;
                font-size: 102%;
    
                /* убираем обводку */
                outline:none;
            }
        </style>
        <form action='' method='POST'>
            <input class='btn_s' type='text' name='size' maxlength="3" />
        </form>
        <?php
        if (!empty($_REQUEST['size']))
        {
            $wh = explode('x', trim(htmlspecialchars($_REQUEST['size'])));
            
            $VT_data = new Verification_transmitted_data;
            if ($VT_data->check_size_battlefield($wh[0], $wh[1]))
            {
                // сохраняем ширину и высоту
                $_SESSION['field']['width']  = $wh[0];
                $_SESSION['field']['height'] = $wh[1];
            }
            else
            {
                echo "<span style='position: absolute;
                                   margin-left: 350px;
                                   margin-top: -92px;
                                   color: #FF4500;'>".$VT_data->WARNING_SIZE_BATTLEFIELD."</span>";
            }
        }
    }
}
?>
