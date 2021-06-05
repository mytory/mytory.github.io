https://docs.oracle.com/javase/tutorial/essential/regex/quant.html php 버전.

정규식의 수량사(Quantifier)

greedy
reluctant
possessive


모든 수량사는 문자 a를 찾았다. 하지만 앞의 두 수량사는 또한 인덱스 1에서 길이 0의 검색결과를 찾았다. 이것은 입력 문자열의 마지막 문자열 뒤에 있는 것이다.

각 수량사는 찾는 놈이 아닌 놈을 만났을 때 동작이 달라진다.

ababaaaab

b가 1,3,8번 인덱스에 있다. greedy, reluctant 수량사는 b가 있는 인덱스에서 길이 0 일치를 출력한다. 특별히 b를 찾은 건 아니다. 단지 문자 a의 존재를 찾는다. a의 일치가 0번 일어나는 것을 허용하는 수량사라면, a가 아닌 입력값은 무엇이든 길이 0 일치(zero-length)를 보여 준다. 남은 a들은 앞서 말한 규칙에 따라 검색된다.

greedy 수량사는 첫 검색 전에 모든 입력 문자열을 읽어들이도록 강제한다. 첫 번째 일치 탐색 시도가 실패하면, 탐색자는 한 글자씩 뱉어내고 일치가 발견되거나 뱉어낼 글자가 남아있지 않게 될 때까지 반복하며 다시 시도한다. 정규식에 사용된 수량사에 따라 최후의 일치 탐색 시도는 1글자 또는 0글자에 대한 것이 될 것이다.

reluctant 수량사는 그러나 반대 접근법을 취한다. 입력값의 처음부터 시작한다. 그리고 나서 한 번에 한 글자씩 살펴 본다. 이 수량사가 마지막에 시도하는 것은 전체 입력 문자열이다.

마지막으로, possessive 수량사는 언제나 전체 입력 문자열을 살펴 본다. 일치 탐색을 한 번 (정말로 딱 한 번) 시도하면서 말이다. greedy와 달리 possessive는 뱉어내지 않는다. 그렇게 하는 것이 전체 탐색을 성공적으로 허용하는 것이라 해도 말이다.



```php
$target = "ababaaaab";
$patterns = ['/a?/', '/a*/', '/a+/'];
foreach ($patterns as $pattern) {
preg_match_all($pattern . '', $target, $matches, PREG_OFFSET_CAPTURE); 
print_r($matches);
}



$targets = ["aa","aaa","aaaa","aaaaaaaaa"];
$pattern = '/a{3,6}/';
foreach ($targets as $target) {
preg_match_all($pattern . '', $target, $matches, PREG_OFFSET_CAPTURE); 
print_r($matches);
}



$target = "dogdogdogdogdogdog";
$patterns = ['/(dog){3}/', '/dog{3}/'];
foreach ($patterns as $pattern) {
preg_match_all($pattern . '', $target, $matches, PREG_OFFSET_CAPTURE); 
print_r($matches);
}



$target = "abccabaaaccbbbc";
$patterns = ['/[abc]{3}/', '/abc{3}/'];
foreach ($patterns as $pattern) {
preg_match_all($pattern . '', $target, $matches, PREG_OFFSET_CAPTURE); 
print_r($matches);
}



$target = "xfooxxxxxxfoo";
$patterns = ['/.*x/','/.*?x/','/.*+x/',];
foreach ($patterns as $pattern) {
preg_match_all($pattern . '', $target, $matches, PREG_OFFSET_CAPTURE); 
print_r($matches);
}
```