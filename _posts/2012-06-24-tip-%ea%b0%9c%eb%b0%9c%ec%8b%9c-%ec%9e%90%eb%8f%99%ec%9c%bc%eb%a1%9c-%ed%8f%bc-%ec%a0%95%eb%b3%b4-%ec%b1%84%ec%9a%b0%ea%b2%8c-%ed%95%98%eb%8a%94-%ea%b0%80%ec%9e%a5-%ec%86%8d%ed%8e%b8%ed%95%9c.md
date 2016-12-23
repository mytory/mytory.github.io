---
title: '[Tip] 개발시 자동으로 폼 정보 채우게 하는 가장 속편한 방법 &#8211; GreaseMonkey(Firefox), TamperMonkey(Chrome) + jQuery 사용하기'
author: 안형우
layout: post
permalink: /archives/2650
aktt_notify_twitter:
  - yes
daumview_id:
  - 36595702
categories:
  - 기타
tags:
  - TIP
---
개발을 하다 보면 참가 신청, 주문 정보 등등 폼을 채우고 테스트를 해야 하는 경우들이 생긴다.

이걸 편하게 하려고 자동으로 폼을 채워 주는 플러그인을 써 보기도 했고, js 코드로 박아 넣은 적도 있다. 그런데 자동으로 폼을 채워 주는 플러그인은 만족스럽게 작동하지 않았고, js 코드로 박아 넣는 건 실수로 사이트에 올릴까 봐 스트레스를 받으면서 개발을 해야 했다.

클라이언트 단에서만 js를 작동하게 하는 방법은 없을까 하는 고민을 하다가 크롬 확장을 뒤져 봤다. [JavaScript Injector][1] 라는 플러그인이 있었는데, URL을 딱 하나만 사용해야 한다는 문제가 있었다. 내가 개발하는 놈은 URL이 동적으로 바뀌는 것이었기 때문에 적용할 수 없었다.

## GreaseMonkey

그러다가 파이어폭스 플러그인인 [그리스몽키 GreaseMonkey][2] 를 떠올렸다. 크롬 확장으로는 [탐퍼몽키 TamperMonkey][3]라는 놈이 있었다. 그래서 당장 설치를 했다.

그리고 UserScript로 아래와 같이 만들어서 넣었다.

<pre class="brush: js; gutter: true; first-line: 1">// ==UserScript==
// @name       자동으로 주문정보 넣기
// @namespace  http://mytory.net/?p=2650
// @version    0.1
// @description  @require를 사용해야 jQuery를 사용할 수 있다.
// @match      http://target-url.com/?item=*
// @require    http://code.jquery.com/jquery-latest.js
// @copyright  2012+, You
// ==/UserScript==
(function(){
    jQuery(&#039;[name="code"]&#039;).click();
    jQuery(&#039;[name="bankUid"]&#039;).val(6);
    jQuery(&#039;[name="depositor"]&#039;).val(&#039;asdf&#039;);
    jQuery(&#039;input[data-initcode="orderer"]&#039;).click();
})();</pre>

위 코드를 참고해서 각자 만들어 사용하면 될 거다.

## GreaseMonkey, TamperMonkey 에서 jQuery 사용하기

jQuery를 사용하면 훨씬 코드를 빨리 짤 수 있는데, 그리스몽키와 탐퍼몽키 안에서는, 웹사이트에 들어가 있는 jQuery를 사용할 수 없었다. 왜 그런진 모르겠지만 여튼 안 됐다. 그래서 좀 찾았는데, [UserScript 사이트][4]에서 해답을 얻을 수 있었다. 위 코드에서

<pre class="brush: javascript; gutter: true; first-line: 1">// @require    http://code.jquery.com/jquery-latest.js</pre>

이 부분이 핵심이다. 이 부분을 넣어 주면 그 때부터 jQuery 변수를 사용할 수 있다.

 [1]: https://chrome.google.com/webstore/detail/abdogfafejmdomllalkdegagoehgbdbk
 [2]: https://addons.mozilla.org/ko/firefox/addon/greasemonkey/
 [3]: https://chrome.google.com/webstore/detail/dhdgffkkebhmkfjojejmpbldmpobfkfo
 [4]: http://userscripts.org/