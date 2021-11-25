<?php
# Выводит нужный шаблон страницы
#
#

class View
{
    # Шапка/тело сайта
    public static function head($style = null)
    {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset='utf-8'>
                <link rel="stylesheet" type="text/css" href="<?php echo $style; ?>">
                <title>Sea Battle</title>
                <style>
                    .btn
                    {
                        cursor: pointer;
                    }
                </style>
            </head>
            <body style='background-color: black; color: white;'>
        <?php
    }
    
    
    # Конец тела
    public static function end_body()
    {
        ?>
            </body>
        </html>
        <?php
    }
    
    
    # Сообщение перед выходом
    public static function message_before_exit()
    {
        ?>
        <br /><br />Обещай, что скоро вернешься!<br />P.S. Я с удовольствием сыграю с тобой ещё;<br /><br />
        <form action='/' method='POST'> 
            <input class='btn' type='submit' name='play' value='Начать' />
        </form>
        <?php
    }
}
?>
