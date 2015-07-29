---
title: 'Dropbox, GitHub와 연동하는 WordPress Markdown Plugin &#8211; Mytory Markdown'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/12276
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/page-mytory-markdown.md
categories:
  - WordPress
tags:
  - My WordPress Plugin
---
그냥 시작부터 문의 안내와 기타부터 ㅋ

## 기타, 제안과 문의

*   제안과 문의는 아래 댓글을 남겨 주시거나, mytory골뱅이gmail.com으로 보내 주세요.
*   [워드프레스 플러그인 사이트에서 추천해 주세요.][1] 굳이 영어로 리뷰를 쓰지 않고 한글로 쓰셔도 아무 상관 없어요.
*   [후원도 환영합니다. 근데 PayPal만 됨;;][2]

## 소개 영상

<div class="video-container">
  <div class="video-container__inner">
  <iframe width="560" height="315" src="https://www.youtube.com/embed/mCgzB1aCQgM" frameborder="0" allowfullscreen></iframe>
  </div>
</div>

## 만든 이유

마크다운으로 블로그 글을 쓰고 싶었다. 주요한 이유는 `code`랑 `pre` 태그를 쓰기가 너무 불편해서였다. 여긴 개발자 블로그니까. 그리고 워드프레스 관리자 페이지에서 글을 쓰는 것도 별로 맘에 들지 않았다. 글을 쓸 때는 글에만 집중하고 싶은데 워드프레스 관리자 페이지는 너무 무겁다. 버벅대는 느낌이 싫었다. 에디터에서 글을 쓰면 바로 워드프레스로 들어가게 하고 싶었다. 물론 그렇게 할 수 있는 툴들이 있는 것을 알고 있지만, 그 툴들이 생성하는 지저분한 HTML도 싫었다. 까탈스럽다.

이런 기준에 따르면 기존에 나와 있는 워드프레스 마크다운 플러그인들은 모두 맘에 안 들었다. 기본적으로 다 워드프레스 관리자 페이지의 에디터를 이용하도록 돼 있었기 때문이다. 그래서 그냥 만들기로 했다. 아이디어를 얻은 것은 마크다운 포맷을 이용하는 다른 블로그 플랫폼들이었다. [Jekyll][3] 같은 툴은 그냥 마크다운 파일을 올리면 그게 블로그 글이 된다. 즉, 자기 컴퓨터에서 마크다운으로 글을 쓰고, 업로드만 하면 끝인 거다. 나도 그런 걸 사용하고 싶었다.

## 기능

그래서 만든 [Mytory Markdown][4]의 기능은 다음과 같다. 설치하려면 플러그인 설치하는 데서 Mytory Markdown으로 검색하면 된다.

* 드롭박스 Public 폴더에 있는 마크다운 파일과 포스트 내용을 동기화한다.
* GitHub에 있는 마크다운 파일과 포스트 내용을 동기화한다.

이게 끝이다. 딴 거 없다. 마크다운 파일로 글 다 쓴 다음 드롭박스의 &#8216;공개 링크&#8217;나 GitHub 'Raw' 버튼의 URL을 복사해서 &#8216;Markdown File Path&#8217;에 붙여 넣고 &#8216;Update Editor Content&#8217; 누른 다음 저장하면 된다. 사실 &#8216;Update Editor Content&#8217; 버튼도 안 눌러도 된다. 어차피 글 보기할 때마다 파일 검사해서 내용 갱신하니까.

## 사용법

*   자기 컴퓨터의 드롭박스 Public Folder에서 파일을 편집하고 &#8216;공개 링크&#8217;를 복사한다. 
*   2012년 12월 이후 가입자들은 Public 폴더가 없을 거다. 무료 사용자라면 Public 폴더를 사용할 길이 없다. GitHub를 사용해야 한다. Pro나 Bussiness 사용자라면 여기서 활성화할 수 있다 : [Enable public folder][5]
*   플러그인을 활성화한 뒤 글쓰기 화면에 들어가면 Markdown File Path라는 항목이 보일 거다. 거기에 공개 링크 혹은 Raw URL을 집어넣는다(사실 드롭박스나 GitHub가 아니라도 마크다운 파일로 연결되는 URL이면 웬만하면 다 될 거다).
*   붙여 넣은 뒤 &#8216;Update Editor Content&#8217; 버튼을 누르면 마크다운 파일의 내용이 HTML로 변환돼서 워드프레스 에디터에 들어간다. `h1` 요소가 있다면 첫 번째 `h1` 요소를 제목에 집어넣는다.
*   이후엔 마크다운 파일만 수정하면 컨텐츠도 자동으로 업데이트된다.

