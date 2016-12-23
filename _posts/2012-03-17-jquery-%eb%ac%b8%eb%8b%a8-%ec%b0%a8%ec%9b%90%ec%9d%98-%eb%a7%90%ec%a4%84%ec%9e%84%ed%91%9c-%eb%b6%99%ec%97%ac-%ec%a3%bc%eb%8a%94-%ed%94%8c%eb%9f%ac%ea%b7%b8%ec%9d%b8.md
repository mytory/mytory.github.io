---
title: '[jQuery] 문단 차원으로 말줄임표 붙여 주는 플러그인'
author: 안형우
layout: post
permalink: /archives/2325
aktt_notify_twitter:
  - yes
daumview_id:
  - 36620985
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
[▶예제 보기][1]

멋진 플러그인을 발견했다. 박스 사이즈에 따라 말줄임표를 붙여 주는 플러그인이다. 이름하여 jQuery dotdotdot 플러그인.

데모를 보면 사용법을 잘 알 수 있다.

[▶jQuery dotdotdot 플러그인 사이트 가기][2]

기본적으로 박스의 높이에 따라 알아서 말줄임표를 붙여 준다.

`after` 옵션을 사용하면 말줄임표로 자르면서 남겨 둘 요소를 지정해 줄 수 있다.

`watch: 'window'` 옵션을 사용하면 윈도우 사이즈가 변할 때 알아서 다시 잘라 준다.

그 외 다양한 옵션이 있는데, 아래와 같다. 자세한 설명은 코드 아래쪽에 좀더 썼다.

<pre class="brush: javascript; gutter: true; first-line: 1">$(document).ready(function() {
  $("#wrapper").dotdotdot({
    wrapper  : &#039;div&#039;,  /*  콘텐트를 감쌀 요소. */
    ellipsis: &#039;... &#039;,  /*  말줄임표를 뭘로 할지 */
    wrap  : &#039;word&#039;,    /*  자를 단위. 다음 옵션 중 하나 선택: &#039;word&#039;/&#039;letter&#039;/&#039;children&#039; */
    after  : null,     /*  자르고 나서도 유지시킬 요소를 jQuery 선택자로 적는다. */
    watch  : false,    /*  윈도우가 리사이즈될 때 업데이트할 건지: true/&#039;window&#039; */
    height  : null     /*  선택. max-height를 지정한다. 만약 null이면 알아서 잰다. */
    tolerance: 0       /*  글이 넘치면 이만큼쯤 height를 늘린다 */
  });
});</pre>

`wrap`을 `children`으로 설정하면, 자식 요소들을 한 단위로 해서 자르게 된다. 자식 요소가 없이 텍스트만 있으면 내용이 다 날아간다. ㅋ

`wrapper`는 플러그인이 텍스트를 감쌀 때 dotdotdot이라는 클래스의 박스를 생성하게 되는데, 이걸 어떤 태그로 할지 설정해 주는 놈이다.

`height` 옵션은 겉의 박스 높이와 상관없이 자체적으로 높이를 지정할 때 쓰는 놈이다. 예제에 내가 쓴 게 있다.

`tolerance`는 홍세화 선생님이 유명하게 만든 그 똘레랑스 맞다. 관용이다. 50으로 설정한다면, 설정한 높이보다 글이 많을 때 50px까지는 더 높이를 높인다. (뭔 말인지는 이해하기 힘들 거다. `height`를 100으로, `tolerance`를 50으로 설정하고 글자를 많이 넣어 보길.)

## 커스텀 이벤트 핸들러

이 외에도 자르는 걸 업데이트하는 `update` 이벤트 트리거(윈도우나 박스 사이즈가 변경됐을 때 사용하는 듯), `isTruncated` 이벤트 트리거(아마도 텍스트가 잘렸는지 확인하는 것인 듯), 원래의 전체 글을 불러오는 `originalContent` 이벤트 트리거, dotdotdot 적용을 없애는 `destroy` 이벤트 트리거를 제공한다.

(이벤트 트리거란? `$('.className').bind('click', functionName);` 식의 코드에서 &#8216;`click`&#8216;이 이벤트 트리거다. 실제 마우스 클릭을 하면 `click` 이벤트가 `trigger` 된다. 실제 클릭을 하지 않고도, `$('.className').trigger('click')` 하면 이벤트가 발생된다.)

 [1]: http://dl.dropbox.com/u/15546257/code/dotdotdot-1.4.0/index.html
 [2]: http://dotdotdot.frebsite.nl/