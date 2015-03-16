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

## 원리 

원리는 이렇다. 

- 우선 A에 타이핑하는 것을 B에 옮긴다고 하자. 
- A에 포커스(`focus`)가 잡히는 순간 A와 B의 값을 저장한다(이를 원값이라고 부르자). 
- 그리고 `blur`(input 등에서 빠져나오는 것)나, `keyup` 이벤트가 발생할 때 A와 B의 원값을 검사한다. 
- B가 원래 빈 값이라면 그냥 무조건 복사한다. 
- B가 빈 값이 아니라면 A의 원값과 B의 원값이 같을 때만 복사한다. 무조건 동기화를 하면, B의 값을 A와 다르게 넣어 둔 경우 A의 값을 바꿀 때 B의 값이 의도와 다르게 바뀔 수 있기 때문이다. (만약 B의 값을 무조건 A와 같게 하고 싶다면 B에 `readonly` 속성을 주면 된다.

플러그인으로 만들어도 되겠지만 귀찮고, 초심자들에게는 플러그인 형태로 돼 있는 코드보다 함수 형태로 돼 있는 코드가 이해하기 쉽다고 생각해서 플러그인으로 만들진 않았다.

## 예제
    
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