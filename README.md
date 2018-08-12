# 🚴 🚴 🚴 PHP Cyclist  🚴 🚴 🚴 🚴 🚴 🚴
记录PHP Design Pattern的点滴。

## 创建模式
### Abstract Factory
<p class="tip">
    `工厂`是创建产品（对象）的地方，其目的是将产品的创建与产品的使用分离。`抽象工厂模式`的目的，是将若干抽象产品的接口与不同主题产品的具体实现分离开。这样就能在增加新的具体工厂的时候，不用修改引用抽象工厂的客户端代码。抽象工厂模式提供了一种方式，可以将一组具有同一主题的构建以抽象工厂的形式封装起来。在正常使用中，客户端程序需要创建抽象工厂的具体实现，然后使用抽象工厂作为接口来创建这一主题的具体对象.    
</p>

举个例子来说，一个办公用具`印刷机`打印一套办公用品，例如，公司信纸，公司简历， 等等。这些办公组件，有不同的主题，例如，`classic, fancy, modern`. 我们需要一个抽象工厂类叫做`DocumentCreator`（文档创建器），此类提供创建若干种产品的接口，包括`createLetter()`（创建信件）和`createResume()`（创建简历）。其中，createLetter()返回一个`Letter`（信件），createResume()返回一个`Resume`（简历）。系统中还有一些DocumentCreator的具体实现类，包括`FancyDocumentCreator`和`ModernDocumentCreator`。这两个类对DocumentCreator的两个方法分别有不同的实现，用来创建不同的“信件”和“简历”（比如，用ModernDocumentCreator的实例可以创建`ModernLetter`和`ModernResume`）。这些具体的“信件”和“简历”类均继承自抽象类，即Letter和Resume类。客户端需要创建“信件”或“简历”时，先要得到一个合适的DocumentCreator实例，然后调用它的方法。一个工厂中创建的每个对象都是同一个主题的（“fancy”或者“modern”）。客户端程序只需要知道得到的对象是“信件”或者“简历”，而不需要知道具体的主题，因此客户端程序从抽象工厂DocumentCreator中得到了Letter或Resume类的引用，而不是具体类的对象引用。

    - 客户端代码不知道任何具体类型，也就没必要引入任何相关的头文件或类定义。
    - 如果要增加一个具体类型，只需要修改客户端代码使用另一个工厂即可，而且这个修改通常只是一个文件中的一行代码。

### Static Factory

### Simple Factory

### Factory Method

### Builder

### Singleton
<p class="tip">
    `Singleton` 设计模式，最常用的情况是： 举例1，前端网站在访问数据库时，有且只有唯一一个数据库链接。举例2， 当服务需要一个`Locker`对象来做某些切换的时候。我们可以使用`singleton`编写一个`Locker`对象，以这个唯一的对象作为切换的标准，进行解锁或上锁。
</p>
<p class="warning">
    singleton对象不可为父类: 定义类为private
</p>
<p class="warning">
    singleton对象不可复制: 定义__clone()为private
</p>
<p class="warning">
    singleton对象不可从外部构建: 定义__construct()为private
</p>
<p class="warning">
    singleton对象不可唤醒，或者说不可unserialized: 定义__wakeup()为private
</p>

#### Locker.php
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Singleton;

final class Locker
{
    /** @var Locker */
    private static $instance;

    /** @var bool */
    private $isLocked = false;

    public static function getInstance(): Locker
    {
        if (null === static::$instance) {
            static::$instance = new Static();
        }

        return self::$instance;
    }

    public function lock()
    {
        $this->isLocked = true;
    }

    public function unlock()
    {
        $this->isLocked = false;
    }

