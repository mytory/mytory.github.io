---
title: 구글 페이지 스피드가 추천하는 브라우저 캐시 활용(Leverage browser caching)
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1232
aktt_notify_twitter:
  - yes
daumview_id:
  - 36718878
categories:
  - 기타
tags:
  - TIP
---
[구글 페이지 스피드][1]는 웹사이트의 트래픽을 절약하고 속도를 높이는 다양한 방법을 제안하고, 내 사이트는 어떤 걸 더 적용해야 하는지 평가해 주는 온라인 서비스다.

내가 관리하는 몇 군데 사이트를 측정해 본 결과 점수는 대체로 만족스러웠는데 공통적으로 지적된 게 바로 브라우저 캐시를 활용하지 않는다는 점이었다.

브라우저 캐시 기간을 설정해 주면 그 기간 동안은 웹브라우저가 다시 온라인에서 js나 이미지 같은 것을 다운받지 않고 그냥 오프라인에 저장돼 있는 것을 확실히 사용하기 때문에 트래픽이 줄어들고, 속도도 늘어난다.

구글은 캐시 기간을 1년으로 설정해 두고, 내용이 변경될 때마다 브라우저가 새로 자원을 다운받을 수 있는 기법(지문 fingerprint 기법)도 설명하고 있다.

아래는 구글 페이지 스피드의 설명인 [Leverage browser caching][2] 부분을 번역한 것이다.

## 요약

정적인 자원[js나 css, 이미지 같은 것들 - 역자]의 만료일 혹은 최대 수명(maximum age)을 지정해 놓으면 브라우저는 네트워크에서 다운받지 않고 로컬 디스크에 예전에 저장한 것을 불러 오게 된다.

## 자세히 보기

HTTP/S는 브라우저가 정적인 자원을 로컬에 임시 저장(cache. 이후 그냥 캐시라고 쓰겠다.)할 수 있도록 지원한다. 몇몇 최신 브라우저(IE7, 크롬)은, 얼마나 캐시할지 지정돼 있지 않은 모든 자원을 얼마나 오래 캐시할지 스스로 학습을 통해 정한다. 다른 구식 브라우저들은 캐시에서 자원을 불러오기 전에 헤더에 있는 캐시 관련 지시를 요구할 것이다. 그리고 또다른 몇몇은 아예 SSL[https - 역자]을 캐시하지 않는다.

모든 브라우저에서 일관되게 캐시의 장점을 활용하려면, 서버 쪽에서 캐시 기간을 명확히 설정하고, 이를 적용할 수 있는 **모든** 자원에 적용하기를 권한다. (이미지 같은) 작은 그룹에만 지정하지 말고 말이다. 캐시할 만한 자원에는 JS와 CSS 파일, 이미지 파일, 그리고 다른 바이너리 파일(미디어 파일, PDF들, 플래시 파일 등등)이 있다. 일반적으로, HTML은 정적이지 않다. 그래서 캐시하는 것을 고려하지 않는 편이 낫다.

HTTP/1.1은 다음과 같은 캐시 응답 헤더를 제공한다.

*   `Expires` 와 `Cache-Control: max-age`. 이것은 자원이 최신이라고 할 수 있는 기간을 정한다. 바로, 브라우저가 웹 서버에서 최신 버전을 체크하지 않고 캐시된 자원을 사용할 수 있는 기간을 말한다. 이들은 무조건 적용되는 &#8220;강력한 캐시 헤더&#8221;다. 즉, 한 번 만료일이 설정된 채 다운되면, 만료일에 도달하거나 수명이 다 하기 전까지는 절대로 브라우저가 GET 요청을 보내지 않는다.
*   `Last-Modified` 와 `ETag`. 브라우저가 파일이 예전과 같은지 체크할 수 있도록 문자열을 제공하는 방법이다. `Last-Modified` 헤더에서 이 문자열은 날짜로 표시한다. `ETag` 헤더에서 문자열은 자원의 최신 여부를 식별할 수 있는 유일한 어떤 값이다.(파일 버전이나 콘텐트 해시가 일반적이다.) `Last-Modified`는 인공지능을 갖춘 브라우저에 한해 캐시를 사용할지 다운을 받을지 결정할 수 있도록 돕는 &#8220;약한&#8221; 캐시 방법이다.(인공지능 방법은 브라우저별로 다르다.) 그러나, 이 헤더는 사용자가 명시적으로 페이지를 리로드했을 때 조건부로 GET 요청을 보냄으로써 캐시된 자원을 효과적으로 업데이트할 수 있도록 한다. 조건부 GET 요청은 자원이 서버에서 교체되기 전까지는 자원을 다운로드(full response)하지 않는다. 따라서 자원을 모두 다운로드(full GETs)하는 것보다 지연이 덜하다.

