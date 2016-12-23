---
title: 우분투에서 CPU 온도 보기(모니터링 하기)
author: 안형우
layout: post
permalink: /archives/146
aktt_notify_twitter:
  - yes
daumview_id:
  - 37184783
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
윈도우용을 찾는다면 다음 두 글 중 하나를 참고하면 된다 :

<http://comlog.kr/104>&nbsp;<http://loved.pe.kr/entry/CPUID-HWMonitor>

내 노트북이 세 번째 고장났다.

내 노트북은 TGIC NOTEBOOK이라는 중소기업에서 나온 건데, 지금 그 회사는 망했고 TGIC는 모니터 회사가 됐다. 물론 이 회사에서 노트북도 만드는 것 같던데, 내 노트북 기종에 대한 지원은 미약한 듯하다. 인수한 것인지 새출발한 것인지는 모르겠으나, 그냥 버리지는 않는 정도. <a href="http://mytory.textcube.com/entry/TGIC-MXBOOK-노트북은-수리-불능-TGIC-MXBOOK-PS1530V1510V" target="_blank">가장 중요한 건 A/S가 안 된다는 점이다.</a>

용산 에이스컴에서 노트북을 수리했는데, 열 때문에 메인보드 칩이 나가는 것 같다고 했다. 노트북 안에 쿨러를 추가설치할 수는 없으니 바닥에서 팬으로 열을 식혀주는 그런 걸 사라고 조언해 줬다.

그것도 사야 겠다. 그리고 오늘은 우분투에 CPU 온도 감시 프로그램을 설치했다.

참고한 글은 이거다 : <a href="http://ubuntuyo.textcube.com/17" target="_blank">ubuntu 8.04 에서 온도를 보자. 우분투 8.04 cpu 온도를 보자.</a>

내 우분투는 9.10이지만 8.04를 대상으로 한 저 설명과 다를 바가 없었다. 크게 변한 게 없는 모양이다. 저 글을 보면 금방 할 수 있을 텐데, 한 가지 헤맨 건, 패널에 온도 그래프가 뜨게 만드는 방법이었다. 그 부분이 매우 생략돼 있어서 헤맸다.

일단, 설치할 프로그램은 sensors-applet이다. 시냅틱 패키지 관리자에서 찾아서 설치하면 의존성을 만족시키면서 모두 설치하니까 저놈만 찾아서 설치하면 된다.

<div style="width: 380px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile22.uf.1575A3584D4BC8761F996B.png" width="370" height="82" alt="" /><p class="wp-caption-text">
    △이놈만 찾아서 설치하면 된다.
  </p>
</div>

설치 끝난 후 패널에 CPU 온도를 표시하려면 다음과 같이 한다. 시냅틱 패키지 관리자 일단 끄고. 패널에서 마우스 오른쪽 버튼을 누른다.

<img src="/uploads/legacy/old-images/1/cfile9.uf.130EAD494D4BC8762244B8.png" class="aligncenter" width="154" height="172" alt="" />

나오는 메뉴에서 패널에 추가를 선택한다.

&#8216;패널에 추가할 항목 찾기&#8217;에 sensors 라고 치면 필요한 놈이 나올 것이다. 아래 그림 참고하면 된다.(안 나오면 로그아웃했다가 들어와 보자. 로그아웃했다 들어왔는데 안 되면 재부팅 해 보자.)

<img src="/uploads/legacy/old-images/1/cfile9.uf.124C91474D4BC8762CF7DA.png" class="aligncenter" width="570" height="522" alt="" />

그러면 아래 그림처럼 CPU 온도가 표시된다. 내 노트북의 CPU는 평소 때 45~46℃를 유지하는 것 같다.

<img src="/uploads/legacy/old-images/1/cfile25.uf.135B8E4C4D4BC87717458C.png" class="aligncenter" width="558" height="26" alt="" />