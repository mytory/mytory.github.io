---
title: '[HTML5] input의 어트리뷰트인 required'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/648
aktt_notify_twitter:
  - yes
daumview_id:
  - 36884842
mytory_md_path:
  - 
categories:
  - 웹 퍼블리싱
tags:
  - HTML
---
얼마 전부터 크롬에서 글쓰기를 하면 필요도 없는 input text 때문에 submit이 되지 않는 현상이 발생했다. 사실 오페라에선 예전부터 그런 현상이 발생했기 때문에 오페라를 몇 번 사용하려고 하다가 때려 쳤었다. 그런데 크롬에서도 같은 현상이 발생하는 것! 나는 크롬을 주력 브라우저로 사용하기 때문에 초난감했다. 그래서 한동안, 아래 명령어를 크롬의 콘솔(Ctrl+Shift+J하면 나오는 그놈)에서 직접 입력했었다.

그러다가 문득 이런 생각이 들었다.

> 웹브라우저 개발자들이 ㅂㅅ도 아니고 뭔가 페이지에 문제가 있지 않을까?

그리고 찾아봤다. 자꾸 비어있는데 입력하라고 나오는 그 놈은 바로 아래와 같은 코드였다.

<pre class="brush:html">&lt;input name="title_for_web" type="text" size="70" maxlength="66" required="no" message="웹용 제목"/&gt;</pre>

원래 required는 자바스크립트에서 사용하는 놈이다. required=&#8221;yes&#8221;라면 폼 밸리데이션에서 잡아내는 역할을 한다. 그런데 이 코드는 required=&#8221;no&#8221;이므로 필수가 아니란 말. 참, 그리고 html4에서 이 요소는 없는 것으로 알고 있다. 그건 message도 마찬가지다. 그런데 문제는 자바스크립트 폼 밸리데이션 기법으로 이런 방법이 광범위하게 사용돼왔다는 점이다.

여튼간에 이놈이 뭔가 연관이 있을 것이라고 생각하고 검색을 해봤다. 왠걸, 역시 있었다.

링크해 둔 곳에서 required라고 검색해 보시길&#8230; 표준 문법은 아래와 같다.

<pre class="brush:html">&lt;input type="text" required="required"/&gt;</pre>

그런데 아는가? readonly의 표준 문법도 readonly=&#8221;readonly&#8221;인 것을. 그런데 사람들은 그냥 아래처럼 쓰곤 한다.

<pre class="brush:html">&lt;input type="text" readonly /&gt;</pre>

왜? 그래도 작동하니까.

그리고 이로써 문제를 밝혀냈다.

required=&#8221;no&#8221;라고 써 있는 위 태그를, 크롬이 html5를 지원하게 되면서, required=&#8221;required&#8221;라고 인식하게 된 것이다. 왜? no라는 값는 없는 옵션이니 무시, input 안에 required 속성이 등장한 것만으로 크롬은 &#8220;이놈 필수!&#8221;라고 인식하게 된 것이다.

그래서? required=&#8221;no&#8221;인 경우 다 제거해 버렸다. ㅋㅋㅋ

그러니 걸리지 않고 잘 submit된다. 성공!