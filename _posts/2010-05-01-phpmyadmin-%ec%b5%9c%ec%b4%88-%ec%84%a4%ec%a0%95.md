---
title: phpMyAdmin 최초 설정
author: 안형우
layout: post
permalink: /archives/549
aktt_notify_twitter:
  - yes
daumview_id:
  - 36962340
categories:
  - 서버단
tags:
  - PHP
---
군데군데 흩어져 있는 설명은 별로 맘에 들지 않는다. 설명이 제각각이고 그 방법 말고는 다른 방법이 없는 것처럼 설명하는 게 맘에 안 든다. 물론 나도 그런 식으로 설명할 때가 있다는 걸 안다. 하지만 phpMyAdmin 같은 대중적인 프로그램은 좀더 정확한 설명이 필요하지 않나 싶다.

그리고 핵심은, 프로그램 홈페이지에 가서 <a href="http://www.phpmyadmin.net/documentation/" target="_blank">document 항목</a>을 보는 것이다. 거기에 기초 설명이 돼 있다. 응용은 알아서 하는 것이지만, 기초가 없다면 응용도 제대로 할 수 없다는 것은 수학시간에만 맞는 말은 아니다. 프로그래밍도 같다.

여튼간에, <a href="http://www.phpmyadmin.net/" target="_blank">phpMyAdmin</a>을 깔 때마다 블로그에서 설정방법을 찾아 보고 간혹 안 되서 헤매는 경우도 있고 했는데 오늘은 그냥 phpMyAdmin 홈페이지의 설명을 찾아 봤다. 진작에 찾아 볼 걸 하는 생각이 들었다. 

여튼, 필요가 당장 급한 사람은 아래 파일을 사용하면 된다. 아, 내 phpMyAdmin 버전은 3.3.2다.

<a href="/uploads/legacy/old-images/1/cfile23.uf.147962544D4BC8F21FA64E" class="aligncenter" />cfile23.uf.147962544D4BC8F21FA64E</a>

내가 여기 인용한 부분은 <a href="http://www.phpmyadmin.net/documentation/#quick_install" target="_blank">Quick Install 부분</a>이다. 이 방법을 사용해서 config.inc.php 파일을 만들면 우리가 흔히 마주하는 phpMyAdmin 화면을 볼 수 있다. 웹 로그인 창이다.

<img src="/uploads/legacy/old-images/1/cfile29.uf.142A68484D4BC8F2299277.jpg" class="aligncenter" width="409" height="393" alt="" />

수동으로 config.inc.php 파일을 만들고 아래 내용을 채워 넣으면 된다고 돼 있다. config.sample.inc.php 파일을 사용할 수도 있다고 써 있다. 여튼 아래 코드가 핵심이다.

<pre class="brush:php">$cfg[&#039;blowfish_secret&#039;] = &#039;ba17c1ec07d65003&#039;;  // 아무거나 채워 넣으면 된다.

$i=0;
$i++;
$cfg[&#039;Servers&#039;][$i][&#039;auth_type&#039;]     = &#039;cookie&#039;;
</pre>

위에서 $cfg['blowfish_secret'] 에 들어가는 것은 아무거나 넣으면 된다. 나도 아무거나 넣었다. 예컨대 이런 거 말이다. T^UIGHF^R^r76uygt87y8 한글로 해도 되는지는 안 해봤다;;

이 내용을 채워서 phpMyAdmin 폴더의 루트에 두면 된다. 간단하다.

다음, 굳이 로그인 과정을 거치지 않도록 만드는 방법도 있다. 이 방법은 당연히, 관리자 로그인 같은 게 돼 있을 때만 config.inc.php 를 읽을 수 있도록 세션 체크를 해야 할 거다. 안 그러면 DB를 만천하에 공개하는 게 되니 말이다.

여튼 아래처럼 만들 수도 있다.

<pre class="brush:php">$i=0;
$i++;
$cfg[&#039;Servers&#039;][$i][&#039;user&#039;]          = &#039;아이디&#039;;
$cfg[&#039;Servers&#039;][$i][&#039;password&#039;]      = &#039;비밀번호&#039;; // 여기 비밀번호를 넣어라
$cfg[&#039;Servers&#039;][$i][&#039;auth_type&#039;]     = &#039;config&#039;;
</pre>

간단하다.

지금까지 설정땜에 고생한 거 생각하면 살짝 화난다. 이 외에도 다양한 설정법이 있다. 필요하면 사용하게 될 테고, 사용하면 설명도 적도록 하겠다. 당장 되지는 않을 거다.

이상.