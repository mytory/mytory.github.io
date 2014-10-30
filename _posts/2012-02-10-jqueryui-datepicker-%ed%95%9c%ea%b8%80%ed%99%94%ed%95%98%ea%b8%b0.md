---
title: '[jQueryUI] datepicker 한글화하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2217
aktt_notify_twitter:
  - yes
daumview_id:
  - 36629074
mytory_md_path:
  - 
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
<pre class="brush: javascript; gutter: true; first-line: 1">jQuery(function($) {
    $.datepicker.regional['ko'] = {
        closeText : '닫기',
        prevText : '이전달',
        nextText : '다음달',
        currentText : '오늘',
        monthNames : ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort : ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames : ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort : ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin : ['일', '월', '화', '수', '목', '금', '토'],
        weekHeader : 'Wk',
        dateFormat : 'yy-mm-dd',
        firstDay : 0,
        isRTL : false,
        showMonthAfterYear : true,
        yearSuffix : '년'
    };
    $.datepicker.setDefaults($.datepicker.regional['ko']);
});</pre>

<p class="brush: javascript; gutter: true; first-line: 1">
  이건 내가 만든 게 아니다. jQuery UI 패키지를 다운받으면 development-bundle/ui/i18n 폴더에 jquery.ui.datepicker-ko.js 라는 파일이 있다. 거기에서 월 뒤에 있는 영어만 제거한 것이다.
</p>

<p class="brush: javascript; gutter: true; first-line: 1">
  위 코드를 긁어서 파일을 만들고 script src 로 페이지에 삽입하면 된다. 너무 당연한 말이지만, jqueryui를 넣은 곳 뒤에 넣어야 한다.
</p>

그냥 간편하게 아래처럼 할 수도 있다.

<pre>var day_names = ['일', '월', '화', '수', '목', '금', '토'],
    mon_names = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
    opts = {
        dateFormat: 'yy-mm-dd',
        constrainInput:  true,
        dayNames:        day_names,
        dayNamesShort:   day_names,
        dayNamesMin:     day_names,
        monthNames:      mon_names,
        monthNamesShort: mon_names,
        monthNamesMin:   mon_names,
        constrainInput:  true,
        showMonthAfterYear: true,
        yearSuffix: "",
        changeMonth: true
    };

$('.js-datepicker').datepicker(opts);</pre>