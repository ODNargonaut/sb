<?php
require_once "view/view.php";               # HTML-страница
require_once "classes/name_of_game.php";    # Выводит название игры

View::head();
echo "<pre>";

// кнопка больше не нужна
if (!isset($_REQUEST['play']))
{
   ?>
   <form action='index.php' method='POST'> 
      <input class='btn' type='submit' name='play' value='Начать' />
   </form>
   <?php
}
else
{
   Name_of_game::result();
    ?>
         <form action='view/html/view_html.php' method='POST' style='position: absolute; margin-left: -80px;'>
             <style>
             .btn
             {
                 border: none;
                 background-color: black;
                 color: white;
                 cursor: pointer;
             }
                     
             .btn:hover
             {
                 color: red;
             }
             </style>
             <input class='btn' type='submit' value='0' name='response' />: Начать игру
             <input class='btn' type='submit' value='1' name='response' />: Инструкция
             <input class='btn' type='submit' value='2' name='response' />: Рекорды
             <input class='btn' type='submit' value='3' name='response' />: Выход
         </form>
    <?php
}
 
echo "</pre>";
View::end_body();
?>