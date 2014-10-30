---
title: '[번역:phpThumb] phpThumb FAQ(2)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/477
aktt_notify_twitter:
  - yes
daumview_id:
  - 36982897
categories:
  - 서버단
tags:
  - PHP
  - phpThumb()
---
<div class="box">
  <p>
    이 글은 썸네일 생성 프로그램인 <a href="http://phpthumb.sourceforge.net/" target="_blank">phpThumb()</a>의 <a href="http://phpthumb.sourceforge.net/demo/docs/phpthumb.faq.txt" target="_blank">FaQ</a> 뒷부분을 번역한 것이다. <a href="http://mytory.textcube.com/entry/%EB%B2%88%EC%97%ADphpThumb-phpThumb-FAQ1" target="_blank">앞부분 번역도 이 블로그에서 볼 수 있다.</a> 당연히 오역이 있을 수 있다. &#8211; 녹풍
  </p>
</div>

**Q: config에서 (w/h/fltr[] 같은) 파라미터를 설정해서 URL을 바꾸는 게 불가능하도록 할 수 있나요?**

A: phpThumb.config.php의 맨 아래쪽에 있는 `$PHPTHUMB_DEFAULTS`를 보세요. 이렇게 바꾸면 됩니다.

<pre class="brush:php">$PHPTHUMB_DEFAULTS_GETSTRINGOVERRIDE = false</pre>

이렇게 하는 것도 됩니다.

<pre class="brush:php">$PHPTHUMB_DEFAULTS_DISABLEGETPARAMS = true</pre>

더 연구하길 바라면

