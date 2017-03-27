---
title: '[jQuery plugin] 파이어폭스와 크롬에서 한글 단어별로 줄바꾸기 jQuery word-break: keep-all Plugin'
author: 안형우
layout: post
permalink: /archives/2801
aktt_notify_twitter:
  - yes
daumview_id:
  - 36590591
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
오늘 플러그인을 하나 만들었다. 예전부터 만들고 싶었던 건데, 바로 한글을 단어별로 줄바꿈할 수 있도록 하는 플러그인이다.

<div style="width: 420px" class="wp-caption aligncenter">
  <img alt="" src="https://mytory.net/uploads/legacy/word-break-keep-all-example.png" width="410" height="106" /><p class="wp-caption-text">
    이렇게 &#8216;다&#8217;만 달랑 다음 줄로 오는 경우를 싫어하는 사람들이 있다. 이걸 해결하려면 골치가 좀 아프다.
  </p>
</div>

신기하게도 인터넷 익스플로러가 이 쟁점에서는 우위에 서 있다. CSS로 이걸 지원하기 때문이다. 아래 CSS 코드를 넣으면 익스플로러는 단어별로 줄바꿈이 된다. (아마 MS가 가장 세계화된 업체기 때문이 아닐까 싶다. 하지만 그럼 구글은 왜;;)

<pre class="brush: css; gutter: true; first-line: 1">.target{
  word-break: keep-all;
}</pre>

물론 `.target` 요소가 block 요소여야 한다. 그래서 inline 요소를 그렇게 하고 싶을 때는

<pre class="brush: css; gutter: true; first-line: 1">display: block;</pre>

을 추가해 줘야 한다.

## 비 IE 브라우저

인터넷 익스플로러가 아닌 브라우저들은 `keep-all` 을 지원하지 않기 때문에 따로 손을 써 줘야 하는데 보통 수동으로 `<br>`을 넣곤 한다. 그렇게 하면 자동화가 불가능해지고, 가로폭이 달라지면 위치 조정을 할 수 없게 되는 문제가 생긴다.

물론 아예 방법이 없는 건 아닌데, 필요한 경우에 CSS를 이용해 `br`을 `display: none` 처리하면 해결되는 경우가 있다. 그러나 근본적인 해결책은 아니다.

그래서 아이디어를 낸 것이 자바스크립트를 이용해서 모든 단어를 각각 `span`으로 묶고 거기에 `white-space: nowrap` 속성을 주는 것이다.

오늘 만든 건 그걸 자동으로 해 주는 스크립트다. 늘 그냥 스크립트만 만들어 왔는데 오늘은 한 번 jQuery 플러그인으로 만들어 봤다. 앞으로 계속 활용하고 발전시켜 갈 생각으로 구글 코드에 레포지토리도 얻어서 넣어 버렸다. 이상.

[2013-09-04 추가 : 레포지토리를 기트허브로 옮겼다. ver.1.3부터는 GitHub에만 있다.]

[▶jQuery word-break:keep-all Plugin 프로젝트 홈 가기][1]  
[▶jQuery word-break:keep-all Plugin 데모 보기][2]

[2013-01-06 추가] 버전 1.2로 업데이트했다. 안에 태그가 있어도 작동하도록 했다.

 [1]: https://github.com/mytory/jquery-word-break-keep-all
 [2]: https://mytory.net/uploads/code/jquery-word-break-keep-all-plugin/example.html