모든 캐시 가능한 자원에 대해서 `Expires` 나 `Cache-Control max-age` 중 하나, `Last-Modified` 나 `ETag` 중 하나, [즉 강한 캐시와 약한 캐시 방법 중 하나를] 선택하는 것이 중요하다. `Expires` 와 `Cache-Control: max-age` 중 하나를 선택하거나, `Last-Modified` 와 `ETag` 중 하나를 고르는 것은 부차적이다.

## 모든 정적 자원에 대해 적극적으로 캐시를 설정하길 권한다

모든 캐시 가능한 자원에 대해 다음 세팅을 하길 권한다:

*   최소 1개월을 만료일로 설정하라, 그리고 나중에는 1년 정도 설정해 보라. (`Expires` 가 `Cache-Control: max-age` 보다 낫다. 더 많은 브라우저가 그걸 지원하기 때문이다.) 나중에도 1년 이상은 설정하면 안 되는데, [RFC][3] 가이드라인을 위반하는 것이기 때문이다.  
    만약 자원이 언제 변할지를 분명히 알고 있다면, 더 짧은 만료일을 설정해도 좋다. 하지만 &#8220;곧 변경될지도 모르는데&#8221; 하는 정도라면, 만료일을 길게 설정하고, 아래에서 설명하는 URL 지문을 사용하라. 캐시를 적극적으로 활용하는 게 브라우저를 &#8220;혼란스럽게(pollute)&#8221; 만들지는 않는다: 우리가 아는 한, 모든 브라우저들은 Least Recently Used 알고리즘에 따라 캐시를 비운다; 적어도 우리가 아는 한 무작정 만료일을 기다리기만 하는 브라우저는 없다.
