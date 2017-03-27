---
title: Twenty Eleven 테마(유동형 레이아웃, 1단 가능)로 블로그 스킨 변경한 후 커스터마이징 했습니다
author: 안형우
layout: post
permalink: /archives/2159
aktt_notify_twitter:
  - yes
daumview_id:
  - 36642767
categories:
  - WordPress
tags:
  - WordPress Tip
---
[2013-10-19 추가] 2012년 2월의 테마 변경 이후 2013년 9월에 다시 테마를 변경했다. 관련글은 [&#8216;블로그 리뉴얼 – 마법 나무 테마&#8217;][1]다.

&#8212;&#8212;

블로그 스킨을 변경했습니다.

심플한 걸 추구하기 때문에 사용하지 않을 줄 알았는데 워드프레스 기본 테마의 최신 버전인 [Twenty Eleven 테마][2]를 선택했습니다.

선택의 이유는 단 하나였습니다. 이게 유동형 레이아웃(fluid layout : [반응형][3] 웹디자인의 한 요소)이더라고요.

그리고 제 취향에 맞게 1단형으로 설정을 할 수 있다는 걸 최근에야 알게 됐습니다. 저는 사이드바가 없는 걸 좋아하거든요. 그래야 읽는 맛이 나죠. 본문 읽을 때 사이드바가 옆에 있으면 걸리적거려요. (**테마 디자인 > Theme Options > Default Layout**)

예전 hybrid 테마는 반응형도 유동형도 아니었습니다. 그래서 모바일로 들어오는 경우에는 글자 크기만 좀 키워주는 수준으로 제가 커스터마이징해 뒀더랬습니다.

이제는 유동형 레이아웃이니 크게 신경쓰지 않아도 모바일에서 레이아웃이 깔끔하게 나옵니다. 맨 아래 부분이 가장 맘에 들어요. 데스크탑에선 3단인데, 모바일로 들어오면 1단으로 변하거든요.

## 커스터마이징1 &#8211; 최상단 이미지 제거

가장 먼저 한 것은 최상단에 나오는 이미지를 제거해 버린 것입니다. 저는 설치형 블로그를 사용하고 있고, 큰 이미지는 트래픽을 잡아먹으니까요.

header.php 의 82번째 줄을 주석처리하고, 빈 값으로 바꿔치기해 주면 됩니다.

<pre class="brush: php; gutter: true; first-line: 82">//$header_image = get_header_image();
$header_image = &#039;&#039;;</pre>

## 커스터마이징2 &#8211; 글씨 크기

그리고 모바일에서도 그렇고, 데스크탑에서도 그렇고 글씨 크기가 좀 작더라고요. 그래서 좀 키웠습니다. 사이즈에 % 단위를 사용했더라고요. 아마도 유동형이라? 여튼간에 그래서 규칙을 잘 따라 줬습니다.

style.css 의 26번 줄에 있는 글씨크기를 100%에서 103%로 키웠습니다.

<pre class="brush: css; gutter: true; first-line: 26">font-size: 103%;</pre>

<h2 class="brush: css; gutter: true; first-line: 26">
  커스터마이징3 &#8211; Better WordPress Minify 플러그인 설치
</h2>

<p class="brush: css; gutter: true; first-line: 26">
  이건 테마 커스터마이징은 아니지만, 여튼간에 테마를 바꾸니까 그 전에 압축 전송 설정을 해 놓은 게 풀리면서 오후 5시에 트래픽 초과가 됐습니다. 그래서 부랴부랴 압축 전송 플러그인을 설치했죠. 이놈은 설치만 하면 모든 걸 알아서 처리해 주더라고요.
</p>

<p class="brush: css; gutter: true; first-line: 26">
  다만, 또 다른 플러그인인 Syntax Highlighter MT에서 사용하는 js와 css는 압축을 못하길래 그건 그냥 cloud에서 가져다 사용하는 것으로 따로 커스터마이징했습니다.
</p>

<p class="brush: css; gutter: true; first-line: 26">
  stxhighlightmt.php 의 49번째 줄을 이렇게 변경하면 됩니다.
</p>

<pre class="brush: php; gutter: true; first-line: 49">$x = &#039;http://alexgorbatchev.com/pub/sh/current&#039;;</pre>

<p class="brush: php; gutter: true; first-line: 49">
  그러면 내 블로그에 있는 놈을 사용하지 않고 Code Syntax Highlight 3 에서 제공하는 클라우드에서 파일을 가져다 사용하게 됩니다.
</p>

<h2 class="brush: php; gutter: true; first-line: 49">
  커스터마이징4 &#8211; 웹폰트 사용
</h2>

<p class="brush: php; gutter: true; first-line: 49">
  웹폰트도 적용해 봤습니다. 인용문(blockquote)을 귀여운 글씨체인 <a href="http://api.mobilis.co.kr/webfonts/font_usage.html?fontface=HeummBlueSkyWeb">혜움블루스카이</a>로 해 봤습니다. 모빌리스 웹폰트 좋더군요.
</p>

> <p class="brush: php; gutter: true; first-line: 49">
>   인용문은 이렇게 귀여운 글씨체로 나옵니다. 모든 브라우저에서 가능합니다.
> </p>

<p class="brush: php; gutter: true; first-line: 49">
  그리고 인용문은 이탤릭 처리돼 있는데, 획수가 많은 한글은 이탤릭을 사용하면 가독성을 심각하게 해치므로 풀어 줬습니다.
</p>

<h2 class="brush: php; gutter: true; first-line: 49">
  커스터마이징5 &#8211; 너비 조정
</h2>

<p class="brush: php; gutter: true; first-line: 49">
  Twenty Eleven 테마를 1단으로 사용하니까 너비가 좀 좁더군요. 그냥 보긴 괜찮은데 코드를 보는 게 좀 많이 불편했습니다. 코드는 가로가 긴 경우들이 있으니까요. 그래서 너비를 200px 늘렸습니다.
</p>

<pre class="brush: css; gutter: true; first-line: 193">/* One column */
.one-column #page {
	max-width: 890px;
}</pre>

