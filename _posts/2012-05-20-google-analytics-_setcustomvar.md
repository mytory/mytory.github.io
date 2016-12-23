---
title: '[Google Analytics] _setCustomVar()'
author: 안형우
layout: post
permalink: /archives/2476
aktt_notify_twitter:
  - yes
daumview_id:
  - 36608634
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
[구글 아날리틱스(GA : Google Analytics)에서 관리자가 방문하는 걸 통계에서 제거][1]하고 싶었다. 그래서 도움말을 디벼 보고 탐구를 했다. `_setVar()`라는 GA 함수를 사용하는 방법이 나와 있었다.

그런데 `_setVar()` 는 deprecated 다. 개발자 문서는 대신 [`_setCustomVar()`][2]를 사용하라고 하고 있었다. 그래서 탐구를 했고, 그 결과를 그냥 보관한다. 아까워서;;

[`_setCustomVar()`][2]는 뭔가 따로 저장할 만한 값이 있을 때 사용하는 함수인 듯하다. 세팅한 값은 **잠재고객 > 맞춤 > 맞춤 변수(Audience > Custom > Custom Variables)**에서 확인할 수 있다.

## 사용방법

<pre>//_gaq.push([&#039;_setCustomVar&#039;, index, name, value, opt_scope]);
_gaq.push([&#039;_setCustomVar&#039;, 1, &#039;User Type&#039;, &#039;admin&#039;, 1]);</pre>

index에는 1~5 사이의 값을 넣어 준다. 구글 아날리틱스에 들어가서 보면 1~5까지의 슬롯이 있는 것을 확인할 수 있을 거다. 이건 사전에 분류가 있다기 보다는 자신이 자의적으로1~5 사이의 값을 넣어 주면 되는 거다. 자기가 알아서 1~5 사이로 맞춤 변수를 분류하라는 뜻으로 이해하면 된다.

name과 value는 굳이 설명하지 않아도 될 것이다.

opt_scope는 맞춤 변수를 어떤 범위에서 추적할 것인지 세팅하는 것이다. 1은 visitor 레벨에서 추적, 2는 세션 레벨에서 추적, 3은 페이지 레벨에서 추적하는 것이다.

Visitor 레벨인 1로 설정하면 아마 2년 동안 내가 아무리 와도 1회만 추적될 것이다. 세션 레벨 추적이라면 세션이 끝나는 순간 새로운 값이 추적될 것이다.(간단히 말해 브라우저 껐다 켜면 새로 추적된다는 소리) 3은 페이지가 변경될 때마다 추적되도록 설정하는 것이다.(간단히 말해, F5 누를 때마다 추적된다는 소리다.)

 [1]: http://mytory.net/archives/2090 "[Google Analytics] 쿠키를 이용해 관리자 트래픽을 통계에서 제외하기"
 [2]: https://developers.google.com/analytics/devguides/collection/gajs/gaTrackingCustomVariables