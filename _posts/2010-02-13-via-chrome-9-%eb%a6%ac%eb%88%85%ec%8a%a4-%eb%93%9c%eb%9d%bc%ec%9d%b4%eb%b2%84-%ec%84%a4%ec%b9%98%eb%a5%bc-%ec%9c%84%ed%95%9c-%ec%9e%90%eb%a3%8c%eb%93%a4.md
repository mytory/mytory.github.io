---
title: via chrome 9 리눅스 드라이버 설치를 위한 자료들
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/275
aktt_notify_twitter:
  - yes
daumview_id:
  - 37091007
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
내 노트북의 그래픽 드라이버는 Via Chrome 9이다. 저가형 노트북에 저가형 그래픽 드라이버인 듯하다.(확실한 것은 아니다.) 참고로 내 노트북은 <a href="http://mytory.textcube.com/entry/TGIC-MXBOOK-%EB%85%B8%ED%8A%B8%EB%B6%81%EC%9D%80-%EC%88%98%EB%A6%AC-%EB%B6%88%EB%8A%A5-TGIC-MXBOOK-PS1530V1510V" target="_blank">지금은 망한 회사인 TGIC NOTEBOOK</a>(지금 모니터를 만드는 TGIC는 이 회사를 인수한 것인지 새출발한 것인지 모르겠지만, 여튼 모니터 만드는 회사는 망한 회사는 아니다)의 PS1510V/PS1530V다. 노트북엔 MXBOOK이라고 써 있다. 이 노트북이 여러 모로 나를 피곤하게 한다.(물론 듀얼코어라 성능은 좋고, 메모리도 2기가로 업그레이드해서 쓸만 하다.)

여튼간에, 우분투 리눅스에서 그래픽 드라이버를 설치할 수가 없어서 화려한 3D가속을 이용할 수 없는 게 항상 안타까운 점이다.

자료를 몇 가지 모으고 있다. 같은 문제로 고민하는 분들께도 도움이 됐으면 한다. 혹시 아는 게 있다면 제보 남겨 주시기 바란다.

비디오 카드 모델명 : CN896/VN896/P4M900 \[Chrome 9 HC\] (rev 01)

<a href="http://linux.via.com.tw/support/downloadFiles.action" target="_blank">VIA Linux Portal</a> : 여기는 우분투 9.04까지 그래픽 드라이버가 올라와 있다. 만약 내가 9.10으로 업그레이드 하지 않았다면 이 드라이버로 테스트해 봤을 것이다.

<a href="http://kmuto.jp/debian/hcl/VIA/Chrome9+HC+IGP" target="_blank">Debian HCL</a> : 여기는 그래픽 드라이버와 데비안 리눅스의 호환성을 체크한 곳인 것 같다. Via Chrome 9은 잘 작동하는 것으로 체크돼 있다.

<a href="http://files.aoaforums.com/D357-VIA%20Chrome%209%20Drivers.html" target="_blank">VIA Chrome 9 Drivers(윈도우용)</a> : 윈도우용 드라이버다. <a href="http://mytory.textcube.com/entry/%EC%9A%B0%EB%B6%84%ED%88%AC%EC%97%90%EC%84%9C-%EC%9C%88%EB%8F%84%EC%9A%B0%EC%9A%A9-%EB%AC%B4%EC%84%A0%EB%9E%9C-%EB%93%9C%EB%9D%BC%EC%9D%B4%EB%B2%84-%EC%84%A4%EC%B9%98%ED%95%98%EA%B8%B0" target="_blank">무선랜은 윈도우 드라이버를 리눅스에서 사용하게 해 주는 유틸이 있는데</a> 그래픽 드라이버는 그런 게 없는지 궁금하다.(<a href="http://files.aoaforums.com/I3939-p4m900(ce)-vn896(ce)-cn896(ce)_24-10-04p_bld2_win7_viawsetup_logod.zip.html" target="_blank">윈도우7용 드라이버 다운로드</a>)

<a href="http://www.ubuntu.or.kr/viewtopic.php?p=47451#p47451" target="_blank">우분투 한국 사용자 모임 고수이신 강분도 님의 답변</a> : 이대로 했지만 아마도 xorg.conf 문제 때문에 실패한 듯하다. 다시 질문했다.

<a href="http://ubuntu.or.kr/viewtopic.php?f=9&t=1369" target="_blank">HP 2133 Mini Ubuntu 8.04 설치</a> : via chrome9의 칩셋은 HP2133 에서도 사용한다. 이 노트북에 우분투를 설치하려는 시도가 많았었나보다. 같은 그래픽 칩셋을 사용하는 만큼, HP2133에서 그래픽 드라이버 설치한 것을 보면 내 노트북에 그래픽 드라이버를 어떻게 설치할 수 있는지 알 수 있다는 말이 된다.

