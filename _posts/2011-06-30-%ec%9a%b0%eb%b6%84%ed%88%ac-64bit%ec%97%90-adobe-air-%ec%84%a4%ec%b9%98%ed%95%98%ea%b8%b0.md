---
title: 우분투 64bit에 adobe air 설치하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1409
aktt_notify_twitter:
  - yes
daumview_id:
  - 36708472
categories:
  - 기타
tags:
  - Ubuntu Family
---
어도비 에어는 요즘 크로스 플랫폼 개발 언어로 많이 사용된다. 한 마디로, air 기반으로 프로그래밍을 하면 그놈이 리눅스, 맥, 윈도우에서 다 돌아간다는 말이다.

내가 처음 그 말을 들었을 때 &#8216;자바잖아?&#8217; 하는 생각을 했었다. 뭐가 다른지는 정확히 모른다.

여튼간에, 트위터 클라이언트를 제작할 때 air가 많이 사용되는 바람에 나도 air에 대해 알게 됐고, 우분투 64bit를 사용하는 나는 트위터 클라이언트를 사용하기 위해 air를 깔아야 한다.

그런데 젠장 어도비에서 리눅스 64bit용을 위해서는 air 설치 파일을 공식적으로는 지원하지 않는다. 소스를 컴파일해야 한다.

내가 아무리 개발자라지만, 웹 개발자고 그래서 소스 컴파일따위 어떻게 하는지 모른다. 그래서 구글신에게 물어 봤다.

구글신은 영어와 한글로 각기 답해 주셨다. 그래서 한글로 된 문서를 여러분에게 소개한다. 아래 글이다.

<del>Adobe Air를 ubuntu 10.10 64bit 설치하기.</del>  지금은 사라진 문서가 됐다.

글에서는 우분투 10.10을 기준으로 설명했지만 나는 지금 11.04를 사용하고 있는데 잘 작동했다. 이후 버전에서도 아마 별 탈 없이 잘 될 거라 생각한다. 워 20.10 버전에선 어떨지 모르지만 말이다.

나도 간략하게 설명하면, 일단 위 글에서는 커맨드라인 코드가 깨져 나오는데, 제대로 바꿨다.

터미널을 열고 아래와 같이 한 줄씩 입력해 주면 된다.

[어도비 에어 공식 웹사이트에서 .deb 파일을 다운][1]받고, 다운받은 폴더에 가서 아래 명령어들을 입력해 줘야 하는 거다.

<pre>mkdir tmp
dpkg-deb -x adobeair.deb tmp
dpkg-deb --control adobeair.deb tmp/DEBIAN
sed -i "s/i386/all/" tmp/DEBIAN/control
dpkg -b tmp adobeair-64.deb</pre>

그러면 tmp 폴더가 생기고 adobeair-64.deb 라는 파일이 생성됐을 거다.

그놈으로 설치하면 된다.

 [1]: http://get.adobe.com/kr/air/