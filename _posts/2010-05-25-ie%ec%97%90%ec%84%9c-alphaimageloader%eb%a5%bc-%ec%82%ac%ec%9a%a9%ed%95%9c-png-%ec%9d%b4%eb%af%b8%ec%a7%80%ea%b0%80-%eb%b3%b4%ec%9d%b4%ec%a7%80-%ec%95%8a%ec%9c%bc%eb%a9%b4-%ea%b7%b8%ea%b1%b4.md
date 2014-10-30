---
title: ie에서 AlphaImageLoader를 사용한 png 이미지가 보이지 않으면, 그건 바로 https 때문
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/617
aktt_notify_twitter:
  - yes
daumview_id:
  - 36915101
categories:
  - 웹 퍼블리싱
tags:
  - IE:인터넷 익스플로러
---
나참, 별 희한한 버그를 다 만난다.

  
얼마전 소개한 <A href="http://fancybox.net/" target=_blank>fancybox</A>가 ie에서 왕창 이상하게 보이는 것이었다. 일단, 투명 png이 하나도 보이지 않아서, 오버레이되는 캡션이랑, 좌우 화살표 그림이 하나도 보이지 않았다.

  
이런 쌍!

  
처음엔 fancybox가 ie를 지원하지 않는 줄 알았다. 그런데 아니었다. 데모는 잘 나왔다.

  
그래서 난 내가 뭘 덜 붙인 줄 알았다. 그런데 아니었다. 붙이라는 거 다 붙였는데도 안 됐다.

  
그래서 고민했다. 뭘까&#8230;

  
fancybox의 css를 뜯어 보니 alphaImageLoader를 사용하고 있었다.

  
그리고 내가 구현한 곳과 fancybox의 유일한 차이는 http와 https라는 차이밖에 없었다.

  
그래서 구글링 시작.

  
<A href="http://www.google.co.kr/search?hl=ko&newwindow=1&q=AlphaImageLoader+https&aq=f&aqi=&aql=&oq=&gs\_rfai=" target=\_blank>alphaImageLoader https로 검색</A>했다. 그리고 찾았다. <A href="http://betabug.ch/blogs/ch-athens/857" target=_blank>PNG, Transparency, IE6, AlphaImageLoader, and SSL</A>이라는 글을 말이다. 이 글에는 <A href="http://code.google.com/p/google-web-toolkit/issues/detail?id=1172" target=_blank>PNG와 IE, 그리고 SSL 관계의 전말을 밝힌 글도 링크</A>돼 있었다.(이 글타래에서도 <A href="http://code.google.com/p/google-web-toolkit/issues/detail?id=1172#c10" target=_blank>10번째 댓글</A>이 가장 명확하게 설명하고 있다.) 그리고 해결책도 제시돼 있었다.

  
그런데 영어가 딸려서 뭔 말인지 잘은 모르겠다 ㅡㅡ;; 각잡고 해석해야 될 것 같다. 지금은 말고;;

  
여튼간에 대충 보면, https를 사용하면 캐시를 하지 않고, 알파 이미지 로더에는 캐시가 꼭 필요한데, 캐시를 안 하니깐 열라 받아오고 날아가고 받아오고 날아가고 하면서 안 보이게 된다 뭐 이런 이야기같다. 물론 내 번역을 신뢰하지 말기 바란다.

  
여튼간에, 그래서 해결책은 https의 보호에서 png를 제거해 버리는 거라고 한다. 그래서 서버쪽에서 처리해 줘야 하는 것 같은데, 톰캣이랑 글래스피쉬만 나와 있지, 내가 사용하는 아파치에 관한 건 안 나와있다. 쌍.

  
어쨌든, 원인을 알게 되어 기분좋다. 내가 만지는 사이트는 정식 오픈하면 https는 사용하지 않을 테니 상관없다.