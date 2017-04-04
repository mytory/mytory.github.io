---
title: 'Github 같은 URL을 연결해 사용하는 WordPress Markdown Plugin – Mytory Markdown'
author: 안형우
layout: post
permalink: /archives/12276
categories:
  - WordPress
tags:
  - My WordPress Plugin
description: md 파일의 URL을 넣고 버튼을 누르면 에디터에 html을 넣어 주는 플러그인이다. 자매품 Mytory Markdown for Dropbox도 있다.
date_modified: 2017-04-04 13:45
image: /uploads/2017/mytory-markdown.jpg

---

## 제안과 버그 신고

*   [제안과 버그 신고](https://github.com/mytory/mytory-markdown/issues)
*   [워드프레스 플러그인 사이트에서 추천해 주세요.][1] 한글로 써도 됩니다.
*   [후원도 환영합니다.][2]

## Mytory Markdown for Dropbox

원래 이 플러그인은 Dropbox의 Public Link를 이용한 것이었다. Dropbox가 Public Link 기능을 중지하는 바람에 Dropbox로 이 플러그인을 사용할 수는 없게 됐고 일반적인 URL을 사용하는 것으로 변경했다. 

대신 Dropbox로 이용할 수 있도록 [Mytory Markdown for Dropbox]라는 플러그인을 새로 만들었다.

## 소개 영상

<div class="video-container">
  <div class="video-container__inner">
  <iframe width="560" height="315" src="https://www.youtube.com/embed/wKcrIvlGVfo" frameborder="0" allowfullscreen></iframe>
  </div>
</div>

## 만든 이유

마크다운으로 블로그 글을 쓰고 싶었다. 주요한 이유는 `code`랑 `pre` 태그를 쓰기가 너무 불편해서였다. 여긴 개발자 블로그니까. 그리고 워드프레스 관리자 페이지에서 글을 쓰는 것도 별로 맘에 들지 않았다. 글을 쓸 때는 글에만 집중하고 싶은데 워드프레스 관리자 페이지는 너무 무겁다. 버벅대는 느낌이 싫었다. 에디터에서 글을 쓰면 바로 워드프레스로 들어가게 하고 싶었다. 물론 그렇게 할 수 있는 툴들이 있는 것을 알고 있지만, 그 툴들이 생성하는 지저분한 HTML도 싫었다. 까탈스럽다.

이런 기준에 따르면 기존에 나와 있는 워드프레스 마크다운 플러그인들은 모두 맘에 안 들었다. 기본적으로 다 워드프레스 관리자 페이지의 에디터를 이용하도록 돼 있었기 때문이다. 그래서 그냥 만들기로 했다. 아이디어를 얻은 것은 마크다운 포맷을 이용하는 다른 블로그 플랫폼들이었다. [Jekyll][3] 같은 툴은 그냥 마크다운 파일을 올리면 그게 블로그 글이 된다. 즉, 자기 컴퓨터에서 마크다운으로 글을 쓰고, 업로드만 하면 끝인 거다. 나도 그런 걸 사용하고 싶었다.

## 기능

그래서 만든 [Mytory Markdown][4]의 기능은 다음과 같다. 설치하려면 플러그인 설치하는 데서 Mytory Markdown으로 검색하면 된다.

* md 파일의 URL을 받아서 포스트 내용을 동기화한다.
* 즉, GitHub raw content url 같은 것을 이용할 수 있다.

이게 끝이다. 딴 거 없다. 마크다운 파일로 글 다 쓴 다음 해당 파일의 URL이나 GitHub ‘Raw’ 버튼의 URL을 복사해서 ‘Markdown File Path’에 붙여 넣고 ‘Update Editor Content’ 누른 다음 저장하면 된다. 사실 ‘Update Editor Content’ 버튼도 안 눌러도 된다. 어차피 글 보기할 때마다 파일 검사해서 내용을 갱신한다.

## 사용법

- 플러그인을 활성화한 뒤 글쓰기 화면에 들어가면 Markdown File Path라는 항목이 보일 거다. 거기에 md 파일의 URL을  집어넣는다. GitHub를 이용하려면 Raw URL을 넣으면 된다. 
- 붙여 넣은 뒤 ‘Update Editor Content’ 버튼을 누르면 마크다운 파일의 내용이 HTML로 변환돼서 워드프레스 에디터에 들어간다. `h1` 요소가 있다면 첫 번째 `h1` 요소를 제목에 집어넣는다.
- 이후엔 마크다운 파일만 수정하면 컨텐츠도 자동으로 업데이트된다.

## 설정

설정도 있다. **설정 > Mytory Markdown**에 가면 설정할 수 있다.

*   Auto update only when writer (or admin) visits : 이걸 y로 설정하면 글쓴이나 관리자로 로그인해서 해당 포스트(혹은 페이지)에 방문했을 때만 자동 업데이트를 한다. 난 지금 이 모드로 쓰고 있다. 그러면 글을 수정한 다음 수정한 페이지를 한 번 로그인한 채로 방문해 줘야 글이 갱신된다. 난 글 수정한 다음 블로그에 가서 꼭 확인을 하니까 크게 불편함이 없다.
*   Auto update per x visits : x회 방문마다 자동갱신을 한다. 기본값은 1이다. 즉, 기본적으로는 매 방문마다 Dropbox에 접속해서 내용이 달라지지 않았는지 검사한다. 이걸 10으로 설정한다면 해당 글을 10회 방문할 때마다 1번씩 Dropbox에 접속해서 내용이 달라졌는지 확인하게 된다. 만약 관리자로 들어올 때만 자동갱신하는 위 옵션을 y로 했다면 이 숫자는 무의미하다.

## 장점

*   자기가 좋아하는 에디터로 글을 작성할 수 있다.
*   컴퓨터 파일을 수정하면 글이 자동으로 동기화되므로 관리자 페이지로 가는 불편 없이 편안하게 글을 수정할 수 있다.
*   마크다운을 HTML로 변환해서 에디터에 넣어 주는 기능만 하는 것이기 때문에 여타 다른 플러그인들과 충돌할 일이 없다. 대표적인 게 short tag인데, 전혀 충돌하지 않는다.
*   위와 같은 이유로, 플러그인을 제거해도 아무 문제가 생기지 않는다.
*   실수로 파일을 삭제해도 아무 문제 없다. DB에 내용이 들어가 있기 때문이다. (단, 파일은 살아있는 채로 내용만 날리면 문제가 생긴다. 물론, 워드프레스에 글 history가 기록돼 있으므로 금세 복구할 수 있다.)
*   워드프레스 에디터 내용만 바꾸는 것이기 때문에 워드프레스 리비전 기능(글 history 기능)이 그대로 살아 있게 된다. 
*   실수로 웹사이트가 날아가도 자기 컴에 md 파일이 다 남아 있기 때문에 핵심 콘텐츠인 글은 다 살아있게 된다.

## 사실 지금 난 jekyll을 사용하긴 하는데

난 블로그 트래픽 문제로 [jekyll을 사용하는 GitHub Page로 블로그를 옮겼다.](https://mytory.net/기타/2014/11/04/move-to-jekyll.html) 하지만 이 플러그인도 100명 정도는 사용하고 있어서 계속 개발중이다. [Mytory Markdown for Dropbox]로 그래서 만들었고 말이다.

 [1]: http://wordpress.org/support/view/plugin-reviews/mytory-markdown
 [2]: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=QUWVEWJ3N7M4W&lc=GA&item_name=Mytory%20Markdown&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
 [3]: http://jekyllrb.com/
 [4]: http://wordpress.org/plugins/mytory-markdown/
 [5]: https://www.dropbox.com/enable_public_folder
 [6]: http://blog.kalkin7.com/2014/01/04/mytory-markdown-plugin-using-dropbox-public-link/
 [Mytory Markdown for Dropbox]: https://mytory.net/2017/03/27/mytory-markdown-for-dropbox.html