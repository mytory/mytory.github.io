---
title: '[우분투] 설치된 패키지 목록 저장(백업)했다가 한 번에 설치하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/647
aktt_notify_twitter:
  - yes
daumview_id:
  - 36885899
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
뭐, 거의 백업이나 다름없다. 저장소에서 파일 다운받는 데 시간이 좀 걸린다는 문제가 있지만 말이다. <div>
  <a href="http://myubuntu.tistory.com/382" target="_blank">http://myubuntu.tistory.com/382</a>
</div>

<div>
  링크 참고하면 될 거고&#8230; 명령어가 편하니 명령어를 쓰면&#8230;
</div>

<div>
  <pre class="brush:plain">dpkg --get-selections | grep -v deinstall &gt; 설치내역.txt</pre>
</div>

<div>
  이러면 &#8216;설치내역.txt&#8217;가 만들어지고&#8230;
</div>

<div>
  <pre class="brush:plain">sudo dpkg --set-selections &lt; 설치내역.txt</pre>
</div>

<div>
  이러면, 설치내역에 저장된 애들이 다 설치된다.
</div>

<div>
  참 쉽죠잉?
</div>