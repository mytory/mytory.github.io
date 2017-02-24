---
title: 워드프레스 플러그인 만들기 기본 개념
author: 안형우
layout: post
permalink: /archives/3225
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36565563
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스로 뭔가를 개발할 때 테마 종속적이지 않도록 하기 위해선 플러그인을 사용하는 게 좋다. 플러그인을 만들면 코어 파일을 수정하지 않고도 많은 변화를 줄 수 있다. 코어 파일을 수정하면 워드프레스를 업데이트할 때마다 다시 커스터마이징을 해야 한다. 보안을 위해선 업데이트를 안 할 수도 없기 때문에 귀찮지 않으려면 코어 파일은 건드리지 말아야 한다.

즉, 워드프레스를 커스터마이징할 땐 플러그인을 만드는 게 좋은 것 같다.

## 플러그인의 기본 개념

워드프레스는 플러그인을 통해서 거의 모든 것을 조작할 수 있도록 하고 있다. 예를 들어 보자.

로그인 메시지를 조금 바꾸고 싶다고 하자.

<pre class="brush: php; gutter: true; first-line: 1">function modify_login_message($msg){
  $msg .= &#039;나 말곤 아무도 로그인하지 마!&#039;;
  return $msg;
}
add_filter(&#039;login_message&#039;, &#039;modify_login_message&#039;);</pre>

테마에 있는 `functions.php` 파일에 위 코드를 넣어 주면 된다. `add_filter`는 필터를 추가한다는 이야기고, &#8216;`login_message`&#8216;는 워드프레스가 제공하는 키워드다. `modify_login_message`는 위에서 보면 알 수 있듯, 함수명이다. 즉, `login_message`를 `modify_login_message`라는 함수로 조작을 가하겠다는 뜻이다. 함수명은 뭐가 되든 상관 없는데 `asdfasdf` 같은 함수명도 상관없다. 두 번째 인자값으로 명시만 해 주면 되는 것이다.

`modify_login_message` 함수는 `$msg`를 받아서 가공을 한 뒤 돌려 준다. 이건 필터에 등록되는 함수의 규칙이다. 가공할 놈을 받고, 그 놈을 돌려 줘야 필터링이니까.

위에서 예로 든 건 필터인데, 액션이란 것도 있다. 걱정할 거 없다. 필터 아니면 액션이다. 사용법은 비슷하다. 액션과 필터의 차이는 간단한데, 필터는 뭔가를 받아서 리턴해 주는 놈이다. 액션은 그냥 뭔가를 하는 놈이다.

*   [필터에 사용되는 키워드 목록 보기][1]
*   [액션에 사용되는 키워드 목록 보기][2]

`wp-login.php`를 열어 보면 아래와 같은 코드를 볼 수 있다.

<pre class="brush: php; gutter: true; first-line: 1">$message = apply_filters(&#039;login_message&#039;, $message);</pre>

필터를 여기서 적용하는 거다. `apply_filter`를 우리가 쓸 일은 거의 없을 거다. 저런 식으로 `apply_filters('키워드', $변수)` 식의 코드가 곳곳에 있고, 거기마다 우리가 조작을 가할 수 있는 것이다.

액션의 경우엔 `do_action('키워드')` 라는 함수가 곳곳에 있다. 여기서 해당 키워드의 액션이 벌어지는 것이다.

함수 이름에서도 알 수 있는데 필터는 적용(`apply`)하고 액션은 한다(`do`).

키워드를 소개했으니 말인데, 본문을 필터링하고 싶다면 필터 키워드에 &#8216;`the_content`&#8216;를 써 넣으면 된다.

## 이 필터를 플러그인으로 만들려면&#8230;

`functions.php`에 위 코드를 넣는 것은 아직 플러그인을 만든 것이 아니다. 이걸 플러그인으로 만드는 건 간단하다.

`wp-content/plugins` 하위에 `modify-login-message` 라는 폴더를 만들고, `modify-login-message.php` 파일을 만든다. 폴더명과 파일명이 꼭 같아야 하는 건 아닌 것 같다. 이 파일이 플러그인이 작동시키는 파일이 된다. (폴더 안 만들고 plugins 폴더에 직접 파일을 만들어도 상관없다. 파일 하나로 충분한 플러그인이라면 그렇게 할 수도 있겠다.)

이 파일의 맨 위에 이렇게 적는다.

<pre class="brush: php; gutter: true; first-line: 1">/*
 Plugin Name: 로그인 메시지 변경
 Plugin URI: http://없어도-된다
 Description: 로그인 메시지를 변경하는 예제 플러그인다.
 Version: 1.0.0
 Author: mytory
 Author URI: https://mytory.net
 License: GPL2
 */</pre>

워드프레스의 라이센스인 GPL2 라이센스를 따라 보자. 만약 GPL2 라이센스를 따를 생각이라면 아래 문구를 집어 넣어 줘야 한다고 한다. (권장사항인 거겠지.)

<pre class="brush: php; gutter: true; first-line: 1; highlight: []; html-script: false">/* Copyright YEAR PLUGIN_AUTHOR_NAME (email : PLUGIN AUTHOR EMAIL)
 This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/</pre>

위에 YEAR랑 `PLUGIN_AUTHOR_NAME`, `PLUGIN AUTHOR EMAIL` 같은 건 알아서 채워 넣어라.

이렇게 하고 아까 코드를 `funcitons.php` 에서 빼와서 이 파일에 집어 넣다. 저장을 하고 워드프레스 관리자모드의 플러그인 메뉴에 가면 내가 만든 플러그인이 있는 것을 볼 수 있다. 그리고 플러그인을 활성화하면 로그인 화면에 아이디 입력 칸 위에 아까 입력한 메시지가 뜨는 것을 볼 수 있다.

## 덧붙임

여기서 다룬 것은 기본 개념이다. 필터와 액션에 들어가는 변수, 우선순위 등등 알아야 할 것이 꽤 있다. 그러나 위의 기본 개념을 파악하고 나면 좀더 쉽게 플러그인을 제작할 수 있을 것이다.

마지막으로, [예제 코드를 다운로드][3]할 수 있다. 별 거 없지만 ㅋ

 [1]: http://codex.wordpress.org/Plugin_API/Filter_Reference
 [2]: http://codex.wordpress.org/Plugin_API/Action_Reference
 [3]: https://mytory.net/uploads/legacy/modify-login-message.zip