---
title: '[워드프레스] 플러그인과 테마 업데이트할 때 FTP 인증을 거치지 않게 하려면'
author: 안형우
layout: post
permalink: /archives/3261
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36557523
categories:
  - WordPress
tags:
  - WordPress Tip
---
**요약 :**

1.  `wp-config.php` 파일에 `define('FS_METHOD', 'direct');`라고 추가한다.
2.  `wp-content/`, `wp-content/plugins/`, `wp-content/themes/` 폴더를 쓰기 가능하게 한다. 만약 `wp-content/upgrade/` 폴더가 있다면 그것도. (보통의 FTP 호스팅에선 755로 설정해야 할 거다. 777로 해야 하는 경우도 있는데, 그렇게 되면 보안에 별로 좋지 않다. 나는 권장하지 않겠다.)

워드프레스 3.2.1부터 작동한다.

&#8212;&#8212;

워드프레스 플러그인을 업데이트할 때 어느 순간부터 FTP 인증을 안 하게 됐다. 무슨 일인가 했다. 그런데 오늘 다른 웹사이트를 워드프레스로 개발하는데, FTP 아이디 비번을 넣으라는 것이다. 얼레 뭐지? 하는 생각이 들어서 찾아 봤다. 역시나 해답은 나왔다. ([Can I install/update wordpress plugins without providing ftp access?][1])

간단한 해법이었는데 그냥 wp-config.php에 다음 라인을 추가하는 것이었다.

<pre>define(&#039;FS_METHOD&#039;, &#039;direct&#039;);</pre>

물론 테마와 플러그인을 설치하려면 테마와 플러그인 폴더가 쓰기가능 상태여야 한다. FTP로 들어가서 마우스 우클릭을 하고 속성 같은 걸 보면 소유자 권한 &#8211; 읽기/쓰기/실행, 그룹 권한 &#8211; 읽기/쓰기/실행, 공개 권한 &#8211; 읽기/쓰기/실행 이런 게 있을 거다. 소유자에게 쓰기 권한이 있으면 된다. (숫자로 755라고 써도 된다. 맨 앞의 7이 핵심이다.) 755로는 되지 않는 경우가 있다. (그런 경우엔 777로 설정하면 되는데, 보안에 좋지 않다. 그런 경우엔 그냥 이 기능을 사용하지 않는 게 낫다고 생각한다.)

그러면 끝이다. 플러그인과 테마, 그리고 워드프레스도. 업데이트할 때 FTP 관리자 비번을 입력하라고 하지 않게 될 거다.

 [1]: http://stackoverflow.com/questions/640409/can-i-install-update-wordpress-plugins-without-providing-ftp-access