---
title: '[워드프레스] Media Uploader를 Flash로만 사용하고 Siverlight는 사용하고 싶지 않을 때 필터'
author: 안형우
layout: post
permalink: /archives/9254
daumview_id:
  - 39402732
categories:
  - WordPress
tags:
  - WordPress Tip
---
황당한 문제를 겪었다. 내가 작업하고 있는 게 한글 도메인이다. 말 그대로 한글 도메인. 나도 처음엔 이런 게 있는지 몰랐는데 도서관.com 이런 식의 도메인이 실제로 등록이 된다. 꼼수로 쓰는 게 아니라 정식으로 말이다. (근데 권하지 않는다. 이 글을 쓰게 된 희귀한 버그도 이것 때문에 발생한 거니까)

워드프레스 3.5의 미디어 업로더가 작동을 하지 않았다. 처음엔 내가 뭔가 잘못한 건줄 알았다. 그래서 내가 작성한 js와 php를 모두 걷어내 봤다. 그런데 작동하지 않았다.

다음은 서버 설정 문제인가 했다. 그래서 IE에서 미디어 업로더가 제대로 작동하는 것을 확인한 서버로 웹사이트를 옮겨 봤다. 그래도 제대로 작동하지 않았다.

그래서 마지막으로 도메인명을 영문으로 변경해 봤다. 그제서야 제대로 돌아가기 시작했다.

## 해결책 &#8211; 미디어 업로드 runtimes에서 silverlight를 제거

그래서 silverlight로 전체 파일을 검색해 봤더니 두 군데 있는 media.php에서 설정값을 찾을 수 있었다. 워드프레스 개발자들 짱이다. 이런 것도 커스터마이징할 수 있게 만들어 놨다.

여튼, 아래처럼 함수를 만들고 필터를 걸면 된다.

<pre>/**
 * 한글 도메인에서 실버라이트 업로드 작동 안 함. 따라서 업로드할 때 실버라이트 업로더는 사용하지 않게 만듦.
 * @param array $plupload_init
 * @return string
 */
function my_remove_silverlight_on_uploaders($plupload_init){
	$temp = explode(',',$plupload_init['runtimes']);
	foreach ($temp as $key =&gt; $value) {
		if($value == 'silverlight'){
			unset($temp[$key]);
		}
	}

	$plupload_init['runtimes'] = implode(',', $temp);
	return $plupload_init;
}

add_filter('plupload_init', 'my_remove_silverlight_on_uploaders');
add_filter('plupload_default_settings', 'my_remove_silverlight_on_uploaders');</pre>