## 설정

설정도 있다. **설정 > Mytory Markdown**에 가면 설정할 수 있다.

*   Auto update only when writer (or admin) visits : 이걸 y로 설정하면 글쓴이나 관리자로 로그인해서 해당 포스트(혹은 페이지)에 방문했을 때만 자동 업데이트를 한다. 난 지금 이 모드로 쓰고 있다. 그러면 글을 수정한 다음 수정한 페이지를 한 번 로그인한 채로 방문해 줘야 글이 갱신된다. 난 글 수정한 다음 블로그에 가서 꼭 확인을 하니까 크게 불편함이 없다.
*   Auto update per x visits : x회 방문마다 자동갱신을 한다. 기본값은 1이다. 즉, 기본적으로는 매 방문마다 Dropbox에 접속해서 내용이 달라지지 않았는지 검사한다. 이걸 10으로 설정한다면 해당 글을 10회 방문할 때마다 1번씩 Dropbox에 접속해서 내용이 달라졌는지 확인하게 된다. 만약 관리자로 들어올 때만 자동갱신하는 위 옵션을 y로 했다면 이 숫자는 무의미하다.

## 장점

장점은 [&#8216;Mytory Markdown 플러그인과 드롭박스 퍼블릭 링크를 이용해서 워드프레스에 포스팅하기&#8217;][6]에 잘 소개돼 있다.

*   자기가 좋아하는 에디터로 글을 작성할 수 있다.
*   컴퓨터 파일을 수정하면 글이 자동으로 동기화되므로 관리자 페이지로 가는 불편 없이 편안하게 글을 수정할 수 있다.
*   마크다운을 HTML로 변환해서 에디터에 넣어 주는 기능만 하는 것이기 때문에 여타 다른 플러그인들과 충돌할 일이 없다. 대표적인 게 short tag인데, 전혀 충돌하지 않는다.
*   위와 같은 이유로, 플러그인을 제거해도 아무 문제가 생기지 않는다.
*   실수로 파일을 삭제해도 아무 문제 없다. DB에 내용이 들어가 있기 때문이다. (단, 파일은 살아있는 채로 내용만 날리면 문제가 생긴다. 물론, 워드프레스에 글 history가 기록돼 있으므로 금세 복구할 수 있다.)
*   워드프레스 에디터 내용만 바꾸는 것이기 때문에 워드프레스 리비전 기능(글 history 기능)이 그대로 살아 있게 된다. 
*   실수로 웹사이트가 날아가도 자기 컴에 md 파일이 다 남아 있기 때문에 핵심 콘텐츠인 글은 다 살아있게 된다.

## 기타, 제안과 문의

*   제안과 문의는 아래 댓글을 남겨 주시거나, mytory골뱅이gmail.com으로 보내 주세요.
*   [워드프레스 플러그인 사이트에서 추천해 주세요.][1] 굳이 영어로 리뷰를 쓰지 않고 한글로 쓰셔도 아무 상관 없어요.
*   [후원도 환영합니다. 근데 PayPal만 됨;;][2]

 [1]: http://wordpress.org/support/view/plugin-reviews/mytory-markdown
 [2]: http://mytory.net/paypal-donation
 [3]: http://jekyllrb.com/
 [4]: http://wordpress.org/plugins/mytory-markdown/
 [5]: https://www.dropbox.com/enable_public_folder
 [6]: http://blog.kalkin7.com/2014/01/04/mytory-markdown-plugin-using-dropbox-public-link/