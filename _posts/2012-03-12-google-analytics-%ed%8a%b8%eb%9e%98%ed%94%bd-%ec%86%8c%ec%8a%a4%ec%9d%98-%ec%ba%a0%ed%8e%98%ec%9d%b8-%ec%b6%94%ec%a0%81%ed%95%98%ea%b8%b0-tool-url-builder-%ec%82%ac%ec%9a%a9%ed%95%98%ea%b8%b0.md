---
title: '[Google Analytics] 트래픽 소스의 캠페인 추적하기 &#8211; Tool: URL Builder 사용하기'
author: 안형우
layout: post
permalink: /archives/2318
aktt_notify_twitter:
  - yes
daumview_id:
  - 36621427
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
요약 : [구글 아날리틱스가 제공하는 URL Builder][1]를 이용하면, 메일링 리스트, 웹자보, 배너 등을 클릭해서 누가 얼마나 들어왔는지 추적할 수 있다.

피드버너를 사용하는 사람들 중, 추적을 사용하는 사람들은 아마 URL 뒤에 붙은 긴 변수들을 본 적 있을 거다.

<pre>http://mytory.net/archives/2314?utm_source=feedburner&utm_medium=feed&utm_campaign=Feed%3A+mytory_tc+%28%EC%9B%B9%EC%9C%BC%EB%A1%9C+%EB%A7%90%ED%95%98%EA%B8%B0%29</pre>

위 URL은 내 RSS를 구독하는 사람들이 클릭해서 들어왔을 때의 URL이다. 추가로 붙는 변수는 아래와 같이 구성돼 있다.

*   utm_source=feedburner
*   utm_medium=feed
*   utm\_campaign=Feed%3A+mytory\_tc+%28%EC%9B%B9%EC%9C%BC%EB%A1%9C+%EB%A7%90%ED%95%98%EA%B8%B0%29

GET 변수가 이렇게 세팅돼 있다.

utm\_campaign의 값은 &#8220;Feed: mytory\_tc (웹으로 말하기)&#8221;를 URL 형식으로 인코딩한 거다.

위 구분에서 잘 알 수 있듯이 소스는 중간쯤 구체적인 것을, medium은 가장 넓은 범주의 미디어를, 그리고 캠페인은 가장 구체적인 것을 적는다.

위 URL에 따라 Google Analytics는 이렇게 통계를 잡아 준다.

<img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/google-analytics-url-builder-1.jpg" alt="" width="645" height="82" />

구글 아날리틱스의 최신 버전에서 **트래픽 소스 > 소스 > 캠페인** 항목을 보면 볼 수 있다.

## URL을 수동으로 세팅할 수 있다

처음에 관심을 가진 건 Feedburner 의 URL을 보고서였다. 그런데, 이걸 수동으로 만들어도 작동하지 않을까? 하는 생각을 해 본 적이 있다. 그래서 찾아 봤더니 역시나 수동으로 세팅해도 작동하는 것이었다.

수동으로 세팅을 해 주는 툴도 있었다. [Tool: URL Builder][1]가 그것이다.

<img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/google-analytics-url-builder-2.jpg" alt="" width="676" height="673" />

위 주소로 가면 이런 화면이 나온다.

캠페인 소스에는 mailling4 같은 것을, Medium에는 email 따위를, 캠페인 Name에는 &#8220;2012년 봄 특판 행사&#8221; 따위를 넣으면 된다. 물론 URL도 넣어 준다.

그리고 나서 Generate URL 버튼을 누르면 URL을 뽑아 준다. 한글은 URL 인코딩을 해 주니 편하다.

( [URL Builder Chrome 확장][2]도 있다. )

## 응용

이걸 응용할 수 있는 곳은 바로 메일링 리스트와 웹자보다. 이메일을 클릭해서 누가 얼마나 들어왔는지, 웹자보를 클릭해서 누가 얼마나 들어왔는지 알고 싶은데 그러헥 하려면 복잡하고&#8230; 좀 고민이었던 적이 있을 것이다.

완벽한 해결책은 아니지만, (예컨데, 저 URL을 누가 트위터로 퍼가면 통계가 교란될 수 있을 듯하다.) URL Builder를 이용하면 그런 것들을 추적할 수 있다.

 [1]: http://support.google.com/googleanalytics/bin/answer.py?hl=en&answer=55578
 [2]: https://chrome.google.com/webstore/detail/gaidpiakchgkapdgbnoglpnbccdepnpk