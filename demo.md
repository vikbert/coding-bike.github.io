---
title: testing
pagetitle: xzhou
pandoc-latex-fontsize:
  - classes: [smallcontent]
    size: tiny
  - classes: [largecontent, important]
    size: huge
---

~~~{.cpp}
class A 
{
    public:
        static void f1 () {}; 

        virtual void f2 () = override; 
};
~~~
```php
$stub = $this->createMock(SomeClass::class);

// stubbing by calling `method()`. Only be valid, if no function named `method` in original class
$stub->method('doSomething')->willReturn('foo');

// stubbing by calling `expects()->method()`
$stub->expects($this->any())->method('doSomething')->willReturn('foo');

// 现在调用 $stub->doSomething() 将返回 'foo'。
$this->assertEquals('foo', $stub->doSomething());
```