    public function isLocked(): bool
    {
        return $this->isLocked;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
```
#### LockerTest.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Singleton;

use PHPUnit\Framework\TestCase;

class LockerTest extends TestCase
{
    public function testCreateOneJustOneInstance()
    {
        $locker1 = Locker::getInstance();
        $locker2 = Locker::getInstance();
        $this->assertTrue($locker1 === $locker2);
    }

    public function testLockStatus()
    {
        $locker1 = Locker::getInstance();
        $this->assertFalse($locker1->isLocked());

        $locker1->lock();
        $this->assertTrue($locker1->isLocked());

        $locker2 = Locker::getInstance();
        $this->assertTrue($locker2->isLocked());
    }
} 
```





### Multition

### Pool

### Prototype

## 结构模式

### Adapter
<p class="tip">
    Adapter 设计模式常用来解决接口不兼容的问题。 比方说，德国的电源插座是双孔圆形接口，当你使用中国三孔矩形接口的电器时，就无法接通电源。因为，接口不合标准。通常，解决的办法是，旅行随身携带一个电源转接头，即`adapter`. 然后将此转接头接到矩形三口插头上， 再将转接头连接到德国双孔圆形电源插座上。 通过转接头的转换，现在却可以对不符合标准的电器提供电源。在软件设计中，被称为`adapter`的对象，会实现标准接口，然后将非标准，有冲突的借口的对应方法进行相应的解析或者翻译，让其不标准的接口通过转换后满足调用者的接口需求。
</p>

现有的服务`BookService`只能兼容interface `Book` 的进行阅读。当出现`Ebook`类的时候，该服务`BookService`就无法对它进行阅读， 因为出现接口冲突。

#### BookService.php

```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

class BookService
{
    private $book;

    public function __construct(BookInterface $book)
    {
        $this->book = $book;
    }

    public function read(int $pageNumber): bool
    {
        $this->book->open();
        while ($this->book->getPage() !== $pageNumber) {
            echo 'read the page ' . $this->book->getPage() . "\n";
            $this->book->turnPage();
        }

        return true;
    }
}
 
```
#### BookInterface.php
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

interface BookInterface
{
    public function open();

    public function turnPage();

    public function getPage(): int;
}
```
#### Book.php
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

class Book implements BookInterface
{
    private $amountPages;
    private $currentPage;

    public function __construct(int $amountPages)
    {
        $this->amountPages = $amountPages;
    }

    public function open()
    {
        $this->currentPage = 1;
    }

    public function turnPage()
    {
        if ($this->currentPage === $this->amountPages) {
            throw new \Exception('Failed: already the last page!');
        }

        ++$this->currentPage;
    }

    public function getPage(): int
    {
        return $this->currentPage;
    }
}
```
#### EbookInterface.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

interface EbookInterface
{
    public function unlock();

    public function pressNext();

    public function getViewNumber(): int;
}
 
```
此时可以通过添加adapter `EbookAdapter`，让该class `EbookAdapter`实现接口`BookInterface`来满足服务的要求。 在adapter内部，对不兼容的接口`EbookInterface`进行解析和转换，将`EbookInterface`翻译转换成为可兼容的借口，最后达到可以被`BookService`所使用。

#### BookAdapter.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

class EbookAdapter implements BookInterface
{
    private $ebook;

    public function __construct(EbookInterface $ebook)
    {
        $this->ebook = $ebook;
    }

    public function open()
    {
        $this->ebook->unlock();
    }

    public function turnPage()
    {
        $this->ebook->pressNext();
    }

    public function getPage(): int
    {
        return $this->ebook->getViewNumber();
    }
}
```
#### Ebook.php

```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

/**
 * @author Xun Zhou <xun.zhou@lidl.com>
 */
class Ebook implements EbookInterface
{
    /** @var bool */
    private $isLocked = true;

    /** @var int */
    private $currentPage;

    /** @var int */
    private $amountPages;

    public function __construct(int $amountPages)
    {
        $this->amountPages = $amountPages;
    }

    public function unlock()
    {
        $this->isLocked = true;
        $this->currentPage = 1;
    }

    public function pressNext()
    {
        ++$this->currentPage;
    }

    public function getViewNumber(): int
    {
        return $this->currentPage;
    }
}
 
```
#### BookServiceTest.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

use PHPUnit\Framework\TestCase;

class BookServiceTest extends TestCase
{
    public function testReadBook()
    {
        $service = new BookService(new Book(200));

        echo "Open Book: \n";
        $this->assertTrue($service->read(10));
    }

    public function testReadEbook()
    {
        $ebook = new Ebook(100);

        echo "Open E-Book: \n";
        $service = new BookService(new EbookAdapter($ebook));
        $this->assertTrue($service->read(10));
    }
}
 
```


### Bridge

### Composite

### Data Mapper

### Decorator

### Dependency Injection

### Facade

### Fluent Interface

### Flyweight

### Proxy

### Registry

## 行为模式
### Chain of Responsibilities

### Command

### Iterator

### Mediator

### Memento

### Null Object

### Observer

### Specification

### State

### Strategy

### Template Method

### Visitor
