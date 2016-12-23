---
title: '[mysql] 정렬해서 가져온 놈을 뒤집어야 할 때'
author: 안형우
layout: post
permalink: /archives/602
aktt_notify_twitter:
  - yes
daumview_id:
  - 36919921
categories:
  - 서버단
tags:
  - MySQL
---
php를 예로 설명하자면, mysql\_fetch\_array($result) 를 하면 가장 위에 있는 놈이 array에 들어가게 된다.

한 마디로, 1,2,3,4,5 순서로 불러왔다면 1,2,3,4,5 순서로 들어오게 된다는 거다. 5부터 불러올 방법이 없다.

당연히, &#8220;그럼 DESC로 불러오면 되잖나?&#8221; 할 것이다. 맞다. 5개만 갖고 그러면 된다.

<div>
  그러나 1,3,4,5,6,8,11,13,14,15,16,17,18,21,22 중에서 13 바로 앞의 5개를 오름차순으로 가져오라고 한다면?
</div>

<div>
  <pre class="brush: sql; gutter: true; first-line: 1">SELECT * FROM table WHERE number &gt;= 13-5 AND number &lt; 13 ASC</pre>
  
  <p>
    이렇게 생각할지 모르겠다. 그런데~ 두둥. 위처럼 하면 8,11 고작 두 개만 온다. 그렇다. 숫자가 1씩 증가한다고 보장할 수 없을 때 골때린다.
  </p>
</div>

<div>
  그럼 5개만 제한해서 가져와 볼까?
</div>

<div>
  <pre class="brush: sql; gutter: true; first-line: 1">SELECT * FROM table WHERE number &lt; 13 ORDER BY number ASC LIMIT 5</pre>
</div>

<div>
  와우~ 이렇게 했더니 1,3,4,5,6이 불러와 진다. 그럼 DESC를 쓸까?
</div>

<div>
  <pre class="brush: sql; gutter: true; first-line: 1">SELECT * FROM table WHERE number &lt; 13 ORDER BY number DESC LIMIT 5</pre>
  
  <p>
    그러면 11,8,6,5,4 가 불러와 진다.
  </p>
</div>

여기까지 하고 완전 좌절한 다음에 mysql\_fetch\_array()의 결과를 array()에 계속 집어넣은 다음 array[4]부터 array[0]까지 차례대로 숫자를 내려서 정보를 받아오느라 뒤지는 줄 알았다.

<div>
  그런데 너무나, 너무나도! 간단한 해결책이 있었다!!!!
</div>

<div>
  <pre class="brush: sql; gutter: true; first-line: 1">SELECT * 
FROM ( SELECT * FROM table WHERE number &lt; 13 ORDER BY number DESC LIMIT 5) A
ORDER BY no ASC</pre>
</div>

이렇게 사용하면 되는 것이었다. 셀렉트한 놈들에서 다시 정렬을 하는.(괄호 뒤의 A는 저 괄호에 이름을 붙여 주는 역할을 하는 것 같다. 그거 안 쓰니가 안 되더라.)

역시 정렬 등 자료를 가공하는 것은 sql을 따라올 놈이 없다. 자꾸 프로그래밍단에서 처리하고 싶은 유혹을 느끼곤 하는데 그렇게 하지 말자.