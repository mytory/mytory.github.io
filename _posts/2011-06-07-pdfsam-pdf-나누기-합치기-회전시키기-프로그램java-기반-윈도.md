---
title: '[pdfsam] PDF 나누기 합치기 회전시키기 프로그램(JAVA 기반, 윈도우/리눅스/맥 다 됨)'
author: 안형우
layout: post
permalink: /archives/1354
aktt_notify_twitter:
  - yes
daumview_id:
  - 36712033
categories:
  - 기타
tags:
  - TIP
---
가끔 PDF를 편집해야 할 때가 있다.

그러나 어도비 아크로뱃이 깔려 있어야 PDF를 편집할 수 있다고 알고 있다.

다른 방법도 있을 텐데 여튼 피곤한 일이다.

그러나 나누거나 합치는 것은 쉬운 일이다.

합치기만 하는 경우 윈도우에는 PDF Merge 라는 프로그램이 있다.

그러나 윈도우/리눅스/맥 전부에서 돌아가는, 아주 깔끔한 프로그램이 있다.

pdfsam 이 그것이다. 우분투 같은 경우 그냥 소프트웨어 센터에서 pdfsam 으로 검색하면 나온다.

[▶pdfsam 다운로드 페이지][1]

인터페이스는 매우 깔끔하다.

<img class="aligncenter" src="https://mytory.net/uploads/legacy/pdfsam-interface.png" alt="" width="100%" />

합칠 거면 Merge/Extract 를 선택하고 합칠 PDF들을 넣어 준 후 Run을 누르면 된다.

만약 나누는 경우에는 여러 옵션이 있다.

*   Burst(split into single pages) : 1페이지씩으로 나눈다. 10페이지짜리 PDF 문서라면 10개의 PDF 파일이 나온다.
*   Split even pages : 1페이지부터 시작해서 2페이지씩 나눈다. 즉, 1-2p, 3-4p, 5-6p 식으로 파일을 만든다.
*   Split odd pages : 1페이지는 혼자 두고 2페이지부터 2-3p, 4-5p, 6-7p 이런 식으로 나눈다.
*   Split after these pages : 이건 입력칸이 있다. 2를 입력하면 1-2p와 3-끝p 이렇게 나눈다.
*   Split every &#8220;n&#8221; pages : 입력칸이 있다. 5을 입력하면 5p씩 나눈다.
*   Split at this size : 용량별로 나눈다.
*   Split by bookmarks level : 뭔지 모르겠다. PDF에 북마크가 있을 때 사용하는 건가?

이 외에도 Alternate Mix, Visual document composer, Visual reorder 등의 기능도 있는데 뭔지는 잘 모르겠다.

## Settings

Settings에 가면 Language 옵션이 있다. Korean을 선택하고 재시작하면 부분적으로 한글화돼 나온다. 아직 완벽하지는 않은 것 같다.

## JAVA가 깔려 있어야 한다

이 프로그램은 JAVA 기반이므로 기본적으로 JRE(JAVA Runtime Environment) 가 깔려 있어야 한다. 물론 JRE 대신 JDK가 깔려 있어도 될 거다.

[▶JRE 다운로드 하기][2]

## 64bit JDK에서 안 돌아가는데

그런데 난 JDK가 깔려 있는데 javaw.exe를 찾을 수 없다면서 실행되지 않는 것이었다. 아마도 64bit 환경에 JDK가 깔려 있어서 그런 듯하다. 해결책은 두 가지다.

첫째 해결책은 위 링크에서 JRE를 다운받아 그냥 다시 설치하는 거다. 그러니까 실행된다.

둘째 해결책은 윈도우 설치 파일을 다운받지 말고 그냥 zip archive 를 다운받는 방법이다.

<div style="width: 709px" class="wp-caption aligncenter">
  <img src="https://mytory.net/uploads/legacy/pdfsam-download.png" alt="" width="699" height="224" /><p class="wp-caption-text">
    △위 그림에서 두 번째 줄에 있는 놈을 다운받는다.
  </p>
</div>

zip archive 를 다운받아 압축을 풀면 pdfsam-2.2.1.jar 형식의 파일이 있는데 이놈을 더블클릭하면 실행된다. 당연히 JDK가 설치돼 있어야 할 것이다. pdfsam-starte.exe 도 들어있던데 눌러보지 않았다.

 [1]: http://www.pdfsam.org/?page_id=32
 [2]: http://www.java.com/ko/download/index.jsp