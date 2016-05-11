---
title: 우분투에서 쉘 스크립트(sh)를 이용해 여러 개의 설치 파일을 한꺼번에 설치하는 실행 파일을 만들려고 한다면
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/168
aktt_notify_twitter:
  - yes
daumview_id:
  - 37167414
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
나는 우분투 초보다. 그러나 사무실에서는 고수 중 하나다;;

여러 개의 deb 파일로 이루어진 테마를 사람들이 간편하게 설치할 수 있도록 쉘 스크립트(sh) 파일을 만들고 싶어 좀 찾아봤다. 우분투의 쉘 스크립트는 기본적으로 dos 시절의 bat 파일과 같은 개념으로 생각하면 된다고 한다. 물론 고급 기능을 사용하면 프로그래밍이라고 부를 수도 있다고 한다.

<a href="http://www.google.co.kr/search?hl=ko&newwindow=1&q=쉘+스크립트+강좌&btnG=검색&lr=&aq=4&oq=쉘+스크립트+" target="_blank">쉘 스크립트 강좌를 찾고 싶으면 구글에서 검색</a>해 보자. 내가 찾은 괜찮다고 하는 쉘 스크립트 강좌는 여기다 : <a href="http://wiki.kldp.org/HOWTO//html/Adv-Bash-Scr-HOWTO/index.html" target="_blank">http://wiki.kldp.org/HOWTO//html/Adv-Bash-Scr-HOWTO/index.html</a>

나는 초보적인 것 중의 초보적인 것만 사용했다.

1.  일단 노틸러스(파일 탐색기)에서 폴더의 빈 공간에 오른쪽 버튼을 눌러 &#8216;문서 만들기 &#8211; 빈 파일&#8217;을 선택한다.
2.  실행.sh 따위의 파일 이름을 붙여 준다.
3.  더블클릭해서 gedit 따위의 텍스트 편집기로 파일을 연다.
4.  맨 앞줄에는 #!/bin/sh를 써 준다.(근데 파일 확장자가 sh로 돼 있으면 안 써줘도 되는 것 같다. 만약 맨 앞줄에 #!/bin/sh가 써 있으면 확장자에 상관없이 쉘 스크립트로 인식하는 것 같다.)
5.  앞서 <a href="http://mytory.textcube.com/entry/%EC%9A%B0%EB%B6%84%ED%88%AC%EC%97%90%EC%84%9C-%EC%97%AC%EB%9F%AC-%EA%B0%9C%EC%9D%98-deb-%ED%8C%A8%ED%82%A4%EC%A7%80-%EC%84%A4%EC%B9%98-%ED%8C%8C%EC%9D%BC%EC%9D%84-%ED%95%9C%EA%BA%BC%EB%B2%88%EC%97%90-%EC%84%A4%EC%B9%98%ED%95%98%EA%B3%A0-%EC%8B%B6%EB%8B%A4%EB%A9%B4" target="_blank">우분투에서 여러 개의 deb 패키지 설치 파일을 한꺼번에 설치하고 싶다면</a>에서 설명한 것처럼, 두 번째 줄에 이렇게 써 넣는다 : sudo dpkg -i *.deb
6.  저장하고 닫는다.
7.  만든 실행.sh 파일에서 마우스 오른쪽 버튼을 눌러 **속성**으로 들어간다. **권한 탭**으로 가서 **&#8216;파일을 프로그램으로 실행 허용&#8217;**에 체크한다. 우분투 9.10이므로 하위 버전에도 이 항목이 있는지 체크해 보진 못했다. 만약 이 항목을 찾을 수 없다면 터미널에 들어가서 명령줄로 파일 권한을 바꿔 주면 된다. 터미널 명령줄로 권한 바꾸는 명령어는 **chmod +x 실행.sh** 다.  
    <img class="aligncenter" src="/uploads/legacy/old-images/1/cfile1.uf.195AD14D4D4BC87A2CEF28.png" alt="" width="464" height="434" />
8.  여기까지 했으면 실행파일이 생성된 것이다. 여러 개의 deb 파일도 한꺼번에 설치할 수 있도록 sh 파일이 만들어진 것.

나는 여기까지 한 후 설명서에 이렇게 적었다. &#8220;파일 압축을 풀고 폴더로 들어가서 실행.sh를 더블클릭한 후 &#8216;터미널에서 실행&#8217;을 선택하세요&#8221; 그러면 초보들이 터미널에 명령줄 같은 것 입력하지 않고, 또 여러 개의 파일을 일일이 더블클릭할 일 없이 편리하게 여러 개의 패키지를 설치할 수 있다.