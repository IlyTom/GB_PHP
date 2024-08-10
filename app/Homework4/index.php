<?php
abstract class Book
{
    protected $title;
    protected $author;
    protected $readCount;

    public function __construct($title, $author)
    {
        $this->title = $title;
        $this->author = $author;
        $this->readCount = 0;
    }

    abstract public function getLocation();

    public function incrementReadCount()
    {
        $this->readCount++;
    }

    public function getReadCount()
    {
        return $this->readCount;
    }
}

class DigitalBook extends Book
{
    private $downloadLink;

    public function __construct($title, $author, $downloadLink)
    {
        parent::__construct($title, $author);
        $this->downloadLink = $downloadLink;
    }

    public function getLocation()
    {
        return $this->downloadLink;
    }
}

class PhysicalBook extends Book
{
    private $libraryAddress;

    public function __construct($title, $author, $libraryAddress)
    {
        parent::__construct($title, $author);
        $this->libraryAddress = $libraryAddress;
    }

    public function getLocation()
    {
        return $this->libraryAddress;
    }
}


//6 задание 
/*class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();*/

/*Вывод $x = 1 (первый вызов)
2: $x = 2 (второй вызов в другом экземпляре)
3: $x = 3 (третий вызов)
4: $x = 4 (четвёртый вызов в другом экземпляре)*/

/*class A {
    public function foo() {
    static $x = 0;
    echo ++$x;
    }
    }
    class B extends A {
    }
    $a1 = new A();
    $b1 = new B();
    $a1->foo();
    $b1->foo();
    $a1->foo();
    $b1->foo();
    1: $x = 1 (в классе A)
1: x=1(в классе B–статическаяпеременная
x=1(вклассеB–статическаяпеременнаяx в классе A не влияет на B, инициализация своей)
2: $x = 2 (в классе A)
2: $x = 2 (в классе B)
