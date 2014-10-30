---
title: js와 iframe 없는 가벼운 트위터 공유 버튼
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/11702
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/11702-light-sns.md
daumview_id:
  - 51727183
categories:
  - 기타
  - 서버단
tags:
  - PHP
  - SNS
  - TIP
  - 마법 나무 테마
---
이 글은 [&#8216;마법 나무&#8217;로 블로그 스킨을 갈면서 한 경험을 공유하는 글][1]이다.

트위터, 페이스북 공유 버튼이 거의 모든 웹사이트에 달려 있다. 신경좀 쓴 곳은 구글 플러스 버튼도 달려 있다. 그런데 한 가지 알아야 할 게 있다. 이 모든 버튼은 `iframe`을 사용한다는 점이다. `iframe`을 사용해서 SNS 사이트들은 득을 보겠지만, 사이트 입장에서는 득실을 잘 판단해야 한다. 예컨대 나처럼 별로 공유가 없는 블로거 같은 경우엔 SNS 버튼 세 개에 `iframe`을 세 개나 사용하는 건 자원 낭비다. 사이트 렌더링이 꽤 느려진다.

그럼 어떻게 하는 게 좋을까? 해법은 간단하다. 그냥 링크로 처리하자. `target="_blank"` 속성을 줘서 링크를 새 창에서 열리게 할 수도 있다. 그거면 충분하다. 트위터 같은 경우는 링크에도 다양한 옵션을 줄 수 있다. 예컨대, 나 같은 경우는 아직 나를 팔로우하지 않은 사람이라면 팔로우하라고 추천하는 걸 나오게 하기도 했다.

우선 트위터 공유 버튼 만들기부터 살펴 본다.

## 트위터 공유 버튼 만들기

트위터 공유 버튼 만드는 게 신경쓸 게 제일 많다. 첫째, 문장을 URL에 넣어야 하기 때문이다. 둘째, 옵션을 줄 수 있는 게 많다.

트위터 공유 버튼은 기본적으로 다음과 같은 URL 형식을 가진다.

    https://twitter.com/intent/tweet?original_referer={URL}&text={text}&url={URL}&via={twitter-ID}&related={twitter-ID}
    

2013년 12월 15일 현재 내 블로그의 트위터 공유 URL은 모두 저런 식으로 생겼다. 이 글의 트위터 공유 링크도 마찬가지다. 아래 링크를 클릭하면 내 블로그가 공유된다.

[트위터로 &#8216;웹으로 말하기&#8217; 공유][2]

위 링크는 이렇게 생겼다.

    https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Fmytory.local&text=%EC%9B%B9%EC%9C%BC%EB%A1%9C%20%EB%A7%90%ED%95%98%EA%B8%B0&url=http%3A%2F%2Fmytory.local&via=mytory&related=mytory
    

`%3A` 같은 문자는 URL 인코딩이다. URL에서 특수문자와 한글을 깨지지 않고 이해할 수 있도록 해 주는 거다. PHP에서는 `urlencode()` 함수를 사용해서 만든다. javascript에서는 [`encodeURIComponent()` 함수를 사용한다.][3]

여튼간에, 위 URL을 하나씩 분석해 보자.

일단 호출할 주소는 `https://twitter.com/intent/tweet`이다. 나머지는 인자값이다.

*   **`original_referer`** : 실제로 이 트윗을 하게 된 페이지를 말한다. 내 블로그의 글 같은 경우는 공유할 URL과 referer가 같지만, 글 목록에서 특정 글을 바로 트윗하는 경우엔 referer는 글 목록 페이지가 되고, 공유할 URL은 실제 글의 URL이 될 거다.
*   **`text`** : 트윗에 넣을 메시지
*   **`url`** : 공유할 URL
*   **`via`** : 이 URL 소유자의 트위터 아이디
*   **`related`** : 트윗하고 나서 팔로우하라고 추천할 트위터 아이디

더 자세한 내용은 [Web Intents][4]에서 보면 된다.

### PHP에서 `http_build_query` 함수를 사용하면 편리하다

PHP를 사용한다면 [`http_build_query()` 함수][5]를 이용하자. `urlencode()`까지 알어서 처리해 주고, 코드가 배열로 깔끔하게 정리되니까 좋다. 아래처럼 써 주면 된다.

    <?php
    $tweet_share_url_query_string = http_build_query(
        array(
            'text' => '웹으로 말하기,
            'url' => 'http://mytory.local',
            'via' => 'mytory',
            'related' => 'mytory',
        );
    );
    $tweet_share_url = "https://twitter.com/intent/tweet?" . $tweet_share_url_query_string;
    ?>
    <a href="<?php echo $tweet_share_url ?>" target="_blank">트위터 공유</a>
    

그리 복잡하지 않다.

일단 이번 글은 트위터 공유로 끝내고 다음 글에선 나머지 SNS 서비스들의 공유 URL을 만드는 방법을 설명한다. 다른 것들은 URL만 넘기면 되니 사실 별로 설명할 것도 없다;;

 [1]: http://mytory.local/?tag=%eb%a7%88%eb%b2%95-%eb%82%98%eb%ac%b4-%ed%85%8c%eb%a7%88
 [2]: https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Fmytory.local&text=%EC%9B%B9%EC%9C%BC%EB%A1%9C%20%EB%A7%90%ED%95%98%EA%B8%B0&url=http%3A%2F%2Fmytory.local&via=mytory&related=mytory
 [3]: http://xkr.us/articles/javascript/encode-compare/
 [4]: https://dev.twitter.com/docs/intents
 [5]: http://www.php.net/http_build_query