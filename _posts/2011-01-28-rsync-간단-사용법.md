---
title: rsync 간단 사용법(로컬 원격 모두)
author: 안형우
layout: post
permalink: /archives/814
aktt_notify_twitter:
  - yes
daumview_id:
  - 36767759
categories:
  - 기타
tags:
  - Program
---
rsync는 폴더를 동기화해 주는 프로그램이다. 리눅스 등 유닉스 계열에서 사용하는 듯. 서버 관리자라면 알아 두는 게 좋을 것이고, 뭔가 백업과 동기화가 필요한 작업을 하는 분도 알아 두는 게 좋을 듯. 로컬에서도 작동하고 원격으로도 작동한다.

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile30.uf.1945374E4D4BC96E31B91C.jpg" alt="" width="320" height="200" />

내가 사용한 명령어는 아래와 같다.

<pre class="brush:plain">rsync -av --exclude=.svn --delete --delete-excluded /source /destination</pre>

위와 같은 명령어를 사용할 수 있다.

각 옵션은 `rsync -h` 로 설명을 보고 꼭 확인해 보기 바란다. 일단 위에 쓴 것만 설명하면,

`-a` : 설명을 보면 아카이브 모드라고 써 있다. 이 옵션을 빼고 실행하니까 `-r`이나 `-d` 옵션을 주지 않으면 실행이 안 된다고 에러가 떴다. `-r`은 디렉토리로 재귀한다(recurse into directories)고 설명돼 있다. 하위 폴더까지 복사한다는 말이다. `-d`는 재귀하지 않고 디렉토리를 옮긴다(transfer directories without recursing)고 써 있다. <del>하위 디렉토리를 복사하지 않는다는 걸로 이해된다.</del> 이렇게 하면 디렉토리**&#8216;만&#8217;** 옮기는 것 같다. 여튼 다른 블로그에서 봤을 때 `-a`가 옵션으로 붙어 있었으므로 나도 사용했다. 그 뿐이다.

`-v` : `-av`는 a 옵션과 v 옵션을 동시에 사용한 거다. v 옵션은 작업 상황을 텍스트로 보여주라는 옵션이다. 이 옵션을 주지 않으면 작업이 성공했다는 메세지도 안 나온다. 원래 쉘은 그런 거다. 아무 반응이 없으면 성공인 거다.

`--exclude=.svn` : .svn은 빼고 동기화 하라.

`--delete` : 원본 소스에 없는 놈은 목표 폴더에서도 지워라.(원본 폴더에서 지운 파일이 있다면 백업쪽에도 반영시키라는 말이겠죠?)

`--delete-excluded` : `--exclude`에 지정된 놈도 목표 폴더 쪽에서 지워라.(백업할 필요 없는 놈은 백업하지 말라는 말이죠 ㅋ)

이상이다.

## 윈도우에서 사용하기

자료를 백업하기 위해서 1테라짜리 하드를 하나 사 뒀다.

이놈을 네트워크 드라이브인 z로 잡아 뒀다.

처믐엔 <a href="http://allwaysync.com/" target="_blank">allway sync</a> 같은 프로그램을 이용하려고 했지만, 이놈은 처음엔 무료고 일정 용량 이상 싱크를 하면 더이상 사용을 하지 못하는 놈이었다. 당했다 ㅡㅡ;;

그래서 이놈저놈 찾다가 그냥 rsync를 이용하기로 했다. 최고로 안정적인 무료 프로그램 아닌가 ㅡㅡ;;

그리고 난 프로그래머! cui따위 두렵지 않아!!! ㄷㄷㄷ;;

그래서 일단 윈도우에서 rsync를 사용하기 위해 <a href="http://blog.bagesoft.com/864" target="_blank">cygwin을 설치</a>했다.

cygwin은 윈도우에서 unix 프로그램들을 사용할 수 있게 해 주는 프로그램이다. 좀 눈이 돌아갔지만 무사히 설치했다.

그리고 아래 명령어를 이용해서 깔끔하게 끝냈다.

<pre class="brush:shell">rsync -av --delete /cygdrive/c/backup /cygdrive/z</pre>

이상!

## 원격에서 하기

원격 rsync 는 ssh를 사용한다. 서버컴에서 192.168.0.2 의 `~/backup` 폴더로 백업할 때 아래 명령을 사용하면 된다. 192.168.0.2 원격 컴퓨터의 사용자 이름은 mytory 라고 가정한다.

<pre>rsync -avzO /serverComputer/backup mytory@192.168.0.2:~/backup</pre>

-z 옵션은 전송시 압축을 해서 보내라는 거다. 그럼 받는 쪽에서 압축을 푼 다음에 받게 될 거다.(아마)

`~/backup` 에서 ~ 기호는 home 폴더를 의미한다. `cd ~` 라고 터미널에 쳐 보라.

위 명령을 치면 암호를 입력하라고 나온다. 암호 입력 과정을 생략하고 싶다면, [ssh 사용시 암호 입력 과정을 생략할 수 있도록 키를 생성하는 방법][1]을 참고하라.

 [1]: https://mytory.net/archives/1144 "ssh를 이용한 파일 복사 scp – 암호 없이 복사하는 방법도."