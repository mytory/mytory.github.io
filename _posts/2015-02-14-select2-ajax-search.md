---
title: "select2 ajax search code snippet"
layout: "post"
category: "html-css-js"
tags: 
    - jquery
---

그냥 코드 보관용 포스트. [select2](https://select2.github.io/)는 내가 본 것 중에 가장 괜찮은 jQuery 자동완성 플러그인이다. 기본적으로는 select 박스에 적용하면 바로 자동완성으로 바꿔주니 아주 간편하게 사용할 수 있다. `$('select').select2()` 하는 식으로 말이다. 물론 모든 `select` 태그에 적용해 버리는 짓을 하면 안 된다. 알아먹기 쉬우라고 저렇게 적은 거다.

이 select2로 ajax 자동완성도 가능한데, 이 코드는 그 예제 코드다. 만들었다가 사용하지 않게 됐는데, 버리기 아까워서 보관. select2 버전은 3.5.2 기반이다. 지금 4.0 베타가 나와 있는데, 거기선 작동 안 할 지도 모른다.

    $('#모델명').select2({
        placeholder: '모델명 입력',
        minimumInputLength: 2,
        formatInputTooShort: function (input, min) { var n = min - input.length; return n + "글자 이상 더 입력하시면 검색합니다."; },
        ajax: {
            url: 'ajax/models.php',
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    q: term // search term
                }
            },
            results: function (data, page) {
                return { results: data };
            },
            cache: true
        },
        initSelection: function($el, callback){
            callback({
                id: $el.val(),
                text: $el.val()
            });
        },
        formatSearching: function(){ return '검색중...'; }
    });