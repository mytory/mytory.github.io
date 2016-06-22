---
title: '자바스크립트와 jsp, php를 섞지 말자'
layout: post
tags:
  - javascript
---

유지보수를 맡은 코드를 까 보니 모든 jsp 파일에서 비슷한 js와 css가 반복되고 있었다. 당연히 js와 css를 파일에서 분리하려고 했다. 그런데, js를 분리하고 나니 IDE에서 에러가 표시가 엄청 떴다. 아래와 같은 코드 때문이었다.

    var url = "http://${pageContext.request.serverName}:${pageContext.request.serverPort}/api/";

jsp에서 `${pageContext.request.serverName}`은 URL의 도메인(`domain.com` 따위) 부분을 가리킨다. IP 숫자일 수도 있고 뭐. 위 코드를 php로 변경하면 아래와 같을 것이다.

    var url = "http://<?= $_SERVER['HTTP_HOST'] ?>/api/";

이런 코드는 가독성을 떨어뜨리고, 다른 개발자들을 혼란에 빠뜨린다. 나쁘다. 사실 이런 경우 그냥 js로 이렇게 적으면 된다.

    var url = location.origin + '/api/';

[IE 10까지 `window.location.origin` 객체가 없으므로](https://developer.mozilla.org/en-US/docs/Web/API/Window/location) 위 코드 사용 전 어딘가에 [아래와 같은 코드](http://tosbourn.com/a-fix-for-window-location-origin-in-internet-explorer/)를 넣어 주면 된다.

<pre>
if (!window.location.origin) {
  window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
}
</pre>

사실 그냥 이렇게 적어도 된다.

    var url = '/api/';

어차피 같은 도메인이니 별 문제가 없다.


## 서버단 자료 일부를 js에서 가져다 써야 하는 경우

서버단 값을 받아 js에서 처리해야 하는 경우에는 위처럼 기본값을 가져와서 사용하는 게 안 된다. 예컨대 js에서 `$username` 값이 필요하다고 가정해 보자. 이런 경우엔 HTML DOM의 적당한 곳에 `$username` 값을 박은 뒤 js에서 꺼내 쓰도록 한다.  어딘가에 'mytory님, 환영합니다!' 같은 문구가 있을 테니 거기에 넣으면 될 것이다. 논리적이기도 하다. HTML은 아래와 같이 될 것이다(`$username`을 굳이 이스케이프 처리하진 않았다. 필요하면 알아서 할 것).

    <p>
        <span id="#username" data-username="<?= $username ?>">
            <?= $username ?>
        </span>
        님, 환영합니다!
    </p>

jQuery를 사용한다면 이렇게 가져다 쓰면 될 것이다.

    var username = $('#username').data('username');

`post_id` 같은 것도 마찬가지다. HTML 요소의 어딘가에 넣어 뒀다가 꺼내 쓰면 된다. 아래는 예시.

    var post_id = $('[name="post_id"]').val();


## 사이즈가 큰 서버단 자료로 json을 만들어 활용해야 하는 경우

차트를 그리는 경우 서버단 데이터로 json을 만들어 js에 전달해야 한다. 그러면 위와 같은 해법은 한계가 있다. 이런 경우 ajax 호출을 해서 데이터를 가져오는 경우엔 코드가 깔끔해질 것이다. 

서버단의 ajax 응답 php 스크립트는 아래와 같으면 될 것이다.

    header('content-type: application/json; charset=utf-8');
    // $data 변수 세팅 과정은 생략했다
    echo json_encode($data);

ajax 처리는 굳이 서버에 요청을 한 번 더 보내게 된다. 데이터가 동적으로 바뀌는 경우가 아니라면 페이지에 json을 박지 말아야 할 이유가 있는가? 정적인 페이지인데 ajax 호출을 하면 오히려 다른 개발자가 코드를 봤을 때 헷갈릴 수도 있다.

아래는 타협책이다. 데이터 json을 제외한 모든 js 코드는 별도 파일로 분리하고, 데이터 json만을 위한 `script` 태그를 사용하는 것이다.

    <script>
    var data = <?= json_encode($data) ?>;
    </script>

약간 신경이 거슬리지만, 다른 개발자가 이 코드를 이해하는 게 어렵진 않을 것이다. 이 이상의 코드를 섞어야 한다면, 정말 이렇게 짜야 하는 것인지 의심하고, js 코드를 이용한 해법을 찾아야 한다. 다시 강조하지만, `var data`만 `script` 태그 안에 넣었다. 나머지 js는 별도 파일에 넣었다.


## 결론

코드 양이 많은 json 데이터를 가져와서 뿌리는 예외적인 경우를 빼면 거의 모든 경우 js와 서버단 스크립트를 분리할 수 있고, 그렇게 해야 한다는 것이 강조다. js 안에 php를 넣어서 간단하게 해결할 수 있다는 생각이 들면, 그렇게 하지 말자. 분명 다른 해법이 있을 것이다. 

목적은 코드 가독성을 얻는 것이다. 지금 내가 짜는 코드를 다른 개발자가 봤을 때, 1년 후 혹은 2년 후의 내가 봤을 때 이해하기 쉬워야 한다. 지금 당장의 편리함만을 추구하는 코드는 대체로 나쁘다.


