---
title: '[CSS] 텍스트가 넘치면 말줄임표 붙여 주기 &#8211; CSS로 된다니!'
author: 안형우
layout: post
permalink: /archives/639
aktt_notify_twitter:
  - yes
daumview_id:
  - 36895668
mytory_md_path:
  - 
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
아래 링크를 참고하면 된다.

[▶텍스트 말줄임 (text-overflow:ellipsis)][1]

현재 모든 최신 브라우저가 다 지원한다. (놀라운 건, IE는 이미 6부터 지원하고 있었다는 것 ㅋ)

코드를 배껴 온 뒤, `display: block;`만 추가했다. `inline-block`을 사용해도 된다.

<pre class="brush: css; gutter: true; first-line: 1">.ellipsis {
    width: 200px;
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    word-wrap: normal !important;
    display: block;
}</pre>

왜 저런 식의 코드인지 설명은 링크에 들어가서 보길 바란다.

## 문단 말줄임

위 CSS로는 한 줄짜리만 말줄임표 붙이는 게 가능하다. 문단 수준에서 하려면 jQuery 플러그인을 사용하면 된다. 아래 링크 참고.

[▶jQuery dotdotdot][2]

 [1]: http://kyouyoum.cafe24.com/?p=75
 [2]: http://dotdotdot.frebsite.nl/