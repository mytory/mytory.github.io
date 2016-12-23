---
title: '[fancyBox2] 모바일 문제 해결하기 &#8211; 위치가 이상해지는 것'
author: 안형우
layout: post
permalink: /archives/2634
aktt_notify_twitter:
  - yes
daumview_id:
  - 36597236
categories:
  - 기타
tags:
  - TIP
---
이 해결책은 [팬시박스1][1]에 대한 해결책은 아니다. 그러나 1에도 적용할 수 있을지 모르겠다. 난 안 해 봤으니 모르겠고. ([팬시박스2][2]의 [주요 변경사항][3])

그런데 팬시박스2에서도 모바일 화면에서 문제가 생긴다. 아이폰에서 화면을 확대하면 팬시박스로 떠 있는 놈이 화면 밖으로 튀어나가 버리는 문제다.

CSS의 fixed 프로퍼티 때문에 발생하는 문제인데, 확대했을 때의 top, left 픽셀이 비율에 맞게 함께 조정되면서 생기는 문제인 것 같다. (무슨 말인지 모르겠으면 문제 진단은 패스하고.)

<img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/fancybox2-problem/problem.png" alt="" width="640" height="480" />

해결책은 의외로 간단하다. 스타일에 다음을 추가해 준다.

<pre class="brush: css; gutter: true; first-line: 1">.fancybox-wrap{
	position: absolute !important;
}</pre>

그러면 아래처럼 깔끔하게 볼 수 있다.

<img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/fancybox2-problem/resolved.png" alt="" width="320" height="480" />

실제 적용된 걸 보고 싶다면 : [레프트21 갤러리 &#8220;파업 결의하는 금속 노동자&#8221; 바로 가기][4]

 [1]: http://fancybox.net
 [2]: http://fancyapps.com/fancybox/
 [3]: http://mytory.net/archives/599 "최고의 jQuery 갤러리 플러그인, fancyBox2 – 새로운 기능은?"
 [4]: http://photo.left21.com:8080/photo_issue.php?title_no=636