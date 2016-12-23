---
title: '[MySQL] PASSWORD() 함수의 결과값이 달라졌을 때 (MySQL 4.1부터 달라짐)'
author: 안형우
layout: post
permalink: /archives/3120
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36574968
categories:
  - 서버단
tags:
  - PHP
---
MySQL 버전이 4.1대로 넘어오면서 MySQL 함수인 `PASSWORD()`의 암호화 방법이 달라졌다고 한다. 이전의 `PASSWORD()` 함수는 16자리 결과물(해시값)을 내놓는 데 반해 새로운 `PASSWORD()` 함수는 41자리 결과물을 내놓는다.

사용자 인증시 `PASSWORD()` 함수를 사용하고 있었다면, MySQL 버전이 달라졌을 때 난감해진다. 이 때 가장 간단한 대처법은, PHP인 경우 코드에 다음 값을 추가해 주는 것이다.

<pre class="brush: php; gutter: true; first-line: 1">//mysql 연결을 한 뒤
@mysql_query( &#039;set old_passwords = 1 &#039;);</pre>

이렇게 하면 문제가 해결된다.

## 다른 방법 1. `my.cnf` 에 `old_password = 1` 추가

다른 방법은 내가 실제로 해 보지는 않아서 사소한 정확성이 떨어질 수 있다.

`/etc/my.cnf` 파일을 찾아서 `old_password = 1` 이라는 옵션을 추가해 주면 해결된다고 한다. (`my.cnf` 파일의 위치는 사용하고 있는 운영체제에 따라 다르다. 그리고 운영체제가 같아서 MySQL을 어떻게 설치해서 사용하고 있냐에 따라 다르다. `/etc/my.cnf` 는 리눅스 기본 설치 기준인 듯하다.)

## 다른 방법 2. `OLD_PASSWORD()` 함수를 사용

만약 소스 코드를 확실하게 관리할 수 있고, DB 때문에만 문제가 생긴 거라면, MySQL 쿼리 부분의 `PASSWORD()` 함수를 OLD_PASSWORD() 함수로 변경해 준다. 그러면 깔끔하게 해결될 거다.

## 다른 방법 3. PHP로 대체

PHP 함수를 뒤져 보니 `old_password()`를 구현해 놓은 걸 찾을 수 있었다. 이걸 사용할 수도 있다.

<pre class="brush: php; gutter: true; first-line: 1">function old_password($password) {
	$nr=0x50305735;
	$nr2=0x12345671;
	$add=7;
	$charArr = preg_split("//", $password);
	foreach ($charArr as $char) {
		if (($char == &#039;&#039;) || ($char == &#039; &#039;) || ($char == &#039;\t&#039;)) continue;
		$charVal = ord($char);
		$nr ^= ((($nr & 63) + $add) * $charVal) + ($nr &lt;&lt; 8);
		$nr2 += ($nr2 &lt;&lt; 8) ^ $nr;
		$add += $charVal;
	}
	return sprintf("%08x%08x", ($nr & 0x7fffffff), ($nr2 & 0x7fffffff));
}</pre>