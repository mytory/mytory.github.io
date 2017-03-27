---
title: 워드프레스 3.2를 소개한다. 자기 PHP 버전을 확인하라.
author: 안형우
layout: post
permalink: /archives/1431
aktt_notify_twitter:
  - yes
daumview_id:
  - 36703463
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스 3.2가 나와서 천천히 업데이트하려고 생각하고 있었다. 플러그인들이 제대로 작동을 해야 하니까.

뭐가 바뀌었나 궁금해서 들어가 봤다.

그런데 &#8220;요구사항 변화&#8221; 항목이 눈에 띄었다.

그리고 거기엔 이렇게 씌어 있었다.(번역했다.)

*   [PHP][1] 5.2.4 이상 (예전 요구 사항 &#8211; [WordPress 2.5][2]부터 PHP 4.3 이상)
*   [MySQL][3] 5.0.15 이상 (예전 요구 사항 &#8211; [WordPress 2.9][4]부터 MySQL 4.1.2 이상)

그래서 내 PHP와 MySQL 버전을 알아 봤다. 나는 dothome에서 서비스를 받고 있다.

PHP 버전은 5.2.10 이었고, MySQL은 5.1.38 이었다.

5.2.10 < 5.2.4 따라서 나는 깔 수 없다.????

그런데 문득 이런 생각이 들었다. 이게 PHP 버전이 5.2.9 -> 5.2.10 -> 5.2.11 이런 식으로 나가는 게 아닐까?

[PHP Changelog][5]로 검색해 봤다.

찾아 봤더니 5.2.4는 2007년에 출시됐고, 5.2.10은 2009년에 출시됐다. 와우~! 내 생각이 맞았다.

즉, dothome에 호스팅받고 있는 유저들은 (아마도) 업데이트해도 되는 듯하다. 서버별로 다를 수 있지만 말이다.

그래서 한 달쯤 있다가 플러그인들의 업그레이드 상황을 보고 업데이트할 생각이다.

## 워드프레스 3.2의 주요 특징

이번 버전의 주요 특징 네 가지는 아래와 같이 소개돼 있다.(번역했다.) 빨리 보고 싶은걸.

*   **관리자 UI를 새로 고쳤다** &#8211; Admin 재디자인
*   **새로운 기본 테마 &#8220;Twenty Eleven&#8221;** &#8211; 최신 [테마 기능][6] 사용
*   **전체 화면 에디터** &#8211; 방해 없이 글을 작성할 수 있음
*   **확장 Admin 바** &#8211; 사이트를 제어할 수 있는 더 유용한 링크들

그리고 눈에 띄는 것은 IE6 지원을 중단하는 것, IE7 지원 중단을 시작하는 것, 지원하지 않는 브라우저를 부드럽게 알려 주는 것이다.

추가로 여러 가지 언급이 있는 것은 빠르고 가벼워졌다는 건데 사용해 보면 알겠지.

이상이다.

&nbsp;

 [1]: http://codex.wordpress.org/Glossary#PHP "Glossary"
 [2]: http://codex.wordpress.org/Version_2.5 "Version 2.5"
 [3]: http://codex.wordpress.org/Glossary#MySQL "Glossary"
 [4]: http://codex.wordpress.org/Version_2.9 "Version 2.9"
 [5]: http://php.net/ChangeLog-5.php
 [6]: http://codex.wordpress.org/Theme_Features "Theme Features"