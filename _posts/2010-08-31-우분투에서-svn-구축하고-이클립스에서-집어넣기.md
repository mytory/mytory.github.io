---
title: 우분투에서 SVN 구축하고 이클립스에서 집어넣기
author: 안형우
layout: post
permalink: /archives/759
aktt_notify_twitter:
  - yes
daumview_id:
  - 36814808
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
이 글은 특정 개발 환경을 대상으로 한 글입니다. 다만, 중간중간에 나오는 svn 명령어는 쓸모가 있을 겁니다.

일단 우분투에서 subversion을 설치합니다. 시냅틱 패키지 관리자에서 subversion으로 검색해서 설치하거나, 터미널에 아래 명령어를 치면 되겠죠.

<pre class="brush:plain">sudo apt-get install subversion</pre>

자, 그러면 일단 설치는 완료됐죠?

원하는 위치에 폴더를 하나 만들어 줍니다. 그 폴더를 svn 데이터를 넣게 됩니다.

폴더를 노틸러스(탐색기)에서 만들어도 되고, 터미널에서 만들어도 됩니다. 터미널에서 만들려면 원하는 위치에서 아래 명령어를 쓰세요.

<pre class="brush:plain">mkdir svn-repos</pre>

자, 저는 책에서 배운대로 svn-repos 라는 폴더를 만들었습니다. 책은 <a href="http://koko8829.tistory.com/23" target="_blank">《서브버전을 이용한 실용적인 버전 관리》</a>입니다. ㅋ 거기 보니까 폴더 이름을 저렇게 주더라고요.

자, svn-repos의 경로를 /home/mytory/svn-repos 라고 가정하겠습니다.

그러면 svn 저장소를 실제로 생성하라고 말해 줘야겠죠?

<pre class="brush:plain">svnadmin create /home/mytory/svn-repos</pre>

이렇게 명령을 내리고 나면 svn-repos 폴더에 뭔가 막 생깁니다. 한 번 들어가서 내용을 보시면 알 수 있어요.

ls 명령으로 디렉토리 내용을 보시면 되겠죠.

<pre class="brush:plain">README.txt  conf  db  format  hooks  locks</pre>

위와 같은 놈들이 있습니다. README.txt 외에는 모두 폴더죠. 영어 잘하시면 README도 읽어 보시고.

여기까지 왔으면 기초적인 건 완료됐습니다.

## 외부에서 접속할 수 있도록 SVN 서버 구축

그다음, 여기에 외부에서 접속할 수 있도록 서버를 구축해야 하겠죠?

두 가지 방법이 있습니다. 아파치를 이용하는 방법과 svn이 자체로 제공하는 svnserve를 사용하는 방법입니다.

아파치를 사용하는 방법은 따로 찾아 보세요. 저는 svnserve를 이용하는 방법만 설명하겠습니다.

svnserve 실행명령은 간단한데, 아래와 같습니다.

<pre class="brush:plain">svnserve -d -r /home/mytory/svn-repos</pre>

자, -d는 데몬으로 돌리겠다는 말입니다.(근데 데몬으로 돌리겠다는 말이 뭐죠;;)

-r는 여기를 루트 경로로 하겠다는 말이 되겠습니다. 따라서 경로를 써 줘야 하겠죠? ^^ 그래서 /home/mytory/svn-repos 라고 절대경로를 적어 준 겁니다.

자, 서버만 돌리면 뭐합니까. 사용자 권한을 설정해 줘야겠죠.

/home/mytory/svn-repos/conf 로 이동합니다. 그리고 자신이 선호하는 에디터로 설정파일을 엽니다. 건드려 줘야 할 설정 파일은 두 종류인데, svnserve.conf 와 passwd 입니다. 일단 svnserve.conf 부터 열어 보죠.

만약 로컬에서 작업하고 있다면 gedit로 열면 되겠죠? 원격에서 콘솔 작업 중이라면 저는 nano를 사용하겠습니다. 저는 콘솔 에디터의 초보거든요 ㅋ

<pre class="brush:plain">sudo nano /home/mytory/svn-repos/conf/svnserve.conf</pre>

권한이 필요없다면 sudo는 빼도 되겠죠? gedit를 사용하신다면 그냥 탐색기에서 직접 작업하셔도 되겠죠. 아니면 콘솔에 nano 대신 gedit라고 써 줘도 될 거예요.

