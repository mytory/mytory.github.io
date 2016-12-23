---
title: 워드프레스 플러그인에 언어 파일을 등록하기
author: 안형우
layout: post
permalink: /archives/8528
daumview_id:
  - 36682900
categories:
  - WordPress
tags:
  - WordPress Tip
---
트위터를 블로그에 긁어서 모으는 플러그인을 만들었다. [번역용 텍스트를 뽑아냈다.][1] 그리고 한국어 언어 파일을 만들었다. 그런데 적용을 어떻게 하는지 헷갈렸다. [워드프레스의 플러그인 언어 파일 등록 함수 매뉴얼][2]뿐 아니라 다른 플러그인들이 한 걸 뜯어 보고 나서야 성공할 수 있었다.

경험적인 접근이었긴 하지만, 공유한다.

아래 코드는 플러그인 폴더 밑에 languages 라는 폴더를 만들고 거기에 언어 파일을 넣은 경우 코드다. 내 플러그인의 이름은 tweet collection이고 플러그인 폴더이름이 tweet-collection이다. 그리고 **텍스트 도메인을 플러그인의 폴더명과 맞춰 줘야 하는 것 같다.**

<pre class="brush: php; gutter: true">//언어 파일 등록
function tweet_collection_init() {
	load_plugin_textdomain( &#039;tweet-collection&#039;, false, dirname( plugin_basename( __FILE__ ) ) . &#039;/languages&#039; );
}
add_action(&#039;plugins_loaded&#039;, &#039;tweet_collection_init&#039;);</pre>

코드 설명을 하겠다.

`load_plugin_textdomain()` 함수는 현재 변수를 세 개 받는 걸로 돼 있는데, 두번째 변수는 deprecated다. 따라서 두 번째 변수는 false로 주고, 세 번째 변수만 사용하면 된다.

세 번째 변수는 지금 `dirname( plugin_basename( __FILE__ ) ) . '/languages'` 이렇게 들어가 있는데, `echo`를 해 보면 `tweet-collection/languages` 이렇게 나온다. 즉, 플러그인 폴더에서 언어 파일이 있는 폴더의 상대경로를 적어 주면 되는 거다. `languages` 폴더에 두지 않고 플러그인의 루트 폴더에 언어 파일을 두려면 뒤쪽에 써 놓은 `'languages'` 부분을 빼면 된다.

## 언어 파일의 파일명

그 다음으로 신경써야 할 것이 언어 파일의 파일명이다. 파일명은 아래와 같아야 한다.

<pre>{$textdomain}-{WPLANG}.po 그리고 {$textdomain}-{WPLANG}.mo</pre>

그러니까 실제로 한국어 언어파일의 경우엔,

<pre>tweet-collection-ko_KR.po 그리고 tweet-collection-ko_KR.mo</pre>

이렇게 되는 거다.

이렇게 하니까 언어 파일이 적용되기 시작했다.

 [1]: http://mytory.net/archives/4912 "[워드프레스] 테마에서 Poedit로 번역할 문장 뽑아오는 방법"
 [2]: http://codex.wordpress.org/Function_Reference/load_plugin_textdomain