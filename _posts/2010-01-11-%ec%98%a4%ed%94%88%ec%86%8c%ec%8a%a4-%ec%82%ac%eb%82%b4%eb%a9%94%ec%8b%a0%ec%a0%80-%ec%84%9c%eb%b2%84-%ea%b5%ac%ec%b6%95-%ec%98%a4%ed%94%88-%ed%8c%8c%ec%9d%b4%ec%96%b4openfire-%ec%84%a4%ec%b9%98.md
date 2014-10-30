---
title: 오픈소스 (사내)메신저 서버 구축, 오픈 파이어(openfire) 설치방법과 세팅(리눅스 기준)
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/212
aktt_notify_twitter:
  - yes
daumview_id:
  - 37153782
categories:
  - 기타
tags:
  - Program
---
[참고 : 관리자 계정의 비번을 까먹었을 때 재설정하는 방법][1]

[오픈 파이어][2] 소개를 일단 붙인다. 번역이다.

> 오픈파이어는 리얼타임 협동(RTC) 서버다. 이 프로그램은 오픈 소스 아파치 라이센스다. 오픈파이어는 널리 채택된 인스턴트 메세지 프로토콜인 XMPP(또한 Jabber라고도 볼린다)만 사용한다. 오픈파이어는 설정하고 관리하는 것이 아주 쉽지만, 견고한 보안과 멋진 성능을 제공한다.
> 
> Openfire is a real time collaboration (RTC) server licensed under the Open Source Apache License. It uses the only widely adopted open protocol for instant messaging, XMPP (also called Jabber). Openfire is incredibly easy to setup and administer, but offers rock-solid security and performance.

링크 : <a href="http://www.igniterealtime.org/projects/openfire/index.jsp" target="_blank">오픈 파이어 다운로드 링크</a>

내가 설치한 버전은 3.6.4다. 오픈파이어는 윈도우/맥/리눅스 서버를 다 지원한다.

일단 서버를 설치하면 <a href="http://www.pidgin.im/download/" target="_blank">피진(pidgin)</a>으로 사용 가능하다.(엠파시처럼 XMPP(jabber)를 지원하는 메신저들은 모두 사용할 수 있다. 즉, 우분투에서 기본으로 설치해 주는 메신저는 그냥 사용할 수 있다고 보면 된다.) spark는 우분투에서 한글이 안 되는 것 같다.

## 설치시 유의점

<a href="http://ngweb.tistory.com/132" target="_blank">윈도우 경우는 잘 나와 있는 게</a> 있는 것 같다. 나는 리눅스에서 설치하는 방법과 유의점을 적으려고 한다.

일단 설치를 하고, 리눅스의 경우는 http://서버주소:9090 으로 접속하면 세팅을 할 수 있다.

만약 들어가지지 않는다면, openjdk만 깔려 있어서 그런 거다. sun에서 나온 jdk를 설치해 줘야 한다. 아니면 아래처럼 /etc/init.d/openfire 파일을 수정해 줘도 된다.

<pre># 앞부분 생략

# Attempt to locate JAVA_HOME, code borrowed from jabref package
# 이놈을 추가해 준 거다.
if [ -z $JAVA_HOME ]
then
    t=/usr/lib/jvm/java-6-openjdk && test -d $t && JAVA_HOME=$t
fi

# Attempt to locate JAVA_HOME, code borrowed from jabref package
# 원래 놈을 주석처리한 거다.
#if [ -z $JAVA_HOME ]
#then
#	t=/usr/lib/jvm/java-1.5.0-sun && test -d $t && JAVA_HOME=$t
#	t=/usr/lib/jvm/java-6-sun && test -d $t && JAVA_HOME=$t
#fi

#뒷부분 생략</pre>

이렇게 주석처리를 한 다음 아래 명령어를 쳐서 오픈파이어를 시작한다.

<pre>sudo /etc/init.d/openfire start</pre>

