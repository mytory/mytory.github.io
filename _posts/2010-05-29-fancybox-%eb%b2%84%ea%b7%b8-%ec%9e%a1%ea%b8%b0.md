---
title: fancybox1 버그 잡기
author: 안형우
layout: post
permalink: /archives/623
aktt_notify_twitter:
  - yes
daumview_id:
  - 36910549
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
<a href="http://fancybox.net/" target="_blank">fancybox1</a>를 사용하는데 ie에서 골치아픈 문제가 있었다. 사용하기 전에 알았다면 fancybox를 사용하지 않고 <a href="http://colorpowered.com/colorbox/" target="_blank">colorbox</a>를 사용했을 것이다. ([fancybox2][1]에는 이런 문제가 없다. 단, [fancybox2는 상업적 사용 금지][2]다. 1은 가능하다.)

## ie6,7(익스플로러6,7)에서 아이콘들이 보이지 않는 상황 해결

<a href="http://fancybox.net/howto" target="_blank">fancybox의 설치 방법</a>에 <a href="http://groups.google.com/group/fancybox/browse_thread/thread/8530478044b9f586#" target="_blank">해결방법</a>이 함께 제공되고 있기 때문에 버그라고 하기까지는 뭐하다고 할 수도 있겠다. 하지만 readmore를 클릭해야만 볼 수 있기 때문에 이건 좀 아니다 싶다.

해결은 간단하다. fancybox 폴더를 root에 두거나, css파일로 들어가서 /\* ie \*/ 라고 써 있는 거 아래쪽 부분의 src를 모두 절대경로로 바꿔주는 것이다.

만약 https를 사용하고 있다면 이것도 문제다. ie6는 png의 (반)투명이미지를 표시하기 위해서 알파채널 로더를 이용한다. fancybox의 아이콘들도 모두 이걸 이용해서 표현하게 된다. 그런데 https를 사용할 경우 이걸 작동시키지 못하는 것 같다.(참고 : <a href="http://betabug.ch/blogs/ch-athens/857" target="_blank">PNG, Transparency, IE6, AlphaImageLoader, and SSL</a>) 그래서 아예 아이콘이 표시되지 않게 된다.

## ie6에서 이미지가 박스 밖으로 튀어나오는 문제

이건 늘상 벌어지는 문제는 아닌 것 같다. fancybox 홈페이지에 있는 이미지는 ie6에서도 잘 나오기 때문이다. 그런데 내가 설치한 데서는 박스 밖으로 튀어나왔다. 원인은 padding 때문이었다. ie6는 패딩을 합쳐서 width를 판단하기 때문에, padding이 설정돼 있으면 <span style="font-weight: bold;">width가 줄어들어버린다.</span>

이걸 js에서 isIE라는 것으로 해결하고 있는 듯한데, 왜인지 작동하지를 않았다. 내가 fancybox 전문가가 될 생각까진 없었으므로 대충 해결했다. 해결방법은?

<pre class="brush:css">#fancybox-wrap {
	position: absolute;
	top: 0;
	left: 0;
	margin: 0;
	/*padding: 20px;*/
	z-index: 1101;
	display: none;
}</pre>

위 코드를 찾아서 padding을 주석처리한다.

단, 이런 식으로 했을 때 어떤 버그가 생길지는 알 수 없다. 안정성을 보장할 수는 없다는 거다. 물론 나는 ie6, ie7, firefox에서 테스트를 해 봤다. 멀쩡하게 잘 나온다.(단, ie6에서 안쪽으로 캡션을 붙이면 오른쪽이 약간 짧다. 이것 역시 padding 때문인데 이거까지 고치진 않았다. ie6지원 안 하는 부분 중 하나.)

이상이다. 에잇! 첨부터 colorbox를 알았다면 그걸 썼을 텐데 하는 생각이 든다.

 [1]: http://fancyapps.com/fancybox/
 [2]: http://mytory.net/archives/599 "최고의 jQuery 갤러리 플러그인, fancyBox2 – 새로운 기능은?"