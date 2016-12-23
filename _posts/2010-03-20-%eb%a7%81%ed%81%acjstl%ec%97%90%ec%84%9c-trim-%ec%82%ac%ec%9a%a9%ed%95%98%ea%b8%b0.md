---
title: '[링크]JSTL에서 trim 사용하기'
author: 안형우
layout: post
permalink: /archives/427
aktt_notify_twitter:
  - yes
daumview_id:
  - 36994969
categories:
  - 서버단
tags:
  - JAVA
---
trim() 함수를 모르는 사람은 이 글이 필요 없을 텐데 ㅋ

오늘 JSTL 사용하다가

<pre class="brush:html">&lt;c:if test="${not empty string}"&gt;
&lt;p&gt;${string}&lt;/p&gt;
&lt;/c:if&gt;
</pre>

이런 코드를 썼는데 string이 공백인데 <p> </p>가 출력되니까 안 좋았다. <p>에 배경색이 매겨져 있었던 것.

string에서 공백을 제거해야 했다.

그래서 찾아봤는데, <a target="_blank" href="http://www.roseindia.net/jsp/trim-fnJstlTag.shtml">http://www.roseindia.net/jsp/trim-fnJstlTag.shtml</a>를 찾을 수 있었다.

간단하다. 일단 맨 위에 fn 태그를 사용할 거라고 선언을 해 줘야 한다.

<pre class="brush:java">&lt;%@ taglib prefix="fn" uri="http://java.sun.com/jsp/jstl/functions" %&gt;
</pre>

그리고 사용법은 아래와 같다. 아까 코드를 고친 것이다.

<pre class="brush:html">&lt;c:if test="${not empty fn:trim(string)}"&gt;
&lt;p&gt;${fn:trim(string)}&lt;/p&gt;
&lt;/c:if&gt;
</pre>

참 쉽죠잉?