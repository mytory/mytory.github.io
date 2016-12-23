---
title: 'crontab 에디터 오류 &#8211; /bin/sh: /usr/bin/vi: No such file or directory    crontab: &#8220;/usr/bin/vi&#8221; exited with status 127'
author: 안형우
layout: post
permalink: /archives/836
aktt_notify_twitter:
  - yes
daumview_id:
  - 36763244
categories:
  - 서버단
tags:
  - shell
---
crontab -e 명령으로 <a href="http://mytory.net/archives/601" target="_blank" title="우분투 예약작업 관리, cron">crontab을 사용</a>하려고 하니까 오류가 났다.

<img alt="" class="aligncenter" filemime="image/jpeg" filename="crontab 오류 해결.png" height="300" src="/uploads/legacy/old-images/1/cfile24.uf.120CC73A4D632BA10A8D0F.png" width="577" />

이렇게 cron 명령어를 치니

<pre class="brush:shell">sudo crontab -e</pre>

이렇게 에러 메시지가 떴다.

<pre class="brush:plain">no crontab for root - using an empty one
/bin/sh: /usr/bin/vi: No such file or directory
crontab: "/usr/bin/vi" exited with status 127
</pre>

에러 구문을 보니 편집기인 vi 의 위치가 잘못 잡혀 있는 것 같았다.

그래서 몇 군데를 뒤졌다가 <a href="http://www.unix.com/unix-dummies-questions-answers/773-bin-sh-usr-bin-vi-no-such-file-directory-when-doing-crontab.html" target="_blank" title="[http://www.unix.com/unix-dummies-questions-answers/773-bin-sh-usr-bin-vi-no-such-file-directory-when-doing-crontab.html]로 이동합니다.">해결책이 써 있는 곳</a>을 발견했다.

근본적 해결책이라기 보다는 임시 방편이긴 하다. 하지만 일단 잘 작동한다.

위 에러 메시지를 보면 /usr/bin/vi 라는 파일이나 디렉토리가 없다는 말이 나온다. 실제로 없었다.

실제 vi의 위치는 /bin/vi 였다. 위 해결책은 /bin/vi 의 심볼릭 링크를 만드는 방법이다. /usr/bin/vi 로 심볼릭 링크를 만들어 주면, 깔끔하게 실행되는 것이다.

(심볼릭 링크가 뭔지 잘 모르는 사람은 그냥 단축 아이콘이라고 생각하면 된다. 물론 심볼릭 링크의 경우는 심볼릭 링크를 지우면 원본까지 함께 삭제되므로 단순한 단축 아이콘은 아니다)

명령어는 아래와 같다. 관리자 권한이 필요할 것이다. 나는 sudo를 붙여서 관리자 권한을 사용했다.

<pre class="brush:shell">sudo ln -s /bin/vi /usr/bin/vi</pre>

/bin/vi를 실행시키는 /usr/bin/vi 라는 링크를 만들라는 명령어다.(나 같은 경우는 /usr/bin/vim 을 연결했다.)

위 명령을 실행하고 나면 해결된다.