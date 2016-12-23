---
title: '[이클립스] Failed to load JavaHL Library 해결하기'
author: 안형우
layout: post
permalink: /archives/978
aktt_notify_twitter:
  - yes
daumview_id:
  - 36762042
categories:
  - 개발 툴
tags:
  - SVN
---
<pre>Failed to load JavaHL Library.
These are the errors that were encountered:
no libsvnjavahl-1 in java.library.path
no svnjavahl-1 in java.library.path
no svnjavahl in java.library.path
java.library.path = /usr/lib/jvm/java-6-openjdk/jre/lib/amd64/server:/usr/lib/jvm/java-6-openjdk/jre/lib/amd64:/usr/lib/jvm/java-6-openjdk/jre/../lib/amd64:/usr/lib64/xulrunner-addons:/usr/java/packages/lib/amd64:/usr/lib/jni:/lib:/usr/lib</pre>

subclipse를 설치하고 svn 관련 업무를 시작하려고만 하면 이런 메세지가 뜬다. ok를 누르면 무리없이 잘 동작하지만 뭔가 찜찜하다.

왜 이런 것이 뜨는 걸까? 영어라 계속 무시했지만, 오늘은 해결해 보려고 했다. 그리고 바로 에러 메세지 창에서 해결책을 발견했다. 오호라! 나는 눈 뜬 장님이었던 것인가! (아래 그림과 같은 에러 메세지를 말한다.)

<p style="text-align: center;">
  <img class="   aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/subversion-native-library-not-available.png" alt="" width="660" height="446" />
</p>

<http://subclipse.tigris.org/wiki/JavaHL>

## JavaHL를 설치하면 해결되는 문제

여기부터는 위에 링크한 페이지의 번역이다. 편의상 생략한 부분이 아주 조금 있고, 당연히 오역이 있을 수 있다. 하지만 대충 이해하는 대는 무리가 없을 것이다.

&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;-

일단 Subclipse Version에 맞는 JavaHL을 깔아야 한다는 점을 강조하고 있다. JavaHL은 Subversion의 일부고 각 Subversion은 하나의 Subversion client version 만 지원한다고 한다. API 차이 때문이고. 그래서 올바른 버전을 깔아야 한다고 한다.

그래서 아래 표를 참고해서 제대로 된 SVN/JavaHL Version을 설치하면 된다고 한다.

<table>
  <tr>
    <td>
      <p class="line862">
        <strong>Subclipse Version</strong>
      </p>
    </td>
    
    <td>
      <p class="line862">
        <strong>SVN/JavaHL Version</strong>
      </p>
    </td>
  </tr>
  
  <tr>
    <td style="text-align: center;">
      <p class="line862">
        1.6.x
      </p>
    </td>
    
    <td style="text-align: center;">
      <p class="line862">
        1.6.x
      </p>
    </td>
  </tr>
  
  <tr>
    <td style="text-align: center;">
      <p class="line862">
        1.4.x
      </p>
    </td>
    
    <td style="text-align: center;">
      <p class="line862">
        1.5.x
      </p>
    </td>
  </tr>
  
  <tr>
    <td style="text-align: center;">
      <p class="line862">
        1.2.x
      </p>
    </td>
    
    <td style="text-align: center;">
      <p class="line862">
        1.4.x
      </p>
    </td>
  </tr>
  
  <tr>
    <td style="text-align: center;">
      <p class="line862">
        1.0.x
      </p>
    </td>
    
    <td style="text-align: center;">
      <p class="line862">
        1.4.x
      </p>
    </td>
  </tr>
</table>

## JavaHL이 뭔가?

