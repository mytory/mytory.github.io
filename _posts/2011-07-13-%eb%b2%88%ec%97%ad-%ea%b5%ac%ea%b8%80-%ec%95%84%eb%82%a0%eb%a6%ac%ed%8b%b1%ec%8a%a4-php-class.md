---
title: '[번역] 구글 아날리틱스 PHP Class'
author: 안형우
layout: post
permalink: /archives/1469
aktt_notify_twitter:
  - yes
daumview_id:
  - 36700641
categories:
  - 서버단
tags:
  - PHP
---
[역자 주] 웹사이트 관리자모드에서 통계를 보고 싶다. 그런데 구글 아날리틱스는 통계 그래프 API를 제공하지 않는다. 거품이 잔뜩 낀 페이지뷰를 노출하고 싶지는 않고, 좀더 정확한 구글 아날리틱스로 관리자 모드에서 통계를 보여 주고 싶은데 제약이 많았다. 그래서 구글 아날리틱스 API 웹사이트를 뒤져 봤지만 헛수고.

그런데 오늘 검색을 하다가 좋은 글을 발견했다. 왜 예전에는 못 보고 지나쳤던 걸까? 내가 예전에 [구글 아날리틱스 그래프 라이브러리][1]를 소개한 적이 있었는데, 그 API는 너무 제한적인 것만 알려 줬기 때문에 결국 사용하지 않게 됐었다. 오늘 다시 좋아 보이는 걸 발견해서 일단 번역부터 해 본다. 그리고 좀더 사용하다가 jQuery 같은 거 붙여서 그래프도 그려 보고 할 생각이다. 번역을 다 하고 나서 드는 소감은, &#8216;이자식 짱이다&#8217; 하는 거다.

이제부터 번역 시작이다. 원문은 [Google Analytics API class for PHP][2] 다.

[2013-09-30 추가 : 이 글을 쓰던 2011년 7월엔 구글 아날리틱스 PHP API를 찾기 힘들었다. 그런데 오늘 검색해 보니 몇 개가 더 나오더라. 이제는 이 글에서 소개하는 게 다른 것들보다 낫다고 확언할 수는 없을 것 같다.]

# Google Analytics API class for PHP

<img alt="" src="/uploads/legacy/ga-marbles.jpg" width="277" height="184" />

한 달 전쯤 [구글이 아날리틱스 API 서비스를 개장][3]했다. [역자 주: 이 글은 2009년 5월 29일에 씌어졌다.] 모든 아날리틱스 유저에게 말이다. API를 이용하면 개발자가 GA[역자주: 구글 아날리틱스 - 이하 전부 GA로 표기] 보고서를 자신의 어플리게이션이나 웹사이트에 통합할 수 있다. 심지어 핸드폰에서도 불러올 수 있다!

내가 만지는 사이트에 이 API를 어떻게 통합해서, 기능을 향상시킬 수 있을지 좀 고민을 했다. 하지만 아이디어를 내놓기(kicking off) 전에, 나는 API 사용법과 액세스 방법을찾아 내야(find out)만 했다. 나는 마침내 PHP 클래스를 만들었다. 이 놈이 API를 호출하는 짜증나는 일을 모두 처리해 줄 것이다. 당신은 단지 보고서의 파라미터만 제출하면 된다. 그러면 PHP 클래스가 아날리틱스 데이터가 든 배열을 리턴해 줄 것이다.

## 시작하기

자, 무엇보다도 우선, GA 계정이 있어야 한다. 당연히 로그인도 해야 한다. 그리고 나서 내 글 맨 마지막 부분에 있는 내 PHP 클래스를 다운로드해야 한다.

API를 액세스하는 것은 기본적으로 두 단계를 거치게 된다. 먼저 구글에 자기 자신의 계정으로 로그인을 해야 한다. 그러면 자격증명 코드를 얻을 수 있다. 그러면 자격증명 코드를 이용해서 GA 프로필에 등록돼 있는 웹사이트 데이터를 불러올 수 있다.

구글 아날리틱스 PHP 클래스

이건 페이지뷰와 방문수를 불러 오는 코드다. 날짜와 국가별로 분류를 한 뒤, &#8216;Austrailia&#8217;만 가져오도록 필터를 적용했다. 페이지뷰가 높은 놈부터 출력하도록 했다.

