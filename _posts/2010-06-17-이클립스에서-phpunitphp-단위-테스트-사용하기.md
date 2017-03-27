---
title: 이클립스에서 PHPUnit(PHP 단위 테스트) 사용하기
author: 안형우
layout: post
permalink: /archives/687
aktt_notify_twitter:
  - yes
daumview_id:
  - 36862032
categories:
  - 서버단
tags:
  - PHP
  - PHPUnit
---
일단, 기본적으로 정보를 얻을 수 있는 곳은 <a href="http://www.phpunit.de/manual/3.6/en/index.html" target="_blank">PHPUnit Support in Eclipse</a>다.

컴퓨터에 PHPUnit가 기본적으로 설치돼 있어야 한다.

이클립스에서 PHPUnit은 플러그인으로 설치하는 게 **아니다**. 실행환경으로 사용한다.

(이 방법 말고 다른 방법도 있는 것 같긴 하다. 플러그인은 아니지만 GUI를 제공해 주는 것 같다. <a href="http://code.google.com/p/phpunit4eclipse/" target="_blank">phpunit4eclipse</a>라는 프로젝트다.)

외부 실행환경 설정을 통해 금방 해결할 수 있다.

메뉴에서&#8230; **Run > External Tools > External Tools Configuration** 을 선택해서 들어간다.

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile6.uf.124F76474D4BC9522992C7.png" alt="" width="580" height="442" />

왼쪽 상단의 **New launch configuration** 을 누른다.

그러면 아래 같은 창이 뜨는데, 적절히 내용을 채운다.

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile10.uf.140B0D534D4BC9520A3316.png" alt="" width="580" height="442" />

우분투의 경우 위와 똑같이 써 주면 된다. 참 쉽다.(수정사항 있다. Arguments는 ${workspace\_loc}${resource\_path} 라고 써야 한다.)

Name 은 이름이다. 자유롭게 붙이면 된다. 당연히 PHPUnit 으로 붙이는 게 나을 거다.

Location 은 PHP 실행파일의 위치다. 우분투는 /usr/bin/php5 다.

Working Directory 는 PHPUnit을 어떤 프로젝트에 적용할 거냐는 거다. Variables 에서 workspace\_loc 를 선택해 주거나 그냥 ${workspace\_loc} 이라고 써 주면 된다.

Arguments 는 PHPUnit을 실행해 주는 명령문인데, PHPUnit의 실행파일명 뒤에 ${workspace\_loc}${resource\_path}를 붙여서 쓴다.

우분투는 /usr/bin/phpunit ${workspace_loc}${resource} 다.

(이런 <a href="http://help.eclipse.org/ganymede/index.jsp?topic=/org.eclipse.platform.doc.user/concepts/concepts-exttools.htm" target="_blank">변수들에 대한 설명은 여기</a>서 볼 수 있다. ${workspace_loc}${resource}는 선택하고 있는 파일의 절대경로를 리턴한다.)

<div>
  <p>
    Run을 눌러 보자. ㅋ 만약 PHPUnit 테스트용 파일이 열려있는 상태라면 콘솔에서 테스트 결과를 볼 수 있을 것이다.
  </p>
</div>

## 오류

만약 &#8220;**Variable references empty selection: ${resource_path}**&#8221; 같은 오류상자가 뜬다면, 왼쪽 프로젝트 익스플로러에서 파일을 선택하지 않았기 때문에. PHPUnit을 실행하기 전에 프로젝트 익스플로러에서 파일을 선택해 주자.

혹은 콘솔에 &#8220;**Argument #1 of PHPUnit\_Util\_Fileloader:checkAndLoad() is no existing file**&#8221; 라는 에러 메시지가 나온다면 경로가 제대로 안 잡힌 거다. ${workspace\_loc}${resource\_path}에 오타는 없는지 찾아 보라.

<div>
  <span class="Apple-style-span" style="line-height: 25px; font-size: 18px; font-weight: bold;">주의할 점</span>
</div>

아마도 class명과 파일명을 일치시켜야 하는 듯하다. 아닐 수도 있다. 확인해 보고 정확하게 쓰겠다.

그리고 파일을 테스트하려면 **Run > External Tools > PHPUnit** 을 선택하면 된다. 그러면 콘솔이 뜨고 테스트가 된다.

뭔가 테스트하고 싶은 분들은 아래 코드를 긁어서 ArrayTest.php 를 만들고 직접 테스트해 보기 바란다.

<pre class="brush:php">require_once &#039;/usr/share/php/PHPUnit/Framework.php&#039;;

class ArrayTest extends PHPUnit_Framework_TestCase
{
    public function testNewArrayIsEmpty()
    {
        // Create the Array fixture.
        $fixture = array();

        // Assert that the size of the Array fixture is 0.
        $this-&gt;assertEquals(0, sizeof($fixture));
    }

    public function testArrayContainsAnElement()
    {
        // Create the Array fixture.
        $fixture = array();

        // Add an element to the Array fixture.
        $fixture[] = &#039;Element&#039;;

        // Assert that the size of the Array fixture is 1.
        $this-&gt;assertEquals(1, sizeof($fixture));
    }
}</pre>

참고로 맨 위의 require_once 에는 실제 경로를 넣어 줘야 한다. 위 경로는 우분투를 기준으로 한 경로다.