---
title: "$_SERVER['DOCUMENT_ROOT']와 dirname(__FILE__)"
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/6
aktt_notify_twitter:
  - yes
daumview_id:
  - 37275392
categories:
  - 서버단
tags:
  - PHP
---
`$_SERVER['DOCUMENT_ROOT']`는 현재 파일의 절대 경로를 리턴해 주는 함수죠.  
그런데 이놈이 종종 문제를 일으킵니다. 제대로된 경로를 돌려주지 않는 경우가 있는 거죠.

들어 보니 PHP 고수들은 `$_SERVER['DOCUMENT_ROOT']`를 사용하지 않는다고 하더라고요.(그냥 카더라입니다.)  
`$_SERVER['DOCUMENT_ROOT']` 변수 대신에 다음 변수를 사용해 보시면 될 것 같습니다.  
이 변수(?)는 현재 디렉토리를 리턴해 줍니다.

<pre class="brush: php; gutter: true; first-line: 1; highlight: []; html-script: false">dirname(__FILE__)</pre>

그러면 제대로 출력이 되는 것을 확인하실 수 있을 겁니다.  
`$_SERVER['DOCUMENT_ROOT']`가 왜 제대로 작동하지 않는 경우가 있는 것인지 알고 있으신 분 있다면 댓글 달아 주세요. 저도 이놈 때문에 고생좀 했거든요.

이 팁은 [`$_SERVER['DOCUMENT_ROOT']` problem 이라는 글에 Chris..S라는 사람이 달아놓은 댓글][1]을 참고했습니다.

영어 잘 못해서 대충 알아먹은 거지만요.

그럼이만 ^^

## 추가 : 직접 입력이 가장 깔끔한 듯?

추가로 좀 더 생각을 해봤습니다. 제 생각에 가장 깔끔한 것은 직접 입력하는 것이라고 결론내렸습니다.

설치형 블로그 텍스트큐브의 경우 `config` 파일에 직접 주소들을 입력하도록 하죠. fckeditor도 주소를 입력하도록 합니다.

어떤 경우라도 에러는 발생할 수 있는 것 같고, 유연성을 최대로 하기 위해서는 직접 입력받은 것을 사용하는 게 최선인 듯합니다.

config.class.php를 하나 만들어 두고 거기에 절대경로 루트, 상대경로 루트, 루트 주소를 가리키는 URI를 넣도록 하면 나머지는 쉽게 해결될 것이라고 생각합니다.

단, 이미 만들어진 것을 고쳐야 하는 경우는 골치아플 수 있겠죠. 그럴 때는 위의 팁을 사용할 수 있다고 봅니다.

 [1]: http://csscreator.com/node/10972#comment-46501