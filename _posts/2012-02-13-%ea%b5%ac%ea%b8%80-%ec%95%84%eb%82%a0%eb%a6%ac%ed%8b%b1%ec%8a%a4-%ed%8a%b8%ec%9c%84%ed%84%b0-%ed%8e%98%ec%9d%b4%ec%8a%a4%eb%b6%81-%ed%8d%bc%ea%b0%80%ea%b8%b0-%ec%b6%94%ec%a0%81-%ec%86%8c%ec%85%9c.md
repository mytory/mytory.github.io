---
title: '[구글 아날리틱스] 트위터, 페이스북 퍼가기 추적 (소셜 네트워크 트래킹)'
author: 안형우
layout: post
permalink: /archives/2232
aktt_notify_twitter:
  - yes
daumview_id:
  - 36626427
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
일단 코드부터.

<pre class="brush: javascript; gutter: true; first-line: 1">/**
 * Google Analytics 이벤트 추적을 위한 글로벌 변수
 */
var _gaq = _gaq || [];

$(document).ready(function(){
  이벤트걸기_구글아날리틱스로_소셜네트워크_추적();
});

function 이벤트걸기_구글아날리틱스로_소셜네트워크_추적(){

  //Google+는 알아서 추적되므로 걸 필요가 없다.

  var title = document.title;
  var path = location.pathname.replace(/.html/,&#039;&#039;);

  $(&#039;.retweet_this&#039;).click(function(){
    _gaq.push([&#039;_trackSocial&#039;, &#039;twitter&#039;, &#039;share&#039;, title, path]);
    $(this).unbind(&#039;click&#039;);
  });

  $(&#039;.me2day_button&#039;).click(function(){
    _gaq.push([&#039;_trackSocial&#039;, &#039;me2day&#039;, &#039;share&#039;, title, path]);
    $(this).unbind(&#039;click&#039;);
  });

  $(&#039;.facebook_button&#039;).click(function(){
    _gaq.push([&#039;_trackSocial&#039;, &#039;facebook&#039;, &#039;share&#039;, title, path]);
    $(this).unbind(&#039;click&#039;);
  });

  //페이스북 좋아요 버튼 추적
  try {
    if (FB && FB.Event && FB.Event.subscribe) {
      FB.Event.subscribe(&#039;edge.create&#039;, function(targetUrl) {
        _gaq.push([&#039;_trackSocial&#039;, &#039;facebook&#039;, &#039;like&#039;, title, path]);
      });
      FB.Event.subscribe(&#039;edge.remove&#039;, function(targetUrl) {
        _gaq.push([&#039;_trackSocial&#039;, &#039;facebook&#039;, &#039;unlike&#039;, title, path]);
      });
      FB.Event.subscribe(&#039;message.send&#039;, function(targetUrl) {
        _gaq.push([&#039;_trackSocial&#039;, &#039;facebook&#039;, &#039;send&#039;, title, path]);
      });
    }
  } catch (e) {}  

  //트위터 팔로우 버튼 추적
  twttr.events.bind(&#039;follow&#039;, function(event) {
    if (event) {
      _gaq.push([&#039;_trackSocial&#039;, &#039;twitter&#039;, &#039;follow&#039;, title, path]);
    }
  });
}</pre>

## 구글 아날리틱스가 제공하는 소셜 트래킹

일단 참고한 문서는 [Social Interaction Analytics(소셜 네트워크 상호작용 분석)][1] 이다. 소셜 추적에 사용되는 [Tracking Code: Social Plug-in Analytics(추적 코드: 소셜 플러그인 분석 &#8211; `_trackSocial()` 메서드에 대한 설명이다)][2] 도 참고했다.

이거 외에도 [구글이 제공하는 소셜 트래킹 예제 코드][3]를 참고할 수 있다.

구글 아날리틱스는 방문자가 내 웹사이트에서 어디어디를 다녀갔는지, 얼마나 머물렀는지, 어디서 왔는데, 어떤 브라우저를 쓰는지 등등 다양한 것을 추적해 주지만, 웹사이트 분석에서 매우 중요한 소셜 네트워크 상호작용이 얼마나 일어나는지는 말해 주지 못한다. 왜?

1.  페이스북 좋아요, 트위터 트윗 버튼은 모두 iframe을 사용한다.
2.  커스텀 URL로 퍼가기를 만들더라도, 이건 모두 외부 URL로 빠지는 것이기 때문에 자동으로 추적되지 않는다.

그런데 사이트의 상호작용을 추적하는 것은 매우 중요하다. 분석은 단지 누가 얼마나 왔냐에 그쳐선 안 되고, 누가 얼마나 와서 무엇을 했는가가 중요하다. 내 사이트에 오래 있었던 게 원하는 걸 못 찾고 헤매서인지, 원하는 걸 찾고 기분이 좋아져서 더 돌아다닌 것인지 알 수 없다. 이럴 때 누군가 &#8220;좋아요&#8221;를 누른 것을 알게 된다면, 이 사람은 내 사이트가 좋아서 돌아다녔다는 것을 알 수 있다.

여튼 웹사이트 분석 분야에서 최신 트렌드는 사용자의 마음을 읽어내려는 분석이다. 이걸 정성적 분석이라고 한다. 한자로는 定性的. 대비되는 단어는 정량적 분석이다.

여튼, 방문자들의 소셜 네트워크 활동을 추적해서 통계를 내는 건 중요한 일이다. 그래서 처음엔 구글 아날리틱스의 단순 이벤트 기능을 활용해서 그렇게 하려고 시도하다가, 개발자 문서에서 재밌는 걸 발견했던 것이다. Social Tracking Method(소셜 네트워크 추적 함수)라는.

## 단순 링크는 추적 명령을 내리기 쉽다

위의 코드에서 맨 윗줄의 .retweet_this 링크를 보자. 이건 내가 직접 만든 링크다. 링크 코드는 아래와 같다.

<pre class="brush: html; gutter: true; first-line: 1">&lt;span class="retweet_this"&gt;
  &lt;a target="_blank" href="http://twitter.com/share?text=%22%EC%82%AC%ED%8C%8C%ED%8B%B0%EC%8A%A4%ED%83%80+%EB%B4%89%EA%B8%B0%2C+%EA%B7%B8+%ED%9B%84+10%EB%85%84%22&amp;url=http://left21.com/article/1234&amp;via=left21twit" title="트위터로 퍼가요"&gt;
    &lt;img src="http://left21.com/images/icon_twitter_21x21.png" alt="트위터로 퍼가요"&gt;
  &lt;/a&gt;
&lt;/span&gt;</pre>

코드를 보면 알 수 있겠지만, 그냥 내가 만든 코드다. 트위터에서 받은 게 아니다. 즉, iframe이 아니라 그냥 a 태그다. 따라서 아래처럼만 써 주면 알아서 추적을 한다.

<pre class="brush: javascript; gutter: true; first-line: 17">$(&#039;.retweet_this&#039;).click(function(){
    _gaq.push([&#039;_trackSocial&#039;, &#039;twitter&#039;, &#039;share&#039;, title, path]);
    $(this).unbind(&#039;click&#039;);
  });</pre>

retweet_this 클래스를 가진 객체를 클릭하면 바로 twitter 에 대한 share가 일어난 것으로 기록하게 한 거다.

위 코드에서 눈여겨 볼 것이 바로 _gaq.push 부분이다. 각 인자값에 대한 설명은 [Setting Up Social Analytics][4] 항목에 잘 나와 있는데, 하나씩 설명을 해 보자.

일단 함수는 이게 기본형이다.

<pre class="brush: javascript; gutter: true; first-line: 1">_gaq.push([&#039;_trackSocial&#039;, network, socialAction, opt_target, opt_pagePath]);</pre>

<p class="brush: javascript; gutter: true; first-line: 1">
  함수를 사용하려면 _gaq.push 에 인자값으로 넣어 주는 배열의 맨 앞에 함수 이름을 써 주면 된다. 그래서 이 경우엔 맨 처음에 들어간 놈이 &#8216;_trackSocial&#8217;이다. 이건 그냥 이렇게 써야 하는 거다. 나머지가 진정한 인자값이다. 설명해 보겠다.
</p>

1.  **network :** twitter, facebook, me2day 따위, 즉, 소셜 네트워크의 이름을 쓴다. 정해져 있는 건 없으니 알아서 쓰면 된다.
2.  **socialAction :** like, share, tweet, follow, me2 따위를 쓴다. 역시 정해져 있는 건 없다.
3.  **opt_target :** 앞에 opt가 붙은 이유는 필수 요소가 아니기 때문이다. 소셜 네트워크 상호작용이 일어난 곳을 지칭할 수 있는 거라면 뭐든 쓰면 된다. 내 코드를 보면 알겠지만, 나는 document.title 을 넣었다. 구글 예제에는 URL을 넣어 놨더라. 이 인자값은 입력하지 않아도 되며, 그러면 자동으로 URL이 들어가게 된다.
4.  **opt_pagePath :** 경로를 적어 주는 부분이다. 내 코드를 보면 알겠지만, ?이하 쿼리를 무시할 수 있도록 location.path 를 사용했다. 도메인까지는 적지 않는 모양이다. 구글 예제엔 path와 ?이하 쿼리 부분을 모두 추적하게 해 놨더라. 역시 이 인자값은 입력하지 않으면 자동으로 path와 ?이하 쿼리 부분을 기록한다.

<pre class="brush: javascript; gutter: true; first-line: 19">$(this).unbind(&#039;click&#039;);</pre>

이 코드는 왜 쓴 걸까? 링크로 된 퍼가기 버튼이기 때문이다. 만약 이렇게 클릭 이벤트를 해제하지 않으면, 한 사용자가 퍼가기 버튼을 두 번 눌렀을 때 소셜 상호작용이 2회로 추가되게 된다. 그런데 한 사용자가 퍼가기 버튼을 왜 두 번 누르겠는가? 뭔가 잘못됐기 때문에 그럴 거다. 그러면 이건 1회로 쳐야 하는 거다. 그러니까 최초로 눌렀을 때만 횟수에 추가하고, 다음에 또 눌렀을 때는 횟수에 추가하지 않기 위해서 이렇게 한 거다.

## 페이스북 좋아요/좋아요 취소/보내기 버튼 추적

일단 구글+는 아날리틱스가 알아서 자동으로 추적하므로 굳이 추적 함수를 따로 적어 줄 필요가 없다.

앞에서 내가 설명한 a 태그로 된 링크 버튼과 달리 트위터나 페이스북에서 직접 제공하는 좋아요 버튼이나 트윗 버튼은 iframe 방식으로 돼 있다. 해당 iframe을 감싸고 있는 span 객체에 click 이벤트를 걸어 봤지만, 추적하지 못하는 것을 확인했다.

따라서 트위터와 페이스북에서 직접 제공하는 좋아요/트윗 버튼을 추적하려면 구글에서 제공하는 방식을 따라야 한다. 정확히 말하면, 구글에서 제공하는 방식도 트위터와 페이스북에서 제공하는 API를 보고 만든 것이다. 따라서 정리하자면, 이 방법은 각 소셜네트워크 서비스가 제공하는 API의 콜백 함수에 구글 아날리틱스 추적 함수 실행을 추가해 주는 것이라고 할 수 있다.

이 방법에 따른 페이스북 추적 코드는 아래와 같다.

<pre class="brush: javascript; gutter: true; first-line: 32">//페이스북 좋아요 버튼 추적
  try {
    if (FB && FB.Event && FB.Event.subscribe) {
      FB.Event.subscribe(&#039;edge.create&#039;, function(targetUrl) {
        _gaq.push([&#039;_trackSocial&#039;, &#039;facebook&#039;, &#039;like&#039;, title, path]);
      });
      FB.Event.subscribe(&#039;edge.remove&#039;, function(targetUrl) {
        _gaq.push([&#039;_trackSocial&#039;, &#039;facebook&#039;, &#039;unlike&#039;, title, path]);
      });
      FB.Event.subscribe(&#039;message.send&#039;, function(targetUrl) {
        _gaq.push([&#039;_trackSocial&#039;, &#039;facebook&#039;, &#039;send&#039;, title, path]);
      });
    }
  } catch (e) {}</pre>

FB는 페이스북 좋아요/좋아요 취소/보내기 등의 작동을 할 때 사용하는 객체다.

34번째~37번째 줄을 보자. 이건 만약, `FB` 객체도 있고, `FB.Event`도 있고, `FB.Event.subscribe` 도 있으면 `FB.Event.subscribe`의 콜백에다가 콜백 함수를 넣어 주는 것이다.

`'edge.create'` 라는 인자값은 `edge.create` 라는 이벤트가 일어났을 때 이놈을 콜백으로 넣으라는 말이 되겠다. `edge.create`는 우리가 쉽게 아는 말로 하면 &#8216;좋아요&#8217;가 되겠다. 그래서 구글 아날리틱스 추적 함수에는 like라고 이름을 붙여 준 것이다.

그 아래쪽의 콜백 거는 코드 두 개는 좋아요 취소와 보내기에 해당하는 놈들이다. 내가 이걸 붙인 사이트에는 좋아요 버튼밖에 없어서 보내기에 해당하는 건 추적할 필요가 없었지만, 그래도 나중에 혹시 추가할 지 모르기 때문에 그냥 보내기까지 추적하도록 세팅했다.

## 트위터 트윗/팔로우 버튼 추적

트위터 역시 기본적으로 페이스북 좋아요 추적과 마찬가지다.

<pre class="brush: javascript; gutter: true; first-line: 47">//트위터 팔로우 버튼 추적
  twttr.events.bind(&#039;follow&#039;, function(event) {
    if (event) {
      _gaq.push([&#039;_trackSocial&#039;, &#039;twitter&#039;, &#039;follow&#039;, title, path]);
    }
  });</pre>

트위터가 사용하는 객체는 `twttr` 다. 여기서는 콜백 함수를 사용하기 위해 `twttr.events.bind` 함수를 사용한다. 그리고 이벤트명을 적어 줘야 하는데, jQuery `bind` 함수를 써 본 사람은 알겠지만, 첫 번째 인자값으로 이벤트명을 문자열로 넣어 준다.

내가 위 코드를 넣은 사이트에서는 트위터가 제공하는 걸로는 follow 버튼만 사용하고 있기 때문에 follow만 추적하라고 저렇게 썼지만, 트윗 버튼을 단 사람은 이벤트명을 `'tweet'`이라고 적어 줘야 한다. 실제 [구글이 제공하는 예제 코드][3]에서는 트윗만 추적한다.

즉, 두 개 다 넣어 주면 되는 거다.

아날리틱스에 알려 주는 함수 실행부에 대해서는 굳이 또 설명하지 않겠다.

## 확인해 보기

구글 아날리틱스에서 소셜 활동을 확인하는 건 간단하다. 일단 구글 아날리틱스의 최신 버전을 사용하고 있어야 한다. 우측 상단을 보면 새 버전 사용 뭐 이런 말이 있을 거다.

그리고 **표준보고서 > 잠재고객 > 소셜** 항목에 가면 있다. 추적 내용을 볼 수 있다.

## 비동기식 통신의 한계를 극복하는 `_gaq` 변수

일단 구글 아날리틱스의 최신 추적 코드를 사용한다면 `_gaq` 변수를 쓸 줄 알아야 한다. 설명을 보면 나와 있는데, 이렇게 세팅을 해 준다.

<pre class="brush: javascript; gutter: true; first-line: 1">var _gaq = _gaq || [];</pre>

일단 코드의 뜻은 `_gaq`가 있으면 `_gaq`를 그대로 사용하고, 없으면 빈 배열을 만들라는 거다.

빈 배열은 왜 만들까?

간단한 원리인데, 최신 방식의 구글 아날리틱스는 비동기식 자바스크립트로 구동된다. 페이지가 로딩된 후에 구글 아날리틱스의 js를 받아 온다는 거다. 그런데 미처 구글 아날리틱스의 스크립트가 다 로드되기 전에 사용자가 페이스북 좋아요 버튼을 누른다면? 추적이 안 될 위험이 있다. 이걸 회피하기 위해 일단 `_gaq` 배열을 만들어 버리는 거다.

push 함수는 알겠지만, 배열에 추가로 내용을 집어넣는 함수다. 만약 구글 아날리틱스 스크립트가 다 로드되기 전에 _gaq 변수에 내용이 들어간다면, 나중에 로드된 구글 아날리틱스 js는 이 배열 안에 있는 정보를 구글 아날리틱스 서버로 보낸다.

다 로딩된 다음에도 잘 작동한다. 구글 아날리틱스에서 로드된 \_gaq 객체는 push라는 함수를 갖고 있다. 그래서 함수 문법 그대로 \_gaq.push를 실행해 주면 바로 구글 아날리틱스 서버로 정보를 전달하게 된다.

구글 짱이다 ㅋㅋ

이상 구글 아날리틱스로 소셜 네트워크 상호작용 추적하기를 마친다.

[추신] 뭐 굳이 이런 것까지 말해야 할까 싶긴 하지만, 이건 전적으로 내 웹사이트에서 일어나는 상호작용만 추적하는 거다. URL을 복사해서 붙여넣기하는 방식으로 퍼간 거? 추적 안 된다. 북마클릿으로 퍼간 거? 역시나 추적 안 된다.

 [1]: http://code.google.com/intl/ko-KR/apis/analytics/docs/tracking/gaTrackingSocial.html
 [2]: http://code.google.com/intl/ko-KR/apis/analytics/docs/gaJS/gaJSApiSocialTracking.html
 [3]: http://code.google.com/p/analytics-api-samples/source/browse/trunk/src/tracking/javascript/v5/social/ga_social_tracking.js
 [4]: http://code.google.com/intl/ko-KR/apis/analytics/docs/tracking/gaTrackingSocial.html#settingUp