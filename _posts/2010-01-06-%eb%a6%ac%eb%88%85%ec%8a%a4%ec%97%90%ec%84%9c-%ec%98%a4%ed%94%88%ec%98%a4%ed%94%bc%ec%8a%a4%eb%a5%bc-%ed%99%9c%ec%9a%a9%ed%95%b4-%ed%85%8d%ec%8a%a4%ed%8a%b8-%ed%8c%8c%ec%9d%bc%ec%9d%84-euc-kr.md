---
title: 리눅스에서 오픈오피스를 활용해 텍스트 파일을 EUC-KR 윈도우용 문자 인코딩으로 저장하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/199
aktt_notify_twitter:
  - yes
daumview_id:
  - 37158432
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
리눅스는 기본적으로 UTF-8 형식의 인코딩을 사용하기 때문에 모든 언어를 다 표현할 수 있다. 윈도우도 모든 언어를 다 표현은 할 수 있는 것 같지만, UTF-8 인코딩만큼 자유롭지 않은 것은 당연한 말씀. 여기서 인코딩에 대해 다 설명할 수는 없고&#8230;

여튼간에 리눅스에서 저장한 txt 파일을 윈도우에서 열어 보면 다 깨져서 나온다. 물론 윈도우에서 UTF-8을 읽을 수 있는 프로그램을 사용하면 간단할 테지만 이도 잘 모르는 사용자가 많다.

또 하나는, 리눅스에서 txt 파일로 저장해 핸드폰에서 읽으려 할 때다. 보통 핸드폰의 txt 파일 읽는 프로그램은 EUC-KR로 인코딩된 것만 읽을 수 있게 나온다.(아직까진.) 내 핸드폰이 그래서 아주 짜증이 났다.

그래서 찾아본 결과 오픈오피스에서 저장하면 된다는 사실을 알았는데 좀 시행착오를 겪었다. 처음에 인코딩은 잘 맞춰 저장을 했는데, 엔터값이 다 무시된 채로 저장됐던 것이다.

그런 실수를 하지 않도록 한 번 정리하기로 했다.

일단 오픈오피스에서 &#8216;**<font class="Apple-style-span" color="#FF0000">파일 &#8211; 다른 이름으로 저장</font>**&#8216;(Ctrl+Shift+S)을 선택한다. 아래 그림처럼 말이다.

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile25.uf.1132D5554D4BC87E297A0F.png" class="aligncenter" width="261" height="510" alt="" />

그러면 저장하는 화면이 뜰 텐데, 오른쪽 하단에 파일 형식을 고르는 게 있다. 거기서 **<font class="Apple-style-span" color="#FF0000">&#8216;인코딩된 텍스트&#8217;</font>**를 고른다.

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile29.uf.12534C4C4D4BC87F22A840.png" class="aligncenter" width="580" height="585" alt="" />

오른쪽 하단의 &#8216;ODF 텍스트 문서&#8217;라고 표시된 부분을 클릭하면 아래 화면처럼 여러 형식이 나온다. 이 중 &#8216;인코딩된 텍스트&#8217;를 고르라는 말이다.

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile26.uf.161C5C524D4BC8802306B4.png" class="aligncenter" width="580" height="610" alt="" />

선택하고 파일 이름도 정하고, 폴더도 확인했다면 저장 버튼을 누른다. 저장 버튼을 누르면 아래 같은 창이 뜬다.

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile23.uf.1750BD4F4D4BC87F216D6B.png" class="aligncenter" width="548" height="155" alt="" />

위 그림에 나와 있는대로, 한국어(EUC-KR)과 CR&LF를 선택해 주자.(이걸 선택하지 않아서 엔터값이 다 무시된 채로 보였던 것이다. 리눅스 txt의 엔터값 코드와 윈도우의 엔터값 코드가 다르기 때문에 생기는 문제라고 한다.)

그리고 확인을 누르면 저장 완료다.