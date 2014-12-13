---
title: "[PHP] 다가올 가장 가까운 평일을 구하기"
layout: "post"
category: "php"
tags: 
    - 코드 조각
---

오늘이 토요일인 경우 월요일을 구하고 싶다면? 예컨대, CMS 출금예정일을 생각해 보자. CMS 출금일이 25일인데 이 날이 토요일이라면 월요일 날짜를 구해서 출금 예정일이라고 알려 줘야 한다. 평일이라면 그냥 해당일을 리턴해 주고 말이다. 그럴 때 아래 함수를 사용하면 된다. 아, 물론 한국 명절이 적용되진 않는다. 딱 토일요일만 체크한다.

    function get_가까운_평일($date = null){
        if( ! $date){
            $date = date('Ymd');
        }
        return date('Ymd', strtotime($date . ' +0 Weekday'));
    }

`strtotime`은 잘 공부해 두면 쓸모가 많을 것 같다.
