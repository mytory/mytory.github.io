---
title: 'Filezilla Server, Passive 모드 설정 &#8211; 웹브라우저에서 접속할 수 있도록 하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/9878
daumview_id:
  - 42977284
categories:
  - 기타
tags:
  - Program
---
파일질라 서버 세팅을 했는데, 공개 폴더와 anonymous 계정을 만들어서 웹브라우저로 파일을 다운받을 수 있게 만들려고 했다. 근데 이게 ftp 클라이언트들에선 접속이 잘 되는데, 웹브라우저로는 접속이 안 되는 거다.

검색했고, 찾았다. [Re: Error 421 can&#8217;t create socket][1] 여기서 말이다.

여튼 사용자 그룹을 만들고 홈폴더 설정도 하고, anonymous라는 사용자도 설정했다고 가정한다. 당연히 공유기에선 포트포워드로 ftp 서버 컴퓨터로 포트를 열어 줬다고 가정한다. 그런데도 안된다면?

## Passive 모드 설정

브라우저는 Passive 모드를 사용해서 ftp에 접속한다고 한다. 그런데 Filezilla Server가 공유기 뒤에서 Passive 모드를 제대로 사용하려면, 두 가지를 해 줘야 한다.

*   <span style="line-height: 1.714285714; font-size: 1rem;">서버의 실제 인터넷 ip 주소를 알려 줘야 한다 : 그러니까, 192.168.*** 이런 거 말고 말이다. 실제 인터넷 ip를 알고 싶다면 공유기 관리자모드에 들어가거나 <a href="http://www.whatismyip.com/">what is my ip</a> 같은 데 들어가서 보면 된다.</span>
*   파일 전송에 사용할 수 있는 포트 범위를 알려 줘야 한다. 100개쯤의 범위로 설정을 하라고 하더라. 웬만하면 50000번 이상으로 설정하고 말이다. ftp 포트로 설정한 것을 사용하면 안 되고. 그건 ftp 연결 port지 파일 전송 port가 아니기 때문이라고 한다.

아래 그림을 참고하라.

[<img class="aligncenter" alt="" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/filezilla-server-passive.png" width="607" height="418" />][2]

<span style="line-height: 1.714285714; font-size: 1rem;">위에서 빨간 줄 친 곳을 입력하면 된다.</span>

이렇게 한 뒤 브라우저로 접속하면 잘 될 거다.

&nbsp;

 [1]: https://forum.filezilla-project.org/viewtopic.php?f=6&t=27163#p102246
 [2]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/filezilla-server-passive.png