강분도님의 답변에서 착안해 HP2133 ubuntu 9.10 이렇게 검색해 봤다. 그랬더니 이런 글을 찾을 수 있었다.

<a href="https://wiki.ubuntu.com/LaptopTestingTeam/HP2133" target="_blank">HP 2133 Mini-Note</a>

뭔고 하니, 우분투 버전별로 HP2133에서 제대로 돌아가는지를 다 테스트해 본 결과란 말씀. 당연히 그래픽 드라이버에 관한 설명도 나와 있었다.

결과는 좀 좌절이다.

> Notes for 9.10
> 
> *   **<span style="color: #ff0000;">No VIA binaries available yet.</span>**
> *   **<span style="color: #ff0000;">VIA 바이너리 드라이버는 아직 사용할 수 없다.</span>**
> <li style="color: #999999;">
>   External monitor only works if connected at boot time.
> </li>
> *   외부 모니터는 부팅될 때 연결돼야만 작동한다.
> <li style="color: #999999;">
>   Audio driver is flaky, sometimes fails to work at all, sometimes disappears after suspend or hibernate but comes back after reboot; when it starts it works fine though.
> </li>
> *   오디오 드라이버는 좀 유별난데, 가끔 제대로 작동을 안 한다. 대기모드나 최대절전모드에 들어갔다 나오면 사라지는 경우도 있는데, 재부팅하면 다시 돌아온다; 어쨌든 시작하면 잘 작동한다.
> <li style="color: #999999;">
>   On a fresh install of kubuntu/karmic my wireless wasn&#8217;t working. It may be related to this bug. I was able to get wlan working by going to <strong>Administration> hardware drivers</strong> and enable the Broadcom STA which then downloaded drivers e.g. I had to have a working wired connection to finish this. I had wireless working on reboot.
> </li>
> *   쿠분투 칼믹(9.10)을 새로 설치한 경우 무선랜이 작동하지 않았다. 버그로 보고됐을 것이다. **시스템 > 관리 > 하드웨어 드라이버** 에서 Broadcom STA를 활성화하면 작동할 것이다. 예를 들면 나는 그렇게 하니까 제대로 됐다. 나는 재부팅 하니까 됐다.
> <li style="color: #999999;">
>   Since Karmic uses GRUB2 rather than GRUB to pass boot options, I had to edit /etc/default/grub to implement the CPU scaling fix mentioned above and add &#8220;osi=\&#8221;!Windows 2006\&#8221;. The back-slashes are necessary to escape the quotations within the stanza. The full line now looks like this: GRUB_CMDLINE_LINUX_DEFAULT=&#8221;acpi_osi=\&#8221;!Windows 2006\&#8221; quiet splash&#8221;
> </li>
> *   칼믹이 GRUB 대신 GRUB2를 사용해서 부트 옵션을 그냥 지나지므로, 나는 /etc/default/grub을  고쳤다. 위에 언급된 <a href="https://wiki.ubuntu.com/LaptopTestingTeam/Old/HP2133/CPUScalingFix" target="_blank">CPU 스케일링 수정</a>을 위해서다.(뭔 말인지는 링크 보면 될 거 같은데 아마 HP2133을 위한 것 같다. 나는 비디오 카드만 필요하므로 이건 필요 없을 것 같다.) 이걸 추가하면 된다. &#8220;osi=\&#8221;!Windows 2006\&#8221; 백슬러시는 따옴표를 컴퓨터에게 인지시키기 위해서 붙인거다. 이 라인을 전부 쓰면 이렇다 : GRUB\_CMDLINE\_LINUX\_DEFAULT=&#8221;acpi\_osi=\&#8221;!Windows 2006\&#8221; quiet splash&#8221;

번역하느라 힘들었다. 어쨌든, 핵심은 **9.10에 맞는 Via 바이너리 드라이버는 없다**는 거다.

자, 다음 9.04를 보자.(자세한 내용은 <a href="https://wiki.edubuntu.org/LaptopTestingTeam/Old/HP2133/Jaunty" target="_blank">LaptopTestingTeam/HP2133/Jaunty</a>를 참고하면 된다.)

