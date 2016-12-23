---
title: '[번역:phpThumb] phpThumb FAQ(1)'
author: 안형우
layout: post
permalink: /archives/474
aktt_notify_twitter:
  - yes
daumview_id:
  - 36984273
categories:
  - 서버단
tags:
  - PHP
  - phpThumb()
---
이 글은 phpThumb() 홈페이지의 <a href="http://phpthumb.sourceforge.net/demo/docs/phpthumb.faq.txt" target="_blank">phpthumb.faq.txt</a> 의 앞부분 절반을 번역한 글이다. 뒷부분은 계속 번역중이다.

## phpThumb(), 자주 하는 질문

<p style="font-weight: bold;">
  Q: 궁금한 게 있는데 여기 답변이 없는 경우 어떻게 지원받을 수 있나요?
</p>

A: <a href="http://support.silisoftware.com" target="_blank">http://support.silisoftware.com</a> 를 방문해서 질문, 제안, 버그 신고 같은 걸 할 수 있습니다.

<p style="font-weight: bold;">
  Q: 버그를 발견한 것 같은데 가장 먼저 해야 할 일은?
</p>

A: 최신 버전을 사용중인지 확인해 보세요. 운이 좋으면 [최신 버전엔서는] 버그가 이미 고쳐졌을지도 모릅니다. 그리고 나서 최신 버전과 함께 다시 테스트해 보세요. 버그 보고를 하기 전에 말입니다.

<p style="font-weight: bold;">
  Q: phpThumb가 생각대로 작동하지 않네요. 서버 설정 때문인 것 같습니다. 어떻게 체크할 수 있나요?
</p>

A: /demo/demo.check.php 를 돌려 보세요. 추천 서버 설정 제안과 성능 개선을 위해 할 것들을 찾을 수 있습니다.

<p style="font-weight: bold;">
  Q: GPL은 무엇입니까? 상업용 사이트에서 이걸 사용할 수 있나요?
</p>

