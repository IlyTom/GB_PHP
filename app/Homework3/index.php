<?php
//1. Обработка ошибок
//Перед тем как записывать данные в файл, следует валидировать ввод. Например, проверим корректность даты и другие потенциально некорректные данные.

function isValidDate($date) {  
    $d = DateTime::createFromFormat('d-m-Y', $date);  
    return $d && $d->format('d-m-Y') === $date;  
}  

function writeData($name, $date) {  
    if (empty($name)) {  
        throw new Exception("Имя не может быть пустым.");  
    }  

    if (!isValidDate($date)) {  
        throw new Exception("Неверный формат даты. Используйте 'дд-мм-гггг'.");  
    }  

    $data = "$name, $date\n";  
    file_put_contents('birthdays.txt', $data, FILE_APPEND);  
}  

//2. Поиск по файлу
//Функция, которая будет искать пользователей по дате, будет выглядеть так:
function findBirthdayToday() {  
    $today = date('d-m');  
    $file = fopen('birthdays.txt', 'r');  
    if ($file) {  
        while (($line = fgets($file)) !== false) {  
            list($name, $date) = explode(', ', trim($line));  
            if (substr($date, 0, 5) == $today) {  
                echo "Сегодня день рождения у: $name\n";  
            }  
        }  
        fclose($file);  
    } else {  
        echo "Не удалось открыть файл для чтения.\n";  
    }  

//3. Удаление строки
//Создадим функцию для удаления пользователей по имени или дате.

function deleteEntry($searchTerm) {  
    $fileName = 'birthdays.txt';  
    $lines = file($fileName);  
    $found = false;  

    foreach ($lines as $key => $line) {  
        if (strpos($line, $searchTerm) !== false) {  
            unset($lines[$key]);  
            $found = true;  
            break;  
        }  
    }  

    if ($found) {  
        file_put_contents($fileName, implode('', $lines));  
        echo "Запись удалена.\n";  
    } else {  
        echo "Запись с заданным значением не найдена.\n";  
    }  
}


//4. Новые функции
//Можно добавить функциональности, например, для вывода всех записей, или для редактирования существующих записей.

function listAllEntries() {  
    $file = fopen('birthdays.txt', 'r');  
    if ($file) {  
        while (($line = fgets($file)) !== false) {  
            echo trim($line) . "\n";  
        }  
        fclose($file);  
    } else {  
        echo "Не удалось открыть файл для чтения.\n";  
    }  
}  

// Для редактирования записи  
function editEntry($searchTerm, $newData) {  
    $fileName = 'birthdays.txt';  
    $lines = file($fileName);  

    foreach ($lines as $key => $line) {  
        if (strpos($line, $searchTerm) !== false) {  
            list($name, $date) = explode(', ', trim($line));  
            if (isValidDate($newData[1])) {  
                $lines[$key] = "{$newData[0]}, {$newData[1]}\n";  
                file_put_contents($fileName, implode('', $lines));  
                echo "Запись обновлена.\n";  
            } else {  
                echo "Недопустимый формат даты.\n";  
            }  
            return;  
        }  
    }  
    echo "Запись с заданным значением не найдена.\n";  
}


//Пример использования функций

try {  
    writeData("Василий Васильев", "05-06-1992");  
    findBirthdayToday();  
    deleteEntry("Василий Васильев");  
    listAllEntries();  
    editEntry("Василий Васильев", ["Василий Васильев", "06-06-1992"]);  
} catch (Exception $e) {  
    echo 'Ошибка: ' . $e->getMessage() . "\n";  
}