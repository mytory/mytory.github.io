---
title: 'WP Security Scan으로 DB prefix 고친 후 &#8220;이 문서에 접근할 권한이 없습니다(You do not have sufficient permissions to access this page)&#8221;가 나올 경우'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1064
aktt_notify_twitter:
  - yes
daumview_id:
  - 36753383
categories:
  - WordPress
tags:
  - WordPress Tip
---
[WP Security Scan][1]은 워드프레스의 각종 보안사항을 점검해 주는 플러그인이다.

그런데 가장 골때리는 게 DB table의 prefix를 `wp_`로 하면 안 된다고 하는 부분이다.(prefix는 번역하면 접두어인데, DB table의 prefix라고 하면 `wp_user`, `wp_post`, `wp_usermeta` 따위에서 앞에 붙는 `wp_`를 말하는 거다. 한 DB 안에 여러 개의 프로그램용 table이 생겼을 때 prefix 없이 테이블을 만들었다가는 관리자가 눈이 돌아갈 거다.)

<div style="width: 422px" class="wp-caption aligncenter">
  <img class=" " src="http://dl.dropbox.com/u/15546257/blog/mytory/wp_security_scan_1.jpg" alt="" width="412" height="384" /><p class="wp-caption-text">
    위쪽 빨간 줄을 보면 prefix가 wp_면 안 된다고 써 있다.
  </p>
</div>

이미 생성한 DB를 고쳤다가 무슨 일이라도 벌어지면 어떻게 하라고?

오늘 개발을 하다가 로컬에서 한 번 이 플러그인을 이용해 table의 prefix를 고쳐 보기로 했다. svn도 있고 DB는 모두 백업해 놨고 뭐 거슬릴 거 없었다.

(이걸 하려면 phpmyadmin 같은 걸로 DB에 접근하고 데이터를 고칠 줄 알아야 한다. 그런 능력이 없으면 끝까지 다 읽어 보고 하기 바란다. 하기 전에 DB 백업은 필수다.)

하기 전에 설명을 보면

> wp-config must be set to writable before running this script.  
> the database user you&#8217;re using with WordPress must have ALTER rights.

라고 한다. 일단 루트 폴더에 있는 wp-config.php 를 아파치가 쓸 수 있는 상태여야 하고,(보통의 웹서버에서는 777로 권한을 설정해 줘야 한다.) 다음으로는 database 사용자가 ALTER 권한이 있어야 한다. 대부분의 웹서버에서는 권한이 없을리 없으므로 걱정할 거 없다.

자, wp-config.php의 권한을 바꿔 보자. 나는 Filezilla FTP Client를 사용한다. 파일의 속성을 보면 아래와 같이 나오는데 그냥 숫자로 777이라고 써 주자. (작업이 끝나면 바로 644로 되돌려 놔야 한다.)

<div style="width: 282px" class="wp-caption aligncenter">
  <img src="http://dl.dropbox.com/u/15546257/blog/mytory/wp_security_scan_2.jpg" alt="" width="272" height="376" /><p class="wp-caption-text">
    하기 전에 파일 속성을 777로 변경해 주고 끝난 다음에는 다시 644로 변경해 준다.
  </p>
</div>

그다음 SECURITY > Database 로 들어가서 원하는 prefix를 적어 준다.

<div style="width: 581px" class="wp-caption aligncenter">
  <img src="http://dl.dropbox.com/u/15546257/blog/mytory/wp_security_scan_3.jpg" alt="" width="571" height="208" /><p class="wp-caption-text">
    원하는 prefix를 적어 준 후 Start Renaming 버튼을 눌러 준다.
  </p>
</div>

그러면 뭐라뭐라 나온다. 의외로 쉽게 끝난다.

끝난 다음에 나오는 메세지를 유심히 봐야 한다. 이런 데 나오는 메세지를 절대로 소홀히 여기지 말 것!

<div style="width: 752px" class="wp-caption aligncenter">
  <img class=" " src="http://dl.dropbox.com/u/15546257/blog/mytory/wp_security_scan_4.jpg" alt="" width="742" height="274" /><p class="wp-caption-text">
    (1) usermeta 테이블의 무슨 값을 바꿔야 하는데 못 바꿨다고 나오고 (2) wp-config 의 권한을 바꾸지 못했다고 나온다.
  </p>
</div>

위의 설명을 보면 뭔가 DB에서 수정해야 하는데 못 한 것 같고, 다음으로 wp-config.php 권한을 644로 못 바꿨다고 하는 거다. wp-config의 권한이야 다시 FTP Client에 들어가서 바꾸면 되는 거고, DB의 usermeta 테이블에서 뭔가 값을 고치지 못한 것은 치명적이다. 이것 때문에 관리자 로그인이 안 된다. ㄷㄷ;;

관리자 화면으로 돌아가려고 하면 아래와 같은 에러 메세지가 뜬다.

> You do not have sufficient permissions to access this page

한글로는

> 이 문서에 접근할 권한이 없습니다.

초심자라면 졸라 당황할 거다. 나도 당황해서 걍 원래대로 되돌렸다가 [검색을 해서 찾아냈다.][2](근데 이 사람이 적어 준 SQL문은 작동하지 않는다. 내가 아래쪽에 고쳐서 제대로 작동하는 놈을 적어 놨다.)

해결하기 위해서는 mysql 명령을 내릴 줄 알아야 한다. phpmyadmin으로 들어가 보자.

일단 wp\_usermeta였을, 그리고 지금은 newprefix\_usermeta일 그 테이블로 들어간다. 그리고 내용을 봐야 하는데, meta\_key 컬럼에서 아래와 같은 놈들을 볼 수 있을 거다. user\_level을 제외하고는 죄다 예전 그대로 wp_로 prefix가 붙어 있다.

<p style="text-align: center;">
  <img class="aligncenter" src="http://dl.dropbox.com/u/15546257/blog/mytory/wp_security_scan_6.jpg" alt="" width="250" height="114" />
</p>

이놈들을 한 방에 고쳐 주는 명령이 아래 명령이다.

<pre>UPDATE book_usermeta SET meta_key = REPLACE( meta_key , &#039;wp_&#039;, &#039;book_&#039; )</pre>

SQL 항목을 눌러서 위 명령줄을 복사해 넣고 실행하면 완료된다.

그럼 모든 것이 문제없이 작동한다. 끝!

 [1]: http://wordpress.org/extend/plugins/wp-security-scan/
 [2]: http://wordpress.org/support/topic/wp-security-scan-error-after-database-prefix-change#post-1840691