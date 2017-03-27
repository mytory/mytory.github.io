---
title: php session_start()만 있는데 에러가 난다면?
author: 안형우
layout: post
permalink: /archives/12
aktt_notify_twitter:
  - yes
daumview_id:
  - 37272848
categories:
  - 서버단
tags:
  - PHP
---
<?  
session_start();  
?>

이렇게 달랑 하나 있는데 에러 메세지가 떴다. 에러 메세지는 다음과 같았다.

Warning: session\_start() [function.session-start]: Cannot send session cache limiter &#8211; headers already sent (output started at C:\APM\_Setup6\htdocs\index.php:1) in C:\APM_Setup6\htdocs\ndex.php on line 1 

구글 번역기를 돌려 보니 &#8220;세션 캐시를 보낼 수없습니다 리미 &#8211; 헤더를 이미 보낸&#8221;이라고 나왔다.

즉, 헤더를 이미 보냈기 때문에 세션을 시작할 수 없다는 뜻이다.

php에서 세션 관련 함수, 헤더 관련 함수는 어떤 출력(echo나 html 문자)도 있기 전에 와야 한다는 건 익히 알고 있었지만, 그렇게 했는데도 에러가 나는 것은 처음이었다.

<a target="_blank" href="http://phpschool.com/gnuboard4/bbs/board.php?bo_table=qna_function&wr_id=272855&sca=&sfl=wr_subject%7C%7Cwr_content&stx=%BC%BC%BC%C7&sop=and">phpschool.com에 물어본 결과</a>, <span style="font-weight: bold;">utf-8 BOM</span>이라는 놈과 관련있다는 사실을 알게 됐다.

이건 UTF-8,16,32에서 이 페이지의 인코딩이 뭘로 돼있는지, 알려주기 위해 문서 맨 앞에 삽입하는 것인데, 이 때문에 <span style="font-weight: bold;">session_start()</span>를 하기 전에 html 출력이 있었던 것처럼 처리되는 것이다.(utf-8은 선택, utf-16,32는 필수다.)

만약 php가 이런 부분까지 해결해 준다면 좋겠지만, 아직 지원이 안 된다고 한다.

해결방법은, 에디트 플러스 같은 에디터에서 설정파일을 뒤지는 것이다.

에디트플러스의 경우 : 메뉴 &#8211; 문서 &#8211; 영구적인 설정 &#8211; 파일 &#8211; UTF-8 식별기호 &#8211; 항상 식별기호 제거

이렇게 선택한 다음, 한 번 저장을 해 주면 된다.

원래 <span style="font-weight: bold;">UTF-8 BOM</span>은 인코딩 인식을 편리하게 하도록 해 주기 위한 장치다. 편리를 위한 것이다.

php가 아직 불완전하기 때문에 문제가 되는 것 같다. 빨리 해결됐으면 좋겠다.