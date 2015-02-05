---
title: "jQuery Simple Filter"
layout: "post"
category: "html-css-js"
tags: 
    - javascript
    - jQuery
---

테이블에서 간단한 검색을 하는 건 js로 하는 게 구현하기 간편하다. 물론 자료 량이 많아지면 그냥 서버단 검색을 붙이는 게 좋다.

간단하게 활용할 용도로 만든 코드다.

js funciton 코드는 다음과 같고, 문서다 모두 로드된 뒤 `init_simple_filter()`를 실행하면 된다.

	function init_simple_filter(){
	    var $container = $('.js-simple-filter');
	    var $keyword_inputs = $container.find('.js-keyword');
	    var $submit_button = $container.find('.js-submit');
	    var target_selector = $container.data('target-selector');
	    $keyword_inputs.on('keyup change blur', function(e){
	        e.preventDefault();
	        $submit_button.click();
	    });
	    $submit_button.click(function(){
	        $(target_selector).show();
	        $keyword_inputs.each(function(index, el){
	            var string_find_selector;
	            var keyword = $(el).val().toLowerCase();
	            if( ! keyword){
	                return true;
	            }
	            string_find_selector = $(el).data('string-find-selector');
	            $(el).val().toLowerCase();
	            $(target_selector).each(function(){
	                var string = $(this).find(string_find_selector).text().toLowerCase();
	                if(string.indexOf(keyword) == -1){
	                    $(this).hide();
	                }
	            });
	        });
	    });
	}

HTML 코드 예제는 아래와 같다.

	<div class="js-simple-filter" data-target-selector=".js-filter-table tbody tr">
		검색:
        <label style="margin-right: 1em;">
            모델명
            <input type="text" class="js-keyword" data-string-find-selector=".js-model-name, .js-petname"/>
        </label>
        <label style="margin-right: 1em;">
            통신사
            <select class="js-keyword" data-string-find-selector=".js-통신사">
                <option value="">전체</option>
                <option value="SKT">SKT</option>
                <option value="KT">KT</option>
            </select>
        </label>
    </div>

	<table class="js-filter-table">
		<thead> ... </thead>
		<tbody>
			<tr>
				<td class='js-model-name'>AIP-16</td>
				<td class='js-pet-name'>아이폰</td>
				<td class='js-통신사'>KT</td>
			</tr>
			...
		</tbody>
	</table>

뭐 적당히 옮겼다. 그대로 해서 될지 안 될지는 모르겠으나 이정도면 충분하다고 본다. js 코드에 에러는 없다. 예제가 안 돌아간다면 HTML 문제다.