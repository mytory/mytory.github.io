---
title: '[링크] Shell에서 용량 관리 위한 명령어'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2195
aktt_notify_twitter:
  - yes
daumview_id:
  - 36632436
categories:
  - 서버단
tags:
  - shell
---
[shell에서 용량 관리를 하는 유용한 명령어][1]들을 찾았다. 그런데 내가 본 글은 한 네이버 블로그의 리눅스 팁에서 용량 부분을 찾아내 퍼온 것이고(나름의 수고를 들여 찾아낸 듯), 그 글은 또 &#8216;<a title="나의 리눅스 관련 팁" href="http://imtl.skku.ac.kr/index.php?document_srl=14324&vid=hjlim99" rel="bookmark">나의 리눅스 관련 팁</a>&#8216;이라는 글을 그대로 퍼온 것이었다. 네이버 블로그에 있는 원문 주소는 깨진 것이었지만, 검색을 통해 원래 원문을 찾을 수 있었다. 원문을 담고 있는 이 블로그는 cafe24를 사용하다가 설치형 테터툴즈로 이사를 가 있었다.

여튼간에, 위 글들을 참고하라. 아래는 내가 스타일만 정리하고, 맥에서 사용법을 일부 추가한 것인데, 원문을 보기를 더 추천한다.

[▶shell에서 용량 관리를 하는 유용한 명령어][1]  
[▶나의 리눅스 관련 팁][2]

## 1. 폴더내에서 크기가 가장 큰 파일, 디렉토리 찾기

&#8211; 디렉토리 :

<pre>du -S | sort -n</pre>

&#8211; 파일 :

<pre>ls -IR | sort +4n</pre>

## 2. 현재 디렉토리의 크기 구하기

<pre>du -c -h --max-depth=0 *</pre>

맥에서는 &#8211;max-depth=0 대신 -d 0 이라고 써야 한다. 3번 명령어도 마찬가지다. 3번에 대한 예시는 생략한다.

<pre>du -c -h -d 0 *</pre>

## 3. 사용자별 사용량 보기

<pre>du -h --max-depth=1 /home/ | less</pre>

## 4. 오늘 생성된 파일 검색

<pre>find / -ctime -1</pre>

## 5. 지정된 일 수 이상 파일만 이동 또는 복사

<pre>find ./ -mtime +10 | awk &#039; { print "mv "$1" ./target" } &#039; | sh</pre>

+10 은 수정된지 10일 이상, /target 디렉토리로, mv 이동

mtime는 생성시간, atime는 접근시간, ctime는 최근변경

 [1]: http://downrg.com/84
 [2]: http://imtl.skku.ac.kr/index.php?document_srl=14324&vid=hjlim99