---
title: '[java]이클립스 WTP 사용시 실제 WebContent 경로'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/770
aktt_notify_twitter:
  - yes
daumview_id:
  - 36808785
categories:
  - 서버단
tags:
  - JAVA
---
나는 처음에 마이 이클립스로 자바를 배웠기 때문에 tomcat 폴더에 실제 클래스 파일들이 들어가는 데 익숙했다. 그런데 이클립스에 WTP를 붙여서 사용하니까 그게 아니었다. tomcat 폴더는 비어 있는 것이었다. 헐~

그래서 클래스 로직 중에 현재 구동중인 파일의 실제 경로를 찍는 코드를 써넣은 다음에야 클래스파일들이 실제 어디로 들어가는지를 확인할 수 있었다.(즉, 이클립스의 서버 항목에서 publish를 했을 때 파일들이 들어가는 경로 말이다.)

바로 아래와 같은 경로였다.(워크스페이스 경로를 /home/mytory/workspace 로 가정한다.)

<pre class="brush:shell">/home/mytory/workspace/.metadata/.plugins/org.eclipse.wst.server.core/tmp0/wtpwebapps/
</pre>

저기 가면 클래스 파일들과 실제 FTP에 업로드할 수 있는 파일들을 찾을 수 있다.

자, 다음으로는 jsp 파일들을 해석한 java 파일의 경로다. jsp가 java로 해석된 후 class가 된다는 것은 다들 알고 있을 것이다. 다음 경로에서 jsp 파일을 해석한 java 파일을 찾을 수 있다.

<pre class="brush:shell">/home/mytory/workspace/.metadata/.plugins/org.eclipse.wst.server.core/tmp0/work/Catalina/localhost/_/org/apache/jsp</pre>

마지막으로 한 가지 팁을 주자면, .plugins는 숨김 폴더다. .으로 시작하는 이름은 리눅스에서는 숨김파일이 된다. 이놈을 보이게 하려면 노틸러스(리눅스용 탐색기)에서 Ctrl+H를 눌러 주면 된다.