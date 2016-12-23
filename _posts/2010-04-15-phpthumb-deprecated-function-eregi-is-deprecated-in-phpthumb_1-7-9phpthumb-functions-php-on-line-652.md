---
title: '[phpThumb] Deprecated: Function eregi() is deprecated in /phpThumb_1.7.9/phpthumb.functions.php on line 652'
author: 안형우
layout: post
permalink: /archives/510
aktt_notify_twitter:
  - yes
daumview_id:
  - 36974098
categories:
  - 서버단
tags:
  - PHP
  - phpThumb()
---
phpThumb()를 설치하고 기능을 체크해봤다. 그런데 아래와 같은 메시지가 주욱 떴다.

&nbsp;

<pre class="brush:plain">Deprecated: Function eregi() is deprecated in /var/www/phpThumb_1.7.9/phpthumb.functions.php on line 652</pre>

&nbsp;

Deprecated는 향후 지원을 하지 않을 계획이므로 권장하지 않는다는 말이다.

위 문장을 해석하면 eregi() 함수는 향후 지원하지 않을 것이므로 쓰지 말라는 거다. 즉, 경고 메시지.(실제로 PHP6부터는 함수가 없어진다고 한다.) PHP 5.3이면 위 메시지가 나온다고 한다. 그 이하 버전에서는 등장하지 않을 듯.

정리하면? 경고 메시지이지 에러가 아니고, 정상작동한다.

그럼, 두 가지 방법이 있겠다.

(1)저 함수를 다 고친다.

(2)경고 메시지를 출력하지 않게 만든다.

남이 만든 라이브러리를 일일이 수정할 자신은 없으니(물론 <a href="http://nthinking.net/index.html#reDeprec.html" target="_blank">자동으로 수정해 주는 프로그램</a>도 있다고 한다.) 경고 메시지만 출력하지 말자.

&nbsp;

<pre class="brush:php">error_reporting(E_ALL ^E_DEPRECATED);</pre>

&nbsp;

위 코드를 실행 전에 넣어 주면 된다고 한다.(<a href="http://www.sitehis.com/spb3/sboard3/read.php?db=talk&cateuid=4&uid=167" target="_blank">참고한 글</a>)

자, phpThumb.php에 바로 위 코드를 넣으면 되는 거다.

phpThumb.php를 열면, 맨 위쪽에 비슷한 코드가 보인다.

&nbsp;

<pre class="brush:php">error_reporting(E_ALL);
ini_set(&#039;display_errors&#039;, &#039;1&#039;);</pre>

&nbsp;

12째 줄의 위와 같은 코드를 찾아서&#8230;

&nbsp;

<pre class="brush:php">error_reporting(E_ALL ^E_DEPRECATED);
ini_set(&#039;display_errors&#039;, &#039;1&#039;);</pre>

&nbsp;

이렇게 고쳐 준다.

그러면 만사 오케이.

이 다음부터는 위 에러가 뜨지 않을 거다.

## 모든 deprecated에 대처해 보자. php.ini를 고치는 방법

php.ini를 고쳐 보자.

지금은 사라진 http://bugs.php.net/23610 라는 주소의 페이지에서 대책을 찾을 수 있었다.

아래처럼 고치란다. 시키는대로 해 보자.

&nbsp;

<pre class="brush:plain">error_reporting = E_ALL & ~E_DEPRECATED</pre>

&nbsp;

위처럼 쓰면 에러 보고를 전부 하되, DEPRECATED 의 경우만 하지 말라는 뜻이 된다. 자세한 내용은 <a href="http://www.php.net/manual/en/errorfunc.configuration.php#ini.error-reporting" target="_blank">PHP 사이트에서</a> 보면 된다.

위처럼 했는데 안 될 경우 E\_ALL 대신 E\_ERROR을 써 보자. 그럼 에러만 출력하라고 하는 거니까 말이다.

당연히 아파치를 재시작해 줘야 한다. 우분투 사용자라면 터미널에서 아래 명령을 친다. 영 모르겠으면 걍 컴터를 재부팅해라.

&nbsp;

<pre class="brush:plain">sudo /etc/init.d/apache2 restart</pre>

&nbsp;

그러니까 경고 메시지가 말끔히 사라졌다.