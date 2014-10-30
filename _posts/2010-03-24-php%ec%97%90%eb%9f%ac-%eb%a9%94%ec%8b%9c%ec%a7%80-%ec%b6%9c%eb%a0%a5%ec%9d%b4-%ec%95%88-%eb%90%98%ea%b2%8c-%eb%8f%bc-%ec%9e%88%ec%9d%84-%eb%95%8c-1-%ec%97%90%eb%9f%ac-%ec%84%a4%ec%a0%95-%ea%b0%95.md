---
title: '[PHP]에러 메시지 출력이 안 되게 돼 있을 때 &#8211; 1.에러 설정 강제 변환 2.커스텀 에러 핸들러'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/456
aktt_notify_twitter:
  - yes
daumview_id:
  - 36988343
categories:
  - 서버단
tags:
  - PHP
---
웹호스팅 업체에서 PHP의 에러 메시지 출력을 막아둔 경우가 있습니다. 이해할만한 일인데, 보통 사용자들 입장에서는 에러 메시지가 나오는 것보다는 아예 아무 화면도 안 뜨는게 좀더 나아 보이기 때문이죠. 또한, 에러가 실제 콘텐츠에는 영향을 안 끼치는 경우도 있습니다. 

include한 파일에 에러가 있는데, include한 파일에서 아무 것도 리턴해 주지 않는 경우를 생각해 봅시다.(조건에 따라 얼마든지 그럴 수 있습니다.) 그런데 include한 파일에 오류가 하나 있다고 칩시다. 그러면 오류를 뿌리지 않는 경우에는 &#8216;멀쩡한&#8217; 것처럼 나옵니다. 오류를 뿌리는 경우에는 괜시리 화면이 깨져 보이는 것입니다.

당연히 단점도 있습니다. 오류가 있는데 모르는 거죠. 이건 로컬에서 충분히 테스트를 하는 것으로 해결을 해야겠죠.

하지만, 로컬에서는 제대로 돌아가는데 온라인에서는 제대로 돌아가지 않는 경우도 생깁니다. 이럴 때 오류 메시지가 나오지 않으면 답답하기 짝이 없습니다. php.ini를 수정할 수도 없으니 방법이 없다고 생각할 수도 있죠.

하지만 두 가지 방법을 사용해서 에러 메시지를 볼 수 있습니다.

첫 번째 방법은 해당 페이지에서만 php.ini 설정보다 우선한 설정을 적용시키는 것입니다.(이 첫 번째 방법은, <a href="http://blog.azki.org/" target="_blank">아즈키</a>님의 <a href="#comment8765798" target="_self">댓글</a>을 보고 추가한 내용입니다.)

아래 코드를 쓰면 됩니다.

<pre class="brush:php">error_reporting(E_ALL); 
ini_set("display_errors", 1); 
//오류 코드 - 없는 변수를 출력하라고
echo $there_is_no;
</pre>

두 번째 방법은 custom 에러 핸들러를 사용하는 것입니다.

일단 이 링크를 참고하세요 : <a target="_blank" href="http://sirjhswin.tistory.com/163">[PHP 고급] PHP 오류 처리하기</a>

고급이라고 해서 쫄지 마세요. 오류를 보고 싶은 파일의 맨 위에 아래 코드를 추가하면 간단하게 오류를 볼 수 있습니다.

<pre class="brush:php">//커스텀 에러 핸들러 함수
function customError($errno, $errstr)
 { 
 echo "&lt;p&gt;&lt;strong&gt;Error:&lt;/strong&gt; [$errno] $errstr&lt;/p&gt;";
 }

//에러 핸들러 세팅
set_error_handler("customError");
</pre>

참 쉽죠잉?

더 알아보고 싶다면 <a target="_blank" href="http://sirjhswin.tistory.com/163">위에서 링크한 글</a>과 <a target="_blank" href="http://php.net/manual/en/function.set-error-handler.php">php.net의 set_error_handler 함수 설명</a>을 보세요.