<pre class="brush:php">// 구글 아날리틱스 PHP 클래스 include
include "googleanalytics.class.php";
try {
	// 자신의 GA email ID와 비밀번호를 사용해서 GA 클래스의 인스턴스를 생성한다. [아래 이메일과 1234는 자신의 것으로 변경한다.]
	$ga = new GoogleAnalytics('email@company.com','1234');

	// 불러오길 원하는 GA 프로필을 세팅한다. 형식은 'ga:123456' 이다. [코드 아래쪽에 뭘 긁으면 되는지 설명돼 있다.]
	$ga-&gt;setProfile('{GA Profile ID}');

	// 날짜를 세팅한다. 포맷은 YYYY-MM-DD
	$ga-&gt;setDateRange('2009-04-01','2009-04-07');

	// 국가와 날짜별로 보고서를 가져 온다. Australia로 국가를 필터링하고 페이지뷰와 방문수를 보여 주도록 한다.
	$report = $ga-&gt;getReport(
		array('dimensions'=&gt;urlencode('ga:date,ga:country'),
			'metrics'=&gt;urlencode('ga:pageviews,ga:visits'),
			'filters'=&gt;urlencode('ga:country=@Australia'),
			'sort'=&gt;'-ga:pageviews'
			)
		);

	//$report 배열을 출력한다.
	print_r($report);

} catch (Exception $e) {
	print 'Error: ' . $e-&gt;getMessage();
}</pre>

내가 바라는 건, 설명 없이고 코드 자체가 자신이 뭘 하는지 나타내는 거다. `setProfile()`에는 자신의 웹사이트 프로필 id 번호가 필요하다. 프로필 id 번호를 얻으려면 GA 대시보드에 가서 원하는 웹사이트의 &#8216;보고서 보기&#8217;를 누른다. 그리고 URL을 살펴 보는 거다. 거기에 &#8216;id=xxxxxx&#8217; 라는 문자열이 있다. 그게 자신의 id 번호다. 그걸 `setProfile()`에 &#8216;ga:xxxxxxx&#8217; 형식으로 세팅을 해 줘야 한다.

<p style="text-align: center;">
  <img class="aligncenter" alt="" src="/uploads/legacy/ga-url.jpg" width="507" height="29" />
</p>

[2013-09-30 추가 : URL로는 더이상 id를 얻을 수 없다. 아날리틱스에서 **관리 > 보기(프로필) 탭 > 설정 보기 > 보기 ID** (영문 :** Admin > VIEW(PROFILE) > View Settings > View ID**)에 나오는 값이 ID값이다.]

아니면 클래스 안에 있는 `getWebsiteProfiles()` 함수를 사용해도 된다. 자격증명을 얻은 뒤 이 함수를 호출하면, 자신의 계정에 등록돼 있는 웹사이트 프로필 배열을 얻을 수 있다. 거기서도 id 번호를 찾을 수 있다.

주의를 기울여야 하는 유일한 함수는 바로 `getReport()` 함수다. 원하는 결과를 얻기 위해서는 이 함수에 각종 파라미터를 잘 설정해 줘야 한다.

만약 GA에 익숙하다면, GA가 기본적으로 두 가지 필드 타입을 바탕으로 작동한다는 걸 알고 있을 거다. 그건 바로 dimensions(치수?) 와 metrics(통계?) 다. 간단히 말해서, metrics 는 GA 보고서의 컬럼으로, dimensions 는 행으로 생각하면 된다.

구글은 API에서 [사용할 수 있는 dimensions 와 metrics 목록][4]을 제공하고 있다.

[역자 주: 배열에 넣는 각종 변수는 [Core Reporting API - Reference Guide][5]서 참고하면 된다.]

`getReport()` 함수를 이용해서 기본적으로 GA의 맞춤 보고서와 같은 일을 할 수 있다. 어떤 dimensions 와 metrics 를 사용할 것인지 결정하면, API가 데이터를 리턴해 준다.

`getReport()` 함수를 이용해서 얻을 수 있는 결과는 아래와 같다.

<pre>Array
(
    [20090401~~Australia] =&gt; Array
        (
            [ga:pageviews] =&gt; 6
            [ga:visits] =&gt; 3
        )

    [20090402~~Australia] =&gt; Array
        (
            [ga:pageviews] =&gt; 4
            [ga:visits] =&gt; 3
        )

    [20090407~~Australia] =&gt; Array
        (
            [ga:pageviews] =&gt; 4
            [ga:visits] =&gt; 4
        )

    [20090403~~Australia] =&gt; Array
        (
            [ga:pageviews] =&gt; 3
            [ga:visits] =&gt; 3
        )

    [20090405~~Australia] =&gt; Array
        (
            [ga:pageviews] =&gt; 3
            [ga:visits] =&gt; 3
        )

    [20090406~~Australia] =&gt; Array
        (
            [ga:pageviews] =&gt; 3
            [ga:visits] =&gt; 3
        )

    [20090404~~Australia] =&gt; Array
        (
            [ga:pageviews] =&gt; 2
            [ga:visits] =&gt; 2
        )
)</pre>

