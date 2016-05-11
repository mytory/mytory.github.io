---
title: '[tip] 페이지 하단에 깜빡거리는 배너 광고 &#8211; realclick 정지시키기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/667
aktt_notify_twitter:
  - yes
daumview_id:
  - 36869056
categories:
  - 웹 퍼블리싱
tags:
  - javascript
---
요즘 나를 완전 짜증으로 몰아넣는 광고 유형이 생겼다. realclick이라는 놈인데, 도대체 이딴 광고를 왜 만드는지 모르겠다. 광고비를 많이 지급하는지 꽤 많은 언론이 이런 유형의 광고를 달았다. 헐이다.

<div class="mceTemp mceIEcenter">
  <dl>
    <dt>
      <img src="/uploads/legacy/old-images/1/cfile1.uf.17571A4F4D4BC94F18CC13.png" alt="" width="580" height="152" />
    </dt>
    
    <dd>
      △닫아도 닫아도 계속 뜨는 미친 광고
    </dd>
  </dl>
</div>

꺼도 꺼도 계속 부활해서 사람을 짜증나게 만든다.  
여튼간에, 이놈을 정지시킬 수 있게 코드를 만들어봤다.  
몇몇 사이트에서만 테스트했기 때문에 내 코드가 동작하지 않는 사이트가 있을지도 모른다.  
아래 링크를 즐겨찾기(북마크)에 드래그해서 넣고, realclick이란 놈이 성가시게 할 때마나 눌러 주거나,  
<a href="javascript:jQuery(window).unbind('scroll');jQuery(window).unbind('resize');clearTimeout();" target="_blank">realclick 정지</a>  
아래 코드를 긁어서 즐겨찾기(북마크)의 url 부분에 넣어 즐겨찾기(북마크)를 만들고 눌러주면 된다.

<pre>javascript:jQuery(window).unbind(&#039;scroll&#039;);jQuery(window).unbind(&#039;resize&#039;);clearTimeout();</pre>

그렇게 하면 더이상 성가시게 깜빡이지 않을 거다.  
단, 이미 떠 있는 놈은 닫기 버튼을 눌러 주시라. 다시는 부활하지 못할 거다.  
이거 무슨, 죽여도 죽여도 부활하는 대마왕 한 놈 때려잡은 기분이다.

<div>
  &#8212;-
</div>

다른 방법도 발견했다. 이건 <a title="마우스오버 오토팝업 키워드광고를 막아보자!" href="http://lazypawn.egloos.com/3160130" target="_blank">광고를 보내는 사이트를 원천 차단하는 방법</a>이다. 링크타고 들어가서 나오는 차단 목록을 링크 타고 들어간 글에서 설명하는 방식대로 차단하면 된다.