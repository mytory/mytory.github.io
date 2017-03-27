---
title: '[PHP] 외부 URL의 내용 얻어오기(cURL, file_get_contents)'
author: 안형우
layout: post
permalink: /archives/649
aktt_notify_twitter:
  - yes
daumview_id:
  - 36883042
categories:
  - 서버단
tags:
  - PHP
---
<pre class="brush: php">header(&#039;Content-Type: text/xml&#039;);
  $curl = curl_init();
  $timeout = 5; // 0으로 하면 시간제한이 없다.
  $url = &#039;http://feedproxy.feedburner.com/jquery/&#039;;
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
  print curl_exec($curl);
  curl_close($curl);</pre>

뭐 cURL을 이용한 코드는 위와 같다.

print curl_exec($curl) 하면 내용을 출력하게 된다.

단, cURL이 설치돼 있어야 한다. 우분투에서의 설치방법은 <a href="http://mytory.textcube.com/entry/PHP-%EA%B5%AC%EA%B8%80-%EC%95%84%EB%82%A0%EB%A6%AC%ED%8B%B1%EC%8A%A4-%ED%86%B5%EA%B3%84-%EA%B7%B8%EB%9E%98%ED%94%84%EB%A5%BC-%ED%99%88%ED%8E%98%EC%9D%B4%EC%A7%80%EC%97%90-%EB%8B%AC%EA%B8%B0" target="_blank">이 글</a>의 중간쯤에 나온다.(윈도우 쪽은 설치방법은 없고, 설치할 수 있는 홈페이지에 가서 직접 살펴 봐야 할 거다. cURL로 검색하면 많이 나올 거고, APM Setup 7 부터는 cURL를 서버 설정에서 체크해 주면 켜진다.)

아래는 file\_get\_contents 함수를 이용한 건데, 간편하지만, 막아놓은 곳이 많다고 한다.

<pre class="brush: php">// file_get_contents() 가 서버에서 켜져 있다면, 
  // 이게 가능한 가장 짧은 코드다.
  header(&#039;Content-Type: text/xml&#039;);
  print file_get_contents(&#039;http://jquery.com/blog/feed&#039;);</pre>

이상의 코드는 모두 <a href="http://wikimain.cafe24.com/wiki/Wiki.jsp?page=Jquery13" target="_blank">《jQuery 1.3 &#8211; 작고 강력한 자바스크립트 라이브러리》</a>의 9장 예제에서 가져온 것이다.<del>(압축을 풀면 나오는 것 중 news/feed.php 파일이다.)</del> 한글 소스코드는 웹사이트가 날아간 듯하고, 원서 소스코드에는 9장 코드가 빠져 있다. 뭐지;;