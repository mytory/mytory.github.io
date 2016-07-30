---
title: '[jQuery] Select2 라이브러리 &#8211; 선택만이 아니라 입력도 할 수 있게 하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/9444
daumview_id:
  - 40670268
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
Select2 라이브러리는 매우 강력하고 쉽다.

우리는 Select2 라이브러리를 이용해서 셀렉트 박스와 hidden input을 Select2 UI로 만들 수 있다. 그런데 셀렉트 박스 형식으로 UI를 사용하는 경우, 새로운 입력을 하게 만드는 것이 기본으로 제공되지 않는다. 물론 tag 기능을 이용하면 쉽게 구현할 수 있다. 그러나 tag 기능을 이용하면 UI가 tag 모양으로 나온다. 셀렉트 박스 형식의 UI가 필요할 때는 사용할 수 없는 방법이다.

따라서 다음 설명은 tag 기능을 이용하지 않고 셀렉트 박스 형식의 UI로 새로운 입력을 가능하게 하는 방법이다.

이렇게 만들 수 있다.

<img class="alignnone" alt="" src="/uploads/legacy/select2-input.png" width="131" height="124" />

## HTML

<pre>&lt;input type="hidden" name="email_server" 
    data-list='[{"id":"hanmail.net","text":"hanmail.net"}, {"id":"gmail.com","text":"gmail.com"}, {"id":"naver.com","text":"naver.com"}, {"id":"hotmail.com","text":"hotmail.com"}]'
    data-default-value='{"id":"left21.com","text":"left21.com"}'
    id="email_server" class="select2-input"&gt;</pre>

## JS

<pre>// 선택할 뿐 아니라 입력도 할 수 있는 select2. input[hidden]이어야 하고, data-liat 요소가 있어야 한다.
// default값을 지정하고 싶으면 data-default-value를 요소에 넣어 주면 된다.
$("input.select2-input").each(function(){
  try{
    var $this = $(this);
    var list = $this.data('list');
    var default_value = $this.data('default-value');
    var option = { 
      data: list,
      createSearchChoice: function (term){
        return {id: term, text: term};
      },
      initSelection: function (element, callback) {
            callback(default_value);
        }
    };

    $this.select2(option);

    // 기본값이 있다면 설정.
    if(default_value){
      $this.select2('val', default_value);
    }
  }catch(e){

  }
});</pre>

`try`, `catch` 구문은 `query function not defined for Select2 undefined` 라는 에러 메시지가 파이어폭스에서 나오면서 js 작동이 중지되는 것때문에 집어 넣은 것이다.