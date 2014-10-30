---
title: 센스부족(노센스)는 80포트를 사용한다
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/70
aktt_notify_twitter:
  - yes
daumview_id:
  - 37249474
categories:
  - 서버단
tags:
  - apache
---
얼마 전 알게 된 사실이다.

<a href="http://www.apmsetup.com/" target="_blank">APM_SETUP</a>으로 개인 컴에 서버를 구축해서 잘 사용하고 있었는데, 어느날 갑자기 아파치가 안 돌아가는 것이다.

왠일이지? ㅇ_ㅇ?

라고 생각한 뒤 그냥 82번 포트로 바꿨다. 그러니 잘 돌아갔다. 별 문제 없이 사용했다.

그런데 포맷을 하고 나서 이번엔 아예 APM_SETUP이 깔리지도 않는 것이었다.

그냥 80번 포트가 사용중이라는 안내메시지만 뜨고 설치가 안 됐다.

아파치랑 mysql이랑 php를 다 다운받아서 설정하고싶지 않았다!(귀찮아 죽는다구!)

그래서 이번에 문제를 해결하고 말았다.

어떤 프로그램이 무슨 포트를 사용하고 있는지 알려주는 훌륭한 프로그램을 다운받았다.(<http://qaos.com/article.php?sid=1991> 참고 &#8211; 프로그램 이름은 <a href="http://www.pendriveapps.com/currports-portable-tcp-ip-udp-port-monitor/" target="_blank">NirSoft에서 만든 CurrPorts</a> 다. / 리눅스라면 <http://kldp.org/node/21394>를 참고하면 좋을 듯. 물론 APM_SETUP은 윈도우 프로그램이지만 말이다;;)

그리고 어떤 프로그램이 얌체같이 80포트를 먹었는지 알게됐다.

## 범인은 센스부족

바로 센스부족이다.

<a href="http://www.kippler.com/win/nosense/" target="_blank">센스부족은 브라우저에서 광고를 제거해 주는 프로그램</a>이다. 브라우저 자체 기능을 사용하는 게 아니라 hosts 파일을 사용하기 때문에 광고를 원천적으로 차단해 준다.

사실 이 프로그램을 사용하지 않아도 웹에 돌아다니는 <a href="http://lovelywolf.tistory.com/375" target="_blank">hosts 파일을 다운받아 덮어씌우는 것으로 얼마든지 광고를 차단</a>할 수 있지만, 이 프로그램을 사용한 이유가 있다.

광고의 주소 자체를 차단해버리기 때문에 광고가 있는 자리에 광고 대신 404 오류가 뜬다. 그래서 살짝 보기 흉한 면이 있다. 그런데 센스부족을 사용하면 이 화면을 하얗게 처리해 준다.

다른 하나의 장점은 탐색기에서 귀찮게 hosts를 찾지 않고 원클릭으로 껐다켰다 할 수 있다는 점이다.

그런데 이 프로그램이 80포트를 먹어버리니, 윈도우 애플리케이션에 대한 지식이 없는 나로서는 지우고 사용하는 수밖에.

어쨌든, 그래서 무사히 APM_SETUP을 깔았다는&#8230;

혹시 80포트 막혀서 고생하시는 분들 중 센스부족을 사용하시는 분들은, 센스부족을 지워보시면 바로 될 것입니다.

&nbsp;