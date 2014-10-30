---
title: 마우스 오른쪽 클릭 금지, 가장 간단하고 완벽한 해제 방법
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/226
aktt_notify_twitter:
  - yes
daumview_id:
  - 37135641
categories:
  - 기타
tags:
  - TIP
---
네이버 블로그의 마우스 우클릭 금지는 시중에 나와 있는 <a href='javascript:function%20r(d){d.oncontextmenu=null;d.onselectstart=null;d.ondragstart=null;d.onkeydown=null;d.onmousedown=null;%20d.body.oncontextmenu=null;d.body.onselectstart=null;d.body.ondragstart=null;d.body.onkeydown=null;%20d.body.onmousedown=null;};function%20unify(w){r(w.document);if(w.frames.length>0){for(var%20i=0;i<w.frames.length;i++){try{unify(w.frames[i].window);}catch(e){}};};};unify(self);alert("%ED%95%B4%EC%A0%9C%20%EC%99%84%EB%A3%8C!");' target="_self">우클릭 해제 스크립트</a>(끌어다가 즐겨찾기에 갖다 놓고 우클릭 금지돼 있는데서 클릭해 주면 우클릭 금지가 해제된다.) 등으로 해결이 안 된다. 심지어 크롬의 확장인 <a href="http://mytory.textcube.com/entry/%EA%B5%AC%EA%B8%80-%ED%81%AC%EB%A1%AC-%ED%99%95%EC%9E%A5-%EC%98%A4%EB%A5%B8%EC%AA%BD-%ED%81%B4%EB%A6%AD-%EA%B8%88%EC%A7%80-%ED%95%B4%EC%A0%9C-allow-right-click" target="_blank">allow right click 플러그인</a>으로도 해제가 안 된다.

그러나 이 방법을 사용하면 100% 해결된다. 우클릭 금지 자체를 원천적으로 막는 방법이기 때문이다.

너무 간단해서 어이가 없으심일 수도 있다.(단, 아래 주의사항을 꼭!!!! 읽어야 한다.)

아래 그림은 **<a href="http://www.mozilla.or.kr/" target="_blank">파이어폭스</a>의 환경설정 화면**이다. 내용 탭에서 **자바스크립트 사용**을 체크해제해 준다.

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile10.uf.116287504D4BC8821D511E.png" class="aligncenter" width="575" height="581" alt="" />

위 그림처럼 &#8216;자바스크립트 사용&#8217;을 체크해제한다.

그리고 해당 페이지를 새로고침(F5)한다.

간단하게 해결&#8230;

우클릭 금지 자체가 자바스크립트를 사용한다는 점을 생각해 보면 왜 이 방법으로 금세 우클릭 금지를 해제할 수 있는지 알 수 있을 것이다.

## !!!주의!!!

원하는 텍스트를 긁은 다음에는 다시 사용 체크해 줘야 한다. 자바스크립트를 끄면 제대로 안 돌아가는 사이트가 왕창 많기 때문이다.