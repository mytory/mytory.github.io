---
title: 'Code Snippet &#8211; 버튼에 이벤트를 걸어서 타겟을 열고 닫는 jQuery 코드 조각'
author: 안형우
layout: post
permalink: /archives/9601
daumview_id:
  - 41389620
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
버튼에 이벤트를 걸어서 타겟을 열고 닫고 하는 건 상당히 자주 구현하게 된다. 근데 이게 졸라 반복되는 패턴이다. 몇 번 시도를 했었는데 귀찮아서 구현하지 않고 있다가 얼마 전에 그냥 구현을 했다. 앞으론 그냥 이거 긁어서 사용할 생각이다.

[▶ Demo부터 보기][1]

일단 아이디어는, 버튼에 `js-open-target`이라는 클래스를 놓고, `data-target` 속성에 접었다 폇다 할 target의 `selector`를 명시해 주는 것이다. 이러면 클래스와 속성을 부여하는 것만으로 접었다 폈다 하는 것을 할 수 있다.

## js

js 코드는 아래와 같다.

    $(document).ready(function(){
      // 열리는 이벤트를 건다.
      $('.jquery-on-container').on('click', '.js-open-target', function(e){
    
        // a나 submit 버튼에 클래스를 매긴 경우 링크 이동이나 submit을 막는다.
        e.preventDefault();
        var target_selector = $(this).data('target');
        $(target_selector).slideDown();
        $(this).removeClass('js-open-target').addClass('js-close-target');
      });
    
      /*
       * 처음엔 .js-close-target 클래스가 DOM에 로드돼 있지 않다.
       * on 함수를 이용하면 감시하고 있던 요소 안에 정해 준 요소가 등장했을 때 이벤트를 건다.
       * 이 경우, .jquery-on-container를 감시하고 있다가 .js-close-target가 등장하면
       * 닫히는 이벤트를 건다. 앞의 열리는 이벤트를 on 함수로 건 이유도 마찬가지다. 
       * 클래스를 js-open-target으로 했다가 js-close-target으로 했다가 하기 때문이다.
       */
      $('.jquery-on-container').on('click', '.js-close-target', function(e){
        e.preventDefault();
        var target_selector = $(this).data('target');
        $(target_selector).slideUp();
        $(this).removeClass('js-close-target').addClass('js-open-target');
      })
    
      // js를 끈 경우엔 컨텐츠가 보이도록 js로 열 것은 js에서 감춘다.
      $('.js-open-target').each(function(){
        var target_selector = $(this).data('target');
        $(target_selector).hide();
      });
    });
    

## HTML

그리고 이런 `HTML`을 넣었다.

    <h2 class="jquery-on-container">
      <!-- 키보드 focus가 가능하도록 a 태그를 이용했다. -->
      <a class="js-open-target" data-target=".closed-content">Toggle Target</a>
    </h2>
    <div class="closed-content">
      <p>대중이 역사의 무대에 등장하는 순간을 혁명이라 한다면, 우고 차베스의 볼리바르 혁명은 2002년 4월 11일에 시작했다.</p>
      <p>우익 쿠데타 세력은 차베스를 납치하고 새 정부를 선포했다. 그 정부는 겨우 48시간 동안만 유지됐다.</p>
      <p>차베스 지지자 수만 명이 차베스의 복귀를 요구하며 대통령궁을 포위했다.</p>
      ...
    </div>
    

이 경우 `h2` 요소의 제목을 `.jquery-on-container`로 만들고, `.js-open-target` 요소는 그 안에 `span`으로 집어넣었다. 하지만 `.jquery-on-container`를 좀더 넓은 `div`로 잡아도 크게 문제될 건 없다. 단, `body`에 해당 클래스를 놓지는 마라. `.live()` 함수가 그런 함수였고, 성능 이슈가 발생해서 deprecated된 것이다. 혹시 몰라서 밝혀 두는데, `.on()` 함수에 대한 건 주석에 설명을 적어 두었다.

접었다가 폈다가 할 요소는 `closed-content`라는 클래스가 붙은 `div`다. 그래서 `js-open-target` 요소의 `data-target`에는 `.closed-content`라는 jQuery Selector를 넣어 줬다. js 코드를 보면 알겠지만 이 안에는 어떤 jQuery Selector를 넣어도 된다. 심지어 여러 개를 넣어도 되고, 여러 개에 영향을 미치는 Selector를 넣어도 된다.

## CSS

마지막으로, CSS3를 살짝 이용했다. 접은 것엔 펼칠 수 있다는 암시를, 펼친 것엔 접을 수 있다는 암시를 줘야 하기 때문에, `:after` 가상 선택자를 이용해서 삼각형 화살표를 넣어 줬고, 마우스 포인터를 클릭할 수 있다는 암시를 주는 `cursor`로 바꿔 줬다.

    .js-open-target, .js-close-target {
      cursor: pointer;
    }
    .js-open-target:after {
      content: "▼";
      font-size: .6em;
      font-family: helvetica;
      color: #888;
      vertical-align: middle;
      margin-left: .5em; 
    }
    .js-close-target:after {
      content: "▲";
      font-size: .6em;
      font-family: helvetica;
      color: #888;
      vertical-align: middle;
      margin-left: .5em; 
    }
    

이렇게 삼각형 기호를 넣어 주면, 이미지를 넣는 것보다 해상도 대응이 쉬워 진다. `vertical-align` 속성을 이용해서 세로 위치를 가운데로 맞췄고, `font-size`는 맥락에 맞게 유동적으로 대응할 수 있도록 `0.6em`으로 지정해 줬다. 글꼴에 따라 모양이 달라지는 걸 방지하기 위해 어디에나 있을 법한 영문 글꼴인 helvetica를 글꼴로 지정해 줬다.

자, 그러면 만든 것을 [데모 페이지][1]에서 감상하면 되겠다.

 [1]: http://dl.dropbox.com/u/15546257/code/js-open-target/js-open-target.html