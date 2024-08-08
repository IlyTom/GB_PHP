<?php
//1 задание
function calculate($num1, $num2, $operation)
{
    switch ($operation) {
        case 'add':
            return $num1 + $num2;
        case 'subtract':
            return $num1 - $num2;
        case 'multiply':
            return $num1 * $num2;
        case 'divide':
            return $num2 != 0 ? $num1 / $num2 : 'Division by zero';
        default:
            return 'Invalid operation';
    }
}
//2 задание
function mathOperation($arg1, $arg2, $operation) {  
    return calculate($arg1, $arg2, $operation);  
}  
//3 задание
$regions = [  
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],  
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],  
    'Рязанская область' => ['Рязань', 'Скопин', 'Рыбинск']  
];  

foreach ($regions as $region => $cities) {  
    echo $region . ': ' . implode(', ', $cities) . PHP_EOL;  
}
//4 задание
$translitMap = [  
    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',  
    'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',  
    'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',  
    'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',  
    'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch',  
    'ш' => 'sh', 'щ' => 'shch', 'ъ' => '', 'ы' => 'y', 'ь' => '',  
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya'  
];  

function transliterate($string) {  
    global $translitMap;  
    return strtr($string, $translitMap);  
}

//5 задание

function power($val, $pow) {  
    if ($pow == 0) {  
        return 1;  
    } elseif ($pow < 0) {  
        return 1 / power($val, -$pow);  
    } else {  
        return $val * power($val, $pow - 1);  
    }  
}

//6 задание

function getCurrentTimeWithDeclension(string $timezone = 'UTC'): string {  
    // Устанавливаем временную зону  
    date_default_timezone_set($timezone);  
    
    // Получаем текущее время  
    $currentHour = (int)date('H');  
    $currentMinute = (int)date('i');  

    // Склонения для часов  
    $hourDeclensions = ['час', 'часа', 'часов'];  
    // Склонения для минут  
    $minuteDeclensions = ['минута', 'минуты', 'минут'];  

    // Функция для определения правильного склонения  
    function declension(int $number, array $declensions): string {  
        if ($number % 10 == 1 && $number % 100 != 11) {  
            return $declensions[0]; // час, минута  
        } elseif ($number % 10 >= 2 && $number % 10 <= 4 && ($number % 100 < 10 || $number % 100 >= 20)) {  
            return $declensions[1]; // часа, минуты  
        } else {  
            return $declensions[2]; // часов, минут  
        }  
    }  

    // Получаем правильные склонения  
    $hourWord = declension($currentHour, $hourDeclensions);  
    $minuteWord = declension($currentMinute, $minuteDeclensions);  

    // Формируем строку с текущим временем  
    return "{$currentHour} {$hourWord} {$currentMinute} {$minuteWord}";  
}  

// Пример использования с UTC+0  
echo getCurrentTimeWithDeclension('Europe/Moscow'); 
