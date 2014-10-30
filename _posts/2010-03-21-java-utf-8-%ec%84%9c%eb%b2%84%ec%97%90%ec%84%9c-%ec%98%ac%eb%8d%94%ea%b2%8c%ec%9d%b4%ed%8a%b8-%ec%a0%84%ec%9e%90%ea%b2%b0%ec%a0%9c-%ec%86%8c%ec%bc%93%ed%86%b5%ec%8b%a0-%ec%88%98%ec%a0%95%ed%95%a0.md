---
title: '[JAVA] UTF-8 서버에서 올더게이트 전자결제 소켓통신 수정할 부분'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/433
aktt_notify_twitter:
  - yes
daumview_id:
  - 36991947
categories:
  - 서버단
tags:
  - JAVA
---
초보라 삽질을 좀 많이 했다.

php에도 붙여 봤는데 그 때는 전송 부분에 iconv를 사용해야 했다. 은행은 euc-kr을 사용하고, 우리 홈페이지는 utf-8을 사용했기 때문이다. 만약 홈페이지가 euc-kr로 돼 있는 경우라면 이 글이 필요 없을 것이다.

<pre class="brush:php">//은행으로 정보를 전송하기 전에
$String=iconv("utf-8","euckr",$String);
//전송하고 나서 응답받은 메시지를 보려면 
$String=iconv("euckr","utf-8",$String);
</pre>

이렇게 했었다.

이번에 java로 된 홈페이지에 올더게이트 결제를 붙여야 했다. 이번에도 캐릭터 인코딩이 문제였다. 결정적 힌트를 제공한 글은 <a href="http://www.google.co.kr/#hl=ko&xhr=t&q=&#039;java+socket+encoding+%EC%82%BD%EC%A7%88%EA%B8%B0&#039;&cp=26&pf=p&sclient=psy&newwindow=1&site=&source=hp&aq=f&aqi=&aql=&oq=&#039;java+socket+encoding+%EC%82%BD%EC%A7%88%EA%B8%B0&#039;&pbx=1&fp=9bc2c99ee635e670" target="_blank">&#8216;java socket encoding 삽질기&#8217;</a>였다.

내가 사고를 진행한 순서대로 써보겠다.

우선, 은행 쪽에서 뭔가 메세지가 오는데 깨져서 왔다. 은행쪽 인코딩이 우리 것과 안 맞는다는 판단을 했고, 메시지 수신부를 찾아서 소스를 고쳤다. 아래처럼 &nbsp;소스를 고치고 나서야 메시지를 제대로 볼 수 있었다.

<pre class="brush:java">//ProcessRequest함수에 있는 부분
RecvMsg = new String( readMsg( iRecvLen ) );
//위와 같은 소스를
RecvMsg = new String( readMsg( iRecvLen ) , "MS949");
//이렇게 고쳤다.
</pre>

그러자 은행쪽에서 보내 주는 메시지를 제대로 볼 수 있었다. &#8216;결제실패&#8217;라는 메시지였다.

당연히 보내는 쪽에서도 은행쪽 인코딩인 MS949로 해야 제대로 결제가 진행될 거라고 판단했다. 메시지 전송부를 찾아서 아래처럼 고쳤다.

<pre class="brush:java">//역시 ProcessRequest함수에 있는 부분
this.writeMsg(SendMsg.getBytes());
//위와 같은 소스를
this.writeMsg(SendMsg.getBytes("MS949"));
//위와 같이 고쳤다.
</pre>

그런데 여전히 &#8216;결제실패&#8217;라는 메시지가 왔다. 당황스러웠다.

다음날이 되서야 생각이 진행됐다. &#8216;getBytes가 저기 말고도 여러 군데 있는 게 아닐까?&#8217;

Ctrl+F로 getBytes를 다 찾았다. 역시, 여러 군데 getBytes가 있었다. 일일이 찾아서 고쳤다.(처음부터 getBytes()를 getBytes(&#8220;MS949&#8243;)로 일괄변환했다면 편했을 텐데;;)

그러자 결제가 제대로 되기 시작했다. 완전 다행.

정말 아래 글이 최고의 실마리를 제공했다. 필자에게 감사한다.

<a href="http://www.google.co.kr/#hl=ko&xhr=t&q=&#039;java+socket+encoding+%EC%82%BD%EC%A7%88%EA%B8%B0&#039;&cp=26&pf=p&sclient=psy&newwindow=1&site=&source=hp&aq=f&aqi=&aql=&oq=&#039;java+socket+encoding+%EC%82%BD%EC%A7%88%EA%B8%B0&#039;&pbx=1&fp=9bc2c99ee635e670" target="_blank">&#8216;java socket encoding 삽질기&#8217;</a>