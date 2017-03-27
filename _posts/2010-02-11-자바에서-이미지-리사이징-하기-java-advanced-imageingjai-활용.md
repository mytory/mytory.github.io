---
title: 자바에서 이미지 리사이징 하기-Java Advanced Imageing(JAI) 활용
author: 안형우
layout: post
permalink: /archives/271
aktt_notify_twitter:
  - yes
daumview_id:
  - 37094648
categories:
  - 서버단
tags:
  - JAVA
---
자바의 API인 Java Advanced Imageing(JAI) API를 사용한다.

아래는 이 라이브러리 활용에 관한 설명들이다.

*   <a href="http://blog.naver.com/PostView.nhn?blogId=mirmir96&logNo=70085487223" target="_blank">썸네일 컴포넌트(JAI)</a> : 설치부터 코드까지 비교적 자세한 설명을 볼 수 있다.
*   <a href="http://stylekai.tistory.com/204" target="_blank">[Java] Image resize</a> : 제목은 영어지만 내용은 한글이다. 예제 소스가 그림으로 첨부돼 있다. JAI뿐 아니라 다른 방법도 두 가지 설명돼 있는 점이 좋은 듯
*   <del>자바 이미지 리사이즈(썸네일) : 자바 좀 해 본 사람들이면 알아먹을 수 있는 속도감 있는 설명이 돼 있다.</del> 웹사이트가 통째로 없어졌다.

한 간단한 예제는 에 가면 볼 수 있다. 간단한 설명은 에서 볼 수 있다.

여기서는 <a href="http://docs.sun.com/app/docs/doc/806-5413-10?l=ko" target="_blank">영어로 된 매뉴얼</a>을 다운받을 수 있다.

API는 여기서 볼 수 있다 : <a href="http://java.sun.com/products/java-media/jai/forDevelopers/jai-apidocs/index.html" target="_blank">jai API</a>

jar를 다운받는 곳은 여기다 : <a href="http://java.sun.com/products/java-media/jai/current.html" target="_blank">jai 다운로드</a>

그런데 다운로드 페이지에 가면 링크가 너무 많다;; 아래 같은 링크들이 나열돼 있다.

<img src="/uploads/legacy/old-images/1/cfile23.uf.156EF9534D4BC88F2C2358.png" alt="" width="259" height="290" />

잘 찾아 보니 설명이 돼 있었다.

> bundles of the form \*-jdk\* for installation into a JDK;
> 
> bundles of the form \*-jre\* for installation into a JRE;
> 
> bundles of the form *jar.zip for auto-installation into a browser; and
> 
> bundles of the form \*<platform>.tar.gz or \*<platform>.exe for installation at a location specified by the CLASSPATH environment variable.

즉, \*-jdk는 JDK를 위한 거고, \*-jre는 JRE를 위한 거고&#8230;(솔직히 당연한 거 아냐? 근데 어쩌라고. jdk에 넣으라고? 뭔 말인 거냐&#8230;) 그 다음이 눈여겨 볼 만한 거 같다.

*jar.zip은 브라우저에 자동 설치하기위한 거라는데 뭐에 쓰는 물건인지;;

네 번째가 핵심인 거 같다. *<윈도우/리눅스/솔라리스>.tar.gz 이나 .exe는 CLASSPATH 환경변수가 분류하는 위치에 인스톨하기 위한 거란다. 아마도 이걸 사용하면 되지 않을까 싶은데&#8230;

실제로 압축을 풀어 보니 jai-core.jar와 jai\_codec.jar, mlibwrapper\_jai.jar가 있다. 이 세 개를 lib에 넣고 build path를 하면 될 듯하다.(이클립스에서 그렇게 한다는 말이다.)