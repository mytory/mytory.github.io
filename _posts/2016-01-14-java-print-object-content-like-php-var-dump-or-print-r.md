---
title: 자바에서 Pojomatic을 이용해 객체 내용 출력하기 - var_dump나 print_r처럼
layout: post
categories:
  - serverside
tags:
  - java, pojomatic
---

나는 주로 PHP 개발을 한다. 물론 JAVA 개발도 한다. PHP에는 디버그 툴로 `print_r`이나 `var_dump` 같은 함수가 있다. [`xdebug`](http://xdebug.org/) 같은 확장을 이용하면 출력도 깔끔하다. 

JAVA에는 그런 게 없다. 물론 이클립스를 이용해 객체를 디버그할 수 있지만, 불편하다. 

좀 번거롭지만, `toString()` 메서드를 오버라이드할 수 있는 방법이 있다. 이렇게 하면 `print_r` 함수를 사용한 것처럼 객체 내용을 출력한다. [Pojomatic 라이브러리](http://www.pojomatic.org/)를 사용한다.

만약 메이븐을 사용한다면, `pom.xml`에 아래처럼 의존성을 추가해 준다.

    <dependency>
        <groupId>org.pojomatic</groupId>
        <artifactId>pojomatic</artifactId>
        <version>1.0</version>
    </dependency>

`PostVo.java`처럼 내용을 출력하기 원하는 객체에 Pojomatic을 임포트하고, 클래스 위에 `@AutoProperty` 어노테이션을 넣어 준다.

    import org.pojomatic.Pojomatic;
    import org.pojomatic.annotations.AutoProperty;

    @AutoProperty
    public class PostVO { ... }

그리고 아래처럼 `toString` 메서드를 덮어 쓴다.

    @Override
    public String toString() {
        return Pojomatic.toString (this);
    }

`hashCode()`와 `equals(Object o)` 메서드도 덮어 쓸 수 있다.
    
    @Override
    public boolean equals(Object o) {
        return Pojomatic.equals (this, o);
    }

    @Override
    public int hashCode() {
        return Pojomatic.hashCode (this);
    }

이렇게 하고 나면, 아래처럼 코드를 쓸 수 있고, 결과도 아래처럼 나온다.

    System.out.println(new Person("John", "Doe", 32).toString());
    
    // result: Person{firstName: {John}, lastName: {Doe}, age: {32}}
    
흔히 사용하는 log4j에서 `logger.debug("{}", vo)` 식으로 사용할 수도 있다.