A: GPL FAQ를 보세요.(<a href="http://www.gnu.org/licenses/gpl-faq.html" target="_blank">http://www.gnu.org/licenses/gpl-faq.html</a> [그냥 <a href="http://www.gnu.org/licenses/gpl-faq.ko.html#DoesTheGPLAllowMoney" target="_blank">여기</a>를 봐라 상업적으로 이용 가능하다고 써 있다. 그러나 다양한 환경에 놓일 때 복잡한 조건들이 있다. 그러니까 상업적 활용을 진지하게 할 생각이라면 꼼꼼히 GPL을 살펴 보기 바란다.]) 일반적으로, 만약 당신이 <img src=&#8221;phpThumb.php?src=pic.jpg&w=100&#8243;> 처럼 표준으로 phpThumb.php를 호출하길 원한다면 문제가 없다. 당신 사이트가 상업적이든 아니든, 당신 코드가 어떤 저작권 방침을 따르든 간에 위 방식을 사용하는 건 자유입니다.

만약 당신이 phpThumb()를 객체로 호출해서 사용한다면, 라이센스 이슈를 신경써야 합니다. 그러면 위에 소개한 FAQ와 GPL을 꼼꼼히 살펴보기(consult) 바랍니다.

phpThumb()를 상업적으로 사용하든 아니든 간에, 돈을 지불할 필요는 없다. 그러나 후원(donation)은 언제나 환영이다. 후원은 <a href="http://phpthumb.sourceforge.net" target="_blank">http://phpthumb.sourceforge.net</a> 에서 할 수 있다.

<p style="font-weight: bold;">
  Q: 썸네일 생성이 잘 되는 이미지도 있고, 안 그런 것도 있습니다.(대신에 원본 사이즈 이미지가 그냥 출력됩니다.)
</p>

A: PHP가 허용하는 메모리 사이즈가 충분하지 않고, ImageMagick도 서버에 설치되지 않은 경우입니다. PHP 메모리는 이미지 픽셀 수의 5배는 돼야 합니다.

예컨대,

<pre class="brush:plain">640x480x5	= 1.5MB
	1600x1200x5	= 9.2MB</pre>

PHP 메모리 사이즈는 php.ini에서 조절할 수 있습니다.(서버 관리 권한이 있다면 말입니다.) 혹은 (아직까지는 더 나은 방법인데) 서버에 ImageMagick을 설치하십시오. 그러면 메모리 제약 문제를 피할 수 있습니다. 만약 위의 두 가지 방법 중 어떤 것도 할 수 없다면 PHP가 제어할 수 있는 메모리 안쪽으로 이미지 사이즈를 리사이즈할 수 있습니다. 수동으로 말입니다. (당신이 애용하는 이미지 에디터를 사용하면 되겠죠.) 그리고/혹은 내장 EXIF 썸네일이 있는 이미지로 다시 저장할 수 있습니다.(포토샵 같은 걸 이용해서 말이죠.) 그러면 phpThumb가 원본 이미지로 그걸 사용할 수 있습니다.(물론, 이미지 질은 떨어지지만 없는 것보다는 낫습니다.)

<p style="font-weight: bold;">
  Q: 썸네일을 생성하면서 새로운 높이와 너비를 결정하는 방법이 있습니까?(img 태그에 width랑 height를 지정할 수 있는지)
</p>

A: 문제는 phpThumb가 이미지를 리턴한다는 겁니다. width/height 같은 추가적 정보를 보내줄 수 있는 방법은 없습니다. 그러나 이런 식으로 할 수 있습니다.

<pre class="brush:php">require_once(&#039;phpthumb.functions.php&#039;);
$pic = &#039;picture.jpg&#039;;
list($source_w, $source_h) = GetImageSize($pic);
$max_w = 375;
$max_h = 400;
list($newW, $newH) = phpthumb_functions::ProportionalResize($source_w, $source_h, $max_w, $max_h);
$url = &#039;phpThumb.php?src=&#039;.$pic.&#039;&w=&#039;.$max_w.&#039;&h=&#039;.$max_h;
echo "&lt;img src="\"$url\"" width="\"$newW\"" height="\"$newH\""&gt;&#039;;</pre>

<p style="font-weight: bold;">
  Q: 이런 에러 메시지가 나왔습니다.
</p>

Failed: RenderToFile(<filename>) failed because !is\_resource($this->gdimg\_output)

A: RenderToFile()이나 OutputThumbnail 전에 GenerateThumbnail()을 호출하는 걸 빼먹었기 때문입니다.

예제 페이지 /demo/phpThumb.demo.object.php 를 참고하세요.

<p style="font-weight: bold;">
  Q: 인터넷 익스플로러에서 phpThumb가 만든 이미지를 저장하려고 하니까 BMP 포맷으로 저장됩니다. 왜 그런 거죠?
</p>

A: phpThumb 탓이 아닙니다. IE에 관한 논의를 보세요.

<a href="http://support.microsoft.com/default.aspx?scid=kb;en-us;810978" target="_blank">http://support.microsoft.com/default.aspx?scid=kb;en-us;810978</a>

<a href="http://support.microsoft.com/default.aspx?scid=kb;en-us;260650" target="_blank">http://support.microsoft.com/default.aspx?scid=kb;en-us;260650</a>

<p style="font-weight: bold;">
  Q: 투명 영역이 있는 PNG에서 투명 부분이 회색 배경으로 나옵니다.
</p>

A: 인터넷 익스플로러는 지난 10년 동안 깨진 알파 채널 디스플레이를 갖고 있었습니다. 그래서 이건 수정될 수 없습니다. 다른 주요 브라우저들은 일반적으로 알파 채널을 잘 제어합니다. PNG 알파 채널이 제대로 보이도록 해 주는 IE 핵은 <a href="http://www.silisoftware.com/png_alpha_transparency/" target="_blank">http://www.silisoftware.com/png_transparency/</a> 와 <a href="http://www.silisoftware.com/png_alpha_transparency/" target="_blank">http://www.koivi.com/ie-png-transparency/</a> 를 보면 나옵니다. (역자 주 : 어쩐 일인지 두 페이지가 모두 사라졌고, 추적해 보니 결국은 같은 페이지를 가리키게 돼 버렸다.)

<p style="font-weight: bold;">
  Q: 파일이 존재하는데도 &#8220;<filename> does not exist&#8221;[파일이 존재하지 않습니다.] 라는 메시지가 나옵니다.
</p>

A: phpThumb.config.php 에 두 가지 값이 있는지, 있다면 정확히 있는지 체크해 보세요.(버전 1.6.0을 기준으로 설명합니다.)

$PHPTHUMB\_CONFIG['allow\_src\_above\_docroot']  (기본값=false)

$PHPTHUMB\_CONFIG\['allow\_src\_above\_phpthumb'\] (기본값=true)

이미지가 DOCUMENT\_ROOT 밖에 있는 거라면(이미지 업로드 폼이 있다면 포함돼 있을 건대, 보통 이미지는 &#8220;/tmp/<file>&#8221; 식의 디렉토리에 업로드된다) 그러면 &#8216;allow\_src\_above\_docroot&#8217;를 true로 설정해야 할 겁니다.

반드시 웹서버가 파일과 디렉토리를 읽을 수 있도록 퍼미션 설정을 해야 합니다.

<p style="font-weight: bold;">
  Q: 객체로 사용할 때 phpThumb.php와 phpThumb() 중 뭘 써야 할까요?
</p>

A: 기본적 기능만 사용한다면 phpThumb.php가 (적은 코딩으로) 더 사용하기 쉽습니다. phpThumb.php가 모든 캐시를 조정합니다; 객체를 사용하면 자신만의 캐시용 코드가 필요합니다. 만약 존재하는 이미지의 썸네일 코드를 보여주는 것만 바란다면, phpThumb.php를 사용하세요. 만약 썸네일을 파일로 저장하고 싶다면, (예컨대 업로드하는 동안) 객체 모드를 사용하는 것이 적절합니다. 또한, phpThumb.config.php은 phpThumb.php에서만 사용합니다. 그러므로 만약 당신이 객체 인스턴스를 생성한다면 모든 설정을 수동으로 해야 합니다. phpThumb.config.php가 [객체에는] 아무 영향도 미치지 않기 때문입니다. 그래서, 반복하자면:

\*\*객체가 필요한 게 아니라면 항상 phpThumb.php를 사용하세요\*\*

<p style="font-weight: bold;">
  Q: 썸네일이 있는 페이지에 처음 들어가면 썸네일은 안 보이고 이미지 틀만 보입니다.(혹은 이미지가 안 보입니다.) 새로고침을 누르면 모든 썸네일이 순식간에 뜹니다.
</p>

A: 이렇게 해 보면 잘 작동할 수도 있습니다.

<span style="white-space: pre;"> </span>$PHPTHUMB\_CONFIG['cache\_force_passthru'] = false;

하지만 대게는 기본 설정으로도 잘 작동합니다.

알림: 1.7.9 이전 버전에서는 아마도 몇몇 정의되지 않은 변수가 있어서 이런 증세가 나타날 수도 있습니다. [그런데] 만약 버전 1.7.9나 그보다 더 높은 버전에서도 이런 증상이 발생한다면 info@silisoftware.com으로 이메일을 보내 주세요.

<p style="font-weight: bold;">
  Q: phpThumb()에 프론트-엔드(사용자) 그래픽 인터페이스가 있나요?
</p>

A: /demo/readme.demo.txt를 보세요.

<p style="font-weight: bold;">
  Q: phpThumb의 /에 관한 보안 쟁점이 있습니까?
</p>

A: <a href="http://secunia.com/product/5199/" target="_blank">http://secunia.com/product/5199/</a>

<p style="font-weight: bold;">
  Q: phpThumb()로 출력된 이미지는 왜 플래시에서 작동하지 않나요?
</p>

A: 플래시는 프로그레시브 JPEG과 상성이 안 맞습니다. 이렇게 설정하세요:

&nbsp;

<pre class="brush:php">$PHPTHUMB_CONFIG[&#039;output_interlace&#039;] = false;</pre>

&nbsp;

<p style="font-weight: bold;">
  Q: 이미지 질이 썩 좋지 않아요. 왜 그런가요?
</p>

A: GD 1.x 버전을 사용하고 있다면 방법이 없습니다. GD 2.x 버전으로 업그레이드 하세요.

<p style="font-weight: bold;">
  Q: 이미지 질이 엄청 안 좋아요. 픽셀이 다 보여요. 왜 그렇죠?
</p>

A: 원본 이미지가 PHP메모리 허용치보다 더 커서, phpThumb가 EXIF 썸네일을 원본 이미지 대신 사용했기 때문에 그런 것일 수 있습니다. EXIF 썸네일은 보통 160&#215;120 정도 됩니다.(그래서 그걸 640&#215;480으로 리사이즈하면 엄청 안 좋아 보이는 거죠.) php.ini에서 권장 메모리 용량을 계산하려면 이미지 픽셀 수에 5를 곱하세요:

예컨대, 1600&#215;1200 = 1600 \* 1200 \* 5 = 9600000 = 10M

[이보다 더] 쉬운 해결책은 ImageMagick을 설치하는 것입니다.

<p style="font-weight: bold;">
  Q: 생성한 썸네일을 파일로 저장할 수 있나요?
</p>

A: 네. 몇 가지 방법이 있습니다. 가장 좋은 방법은 phpThumb 객체를 생성해서 RenderToFile()을 호출하는 것입니다. [이걸 이용해서] 원하는 파일명으로 저장하면 됩니다.

/demo/phpThumb.demo.object.php에 예제가 있으니 보세요.

다른 방법은 &#8216;file&#8217; 파라미터를 이용하는 것입니다. (/docs/phpthumb.readme.txt를 보세요.) 하지만 이 파라미터는 더이상 지원하지 않으며 1.7.5 버전 이후 작동하지 않습니다.

<p style="font-weight: bold;">
  Q: &#8220;Off-server[다른 서버에 있는 파일을 이용한] 썸네일 만들기가 허용되지 않습니다(Off-server thumbnailing is not allowed)&#8221; &#8212; 어떻게 하면 가능하게 만들죠?
</p>

A: 기본적으로, phpThumb()는 같은 도메인에 있는 이미지의 썸네일만 생성할 수 있습니다. 다른 도메인에 있는 이미지로 썸네일을 만들 수 있게 하려면, (phpThumb.config.php에) 이런 식으로 도메인을 추가해 주세요:

<pre class="brush:php">$PHPTHUMB_CONFIG[&#039;nohotlink_valid_domains&#039;] = array(
  @$_SERVER[&#039;HTTP_HOST&#039;], &#039;example.com&#039;, &#039;www.example.com&#039;,
  &#039;subdomain.example.net&#039;, &#039;example.org&#039;);

//To disable off-server thumbnail blocking, just set:
  $PHPTHUMB_CONFIG[&#039;nohotlink_enabled&#039;] = false;</pre>