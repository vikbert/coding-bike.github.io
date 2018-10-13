---
title: Testing Notes
author: Vikbert
pandoc-latex-fontsize:
  - classes: [c, listing]
    size: footnotesize
...

# Testing
TODO:
- 听听名人是如何说明测试重要性的


## PHPUnit
TODO：
- 使用PHPUnit可以做哪些测试呢
- 如何做 unit test
- 如何做 integration test
- 如何做 database test


### Unit Testing
TODO:
- 了解什么需要测试
- 了解什么无须测试
  

#### Mock Object
会使用PHPUnit的mock object是在写测试的最基本的技能。不会灵活使用它的程序员，不能算是真正会书写测试代码
如果在编写测试时无法使用（或选择不使用）实际的依赖组件(DOC)，可以用mock来代替。在确定的测试目标下，mock不需要和真正的依赖组件有完全一样的的行为方式；mock只需要提供测试所需要的API即可，这样被测系统就会以为它是真正的组件！

PHPUnit 提供的 createMock(ClassName::class) 和 getMockBuilder(ClassName::class) 方法可以在测试中用来自动生成Mock.

##### createMock()
createMock(ClassName::class) 方法直接返回指定类型（接口或类）的测试替身对象实例。此测试替身的创建使用了最佳实践的默认值

- 不执行原始类的 __construct() 
- 不执行原始类的 __clone()
- 所有方法都会被替换为只会返回 null 的伪实现
- 不会调用原版方法
<p class="tip">
    请注意，final、private 和 static 方法无法对其进行上桩(stub)或模仿(mock)。PHPUnit 的测试替身功能将会忽略它们，并维持它们的原始行为。
</p>

```php
$mockRepo = $this->createMock(ProductRepository::class);
```
##### 上桩(stubbing)
将Mock替换为（可选地）返回配置好的返回值的Mock的实践方法称为*上桩(stubbing)*.
```php
$stub = $this->createMock(SomeClass::class);

// stubbing by calling `method()`. Only be valid, if no function named `method` in original class
$stub->method('doSomething')->willReturn('foo');

// stubbing by calling `expects()->method()`
$stub->expects($this->any())->method('doSomething')->willReturn('foo');

// 现在调用 $stub->doSomething() 将返回 'foo'。
$this->assertEquals('foo', $stub->doSomething());
```
<p class="tip">
    用 willReturn($value) 返回简单值。这个简短的语法相当于 will($this->returnValue($value))。而在这个长点的语法中，可以使用变量，从而实现更复杂的上桩行为。    
</p>

```php
$stub = $this->createMock(SomeClass::class);

//01: returns `foo`
$stub->method('doSomething')->willReturn('foo');
$stub->method('doSomething')->will($this->returnValue('foo'));
$this->assertSame('foo', $stub->doSomething());

//02: returns arg1
$stub->method('doSomething')->will($this->returnArgument(0));
$this->assertSame($foo, $stub->doSomething($foo, $bar));

//03: return stub self
$stub->method('doSomething')->will($this->returnSelf());
$this->assertSame($stub, $stub->doSomething());

//04: returns mapped data
// 创建从参数到返回值的映射。
$map = [
    ['a', 'b', 'c', '111'],
    ['e', 'f', 'g', '999']
];

// 配置桩件。
$stub->method('doSomething')
     ->will($this->returnValueMap($map));

// $stub->doSomething() 根据提供的参数返回不同的值。
$this->assertEquals('111', $stub->doSomething('a', 'b', 'c'));
$this->assertEquals('999', $stub->doSomething('e', 'f', 'g'));

```





##### getMockBuilder()
如果这些默认值非你所需，可以用 getMockBuilder(ClassName::class) 方法并使用流畅式接口来定制Mock的生成过程。

## Behat

## Codeception