<p class="brush: php; gutter: true; first-line: 49">
  원래는 690px인데 890px로 늘렸습니다.
</p>

<h2 class="brush: php; gutter: true; first-line: 49">
  커스터마이징6 &#8211; 검색을 구글 검색으로 변경
</h2>

<p class="brush: php; gutter: true; first-line: 49">
  검색은 구글이 짱입니다. 원래는 구글 맞춤검색을 달아놨었는데 이번엔 그렇게 하지 않고, 그냥 검색을 하면 새 창을 띄우면서 구글에서 제 블로그를 검색하도록 했습니다. 그걸 위해서 searchform.php 를 통째로 변경했습니다.
</p>

<pre class="brush: html; gutter: true; first-line: 1">&lt;form method="get" id="searchform" action="http://www.google.co.kr/search" target="_blank"&gt;
	&lt;label for="s" class="assistive-text"&gt;&lt;?php _e( &#039;Search&#039;, &#039;twentyeleven&#039; ); ?&gt;&lt;/label&gt;
	&lt;input type="text" class="field" name="q" id="s" placeholder="&lt;?php esc_attr_e( &#039;검색&#039;, &#039;twentyeleven&#039; ); ?&gt;" /&gt;
	&lt;input type="submit" class="submit" name="submit" id="searchsubmit" value="&lt;?php esc_attr_e( &#039;Search&#039;, &#039;twentyeleven&#039; ); ?&gt;" /&gt;
	&lt;input type="hidden" name="sitesearch" value="mytory.net/archives/"&gt;
	&lt;input type="hidden" value="/author/ /tag/ /date/ /category/" name="as_eq"&gt;
	&lt;input type="hidden" value="blg" name="tbm"&gt;
&lt;/form&gt;</pre>

<p class="brush: php; gutter: true; first-line: 49">
  각종 hidden input 값들이 보이실 겁니다. 참고해서 하시면 구글 검색을 띄우면서 검색을 하실 수 있습니다.
</p>

<p class="brush: php; gutter: true; first-line: 49">
  블로그에서 제공하는 기본 검색은 위젯으로 하단에 달아 뒀죠.
</p>

<h2 class="brush: php; gutter: true; first-line: 49">
  커스터마이징7 &#8211; 메타 정보 한글화
</h2>

<p class="brush: php; gutter: true; first-line: 49">
  아무래도 영어보단 한글이 낫겠죠. 메타 정보들을 모두 한글화했습니다.
</p>

> <p class="brush: php; gutter: true; first-line: 49">
>   <strong>카테고리</strong> Google Analytics | <strong>태그</strong> 구글 아날리틱스 | 댓글쓰기
> </p>

<p class="brush: php; gutter: true; first-line: 49">
  제 블로그 첫 화면의 목록에 모이는 위 정보가 메타정보입니다. 원래는 영어로 돼 있어요.
</p>

<h2 class="brush: php; gutter: true; first-line: 49">
  커스터마이징8 &#8211; Frontpage Manager 한글 최적화
</h2>

<p class="brush: php; gutter: true; first-line: 49">
  이건 또 따로 쓸 생각인데, 여튼 Frontpage Manager 플러그인은 블로그 첫 화면을 최신글 목록으로 꾸며 주는 플러그인입니다. 그런데 이놈이 한글은 글자 수 자르는 것도 제대로 안 되고, &#8216;▶전문 보기&#8217;라고 더 보기 링크 텍스트를 넣어도 깨지기나 하고 골치가 좀 아팠습니다. 이번 기회에 다 수정을 봤죠.
</p>

<p class="brush: php; gutter: true; first-line: 49">
  일단 fp-manager.php의 192번째 줄을 주석처리하고, 한글을 처리할 수 있는 함수로 변경했습니다. (<a title="[PHP] 문자열 자르고 말줄임표 붙이는 함수" href="https://mytory.net/archives/1036">mb_strcut</a>을 사용했습니다.)
</p>

<pre class="brush: php; first-line: 192">//$final = FPManager::fix_html(substr($content, 0, $truncate), $ending);
$final = FPManager::fix_html(mb_strcut($content, 0, $truncate, &#039;utf-8&#039;), $ending);</pre>

<p class="brush: php; gutter: true; first-line: 192">
  이거 말고도 좀더 한 것 같은데 기억은 안 나네요;;
</p>

<h2 class="brush: php; gutter: true; first-line: 192">
  만족스런 결과
</h2>

그 결과 만족스런 블로그 디자인이 완성됐습니다. 앞으로도 디테일은 좀 고칠 테지만 한 1~2년은 이 테마로 가지 싶습니다. HTML5까지 대비돼 있는 테마라 신뢰가 갑니다.

아름다운 유동형 1단 테마! ^^ 기본 테마에서 찾다니! 기분이 좋습니다. 이상입니다.

 [1]: https://mytory.net/archives/10961
 [2]: http://wordpress.org/extend/themes/twentyeleven
 [3]: http://hyeonseok.com/soojung/webstandards/2011/02/05/638.html