<pre class="brush:php">$PHPTHUMB_CONFIG[&#039;high_security_enabled&#039;] = true</pre>

(높은 보안 모드에서 이미지를 호출하는 방법을 알고 싶으면 phpThumb.config.php의 맨 아래쪽에 있는 예제를 보세요.)

**Q: **`<b>phpThumb()</b>`** 객체를 이용해서 URL에 이미지 위치 같은 걸 파라미터로 보여주는 일 없이 썸네일을 생성하는 방법이 있나요?**

A: /demo/phpThumb.demo.object.php에 그런 데모가 있습니다. 이걸 당신이 사용하는 파일에 맞고 고칠 수 있지만, 파일에 파라미터를 넘겨야 한다는 문제는 남습니다. 그게 phpThumb.php든 `phpThumb()` 객체든 간에 말입니다. 제가 제시하는 방법은, 가능한한 아주 많은 파라미터를 phpThumb.config.php의 `$PHPTHUMB_DEFAULTS` 아래 집어넣어서 그런 파라미터들을 각각의 이미지에는 전달하지 않는 것입니다. 만약 사람들이 파라미터를 변경하는 게 싫다면, `$PHPTHUMB_CONFIG['high_security_enabled']`를 켜세요. 그리고 암호를 설정하세요.(phpThumb.config.php의 맨 아래쪽에 있는 `phpThumbURL()` [함수로] 이미지를 만들어야 할 겁니다.) 만약, 사람들이 원본 이미지에 전혀 접근하지 못하게 만들고 싶다면, 원본 이미지들을 서버의 DOCUMENT_ROOT 밖에 두세요.(단, phpThumb/PHP는 그 디렉토리를 읽을 수 있어야 합니다.) 다른 옵션은, 원본 이미지를 MySQL 데이터베이스에 넣고, `$PHPTHUMB_CONFIG['mysql_query']`와 phpThumb.config.php의 관련된 파라미터를 설정하고, 원본 이미지를 데이터베이스에서 뽑아 쓰는 것입니다. 이 방법은 phpThumb.php를 통하는 것 외에는 이미지를 다룰 방법이 없게 만듭니다. 그리고 만약 높은 보안모드가 켜져 있다면, 파라미터를 고쳐서 뭘 보는 건 불가능합니다. 오직 당신이 보여주도록 한 것만 보일 겁니다. 결론적으로, 맞습니다. 당신 자신의 객체를 만들어서 쓰는 것은 가능합니다. &#8212; 한 가지 주의할 점은, phpThumb.php가 모든 캐시를 제어하기 때문에, 객체를 만들 경우에는 [캐시를] 스스로 다뤄야 한다는 점입니다.

**Q: 파일로 쓰거나 브라우저에 쏘는 거 말고, 썸네일을 데이터베이스에 직접 쓸 수 있는 방법은 없나요?**

A: /demo/phpThumb.demo.object.php를 보세요. 기본적으로 `this->GenerateThumbnail()` 를 호출한 다음, `$this->RenderOutput()` 을 하면, 출력된 그대로의 이미지 데이터는 `$this->outputImageData` 에서 찾을 수 있습니다.

**Q: (제 서버에 있지 않은) HTTP 소스 이미지를 다룰 때, 마치 이미지 캐시가 안 되는 것처럼 phpThumb가 너무 느리게 돌아갑니다. 어떻게 하면 빨라질까요?**

A: 

<pre class="brush:php">$PHPTHUMB_CONFIG[&#039;cache_source_filemtime_ignore_remote&#039;] = true;
</pre>

만약 true로 설정돼 있으면, 원격 소스 이미지 수정 날짜를 체크하지 않을 것이고, 캐시된 이미지가 있다면 그걸 사용하게 될 겁니다. 원본 이미지가 바뀌었거나 없어졌더라도 말입니다. 

**Q: &#8220;cache\_default\_only_suffix&#8221; 설정 옵션은 뭐하는 놈인가요?**

A: 캐시 파일은 보통 &#8220;phpThumb\_cache\_www.example.com\_src1a482c2c760463795ff18faf073b389f\_par3e099041c2f4a73041a7f5d7e7fc481a_dat1119952152.jpeg&#8221;처럼 굉장히 이상한 이름으로 생성됩니다. 하지만 만약 `cache_default_only_suffix`가 켜져 있으면 캐시 파일명은 (예컨대) &#8220;pic_thumb.jpg&#8221; 같은 식으로 심플하게 변합니다. 문제는 썸네일이 오직 한 가지 버전만 저장된다는 점입니다. 다른 사이즈나 필터 등을 [캐시에서] 다시 호출하는 게 불가능해집니다. 일반적으로는 그렇게 되는 걸 원하지 않겠지만 몇몇 사람들은 이걸 요구하기 때문에 있습니다.

**Q: 회전된 이미지는 왜 회전되기 전의 이미지보다 작은 건가요?**

A: phpThumb는 회전된 이미지를 가로(`w`) 세로(`h`) 크기에 맞춥니다. `w` 파라미터를 설정하지 마세요 : 

<pre class="brush:plain">phpThumb.php?src=file.png&ra=15</pre>

그렇게 하면 이미지가 회전되지 않은 이미지 사이즈대로 유지됩니다.(사실, 이렇게 맞추면 캔버스 사이즈 자체는 더 커집니다.) 

**Q: phpThumb.demo.check.php를 실행하니까 안전 모드(Safe Mode)가 마스터(Master)에서는 off고, 로컬에서는 on이라고 합니다. php.ini를 체크해 보니 이미 off로 돼 있습니다. 세이프 모드를 끄려면 어떻게 하죠?**

A: 아마 PHP가 Apache 모듈로 설치된 것 같습니다. 그렇다면, 도메인 세팅에서

<pre class="brush:plain">php_admin_value sage_mode "Off"</pre>

이렇게 설정해야 합니다.(보통은 httpd.conf의 <virtualhost> 태그 사이에 있습니다.) 설정하고 나면 아파치를 재시작해야 합니다. 

**Q: 원본 이미지를 지웠을 때 캐시 파일은 어떻게 지우죠?**

A: phpThumb에 내장된 캐시 제거 방법을 써서(phpThumb.config.php를 보세요) 그런 효과를 거둘 수도 있고, 삭제를 위해 원본 이미지를 수동으로 쭉 훑고, 매치(match)되는 캐시 파일을 찾아서 지울 수도 있습니다 : 

<pre class="brush:php">if ($dh = opendir($sourcedir)) {
       while ($file = readddir($dh)) {
         if ($file == $WhatIwantToDelete) {
           $md5 = md5_file($sourcedir.&#039;/&#039;.$file);
           unlink($phpthumb_cache_dir.&#039;/phpThumb_cache_www.example.com_src&#039;.$md5.&#039;*.*&#039;);
         }
       }
       closedir($dh);
     }
</pre></p> 

**Q: 캐시 파일을 지워도 되나요?**

A: 네. 캐시 디렉토리나 파일 죄다 지워도 상관없습니다. phpThumb는 필요하면 자동으로 캐시를 다시 생성할 겁니다. 또한, 자동 캐시 청소를 위해 phpThumb.config.php에 설정돼 있는 &#8220;cache_max*&#8221;를 확인해 보세요.

**Q: phpThumb.php가 특정한 이미지에 대해 사용할 파일명을 알 수 있는 방법이 있나요?**

A: 캐시 파일명을 아는 건 쉽지는 않습니다. phpthumb.class.php 파일의 `SetCacheFilename()` 안에서 [파일명을] 계산하는 메서드를 볼 수 있을 것입니다.(대략 2991-3090라인 사이에 있습니다.) 이미지가 어디에서 렌더링되는지 궁금하다면, 그건 좀더 쉬운데, phpThumb 객체를 호출해서 당신 자신의 캐시를 설정하면 됩니다. /demo/phpThumb.demo.object.simple.php에서 예제를 보세요.

**Q: PDF 썸네일을 생성할 수도 있나요?**

A: ImageMagick과 GhostScript가 설치돼 있다면 가능합니다. GhostScript AFPL 버전이 GNU 버전보다 더 잘 작동하는 걸로 보입니다.(적어도 제가 보기엔 그렇습니다.)  
<a href="http://www.imagemagick.org" target="_blank">http://www.imagemagick.org</a>  
<a href="http://www.cs.wisc.edu/~ghost/" target="_blank">http://www.cs.wisc.edu/~ghost/</a>  
썸네일을 생성할 페이지를 지정하기 위해서는 &#8220;`sfn`&#8220;(Source Frame Number) 파라미터를 사용해야 합니다.

**Q: 웹페이지의 썸네일을 생성할 수 있습니까?**

A: 아마도 그럴 겁니다. 하지만 쉽지 않습니다. 이론적으로는 html2ps, GhostScript, ImageMagick이 모두 설치돼 있으면 가능합니다만, 제가 테스트해 본 적은 없습니다. 웹페이지의 썸네일을 만드는 다른 프로젝트가 있습니다 : <a href="http://www.boutell.com/webthumb/" target="_blank">http://www.boutell.com/webthumb/</a>

**Q: 움직이는 GIF로 썸네일을 생성했더니 원본 파일보다 썸네일의 파일 사이즈가 더 커졌습니다. &#8212; 왜 그런 거죠?**

A: 움직이는 GIF는 시간적, 공간적으로 다양한 압축 테크닉을 사용합니다. 원본 GIF는 아마도 아주 잘 최적화돼 있을 것입니다. 하지만 각각의 프레임이 리사이즈됐을 때, 몇몇 바람직한 압축 프로퍼티는 부정적인 영향을 미칠 수 있습니다.(색깔수가 증가할 수 있습니다; 디더링 영역은 채워진(solid) 영역의 색에 비해 아주 서툴게 압축됩니다.) ImageMagick 또한 파일사이즈를 최적화한 움직이는 GIF를 만들 수는 없습니다.

**Q: 파라미터로 이루어진 이미지 스크립트가 있습니다.(같은 서버에 있을 수도 있고 다른 서버에 있을 수도 있습니다.) 예컨대: http://sourceforge.net/sflogo.php?group_id=106407&type=5 이런 식으로 말입니다.(이 주소는 210&#215;62 사이즈의 PNG 이미지를 보여줍니다.) 이걸 사용해서 [썸네일] 이미지를 만들 수 있나요?  
**

A: 네. phpThumb를 이용해서 그렇게 할 수 있습니다. 원본 이미지가 다른 서버에 있다면, `$PHPTHUMB_CONFIG['nohotlink_valid_domains']`에 소스 도메인을 포함해야 합니다. [예컨대, sourceforge.net] 만약 소스 도메인이 몇 개 정도라면 말입니다. 아니면 `$PHPTHUMB_CONFIG['nohotlink_enabled']`를 false로 설정하세요. 그러면 어떤 도메인/IP에 있는 이미지든 간에 원본 이미지로 사용할 수 있습니다.

또, 이미지 소스를 (PHP의 rawurlencode 함수를 이용해서) 아마 확실하게 인코드해줘야 할 겁니다. :   
/phpThumb.php?src=http%3A%2F%2Fsourceforge.net%2Fsflogo.php%3Fgroup_id%3D106407%26type%3D5&w=100

**Q: phpThumb는 세계 최고의 소프트웨어입니다. 후원하고 싶은데요.**

A: 간단합니다. http://phpthumb.sourceforge.net 의 맨 위에 있는 &#8220;Support this project&#8221; 버튼을 누르고 과정을 따라 하세요.(그럼 SourceForge에도 5%를 내게 됩니다.), 아니면 PayPal을 이용해서 직접 내는 방법도 있습니다. info@silisoftware.com 로 후원하시면 됩니다.

**Q: 이 스크립트/프로그램/라이브러리의 정확한 이름은 뭡니까?**

A: 공식 명칭은 &#8220;phpThumb()&#8221;입니다. 하지만 짧게 쓸 때는(혹은 괄호가 허용되지 않는 경우) 간단히 &#8220;phpThumb&#8221;라고 씁니다. 대소문자를 구분하지 않는 환경에서는 &#8220;phpthumb&#8221;라고 쓰기도 합니다. 다음 경우는 잘못된 형식입니다 : PHPthumb; phpThumbs; phpthump; phpthumbnailer; phpThumbnail; PHP Thumb; Phpthumb; 등