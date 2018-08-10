# 🛵 PHP Scooter 🛵
记录PHP Design Pattern的点滴。

## 创建模式
### Abstract Factory

### Static Factory

### Simple Factory

### Factory Method

### Builder

### Singleton

### Multition

### Pool

### Prototype

## 结构模式

### Adapter
<p class="tip">
    Adapter 设计模式常用来解决接口不兼容的问题。 比方说，德国的电源插座是双孔圆形接口，当你使用中国三孔矩形接口的电脑时，就无法接通电源。因为，接口不合标准。通常，解决的办法是，旅行随身携带一个电源转接头，即`adapter`. 让后将此转接头接到矩形三口插头上， 然后将转接头链接到德国双孔圆形电源插座上。 通过转接头的转换，可以对不符合标准的电器提供电源。在软件设计中，被称为`adapter`的对象，会实现标准接口，然后将非标准，有冲突的借口的对应方法进行相应的解析或者翻译，让其不标准的接口通过转换后满足调用者的需求。
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
