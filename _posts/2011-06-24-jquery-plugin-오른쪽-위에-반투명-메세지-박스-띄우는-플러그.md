---
title: '[jQuery plugin] 오른쪽 위에 반투명 메세지 박스 띄우는 플러그인 jgrowl'
author: 안형우
layout: post
permalink: /archives/1369
aktt_notify_twitter:
  - yes
daumview_id:
  - 36711090
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
시간이 없어서 사용법을 자세히 소개하진 못하지만, 굉장히 간단하다.

일단 동영상을 보실까.

<p style="text-align: center;">
  <div class="video-container">
    <div class="video-container__inner">
    </div>
  </div>
</p>

코드는 아래와 같다. 샘플 1부터 5까지 쉽게 알 수 있다.

<pre>// Sample 1 - 그냥 사용하기
$.jGrowl("Hello world!");
// Sample 2 - 안 사라지게 하기
$.jGrowl("Stick this!", { sticky: true });
// Sample 3 - 메세지에 제목 띄우기
$.jGrowl("A message with a header", { header: &#039;Important&#039; });
// Sample 4 - 시간 정하기(아래는 10초)
$.jGrowl("A message that will live a little longer.", { life: 10000 });
// Sample 5 - 나타나는 애니메이션 설정, 끌 때 실행할 함수 설정(단, 수동으로 끄면 작동하지 않는다.)
$.jGrowl("A message with a beforeOpen callback and a different opening animation.", {
    beforeClose: function(e,m) {
        alert(&#039;About to close this notification!&#039;);
    },
    animateOpen: {
        height: &#039;show&#039;
    }
});</pre>

잠깐 살펴 본 바로는 일단 css 파일을 넣어야 한다. 심플하다.

jQuery UI를 함께 사용할 수도 있는 거 같은데 구체적으로는 뭐에 쓰는지 잘 모르겠다.

옵션은 열리는 속도, 최대 몇 개까지의 메세지를 뜨게 허용할 것인지, 사라지게 할 것인지, 사용자가 임의로 끌 때까지 붙여 둘 것인지 등이 있다. 어디에 뜨게 할 것인지 위치도 지정할 수 있다. 트위터를 받아서 뜨게 할 수도 있다.(신기신기)

지금 프로젝트에 적용해 봐야겠다. ㅋㅋㅋ