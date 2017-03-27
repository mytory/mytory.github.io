---
title: '[우분투] PHPunit 설치와 기본 경로'
author: 안형우
layout: post
permalink: /archives/686
aktt_notify_twitter:
  - yes
daumview_id:
  - 36863188
categories:
  - 서버단
tags:
  - PHP
  - PHPUnit
---
이건 뭐 너무 간단하다.

<div>
  <pre class="brush: bash; gutter: true; first-line: 1">sudo apt-get install phpunit</pre>
</div>

그러면 실행파일은

<div>
  <pre class="brush: bash; gutter: true; first-line: 1">/usr/bin/phpunit</pre>
</div>

이고, 테스트 파일 작성시 require해야 하는 framework.php의 경로는

<div>
  <pre class="brush: bash; gutter: true; first-line: 1">require_once &#039;/usr/share/php/PHPUnit/Framework.php&#039;;</pre>
</div>

이렇게 된다.

그럼 일단 준비는 완료.