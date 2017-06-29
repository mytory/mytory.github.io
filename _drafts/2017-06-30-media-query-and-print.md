미디어쿼리에서 설정한 폰트 사이즈가 인쇄에 영향을 준 사건.

아마 매커니즘은 다음과 같다.

1. 크롬은 인쇄시 페이지 계산을 기본 폰트 사이즈로 한다.
2. 그러나 화면에는 미디어쿼리가 적용된 폰트 사이즈로 글자가 뿌려진다.
3. 그래서 마지막 부분이 잘린다.

~~~
.s-editor-content
  @media (max-width: 600px)
    text-align: left
    font-size: inuit-rem($inuit-global-font-size + 2px)
    h2
      font-size: inuit-rem($inuit-font-size-h2 + 2px)
    h3
      font-size: inuit-rem($inuit-font-size-h3 + 2px)
    .u-text-small
      @include inuit-font-size($inuit-global-font-size, auto, true)
~~~

즉, 600px 이하부터는 폰트 사이즈가 2px 늘어나는 거였다. chrome에서 1cm는 37.7953px이다. 600px은 15.9cm. 여백 2cm씩 준 A4용지의 내용 부분 너비는 17cm. 계산대로라면 미디어 쿼리가 먹어선 안 되는데 먹는다. px을 cm로 변환할 때 스크린에선 96dpi로 계산하지만 프린트시엔 72dpi로 계산하기라도 하는 것일까? 여튼간에 기현상.

인쇄시 마지막 부분이 잘리는 문제 때문에 한참 헤맸는데, 결국 이것 때문이라는 것을 찾고 아래처럼 고쳤다.

    @media screen and (max-width: 600px) 
