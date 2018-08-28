#  🚴  PHP Cyclist  🚴 

记录PHP Design Pattern的点滴。

- [🚴 PHP Cyclist 🚴](#%F0%9F%9A%B4-php-cyclist-%F0%9F%9A%B4)
    - [创建模式](#%E5%88%9B%E5%BB%BA%E6%A8%A1%E5%BC%8F)
        - [Abstract Factory Pattern](#abstract-factory-pattern)
            - [DocumentFactory.php](#documentfactoryphp)
            - [ClassicDocumentFactory.php](#classicdocumentfactoryphp)
            - [ModernDocumentFactory.php](#moderndocumentfactoryphp)
            - [Document.php](#documentphp)
            - [Printer.php](#printerphp)
            - [PrinterTest.php](#printertestphp)
        - [Static Factory Pattern](#static-factory-pattern)
            - [StaticDocumentFactory.php](#staticdocumentfactoryphp)
            - [Printer.php](#printerphp)
            - [PrinterTest.php](#printertestphp)
        - [Factory Method Pattern](#factory-method-pattern)
            - [LogFactory.php](#logfactoryphp)
            - [StreamLogFactory.php](#streamlogfactoryphp)
            - [FileLogFactory.php](#filelogfactoryphp)
            - [Log.php](#logphp)
            - [FileLog.php](#filelogphp)
            - [StreamLog.php](#streamlogphp)
            - [FactoryMethodTest.php](#factorymethodtestphp)
        - [Builder Pattern](#builder-pattern)
            - [VehicleBuilder.php](#vehiclebuilderphp)
            - [Director.php](#directorphp)
            - [MotorbikeBuilder.php](#motorbikebuilderphp)
            - [CarBuilder.php](#carbuilderphp)
            - [Vehicle.php](#vehiclephp)
            - [Engine.php](#enginephp)
            - [DirectorTest.php](#directortestphp)
        - [Singleton Pattern](#singleton-pattern)
            - [Locker.php](#lockerphp)
            - [LockerTest.php](#lockertestphp)
        - [Pool Pattern](#pool-pattern)
            - [StringReverseWorker.php](#stringreverseworkerphp)
            - [WorkerPool.php](#workerpoolphp)
            - [WorkerPoolTest.php](#workerpooltestphp)
        - [Prototype Pattern](#prototype-pattern)
            - [BookPrototype.php](#bookprototypephp)
            - [LanguageBookPrototype.php](#languagebookprototypephp)
            - [TravelBookPrototype.php](#travelbookprototypephp)
            - [PrototypeTest.php](#prototypetestphp)
    - [结构模式](#%E7%BB%93%E6%9E%84%E6%A8%A1%E5%BC%8F)
        - [Adapter Pattern](#adapter-pattern)
            - [BookService.php](#bookservicephp)
            - [BookInterface.php](#bookinterfacephp)
            - [Book.php](#bookphp)
            - [EbookInterface.php](#ebookinterfacephp)
            - [BookAdapter.php](#bookadapterphp)
            - [Ebook.php](#ebookphp)
            - [BookServiceTest.php](#bookservicetestphp)
        - [Bridge Pattern](#bridge-pattern)
        - [Composite Pattern](#composite-pattern)
        - [Data Mapper Pattern](#data-mapper-pattern)
        - [Decorator Pattern](#decorator-pattern)
        - [Dependency Injection Pattern](#dependency-injection-pattern)
        - [Facade Pattern](#facade-pattern)
        - [Fluent Interface Pattern](#fluent-interface-pattern)
        - [Flyweight Pattern](#flyweight-pattern)
        - [Proxy Pattern](#proxy-pattern)
        - [Registry Pattern](#registry-pattern)
    - [行为模式](#%E8%A1%8C%E4%B8%BA%E6%A8%A1%E5%BC%8F)
        - [Chain of Responsibilities Pattern](#chain-of-responsibilities-pattern)
        - [Command Pattern](#command-pattern)
        - [Iterator Pattern](#iterator-pattern)
        - [Mediator Pattern](#mediator-pattern)
        - [Memento Pattern](#memento-pattern)
        - [Null Object Pattern](#null-object-pattern)
        - [Observer Pattern](#observer-pattern)
        - [Specification Pattern](#specification-pattern)
        - [State Pattern](#state-pattern)
        - [Strategy Pattern](#strategy-pattern)
        - [Template Method Pattern](#template-method-pattern)
        - [Visitor Pattern](#visitor-pattern)
        - [S.O.L.I.D](#solid)
            - [D. Dependency Inversion Principle](#d-dependency-inversion-principle)

## 创建模式
### Abstract Factory Pattern
<p class="tip">
    `抽象工厂`是创建产品（对象）的地方，其目的是将产品的创建与产品的使用分离。`抽象工厂模式`的目的，是将若干抽象产品的接口与不同主题产品的具体实现分离开。这样就能在增加新的具体工厂的时候，不用修改引用抽象工厂的客户端代码。抽象工厂模式提供了一种方式，可以将一组具有同一主题的构建以抽象工厂的形式封装起来。在正常使用中，客户端程序需要创建抽象工厂的具体实现，然后使用抽象工厂作为接口来创建这一主题的具体对象.    
</p>

举个例子来说，一个办公用具`印刷机`打印一套办公用品，例如，公司信纸，公司简历， 等等。这些办公组件，有不同的主题，例如，`Classic, modern`. 我们需要一个抽象工厂类叫做`DocumentFactory`（文档创建器），此类提供创建若干种产品的接口，包括`createLetter()`（创建信件）和`createResume()`（创建简历）。其中，createLetter()返回一个`Letter`（信件），createResume()返回一个`Resume`（简历）。系统中还有一些DocumentFactory的具体实现类，包括`ClassicDocumentFactory`和`ModernDocumentFactory`。这两个类对DocumentFactory的两个方法分别有不同的实现，用来创建不同的“信件”和“简历”（比如，用ModernDocumentFactory的实例可以创建`ModernLetter`和`ModernResume`）。这些具体的“信件”和“简历”类均继承自抽象类，即Letter和Resume类。客户端需要创建“信件”或“简历”时，先要得到一个合适的DocumentFactory实例，然后调用它的方法。一个工厂中创建的每个对象都是同一个主题的（“Classic”或者“modern”。

<p class="tip">
    在这个例子当中，客户端`Printer`对具体的对象的创建一无所知，它只需要按照需要从`ClassicDocumentFactory`或者`ModernDocumentFactory`当中选择一个`Factory`, 来打印所需的套件就够了。
</p>

- 👍 客户端代码不知道任何具体类型，也就没必要引入任何相关的头文件或类定义。
- 👍 如果要增加一个具体类型，只需要修改客户端代码使用另一个工厂即可，而且这个修改通常只是一个文件中的一行代码。
- 🔥 需要定义多个`Factory`对象来实现抽象工厂
 
#### DocumentFactory.php
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory\Factory;

use DesignPatterns\Creational\AbstractFactory\Document;

abstract class DocumentFactory
{
    abstract public function createLetterDocument(): Document;

    abstract public function createResumeDocument(): Document;
}
```
#### ClassicDocumentFactory.php
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory\Factory;

use DesignPatterns\Creational\AbstractFactory\ClassicLetter;
use DesignPatterns\Creational\AbstractFactory\ClassicResume;
use DesignPatterns\Creational\AbstractFactory\Document;

final class ClassicDocumentFactory extends DocumentFactory
{
    public function createLetterDocument(): Document
    {
        return new ClassicLetter('classic Letter');
    }

    public function createResumeDocument(): Document
    {
        return new ClassicResume('classic resume');
    }
}
```
#### ModernDocumentFactory.php
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory\Factory;

use DesignPatterns\Creational\AbstractFactory\Document;
use DesignPatterns\Creational\AbstractFactory\LetterDocument;
use DesignPatterns\Creational\AbstractFactory\ModernLetter;
use DesignPatterns\Creational\AbstractFactory\ModernResume;

final class ModernDocumentFactory extends DocumentFactory
{
    public function createLetterDocument(): Document
    {
        return new ModernLetter('Modern Letter');
    }

    public function createResumeDocument(): Document
    {
        return new ModernResume('Modern Resume');
    }
}
```
#### Document.php
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory;

abstract class Document
{
    protected $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}

class ClassicResume extends Document
{
}

class ModernLetter extends Document
{
}

class ModernLetter extends Document
{
}

class ModernResume extends Document
{
}
```

#### Printer.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory;

use DesignPatterns\Creational\AbstractFactory\Factory\DocumentFactory;

final class Printer
{
    private $factory;

    public function __construct(DocumentFactory $factory)
    {
        $this->factory = $factory;
    }

    public function printLetter(): Document
    {
        return $this->factory->createLetterDocument();
    }

    public function printResume(): Document
    {
        return $this->factory->createResumeDocument();
    }
} 
```

#### PrinterTest.php
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory\Tests;

use DesignPatterns\Creational\AbstractFactory\ClassicLetter;
use DesignPatterns\Creational\AbstractFactory\ClassicResume;
use DesignPatterns\Creational\AbstractFactory\Factory\ClassicDocumentFactory;
use DesignPatterns\Creational\AbstractFactory\Factory\ModernDocumentFactory;
use DesignPatterns\Creational\AbstractFactory\ModernLetter;
use DesignPatterns\Creational\AbstractFactory\ModernResume;
use DesignPatterns\Creational\AbstractFactory\Printer;
use PHPUnit\Framework\TestCase;

class PrinterTest extends TestCase
{
    public function testPrintDocument()
    {
        $printer = new Printer(new ClassicDocumentFactory());
        $this->assertInstanceOf(ClassicLetter::class, $printer->printLetter());
        $this->assertInstanceOf(ClassicResume::class, $printer->printResume());

        $printer = new Printer(new ModernDocumentFactory());
        $this->assertInstanceOf(ModernLetter::class, $printer->printLetter());
        $this->assertInstanceOf(ModernResume::class, $printer->printResume());
    }
}
```

### Static Factory Pattern
<p class="tip">
    和`abstract factory`相比，`static factory`是使用一个`static function`来创建所指定的对象。它通常只有唯一一个
    创建方法，通常会被命名微`build`.
</p>

<p class="warning">
    当我们通过`StaticDocumentFactory`来创建多个对象的时候，该类的静态方法`build(type)`就会随着需求不断的被扩充，
    很容易变得非常混乱。如果，在创建每个对象的`case`代码块的代码如果非常复杂的话，就无法容易的维护代码。
</p>

- 👍 相比 abstract factory， 静态工厂的代码较为简单，不需要多余的`ClassicDocumentFactory`, `ModernDocumentFactory`
- 👍 添加对象时，只需再添加一个`case`块
- 🔥 客户端`Printer`需要知道工厂内部使用创建的对象的每一个`docmentType`
- 🔥 static是魔鬼。

#### StaticDocumentFactory.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\StaticFactory\Factory;

use DesignPatterns\Creational\StaticFactory\ClassicLetter;
use DesignPatterns\Creational\StaticFactory\ClassicResume;
use DesignPatterns\Creational\StaticFactory\Document;
use DesignPatterns\Creational\StaticFactory\ModernLetter;
use DesignPatterns\Creational\StaticFactory\ModernResume;

final class StaticDocumentFactory
{
    public static function build(string $documentType): Document
    {
        switch ($documentType) {
            case 'classic_letter':
                return new ClassicLetter('classic Letter');
            case 'classic_resume':
                return new ClassicResume('classic Resume');
            case 'modern_letter':
                return new ModernLetter('modern Letter');
            case 'modern_resume':
                return new ModernResume('modern Resume');
            default:
                throw new \Exception('Unknow document type!');
        }
    }
} 
```
#### Printer.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\StaticFactory;

use DesignPatterns\Creational\StaticFactory\Factory\StaticDocumentFactory;

final class Printer
{
    public function printClassicLetter(): Document
    {
        return StaticDocumentFactory::build('classic_letter');
    }

    public function printClassicResume(): Document
    {
        return StaticDocumentFactory::build('classic_resume');
    }

    public function printModernLetter(): Document
    {
        return StaticDocumentFactory::build('modern_letter');
    }

    public function printModernResume(): Document
    {
        return StaticDocumentFactory::build('modern_resume');
    }
} 
```

#### PrinterTest.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\StaticFactory\Tests;

use DesignPatterns\Creational\StaticFactory\ClassicLetter;
use DesignPatterns\Creational\StaticFactory\ClassicResume;
use DesignPatterns\Creational\StaticFactory\ModernLetter;
use DesignPatterns\Creational\StaticFactory\ModernResume;
use DesignPatterns\Creational\StaticFactory\Printer;
use PHPUnit\Framework\TestCase;

class PrinterTest extends TestCase
{
    public function testPrintDocument()
    {
        $printer = new Printer();
        $this->assertInstanceOf(ClassicLetter::class, $printer->printClassicLetter());
        $this->assertInstanceOf(ClassicResume::class, $printer->printClassicResume());

        $this->assertInstanceOf(ModernLetter::class, $printer->printModernLetter());
        $this->assertInstanceOf(ModernResume::class, $printer->printModernResume());
    }
}
 
```

### Factory Method Pattern
<p class="tip">
    工厂方法, 这个模式是一个 “真正” 的设计模式，因为它遵循了（Dependency Inversion Principle） 众所周知这个 “D” 代表了真正的面向对象程序设计。它意味着工厂方法类依赖于类的抽象，而不是具体将被创建的类，这是工厂方法模式与简单工厂模式和静态工厂模式最重要的区别.
</p>

在下面的例子当中，工厂方法使这种结构可以在不修改具体工厂类的情况下引进新的`Log`. 如果出现新的`Log`类型，只需要为这种新`Log`创建一个具体的工厂类就可以获得`Log`的实例，这一特点无疑使得工厂方法模式具有超越简单工厂模式的优越性，更加符合“开闭原则”:

    1）对于扩展是开放的（Open for extension）。当应用的需求改变时，我们可以对模块进行扩展，使其具有满足那些改变的新行为.
    2）对于修改是关闭的（Closed for modification）。对模块行为进行扩展时，不必改动模块的源代码或者二进制代码.


#### LogFactory.php
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

abstract class LogFactory
{
    abstract public function createLog(): Log;
}
```
#### StreamLogFactory.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

class StreamLogFactory extends LogFactory
{
    public function createLog(): Log
    {
        return new StreamLog();
    }
} 
```

#### FileLogFactory.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

class FileLogFactory extends LogFactory
{
    public function createLog(): Log
    {
        return new FileLog();
    }
} 
```

#### Log.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

abstract class Log
{
    abstract public function writeLog(): void;
} 
```
#### FileLog.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

class FileLog extends Log
{
    public function __construct()
    {
    }

    public function writeLog(): void
    {
        echo 'file logs';
    }
} 
```

#### StreamLog.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

class StreamLog extends Log
{
    public function writeLog(): void
    {
        echo 'stream logs';
    }
} 
```
#### FactoryMethodTest.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod\Tests;

use DesignPatterns\Creational\FactoryMethod\FileLogFactory;
use DesignPatterns\Creational\FactoryMethod\StreamLogFactory;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{
    public function testWriteFileLogs()
    {
        $fileLogFactory = new FileLogFactory();
        $fileLog = $fileLogFactory->createLog();
        $fileLog->writeLog();

        $this->expectOutputString('file logs');
    }

    public function testWriteStreamLogs()
    {
        $streamLogFactory = new StreamLogFactory();
        $streamLog = $streamLogFactory->createLog();
        $streamLog->writeLog();

        $this->expectOutputString('stream logs');
    }
} 
```





### Builder Pattern
<p class="tip">
    建造模式模式, 是一种对象构建模式。它将复杂对象的建造过程抽象为`BuilderInterface`的形式，使这个`BuilderInterface`的不同实现方法(具体的`Builder`类)可以构造出不同的对象。
</p>
<p class="warning">
    - 当创建复杂对象的算法应该独立于该对象的组成部分以及它们的装配方式时；
    - 当构造过程必须允许被构造的对象有不同的表示时。
</p>

参与者
- `VehicleBuilder`为创建一个`Vehicle`对象的各个部件指定抽象接口。
- `MotorbileBuilder`实现Builder的接口以构造和装配该`Motobike`的各个部件。定义并明确它所创建的表示。
- `Director`构造一个使用`VehicleBuilder`接口的对象。
- `Vehcile`是被构造的复杂对象的抽象父类。

协作
- 客户创建Director对象，并用它所想要的Builder对象进行配置。
- Director配置创建复杂对象的流程。
- 生成器处理导向器的请求，并将部件添加到该产品中。

优点
- 容许更改构建对象的内部细节
- 将复杂的构建过程进行了封装
- 可以控制复杂的构建过程


缺点
- 对于对象不同的表相，需要建立不同的`ConcreteBuilder`
- `ConcreteBuilder`时多变的动态的
- `Dependency injection`比较困难

#### VehicleBuilder.php

```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

interface VehicleBuilder
{
    public function createVehicle();

    public function addEngine();
    public function addDoors();
    public function addWheels();

    public function getVehicle(): Vehicle;
} 
```

#### Director.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

final class Director
{
    public function build(VehicleBuilder $builder): Vehicle
    {
        $builder->createVehicle();
        $builder->addDoors();
        $builder->addEngine();
        $builder->addWheels();

        return $builder->getVehicle();
    }
} 
```
#### MotorbikeBuilder.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

use DesignPatterns\Creational\Builder\Parts\Engine;
use DesignPatterns\Creational\Builder\Parts\Wheel;

final class MotorbikeBuilder implements VehicleBuilder
{
    /** @var Motorbike */
    private $motorbike;

    public function createVehicle()
    {
        $this->motorbike = new Motorbike();
    }

    public function addEngine()
    {
        $this->motorbike->setPart('engine', new Engine());
    }

    public function addDoors()
    {
    }

    public function addWheels()
    {
        $this->motorbike->setPart('wheel-1', new Wheel());
        $this->motorbike->setPart('wheel-2', new Wheel());
    }

    public function getVehicle(): Vehicle
    {
        return $this->motorbike;
    }
} 
```
#### CarBuilder.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

use DesignPatterns\Creational\Builder\Parts\Door;
use DesignPatterns\Creational\Builder\Parts\Engine;
use DesignPatterns\Creational\Builder\Parts\Wheel;

class CarBuilder implements VehicleBuilder
{
    /** @var Car */
    private $car;

    public function createVehicle()
    {
        $this->car = new Car();
    }

    public function addEngine()
    {
        $this->car->setPart('engine', new Engine());
    }

    public function addDoors()
    {
        $this->car->setPart('door-1', new Door());
        $this->car->setPart('door-2', new Door());
        $this->car->setPart('door-3', new Door());
        $this->car->setPart('door-4', new Door());
    }

    public function addWheels()
    {
        $this->car->setPart('wheel-1', new Wheel());
        $this->car->setPart('wheel-2', new Wheel());
        $this->car->setPart('wheel-3', new Wheel());
        $this->car->setPart('wheel-4', new Wheel());
    }

    public function getVehicle(): Vehicle
    {
        return $this->car;
    }
} 
```
#### Vehicle.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

abstract class Vehicle
{
    /**
     * @var object[]
     */
    protected $parts = [];

    /**
     * @param string $key
     * @param object $part
     */
    public function setPart(string $key, $part)
    {
        $this->parts[$key] = $part;
    }
}

final class Car extends Vehicle
{
}

final class Motorbike extends Vehicle
{
}
```

#### Engine.php
```php
 <?php
final class Door
{
}

final class Wheel
{
}

final class Engine
{
} 
```
#### DirectorTest.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder\Tests;

use DesignPatterns\Creational\Builder\Car;
use DesignPatterns\Creational\Builder\CarBuilder;
use DesignPatterns\Creational\Builder\Director;
use DesignPatterns\Creational\Builder\Motorbike;
use DesignPatterns\Creational\Builder\MotorbikeBuilder;
use PHPUnit\Framework\TestCase;

class DirectorTest extends TestCase
{
    public function testBuildMotorbike()
    {
        $vehicle = (new Director())->build(new MotorbikeBuilder());

        $this->assertInstanceOf(Motorbike::class, $vehicle);
    }

    public function testBuildCar()
    {
        $vehicle =(new Director())->build(new CarBuilder());

        $this->assertInstanceOf(Car::class, $vehicle);
    }
}
 
```

### Singleton Pattern
<p class="tip">
    `Singleton` 设计模式，最常用的情况是： 举例1，前端网站在访问数据库时，有且只有唯一一个数据库链接。举例2， 当服务需要一个`Locker`对象来做某些切换的时候。我们可以使用`singleton`编写一个`Locker`对象，以这个唯一的对象作为切换的标准，进行解锁或上锁。
</p>

- Singleton 对象不可为父类: 定义类为private
- Singleton 对象不可复制: 定义`__clone()`为private
- Singleton 对象不可从外部构建: 定义`__construct()`为private
- Singleton 对象不可唤醒，或者说不可unserialized: 定义`__wakeup()`为private

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

### Pool Pattern
<p class="tip">
    `对象池设计模式`是创建型设计模式，它会对新创建的对象应用一系列的初始化操作，让对象保持立即可使用的状态. 对象池的使用者会对对象池发起请求，以期望获取一个对象，并使用获取到的对象进行一系列操作，当使用者对对象的使用完成之后，使用者会将由对象池的对象创建工厂创建的对象返回给对象池，而不是用完之后销毁获取到的对象。
</p>

*适用环境：*
- 对象池在某些情况下会带来重要的`性能提升`，比如耗费资源的对象初始化操作，实例化类的代价很高，但每次实例化的数量较少的情况下。
- 对象池中将被创建的对象会在真正被使用时被提前创建，避免在使用时让使用者浪费对象创建所需的大量时间(比如在对象某些操作需要访问网络资源的情况下)从池子中取得对象的时间是可预测的，但新建一个实例所需的时间是不确定。总之，对象池会为你节省宝贵的程序执行时间，比如像:
    - 数据库连接，
    - socket连接，
    - 大量耗费资源的代表数字资源的对象，像字体或者位图
- 不过，在特定情况下，简单的对象创建池(没有请求外部的资源，仅仅将自身保存在内存中)或许并不会提升效率和性能，这时候，就需要使用者酌情考虑了。

#### StringReverseWorker.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Pool;

class StringReverseWorker
{
    /** @var \DateTime */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function run(string $inputString): string
    {
        return strrev($inputString);
    }
} 
```

#### WorkerPool.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Pool;

class WorkerPool implements \Countable
{
    private $freeWorkers = [];
    private $occupiedWorkers = [];

    public function count(): int
    {
        return count($this->freeWorkers) + count($this->occupiedWorkers);
    }

    public function getWorker(): StringReverseWorker
    {
        if (count($this->freeWorkers) === 0) {
            $worker = new StringReverseWorker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->occupiedWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    public function dispose(StringReverseWorker $worker): void
    {
        $hashKey = spl_object_hash($worker);
        if (array_key_exists($hashKey, $this->occupiedWorkers)) {
            unset($this->occupiedWorkers[$hashKey]);
            $this->freeWorkers[$hashKey] = $worker;
        }
    }
} 
```

#### WorkerPoolTest.php
```php
 <?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Pool\Tests;

use DesignPatterns\Creational\Pool\StringReverseWorker;
use DesignPatterns\Creational\Pool\WorkerPool;
use PHPUnit\Framework\TestCase;

class WorkerPoolTest extends TestCase
{
    /** @var WorkerPool */
    private $pool;

    public function setUp(): void
    {
        $this->pool = new WorkerPool();
    }

    public function testCountable(): void
    {
        $this->assertEquals(0, count($this->pool));

        $this->pool->getWorker();
        $this->pool->getWorker();
        $this->assertEquals(2, count($this->pool));
    }

    public function testCanGetAnCorrectInstance()
    {
        $this->assertInstanceOf(StringReverseWorker::class, $this->pool->getWorker());
    }

    public function testCanGetTheSameInstanceIfDisposedPreviousInstance()
    {
        $workerFoo = $this->pool->getWorker();
        $this->pool->dispose($workerFoo);

        $workerBar = $this->pool->getWorker();

        $this->assertSame($workerFoo, $workerBar);
    }
}
 
```


### Prototype Pattern
<p class="tip">
    通过创建一个原型对象，然后复制原型对象来避免通过标准的方式创建大量的对象产生的开销(new Foo())。被复制的实例就是我们所称的“原型”，这个原型是可定制的. 比如通过ORM获取1,000,000行数据库记录然后创建每一条记录对应的对象实体。在实际项目中，原型模式很少单独出现，一般是和工厂方法模式一起出现， 即通过clone的方法创建一个对象，然后由工厂方法提供给调用者。
</p>

*适用环境:*
- 多用于创建复杂的或者耗时的实例，包括数据、硬件资源等。
- 或者创建值相等，只是命名不一样的同类海量数据
- 通过new产生一个对象需要非常繁琐的数据准备或访问权限，则可以使用原型模式。
- 一个对象需要提供给其他对象访问，而且各个调用者可能都需要修改其值时，可以考虑使用原型模式拷贝多个对象供调用者使用。

#### BookPrototype.php 
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Prototype;

abstract class BookPrototype
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $category;

    abstract public function __clone();

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

}
```
#### LanguageBookPrototype.php 
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Prototype;

class LanguageBookPrototype extends BookPrototype
{
    protected $category = 'language';

    public function __clone()
    {
    }
} 
```
#### TravelBookPrototype.php 
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Prototype;

class TravelBookPrototype extends BookPrototype
{
    protected $category = 'travel';

    public function __clone()
    {
    }
} 
```
#### PrototypeTest.php 
```php
<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Prototype\Tests;

use DesignPatterns\Creational\Prototype\LanguageBookPrototype;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{
    public function testCanGetLanguageBook()
    {
        $languageBook = new LanguageBookPrototype();

        $languageBook1 = clone $languageBook;
        $languageBook1->setTitle('language book band 1');
        $this->assertInstanceOf(LanguageBookPrototype::class, $languageBook1);

        $languageBook2 = clone $languageBook;
        $languageBook2->setTitle('language book band 2');
        $this->assertInstanceOf(LanguageBookPrototype::class, $languageBook2);
    }
}
  
```

## 结构模式

### Adapter Pattern
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


### Bridge Pattern

### Composite Pattern

### Data Mapper Pattern

### Decorator Pattern

### Dependency Injection Pattern

### Facade Pattern

### Fluent Interface Pattern

### Flyweight Pattern

### Proxy Pattern

### Registry Pattern

## 行为模式
### Chain of Responsibilities Pattern

### Command Pattern

### Iterator Pattern

### Mediator Pattern

### Memento Pattern

### Null Object Pattern

### Observer Pattern

### Specification Pattern

### State Pattern

### Strategy Pattern

### Template Method Pattern

### Visitor Pattern

### S.O.L.I.D
#### D. Dependency Inversion Principle
<p class="tip">
  依赖反转原则, 该原则规定：1.高层次的模块不应该依赖于低层次的模块，两者都应该依赖于抽象接口。2.抽象接口不应该依赖于具体实现。而具体实现则应该依赖于抽象接口。    
</p>
问题由来：

    UerService直接依赖类SessionStorage，假如要将类SessionStorage改为依赖类RedisStorage，则必须通过修改类UserService的代码来达成。这种场景下，类UserStorage一般是高层模块，负责复杂的业务逻辑；类SessionStorage和类RedisStorage是低层模块，负责基本的原子操作；假如修改类UserService，会给程序带来不必要的风险。

解决方案：

    将类UserService修改为依赖接口StorageInterface，类SessionStorage和类RedisStorage各自实现接口StorageInterface，类UserService通过接口StorageInterface间接与类SessionStorage或者类RedisStorage发生联系，则会大大降低修改类UserStorage的几率。