배열을 심플하게 유지하기 위해, 나는 기본적으로 dimensions 를 첫 번째 배열 키로 사용했다. 두 번째 dimensions 역시 &#8216;~~&#8217;로 구분해서 배열 키로 넣었다. 필요하면 파싱해서 사용하라. metrics 는 배열 안의 배열로 들어간다. 이 배열을 metrics 를 키로 해서 자신의 값을 들고 있다.

모든 dimension 이 metric 과 대응하지는 않는다. 구글은 [해당 dimension 과 metric 조합이 옳은지 판단할 수 있는 비교표][6]를 제공하고 있다.

[역자 주: dimension과 metric 외에 들어가는 변수는 [Parameters][7]를 참고하라.]

이 클래스는 PHP에서 cURL 함수를 사용한다. 보통은 서버에서 사용할 수 있게 돼 있는데, 만약 그렇지 않으면 [여기 cURL 을 사용 가능하게 만드는 방법][8]을 참고하라.

이상 기본적인 설명이 끝났다. 이 클래스를 얼마든지 다운로드해도 좋다. 명심해야 할 것은 이게 &#8216;상용&#8217;으로 사용할 정도로 준비가 돼 있는 클래스는 아니라는 점이다. [역자 주: 이 다음엔 아직 준비가 덜 됐다. 시간이 더 있으면 뭘 하겠다 이런 게 설명돼 있고, 가운데 줄이 그어져 있다.] 이 클래스는 업데이트 됐다. 몇 가지 예외 처리를 추가했다. 그래서 문제에 직면하게 될 경우 좀더 의미가 있는 메세지를 출력해 줄 것이라고 생각한다.

원문의 다운로드 링크: [googleanalytics.class.zip][9]

역자가 제공하는 다운로드 링크: [googleanalytics.class.zip][10]

보고서를 불러 오는 예시를 몇 개 더 보여 주겠다.

<pre class="brush:php">// 브라우저가 뭔지
$report = $ga-&gt;getReport(
	array('dimensions'=&gt;urlencode('ga:browser'),
		'metrics'=&gt;urlencode('ga:visits'),
		'sort'=&gt;'-ga:visits'
		)
	);

// 상위 도착 페이지와 사이트에 머문 시간
$report = $ga-&gt;getReport(
	array('dimensions'=&gt;urlencode('ga:landingPagePath,ga:pageTitle'),
		'metrics'=&gt;urlencode('ga:entrances,ga:timeOnPage'),
		'sort'=&gt;'-ga:entrances'
		)
	);

// 페이지뷰에서 상위 검색 키워드는 무엇인가?
$report = $ga-&gt;getReport(
	array('dimensions'=&gt;urlencode('ga:searchKeyword'),
		'metrics'=&gt;urlencode('ga:pageview'),
		'sort'=&gt;'-ga:pageviews'
		)
	);</pre>

2009-07-15에 덧붙임: 구글은 GA의 새로운 API를 출시했다. 리턴받는 데이터 양에 제한이 생겼고, dimensions 와 metrics 조합에 느슨한 제약이 생겼다.

 [1]: https://mytory.net/archives/629 "[PHP] 구글 아날리틱스 통계 그래프를 홈페이지에 달기"
 [2]: http://www.askaboutphp.com/63/google-analytics-api-class-for-php.html
 [3]: http://analytics.blogspot.com/2009/04/attention-developers-google-analytics.html
 [4]: http://code.google.com/apis/analytics/docs/gdata/gdataReferenceDimensionsMetrics.html
 [5]: http://code.google.com/intl/ko-KR/apis/analytics/docs/gdata/v3/reference.html
 [6]: http://code.google.com/apis/analytics/docs/gdata/gdataReferenceDimensionsMetrics.html#explore2Pair
 [7]: http://code.google.com/apis/analytics/docs/gdata/v3/reference.html#parameters_table
 [8]: http://www.wallpaperama.com/forums/how-to-find-out-if-php-is-compiled-with-curl-extension-installed-enabled-t1576.html
 [9]: http://www.askaboutphp.com/wp-post-images/63/googleanalytics.class.zip
 [10]: https://docs.google.com/leaf?id=0B1y-xjZYE3AqYzJmZTdjMzItNTdlOC00ODJiLWFkMGItMDgyOTA3OGJiZGNk&hl=ko