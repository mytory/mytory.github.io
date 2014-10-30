---
title: '[shell] 원격 접속해서 시간 오래 걸리는 작업, 접속 끊어도 계속 진행되게 하기 disown'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2340
aktt_notify_twitter:
  - yes
daumview_id:
  - 36618133
categories:
  - 서버단
tags:
  - shell
---
**요약 : 원격 쉘에서 프로세스가 진행중일 때 일단 Ctrl+Z 를 눌러서 일시정지를 시킨다. 그리고 `bg` 라고 쳐서 정지된 프로세스를 백그라운드로 돌린다. 그 다음 `disown` 이라고 치면 내 거가 아니라고 선언되면서, 내가 접속을 끊어도 계속 작업이 돌아가게 된다.**

[구루의 기술뉴스][1]에서 예전에 본 글이다.

> <a href="http://t.co/nOhAHDMQ" rel="nofollow">“몇년전부터 알았으면?”하는 리눅스명령어는?</a> 1등이 bash의 내장코맨드인 `disown` 이군요. 쉘종료하면 죽어버리는 Job들에 대해 내꺼아냐! 라고 선언해서 안죽이게 하는 명령

두어번 이게 떠올랐고, 오늘 장시간의 `rsync` 명령을 사용할 일이 생겼다. 그래서 명령어를 실제로 사용해 보려고 했다.

어떻게 사용하는지 몰라서 [원문][2]을 찾아 들어갔다. 그랬더니 친절하게 사용법이 설명돼 있었다.

> ssh 세션에서 졸라 긴 `rsync`를 시작한 뒤 노트북을 끄고 밖으로 나가야 했던 경험이 있을 거다. `screen`이나 `nohup`으로 시작하는 걸 까먹었을 거다. 일단 일시정지를 하고(ctrl+z), 백그라운드 작업으로 돌릴 수 있다.(`bg`) 그리고 `disown` 으로, 당신이 세션을 종료했을 때 SIGHUP로부터 보호받도록 할 수 있다. Bash에는 (그리고 공정히 말하면, zsh와 다른 것들도 비슷할 텐데) 사람들이 잘 모를 수 있는 좋은 작업 제어 명령들이 있다. 심지어 20년 경력의 베테랑이라 해도 말이다. 더 알고 싶다면 [이 페이지][3]를 참고하라.
> 
> You know how you always start that mega long rsync in an ssh session from your laptop and then realize you have to go offline halfway through? You forgot to start it in screen or nohup, didn&#8217;t you? You can pause it (ctrl+z), background it (`bg`), and then `disown` it so it is protected from SIGHUP when you quit your ssh session. Bash (and, to be fair, zsh and others have copied much of this) has some wonderful job control features most people are completely oblivious of &#8211; even veterans of 20 years. Check [this page][3] out for more

nohup가 뭔지 찾아 봤다. hup 없이 실행하라는 말 같은데, 명령 실행할 때 앞에 붙여 준다.

SIGHUP는 로그아웃할 때 job을 한꺼번에 죽이는 걸 말하는 듯하다. `nohup`는 SIGHUP 없이 명령을 실행하라는 뜻인 것 같다.

[위키피디아에 보니][4] SIG는 signal을 의미하고, HUP은 hang up을 의미한다고 한다. 그럼 SIGHUP은 signal  hang up &#8211; 종료 신호가 되겠다. `nohup` 명령은 &#8216;끊지 말라&#8217;쯤 되겠다.

*SIG* is a common [prefix][5] for signal names; *HUP* is a [contraction][6] of *hang up*.

그런데 &#8216;[nohup 와, 백그라운드 작업][7]&#8216;이라는 글을 보니, 요새는 굳이 nohup으로 명령을 시작하지 않아도 자동으로 nohup이 된다고 한다. 확인은 못 해 봤다. 시스템 설정을 확인하면 되는데,

> 명령줄에 `shopt | grep huponexit` 라고 치면  
> `huponexit off`  
> 라고 나옵니다.  
> `huponexit`는 `exit` 할 때 `SIGHUP`을 모든 job에게 보낸다는 옵션인 것 같습니다.  
> 이게 기본으로 켜 있지 않네요.

라고 한다. 즉 `huponexit`가 `off`면 세션을 종료할 때 job이 죽지 않는다는 말이리라. 그러면 그냥 Ctrl+Z 를 눌러 일시정지를 한 뒤, `bg`를 쳐서 백그라운드작업으로 돌린 뒤, 세션을 나오면 되는 듯하다. 물론 나는 그래도 불안하니 `disown`을 치고 나서 나오련다.

## screen 명령

마지막으로 `screen` 명령어도 `nohup`와 비슷한 역할을 하는 것이라는 걸 확인했다. ([참고1][8], [참고2][9])

1.  `screen -S 작업이름`
2.  빠져나갈 땐 : `Ctrl+A,D`
3.  다시 작업으로 들어가기 : `screen -r 작업이름`
4.  내가 했던 작업 보기 : `screen -ls`

<pre>screen -S rsyncJob</pre>

위처럼 명령을 내리면 새 세션이 시작된다. 아마 가상 뭐 그런 거 같다.

명령을 내린 뒤 Ctrl을 누른채 A,D를 차례로 누르면(Ctrl+A,D) `screen` 명령을 내린 화면으로 돌아온다. 이대로 로그아웃해도 작업은 계속 돌아가고 있다는 거다.

작업 안으로 들어가려면

<pre>screen -r rsyncJob</pre>

이렇게 치면 된다는 거다.

 [1]: http://xguru.net/832
 [2]: http://www.reddit.com/r/linux/comments/mi80x/give_me_that_one_command_you_wish_you_knew_years/
 [3]: http://www.gnu.org/software/bash/manual/bashref.html#Job-Control
 [4]: http://en.wikipedia.org/wiki/SIGHUP
 [5]: http://en.wikipedia.org/wiki/Prefix_(linguistics) "Prefix (linguistics)"
 [6]: http://en.wikipedia.org/wiki/Contraction_(grammar) "Contraction (grammar)"
 [7]: http://kldp.org/node/87464
 [8]: http://windstop.tistory.com/29
 [9]: http://blog.naver.com/kuees98/110108293315