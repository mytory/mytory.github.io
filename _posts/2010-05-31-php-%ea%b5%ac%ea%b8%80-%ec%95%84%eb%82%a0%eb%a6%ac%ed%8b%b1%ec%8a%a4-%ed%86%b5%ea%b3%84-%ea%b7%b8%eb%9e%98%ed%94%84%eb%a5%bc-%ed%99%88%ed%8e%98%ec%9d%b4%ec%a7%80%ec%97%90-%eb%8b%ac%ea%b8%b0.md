---
title: '[PHP] 구글 아날리틱스 통계 그래프를 홈페이지에 달기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/629
aktt_notify_twitter:
  - yes
daumview_id:
  - 36904839
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
**[훌륭한 PHP 클래스][1]를 발견했다. 개발자라면 이놈을 사용하기보다는 [그걸][1] 사용하기 권한다. (2011-07-13 추가.)**

&#8212;&#8212;

안타깝게도 설치형 블로그만 할 수 있다. 일단 스크린샷 먼저.

<div>
  <img class="aligncenter" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile4.uf.170662584D4BC94915FB2F.jpg" alt="" width="525" height="416" /></p> <div>
    일단 <a href="http://www.myphpetc.com/2009/12/display-google-analytics-with-php.html" target="_blank">google analytics graph API</a>를 보자.(정확한 명칭은 Display Google analytics with php, jQuery and flot 이다. 대충 번역하면, 구글 아날리틱스 통계를 php, jQuery와 flot을 이용해서 보자.) <a href="http://sites.google.com/site/myphpetc/Home/analytics.zip" target="_blank">다운로드할 수 있는 링크</a>를 클릭하면 파일을 통째로 받을 수 있다. 혹시 몰라 여기 첨부한다.
  </div>
  
  <div>
    <a class="aligncenter" href="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile7.uf.19467B4A4D4BC949333F5D.zip">cfile7.uf.19467B4A4D4BC949333F5D.zip</a>
  </div>
  
  <div>
    이 API를 사용하려면 <a href="http://curl.haxx.se/libcurl/php/" target="_blank">PHP의 curl 확장</a>이 설치돼 있어야 한다. (curl은 url로 파일을 긁어 오는 라이브러리인 것 같다.) 우분투 사용자들이라면 간편하게 설치할 수 있다.
  </div>
  
  <div>
    <pre class="brush:plain">sudo apt-get install php5-curl</pre>
  </div>
  
  <div>
    사용법은 정말 간단하다.
  </div>
  
  <div>
    홈페이지의 어딘가에 압축을 푼 파일들을 넣고, 접근하면 된다. index.html이 있으니까 그리로 접근하면 그만이다.
  </div>
  
  <div>
    조치가 필요한 게 있다.
  </div>
  
  <div>
    일단, analytics.php 를 열어서 7번째 줄과 8번째 줄에 다음 코드를 넣는다.
  </div>
  
  <pre class="brush:php:firstline[7]">$login = &#039;your_login_id&#039;;
$password = &#039;password&#039;;</pre>
  
  <div>
    그리고 cache.txt 파일의 권한을 777로 해 준다.(쓰기 권한까지 줘야 한다는 말이다.) 그리고 cache.txt 파일의 내용을 지운다. 내용이 없어야 구글 아날리틱스에서 새로 내용을 긁어오기 때문이다.
  </div>
  
  <div>
    그러면 작동하기 시작한다.
  </div>
  
  <div>
    원하는 기간을 설정해야 한다. analytics.php 파일에서 다음 라인을 찾아서 날짜를 집어 넣으면 된다.
  </div>
  
  <div>
    <pre class="brush:php">$data = $api-&gt;data($account[&#039;tableId&#039;], &#039;ga:week&#039;, &#039;ga:visits&#039;, &#039;ga:week&#039;, &#039;2009-07-05&#039;, &#039;&#039;, &#039;52&#039;);</pre>
  </div>
  
  <div>
    2009-07-05는 시작날짜고, 52는 이후 52주간의 데이터를 긁어 오라는 말이 되겠다.
  </div>
  
  <div>
    열라 간단하다.
  </div>
</div>

 [1]: http://mytory.local/archives/1469 "[번역] 구글 아날리틱스 PHP Class"