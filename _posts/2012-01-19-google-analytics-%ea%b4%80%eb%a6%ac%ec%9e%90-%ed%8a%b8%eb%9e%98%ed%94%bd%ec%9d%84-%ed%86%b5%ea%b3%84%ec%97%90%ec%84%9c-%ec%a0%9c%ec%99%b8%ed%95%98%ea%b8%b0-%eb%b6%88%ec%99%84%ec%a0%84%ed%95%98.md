---
title: '[Google Analytics] 쿠키를 이용해 관리자 트래픽을 통계에서 제외하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2090
aktt_notify_twitter:
  - yes
daumview_id:
  - 36652954
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
구글 아날리틱스에서 관리자 트래픽을 제거하는 가장 단순한 방법은 IP 주소를 바탕으로 필터링을 하는 거다. 하지만, 대부분은 유동 IP를 사용하기 때문에 무용지물이다. IP 주소를 바탕으로 제외하면 한두 달에 한 번씩 필터를 갱신해 줘야 한다.

고급 방법은 쿠키를 이용하는 방법이다. 예컨대, 관리자 페이지 같은 데서 쿠키를 세팅하고, 해당 쿠키를 가진 방문은 방문수에서 제외하는 방식이다.

참고한 자료는 아래와 같다.

*   [보고서에서 내부 트래픽을 제외하려면 어떻게 해야 합니까?(한글)][1]
*   [How do I exclude my internal traffic from reports? (영문)][2]
*   [`_setVar()` 설명][3]

## 집어 넣을 코드

일단 구글 아날리틱스 코드가 있는 곳에 아래 코드를 넣으라는 거다. 신식 비동기(async) 코드에서는 아래처럼 쓰면 된다.

<pre>_gaq.push([&#039;_setVar&#039;, &#039;admin&#039;]);</pre>

구식 추적 코드를 사용하고 있다면 아래처럼 써라.

<pre>pageTracker._setVar(&#039;admin&#039;);</pre>

## 구글 아날리틱스에서 확인하기

`_serVar` 를 바탕으로 코드를 짰다면 아래 위치에서 해당 변수가 세팅된 방문을 추적할 수 있다.

<div style="width: 243px" class="wp-caption aligncenter">
  <img src="http://dl.dropbox.com/u/15546257/blog/mytory/google-analytics-set-var.png" alt="" width="233" height="382" /><p class="wp-caption-text">
    영어로는 User Defined 라고 돼 있다.
  </p>
</div>

## 필터 설정

아래 이미지는 구글 도움말에서 나온대로 필터를 세팅해 본 거다. 도움말에는 &#8220;사용자설정&#8221;이라고 돼 있는데 실제로 선택해야 하는 놈은 &#8220;맞춤 설정&#8221;이다. (영어는 User Defined로 설명과 실제가 동일하다.)

<img class="aligncenter" src="http://dl.dropbox.com/u/15546257/blog/mytory/exclude-admin-korean.jpg" alt="" width="513" height="594" />

<img class="aligncenter" src="http://dl.dropbox.com/u/15546257/blog/mytory/exclude-admin-english.jpg" alt="" width="545" height="589" />

위 이미지에 나온대로 필터 설정을 해 주면 될 것이다.

이미지보다 텍스트를 선호하는 분들을 위해 텍스트로 한 번 더 설명하자면, **프로필에 새 필터 만들기 > 맞춤 필터 > 제외 > 맞춤 설정** 을 선택하고 필터 패턴에 admin을 넣는다. 영문인 경우 **Create new Filter for Profile > Custom Filter > Exclude > User Defined** 를 선택하면 된다. 필터 이름 지정하는 것도 까먹지 마시고.

## 다른 방법

그런데 손쉬운 방법이 있다. 그냥 관리자모드에서 알아서 쿠키 설정을 한 뒤, 해당 쿠키가 있는 경우 구글 아날리틱스 추적 코드가 실행되지 않도록 하는 거다. 그러면 굳이 구글 아날리틱스 도움말을 디벼 가며 고생할 필요가 없다.

쿠키 관련해서는 [jQuery Cookie Plugin][4]을 사용해도 될 거고 그냥 [plain js로 쿠키 코딩][5]해도 될 거다.

## `_setVar()` 대신 `_setCustomVar()`를 사용?

`_setVar()` 설명에 보면 이놈은 deprecated니 [`_setCustomVar()`][6]를 사용하라는 설명이 있다. 그런데 `_setCustomVar()`를 사용할 경우 필터링하는 방법이 없는 듯하다. `setCustomVar`를 사용할 때는 `name`과 `value`를 입력하는 반면, 필터의 custom field 1 항목에는 입력칸이 하나밖에 없기 때문이다. 아마 custom filed 1,2가 custom variables 와는 다른 놈일 지도 모른다.

여튼간에 `_setCustomVar()`에서 세팅한 값은 **잠재고객 > 맞춤 > 맞춤 변수(Audience > Custom > Custom Variables)**에서 확인하면 된다.

그리고 나의 결론은 `_setCustomVar()`를 사용해서 관리자 통계를 제거할 방법이 없다는 것이고, 그래서 deprecated인 `_setVar()`를 쓰느니 그냥 내가 알아서 cookie 설정하고, 추적 안 하게 하는 게 낫겠다는 것이다. 끝!

 [1]: http://support.google.com/googleanalytics/bin/answer.py?hl=ko&answer=55481
 [2]: http://support.google.com/googleanalytics/bin/answer.py?hl=en&answer=55481
 [3]: https://developers.google.com/analytics/devguides/collection/gajs/methods/gaJSApiBasicConfiguration?hl=ko-KR#_gat.GA_Tracker_._setVar
 [4]: https://github.com/carhartl/jquery-cookie/blob/master/README.md
 [5]: http://www.w3schools.com/js/js_cookies.asp
 [6]: http://mytory.net/archives/2476 "[Google Analytics] _setCustomVar()"