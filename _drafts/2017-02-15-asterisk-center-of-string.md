---
title: [PHP] 문자열 가운데 별표치는 함수
layout: post
author: 안형우
tags: 
  - php
  - snippet
---

~~~ php
function mytory_asterisk($string) {
    $string = trim($string);
    $length = mb_strlen($string, 'utf-8');
    $string_changed = $string;
    if ($length <= 2) {
        // 한 글자면 그냥 뒤에 별표 붙여서 내보낸다.
        $string_changed = mb_substr($string, 0, 1, 'utf-8') . '*';
    }
    if ($length >= 3) {
        // 3으로 나눠서 앞뒤.
        $leave_length = floor($length/3);
        $asterisk_length = $length - ($leave_length * 2);
        $offset = $leave_length + $asterisk_length;
        $head = mb_substr($string, 0, $leave_length, 'utf-8');
        $tail = mb_substr($string, $offset, $leave_length, 'utf-8');
        $string_changed = $head . implode('', array_fill(0, $asterisk_length, '*')) . $tail;
    }
    return $string_changed;
}

$test_array = [
    '야',
    '김호',
    '홍길동',
    '제갈공명',
    '아싸가오리',
    '남행열차를타',
    '자떠나자동해로',
    '자떠나자동해바다',
    '자떠나자동해바다로',
];

foreach ($test_array as $test_string) {
    echo $test_string . PHP_EOL;
    echo mytory_asterisk($test_string) . PHP_EOL;
}
