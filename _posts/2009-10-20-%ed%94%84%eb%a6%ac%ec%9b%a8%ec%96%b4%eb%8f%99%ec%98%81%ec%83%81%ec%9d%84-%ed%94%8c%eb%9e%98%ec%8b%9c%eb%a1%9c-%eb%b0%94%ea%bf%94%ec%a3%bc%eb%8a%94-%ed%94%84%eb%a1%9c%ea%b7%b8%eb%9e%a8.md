---
title: '[프리웨어]동영상을 플래시로 바꿔주는 프로그램'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/75
aktt_notify_twitter:
  - yes
daumview_id:
  - 37241316
categories:
  - 기타
tags:
  - TIP
---
동영상을 바로 홈페이지에 게제하는 것은 별로 권장하지 않고 싶다. 코덱 문제, 속도 문제 등이 걸리기 때문이다. 요즘은 호환성이 뛰어난 플래시로 많이 바뀌었다.(한 3년 전만 생각해도 플래시가 이렇게 대중적이진 않았다.)

그런데 플래시로 바꿔주는 동영상 사이트들은 있지만, 플래시 파일로 바꿔서 재생 버튼도 나오게 하고 하는 기술은 많은 사람들이 모르는 게 사실이다. 사실 나도 프로그래밍을 하지만 플래시를 건드려 본 적은 없다.

그런데 이 프로그램은 동영상을 넣기만 하면 플래시로 바꿔서 뱉어준다. 한마디로 짱이다.

<a target="_blank" href="http://www.dvdvideosoft.com/index.htm">Free Video to Flash Converter</a>(<a href="http://www.dvdvideosoft.com/products/dvd/Free-Video-to-Flash-Converter.htm" target="_blank">다운로드 링크</a>)라는 프로그램이다. 사용법은 간단하다. 넣기만 하면 뱉어준다. 그리고 뱉어낸 폴더로 가 보면 (아마 C:\DVDVideoSoft일 가능성이 크다.) HowToUseFlash_Example.htm 이라는 파일이 있다. 더블클릭하면 웹브라우저에서 열릴 것이다. 거기에 소스가 있다. 플래시를 심을 파일과 플래시 파일을 같은 폴더에 둘 생각이면 그 소스를 그대로 사용하면 된다. 하지만, 실제 플래시 파일과 플래시를 보여주는 페이지가 다른 폴더에 있도록 할 생각이라면 몇 가지 부분을 수정해 줘야 한다.(아마 대부분 이렇게 할 것이라고 생각한다) 다음 소스를 보라.

<pre title="code" class="brush: xhtml;">&lt;object id="player1" type="application/x-shockwave-flash" data="player_flv_maxi.swf" width="480" height="360"&gt; 
&lt;noscript&gt;&lt;a href="http://www.dvdvideosoft.com/products/dvd/Free-Media-Player-Software.htm"&gt;free media player&lt;/a&gt;&lt;/noscript&gt; 
&lt;param name="movie" value="player_flv_maxi.swf" /&gt; 
&lt;param name="allowFullScreen" value="true" /&gt; 
&lt;param name="FlashVars" value="configxml=파일명.xml" /&gt; 
&lt;/object&gt;</pre>

위에서 player\_flv\_maxi.swf 는 재생, 일시정지, 멈춤 등 버튼을 갖고있는 swf다.

파일명.xml은 재생설정 관련 정보를 담고 있는 아이다.

player\_flv\_maxi.swf는 두 번, 파일명.xml은 한 번 소스에 나오는데, 위치를 정확히 적어줘야 한다.

예컨대, 아래처럼 변경한다.

<pre title="code" class="brush: php;">&lt;object id="player1" type="application/x-shockwave-flash" data="/flash01/player_flv_maxi.swf" width="480" height="360"&gt; 
&lt;noscript&gt;&lt;a href="http://www.dvdvideosoft.com/products/dvd/Free-Media-Player-Software.htm"&gt;free media player&lt;/a&gt;&lt;/noscript&gt; 
&lt;param name="movie" value="/flash01/player_flv_maxi.swf" /&gt; 
&lt;param name="allowFullScreen" value="true" /&gt; 
&lt;param name="FlashVars" value="configxml=/flash01/파일명.xml" /&gt; 
&lt;/object&gt;</pre>

지금 나는 html 절대경로로 /flash01/라고 적어줬지만, http://www.url.com/flash01/ 이런 식으로 적어줘도 된다.

그러면 훌륭하게 돌아가는 플래시 비디오의 모습을 볼 수 있을 거다. 유튜브 보다는 다운로드 속도가 빠른 것 같다. 훨씬 적은 사람들이 볼 테니깐. ㅋㅋㅋ