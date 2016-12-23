---
title: javascript 애니메이션 메뉴 코딩시 유의점
author: 안형우
layout: post
permalink: /archives/235
aktt_notify_twitter:
  - yes
daumview_id:
  - 37121781
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
플래시로 된 네비게이션 메뉴를 자바스크립트로 바꿔달라는 의뢰가 들어왔다.

이유는 간단하다. 플래시는 정부에서 지정한 표준 코딩 검사를 통과하지 못하기 때문이다.(플래시를 유지하려 할 경우 장애인을 위한 대체 링크, noscript인 경우의 페이지를 반드시 보여야 하는 것 같다. 정확한 내용은 <a href="http://www.wah.or.kr" target="_blank">웹접근성연구소</a> 문서를 참고하기 바한다.)

<a href="http://www.google.com/search?sourceid=chrome&ie=UTF-8&q=jquery+dropdown+menu" target="_blank">jquery dropdown menu로 검색</a>을 하면 엄청나게 많은 메뉴 방법이 나온다. 그런데 <http://shc.or.kr/>&nbsp;형태의 메뉴는 잘 나오지 않았다.

그래서 그냥 알아서 구현을 해 보기로 했다. 어차피 그림도 엄청나게 많아서 일일이 노가다로 만들어야 하기도 했다.(메뉴는 text로 하는 게 가장 낫다. alt 넣은 이미지는 차선책이다.)

## 핵심은 visibility:hidden

아래를 보자. 마우스를 여러번 왔다갔다 하면 재밌는 일이 벌어진다. <a href="http://www.youtube.com/watch?v=fk7gum_SJeE" target="_blank">메뉴가 지 멋대로 계속 움직인다.(</a><a href="http://www.youtube.com/watch?v=fk7gum_SJeE" target="_blank">동영상 참고</a>)

### 메뉴가 지 멋대로 계속 움직이는 경우

<ul class="menutest1">
  <li>
    메뉴1 <ul>
      <li>
        메뉴1-1
      </li>
      <li>
        메뉴1-2
      </li>
    </ul>
  </li>
  
  <li>
    메뉴2 <ul>
      <li>
        메뉴2-1
      </li>
      <li>
        메뉴2-2
      </li>
    </ul>
  </li>
</ul>



<pre class="brush:html">&lt;ul class="menutest1"&gt;
  &lt;li&gt;메뉴1
    &lt;ul&gt;
      &lt;li&gt;메뉴1-1&lt;/li&gt;
      &lt;li&gt;메뉴1-2&lt;/li&gt;
    &lt;/ul&gt;
  &lt;/li&gt;
  &lt;li&gt;메뉴2
    &lt;ul&gt;
      &lt;li&gt;메뉴2-1&lt;/li&gt;
      &lt;li&gt;메뉴2-2&lt;/li&gt;
    &lt;/ul&gt;
  &lt;/li&gt;
&lt;/ul&gt;</pre>

<pre class="brush:js">jQuery(function(){
  var $ = jQuery;
  $(&#039;.menutest1 li ul&#039;).hide();
  $(&#039;.menutest1 li&#039;).hover(function(){
    $(this).children().show(&#039;slow&#039;);
  }, function(){
    $(this).children().hide(&#039;slow&#039;);
  })
});
</pre>

### 메뉴가 안 닫히고 남아있는 경우

또다른 경우는 <a href="http://www.youtube.com/watch?v=Ww0-e646cTk" target="_blank">하위메뉴가 안 닫히고 겹쳐서 나오게 되는 경우(동영상)</a>다.

<ul class="menutest2">
  <li>
    메뉴1 <ul>
      <li>
        메뉴1-1
      </li>
      <li>
        메뉴1-2
      </li>
    </ul>
  </li>
  
  <li>
    메뉴2 <ul>
      <li>
        메뉴2-1
      </li>
      <li>
        메뉴2-2
      </li>
    </ul>
  </li>
</ul>



<pre class="brush:css">.menutest2{position:relative;width: 600px; height:60px;}
.menutest2 li{float:left; margin-left:20px;}
.menutest2 li ul{width:500px;position:absolute;top:20px;}
.menutest2 li ul li{float:left; margin-left:20px;}
</pre>

<pre class="brush:js">jQuery(function(){
  var $ = jQuery;
  $(&#039;.menutest2 li ul&#039;).hide();
  $(&#039;.menutest2 li&#039;).hover(function(){
    $(this).children().show(&#039;slow&#039;);
  }, function(){
    $(this).children().hide();
  })
});</pre>

위 경우는 마우스가 메뉴1이나 메뉴2의 밖으로 빠져 나올 경우 hide() 함수를 사용해 하위메뉴를 닫을 때 애니메이션 효과를 사용하지 않았다. 그런데, 이번에는 하위메뉴가 사라지지 않는 버그가 생겼다.

애니메이션으로 하위메뉴가 다 열리기 전에 마우스가 상위메뉴에서 빠져나오는 경우에 이런 경우가 생긴다. 

이유는 간단하다. hide() 함수는 display:none 으로 css를 만드는 함수다. 그런데 애니메이션이 지속되고 있을 때 display:none을 시키면 잠깐 동안 안 보인 다음 애니메이션은 계속 작동하면서 다시 보이게 되는 것이다.

그래서 사용해야 하는 게 css의 visibility:hidden 속성이다.

### 제대로 된 애니메이션 메뉴



<ul class="menutest3">
  <li>
    메뉴1 <ul>
      <li>
        메뉴1-1
      </li>
      <li>
        메뉴1-2
      </li>
    </ul>
  </li>
  
  <li>
    메뉴2 <ul>
      <li>
        메뉴2-1
      </li>
      <li>
        메뉴2-2
      </li>
    </ul>
  </li>
</ul>

<pre class="brush:js">jQuery(function(){
  var $ = jQuery;
  $(&#039;.menutest3 li ul&#039;).hide();
  $(&#039;.menutest3 li&#039;).hover(function(){
    $(this).children().css({visibility: &#039;visible&#039;,display: &#039;none&#039;}).show(&#039;slow&#039;);
  }, function(){
    $(this).children().css(&#039;visibility&#039;,&#039;hidden&#039;);
  })
});</pre>

위 코드가 제대로 된 애니메이션 메뉴를 만드는 코드다.

핵심은 간단하다. 마우스가 범위를 떠났을 때는 visibility만 hidden으로 만든다. 그러면 display에 상관없이 일단 메뉴는 닫히게 된다.

마우스가 메뉴1,2에 올라갔을 때 visibility를 visible로 만들고 display를 none으로 만든 다음 애니메이션을 시작한다. 이 과정이 연속적으로 이루어지기 때문에 이미 실행되고 있던 애니메이션은 작동을 멈추게 되는 것 같다.

위 코드와 css를 바탕으로 제대로 된 애니메이션 메뉴를 만들 수 있기 바란다.

이 예제를 파일로 첨부한다.

<a href="/uploads/legacy/old-images/1/cfile25.uf.177112514D4BC88325016C.zip" class="aligncenter" />cfile25.uf.177112514D4BC88325016C.zip</a>