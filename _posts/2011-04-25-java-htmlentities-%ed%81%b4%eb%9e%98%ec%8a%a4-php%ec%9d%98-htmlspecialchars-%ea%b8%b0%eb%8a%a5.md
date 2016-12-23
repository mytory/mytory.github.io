---
title: '[JAVA] HTMLEntities 클래스 &#8211; PHP의 htmlspecialchars 기능'
author: 안형우
layout: post
permalink: /archives/1151
aktt_notify_twitter:
  - yes
daumview_id:
  - 36742801
categories:
  - 서버단
tags:
  - JAVA
---
JAVA에서 <를 <으로 변경해야 하는 일이 생겼다.

PHP에는 이놈이 기본기능(htmlspecialchars)으로 있지만, JAVA에는 기본 기능으로 있지 않다.

따라서 클래스를 사용해야 한다.

그것을 위해 있는 게 바로 HTMLEntities 클래스다. java.net에서 오픈소스로 개발되는 놈이다.

*   [HTMLEntities Class 소개][1]
*   [HTMLEntities Class 다운로드][2] : 다운받음 Zip 파일에서 www 폴더에 있는 jar를 사용하면 된다.

사용법은 간단하다.

일단 import를 해야 하는데, 임포트 경로는 com.tecnick.htmlutils.htmlentities.* 로 하면 된다.

코드는 아래처럼 쓴다.

<pre class="brush:java">String str = HTMLEntities.htmlentities(str);</pre>

몇 가지 매서드가 더 있다. 압축 풀면 나오는 파일들 중 doc 폴더에서 index.html을 열면 문서가 잘 정리돼 있으니까 그걸 보면 된다.

 [1]: http://www.tecnick.com/public/code/cp_dpage.php?aiocp_dp=htmlentities
 [2]: http://sourceforge.net/projects/htmlentities/