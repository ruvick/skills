php код  должен быть заключен в конструкцию такого вида <?php ?>
Сокращенный вариант выглядит так <? ?>

И если php-код идет до конца файла, его можно не закрывать

<? 
Начало файла


конец файла 
?>

Спомощью команды echo можно выводить информацию.
Выведем надпись.

Спомощью echo можно выводить не только текст, но и например теги.
Выведем три заголовка.
И в браузере все наши 3 заголовка отобразяться корректно.

<?
	echo "<h2>Привет, PHP</h2>";
	echo "<h3>Курс по PHP</h3>";
	echo "<h4>Быстрый курс по РHP</h4>";
?>


<!-- ПЕРЕМЕННЫЕ И СИНТАКСИС ================================================================================================-->

Переменные, это как коробка с содержимым, специи, соль и т.д.  
Переменные позволяют, хранить, создавать, изменять и обращаться к информации которая в них записанна. 

Создадим переменную, которую назовем test и запишем туда текст.

Создание переменной, пример.
Ставим знак доллара, потом пишем имя переменной test, пишем знак присваивания = и в кавычках текст котрой мы хотим присвоить нашей переменной test.
Если мы не поставим точку с запятой; то в браузере вместо текста, получим синтаксическую ошибку.

<?php 
$test = "Текст переменной";
Порместим нашу переменную test в одинарные кавычки. И в браузере мы увидим следующую запись  $test.В итоге вывелось не ее значение а ее имя.
echo 'test';

А если мы поменяем одинарные кавычки на двойные, то мы увидим запись, текст, то есть значение из переменной. 
В php есть принципиальная разница при выводе информации с использование двойных и одинарных кавычек.
echo "test";

Мы создали переменную и задали ей значение с конкретным текстом $test = "Текст переменной";
И далее в файле мы можем выводить эту переменную короткой записью echo "test";

// Коментарии
?>;

Названия переменных не должны начинаться с цифр.
Такие переменные создать нельзя:
$1sadisd;
$1221;

Но мы можем использовать цифры, вторым, третьим и последующими символами.
$abc1adc2;

Так же нельзя использовать слеши и другие дополнительные символы, кроме нижнего подчеркивания.
$/adc; - нельзя
$_abc; - можно

Так же нельзя использовать пробелы и нерекомендуется использовать кириллицу.
Регистр так же имеет значение. С большой и маленькой буквы это две разные переменные.
Хорошим тоном считается называть все переменные с маленькой буквы.

Переменная из двух слов писать следует следующим образом $sweetApples; - Это называется Camel Case, верблюжий стиль.
Первое слово пишется с маленькой буквы, второе с заглавной.


<!-- ТИПЫ ДАННЫХ ========================================================================================================================== -->

В php все типы данных можно разделить на две условные категории - простые и сложные.

Одно из протсых типов данных это строка string, то есть текстовая информация. 
Создадим переменную со строкой. 
$text = "Я строка";

Теперь с помощью команды echo и методу get_type выведем тип данных этой переменной на экран.
<?php
$text = "Я строка";
echo gettype($text); И в браузере увидим string - строка.

Создадим переменную которую назовем number.
$number = 123;
echo gettype($number); - И в браузере увидим надпись integer - число, тип данных число. Тип данных целого числа.

Если же мы запишем дробное число, то есть через точку, то мы запишем другой тип данных.

$num = 123.11;
echo gettype($num); И в браузере увидим тип данных double. Тип данных дробного чисола.

Булевый тип данных, выражает истинные значения. и может быть либо правдой либо ложью. Либо true либо false.

$bool = true;
echo gettype($bool); И получим в браузере boolean. Булев тип данных.

Ложью, то есть false будут считать переменные, которым не присвоенны значения, которым присвоен ноль, пустая строка, или пустой массив.
Что понять является та или иная переменная истинной или ложью, можно использовать такое выражение.
Проверку на булевый тип.
var_dump((bool) $text); И в браузере увидим запись bool(true). То есть наша переменная именем текст, является истинной.

NULL - означает что переменной не присвоенно никакое значение.

Тип данных ресурс, который представляет собой ссылку на внешний источник. Например соединение с базой данных.