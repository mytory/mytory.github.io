---
title: '[워드프레스] wp_cron(사실은 wp_schedule_event)을 이용해서 정기적인 작업 하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/3029
aktt_notify_twitter:
  - no
daumview_id:
  - 36579809
categories:
  - WordPress
tags:
  - WordPress Tip
---
`wp_cron()`에 이벤트를 등록하는 [`wp_schedule_event()`][1]를 이용하면 정기적으로 해야 하는 작업을 자동화할 수 있다. (`wp_cron()` 함수는 정기적 작업을 중단할 때만 사용하므로 정기적 작업을 등록할 때는 사용할 일이 없다.)

예를 들면 [Broken Link Checker][2]라는 플러그인은 `wp_cron`에 이벤트를 등록해서 1시간에 한 번씩 깨진 링크를 체크한다.

나도 얼마 전에 정기적으로 자동화할 일이 생겼다. 트래픽을 분석해 보니, 구글과 네이버에서는 많은 수가 방문하는데, Daum에서는 방문수가 거의 없는 것이었다. 2012-07-12 트래픽을 보면, 트래픽이 아래와 같다.

*   구글 검색 : 711회
*   네이버 검색 : 221회
*   다음 검색 : 7회

이건 뭔가 문제가 있다. 그래서 보니까 Daum 블로그 검색에서 내 블로그가 검색되지 않는 것을 발견했다. 웹 검색에서는 내 글이 좀 검색되는 것 같았는데 그마저도 몇 개 안 되는 것 같았고, 심지어 어떤 글은 내 블로그에서 퍼온 글만 검색되는 경우도 있었다. 다음 측에 문의를 했으나 시간이 걸린다는 답변만 오고 후속 답변이 오지 않았다. (이것에 대해서는 다음에 따로 글을 쓸 생각이다.)

그래서 궁여지책으로 다음 뷰에 블로그를 등록했다. 그리고 시간이 흐르니 다음 뷰에서 인지한 글은 검색이 되는 것이었다. 오호라! 그럼 다음 뷰에 글을 전부 다 보내면 되겠군!

하지만 몇 가지를 고려해야 했다. 일단 내 글이 700개가 넘는데 이걸 수동으로 하는 건 미친 짓이다. 그렇다고 스크립트를 짜서 한꺼번에 글을 보내는 것 역시 다음 뷰 측에서 제재를당할 수 있는 바보 같은 짓일 거다. 제재를 당하지 않는다고 해도 사용자들에게 &#8220;쟨 뭐냐&#8221; 하는 눈총을 당할 수 있다. 그래서 생각한 것이, 백그라운드에서 프로그램을 돌리는 것이었다. 30분에 한 개씩 [다음 뷰 IT 섹션으로 트랙백][3]을 보내도록 하기로 했다. 그래서 wp_cron을 사용하게 된 것이다.

## [`wp_schedule_event()`][1]를 사용해 보자

핵심 원리는 다음과 같다.

1.  30분에 한 번씩 작동할 함수를 만든다. 나는 `trackback_to_daum_view()` 라는 함수를 만들었다.
2.  이 함수를 작동시킬 `action`을 만든다. 나는 `tbview`라는 `action`을 만들었다. 이런 식으로 추가해 준다.  
    `add_action('tbview', 'trackback_to_daum_view');`  
    액션 추가는 매번 실행해 줘야 한다. 난 `function.php`에서 추가하도록 했다.
3.  이 액션을 `wp_schedule_event()`에 등록한다. 아래와 같은 형식이다.  
    `wp_schedule_event( time(), 'hourly', 'tbview');`  
    등록은 한 번만 해야 한다.(예컨대 플러그인이라면 활성화할 때.) DB의 `wp_options` 테이블의 `option_name`이 `cron`인 로우에 저장되기 때문이다. 여러 번 등록하면 졸라 많이 등록되는 거다.

## 실행시킬 함수를 만든다

자, 이제 상세 설명 들어간다. 일단 실행시킬 함수를 만든다. 나는 아래와 같이 만들었다.

<pre class="brush: php; gutter: true; first-line: 1">/**
 * 다음 뷰로 트랙백을 보내지 않은 포스트를 다음 뷰에 쏜다.
 */