*   자원이 변경될 시점으로 `Last-Modified` 날짜를 설정하라. 만약 `Last-Modified` 날짜가 꽤 과거라면, 브라우저가 그걸 다시 적용하지는 않을 거다.(Set the Last-Modified date to the last time the resource was changed. If the Last-Modified date is sufficiently far enough in the past, chances are the browser won&#8217;t refetch it.)

## 지문을 사용해서 동적으로 캐시하게 하라

가끔씩만 변하는 자원에 대해, 서버에서 변경되기 전까지만 브라우저가 캐시해 두게 할 수 있다. 서버가 &#8220;새 버전이 나왔어&#8221; 하고 브라우저에 말해 주게 할 수 있는 것이다. 자원의 URL에 지문(fingerprint)을 넣어 두면 그렇게 할 수 있다(예를 들면, 파일 경로). 자원이 변경되면, 지문이 변경되고, 그렇게 되면 URL이 변경된다. URL이 변경되면, 브라우저는 당연히 자원을 새로 적용하게 된다. 지문을 사용하면, 자원이 변하는 주기보다 훨씬 더 길게 만료일을 정할 수 있다. 당연히, 이 테크닉은 외부 자원을 참조하고 있는 페이지가 외부 자원의 지문 URL을 모두 알고 있어야 한다. 즉, 페이지가 짜여진 방식에 따라 가능할 수도 있고 불가능할 수도 있다.

## 인터넷 익스플로러를 위해 Vary 헤더를 제대로 세팅하라

인터넷 익스플로러는 `Accept-Encoding` 과 `User-Agent` 를 제외한 다른 필드와 함께 `Vary` 헤더가 전송되면 그 자원은 캐시하지 않는다.(Internet Explorer does not cache any resources that are served with the `Vary` header and any fields but `Accept-Encoding` and `User-Agent`.) IE에서 이런 자원을 제대로 캐시하기 위해서, `Vary` 헤더에서 다른 모든 필드를 제거하거나, 가능하다면 `Vary` 헤더 전체를 제거해야 한다.

[역자 주: Vary 헤더는 뭔가 다양한 상황에 대비하기 위해 추가하는 헤더 같은데, 뭘 하는 놈인지 썩 잘 이해가 되지는 않는다. 누군가 [HTTP 1.1 캐시 관련 헤더][4]를 번역해 둔 게 있는게 그걸 참고해 보라. 내가 관리하는 사이트를 보니 `Vary:User-Agent,Accept-Encoding` 하고 헤더에 적혀 있다. 그러면 IE도 캐시를 하는 것으로 이해했는데, 나중에 테스트를 해 봐야 겠다.]

## 파이어폭스에서 캐시 충돌을 일으킬 수 있는 URL을 피해야 한다

파이어폭스의 디스크 캐시 해시 함수는 8글자 이하의 URL에 대해서 캐시 충돌을 일으킬 수 있다. [두] 자원의 해시가 같은 키를 갖고 있다면, 하나의 자원만 디스크에 저장될 것이다; [디스크에] 남아있는 같은 키의 자원은 브라우저가 재시작됐을 때 다시 적용된다. 따라서 만약, 지문을 사용하거나 다른 프로그래밍 방법으로 파일의 URL을 생성하고 있다면, 캐시 히트율을 최대화하기 위해, 8글자 이상의 URL을 만들어서 파이어폭스 해시 충돌 이슈를 피하라.

(역자 주 : A 파일과 B 파일이 같은 키를 갖고 있다면, A 파일이 사용되는 쪽에 B 파일이 적용되거나 하지는 않는 듯하다. 다만, A 파일을 캐시했다가 B 파일을 캐시하면 A 파일 캐시가 날아가는 듯.)

## 파이어폭스에서 HTTPS를 캐시할 수 있도록 `Cache control: public` 명령을 사용하라

파이어폭스 몇몇 버전에서는 SSL로 전송된 자원을 캐시하기 위해 `Cache control: public` 헤더가 필요하다. 다른 캐시 헤더가 명확히 지정돼 있어도 말이다. (아래에서 설명할 건데) 보통은 이 헤더가 프록시 서버에서 켜져 있지만, 프록시들은 HTTPS로 전송되는 콘텐츠를 전혀 캐시하지 못한다. 따라서 HTTPS 자원에 대해 이 헤더를 켜 두는 것이 안전하다.

## 예시

구글은 사용자가 캘린더에 로그인한 후 사용하게 되는 스타일 시트 파일명에 지문을 넣어 뒀다.

`calendar/static/<strong>fingerprint_key</strong>doozercompiled.css`, 지문이 있는 곳은 128비트 16진수다. 화면을 캡쳐하던 당시(페이지 스피드의 Show Resources 패널을 캡춰한 것이다), 지문은 `82b6bc440914c01297b99b4bca641a5d` 로 설정됐다.(역자 주: 그래서 파일명이 `82b6bc440914c01297b99b4bca641a5ddoozercompiled.css` 다.)

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/google-pagespeed-caching-header1.png" alt="" />
</p>

지문 기법은 서버가 브라우저의 요청 날짜부터 확실히 1년 후를 `Expires` 헤더로 보낼 수 있게 해 준다; 마지막 변경일을 가리키는 `Last-Modified` 헤더는 확실히 마지막 변경일을 가리키며, `Cache-Control: max-age` 헤더는 3153600이다. 만료일이나 최대 수명 안에 자원이 변경됐을 때, 자원을 다운로드할 수 있게 하기 위해서, 파일 내용이 변경되면 지문(URL)도 변경된다.

## 더 알아 보기

*   HTTP 캐시에 대한 좀더 깊이 있는 설명은 [HTTP/1.1 RFC][5]의 섹션 [13.2][6], [14.21][7], 그리고 [14.9.3][8] 를 보면 된다.
*   아파치에서 캐시를 켜기 위한 자세한 설명은 [Apache Caching Guide][9] 에 있다.

 [1]: http://mytory.local/archives/1183 "Google에서 제공하는 웹사이트 페이지 속도 측정, 관리 기능"
 [2]: http://code.google.com/intl/ko-KR/speed/page-speed/docs/caching.html#LeverageBrowserCaching
 [3]: http://ko.wikipedia.org/wiki/RFC
 [4]: http://icecreamie.tistory.com/entry/HTTP-11-%EC%BA%90%EC%8B%9C-%EA%B4%80%EB%A0%A8-%ED%97%A4%EB%8D%94
 [5]: http://www.w3.org/Protocols/rfc2616/rfc2616.html
 [6]: http://www.w3.org/Protocols/rfc2616/rfc2616-sec13.html#sec13.2
 [7]: http://www.w3.org/Protocols/rfc2616/rfc2616-sec13.html#sec14.21
 [8]: http://www.w3.org/Protocols/rfc2616/rfc2616-sec13.html#sec14.9.3
 [9]: http://apache.org/docs/2.2/caching.html