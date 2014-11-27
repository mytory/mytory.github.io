---
title: '[워드프레스] 관리자 글목록에서 custom taxonomy로 필터링할 수 있도록 하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/9090
daumview_id:
  - 38685075
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스로 쇼핑몰 비슷한 걸 만들고 있다. 제조사로 제빙기를 구분할 수 있도록 custom taxonomy를 설정했다. 그런데 관리자 페이지의 글 목록에서 제조사를 바탕으로 검색을 할 수 없다는 걸 발견했다.

우선 처음 쓴 방법은 워드프레스 3.5부터 들어간 기능을 사용하는 것이다. 글 목록에 custom taxonomy를 보여 주는 것. 그러면 글 목록에 있는 제조사를 클릭했을 때 해당 제조사로 필터링이 된다. 아래 그림처럼 말이다. 아래 그림의 SIMAG 같은 것을 클릭하면 해당 제조사 것만 리스트에 나오게 된다.

<div style="width: 756px" class="wp-caption aligncenter">
  <img alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/wp-custom-taxonomy-in-admin-list.png" width="746" height="192" /><p class="wp-caption-text">
    판매분류와 제조사가 Custom Taxonomy고, Ice-hello, SIMAG 같은 것이 Term이다.
  </p>
</div>

이건 이 글을 보고 안 거다 : [WordPress 3.5 admin columns for custom taxonomies][1]

## 필터링을 할 수 있어야 한다

하지만 목록에 표시되지 않는 제조사로 필터링을 할 수 없지 않나? 여하튼간에 아래처럼 만들어야 했다.

<img class="alignnone" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/wp-custom-taxonomy-in-admin-list-2.png" width="665" height="68" />

알겠지만, 만들어서 이 글을 쓰는 거다. 위처럼 표시하기 위한 코드는 아래와 같다. 판매분류도 custom taxonomy지만, 제조사용 코드만 쓴다. 제조사의 custom taxonomy slug는 company였다.

<pre>&lt;?
add_action('restrict_manage_posts','restrict_ice_machine_by_company');

/**
 * 제조사 분류 셀렉트 박스 출력
*/
function restrict_ice_machine_by_company() {
  global $typenow;
  global $wp_query;
  if ($typenow=='ice_machine') {
    $taxonomy = 'company';
    $taxonomy_info = get_taxonomy($taxonomy);
    $terms = get_terms($taxonomy); ?&gt;
    &lt;select name="&lt;?=$taxonomy?&gt;"&gt;
      &lt;option value="0"&gt;
        &lt;?=$taxonomy_info-&gt;labels-&gt;all_items?&gt;
      &lt;/option&gt;
      &lt;?
      foreach ($terms as $term) {
        $selected = $term-&gt;slug == $_GET[$taxonomy]?' selected ':''; ?&gt;
        &lt;option &lt;?=$selected?&gt; value="&lt;?=$term-&gt;slug?&gt;"&gt;&lt;?=$term-&gt;name?&gt;(&lt;?=$term-&gt;count?&gt;)&lt;/option&gt;
      &lt;?}?&gt;
    &lt;/select&gt;
  &lt;?}
}</pre>

원리가 의외로 단순한데, restrict\_manage\_posts라는 액션에 그냥 셀렉트 박스를 출력하는 hook을 거는 것이다. (hook이 뭔지 궁금하면 &#8216;[워드프레스 플러그인 만들기 기본 개념][2]&#8216;을 한 번 읽어 봐라.) 물론 고려할 건 다 고려해서 한 거다. 이 필터링 박스를 위해서 따로 제공되는 함수 같은 건 없는 것 같다.

일단 &#8216;company&#8217; taxonomy의 term들을 모두 불러와서 그걸로 select 태그를 만들어서 뿌린 거다. select 박스의 option value는 term의 slug가 돼야 한다.

taxonomy 정보를 불러온 건, taxonomy의 label 정보를 불러와서 select 박스의 첫 항목에 &#8216;전체 제조사&#8217; 같은 식으로 띄워 주기 위해서다.

이걸 하는 데는 기본적으로 &#8216;[Adding a Taxonomy Filter to Admin List for a Custom Post Type?][3]&#8216;의 도움을 많이 받았다. 근데 시간이 없어서 다 읽고 하진 않았고, 코드만 보고 내 나름대로 만든 거다. 궁금한 사람은 저 글을 정독하고 만들어도 되겠다.

이상이다.

 [1]: http://make.wordpress.org/core/2012/12/11/wordpress-3-5-admin-columns-for-custom-taxonomies/
 [2]: http://mytory.net/archives/3225 "워드프레스 플러그인 만들기 기본 개념"
 [3]: http://wordpress.stackexchange.com/questions/578/adding-a-taxonomy-filter-to-admin-list-for-a-custom-post-type