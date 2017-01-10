---
title: input 요소의 높이를 지정할 때 height보다는 line-height를 사용하자
author: 안형우
layout: post
permalink: /archives/1207
tags:
  - CSS
---

## 2017-01-10

원래 이 글에서는 `padding`을 사용하라고 권하고 있었다. 2011년 5월이면 5년 7개월 전인데, 이제 갓 웹 개발자가 돼 한창 발전을 하고 있을 때니 `height`로 `input` 높이를 지정하는 걸 벗어난 것만으로 기뻤던 것 같다. 나름 테스트도 해 보고 말이다.

그런데 살면서 깨달은 것은, `padding`으로는 높이 제어가 힘들다는 점이다. 처음에 이 글 쓸 때야 높이 맞추는 것 정도는 신경쓰지 않았지만, 요새는 신경쓰기도 한다. 그래서 높이를 제어할 수 있는 `line-height`를 사용하는 편이 낫다고 생각하게 됐다.

그래서 내용을 갈아 엎었다.

-----

`input` 박스의 사이즈가 크면 보기도 좋고 클릭해서 입력하기도 좋다. 그런데 css로 `height`를 지정하면 IE8에서는 난감한 일이 발생한다. 높긴 한데 커서가 맨 위에 딱 붙어 있게 되는 것이다. (엣지는 아직 확인 안 해 봤다.)

아래는 IE8에서 `height: 25px`을 input에 준 경우다.

![](/uploads/legacy/input-text/ie6-8%EC%9D%80%20%EC%99%BC%EC%AA%BD%EC%9C%84%EC%AA%BD%EC%9D%84%20%EB%94%B1%20%EB%B6%99%EC%9D%B8%EB%8B%A4.png)

위에 딱 붙어서 보기가 흉하다. 위아래 `padding`을 줄 수도 있지만, 그러면 높이 제어가 힘들다. 대신 `line-height`를 원하는 높이만큼 주면 해결된다. 만약 높이를 25픽셀로 하려면 아래처럼 한다.

    line-height: 25px;
    
사실 이 방법은 이 글을 쓴 직후 [@dohoons 님이 알려 준 방법][1]인데, 당시엔 참고사항으로만 적어 놨었다. 하지만 어느 순간 나도 `line-height`를 사용하게 됐다.

[1]: https://twitter.com/dohoons/status/66049468788768768