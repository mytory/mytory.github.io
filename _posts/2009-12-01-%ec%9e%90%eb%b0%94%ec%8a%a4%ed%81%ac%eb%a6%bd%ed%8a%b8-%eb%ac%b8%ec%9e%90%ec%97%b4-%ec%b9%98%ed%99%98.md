---
title: 자바스크립트 문자열 치환
author: 안형우
layout: post
permalink: /archives/109
aktt_notify_twitter:
  - yes
daumview_id:
  - 37216744
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
<pre class="brush:js">var str="Visit Microsoft! Visit Microsoft! Visit Microsoft! Visit Microsoft! Visit Microsoft! Visit Microsoft! Visit Microsoft! Visit Microsoft! ";
document.write(str.replace(/Microsoft/g, "W3Schools"));</pre>

3번 줄의 /와 / 사이에 타켓 문자를 넣는다. 그냥 문자도 되고 정규식도 된다고 한다.

/Microsoft/g 의 맨 뒤에 붙은 g는 Global을 의미한다. 이 g를 안 쓰면 맨 첫 번째 것만 변한다. g를 쓰면 전부 다 변한다.

타겟 문자에 대한 좀더 자세한 옵션은&nbsp;[JavaScript RegExp Object][1]를 참고하라.

메서드 자체에 대한 예시는 [JavaScript replace() Method][2]를 참고하면 된다.

 [1]: http://www.w3schools.com/jsref/jsref_obj_regexp.asp
 [2]: http://www.w3schools.com/jsref/jsref_replace.asp