JavaHL은 서브버전(Subversion) 프로젝트의 일부다. Java 언어를 서브버전 API에 바인딩하는 거다. (혹시 모를까 해서 말하는데 서브버전이 SVN이다. &#8211; 녹풍) 서브버전은 계층적 API 디자인을 제공한다. 계층적 API 디자인은 (DLL 같은) 네이티브 라이브러리들로 제공된다. 서브버전 커맨드 라인은 이 API를 사용하는 한 방법일 뿐이다. API에는 풍부한 기능이 있다. 또한 하위 호환성도 유지된다. 굉장히 좋은 서브버전 클라이언트와 도구가 많은데, 그건 바로 필요한 모든 기능을 제공하는 풍부하고 안정적인 API가 있기 때문이다.

서브버전은 모든 플랫폼을 지원하기 위해 C로 만들어졌다. 어쩌고 저쩌고.(Subversion is written in C to provide excellent cross platform support, but also because C produces libraries that are easy to consume from virtually any other language.) 서브버전 프로젝트는 자바, 펄, 파이썬 그리고 루비를 위한 언어 바인딩을 제공하고 유지하고 있다. 뒤쪽 세 개에 대해서는 SWIG 라이브러리와 기능을 제공한다. 네이티브 라이브러리로 인터페이스 언어 기능을 구현한 것이다. JavaHL은 &#8220;하이 레벨&#8221; API고 이것은 C++ 코드로 작성됐다. 자바 코드와 네이티브 라이브러리를 연결하는 JNI를 제공하기 위해서다. 이 디자인은 좋은 자바 API를 서브버전에 제공할 수 있게 해 준다.

JavaHL은 근본적으로 네 파트로 구성된다:

1.  자바 쪽에서 말을 걸 수 있도록 해 주는 API를 제공하기 위한 상대적으로 얇은 자바 코드.
2.  C++ 라이브러리 (JavaHL library 혹은 libsvnjavahl-1). 자바 레이어는 자바 네이티브 인터페이스(JNI) 호출(call)을 이용해 이 레이어에 말을 건다. C++ 계층은 &#8220;하이 레벨&#8221; API가 구현된 계층에 있다. 예를 들면, 자바는 &#8220;이 메세지와 함께 파일 목록을 커밋하라&#8221; 하고 말한다. C++ 계층은 메모리를 신경쓰면서 더 낮은 레벨의 서브버전 API 호출을 실행해 요청을 완료한다.
3.  서브버전 라이브러리 자신. 커맨드 라인 클라이언트가 설치하고 사용하는 그 라이브러리와 같은 라이브러리다. 또한 TortoiseSVN이나 AnkhSVN 같은 다른 서브버전 클라이언트들도 이런 같은 라이브러리들을 사용한다.
4.  서브버전 라이브러리 의존성. 서브버전은 작동하기 위해 다수의 외부 라이브러리가 필요하다. 가장 큰 부분은 아파치 포터블 런타임(APR)이고, Neon for the HTTP 클라이언트와 보안 제어를 위한 OpenSSL 등의 라이브러리도 필요하다.

JavaHL이 어플리케이션에 사용되고 작동하게 하기 위해 이 네 가지 계층이 필요하다.

## 왜 서브클립스에 JavaHL이 필요한가?

서브클립스은 자바로 만들어졌다. 그래서 서브버전 API를 사용하기 위해서는 JavaHL 라이브러리를 사용해야 한다. 서브클립스는 JavaHL의 자바 계층을 내장하고 있다. 바로 앞의 항목을 보면, 그게 실제로 작동하기 위해 세 개의 서로 다른 계층이 필요하다는 것을 알 수 있을 것이다. (근본적으로는 네이티브 라이브러리.)

## 왜 서브클립스가 JavaHL에 필요한 모든 것을 제공하지 않는가?

32비트 윈도우에서 우리는 필요한 모든 것을 제공한다. 그러나 다른 데서는 기술적 이유로 그렇게 할 수 없다. 네이티브 라이브러리들이 서로 다른 운영체제에서 로드되는 방법이 있어야 한다. 자바와 이클립스에서 사용될 때 서로 다른 세 계층을 그렇게 작동시킬 방법은 없다. 그렇게 하기 위해 찾을 수 있는 유일한 방법은 그게 운영체제가 찾을 수 있는 올바른 위치에 제대로 설치됐는지 확인하는 것이다. 윈도우 라이브러리 로딩에는 자바에서 이용할 수 있는 쿼크(quirk)가 있다. 기본적으로, 우리는 역 주문을 통해 의존성을 로드할 수 있고, 그렇게 함으로써 우리는 각각의 라이브러리를 불러올 수 있다. 의존성이 이미 메모리에 로드돼 있어서 로더가 더이상 그들을 불러오려고 시도하지 않기 때문이다.(뭔 말인지;;)

## JavaHL을 어떻게 얻을 수 있나요?

운영체제에 따라 다양한다.

### 윈도우 32비트

서브클립스 자체에 필요한 모든 게 들어있다. 우리의 이클립스 업데이트 사이트에서 JavaHL 플러그인이 설치됐는지만 확인하면 된다.

### 윈도우 64비트

만약 32비트 JVM을 사용하고 있다면 서브클립스가 제대로 작동할 것이다. 만약 64비트 JVM을 사용하고 있다면 JavaHL 64비트 버전을 제공해야 한다. 그 중 하나는 SlikSVN이고 여기서 얻을 수 있다:

<a href="http://www.sliksvn.com/en/download" target="_blank">http://www.sliksvn.com/en/download</a>

패키지를 설치하면, 서브클립스가 PATH에서 JavaHL을 찾을 것이고, 제대로 작동할 거다.

### OS X

가장 쉬운 방법은 OSX 패키지를 다운로드해 설치하는 것이다. OSX 패키지는 <a href="http://www.collab.net/downloads/subversion#tab-4" target="_blank">openCollabNet</a>을 제공한다. 이것은 JavaHL 라이브러리를 갖고 있는 서브버전을 설치한다. 위치는 /opt/subversion 이다. 그리고 나서 JavaHL 라이브러리를 위해 /Library/Java/Extensions에 심볼릭 링크를 만든다. 이 곳은 OSX JVM이 JNI로 라이브러리를 불러올 때 확인하는 글로벌한 위치다. 그래서 기본적으로, 이 패키지를 설치하면 더 할 게 없다. 서브클립스를 설치한 후 이것을 설치하면 괜찮다. 32비트와 64비트 모두에 사용할 수 있다. MacPorts 또한 손쉬운 서브버전과 JavaHL 패키지를 제공한다. 그러나 스노우 레오파드 MacPorts는 여전이 이 패키지들을 32비트 바이너리로 컴파일한다. 만약 기본으로 있는 64비트 스노우 레오파드 JVM를 사용하면 JavaHL이 로드됐을 때 아래와 같은 에러를 보게 될 것이다.

<pre>Failed to load JavaHL Library.
These are the errors that were encountered:
no libsvnjavahl-1 in java.library.path
no svnjavahl-1 in java.library.path
/opt/local/lib/libsvnjavahl-1.0.0.0.dylib:  no suitable image found.  Did find:  /opt/local/lib/libsvnjavahl-1.0.0.0.dylib: mach-o, but wrong architecture</pre>

잘못된 아키텍쳐라는 에러 메세지를 주목하라. 이건 64비트 JVM이 32비트 네이티브 라이브러리를 로드할 수 없다는 얘기다. OSX CollabNet 바이너리에는 이런 문제가 없다. 거기엔 32비드와 64비트 버전이 모두 있기 때문이다.

[2012-09-05 내가 추가 -  SVN 최신 버전을 설치해야 한다면 OSX CollabNet을 설치하지 않고 <a href="http://subversion.apache.org/download/" target="_blank">svn 소스</a>를 받아서 <a href="http://hivelogic.com/articles/svn_on_os_x/" target="_blank">컴파일</a>하는 게 나을 거다. (<a href="http://hivelogic.com/articles/svn_on_os_x/" target="_blank">컴파일</a> 링크에 나오는 SVN 다운로드 링크는 깨져 있으니 내가 <a href="http://subversion.apache.org/download/" target="_blank">svn소스</a>라는 단어에 걸어 둔 링크로 가서 다운을 받아라)

OSX에서 컴파일을 위해 make 같은 커맨드를 사용하려면 두 가지 방법이 있다. 하나는 Xcode를 열고, Preferences > Downloads > Components > Command Line Tools 를 설치하는 것이다. 다른 하나는, <a href="https://github.com/kennethreitz/osx-gcc-installer/downloads" target="_blank">osx-gcc-installer를 다운</a>받아서 설치하는 것이다. 내가 해 보니 Xcode에서 설치하는 게 용량도 100메가 적고 다운 속도도 빨랐다.]

### 리눅스

이건 정말 복잡하다. 수많은 배포판이 있기 때문이다.

CollabNet은 JavaHL을 포함한 레드햇을 위해 클라이언트 RPM을 제공한다.( <http://www.collab.net/downloads/subversion#tab-1> ) 내 경험상, 이 RPM은 다른 리눅스 배포판에서도 작동한다. CentOS나 Suse 같은 RPM 기반 배포판에서는 RPM 설치 문제일 뿐이다. 데비안 기반 시스템에서, RPM을 설치하기 위해 alien 패키지를 사용할 수 있다.

물론 우분투 같은 많은 리눅스 배포판이 서브버전 패키지를 업데이트하기 위한 좋은 방법을 제공한다. 이런 방법을 사용하면 JavaHL이 대부분 잘 설치된다. 전형적으로 JavaHL 라이브러리는 메인 서브버전 패키지에 의존적인 분리된 패키지들에 들어 있다. 데비안/우분투에서는 패키지 이름이 libsvn-java다. 그래서 이런 커맨드만으로 라이브러리를 설치할 수 있다.

<pre>sudo apt-get install libsvn-java</pre>

일단 라이브러리를 인스톨하면, (이클립스를 사용할 때) 자바한테 어디서 그걸 찾을 수 있는지 말해 줘야 한다. 리눅스 JVM 많은 경우 라이브러리를 찾기 위해 표준 경로를 살피지 않는다. 이건 미래에 분명 바뀔 것이다. 예컨대, 데비안/우분투는 자바에 사용되는 라이브러리로 /usr/lib/jni라는 표준 경로를 사용한다. 그러나, 썬 JVM은 지금 이 경로를 살피지 않는다. 자바에 어디에서 JavaHL 라이브러리를 찾을 수 있는지 말해 주는 가장 쉬운 방법은 JVM이 시작할 때 아래와 같이 명기해 주는 것이다.

<pre>-Djava.library.path=/usr/lib/jni</pre>

CollabNet 서브버전은 /opt/CollabNet_Subversion 에 설치된다. 따라서 이 패키지를 사용할 경우 이렇게 써야 한다.

<pre>-Djava.library.path=/opt/CollabNet_Subversion/lib</pre>

라이브러리의 이름은 libsvnjavahl-1.so 다. 경로를 명기할 때 이 파일을 포함해야 한다.

이클립스는 이 세팅을 위해 자신의 매커니즘을 제공한다. 이클립스에는 eclipse.ini 라는 이름의 파일이 있다. 이 파일은 JVM이 실행될 때 살펴 보는 파일이고, JVM에 세팅을 추가한다. 특히, &#8220;-vmargs&#8221; 라는 라인을 찾아야 한다. 이 라인 아래쪽에 새로운 라인을 추가하고 위 라인을 추가해서 세팅이 JVM에 필요하다고 알려 준다. 한 줄에 인수 하나만 넣어야 한다. 즉, 반드시 새로운 줄에 넣어야 한다. 그리고 한 줄에 위에서 말한 내용을 다 넣어 줘야 한다. 이클립스 3.4에서 그렇게 한 예제다.

<pre>-showsplash
org.eclipse.platform
-framework
plugins/org.eclipse.osgi_3.4.0.v20080605-1900.jar
-vmargs
-Djava.library.path=/opt/CollabNet_Subversion/lib
-Dosgi.requiredJavaVersion=1.5
-Xms40m
-Xmx512m
-XX:MaxPermSize=256m</pre>

### 기타 문제 해결

이클립스 Preferences 밑의 Team > SVN 에서 JavaHL이 로드됐는지 확인할 수 있다. 만약 라이브러리가 제대로 로드됐다면, 라이브러리 버전을 볼 수 있을 것이다. 그렇지 않다면 &#8220;Not available&#8221;이라고 나온다. 만약 버전이 사용하기 너무 오래된 거라면, 라이브러리를 로드할 수 없을 것이고 &#8220;Not available&#8221; 이라고 나올 것이다.

리눅스 사용자에게 나타나는 일반적인 문제는 eclipse.ini에 라이브러리를 로드하는 경로를 적어 넣기는 했지만 작동하지 않는 경우다. 이런 일이 벌어졌을 때 체크할 것은, INI 파일 안의 세팅이 실제로 사용되는지다. 많은 사용자들이 이클립스를 실행할 때 몇몇 커맨드 라인 옵션을 적어 넣어 런처를 커스터마이징한다. 그렇게 하면, 이클립스 런처는 INI 파일 중 몇몇 세팅을 사용하지 않게 된다. 이런 일이 벌어졌는지 확인하는 가장 쉬운 방법은 이클립스에서 Help > About 에 들어가서 Counfiguration Settings를 선택하는 거다. 거기 가면 JVM이 사용하고 있는 setting을 볼 수 있다. 만약 거기에 java.library.path 라인이 없다면, 그건 사용되지 않고 있다는 거다.

### 리눅스에서 클라이언트는 로드되는데, 이클립스가 첫 번째 작동에서 잠기거나(locks) 충돌을(crashes) 일으킨다

이것은 현재 서브버전 1.6이 새로운 GNOME keyring을 지원하는 과정에서 생긴 버그다. 커맨드라인을 사용할 때는 정상적으로 작동하는데, 다른 사용자가 라이브러리를 사용하려고 하면 제대로 작동을 안 한다. 이게 수정될 때까지, 이 기능을 꺼서 문제를 회피할 수 있다. 그렇게 하기 위해, ~/.subversion/config 파일을 열고, 다음을 추가하라.

<pre>[auth]
### Set password stores used by Subversion. They should be
### delimited by spaces or commas. The order of values determines
### the order in which password stores are used.
### Valid password stores:
###   gnome-keyring        (Unix-like systems)
###   kwallet              (Unix-like systems)
###   keychain             (Mac OS X)
###   windows-cryptoapi    (Windows)
password-stores =</pre>

password-stores를 빈 칸으로 남겨 놓으면 이 기능을 끄는 거다. passwords는 모든 구버전 서브버전에서 권한 폴더에 플래인 텍스트로 저장된다.

### JavaHL Library 테스트하기

위의 모든 사항을 이행했는데도 JavaHL 라이브러리가 제대로 작동하지 않는다면, 서브버전 JavaHL JUnit 테스트가 설치를 도와줄 수 있다. 전형적으로, 이것은 서브클립스가 내는 에러와 같은 에러를 낸다. 그러나 시도하고 에러를 내고 문제를 진단하기 더 쉽다.

테스트를 실행하기 쉽게 만들기 위해, JUnit과 JavaHL 클래스를 하나의 Jar 파일에 넣은 서브버전 테스트를 번들로 제공한다. 서브버전 1.6용 테스트를 다음 링크에서 다운받을 수 있다.

[javahltests.jar][1]

이 Jar 파일은 JavaHL 라이브러리의 서브버전 1.6.x 버전에서만 작동한다. 테스트를 하기 위해 다음을 하면 된다:

<pre>$ java -jar javahltests.jar
.........................................
.........
Time: 145.805

OK (50 tests)
The tests create a bunch of repositories and working copies, so run these from a folder you can easily delete or cleanup. Also, you will want to be sure you run the tests using the same JVM that you are using for Eclipse. Finally, you will need to make sure the JavaHL library is on your PATH. So you will probably need to run it something like this:

$ java -Djava.library.path=/opt/CollabNet_Subversion/lib -jar javahltests.jar
.........................................
.........
Time: 145.805

OK (50 tests)</pre>

 [1]: http://subclipse.tigris.org/wiki/JavaHL?action=AttachFile&do=get&target=javahltests.jar