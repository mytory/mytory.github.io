---
title: '[java] yyyy-MM-dd HH:mm:ss 형식 날짜를 RSS 포맷 날짜로 변경하기'
author: 안형우
layout: post
permalink: /archives/1029
aktt_notify_twitter:
  - yes
daumview_id:
  - 36758100
categories:
  - 서버단
tags:
  - JAVA
---
2010-10-30 13:10:59 라는 날짜를 RSS 포맷 날짜인 Tue, 29 Mar 2011 12:56:46 +0900 형태로 고치게 하는 함수다.

SimpleDateFormat 클래스를 사용한다. 따라서 import해야 할 게 좀 있다. eclipse 사용하면 알아서 import 제안을 할 테니 굳이 여기 적지는 않겠다.

클래스 내에서 사용할 용도로 만들었다.

<pre class="brush:java">private String convertPubdateToRssFormat(String pubdate) throws ParseException {
  Date time = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").parse(pubdate);
  String rssFormat = new SimpleDateFormat("EEE, dd MMM yyyy HH:mm:ss +0900", Locale.ENGLISH).format(time);
  return rssFormat;
}</pre>

핵심적인 함수는 SimpleDateFormat Class의 parse 함수다. 문자열을 읽어 와서 날짜 정보를 읽어들인다. 어떤 형태의 문자열인지 앞에 써 주면 된다. 2행을 보면 알 수 있을 것이니 설명은 생략.

다음은 새로운 포맷으로 만드는 놈인데, 이 때 사용하는 함수는 format 함수다. String을 리턴한다.

RSS 포맷에 맞게 만들려면 SimpleDateFormat 생성자의 두 번째 인자값으로 locale을 넣어 줘야 한다. 당연히 ENGLISH로 한다.

그러면 RSS 포맷의 날짜가 훌륭하게 리턴된다.