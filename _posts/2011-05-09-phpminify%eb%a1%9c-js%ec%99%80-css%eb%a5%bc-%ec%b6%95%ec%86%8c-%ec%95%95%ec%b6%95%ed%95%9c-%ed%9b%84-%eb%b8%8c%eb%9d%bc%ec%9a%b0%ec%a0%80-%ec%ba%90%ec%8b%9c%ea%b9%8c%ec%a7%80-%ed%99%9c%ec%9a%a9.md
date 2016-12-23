---
title: '[PHP]minify로 js와 css를 축소, 압축한 후 브라우저 캐시까지 활용하면 금상첨화다'
author: 안형우
layout: post
permalink: /archives/1252
aktt_notify_twitter:
  - yes
daumview_id:
  - 36717402
categories:
  - 서버단
tags:
  - PHP
---
**요약: minify는  `<script type="text/javascript" src="minify/f=my-javascript.js&숫자"></script>` 형식으로 사용할 경우, 자동으로 캐시 기간을 1년으로 설정해 준다. 숫자 항목에 파일의 최근 변경 날짜를 넣는 스크립트를 짜서 넣는다. 파일이 변경되면 숫자가 변하고 그러면 브라우저는 새로운 파일로 인식해 파일을 다운로드한다.**

## 들어가기 전에 알아야 할 것

[minify][1]는 js와 css의 공백을 제거한 후 gz 압축을 해서 온라인 트래픽을 획기적으로 줄여 주는 좋은 PHP 라이브러리다. 사용법을 모른다면 [minify에 대해 내가 쓴 글][1]을 읽고 오라.

브라우저 캐시에 대해 구체적으로 모른다면 [구글이 추천하는 브라우저 캐시 방법에 대해 내가 번역한 글][2]을 읽어라. 그래야 이 글이 이해될 거다.

## 왜 이걸 공부하게 된 거죠?

어제 [구글의 페이지 스피드][3]에서 내가 관리하는 웹사이트가 92점을 받았다. 점수를 가장 많이 깎아 먹은 것은 캐시 부분이었다. 자원 중 하나도 캐시 명령을 내려 주는 게 없었다.

그래서 캐시 공부를 하기로 했고, 구글 페이지 스피드의 [캐시 관련 부분을 번역][2]했다. 번역은 큰 도움이 됐다. 특히! URL Fingerprint (URL 지문) 는 완전히 새로운 개념이었다.

그래서 URL 지문을 활용해 내가 관리하는 사이트에도 캐시를 적용해 보기로 마음먹었다.

## minify가 기본으로 지원한다는 사실

처음에는 파일의 hash를 이용해서 URL 지문을 자동생성하려고 했다. 아마 그렇게 하는 게 가장 좋았을 거다. 하지만 몇 가지 까다로운 점이 있었고, 좀 지나치게 복잡한 부분도 있었다. 그런 부분을 극복하기 위한 조치를 몇 가지 하면서 코드를 다 짰다.

마지막으로 [캐시 관련 헤더][2]를 추가했다. 그런데 왠걸? 만료일을 1년으로 설정했는데도 30분으로 세팅돼 나오는 것!

(아래는 구글 크롬 브라우저에서 헤더 정보를 보는 방법을 설명한 동영상이다.)

<p style="text-align: center;">
  <div class="video-container">
    <div class="video-container__inner">
    </div>
  </div>
</p>

모든 프로젝트에서 캐시의 만료일 관련 단어인 Expires를 찾은 다음에야 원인을 알 수 있었다.(이클립스에서는 Ctrl+H 를 누르면 프로젝트 전체에서 문자열 찾기/바꾸기를 할 수 있다.)

minify 폴더의 config.php 에는 아래와 같은 줄이 있다.

<pre>/**
 * Maximum age of browser cache in seconds. After this period, the browser
 * will send another conditional GET. Use a longer period for lower traffic
 * but you may want to shorten this before making changes if it&#039;s crucial
 * those changes are seen immediately.
 *
 * Note: Despite this setting, if you include a number at the end of the
 * querystring, maxAge will be set to one year. E.g. /min/f=hello.css&123456
 */
