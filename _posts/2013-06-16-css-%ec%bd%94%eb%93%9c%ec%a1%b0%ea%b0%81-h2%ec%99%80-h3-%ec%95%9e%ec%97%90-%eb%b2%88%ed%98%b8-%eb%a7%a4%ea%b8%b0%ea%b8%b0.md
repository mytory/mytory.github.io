---
title: '[CSS 코드조각] h2와 h3 앞에 번호 매기기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10375
daumview_id:
  - 46191541
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
`h2`와 `h3` 앞에 자동으로 번호를 매겨 준다면 참 좋겠다는 생각을 해 왔었다. 얼마 전에야 IE8부터 CSS의 `counter` 속성을 지원한다는 사실을 알게 됐다. 와우!

아래는 `counter` 속성을 이용한 CSS 코드조각이다. 이러면 `h2`마다 번호가 매겨진다. `h2`가 시작될 때마다 `h3`의 번호가 리셋되고, 1부터 다시 시작한다. 코드 보고 설명 듣자.

    .document {
        counter-reset: h2number;
    }
    .document h2 {
        counter-increment: h2number;
        counter-reset: h3number;    
    }
    .document h2:before {
        content: counter(h2number) '. ';
    }
    .document h3 {
        counter-increment: h3number;
    }
    .document h3:before {
        content: counter(h3number) ') ';
    }
    

프로퍼티를 세 개 사용한 걸 볼 수 있을 거다. `counter-reset`, `counter-increment`, `content`. 그리고 `content` 프로퍼티의 값으로 `counter(변수명)`을 사용했다.

자, 퍼블리셔들에게는 약간 이해하기 힘들 수도 있는 개념이 등장했다. 이 `counter`는 변수를 사용한다. 숫자를 기억해야 하기 때문이다. 나는 `h2`의 숫자를 기억시키기 위한 변수로 `h2number`를 사용했다.

자, `h2`에다가 `counter-increment: h2number`하고 적어 주면 `counter-reset` 같은 게 없어도 일단 처음 나오는 `h2`와 1을 CSS가 알아서 연관짓는다. 그리고 그 뒤 `h2`가 나올 때마다 숫자를 1씩 올리게 된다.

나는 선택자를 `.document h2`라고 썼는데, 그럼 `.document h2`에만 영향을 준다. `.asdf h2`가 나와도 카운터가 올라가지 않는다는 말이다.

`h3`는 `h2`가 나올 때마다 숫자가 1부터 다시 시작해야 한다. 그래서 `h2`에 `counter-reset: h3number`를 넣어 둔 것이다. 그러면 `h2`가 나올 때마다 `h3`의 숫자를 기억하고 있는 변수인 `h3number`가 1로 재설정된다.

마지막으로 `content: counter(h2number) '. ';` 코드를 보자. 일단, 이 코드는 `.document h2:before`의 속성이다. 따라서 `:before` 선택자가 작동하는 경우에만 이게 작동할 거다. IE8에서 이 선택자는 잘 작동한다. IE8에서는 큰 따옴표로는 작동하지 않고 작은 따옴표로만 작동한다고 하니 참고하라.

값에서 `counter(h2number)`는 숫자를 가리킨다. 그리고 `'. '`는 점을 찍고 한 칸 띄우는 거다. 다른 언어와 달리 `+`나 `.` 같은 잇기 기호 없이 그냥 이어서 쓰면 된다.

그래서 정리하면 아래와 같다. 일단 `counter-reset`은 필수가 아니다.

*   `counter-increment` : 해당 요소가 나올 때마다 주어진 변수가 기억하는 숫자를 하나씩 올린다. 처음 나올 때 1부터 시작.
*   `counter-reset` : 해당 요소가 나올 때 주어진 변수가 기억하는 숫자를 리셋한다.
*   `content` : `counter(변수명)`을 넣어 줄 프로퍼티다. `:before`나 `:after` 선택자에서 작동한다는 것을 잊으면 안 된다.

이상이다. 쓸 일이 많을 지는 모르겠지만, 일단 분명히 쓸 곳은 있을 거라고 생각한다. 당장 내 개인 문서 정리 시스템에도 이미 도입했다.