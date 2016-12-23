---
title: 코리아 우분투 9.10(코분투), 기본 글꼴 교체하기
author: 안형우
layout: post
permalink: /archives/256
aktt_notify_twitter:
  - yes
daumview_id:
  - 37110649
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
우분투의 한글 기본 글꼴은 &#8216;은 돋움&#8217;이다.

&#8216;은 돋움&#8217;은 괜찮은 글꼴인데, 나는 &#8216;은 돋움&#8217;보다 &#8216;나눔고딕&#8217;이나 &#8216;맑은 고딕&#8217;이 더 마음에 든다.

그래서 우분투 9.10을 노트북 주력 OS로 사용하면서 기본글꼴을 &#8216;나눔고딕&#8217;으로 설정하고 싶었다.

코분투 9.10 2번째 버전부터는 기본글꼴이 나눔고딕으로 변경됐다고 하던데, 내가 깐 것은 코분투 1번째 버전이라서 그렇게 돼 있지 않았다.

그래서 코분투를 2번째 버전으로 다시 깔까 고민하다가, 굳이 그럴 필요가 있나 싶어서 찾아 봤다.

그랬더니 역시 구글, 금세 나왔다.

<a href="http://zodiac12k.egloos.com/1828667" target="_blank">http://zodiac12k.egloos.com/1828667</a>

위 글이 그 글이다.

어쨌든, 요약 설명한다.

<pre class="brush:plain">gksu nautilus</pre>

위를 터미널에서 입력하거나 &nbsp;Alt+F2를 눌러서 뜨는 실행창에 입력한다.

그러면 관리자 권한의 노틸러스(파일 탐색기)를 실행할 수 있다.

자, 그 다음 아래 파일을 gedit 등 에디터 프로그램으로 연다.

<pre class="brush:plain">/etc/fonts/conf.d/69-language-selector-ko-kr.conf</pre>

(내 코분투는 69로 시작하는 파일명이었는데, 29로 시작할 지도 모르겠다.)

그냥 Ctrl+H 나 메뉴의 &#8216;편집 &#8211; 바꾸기&#8217;를 골라서 바꾸기 모드로 들어간다.

UnDotum을 모두 nanumgothic으로 바꾼다.

저장한다.

그러면 끝!