> <li style="color: #999999;">
>   Smooth install with xubuntu 9.04 alternate cd. (au hp2133)
> </li>
> *   xubuntu 9.04 alternate cd를 갖고 하면 잘 설치된다.
> <li style="color: #999999;">
>   Most hardware detected and working out of the box. (au hp2133)
> </li>
> *   대부분의 하드웨어가 박스 밖에서 잡히고 작동한다.(박스는 X윈도우를 말하는 건가?)
> <li style="color: #999999;">
>   VIA binary video drivers (26oct09) released. RandR NOT working.
> </li>
> *   VIA 바이너리 비디오 드라이버는 2009년 8월 26일에 나왔다. 단, RandR은 작동하지 않는다.
> <li style="color: #999999;">
>   When using Openchrome, vga out doesn&#8217;t work.
> </li>
> *   오픈크롬을 이용하면, vga는 작동하지 않는다.
> <li style="color: #999999;">
>   Webcam issues (ok in Cheese, Fails in other applications)
> </li>
> *   웹캠 문제가 보고됐다. (&#8216;치즈&#8217;할 때 찍히는 기능이 다른 어플리케이션에서 작동하지 않는다.)

여기까지 본 결과, 9.04를 사용하면 그래픽 드라이버가 대충 작동한다는 사실을 알게 됐다.(<a href="https://wiki.edubuntu.org/LaptopTestingTeam/Old/HP2133/Jaunty" target="_blank">LaptopTestingTeam/HP2133/Jaunty</a>를 참고하면 9.04에서 그래픽 드라이버 설치법을 자세히 볼 수 있다.) 그럼 9.04로 넘어가는 게 좋을까? 9.10에서 바이너리가 나올 때까지 기다릴까.

8.10 버전의 설명을 볼까나.

> <li style="color: #999999;">
>   (Currently the only version with Latest VIA Binaries fully working)
> </li>
> *   (현재 최신 VIA 바이너리가 완전히 작동하는 유일한 버전이다.)
> <li style="color: #999999;">
>   Successful install with xforcevesa option.
> </li>
> *   xforcevesa 옵션으로 성공적인 설치.(<a href="https://wiki.ubuntu.com/LaptopTestingTeam/Old/HP2133/Intrepid" target="_blank">8.10 설치법</a>의 Base Installation 항목을 보면 이게 무슨 의미인지 알 수 있다.)
> <li style="color: #999999;">
>   VIA binary video drivers (26oct09) Released. RandR IS working.
> </li>
> *   VIA 바이너리 비디오 드라이버가 나와 있다.(2009년 8월 26일) RandR도 작동한다.
> <li style="color: #999999;">
>   Reference material for 8.10 xorg.conf configuration: <a href="https://wiki.ubuntu.com/LaptopTestingTeam/Old/HP2133/DisplayConfig810" target="_blank">/DisplayConfig810</a>
> </li>
> *   8.10에 맞는 xorg.conf(비디오 설정 파일이다) 설정 참고자료는 <a href="https://wiki.ubuntu.com/LaptopTestingTeam/Old/HP2133/DisplayConfig810" target="_blank">/DisplayConfig810</a>에서 볼 수 있다.
> <li style="color: #999999;">
>   Webcam issues (ok in Cheese, Fails in other applications)
> </li>
> *   웹캠 문제가 보고됐다. (&#8216;치즈&#8217;할 때 찍히는 기능이 다른 어플리케이션에서 작동하지 않는다.)

한 마디로 말해, 그래픽 드라이버를 기준으로 내가 선택할 수 있는 최선의 버전은 8.10이라는 말씀. 9.04를 사용하면 RandR이 작동하지 않는다는 건데, 이게 무슨 기능인지 좀 알아 봐야 겠다. 9.10에 맞는 바이너리는 없다는 말 ㅠ.ㅠ 그럼 그냥 9.04를 사용해야 하는 거 같다. RandR이 쌔끈한 기능이라면 8.10을 사용할 용의도 있다.

## 9.04에 그래픽 드라이버 잡기 시도 &#8211; 실패

cobunt 9.04로 드라이버를 인스톨해봤다. 9.04 설치법에 있는 것을 그대로 따라하면 되기 때문에 엄청 쉬웠다. 9.04는 굳이 우분투를 밀지 않고 설치할 때 파티션을 나누도록 해서 했다.

결과는 실패. 또 화면이 까맣게 나오고 말았다. 어쩌면 xubuntu 9.04로 하지 않아서 이렇게 된 것인지도 모른다.

어쨌든, 그래서 지금은 또 ubuntu 8.10으로 테스트하고 있다.

## 이후 시도 종합

xubuntu 9.04는 시디로 설치할 방법이 없어서 테스트하지 못했다.

ubuntu 8.10은 인스톨 할 때 옵션으로 맨 끝 &#8212; 뒤에 ide0=noprobe ide1=noprobe ide2=noprobe ide3=noprobe xforcevesa라고 적어주면 x윈도우가 떠서 설치를 할 수 있다. 하지만 드라이버를 설치하고 xorg.conf를 변경할 때마다 x윈도우가 까맣게만 나와서 실패했다.

8.04를 깔아 볼까;;