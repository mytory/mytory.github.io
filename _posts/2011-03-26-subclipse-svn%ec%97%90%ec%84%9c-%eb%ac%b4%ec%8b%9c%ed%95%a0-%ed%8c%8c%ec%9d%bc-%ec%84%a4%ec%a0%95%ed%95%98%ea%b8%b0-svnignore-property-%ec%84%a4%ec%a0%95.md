---
title: '[subclipse] svn에서 무시할 파일 설정하기 svn:ignore property 설정'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1015
aktt_notify_twitter:
  - yes
daumview_id:
  - 36760777
categories:
  - 개발 툴
tags:
  - SVN
---
개발을 하다 보면 굳이 svn에 들어갈 필요가 없는 것들이 있다.

자유게시판의 첨부파일이나, 사진 썸네일 캐시 같은 임시 파일들 말이다.

그런 경우 svn:ignore 설정으로 아예 svn이 무시하도록 설정할 수 있다.

그렇게 하지 않으면 매번 commit 할 때마다 revert를 해야 하니 좀 짜증난다.

분명히 [subversion 책][1]을 볼 때 무시할 파일을 지정할 수 있다고 했으니, 방법이 있을 거라 생각했다.

## 커맨드 라인으로 하는 방법

물론 커맨드 라인으로 하는 방법은 책을 보면 쉽게 답을 얻을 수 있다.

해당 폴더에서 원하는 파일을 지정해 주면 그만이다. 아래와 같은 커맨드 명령 라인으로 처리 가능하다.

<pre>svn propset svn:ignore target_folder_or_file</pre>

## 서브클립스에서 사용하는 방법은?

하지만 서브클립스를 사용하는 나로서는 다른 팀원들도 쉽게 사용할 수 있도록 subclipse에서 사용하는 방법을 알아야 했다.

모르는 게 있으면 검색을 하든 물어보든 해서 확실히 알아야 실제 프로젝트를 진행할 때 짜증과 불안이 덜 하다. 따라서 오늘, 시간이 나는 날이었으므로 검색을 해 봤다. 검색어는 간단했다 : subclipse ignore

몇 개가 걸렸고, 몇 차례 추가 검색을 통해 쉽게 결과물을 얻을 수 있었다.

자, 일단 아래와 같은 폴더들이 있다고 하자. 이클립스를 사용하는 분들은 금세 알 수 있을 거다.

<div style="width: 510px" class="wp-caption aligncenter">
  <img class="  " title=" " src="/uploads/legacy/svn-ignore-folders.png" alt="" width="500" height="128" /><p class="wp-caption-text">
    위 폴더들 중 photo_thumbnail_cache 는 굳이 svn에 통합할 필요가 없는 놈이다.
  </p>
</div>

자자, 저 폴더의 모든 파일을 svn이 무시하도록 해 보자. 마우스 오른쪽 버튼을 누르고, **Team > Set Property** 를 선택한다.

<p style="text-align: center;">
  <img class="aligncenter" src="/uploads/legacy/svn-ignore-set-property.png" alt="" />
</p>

그러면 아래와 같은 화면이 뜨는데 property name 에는 svn:ignore 라고 써 주고,

<img class="aligncenter" src="/uploads/legacy/svn-ignore-setting.png" alt="" width="613" height="512" />Enter text property 항목에는 무시하길 원하는 파일을 써 주면 된다.

여러 개를 지정할 때는 아래처럼 줄을 바꿔서 써 주면 된다.

<p style="text-align: center;">
  <img class="aligncenter" src="/uploads/legacy/svn-ignore-multiple.png" alt="" width="613" height="512" />
</p>

일단, 나는 이 폴더의 모든 하위 폴더와 파일을 무시하게 할 것이므로 *를 썼다.

그렇게 하고, 일단 폴더 안의 모든 놈을 revert 한 후, 프로젝트 전체를 update 하고 thumbnail 캐시 몇 개를 생성해 봤는데 전혀 영향을 미치지 않았다. 나이스!

자자, 만약 특정 파일을 무시하게 만들고 싶다면 * 대신 filename.php 형식으로 써 주면 될 것이다. 난 이런 식으로 최상위 폴더에 property를 지정해서 .project 파일을 무시하게 만들었다. 내 컴의 프로젝트 세팅이 바뀔 때마다 팀원들 프로젝트 폴더에 영향을 미쳐서 짜증날 때쯤이었다.

이상이다.

[덧] 파일에는 svn:ignore 프로퍼티를 설정할 수 없는 듯하다. 그리고 subclipse를 통해 svn에 통합되지 않은 놈의 경우에는 **Team > Add to svn:ignore** 메뉴를 이용해 쉽게 무시하게 만들 수 있다. 문제는 이미 통합된 놈은 Add to svn:ignore 메뉴가 회색으로 비활성화돼 나온다는 점이다.

<div style="width: 522px" class="wp-caption aligncenter">
  <img class=" " src="/uploads/legacy/svn-ignore-add.jpg" alt="" width="512" height="474" /><p class="wp-caption-text">
    test 파일 왼쪽의 ?는 아직 이놈이 svn에 통합되지 않은 놈이라는 점을 말해 준다. 이런 경우 Add to svn:ignore 메뉴가 활성화돼 있다.
  </p>
</div>

 [1]: http://www.aladin.co.kr/shop/wproduct.aspx?ISBN=8956742995 "알리딘 책 소개 - 서브버전을 이용한 실용적인 버전관리"