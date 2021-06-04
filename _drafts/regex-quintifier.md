https://docs.oracle.com/javase/tutorial/essential/regex/quant.html php 버전.


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