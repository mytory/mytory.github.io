---
title: '[번역] 자바스크립트 파싱 시점을 늦춰 페이지 체감 속도를 높이는 방법 &#8211; Defer Loading Javascript'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1225
aktt_notify_twitter:
  - yes
daumview_id:
  - 36720533
categories:
  - 웹 퍼블리싱
tags:
  - javascript
---
[구글 페이지 스피드][1]의 [Defer Loading of JavaScript][2] 항목을 번역한 것이다.

## 요약

시작할 때 자바스크립트 함수 호출을 늦추는 것은 초기 다운로드 용량을 줄인다. 다른 자원들을 병렬적으로 다운로드하게 허용하기 때문이다. 그러면 실행 시간과 렌더링 속도가 빨라진다.(대충 의미는 맞는데 번역은 정확한지 모르겠다 : Deferring loading of JavaScript functions that are not called at startup reduces the initial download size, allowing other resources to be downloaded in parallel, and speeding up execution and rendering time. )

## 자세히 보기

스타일시트처럼, 스크립트도 브라우저가 웹 페이지를 렌더링하기 전에 다운로드되고 파싱돼야 한다. 다시 말해서, 설사 스크립트가 외부 파일로 페이지에 삽입돼 있고, 브라우저가 그걸 캐시로 저장하고 있다고 해도, 디스크에 저장돼 있던 자바스크립트 코드를 모두 실행하기 전까지 브라우저는 스크립트 아래에 있는 모든 엘리먼트에 대한 렌더링을 멈춘다. 그러나, 몇몇 브라우저에서, 이런 상황을 스타일시트보다 더 안 좋은 결과를 낳는다: 자바스크립트가 실행되는 동안, 아예 다른 자원에 대한 다운로드를 멈춰 버리는 것이다. 대용량 자바스크립트를 포함하는 AJAX 타입 어플리케이션에서, 이건 속도를 심각하게 늦추게 될 수 있다.

스크립트 집약적인 어플리케이션에서 많은 경우 대용량 자바스크립트 코드는 사용자가 뭔가 할 때 벌어지는 이벤트를 제어하는 코드다. 마우스 클릭이나 드래그, 폼 항목과 제출, 숨김 요소 펼치기 등등. 이런 식으로 사용자가 발생시키는 이벤트는 모두 페이지가 로드된 다음 벌어지는 이벤트고, onload 이벤트가 이것들을 실행한다. 따라서, 메인 페이지를 로딩하는 순간에 지연이 많이 되는 것은 자바스크립트 로딩을, 그게 실제로 필요해지기 전까지, 늦춰서 피할 수 있다. &#8220;게으른&#8221; 로딩이 실제 자바스크립트 코드의 용량을 줄이는 것은 아니다. 그러나 페이지가 시작될 때 다운로드해야 하는 용량은 꽤 줄여 준다. 그리고 나머지는 백그라운드에서 비동기적으로(시작할 때 바로 받지 않는다는 뜻이다) 다운받도록 남겨 놓는 것이다.

이 테크닉을 사용하면, onload 이벤트로 호출하는 자바스크립트 함수와 그렇지 않은 것을 구분해야 한다. 페이지 시작 때 호출하지 않는 함수가 25개 이상이라면, 그걸 분리해서 외부 js 파일로 옮긴다. 파일들의 의존성을 고려하면서 리팩토링을 해야 할 수도 있다. (그런 함수가 25개 미만이라면 노력을 들일 가치가 없다.)

그리고 나서, 문서의 헤드 부분에 자바스크립트 이벤트 리스너를 삽입한다. onload 이벤트로, 외부 자바스크립트 파일을 로드할 수 있도록 말이다. 어떤 스크립트 코드를 사용해서 이걸 하든 상관 없다. 하지만 우리는 아주 간단한 돔 엘리먼트 스크립트를 추천한다. (크로스 브라우저와 동일 도메인 정책 이슈를 피할 수 있기 때문이다.) 여기 예시가 있다.(로딩을 지연해야 하는 함수를 포함하고 있는 &#8220;deferredfunctions.js&#8221;를 다루는 코드다.)

<pre>&lt;script type="text/javascript"&gt;

 // Add a script element as a child of the body
 // 스크립트 요소를 body의 자식으로 넣는다.
 function downloadJSAtOnload() {
 var element = document.createElement("script");
 element.src = "deferredfunctions.js";
 document.body.appendChild(element);
 }

 // Check for browser support of event handling capability
 // 브라우저에 따라 이벤트 핸들링 명령을 달리 한다.
 if (window.addEventListener)
 window.addEventListener("load", downloadJSAtOnload, false);
 else if (window.attachEvent)
 window.attachEvent("onload", downloadJSAtOnload);
 else window.onload = downloadJSAtOnload;

&lt;/script&gt;</pre>

 [1]: http://mytory.local/archives/1183 "Google에서 제공하는 웹사이트 페이지 속도 측정, 관리 기능"
 [2]: http://code.google.com/intl/ko-KR/speed/page-speed/docs/payload.html#DeferLoadingJS