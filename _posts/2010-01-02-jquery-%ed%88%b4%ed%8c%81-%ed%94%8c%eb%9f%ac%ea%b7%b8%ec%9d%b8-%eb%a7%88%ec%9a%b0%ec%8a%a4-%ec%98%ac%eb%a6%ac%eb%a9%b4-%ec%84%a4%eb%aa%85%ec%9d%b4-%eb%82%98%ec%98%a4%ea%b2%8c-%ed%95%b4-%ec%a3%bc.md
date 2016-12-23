---
title: 'jQuery 툴팁 플러그인 &#8211; 마우스 올리면 설명이 나오게 해 주는 플러그인'
author: 안형우
layout: post
permalink: /archives/184
aktt_notify_twitter:
  - yes
daumview_id:
  - 37163287
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
(더 다양한 툴팁은 다음 글을 참고하시면 도움이 됩니다: <a href="http://speckyboy.com/2009/09/16/25-useful-jquery-tooltip-plugins-and-tutorials/" rel="bookmark">25 Useful jQuery Tooltip Plugins and Tutorials</a>)

다음 아고라나 view에는 제목을 다 보여 주지 못해서 말줄임표를 쓴 곳이 많습니다.

아래는 다음에서 볼 수 있는 툴팁입니다.

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile6.uf.160D07494D4BC87C259EA6.png" alt="" width="341" height="324" />

사실 가장 간단한 툴팁은 title 어트리뷰트를 사용하는 것입니다. 아래처럼요.

<pre class="brush:html">&lt;a href="/" title="첫 화면으로 이동합니다"&gt;첫 화면&lt;/a&gt;</pre>

그런데 저는 title 어트리뷰트가 맘에 안 듭니다. 반응 속도가 느리기 때문입니다. 마우스를 올리고 0.5초쯤?(정확한 시간은 모릅니다.) 지나야 반응을 합니다. 아래 링크가 title 어트리뷰트를 적용한 링크입니다. 한 번 마우스를 올려놔 보세요.

[첫 화면][1]

예컨대, <a href="http://www.left21.com/" target="_blank">레프트21</a> 같은 언론에서 줄임 제목을 보여 주고, 마우스를 올리면 온전히 긴 제목을 보여 주려고 할 때, 딜레이가 생기지 않는 편이 좋은 것이죠. 그리고 기사에 각주가 달려있다면, 각주를 클릭하기 전에 마우스를 올리는 것만으로 각주내용을 볼 수 있게 한다면 좋은 일이겠죠. 저 0.5초의 딜레이가 아까워지는 것입니다.

(나중에 알았는데 사실 브라우저들이 툴팁 반응 속도를 늦게 하는 건 이유가 있었습니다. 다음 글을 참고하세요: [툴팁 반응속도개선 ― 반응속도를 예전으로 되돌린 이유][2])

<div style="width: 435px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile25.uf.150F71494D4BC87C307AEC.png" alt="" width="425" height="262" /><p class="wp-caption-text">
    △레프트21에 툴팁 플러그인을 적용한 모습. 짧은 제목은 독자들에게 핵심을 파악하게 해 주고, 마우스를 올리면 풀 제목을 보여 줘 내용을 더 구체적으로 파악할 수 있게 해 준다. 딜레이 시간이 없게 하고 싶었다.
  </p>
</div>

이 때 사용할 수 있는 플러그인이 <a href="http://bassistance.de/jquery-plugins/jquery-plugin-tooltip/" target="_blank">jQuery의 tooltip 플러그인</a>입니다.

사용법은 간단하고 <a href="http://jquery.bassistance.de/tooltip/demo/" target="_blank">툴팁 플러그인의 예제</a>를 보면 금세 알 수 있습니다.

저는 대표적인 것만 얘기하겠습니다.

## jQuery 툴팁 플러그인에 필요한 파일 3개

일단 툴팁 플러그인을 구동하려면 기본적으로 jquery.js(1.2 버전 이상), jquery.tooltip.js, jquery.tooltip.css 이 세 가지가 있어야 합니다.

그리고 툴팁을 구현하려는 문서의 head에는 반드시 저런 태그가 들어가야 한다는 것을 잊으면 안 됩니다.

<pre class="brush:html">&lt;link rel="stylesheet" href="jquery.tooltip.css" /&gt;
&lt;script src="jquery.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;script src="jquery.tooltip.js" type="text/javascript"&gt;&lt;/script&gt;</pre>

각 파일의 위치는 알아서.

## jQuery 툴팁 플러그인의 기본 실행 코드

그 다음, 실행 코드인데 간단하다. 가장 기본적인 것은 아래 코드다.