$min_serveOptions[&#039;maxAge&#039;] = 1800;</pre>

여기서 헤더 관련 정보를 1800초(30분)로 설정해 뒀기 때문에 그랬던 것이다. 그렇다고 이 설정을 마음대로 바꿀 수는 없었다. URL 지문을 넣지 않은 자원이 캐시 기간이 1년이 되면 곤란하기 때문이다.

그런데 주석을 보다가 재밌는 걸 알게 됐다.

> Note: Despite this setting, if you include a number at the end of the querystring, maxAge will be set to one year. E.g. /min/f=hello.css&123456

만약 `/min/f=hello.css&123456` 형식으로 호출을 하면 캐시 기간을 뭘로 설정하든 무조건 1년으로 캐시 기간이 설정 된다는 거다. 오호라! 그럼 숫자에 최종 변경일을 넣어 주면 되겠군!

그래서 내가 만든 함수를 폐기하고 minify의 기본 기능을 이용해 캐시를 구현하기로 결정했다. 내가 짠 코드가 아깝기는 했지만, 1)기존 라이브러리를 사용할 때 내가 직접 짠 코드를 추가해 사용하면 아무래도 부담스럽다. 버전업 때 충돌을 일으킬 수도 있고, 그렇지 않더라도 언제 어떤 충돌이 날지 예상할 수 없다. 2)내가 적용한 방식보다 minify의 방식이 간결했다. (물론 내가 짠 것은 md5 해시를 이용하고, minify는 최종 변경일만 사용하게 되므로 내가 짠 방식이 다운로드 회수를 더 줄일 수 있다는 장점은 있다.)

이런 판단 하에 아래 함수를 만들었다.

<pre class="brush:php">function set_filename_with_last_modified_timestamp($file){
	$stat = stat($_SERVER[&#039;DOCUMENT_ROOT&#039;].&#039;/&#039;.$file);
	return &#039;/minify/?f=&#039;.$file.&#039;&&#039;.$stat[&#039;mtime&#039;];
}</pre>

[`stat` 함수는 PHP 기본 함수][4]로, 파일의 상태를 알려 주는 함수다. 파일의 상태 정보를 담은 `array`를 리턴해 주는데, 그 중 `$stat['mtime']`은 최종 변경 시간을 가리킨다.

그니깐, 파일 경로를 `/css/my-css.css` 형식으로 받아서, `/css/my-css.css&1304673504` 형식으로 돌려 주는 함수를 만든 거다. 뒤에 붙는 숫자는 최종 변경 시간의 유닉스 타임스탬프다.

그렇게 하니까 정말로 캐시 기간이 1년이 됐다. 만세!

## 이렇게 하면 어떤 장점이 있냐고?

이렇게 하면 캐시를 정말 실질적으로 활용할 수 있게 된다.

1.  파일이 6개월 간 변경되지 않았다면 파일명이 계속 `/css/my-css.css&1304673504` 로 인지될 것이고, 그렇다면 브라우저는 계속 캐시에 저장된 파일을 사용할 거다.
2.  만약 6개월 후에 파일이 변경된다면 아마 파일명이 `/css/my-css.css&1320225504` 쯤으로 변경될 거다. 그러면 브라우저는 &#8220;어라? 새 파일이잖아?&#8221; 하고 파일을 다운받을 것이다.

결국 캐시 기간이 1년이지만, 파일이 변경되면 다운로드하고, 변경되지 않으면 다운로드하지 않는 효과를 낼 수 있게 되는 것이다!

이런 기법을 바로 URL 지문 기법이라고 한다.

## 참고

이걸 모를까 싶지만, 혹시나 해서 위에서 내가 제공한 함수를 실제로 어떻게 사용하는지 코드를 붙인다.

<pre>&lt;script type="text/javascript" src="&lt;?=set_filename_with_last_modified_timestamp(&#039;/js/jquery.js&#039;)?&gt;"&gt;&lt;/script&gt;</pre>

이상.

&nbsp;

 [1]: http://mytory.net/archives/1048 "[minify] js, css 압축 – 웹사이트 속도 증가, 트래픽 절약"
 [2]: http://mytory.net/archives/1232 "구글 페이지 스피드가 추천하는 브라우저 캐시 활용(Leverage browser caching)"
 [3]: http://mytory.net/archives/1183 "Google에서 제공하는 웹사이트 페이지 속도 측정, 관리 기능"
 [4]: http://php.net/manual/kr/function.stat.php