자, 내용을 뜯어 보면 온통 맨 앞에 # 붙은 문장 투성이입니다.

그렇습니다. 모두 주석처리돼 있습니다.

다 지우고 다시 써도 되고 찾아서 주석을 제거해 줘도 됩니다.

필요한 부분은 아래 네 줄입니다.

<pre class="brush:plain">[general]
anon-access = none
auth-access = write
password-db = passwd</pre>

자, anon-access는 손님이 들어왔을 때 어디까지 할 수 있게 해 주겠냐는 겁니다. 주석처리돼 있는 원래 거엔 read라고 돼 있습니다. 그렇게 해도 상관없다면 그렇게 하면 되고요, none 이라고 쓰면 아무 것도 못 하게 합니다.

auth-access는 권한이 있는 사용자가 들어왔을 때 어디까지 허용할 거냐 하는 겁니다. write라고 쓰면 읽기 쓰기 다 되는 거죠.

password-db는 파일명을 적는 겁니다. passwd라는 파일에 사용자 정보를 넣겠다는 말이 되겠죠.

자, 저장하고 나옵니다. nano에선 Ctrl+X 를 누르면 나가는 게 되고, 저장하겠냐고 묻습니다. y 버튼 누르면 파일명을 뭘로 할 거냐고 묻죠. 덮어 쓸 거면 엔터 치면 됩니다.

여튼, 나와서 다시 같은 폴더에 있는 passwd 파일을 편집합니다. nano든 gedit든 알아서 passwd 파일을 여세요. 처음에 열만 달랑 아래 세 줄이 있습니다.

<pre class="brush:plain">[users]
# harry = harryssecret
# sally = sallyssecret</pre>

예시가 주석처리돼서 있죠? 저는 id를 mytory라고, 비밀번호는 1234qwer 로 할 생각입니다. 그러면 이렇게 적어 주면 되겠죠.

<pre class="brush:plain">[users]
# harry = harryssecret
# sally = sallyssecret
mytory = 1234qwer</pre>

여러 명을 할 거면 줄바꾸고 똑같은 방식으로 적어 주면 됩니다.

자, 저장하고 나옵니다.

svnserve는 굳이 재부팅하지 않아도 변경사항이 잘 적용됩니다.

여기까지 했다면 svn 저장소 생성과 로그인하는 서버 구축까지 완료된 겁니다.

이제 이클립스에서 붙여 주기만 하면 되겠죠?

## 이클립스 프로젝트를 svn에 넣기

일단 이클립스에 subclipse 플러그인을 설치한 것으로 이해하겠습니다.

svn에 넣고 싶은 프로젝트를 선택한 다음 마우스 오른쪽 버튼을 누릅니다. team > share 를 선택합니다.

그러면 저장소는 뭐냐고 묻는데요, 새 저장소 등록을 해 줍니다. create 뭐시기라고 써 있습니다.

거기에 svn의 주소를 적습니다. 로컬이라면 svn://127.0.0.1 이렇게 적어 주기면 하면 됩니다.

svn:// 이 부분은 svnserve를 사용하고 있다는 걸 알려 주는 거죠.

만약 iptime 같은 걸로 연결돼 있는 사내 서버라면 해당 서버의 IP 주소를 적어 주면 됩니다.(사실 외부에서 접속할 수 있는 IP를 적으면 외부에서도 접속 가능하겠죠. IP에 도메인을 연결해 둔 상태라면 도메인을 썯 됩니다.) 예컨대, svn 서버로 사용하는 컴퓨터의 IP가 192.168.0.33이라고 합시다. 그러면 svn://192.168.0.33 이라고 적어 주면 이게 svn 주소가 됩니다.(아파치로 하면 svn-repos 같은 거 적어 줘야 하는데, svnserve에서 svn-repos를 루트로 잡았기 때문에 따로 폴더명을 적어줄 필요는 없습니다.)

자, 그러면 뭐라뭐라 나옵니다 원하는대로 해 주세요. 그리고 마지막에 finish를 누르면 일단 svn에 아까 고른 프로젝트가 들어가고 싱크모드가 됩니다. 여기서 모든 파일을 커밋해버리면 그 때부터 svn과 프로젝트가 완전히 통합됩니다.