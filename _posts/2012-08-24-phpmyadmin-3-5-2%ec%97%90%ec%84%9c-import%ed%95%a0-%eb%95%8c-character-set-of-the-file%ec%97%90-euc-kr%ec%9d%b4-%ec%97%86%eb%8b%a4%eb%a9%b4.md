---
title: phpMyAdmin 3.5.2에서 import할 때 Character set of the file에 euc-kr이 없다면
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/3162
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36573043
categories:
  - 서버단
tags:
  - PHP
---
요약 : `phpMyAdmin/libraries/config.default.php` 파일을 열어서 `$cfg['AvailableCharsets']` 배열에 &#8216;`euc-kr`&#8216;을 추가해 준다.

`phpMyAdmin 3.5.2`를 사용하고 있다. 정말 깔쌈하다. 그런데 `euc-kr`로 된 sql 백업 파일을 임포트하려고 하니까 에러가 났다. 살펴 보니 Character set of the file을 `euc-kr`로 선택해 줘야 에러가 안 나지 싶었다. 마이그레이션할 디비는 당연히 `utf-8`을 사용하고 있었기 때문이다.

그런데 황당, Character set of the file 항목에 `euc-kr`이 없는 거다. `cp949`도 없고.

<div style="width: 588px" class="wp-caption aligncenter">
  <img src="http://dl.dropbox.com/u/15546257/blog/mytory/phpmyadmin3.5.2-import-encoding.png" alt="" width="578" height="233" /><p class="wp-caption-text">
    이 셀렉트 박스 목록에 <code>euc-kr</code>이 없었다.
  </p>
</div>

어차피 `phpMyAdmin`도 내부에선 `iconv` 같은 `PHP` 함수를 사용할 테니 문제될 거 없겠다 싶어서 셀렉트 메뉴만 고칠 요량으로 코어 파일들을 찾아 봤다. 몇 번 삽질 끝에 `phpMyAdmin/libraries/config.default.php` 파일에 임포트할 때의 문자 인코딩 목록이 들어있다는 걸 알게 됐다.

파일을 열고 `euc-jp`로 검색을 했다. `euc-jp`는 항목에 있었기 때문이다. 보니까 역시 배열로 들어가 있다. 보니까 배열 변수명은 `$cfg['AvailableCharsets']` 다. 배열 항목에 `euc-kr`을 추가해 줬다. 그러니까 잘 들어간다. 끝!