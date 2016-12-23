---
title: 아파치 가상호스트 작동 안 할 때 _default_ VirtualHost overlap on port 80, the first has precedence
author: 안형우
layout: post
permalink: /archives/825
aktt_notify_twitter:
  - yes
daumview_id:
  - 36765039
categories:
  - 서버단
tags:
  - apache
---
영어로 돼 있지만 여기가 잘 설명돼 있다 :&nbsp;<a href="http://www.cyberciti.biz/faq/warn-_default_-virtualhost-overlap-port80-first-hasprecedence/" target="_blank" title="[http://www.cyberciti.biz/faq/warn-_default_-virtualhost-overlap-port80-first-hasprecedence/]로 이동합니다.">Apache: [warn] _default_ VirtualHost overlap on port 80, the first has precedence Error and Solution</a>

요지는, <a href="http://mytory.net/archives/13" target="_blank">가상 호스트를 매길 때</a> 가상호스트 설정을 적어 준 부분에 NameVirtualHost 라고 적어 줘야 한다는 건데, 이 때 제대로 적어 줘야 한다는 거다. 예를 보자.(출처는 <a href="http://www.cyberciti.biz/faq/warn-_default_-virtualhost-overlap-port80-first-hasprecedence/" target="_blank" title="[http://www.cyberciti.biz/faq/warn-_default_-virtualhost-overlap-port80-first-hasprecedence/]로 이동합니다.">위 링크</a>)

<pre class="brush:plain"># My Virtual Hosts Config File for Two Domains
NameVirtualHost *:80

&lt;VirtualHost *:80&gt;
    ServerAdmin webmaster@theos.in
    DocumentRoot "/usr/local/docs/theos.in"
    ServerName www.theos.in
    ServerAlias theos.in
    ErrorLog "/var/log/theos.in-error_log"
    CustomLog "/var/log/theos.in-access_log" common
&lt;/VirtualHost&gt;

&lt;VirtualHost *:80&gt;
    ServerAdmin webmaster@nixcraft.com
    DocumentRoot "/usr/local/docs/nixcraft.com"
    ServerName www.nixcraft.com
    ServerAlias nixcraft.com
    ErrorLog "/var/log/nixcraft.com-error_log"
    CustomLog "/var/log/nixcraft.com-access_log" common
&lt;/VirtualHost&gt;
</pre>

여기서 주목할 부분은 바로 *:80이다. 가상 호스트의 포트와 `NameVirtualHost`의 포트를 맞춰 줘야 한다.

만약 IP로 구분을 했다면 *가 아니라 IP를 적어 줘야 한다고 한다.

`NameVirtualHost 192.168.0.99:80` 하는 식으로 말이다.

## 응용!

자, 그런데 나의 경우에는 저렇게 해도 작동이 안 됐다. 왜였을까?

virtualHost 정의 파일이 여러 개 있었던 게 원인이다. 나 같은 경우는 우분투를 사용한다. 우분투는 `/etc/apache2/sites-enabled` 폴더에 있는 심볼릭 링크<sub>(링크를 지우면 원본까지 지워지는 무서운 링크!)</sub>가 바로 가상 호스트를 정의하는 파일인데, 아래 그림을 보라.

<img alt="" class="aligncenter" filemime="" filename="cfile8.uf.175D704D4D4BC970289B63.png" height="393" src="/uploads/legacy/old-images/1/cfile8.uf.175D704D4D4BC970289B63.png" width="550" />

default 외에도 <a href="http://www.mindtouch.com/" target="_blank" title="[http://www.mindtouch.com/]로 이동합니다.">dekiwiki</a> 라는 놈이 보인다. 이놈도 바로 가상호스트를 정의하고 있었던 것이다! 이놈은 <a href="http://www.mindtouch.com/" target="_blank" title="[http://www.mindtouch.com/]로 이동합니다.">dekiwiki</a>를 설치하면 자동으로 생성되는 놈이기 때문에 눈치채지 못했던 것이다. OTL;;

자, 이 파일을 까 보면 이 가상호스트는 아래처럼 시작한다.

<pre class="brush:plain">&lt;VirtualHost *&gt;</pre>

즉, 그러므로 다른 가상 호스트들도 시작 부분을&nbsp;

<meta content="text/html; charset=utf-8" http-equiv="content-type" />


<VirtualHost \*:80> 이 아니라&nbsp;<VirtualHost \*>로 설정을 해 주고, 가상호스트 정의 파일 맨 앞에다&nbsp;

<pre class="brush:plain">NameVirtualHost *
&lt;VirtualHost *&gt;
</pre>

라고 적어 줘야 하는 것이다.

내가 권장하는 것은 가상 호스트 서정 파일 말고 httpd.conf 에 적어 주는 것이다. 가상 호스트 설정파일을 아파치가 읽기 전에 저 NameVirtualHost * 를 읽어야 하기 때문이다.

이렇게 모든 걸 끝내면 모든 가상호스트가 제대로 돌아가기 시작했다.

만약 고쳤는데도 [warn] NameVirtualHost *:80 has no VirtualHosts 따위 에러가 나오면 어딘가에 NameVirtualHost를 적어 둔 것이다. 찾아 내서 지워 주자.