---
title: javascript Date 오브젝트 활용법
author: 안형우
layout: post
permalink: /archives/79
aktt_notify_twitter:
  - yes
daumview_id:
  - 37235093
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
다음과 같이 사용한다.

<pre class="brush: jscript;" title="code">var date = new Date(); 
//일단 이렇게 하면 date 객체에는 현재 날짜시각이 들어간다.
var 연도 = date.getFullYear();
//연도를 2009처럼 풀 연도로 구한다.
var 축약연도 = date.getYear();
//이렇게 하면 2009년은 109라고 나온다.
var 달_컴터용 = date.getMonth();
//이렇게 하면 1월부터 12월 사이가 0~11 숫자로 나온다.
var 달_인간용 = parseInt(date.getMonth())+1;
//그래서 인간용으로 하려면 아래처럼 해야 한다.
var 날 = date.getDate();

//20091026 형식으로 뽑으려면 아래처럼 한다.
var 오늘날짜 = 연도 + 달_인간용.toString() + 날

//달.toString을 한 이유는, 변수 '달_인간용'에 들어있는 자료형이 int기 때문이다. 자바 스크립트는 유연한 자료형을 사용하는데, 애초에 var a = "1" 이런 식으로 줘도 a+1을 을 연산하라고 하면 2를 반환한다. 그래서 숫자를 문자로 인식시키려면 a+''+1 이런 식으로 써줘서 중간에 문자형을 하나 넣어 주던가, 아니면 a.toString() 이런 식으로 문자형으로 명시를 해줘야 한다.

alert(오늘날짜);
//이러면 오늘날짜가 20091026 형식으로 alert창에 뜬다.</pre>

시간은 다음처럼 얻는다.

<pre class="brush: jscript;" title="code">var 시=today.getHours();
var 분=today.getMinutes();
var 초=today.getSeconds();
// 한자리수일 경우 앞에 0을 추가하기 위해 아래처럼 처리한다.
분=checkTime(분);
초=checkTime(초);
alert('현재시각 _ '+시+':'+분+':'+초);</pre>

## 날짜 세팅 방법

다음, 다른 형태들을 알아보자.

꼭 오늘 날짜만 사용하는 경우만 있는 건 아닐 터, 다른 날짜로 세팅해서 사용하는 방법을 알아 보자. 이 부분은 W3C School의 <a href="http://www.w3schools.com/JS/js_obj_date.asp" target="_blank">JavaScript Date Object</a> 부분을 참고했으며, 예문은 그대로 가져왔다.

2010년 1월 14일로 날짜를 세팅하려면 다음과 같이 해 준다.

<pre class="brush: jscript;" title="code">var myDate=new Date();
myDate.setFullYear(2010,0,14);
//달을 쓸 때는 컴퓨터가 알아먹을 수 있게 해 줘야 한다. 1월은 0, 12월은 11 이런 식이다. 즉, 인간이 알아먹는 달에서 -1을 해 줘야 한다.</pre>

5일 뒤로 세팅을 해 보자.

<pre class="brush: jscript;" title="code">var myDate=new Date();
myDate.setDate(myDate.getDate()+5);</pre>

연월을 자동으로 계산해서 올바른 날짜를 반환해 준다. 아주 좋다.

## 다양한 날짜 형태 반환

별로 유용하지는 않지만 Object를 곧장 사용하면 이렇게 된다.

<pre class="brush: jscript;" title="code">document.write(Date());
//결과 : Mon Oct 26 2009 14:24:38 GMT+0900 (Japan Standard Time)</pre>

toUTCString() 메서드도 사용할 수 있는데, 결과를 보자.

<pre class="brush: jscript;" title="code">var d=new Date();
document.write(d.toUTCString());
//결과 : Mon, 26 Oct 2009 05:24:19 GMT</pre>

게중 유용한 것은 유닉스 타임스탬프값 반환일 듯하다.

<pre class="brush: jscript;" title="code">var d=new Date();
document.write("1970년 1월 1일 이후 "+d.getTime()+"초 지났다.");
//결과 : 1970년 1월 1일 이후 1256534643100초 지났다.</pre>

유닉스 타임스탬프는 1970년 1월 1일 이후 몇 초가 지났는지 찍어주는 것인데, 컴퓨터에서 날짜계산을 할 때 기본으로 사용하는 값이다. 예컨대, <a title="PHP date()함수 로직" href="http://mytory.textcube.com/entry/php-date%ED%95%A8%EC%88%98-%EB%A1%9C%EC%A7%81" target="_blank">php는 원하는 날짜를 세팅할 때 유닉스 타임스탬프가 있으면 편하다.</a>

## 응용 : 시계 달기

시계를 표시하는 함수는 다음과 같다.

<pre class="brush: jscript;" title="code">&lt;html&gt;
&lt;head&gt;
&lt;script type="text/javascript"&gt;
function startTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// 한자리수일 경우 앞에 0을 추가한다.
m=checkTime(m);
s=checkTime(s);
document.getElementById('txt').innerHTML=h+":"+m+":"+s;
t=setTimeout('startTime()',500);
}

function checkTime(i)
{
if (i&lt;10)
  {
  i="0" + i;
  }
return i;
}
&lt;/script&gt;
&lt;/head&gt;

&lt;body onload="startTime()"&gt;
&lt;div id="txt"&gt;&lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>

추가로, <a href="http://www.w3schools.com/jsref/jsref_obj_date.asp" target="_blank">Date() 객체의 API</a>를 참고하면 더 많은 정보를 얻을 수 있다.