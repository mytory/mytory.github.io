---
title: '[번역] 워드프레스 퍼미션 설정(Permission Scheme for WordPress)'
author: 안형우
layout: post
permalink: /archives/12672
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12672-wp-permission-scheme.md
categories:
  - WordPress
  - 서버단
tags:
  - WordPress Tip
---
[역자 주] 이 글은 워드프레스 공식 문서의 &#8216;Changing File Permission&#8217; 중 [&#8216;워드프레스 퍼미션 설정(Permission Scheme for WordPress)&#8217;][1] 부분을 번역한 것이다. 그동안 대충 써 왔는데 상세하게 알고 싶어서 번역했다. 그런데 다 번역해 놓고 보니 뭔가 충분한 해답이 되진 않는다. 문서는 2014년 2월 27일 기준이다.

퍼미션은 호스트에 따라 다르다. 따라서 이 안내서는 일반적인 경우에 대해서만 자세히 설명한 것이다. 이 문서는 모든 경우에 대한 것이 아니다. 이것은 표준적으로 설정돼 돌아가는 서버에만 적용할 수 있는 가이드다(알림. &#8220;suexec&#8221; 메서드를 사용하는 공유 호스팅에 대해서는 뒤쪽을 보세요).

[역자 주 - 공유 호스팅은 돈 내고 서버의 일정 공간을 얻어서 사용하는 호스팅을 말한다. 대부분의 호스팅이 이렇다고 보면 된다. IDC에 직접 서버를 갖다 놓는 서버 호스팅이나 가상 서버를 만들어서 호스팅받는 아마존 모델 같은 것은 공유 호스팅이 아니다. 물론 그 서버를 공유 호스팅으로 만들면 또 그게 공유 호스팅이 되겠지만 말이다.]

일반적으로 모든 파일은 웹 서버의 사용자 (ftp) 계정 소유여야 한다. 그리고 그 계정에만 쓰기 권한이 있어야 한다. 공유 호스팅에서 파일은 절대로 웹서버 프로세스 자신의 소유여선 안 된다(때로 이 계정의 이름은 **www**나, **apache**, 아니면 **nobody**다). [역자 주 - 맥에선 daemon이다.]

워드프레스에서 쓰기 권한이 있어야 하는 모든 파일은 워드프레스가 사용하는 사용자 계정의 소유거나 사용자 그룹의 소유여야 한다(이 계정은 어쩌면 서버 계정과는 다를 수도 있다). 예컨대, FTP에서 파일을 넣고 빼고 하는 사용자 계정이 있을 수 있다. 하지만 서버 자체는 **dhapache**나 **nobody** 같은 다른 사용자나 사용자 그룹을 이용해서 돌아가고 있을 수도 있다. 만약 워드프레스가 FTP 계정을 이용해서 돌아가고 있다면, 그 계정에 쓰기 권한이 있어야 한다. 예를 들면, 파일을 소유하고 있거나, 쓰기 권한이 있는 그룹에 포함돼 있어야 한다. 뒤의 경우는 기본 설정보다 좀더 관대한 퍼미션이어야 한다는 것을 의미한다(예컨대, 폴더는 755가 아니라 775, 나머지는 644가 아니라 664).

워드프레스의 파일과 폴더 퍼미션은 설치 시점에 자신이 고른 설치 종류와 설치 시점의 시스템 환경 설정에 따른 umask에 따라 대부분의 사용자들에게 같아야 한다.

* * *

**알림:** 만약 워드프레스를 스스로 설치했다면, 파일 퍼미션을 변경할 필요가 없을 것이다. 퍼미션 에러로 문제를 경험하거나, **스스로 원하는** 게 아니라면, 아마 퍼미션 때문에 골치를 썩고 싶진 않을 거다.

* * *

일반적으로 워드프레스의 모든 코어 파일은 사용자 계정만 쓰기 권한이 있어야 한다(아니면 다른 경우엔 httpd 계정만). (그렇지만 때때로 설치할 때 다중 ftp 계정을 사용하기도 하는데, 그런 경우 모든 ftp 계정을 알고 있고 신뢰할 만하다면, 예컨대, 공유 호스팅이 아니라면, 그러면 그룹 쓰기 권한을 주는 것만으로 충분할 수 있다. 더 자세한 내용은 서버 관리자에게 문의하라.) 그러나 만약 mod&#95;rewrite 고유주소나 다른 `.htaccess` 기능을 활용한다면, 워드프레스가 `.htaccess` 파일 쓰기 권한을 갖도록 해야 한다.

내장 테마 에디터를 사용하고 싶다면, 모든 파일은 그룹 쓰기 권한이 있어야 한다. 파일 퍼미션을 수정하기 전에 사용해 봐라. 작동해야 한다. (다른 사용자가 워드프레스 패키지와 플러그인 또는 테마를 업로드한 경우에도 그렇다. 관리자가 플러그인이나 테마를 설치한 경우엔 문제가 되지 않는다. 다른 ftp 사용자 그룹이 파일을 올린 경우엔 쓰기 권한이 있어야 한다. 공유 호스팅에선, 신뢰할 수 있는 사용자만 그룹에 넣어야 한다. `apache`라는 사용자는 이 그룹에 들어가선 안 되고, 파일을 소유하고 있어도 안 된다.)

[역자 주 - 내장 테마 에디터를 모든 ftp 사용자가 사용할 수 있게 해야 하려면 파일에 그룹 쓰기 권한을 줘야 한다는 이야기 같은데... 워드프레스 멀티사이트를 염두에 둔 말인가? 왜 이런 내용이 있는지 잘 모르겠다.]

몇몇 플러그인은 `/wp-content/` 폴더 쓰기 권한이 있어야 한다. 하지만 이런 경우 설치할 때 알려 줄 거다. 몇몇 경우에, 이것은 755 퍼미션 할당이 필요하다는 것을 의미한다. `/wp-content/cache/`와 아마 `/wp-content/uploads/` 폴더도 마찬가지일 것이다. (만약 [멀티사이트][2]를 사용하고 있다면, `/wp-content/blogs.dir/`도 그렇게 해야 할 거다.)

어떤 플러그인이나 테마가 `/wp-content/` 폴더 아래쪽에 디렉토리가 필요하다면 문서화돼 있어야 한다. 퍼미션은 다양할 것이다.

    /   
    |- index.php
    |- wp-admin
    |   `- wp-admin.css
    |- wp-blog-header.php
    |- wp-comments-post.php
    |- wp-commentsrss2.php
    |- wp-config.php
    |- wp-content
    |   |- cache
    |   |- plugins
    |   |- themes
    |   `- uploads
    |- wp-cron.php
    |- wp-includes
    `- xmlrpc.php
    

## suexec를 사용하는 공유 호스팅(Shared Hosting with suexec)

위 설명은 실행중인 PHP 바이너리에 대해 &#8220;suexec&#8221; 접근을 사용하는 공유 호스팅 시스템에는 적용되지 않을 것이다. 이것은 많은 웹 호스트가 사용하는 흔한 접근법이다. 이 시스템들의 경우엔, php 프로세스에 php 파일 소유권이 있다. 이런 방식은 특정 공유 호스팅의 경우에 더 간편한 설정과 더 나은 보안을 제공한다.

* * *

알림: suexec 망식은 독립사이트 서버 설정에 사용하면 안 된다. 이 방식은 **오직** 공유 호스팅의 특정 경우에만 더 나은 보안을 제공한다.

* * *

그런 suexec 설정의 경우에, 올바른 퍼미션 설정은 간단하다.

*   모든 파일은 실제 사용자 계정이 소유해야 한다. httpd 프로세스를 사용하는 계정이 소유하면 안 된다.
*   웹서버 프로세스 퍼미션 체크를 위한 특정 그룹 권한이 있는 경우가 아니라면 그룹 소유권은 부적절하다. 이건 일반적인 경우는 아니다. &#91;역자 주 &#8211; 뭔 말임. 원문은 각주에.&#93; <a class="simple-footnote" title="Group ownership is irrelevant, unless there&#8217;s specific group requirements for the web-server process permissions checking. This is not usually the case." id="return-note-12672-1" href="#note-12672-1"><sup>1</sup></a>
*   모든 디렉토리들은 755 혹은 750 퍼미션이야 한다.
*   모든 파일은 644나 640 퍼미션이어야 한다. 예외: `wp-config.php`는 600이어야 한다. 서버의 다른 사용자가 읽지 못하게 해야 한다.
*   업로드 디렉토리를 포함해서 777을 줘야 하는 디렉토리는 없다. php 프로세스가 파일을 소유하고 있기 때문에, 755 디렉토리에도 소유자 권한으로 쓸 수 있다.

이 특정한 설정에서, 워드프레스는 완전한 소유권으로 직접 파일을 생성할 수 있다는 것을 감지할 것이다. 그러면 업그레이드할 때나 플러그인을 설치할 때 FTP 인증 정보를 묻지 않을 것이다.

<div class="simple-footnotes">
  <p class="notes">
    Notes:
  </p>
  
  <ol>
    <li id="note-12672-1">
      Group ownership is irrelevant, unless there&#8217;s specific group requirements for the web-server process permissions checking. This is not usually the case. <a href="#return-note-12672-1">&#8617;</a>
    </li>
  </ol>
</div>

 [1]: http://codex.wordpress.org/Changing_File_Permissions#Permission_Scheme_for_WordPress
 [2]: http://codex.wordpress.org/MultiSite "MultiSite"