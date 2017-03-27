---
title: 구글 맞춤 검색 요소(구글 ajax 맞춤 검색)의 검색어를 구글 아날리틱스에서 통계로 잡기
author: 안형우
layout: post
permalink: /archives/179
aktt_notify_twitter:
  - yes
daumview_id:
  - 37164259
categories:
  - 웹 분석과 검색
tags:
  - Google Custom Search
---
**[2012-08-31 추가] 이 글을 쓴 때부터 시간이 꽤 흘렀기 때문에 필자인 저는 이 글의 내용을 신뢰하지 않습니다.**

**요새는 아날리틱스 계정과 맞춤 검색 계정을 연결하는 게 옵션에 있던데 제대로 작동하는지 확인은 안 해 봤습니다. 여튼 그 쪽으로 알아보세요.**

**만약, 구글 아날리틱스 코드를 공부하고 싶은 분들이라면 그냥 <a href="https://support.google.com/analytics/bin/answer.py?hl=ko&answer=1032720" target="_blank">특수 단계 목표 및 유입경로</a>라는 구글 도움말을 참고하세요. (영어 버전(<a href="https://support.google.com/analytics/bin/answer.py?hl=en&answer=1032720" target="_blank">Special-Case Goals and Funnels</a>)으로 보는 게 나을 수도 있습니다.) 아래에 제가 예시로 들어 놓은 코드들은 구버전 아날리틱스 코드라서 최신 버전의 구글 아날리틱스에서는 작동하지 않는 코드입니다.**

<a href="http://google.co.kr/analytics" target="_blank">구글 아날리틱스</a>는 구글이 제공하는 무료 통계 프로그램입니다.

그리고 구글 맞춤 검색(구글 사이트 검색)은 구글에서 제공하는 사이트 맞춤형 검색 프로그램입니다.

예컨대, 레프트21이란 사이트가 있다고 합시다. 이 사이트에 맞춤 검색을 설치하면 레프트21의 콘텐츠만 찾아줍니다.

제가 관리하는 <a href="http://www.left21.com/" target="_blank">레프트21 사이트</a>에 가면 구글 맞춤 검색을 볼 수 있습니다.

구글 맞춤 검색은 세 가지 디자인(방법)을 제공합니다.

하나는 검색을 하면 구글 페이지를 띄워서 검색을 해 주는 것입니다. <a href="http://webmaster.left21.com/" target="_blank">레프트21 웹마스터 블로그</a>의 오른쪽 상단에 있는 &#8216;구글에서 레프트21 검색하기&#8217;를 이용해 검색하면 모양을 알 수 있습니다.

다른 하나는 iframe을 사용한 것입니다. <a href="http://www.ubuntu.or.kr/" target="_blank">우분투 한국 사용자 모임</a>에서 오른쪽 상단의 구글 맞춤 검색을 사용하면 그 모습을 볼 수 있습니다.

마지막 하나가 ajax를 사용한 &#8216;맞춤 검색 요소&#8217;인데, 레프트21은 지금 이 방법을 사용해 맞춤 검색을 제공하고 있습니다.

세 가지 방법 중 위의 두 가지 방법은 사이트에서 사람들이 무엇을 검색하는지 구글 아날리틱스에서 통계를 내 볼 수 있는 것 같습니다. 그런데 세 번째, 맞춤 검색 요소를 활용한 방법을 사용하면 구글 아날리틱스에서 통계를 잡아 주지 않습니다. 그래서 따로 스크립트를 만들었습니다.

기본적으로는 아래 스크립트를 참고하시면 됩니다. [이 스크립트는 구식 아날리틱스에서만 작동합니다. 지금 이 코드가 작동하는 아날리틱스는 아마 거의 없을 겁니다. 코드를 짜려면 [_trackPageview() 구글 공식 도움말 항목][1]을 참고하세요. 2012-08-31 추가]

<pre class="brush:js">//구글 검색 검색어 잡기 위한 tracker
$(&#039;form.gsc-search-box&#039;).live(&#039;click&#039;,function(){
	if($(&#039;input.gsc-input&#039;).val()!=null && $(&#039;input.gsc-input&#039;).val()!=&#039;&#039;)
		pageTracker._trackPageview(&#039;/3_search.php?keyword=&#039;+$(&#039;input.gsc-input&#039;).val());
	});
});</pre>

다만, 위의 네 번째 줄은 설명이 필요할 듯합니다.

<pre class="brush:js">pageTracker._trackPageview(&#039;/3_search.php?keyword=&#039;+$(&#039;input.gsc-input&#039;).val());</pre>

바로 이거죠. [그런데 위 코드를 참고하지 마시고 구글 도움말 <a href="https://developers.google.com/analytics/devguides/collection/gajs/asyncMigrationExamples?hl=ko#VirtualPageviews" target="_blank">Virtual Pageviews</a>를 참고해 보세요. 2012-08-31 추가]

원래는 다운로드 하는 링크나 외부 링크로 빠져나가는 것, 자바스크립트 이벤트처럼, 내부에서 통계를 잡을 수 없는 페이지에 사용하는 방법입니다.

즉, 이렇게 다운로드 받게 해 둔 코드가 있다고 칩시다.

<pre class="brush:html">&lt;a href="file.zip"&gt;다운 받기&lt;/a&gt;</pre>

그러면 이렇게 해 주면 이걸 몇 명이 다운 받았는지 알 수 있게 되는 것이죠.

<pre class="brush:html">&lt;a href="file.zip" onclick="pageTracker._trackPageview(&#039;/file.zip&#039;)"&gt;다운 받기&lt;/a&gt;</pre>

이렇게 하면 구글 아날리틱스의 콘텐츠 항목에 file.zip 이라는 url도 통계로 잡히기 시작하는 것입니다. [위 코드는 안 먹힐 겁니다. 2012-08-31 추가]

물론 이 방법을 사용하려면 구글 아날리틱스의 스크립트를 위 코드 전에 불러 와야 합니다. 페이지 로딩 속도는 조금 더 느려질 수도 있겠죠.

구글 맞춤 검색 요소의 검색어를 구글 아날리틱스에서 통계로 잡는 것은 바로 이 방식을 활용한 것입니다. 검색 버튼을 클릭하는 순간 아래 코드를 실행하도록 jQuery의 live() 메서드로 이벤트를 핸들링한 것입니다.

<pre class="brush:js">pageTracker._trackPageview(&#039;/3_search.php?keyword=&#039;+$(&#039;input.gsc-input&#039;).val());</pre>

위 코드는 다음을 알 수 있기 때문에 도움이 될 거라 봅니다.

*   $(&#8216;form.gsc-search-box&#8217;)에 이벤트를 핸들링해야 한다는 점
*   live() 메서드를 사용해야 한다는 점
*   pageTracker._trackPageview(&#8216;아날리틱스가 인지하게 할 URL&#8217;) 방식을 사용하면 된다는 점

<div>
  맞춤 검색 요소의 통계를 아날리틱스에서 감지하고 싶은 분들은 <a href="http://jQuery.com" target="_blank">jQuery 라이브러리</a>를 html 페이지에 추가하고 위 코드를 사용해 보시면 될 거라 봅니다. 설마 jQuery 라이브러리를 페이지에 어떻게 추가하는지까지 설명할 필요는 없겠죠?
</div>

<div>
  그럼 이만.
</div>

 [1]: https://developers.google.com/analytics/devguides/collection/gajs/methods/gaJSApiBasicConfiguration#_gat.GA_Tracker_._trackPageview