---
title: "[jQuery 코드조각] 두 input의 내용을 동기화"
layout: "post"
category: "html-css-js"
tags: 
    - jquery
---

뭐 별 거 없고 그냥 이런 거다.

	function init_sync_to(){
	    $('.js-sync-to').on('keyup change blur', function(){
			var selector = $(this).data('sync-to');
			var $sync_to_target = $(selector);
			var value = $(this).val();

			// 동기화할 대상의 값이 비어있거나 현재 값과 같은 경우에만 동기화한다.
			if($sync_to_target.val() == '' || $sync_to_target.val() == value){
				$sync_to_target.val(value);
			}
			if(typeof $sync_to_target.select2('val') == 'string'){
				// select2라면.
				$sync_to_target.select2('val', value);
			}
		});
	}

html은, class를 `js-sync-to`로 주고 `data-sync-to='.target-class-name'` 식으로 주면 된다.