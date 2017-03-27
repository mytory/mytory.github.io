---
title: PHP 배열, 자바스크립트의 push 같은 건 없나?
author: 안형우
layout: post
permalink: /archives/377
aktt_notify_twitter:
  - yes
daumview_id:
  - 37013974
categories:
  - 서버단
tags:
  - PHP
---
다 적고 나니 아즈키 님이 <a href="http://php.net/manual/en/function.array-push.php" target="_blank">array_push()라는 함수</a>가 있다고 알려 주셨다. 찾아보니 있다. 이럴 수가!e

내용에 보니 엘리먼트 하나만 넣을 때는 $array[] = 1; 방식을 사용하는 게 낫다고 한다. 함수 호출로 인한 오버헤드(대충 부하/부담 정도로 생각하면 되겠다. 구글 사전은 오버해드 타임을 &#8216;【컴퓨터】 오버헤드 타임 《operating system의 제어 프로그램이 컴퓨터를 사용하는 시간》&#8217;이라고 해설했다. 그러면 좀 이해가 갈 것 같다.)가 없기 때문이란다.(아마도 맞는 번역이지 싶은데 틀렸다면 지적 바란다.)

> **Note**: If you use **array_push()** to add one element to the array it&#8217;s better to use $array[] = because in that way there is no overhead of calling a function.

또 다른 주의사항도 있는데 번역 안 된다. 첫 번째 요소가 배열이 아니면 경고가 뜬다는 거 같은데;;

> **Note**: **array_push()** will raise a warning if the first argument is not an array. This differs from the $var[] behaviour where a new array is created.  
> 괴발개발 번역 : array_push()는 만약 첫 번째 인자가 배열이 아니라면 경고를 띄운다. $var[]에서 새 배열이 생겼을 때 일어나는 일과 차이가 있다.(자신없는 번역;; 옳은 번역을 아는 분은 댓글을)

예제는 PHP 공식 사이트에서 긁어 왔다.

<pre class="brush:php">$stack = array("orange", "banana");
array_push($stack, "apple", "raspberry");
print_r($stack);
//결과는 
//Array
//(
//    [0] =&gt; orange
//    [1] =&gt; banana
//    [2] =&gt; apple
//    [3] =&gt; raspberry
//)
</pre>

## 그 외 배열 함수

이 외에 다음 함수들도 볼 만하다.

<a href="http://www.php.net/manual/en/function.array-pop.php" target="_blank">array_pop()</a> : 배열 요소 중 맨 뒤에 있는 놈을 튕겨 낸다. 인자로 들어간 배열에서는 그 놈이 없어지고, 그놈이 리턴돼서 튀어나온다. $a = array_pop($b)라면, $b에서는 인자가 사라지고 $a는 그 인자가 된다는 말.

<a href="http://www.php.net/manual/en/function.array-shift.php" target="_blank">array_shift()</a> : pop과 같고, 다만 맨 앞에 있는 놈을 처리하는 것 같다.

<a href="http://www.php.net/manual/en/function.array-unshift.php" target="_blank">array_unshift()</a> : array_unshift($queue, &#8220;apple&#8221;, &#8220;raspberry&#8221;); 이렇게 쓰면 $queue 배열 0,1번으로 apple과 raspberry가 들어간다.

배열은 나에게 친숙하지 않다. 오늘 아즈키님 덕에 바쁜 시간 쪼개서 배열 공부를 할 수 있었다. ㅋ

*아래 설명도, 위에서 내가 한 번역이 맞다면 필요한 것이니 읽기 바란다.

## $a[]=&#8217;배열 새 요소&#8217; 방식

php 배열 설명을 보면 흔히 책에서는

<pre class="brush:php">$array = array(1,2,3,4,5)</pre>

식으로 설명해 놓는다.

추가적으로 설명하는 것은 대부분 연관배열이다. key갖는 배열이다.

<pre class="brush:php">$arr = array(&#039;a&#039; =&gt; 1, &#039;b&#039; =&gt; 2);</pre>

이런 거다.

위 처럼 사용하면 $arr[a]에서 1이 호출되고, $arr[b]에서 2가 호출된다.

근데 자바스크립트에서는 일단 배열을 만들고 나서 <a target="_blank" href="http://mytory.textcube.com/entry/javascript-%EB%B0%B0%EC%97%B4%EC%97%90-%EC%83%88-%EC%9A%94%EC%86%8C-%EC%B6%94%EA%B0%80%ED%95%98%EA%B8%B0">배열.push(a)</a> 식으로 쓰면 배열이 추가된다. PHP엔 그런 게 없을까? 있다.

아래 코드를 보자.

<pre class="brush:php">$arr = array();
$arr[] = 1;
$arr[] = 2;
$arr[] = 3;
$arr[] = 4;
echo $arr[2];
//결과는 3
</pre>

이해가 갈 것이다. 그냥 $arr[]에 넣으면 된다. 그럼 알아서 뒤쪽에 가서 붙는다.

PHP 사이트의 Arrays 설명에는 아래 예제가 나와 있다. 번역은 내가 대충 했다.

<pre class="brush:php">$arr = array(5 =&gt; 1, 12 =&gt; 2);

$arr[] = 56;    // 여기서 이렇게 쓰면
                //  $arr[13] = 56; 와 같은 명령이다.

$arr["x"] = 42; // 배열의 키 x에 
                // 새 요소를 추가
                
unset($arr[5]); // 배열에서 요소를 제거

unset($arr);    // 배열 전체를 제거
</pre>

이 예제에선 재밌는 게 있다. 3번 줄이다. $arr[]에 넣었더니 $arr[13]에 들어갔다. 즉, $arr[5]와 $arr[12]밖에 없는 경우에도 무조건 제일 뒤에 가서 붙는다는 거다.

위 예제를 보고 위쪽 코드를 짜봤더니 잘 되서 적었다.

나는 배열을 처음부터 생성할 일이 별로 없는데, 이런 설명이 없어서 답답했다. 알게 된 김에 다른 사람들도 보면 도움될 수 있을 것 같아 적었다.