function trackback_to_daum_view(){
  global $wpdb;
  
  $querystr = "
      SELECT $wpdb-&gt;posts.* 
      FROM $wpdb-&gt;posts
      WHERE $wpdb-&gt;posts.pinged not like &#039;%v.daum.net%&#039;
      AND $wpdb-&gt;posts.post_status = &#039;publish&#039;
      AND $wpdb-&gt;posts.post_type = &#039;post&#039;
      ORDER BY $wpdb-&gt;posts.post_date DESC
      LIMIT 1
   "; 
  
  $pageposts = $wpdb-&gt;get_results($querystr, OBJECT);

  if($pageposts){
    global $post;
    foreach ($pageposts as $post) {
      setup_postdata($post);
      $tb = array(
        &#039;title&#039; =&gt; get_the_title(),
        &#039;excerpt&#039; =&gt; get_the_excerpt(),
        &#039;id&#039;=&gt; get_the_ID()
      );
      $tb[&#039;url&#039;] = &#039;http://mytory.net/archives/&#039; . $tb[&#039;id&#039;];
       //return getPrintr($tb);
       trackback(&#039;http://v.daum.net/tb/ch/it&#039;, $tb[&#039;title&#039;], $tb[&#039;excerpt&#039;], $tb[&#039;id&#039;]);
     }
   }
}</pre>

이 부분에선 `cron`과 상관없는 분야가 두 개 나오는데, Custom Select Query와 `trackback` 함수다. [`trackback` 함수][4]야 굉장히 사용하기 편하게 돼 있지만, Custom Select Query는 좀 복잡하다. 보통 워드프레스에서 포스트를 가져올 때는 [WP_Query 클래스][5]를 사용 한다. 옵션을 통해서 글을 골라 오는데, 어디에 트랙백을 보냈는지에 따라 포스트를 불러올 수 있도록 하는 옵션은 없었다. 그래서 [Custom Select Query][6]를 사용해야 했다. 사용례는 아래와 같다.

<pre class="brush: php; gutter: true; first-line: 1">global $wpdb;

$querystr = "
    SELECT $wpdb-&gt;posts.* 
    FROM $wpdb-&gt;posts
    WHERE $wpdb-&gt;posts.pinged not like &#039;%v.daum.net%&#039;
    AND $wpdb-&gt;posts.post_status = &#039;publish&#039;
    AND $wpdb-&gt;posts.post_type = &#039;post&#039;
    ORDER BY $wpdb-&gt;posts.post_date DESC
    LIMIT 1
 "; 

$pageposts = $wpdb-&gt;get_results($querystr, OBJECT);

if($pageposts){
  global $post;
  foreach ($pageposts as $post) {
    setup_postdata($post);
    //get_the_title(), the_excerpt(), get_the_ID() 처럼
    //post 안에서 사용하는 함수를 사용하면 된다.
   }
 }</pre>

## 함수를 실행시킬 action을 등록한다

`action`은 워드프레스에서 벌어지는 다양한 &#8216;작동&#8217;을 일컫는 말이다. 기본적으로 등록돼 있는 [Action Reference][7]를 보면 다양한 `Action`들을 볼 수 있다. 예컨대 [Template Action][8]에는 `get_header` 같은 `Action`도 있다. 헤더를 불러오는 &#8216;작동&#8217;인 거다. 여기에 특정 함수를 걸면 header를 불러올 때마다 해당 함수가 실행되게 되는 것이다.

그런데 여기서 핵심은 기존에 있는 특정 액션에 `trackback_to_daum_view` 함수를 거는 게 아니라, 새로운 액션을 만든다는 데 있다. 그래서 알아서 액션의 이름을 정하면 된다. `wp_cron`은 특정 시간이 되면 해당 액션을 호출하는 거다. 그래서 나는 `tbview`라는 이름의 액션을 만든 거다.

이 액션은 페이지가 로딩될 때마다 추가돼야 한다. 그래야 제대로 작동한다. 그래서 `function.php`에 아래와 같이 코드를 박은 것이다.

<pre class="brush: php; gutter: true; first-line: 1">add_action(&#039;tbview&#039;, &#039;trackback_to_daum_view&#039;);</pre>

`tbview`라는 액션이 실행되면, `trackback_to_daum_view`라는 함수를 실행하라는 코드다. 만약 함수에 인자값이 들어간다면 세 번째에 인자값을 넣어 주면 된다.([`add_action` 함수 레퍼런스][9] 참고)

## 액션을 `wp_cron`에 등록하기

이제 자신만의 액션을 만들었으므로 이 액션을 `wp_cron`에 등록하자. `wp_cron`에 특정 액션을 등록하는 함수는 [`wp_schedule_event()`][1]다.

이 함수는 한 번만 호출해야 한다. 여러 번 호출하면 여러 번 등록된다. 그래서 나는 특정 페이지를 만들고, 페이지 번호를 따서 테마 폴더에 `page-1234.php`라는 파일을 만들었다. (이렇게 하면 페이지 ID가 1234인 글을 호출했을 때 `page-1234.php` 파일을 템플릿 파일로 사용하게된다. 꼭 이렇게 할 필요는 없다. 자신이 알아서 적당한 곳에서 호출하면 된다. 페이지 번호는 페이지 편집할 때 주소 표시줄을 보면 알 수 있다.)

거기에 아래와 같은 코드를 작성했다.

<pre class="brush: php; gutter: true; first-line: 1">if(wp_schedule_event( time(), &#039;hourly&#039;, &#039;tbview&#039;) === NULL){
	echo &#039;다음뷰로 트랙백을 보내도록 설정했습니다.&#039;;
}else{
	echo &#039;실패!&#039;;
}</pre>

`wp_schedule_event`에 들어가는 인자값 설명을 보면 아래와 같다.

<pre class="brush: php; gutter: true; first-line: 1">wp_schedule_event($timestamp, $recurrence, $hook, $args);</pre>

### `$timestamp`

첫 번째에 들어가는 `$timestamp`는 처음 실행할 기준 시각이다. 현재 시각 타임스탬프를 적으면 되기 때문에 `time()` 함수를 넣었다. (타임스탬프가 뭔지 궁금하면 검색해 보라.)

근데 설명을 보면 아래와 같이 나와 있다.

> <tt>$timestamp</tt>([*integer*][10]) (*필수*) 이벤트가 일어나기 바라는 첫 번째 시각. 반드시 UNIX timestamp 포맷으로 넣어야 한다. PHP의 `time()` 함수 대신에 워드프레스의 [`current_time( 'timestamp' )`][11]를 사용하는 게 좋다. 그렇지 않으면 첫 번째 실행이 블로그의 로컬 타임에 맞춰서 되지 않을 것이다. 그러면 혼란을 겪을 수 있다.
> 
> <tt>$timestamp</tt>([*integer*][10]) (*required*) The first time that you want the event to occur. This must be in a UNIX timestamp format. You should use WordPress&#8217; [current_time( &#8216;timestamp&#8217; )][11] instead of PHP&#8217;s time(); otherwise the first occurrence of the event will not be in your local time, which may lead to confusion.

그런데 나는 오히려 [`current_time( 'timestamp' )`][11]를 사용했다가 혼란을 겪었다. 제 시간에 실행이 되지 않았기 때문이다. 왜 이런 일이 벌어졌는지는 모르겠는데, 여튼간에 [`current_time( 'timestamp' )`][11]를 사용했을 때 제대로 작동하지 않는다면 `time()` 함수를 사용해 보기 바란다.

### `$recurrence`

`$recurrence` 인자값에는 반복되는 시간 간격을 적어 준다. 키워드로 적어 줘야 한다. 키워드는 정해진 것이 몇 개 있다. `wp_get_schedules()` 함수를 실행하면 키워드를 볼 수 있는데,

<pre class="brush: php; gutter: true; first-line: 1">echo &#039;&lt;h2&gt;cron 시간 간격 키워드들&lt;/h2&gt;&lt;pre&gt;&#039;;
print_r(wp_get_schedules())
echo &#039;&lt;/pre&gt;&#039;;</pre>

이렇게 써 보면 키워드 목록을 볼 수 있다. 아래처럼 나온다.

<pre class="brush: text; gutter: true; first-line: 1">Array
(
    [weekly] =&gt; Array
        (
            [interval] =&gt; 604800
            [display] =&gt; 주마다 한번
        )

    [bimonthly] =&gt; Array
        (
            [interval] =&gt; 936000
            [display] =&gt; Twice a Month
        )

    [hourly] =&gt; Array
        (
            [interval] =&gt; 3600
            [display] =&gt; 매 시간
        )

    [twicedaily] =&gt; Array
        (
            [interval] =&gt; 43200
            [display] =&gt; 일일 2회
        )

    [daily] =&gt; Array
        (
            [interval] =&gt; 86400
            [display] =&gt; 매일
        )

)</pre>

`weekly`, `bimonthly`, `hourly`, `twicedaily`, `daily` 가 바로 키워드다. 일단 나는 예시 코드에 `hourly`라고 적었다. (실제로는 `twicehourly`라는 키워드를 새로 만들어서 `twicehourly`로 실행하도록 했다. [원하는 시간 간격을 만드는 방법][12]은 레퍼런스를 참고하면 된다.)

### `$hook`

`$hook`은 대상 액션의 이름을 말한다. 문자열로 넣어 주면 된다. 아까 `add_action`으로 만든 액션이 기억날 것이다. 바로 &#8216;`tbview`&#8216;였다. 그걸 넣으면 된다. 그래서 완성된 코드가 아래와 같은 것이다.

<pre class="brush: php; gutter: true; first-line: 1">wp_schedule_event( time(), &#039;hourly&#039;, &#039;tbview&#039;)</pre>

자, 여기에 내가 몇 가지 검증 코드를 첨가한 게 아래 코드다.

<pre class="brush: php; gutter: true; first-line: 1">if(wp_schedule_event( time(), &#039;hourly&#039;, &#039;tbview&#039;) === NULL){
	echo &#039;다음뷰로 트랙백을 보내도록 설정했습니다.&#039;;
}else{
	echo &#039;실패!&#039;;
}</pre>

## 비활성화 코드 만들기

활성화 코드를 만들었으면 비활성화 코드도 있는 편이 좋겠다. 이건 상대적으로 쉬우니까 뜯어 보고 알아서 적용하기 바란다. 질문있으면 댓글로 해 주면 된다.

<pre class="brush: php; gutter: true; first-line: 1">$timestamp = wp_next_scheduled( &#039;tbview&#039; );
if($timestamp){
	//다음뷰로 트랙백 보내는 거 비활성화
	remove_action( &#039;tbview&#039;, &#039;trackback_to_daum_view&#039; );
	wp_clear_scheduled_hook( &#039;tbview&#039; );	
	echo &#039;다음뷰로 트랙백을 보내는 cron을 비활성화했습니다.&#039;;
}else{
	//다음뷰로 트랙백 보내는 거 활성화하기
	if(wp_schedule_event( time(), &#039;hourly&#039;, &#039;tbview&#039;) === NULL){
		echo &#039;다음뷰로 트랙백을 보내도록 설정했습니다.&#039;;
	}else{
		echo &#039;실패!&#039;;
	}
}</pre>

자, 한 번 활성화를 하면 그 때부터는 자동으로 동작하기 시작한다.

## `wp_cron` 작업 목록 확인하는 방법

등록돼 있는 `wp_cron` 작업 목록을 확인해 보고 싶을 것이다. 아래 코드를 사용하면 된다.

<pre class="brush: php; gutter: true; first-line: 1">echo &#039;&lt;h2&gt;wp_cron 작업 목록&lt;/h2&gt;&lt;pre&gt;&#039;;
print_r(get_option(&#039;cron&#039;));
echo &#039;&lt;/pre&gt;&#039;;</pre>

간단하게 플러그인을 설치해도 된다. `cron`으로 검색해서 설치하면 될 텐데, `cron` 들어간다고 모두 작업목록을 보여 주는 건 아니다. 나는 [Cron View][13]를 설치했다. 그러면 관리자 모드의 &#8216;도구&#8217; 메뉴에 What\`s in Cron? 이라는 항목이 생긴다.

## 핵심 정리

*   `wp_schedule_event()`에 등록하는 것은 `action`이다. 등록은 한 번만 해야 한다.
*   `add_action`은 매번 호출돼야 하며, 액션명은 알아서 정하면 된다.
*   내 경우엔 `time()` 으로 해야 작동했다. `current_time('timestamp')` 로 하니까 제대로 작동하지 않았다. 제대로 작동하지 않으면 저걸 바꿔 보면 도움이 될 거다.

## `wp_cron`의 작동 원리

이건 보너스다. wp_cron이 도대체 어떻게 작동하는 걸까 궁금했는데, [wp\_schedule\_event() 레퍼런스][1]에 잘 설명돼 있었다.

> 누군가 블로그에 방문했을 때, 스케쥴에 등록된 시간이 지났으면 액션이 작동한다.
> 
> The action will trigger when someone visits your WordPress site, if the scheduled time has passed.

 [1]: http://codex.wordpress.org/Function_Reference/wp_schedule_event
 [2]: http://wordpress.org/extend/plugins/broken-link-checker/
 [3]: http://daumview.tistory.com/29
 [4]: http://codex.wordpress.org/Function_Reference/trackback
 [5]: http://codex.wordpress.org/Class_Reference/WP_Query
 [6]: http://codex.wordpress.org/Displaying_Posts_Using_a_Custom_Select_Query
 [7]: http://codex.wordpress.org/Plugin_API/Action_Reference
 [8]: http://codex.wordpress.org/Plugin_API/Action_Reference#Template_Actions
 [9]: http://codex.wordpress.org/Function_Reference/add_action
 [10]: http://codex.wordpress.org/How_to_Pass_Tag_Parameters#Integer "How to Pass Tag Parameters"
 [11]: http://codex.wordpress.org/Function_Reference/current_time "Function Reference/current time"
 [12]: http://codex.wordpress.org/Function_Reference/wp_get_schedules
 [13]: http://wordpress.org/extend/plugins/cron-view/