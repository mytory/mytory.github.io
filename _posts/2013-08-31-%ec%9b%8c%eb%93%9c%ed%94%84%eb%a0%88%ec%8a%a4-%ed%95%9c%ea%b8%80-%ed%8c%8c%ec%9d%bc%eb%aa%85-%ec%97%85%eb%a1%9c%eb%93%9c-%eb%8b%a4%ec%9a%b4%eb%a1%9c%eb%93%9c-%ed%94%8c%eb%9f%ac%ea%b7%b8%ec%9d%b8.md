---
title: 워드프레스 한글 첨부 파일명 플러그인 wordpress uploading downloading non-latin filename
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/3309
categories:
  - WordPress
tags:
  - My WordPress Plugin
---
[2015-08-06 추가: 1.1.3 버전. IE9 이상 지원.]

[2013-09-01 추가: 1.1.2 버전. 이미지 링크의 경우엔 다운로드를 하지 않도록 했다.]

[2013-08-31 추가 : 1.1.1버전이 나왔다. 이 버전은 큰 개선을 두 가지 했다.

*   **플러그인을 삭제해도 문제가 되지 않는다.** 단, 1.1.1 버전 이전의 다운로드 링크는 여전히 플러그인을 지우면 문제가 된다. 1.1.1 버전 이후 다운로드 링크만 괜찮다.
*   파일명이 영어인 경우엔 파일명을 변환하지 않는다.

2013-08-31 추가 종료.]

[2012-10-14 추가 : [워드프레스 공식 플러그인 사이트에서 찾을 수 있다.][1]]

[2012-10-13 추가 : 파이어폭스에서 다운로드할 때 한글 파일명이 깨지던 것을 수정했다. 플러그인명도 uploading downloading non-latin filename 으로 변경했다. ver 1.0.2]

워드프레스는 다 좋은데, 본격 사용하게 되면 가장 골때리는 게 파일명이 한글일 때 업로드가 안 되는 거다. 워드프레스가 비알파벳 업로드를 지원하지 않기 때문인 것 같다. 사실 이게 합리적인 면이 있다. 알파벳이 아닌 경우 서버의 인코딩 설정에 따라 골치아픈 일이 많이 발생하기 때문이다. 그러나 일반인들이 사용하게 되면 이게 가장 걸림돌이 된다고 생각한다.

그래서 플러그인을 만들었다. 플러그인 이름은 uploading downloading non-latin filename 이다. 단지 한글 파일명만 작동하게 하는 게 아니라 다국어를 모두 작동하게 하기 때문에 좀더 포괄적인 이름을 사용했다.

아래는 시연 동영상이다.

<div class="video-container">
  <div class="video-container__inner">
  <iframe width="420" height="315" src="https://www.youtube.com/embed/QMl9bbiZrWQ" frameborder="0" allowfullscreen></iframe>
  </div>
</div>

## 이 플러그인의 장점

이 플러그인의 장점은 아래와 같다.

* 나중에 플러그인을 삭제해도 아무 문제가 생기지 않는다.
* 영문 파일명은 굳이 변환하지 않는다.
*   파일명이 알파벳이 아닐 때도 업로드가 잘 된다.
*   파일을 다운로드할 때 원래 파일명(정확히는 워드프레스에 업로드한 파일의 제목)으로 다운로드한다. (공백은 -로 바꿔서 다운로드한다. 워드프레스의 `sanitize_file_name` 함수를 약간 바꿔서 사용.)
*   bbPress용 플러그인인 [GD bbPress Attachments][2]도 지원한다. (js로 파일명 나오게 처리)
*   파일명을 미디어 라이브러리 제목으로 넣어 준다.

## 이 플러그인의 단점

단점도 있으니 잘 살펴보고 사용하기 바란다. 그런데 버전 1.1부터는 결정적인 단점이던 플러그인 의존성(플러그인을 제거하면 다운로드 링크게 깨지던 문제)이 사라졌기 때문에, 나는 무조건 설치를 권하겠다. ㅋ

*   파일명을 숫자로 바꿔서 서버에 저장한다는 거다. 숫자는 날짜와 시간이다. (에를 들면, 20120930_181522.zip, 파일명이 영어인 경우엔 그렇지 않으니 숫자로 저장하고 싶지 않다면 파일명을 영어로 변경해서 올리면 된다.)
*   포스트에 이미지를 넣을 때 img 태그의 src에 들어가는 파일명은 서버에 있는 파일명이지 원본 파일명이 아니다. (역시 파일명이 영어인 경우엔 해당 없음이다.)

## 지원, 라이센스

내가 개발자로 사는 이상은 이 플러그인을 계속 업데이트할 거다. 문제가 있는 경우 이메일 주시거나 [워드프레스 플러그인 지원 게시판](https://wordpress.org/support/plugin/uploadingdownloading-non-latin-filename)에 남겨 주시면 된다. 라이센스는 워드프레스와 같은 [GPLv2][3]다.

## 기타

*   플러그인은 현재 워드프레스 플러그인 사이트에서 찾을 수 있다 : [플러그인 다운로드][1] (물론 설치는 그냥 관리자 페이지에서 검색해서 설치 버튼을 누르는 게 편할 거다. non latin으로 검색하라.)
*   [GitHub 프로젝트 페이지][4]

 [1]: http://wordpress.org/extend/plugins/uploadingdownloading-non-latin-filename/
 [2]: http://wordpress.org/extend/plugins/gd-bbpress-attachments/
 [3]: http://www.gnu.org/licenses/gpl-2.0.html
 [4]: https://github.com/mytory/uploadingdownloading-non-latin-filename