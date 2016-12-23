---
title: '[번역] bbPress 한글 언어 파일 설치하기'
author: 안형우
layout: post
permalink: /archives/3245
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36560592
categories:
  - WordPress
tags:
  - WordPress Tip
---
이 글은[ bbPress in Your Language][1]를 번역한 것이다. bbPress는 워드프레스에 게시판 기능을 추가해 주는 플러그인이다. 물론 게시판의 타입은 한국형 게시판이 아니라 해외에서 많이 사용하는 포럼형 게시판이다. 그러나 UI를 약간 변경하면 한국형 게시판과 유사하게 만들 수 있을 것이라고 생각한다.

&#8212;&#8212;

워드프레스처럼, bbPress는 어떤 언어로든 번역할 수 있다. 아래 설명에서는, 워드프레스의 언어가 이미 [WordPress in Your Language][2]에서 설명한대로 <tt>wp-config.php</tt> 파일에 있는 `define ('WPLANG', 'ko_KR');` 같은 식으로 이미 설정돼 있다고 상정한다. 만약 아직 설정하지 않았다면 [Installing WordPress in Your Language][3]를 보고 설정부터 하라.

## 언어 파일은 어디서 받나

<http://translate.wordpress.org/projects/bbpress/2.2.x>에 간다. (아니면 [개발 중인 버전][4]으로 간다.)

언어를 고른다. [브라질 포르투갈어를 예로 들고 있지만, 한국어로 바꿔서 번역하겠다. - 형우] 예컨대, [korean][5].

[맨 아래 셀렉트 박스를] &#8216;`all current`&#8216; as &#8216;`.po`&#8216;로 맞추고, &#8216;`export`&#8216;를 누른다. 파일을 내려받았다면, &#8216;`all current`&#8216; as &#8216;`.mo`&#8216;로 다시 맞추고 또 &#8216;`export`&#8216;를 누른다.

## 언어 파일 사용법

각 파일의 이름을 `bbpress-language_COUNTRY.extension` 형식으로 바꾼다.

예컨대, `bbpress-plugin-ko.po`는 `bbpress-ko_KR.po`로,  
`bbpress-plugin-ko.mo`는 `bbpress-ko_KR.mo`로.

FTP로 `.po`와 `.mo` 파일을 모두 `/wp-content/languages/bbpress/` 폴더에 업로드한다. 만약 `/wp-content/languages/bbpress/` 폴더가 없으면 만든다.

## 필요한 언어 파일이 없다면?

목록에 필요한 언어가 없다면, bbPress 번역을 만들어 보는 건 어떨까? 시작하려면 [Translating WordPress][6]를 봐라. 그리고 [WordPress Polyglots][7] 블로그에 질문을 남겨라.

 [1]: http://codex.bbpress.org/bbpress-in-your-language/
 [2]: http://codex.wordpress.org/WordPress_in_Your_Language
 [3]: http://codex.wordpress.org/Installing_WordPress_in_Your_Language
 [4]: http://translate.wordpress.org/projects/bbpress/dev
 [5]: http://translate.wordpress.org/projects/bbpress/plugin/ko/default
 [6]: http://codex.wordpress.org/Translating_WordPress "Translating WordPress"
 [7]: http://make.wordpress.org/polyglots/