---
title: '[워드프레스] TwentyEleven 테마에서 카테고리로 메인메뉴 자동 생성하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/3000
aktt_notify_twitter:
  - yes
daumview_id:
  - 36582985
categories:
  - WordPress
tags:
  - WordPress Tip
---
<pre class="brush: php; gutter: true; first-line: 1; highlight: [8,9,10,11,12]; html-script: true">&lt;nav id="access" role="navigation"&gt;
  &lt;h3 class="assistive-text"&gt;&lt;?php _e( &#039;Main menu&#039;, &#039;twentyeleven&#039; ); ?&gt;&lt;/h3&gt;
  &lt;?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?&gt;
  &lt;div class="skip-link"&gt;&lt;a class="assistive-text" href="#content" title="&lt;?php esc_attr_e( &#039;Skip to primary content&#039;, &#039;twentyeleven&#039; ); ?&gt;"&gt;&lt;?php _e( &#039;Skip to primary content&#039;, &#039;twentyeleven&#039; ); ?&gt;&lt;/a&gt;&lt;/div&gt;
  &lt;div class="skip-link"&gt;&lt;a class="assistive-text" href="#secondary" title="&lt;?php esc_attr_e( &#039;Skip to secondary content&#039;, &#039;twentyeleven&#039; ); ?&gt;"&gt;&lt;?php _e( &#039;Skip to secondary content&#039;, &#039;twentyeleven&#039; ); ?&gt;&lt;/a&gt;&lt;/div&gt;
  &lt;?php /* Our navigation menu.  If one isn&#039;t filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?&gt;
  &lt;?php wp_nav_menu( array( &#039;theme_location&#039; =&gt; &#039;primary&#039; ) ); ?&gt;
  &lt;div class="menu-category"&gt;
    &lt;ul class="menu"&gt;
    &lt;?php wp_list_categories(&#039;title_li=&#039;)?&gt;
    &lt;/ul&gt;
  &lt;/div&gt;
&lt;/nav&gt;</pre>

위에서 8~12번째 줄인

<pre class="brush: php; gutter: true; first-line: 1; html-script: true">&lt;div class="menu-category"&gt;
  &lt;ul class="menu"&gt;
  &lt;?php wp_list_categories(&#039;title_li=&#039;)?&gt;
  &lt;/ul&gt;
&lt;/div&gt;</pre>

이 부분을 집어 넣으면 되는 거다.

wp\_list\_categories() 함수는 카테고리 목록을 반환해 주는 함수다. title_li 라는 인자값은 값을 비운 것인데, 만약 저렇게 값을 비우지 않으면 categories 라는 글자가 자동으로 출력된다. 그러면서 스타일이 깨지는 거다. 자세한 설명은 [wp\_list\_categories() 함수 Codex(워드프레스 공식 매뉴얼) 페이지][1]를 참고하면 된다.

그러면 관리자 메뉴에서 생성한 메뉴와 카테고리를 동시에 사용할 수 있게 된다. 2012-07-07 현재 내 블로그의 메뉴가 그렇게 돼 있다. HTML 뜯어 보면 UL이 두 개인 걸 알 수 있을 거다.

 [1]: http://codex.wordpress.org/Template_Tags/wp_list_categories