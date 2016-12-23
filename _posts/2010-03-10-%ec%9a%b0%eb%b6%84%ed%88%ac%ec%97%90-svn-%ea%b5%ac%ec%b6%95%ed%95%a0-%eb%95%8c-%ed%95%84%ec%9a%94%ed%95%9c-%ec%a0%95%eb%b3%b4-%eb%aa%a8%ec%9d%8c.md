---
title: 우분투에 SVN 구축할 때 필요한 정보 모음
author: 안형우
layout: post
permalink: /archives/382
aktt_notify_twitter:
  - yes
daumview_id:
  - 37012656
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
당연히 우분투에 svn을 설치해 놨어야 한다.

터미널에서 

<pre class="brush:plain">sudo apt-get install subversion</pre>

라고 쓰거나, 시냅틱 패키지 관리자에서 subversion을 찾아서 설치한다.

### 사용자 정보 경로  


/etc/apache2/dav_svn.passwd

### 사용자 정보 수정

비밀번호 수정 : htpasswd -m /etc/apache2/dav_svn.passwd {id}

새 사용자 생성 : htpasswd -c /etc/apache2/dav_svn.passwd {new-id}

### 구축시 참고 문서

<a target="_blank" class=" external" href="http://www.secret.pe.kr/5962">서브버전을 설치해 보아요</a> 와 <a target="_blank" class=" external" href="http://ssami.tistory.com/117">[Ubuntu] Subversion 설치 및 사용법</a> 을 참고해서 구축했다.  
폴더명, 사용자 추가 방법 등은 앞의 것을, 아파치 설정 방법은 뒤의 것을 참고.

### 이클립스의 SVN 플러그인, Subclipse 설명

subclipse 설명은 <a title="http://www.ibm.com/developerworks/kr/library/os-ecl-subversion/" class="external" href="http://www.ibm.com/developerworks/kr/library/os-ecl-subversion/">Eclipse에서 Subversion을 사용하는 방법 (한글)</a>를 참고.

subclipse 플러그인 저장소 주소는 <a title="http://subclipse.tigris.org/servlets/ProjectProcess?pageID=p4wYuA" class="external" href="http://subclipse.tigris.org/servlets/ProjectProcess?pageID=p4wYuA">subclipse Download and Install</a>의 Eclipse update site URL을 참고하든지 여튼 맘대로.

### 아파치의 SVN 유저 관리

아파치의 유저 정보 관리(아이디, 패스워드) 관련해서는 <a target="_blank" class=" external" href="http://httpd.apache.org/docs/2.0/ko/programs/htpasswd.html">htpasswd &#8211; basic authentication에 사용할 사용자파일을 관리한다</a>를 참고했다.

### SVN 기초 매뉴얼

<a class=" external" title="http://wiki.kldp.org/wiki.php/¼­º</body" href="http://wiki.kldp.org/wiki.php/%BC%AD%BA%EA%B9%F6%C0%FC%B1%E2%C3%CA%B8%C5%B4%BA%BE%F3">svn 기초 매뉴얼 가기</a>

### SVN에 저장소를 추가하기

만약 저장소를 추가하지 않고 기존 저장소에 다른 프로젝트를 붙이면, SVN은 동일한 프로젝트 안에 있는 다른 디렉토리로 인식한다. 따라서 한 프로젝트는 한 저장소에 매치시켜야 한다.

(저장소를 추가하는 방법은 http://heestory.kr/58가 괜찮은 설명을 제공한다. 단, 명령줄에 오타가 많으니 그대로 복사하지 말고 유심히 보고 하기 바란다.)

저장소 추가 명령어

<span style="color: rgb(153, 153, 153); ">/home/svn#</span> svnadmin create &#8211;fs-type fsfs 저장소이름

저장소 권한을 웹서버로 넘깁니다

<span style="color: rgb(153, 153, 153); ">/home/svn#</span> chown www-data.www-data -R *

/etc/apache2/mods-enabled/dav_svn.conf 에 다음을 추가. 웹으로 접근할 수 있도록 주소를 부여해 주는 거죠.

<pre class="brush:plain">&lt;Location /svn/저장소이름&gt;
 &nbsp;DAV svn
 &nbsp;SVNPath /home/svn/저장소이름
 &nbsp;AuthType Basic
 &nbsp;AuthName "pyrasis&#039;s Repository"
 &nbsp;AuthUserFile /usr/local/apache2/conf/passwd
 &nbsp;&lt;LimitExcept GET PROPFIND OPTIONS REPORT&gt;
 &nbsp;Require valid-user
 &nbsp;&lt;/LimitExcept&gt;
&lt;/Location&gt;
</pre>

apache 재시작 ( /etc/inid.d/apache2 restart )

이 다음은 안 해도 되는 거 같은데 (아마 그냥 서브클립스에서 처리하는 것 같음) 여튼 적어 둔다.

svn mkdir http://주소/svn/저장소이름/trunk

svn mkdir http://주소/svn/저장소이름/tags

svn mkdir http://주소/svn/저장소이름/branches

### SVN 커맨드 명령어로 하위폴더 삭제하기

<span style="color: rgb(153, 153, 153);">#</span> svn delete http://url/svn/폴더명명

### 최초 Import 명령

이클립스의 플러그인인 서브클립스로 대용량을 커밋하면 다운되는 경우가 있다.

따라서 이럴 경우에는 터미널에서 명령을 입력해 주자.

<pre class="brush:plain">svn import /svn/project http://192.168.0.51/svn/project -m "first loading"</pre>