세팅 과정에서 유의점 몇 가지만 적겠다.

호스트네임을 적을 때 유의해야 한다. 처음에는 my-desktop 같은 이름으로 적혀 있다. 여기에 url을 써 주든지, 아니면 **ip주소를 적어 줘야 메신저가 제대로 작동**한다. 특히 사내 서버의 경우는 더더욱 그렇다. 이걸 my-desktop으로 남겨두면 친구추가가 안 된다 ㅡㅡ;;

일단 오픈파이어는 database도 사용한다. mysql 같은 외부 db를 사용할지 내부 db를 사용할지 설정해 줘야 한다. 외부 db를 사용할 경우 select한 다음 java에서 쓰는 양식으로 db접속 때 사용할 접속경로를 적어줘야 한다. 당연히 mysql은

<pre class="brush:plain">jdbc:mysql://localhost:3306/DBname?useUnicode=yes&amp;characterEncoding=UTF8</pre>

형식이다. 인코딩을 적어 줘야 한글 이름이 안 깨진다.

디폴트 db를 사용하면 따로 설정할 것은 없다.

admin 이메일과 비번을 입력하라고 하는데, 이메일은 필수는 아닌 듯하고, 비번은 적어 주면 된다. 근데 세팅 끝나고 admin console로 접속을 하게 되는데, 여기 아무리 id 비번을 적어도 안 되는 경우가 있다. 이거 땜에 고생했다. 일단 id는 admin이다. 이메일 주소 적는 삽질을 하지 말자. 비번은 정한 거대로 써 준다. 그런데도 에러 메시지가 나온다? 그러면 openfire를 재시작한다. 재시작 명령어는 아파치와 비슷하다.

<pre class="brush:plain">sudo /etc/init.d/openfire restart</pre>

참, 이건 우분투 9.10 기준이다. deb 패키지로 설치했다. 그러니까 데비안 계열은 명령어가 같을 것 같다.

리스타트하면 한동안 http://서버주소:9090가 작동을 안 하는데 시간이 좀 지나면 접속이 된다.

다시 뜨면 admin과 암호를 입력해 보자. 내 경우는 그렇게 하면 admin 모드로 접속이 됐다.

## 사내 메신저로 사용하려 할 때 몇 가지 설정

관리자가 일일이 가입시켜줄 수는 없을 것이다. **사람들이 알아서 가입할 수 있는 페이지를 제공**해 보자.

일단 플러그인 탭에서 Registration 를 설치한다. plugins 탭에서 Available Plugins로 가서 Registration 옆의 + 버튼을 누르면 알아서 설치해 준다. 아주 편리하다.

그 다음 Users/Groups 메뉴의 Registration Properties를 누른다. 거기에서 아래 체크박스에 체크해 준다.

Enable users to register via a web page at http://서버이름:9090/plugins/registration/sign-up.jsp

그러면 http://서버이름:9090/plugins/registration/sign-up.jsp 주소에서 누구나 가입할 수 있게 된다.

다음은 **가입하는 사람은 모두 기본 그룹에 포함**되게 하는 방법이다.

Groups 메뉴를 클릭한다. 거기서 새 그룹을 일단 만든다.(Create New Group)

다시 Users 메뉴를 클릭하고, Registration Properties로 들어간다. 거기서 아래쪽으로 내려가 보면 Default Group이 있다. 거기에 아까 만든 그룹을 적어 주고 save group을 눌러 준다. 저장된 것을 확인했으면 위쪽으로 돌아와서 Enable automatically adding of new users to a group. 에 체크해 준다.

save settings 버튼 누르기를 잊으면 안 된다.

다음, 서로 **친구맺기 하지 않아도 같은 그룹에 포함돼 있으면 그냥 친구로 맺어 주는 방법**이다.

