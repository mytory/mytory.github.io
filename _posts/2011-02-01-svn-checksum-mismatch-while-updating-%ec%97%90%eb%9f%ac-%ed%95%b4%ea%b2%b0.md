---
title: 'svn: Checksum mismatch while updating 에러 해결'
author: 안형우
layout: post
permalink: /archives/827
aktt_notify_twitter:
  - yes
daumview_id:
  - 36764496
categories:
  - 개발 툴
tags:
  - SVN
---
<img src="/uploads/legacy/old-images/1/cfile10.uf.18329D554D4BC97130E518.png" class="aligncenter" width="384" height="332" alt="" filename="subversion_logo-384x332.png" filemime="image/jpeg" />

svn이 어느날 업데이트 명령을 거부했다.

<pre class="brush:plain">update C:/workspace/myProject -r HEAD --force
    svn: Working copy &#039;C:\workspace\myProject\css&#039; locked; try performing &#039;cleanup&#039;
    svn: Working copy &#039;C:\workspace\myProject\css&#039; locked; try performing &#039;cleanup&#039;
cleanup C:/workspace/myProject
</pre>

그런데 난 아무 것도 한 게 없다고! 그냥 잘 작업하다가 update를 눌렀을 뿐이라고!

어찌된 일인지? 에러 메세지를 보면 svn에서 ‘css 폴더가 잠겼으니 cleanup을 해 보시오’ 라고 했기에, <a target="_blank" href="http://wiki.kldp.org/wiki.php/SubversionBook/GuidedTour#svn-ch-3-sect-7.1">cleanup 명령</a>을 내려 봤다.&nbsp;

작업을 실행하다가 문제가 생겼을 때 cleanup을 실행하면 중단한 작업을 다시 실행하게 된다. 그러면 잠겼던 파일도 풀리고 뭐 그런 거다.(svn은 작업을 할 때 대상 파일을 잠근다. 커밋중인 애를 수정하면 망하니까 ㅋ)

자, cleanup 명령을 내렸으니 다시 업데이트를 시켰다.

<pre class="brush:plain">update C:/workspace/myProject -r HEAD --force
    Restored C:/workspace/myProject/css/index.css
    svn: Checksum mismatch while updating &#039;C:\workspace\myProject\css\.svn\text-base\index.css.svn-base&#039;; expected: &#039;1bdfe3f4fe587005aa0562c465ad54ad&#039;, actual: &#039;null&#039;
    svn: Checksum mismatch while updating &#039;C:\workspace\myProject\css\.svn\text-base\index.css.svn-base&#039;; expected: &#039;1bdfe3f4fe587005aa0562c465ad54ad&#039;, actual: &#039;null&#039;
</pre>

그러자 이번엔 뭥미? ‘index.css.svn-base 를 업데이트하는데 <a href="/archives/96" target="_blank" title="[http://mytory.net/72]로 이동합니다.">Checksum</a>이 안 맞는다’고 한다.&nbsp;

자기는 어쩌고 저쩌고를 기대했는데 나의 작업본은 null이란다.

우썅 어쩌라고!

## 해결책: 작업본 삭제

전에 몇 번 이랬을 때는 작업본 전체를 삭제하고 전부 다시 다운받았다.

이제는 그렇게 무식한 짓을 하지 않는다. 문제가 된 폴더는 css 폴더다. 그래서 그놈만 지웠다.

이건 svn에서 지우라는 게 아니라 그냥 **탐색기 가서 del 버튼 누르라는 소리**다.&nbsp;

이클립스 쓰시는 분들 있다면, 이클립스에서 지우지 말고 탐색기나 노틸러스에서 지우시길.

자자. 그러고 나서 update하면 잘 된다.

어쩌면 저 index.css 만 문제일 수도 있다. 저놈만 지워도 될 지도 모른다. 그런데 그렇게 해 본 적은 없으니 패스!