<pre class="brush:js">$(&#039;a&#039;).tooltip()</pre>

이렇게 쓰면 title이 있는 모든 a 위에 마우스를 갖다 댔을 때 툴팁이 뜬다. 이 경우 아래처럼 툴팁이 뜬다.

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile29.uf.197D94544D4BC87C1B2E87.png" alt="" width="541" height="74" />

툴팁 상자의 아래쪽에 google.de 라는 url이 보일 것이다. 기본은 이렇게 title을 위에 굵게 표시해 주고, 아래쪽에 url을 표시해 주는 형식이다.

input과 label 등 모든 곳에 적용 가능하다. input에 적용했을 경우에는 마우스로 입력공간을 클릭하면 툴팁이 사라지게 돼 있다.

참고삼아 위 Link to google 부분 태그를 살펴 보자. 내가 헷갈렸기 때문에, 다른 사람들도 헷갈릴지 모른다고 생각해 html 태크를 써 놓는 것이다.

<pre class="brush:html">&lt;a title="A tooltip with default settings, the href is displayed below the title" href="http://google.de"&gt;Link to google&lt;/a&gt;</pre>

## jQuery 툴팁 플러그인 옵션 몇 가지

옵션은 당연히 javascript 객체 형태로 넣어 준다. 그게 jQuery에서 옵션 넣는 방법이니까.

<pre class="brush:js">{옵션1:값, 옵션2: 값, 옵션3: 값}</pre>

이런 형태라는 거다.

자, 그럼 어떤 옵션이 있을까.

*   delay: 숫자로 쓰는 거 같은데 0이라고 쓰면 마우스 갖다대자마자 툴팁이 뜬다. 내가 원하던 기능.
*   showURL: boolean값으로 넣어 준다. 기본은 true고, false로 넣으면 URL을 보여 주지 않는다.
*   extraClass: 툴팁박스에 class를 하나 더 붙여 준다. 이걸 이용해서 툴팁 디자인을 바꿀 수 있다. 클래스는 직접 jquery.tooltip.css에 코드를 넣어 줘야 한다.
*   opacity: 불투명도. 1이면 투명도가 없는 거다. 0~1 사이 소수점으로 나타낸다. 기본은 0.85로 돼 있다.
*   showBody: &#8221; &#8211; &#8221; 이렇게 하면 title을 &#8221; &#8211; &#8220;을 기준으로 파싱해서 엔터값을 매긴다. 만약 글자가 title=&#8221;녹풍 &#8211; 푸른바람의 블로그입니다&#8221; 로 돼 있다면 &#8220;녹풍&#8221; 부분은 크게 나오고, &#8220;푸른바람의 블로그입니다&#8221;는 줄을 바꿔서 작은 글씨로 나온다.

뭐, 이 정도 옵션으로 내가 원하는 건 다 구현했다. 더 알고 싶은 사람들은 문서를 직접 보기 바란다.

## 속지 말자

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile28.uf.171014494D4BC87C20985F.png" alt="" width="418" height="302" />

데모 페이지를 보면 위와 같은 화면을 만날 수 있다. 나는 깜짝 놀랐다. 이런 화려한 효과를 그냥 기본으로 제공한다는 말인가!!! 하고 말이다.

그러나&#8230; 위의 말풍선은 그냥 그림이다. 그냥 그림이라는 말은 유연성이 없다는 뜻이다. 그래서 툴팁이 길어진다면?

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile9.uf.120622584D4BC87C0D08A2.png" alt="" width="523" height="301" />

위처럼 디자인 박살난다.

따라서 말풍선 같은 걸 만들고 싶은 분은 따로 css를 수정해서 써야 한다.

class는 수정해서 extraClass 옵션을 사용해 붙여 주면 되겠다. 여기서도 pretty 라는 class와 fancy 라는 class를 붙인 것이다.

위에 나와 있는 여러 옵션은 잘 모르겠으니 <a href="http://docs.jquery.com/Plugins/Tooltip" target="_blank">jQuery tooltip plugin 문서</a>를 참고하기 바란다.

그리고 뭔가 IE6의 z-index 버그를 없애기 위해서 <a href="https://github.com/brandonaaron/bgiframe" target="_blank">bgiframe plugin</a>이 필요하다고 한다. 나는 사용하지 않았지만 불안하면 사용하기 바란다.

다른 툴팁 플러그인으로는 cluetip이란 게 있는데 http://towons.kr/blog/7 여기서 사용법을 볼 수 있다. [towons.kr 사이트는 꽤 좋은 사이트였는데, 지금은 사라져 버렸다. ㅠㅠ - 2011-10-16 추가함]

 [1]: / "첫 화면으로 이동합니다"
 [2]: http://webmaster.left21.com/archives/275