groups의 Group Summary로 들어가서 아까 만든 그룹을 클릭한다. 그러면 Edit Group 메뉴로 들어가게 된다. Enable contact list group sharing를 선택해 준다. Enter contact list group name에 지금 그룹 이름을 적어 준다. <s><span style="color: #666666;">Share group with additional users에 체크하고, All users를 선택해 준다.(이건 그냥 다 선택한 건데, 굳이 내가 적은 것처럼 다 선택하지 않아도 원하는 효과를 얻을 수 있을 지도 모른다. 어쨌든 나는 다 골랐고, 그렇게 하니까 모든 사람이 같은 그룹으로 들어와서 친구를 공유하게 됐다.)</span></s>

이 정도 설정을 알면 사내 메신저로 사용하기 어려움이 없을 것이다. 그럼, 끝!

## 세팅 다시 하기

세팅을 실수한 것 같아서 다시 하고 싶을 때는 /etc/openfier/openfire.xml을 열고 아래 부분을 수정한다.

<pre class="brush:xml">&lt;setup&gt;true&lt;/setup&gt;</pre>

이 부분을

<pre class="brush:xml">&lt;setup&gt;false&lt;/setup&gt;</pre>

이렇게 고치면 된다.

그리고 오픈파이어를 리스타트한다.

<pre class="brush:plain">sudo /etc/init.d/openfire restart</pre>

그리고 http://서버주소:9090/ 으로 들어가면 된다. 오픈파이어가 다시 시작할 때 시간이 좀 걸리니까 급하게 생각하지 말기 바란다.

## 일부 한글로 만들기

openfire 기본 언어 세팅에 한글은 없다. 영어 중국어 따위만 있다. 그래도 openfire.xml의 아래 부분을 ko로 해 주면 &#8216;한국표준시&#8217; 따위의 한글은 볼 수 있다.

<pre class="brush:xml">&lt;locale&gt;ko&lt;/locale&gt;</pre>

당연히 xml을 수정한 다음에는 openfire를 restart해야 한다.

<pre class="brush:plain">sudo /etc/init.d/openfire restart</pre>

## 한글 이름 깨지는 문제

username은 아이디다. 당연히 한글로 하지 않는 게 좋다. 그러나 name 부분은 한글로 하는 게 좋을 것이다. 기본으로 보이는 이름이니까 말이다.

그렇게 하려면 처음 db 설정 때 인코딩 설정을 해 줘야 한다. mysql의 경우 아래와 같이 인코딩 설정을 한다.

<pre class="brush:plain">jdbc:mysql://localhost:3306/DBname?useUnicode=yes&amp;characterEncoding=UTF8</pre>

DBname 뒷부분을 긁어서 자신의 코드에 적용하면 된다.

다 설치한 다음 수정하기 위해서는 openfire.xml을 연다. 아래처럼 고쳐 준다.

<pre class="brush:xml">&lt;serverURL&gt;jdbc:mysql://localhost:3306/DBname?useUnicode=yes&amp;characterEncoding=UTF8&lt;/serverURL&gt;</pre>

당연히 xml을 수정한 다음에는 openfire를 restart해야 한다.

<pre class="brush:plain">sudo /etc/init.d/openfire restart</pre>

## 사용 가능한 메신저

일단 설치하고 나면 pidgin에서 사용하면 된다.(정확히 말하면 XMPP(혹은 jabber)를 지원하는 모든 메신저로 사용 가능하다.) 프로토콜을 XMPP로 선택하고 사용자명에 오픈파이어 가입시 적은 username, 도메인에 서버 설치된 ip주소나 도메인 주소를 적어 주면 된다.(포트는 적어줄 필요 없다.) 테스트해보고 싶으면 admin 아이디로 해 보라. 끝.

 [1]: http://mytory.local/archives/2328 "사내 메신저 서버 오픈파이어의 관리자 비번을 까먹었을 때"
 [2]: http://www.igniterealtime.org/projects/openfire/index.jsp