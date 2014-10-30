---
title: PHP 팩토리 패턴을 만드는 방법
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1948
aktt_notify_twitter:
  - yes
daumview_id:
  - 36665258
categories:
  - 서버단
tags:
  - PHP
---
[녹풍]원문은 [How To Create a PHP Factory Pattern][1] 이다.

MVC를 만드는 것은 내가 새로운 프로그래밍 컨셉을 많이 배울 수 있게 해 줬다. 그들 중 **팩토리 패턴**이라는 것이 있다. 프로그래밍 패턴이 필수는 아니다. 패턴은 특정 문제를 해결하기 위한 가장 간단한 방법이다. 이 말은 다른 방법으로도 같은 문제를 해결할 수 있다는 말이다. 다만, 패턴은 목표를 성취하게 해 주는 가장 효과적인 방법이라고 할 수 있다.

오늘은 **팩토리 패턴**을 살펴볼 것이다. 현실에서 공장(Factory)은 물건을 만든다. 비슷하게, 팩토리 패턴에서 &#8216;팩토리&#8217;가 객체를 만든다.

## 팩토리 패턴 만들기

이걸 설명하기 위해, 일반적으로 우리가 객체를 만들고 사용하는 방법을 살펴 보자.

<pre class="brush:php">&lt;?php
$oUser = new User();
$oUser-&gt;start();
?&gt;</pre>

위 코드는 `User` 객체를 만들고 `start` 함수를 실행한다. 팩토리 패턴은 코드 한 줄로 같은 일을 할 수 있게 해 준다.

이렇게 한다.

<pre class="brush:php">&lt;?php
class User
{
    public static function factory()
    {
        return new __CLASS__;
    }
    public function start() { ... }
}

User::factory()-&gt;start();
?&gt;</pre>

위의 `factory` 함수는 객체를 만들고 반환한다. `__CLASS__ `는 클래스 이름을 지칭하는 매직 상수다. 이 경우에는 &#8220;User&#8221;를 지칭하는 게 되겠다. 따라서, `factory` 함수는 `User` 객체를 리턴한다.

이 함수가 스태틱 함수고, 원할 때는 언제든 호출할 수 있다는 점이 아주 중요하다. (factory 함수라는 이름이 중요한 게 아니라.)

객체를 리턴함으로써, 우리는 간단한 함수 체인을 사용할 수 있고, 코드를 한 줄로 만들 수 있다.

## 이 이걸 사용하는 게 좋을까?

물론, **팩토리** 패턴을 (단지 자기 자신만이 아니라) 모든 클래스의 모든 객체를 만들기 위해 사용할 수도 있다. 이 경우에, 이름에 기반해 객체를 만들기 위해 팩토리 함수에 클래스 이름 파라미터를 넘겨 준다.

아래 예제를 보라.

<pre class="brush:php">&lt;?php
class Builder
{
    public static function factory($sClassName)
    {
        return new $sClassName;
    }
}

$oUser = Builder::factory("User");
?&gt;</pre>

이 패턴이 어떤 쓸모가 있을지 머리를 싸매지 말고, 이 패턴이 우리가 좀더 쉽게 일하도록 해 준다는 점을 상기하라. 만약 당신이 객체와 클래스를 다룬다면, 당신은 결국 팩토리 패턴을 사용할 때 완벽하게 처리할 수 있는 그런 상황에 직면할 것이다.

팩토리 패턴은 다른 객체나 클래스의 상태에 기반해 다른 방식으로 객체를 초기화하고 싶을 때 특별히 유용할 것이다. [1,2,3에 따라 각기 다른 객체를 생성한다거나 하는 거.] 이런 경우, 팩토리 클래스는 객체를 올바른 방식으로 초기화할 수 있다. [팩토리 패턴을 사용해야 하는] 또다른 이유는 초기화하려는 객체에 기반해 올바른 파일을 자동으로 불러온다는 점이 되겠다.

팩토리 패턴에 대해 더 알고 싶다면, [PHP 공식 문서][2]를 강력히 추천한다. 질문이 있다면 댓글 남겨라.

 [1]: http://www.webgeekly.com/tutorials/php/how-to-create-a-php-factory-pattern/
 [2]: http://php.net/manual/kr/language.oop5.patterns.php