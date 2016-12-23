---
title: 'IE6용 투명 png 적용 자바 스크립트 중 가장 나아 보이는 것 &#8211; background 이미지까지 처리해 주는 DD_belatedPNG'
author: 안형우
layout: post
permalink: /archives/778
aktt_notify_twitter:
  - yes
daumview_id:
  - 36800694
categories:
  - 웹 퍼블리싱
tags:
  - IE:인터넷 익스플로러
---
인터넷 익스플로러6(IE6)는 투명 PNG 파일을 처리하지 못한다. 그래서 허여멀거니한 색깔을 투명 배경 대신에 뿜어 낸다. 뭐 이런 놈이 다 있나 싶지만. 구식 브라우저에게 신식 기술을 처리 못 한다고 탓할 수는 없는 노릇이니, 뭐 개발자들이 죽어 나야 하는 것이다.

이런 걸 처리해 주는 자바스크립트 라이브러리가 몇 개 있는데 <a href="http://www.dillerdesign.com/experiment/DD_belatedPNG/" target="_blank">DD_belatedPNG 라이브러리</a>가 가장 나은 것 같다. 왜? 배경으로 들어간 투명 PNG까지 처리해 주기 때문이다. 다른 라이브러리들은 배경으로 투명 PNG이 들어가면 잘 처리를 못 했다.

여튼간에 <a href="http://www.dillerdesign.com/experiment/DD_belatedPNG/" target="_blank">DD_belatedPNG 자바스크립트 라이브러리</a>를 사용하면 쉽게 IE6에서 투명 PNG을 적용할 수 있다.

사이트에 가서 보면 사용법은 쉽게 찾을 수 있을 텐데, 간단하게 정리하면, 일단 js 파일을 다운 받아야 할 것이다.

<p style="text-align: center;">
  <a href="http://www.dillerdesign.com/experiment/DD_belatedPNG/#download" target="_blank">DD_belatedPNG 다운로드</a>
</p>

그리고 <a href="http://www.dillerdesign.com/experiment/DD_belatedPNG/#usage" target="_blank">사용법</a>에 나와 있는 것처럼 코드를 적용하면 된다.

<pre class="brush:html">&lt;!--[if IE 6]&gt;
&lt;script src="DD_belatedPNG.js"&gt;&lt;/script&gt;
&lt;script&gt;
/* 예제 */
DD_belatedPNG.fix(&#039;.png_bg&#039;);
/* CSS 셀렉터 아무 거나 넣으면 된다. */
/* .png_bg 는 예제일 뿐이고 꼭 저렇게 해야 하는 건 아니다 */
/* 당신에 맞게 고쳐라. */
&lt;/script&gt;
&lt;![endif]--&gt;</pre>

위는 DD_belatedPNG 웹사이트의 usage 항목에 있는 예제 코드다.

나 같은 경우는 그냥 `DD_belatedPNG.fix('img')`라고 해 버릴 거다.

물론 배경 PNG에도 적용시키려면 배경이 들어간 요소의 css 셀렉터를 넣어 줘야 한다.