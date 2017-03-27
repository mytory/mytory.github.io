---
title: form 데이터를 post로 새창에 보내기
author: 안형우
layout: post
permalink: /archives/16
aktt_notify_twitter:
  - yes
daumview_id:
  - 37270201
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
form 데이터를 새 창을 열어서 보내야 할 경우가 있다. 요즘은 ajax로 많이들 처리하지만, 사실 ID와 Password를 체크할 때 새 창을 열어서 많이들 검증했다.

이 때는 get 방식으로 파라미터를 보낼 수가 없다. post로 보내야 한다는 말이다. password를 주소 표시줄에 노출시키면 안 되니까.

이 때 간단한 방법이 있다. form에 target을 지정해 주고 자바스크립트로 이름 가진 창을 열어 주면 된다. 

<script type=&#8221;text/javascript&#8221;>  
var win;  
function create(){  
<span class="Apple-tab-span" style="white-space:pre"> </span>win = open(&#8221;,<span style="color: rgb(255, 0, 0); "><strong>&#8216;w&#8217;</strong></span>,<u>**&#8216;width=300,height=200&#8242;**</u>);  
}  
</script>

일단 위는 새 창을 여는 자바 스크립트 함수다. 중요한 것은, <span style="color: rgb(255, 0, 0); "><strong>&#8216;w&#8217;</strong></span>라고 써 준 것인데, 이게 새 창의 이름이 된다.

그리고 **width=300,height=200**은 새 창의 크기를 지정해 준 것인데, 사이에 공백이 들어가면 안 된다. **width=300,<span style="background-color: rgb(255, 255, 0); ">&nbsp;</span>height=200** 이렇게 하면 안 된다는 말이다. (노랑색이 공백을 표시한 부분이다. 저 노랑색 만큼의 공백도 안 된다!)

그리고 form은 이렇게 만든다.

<form method=&#8221;post&#8221; action=&#8221;actionServlet&#8221; **<span style="color: rgb(255, 0, 0); ">target=&#8221;w&#8221;</span>** onsubmit=&#8221;**create();**&#8220;>  
<span class="Apple-tab-span" style="white-space:pre"> </span>(<input/>은 생략)  
</form>

&nbsp;그러면 훌륭하게 새 창이 열리면서 작동한다.

설마 action=&#8221;actionServlet&#8221;을 그대로 옮긴 사람은 없을 거라 생각한다. 저기는 알아서 창으로 띄울문서의 경로를 적어 줘야 한다. 왕초보를 위해 적었다.