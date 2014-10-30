---
title: '[JSTL] session에 접근하는 다양한 방법'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/323
aktt_notify_twitter:
  - yes
daumview_id:
  - 37058786
categories:
  - 서버단
tags:
  - JAVA
---
JSTL을 사용하면 <% %>, <%= %> 따위의 문자를 사용하지 않아도 되므로 코드가 덜 어지럽다.

그런데 최근 코딩중 곤란한 일이 생겼다. 세션에 저장한 객체에 접근이 안 되는 것이었다.

JSTL로 세션에 접근하는 기본적인 방법은, 그냥 ${sessionName}이다. 즉, 서블릿에서 

<pre class="brush:java">session.setAttribute("sessionName", sessionInfo);</pre>

이렇게 저장을 했다면 JSTL 페이지에서 그냥 ${sessionName}으로 호출하면 된다.

그런데 그렇게 접근이 안 되는 것이었다. 그래서 한참 고생하던 차에 원인을 알게 됐다. 서블릿을 작성한 사람이 코드를 이렇게 써놨었다.

<pre class="brush:java">session.setAttribute("session", sessionInfo);</pre>

자, 이렇게 썼을 때 어떤 문제가 생겼는지 보자.

jsp 페이지에 ${session} 이라서 써서 화면에 출력시키고 나서야 문제점을 알게 됐다.

${session}은 전체 세션 목록을 의미했던 것이다. 즉, ${session}이라고 쓰자 이런 메세지를 출력했다.

<p style="font-weight: bold;">
  {falg=true, flag2=true,<br /> session=com.login.SessionInfo@a79c31}
</p>

그래서 이렇게 접근하니까 그제서야 내가 의도한대로 작동을 했다.

${session.session}

이렇게 정리할 수 있겠다.

JSTL에서 세션 변수에 접근하는 방법은 세 가지(?)다.

1.  그냥 ${sessionName}으로 접근한다.
2.  ${session.sessionName}으로 접근한다.
3.  scope=&#8221;session&#8221;으로 접근한다.