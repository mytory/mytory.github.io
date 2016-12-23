---
title: jQuery 자동 완성 AutoComplete 플러그인
author: 안형우
layout: post
permalink: /archives/325
aktt_notify_twitter:
  - yes
daumview_id:
  - 37056984
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
[jQuery UI에서 직접 auto complete를 지원한다.][1] 이제 jQuery UI를 사용하는 게 나을 듯하다. (2011.4.30 추가함.)

&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;-

자동완성 플러그인으로 이 데모가 제일 직관적인 듯하다. 그리고 데모에서 다양한 옵션을 볼 수 있게 해 주는 점이 장점이다.

<a href="http://jquery.bassistance.de/autocomplete/demo/" target="_blank">jQuery Autocomplete Plugin Demo(jQuery 자동완성 플러그인 데모)</a>

아직 이 코드가 한글 자동완성까지 지원하는지 확인해보지는 않았다. 예컨대 ㄱ을 입력했을 때 ㄱ으로 시작하는 모든 글자(광주, 거창, 고양, 거제 이런 식으로…)를 찾아 주는 그런 코드 말이다.

만약 그런 기능이 없다면 <a href="http://coterie.textcube.com/53" target="_blank">jQuery 자동완성 플러그인</a>을 참고해 붙이면 될 것이다. 그렇게 하면 공부도 되고, 완성도 있는 자동완성 코드를 만들 수 있을 듯하다.

## 2010년 2월 24일, 추가 사항

*   위 플러그인은 파이어폭스에서 한글은 작동하지 않는다. 한글값을 입력해도 autoComplete가 작동하지 않으며, 화살표 아래쪽 방향키를 눌러야 작동한다.
*   익스플로러에서는 제대로 작동하지만, autoFill을 true로 설정하면 한글 값이 제대로 입력되지 않고 깨지는 것을 발견했다. autoFill이 false인 상태에서는 익스에서 잘 작동한다.

결국 한글에 쉽게 붙일 수는 없다는 것을 알게 됐다.

도대체 네이버와 구글 같은 데는 어떻게 만든 걸까. 당연히 최고수들이 모여 있으니 어렵지 않았겠지만서도;;

라이브러리 공개하면 안 되는 건가;;

 [1]: http://jqueryui.com/demos/autocomplete/