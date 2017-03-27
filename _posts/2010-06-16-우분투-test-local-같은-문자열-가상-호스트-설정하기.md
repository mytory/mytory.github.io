---
title: '[우분투] test.local 같은 문자열 가상 호스트 설정하기'
author: 안형우
layout: post
permalink: /archives/678
aktt_notify_twitter:
  - yes
daumview_id:
  - 36865136
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
<pre class="brush:plain">sudo gedit /etc/apache2/sites-available/default</pre>

<div>
  여기에서 아래 설정을 추가해 준다.
</div>

<div>
  이건 맨 위에 써 주고
</div>

<div>
  <pre class="brush:plain">NameVirtualHost *:80</pre>
</div>

<div>
  이게 있는지 확인한다. 있는 거 확인했으면 일단 위의 줄만 남기고 나머지를 다 지워버린다.
</div>

<div>
  기본으로 돼 있는 긴 <VirtualHost *:80> &#8230; </VirualHost> 부분을 지우라는 말이다. 불안하면 파일을 백업해 놓고.
</div>

<div>
  그리고 아래 줄을 추가하는데 127.0.0.1:80 이런 거 쓰지 말고 *:80을 쓰기 바란다.
</div>

<div>
  아직 공부가 부족한 나로서는 위의 두 사항을 왜 해야하는지는 모른다. 그러나 위의 두 사항대로 하지 않으면 안 되더라;;
</div>

<pre class="brush:plain">&lt;VirtualHost *:80&gt;
ServerName {가상호스트로 사용할 주소(ex - test.local)}
ServerAlias {가상호스트로 사용할 주소(ex - test.local)}
DocumentRoot "{가상호스트의 절대경로(ex - /home/myname/workspace/testProject)}"
&lt;/VirtualHost&gt;
</pre>

<div>
  컴퓨터가 가상 호스트의 주소를 알아먹을 수 있도록 /etc/hosts 파일에 호스트의 주소를 추가해 준다.
</div>

<div>
  <pre class="brush:plain">sudo gedit /etc/hosts</pre>
</div>

<div>
  위 파일에 아래 줄을 추가해 준다.
</div>

<div>
  <pre class="brush:plain">127.0.0.1	{아까 쓴 가상호스트 주소 (ex - test.local)}</pre>
</div>

<div>
  그리고 아파치를 재시작한다.
</div>

<div>
  <pre class="brush:plain">sudo /etc/init.d/apache2 restart</pre>
</div>

<div>
  웹브라우저에 test.local 이라고 치면 잘 들어가진다. 혹시 안 되면 http://test.local 이라고 쳐 보라.
</div>