---
title: "[jQuery 코드조각] 두 input의 내용을 동기화"
layout: "post"
category: "html-css-js"
tags: 
    - jquery
    - snippet
---

뭐 별 거 없고 그냥 이런 거다.

    function init_sync_to(){
        $('.js-sync-to').on('focus', function(){
            var selector = $(this).data('sync-to');
            var $sync_to_target = $(selector);
            $(this).data('original-value', $(this).val());
            $sync_to_target.data('original-value', $sync_to_target.val());
        });
        $('.js-sync-to').on('blur keyup', function(){
            var selector = $(this).data('sync-to');
            var $sync_to_target = $(selector);
            var value = $(this).val();
            var original_value = $(this).data('original-value');
            var target_original_value = $sync_to_target.data('original-value');
            // 동기화할 대상의 값이 비어있거나 현재 값과 같은 경우에만 동기화한다.
            if(target_original_value == '' || original_value == target_original_value){
                $sync_to_target.val(value);
            }
            // select2라면.
            if(typeof $.fn.select2 == 'function'){
                $sync_to_target.select2('val', value);
            }
        });
    }

html은, class를 `js-sync-to`로 주고 `data-sync-to='.target-class-name'` 식으로 주면 된다.

    <label>source: <input type="text" class="js-sync-to" data-sync-to=".js-sync-target"></label>
    <label>target: <input type="text" class="js-sync-target"></label>
    
물론 jQuery를 넣어야 한다. 아래는 예제.

<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<label>source: <input type="text" class="js-sync-to" data-sync-to=".js-sync-target"></label>
<label>target: <input type="text" class="js-sync-target"></label>
<script>
	function init_sync_to(){
        $('.js-sync-to').on('focus', function(){
            var selector = $(this).data('sync-to');
            var $sync_to_target = $(selector);
            $(this).data('original-value', $(this).val());
            $sync_to_target.data('original-value', $sync_to_target.val());
        });
        $('.js-sync-to').on('blur keyup', function(){
            var selector = $(this).data('sync-to');
            var $sync_to_target = $(selector);
            var value = $(this).val();
            var original_value = $(this).data('original-value');
            var target_original_value = $sync_to_target.data('original-value');
            // 동기화할 대상의 값이 비어있거나 현재 값과 같은 경우에만 동기화한다.
            if(target_original_value == '' || original_value == target_original_value){
                $sync_to_target.val(value);
            }
            // select2라면.
            if(typeof $.fn.select2 == 'function'){
                $sync_to_target.select2('val', value);
            }
        });
    }
    init_sync_to();
</script>