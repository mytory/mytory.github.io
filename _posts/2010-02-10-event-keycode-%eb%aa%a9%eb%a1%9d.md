---
title: event.keyCode 목록
author: 안형우
layout: post
permalink: /archives/265
aktt_notify_twitter:
  - yes
daumview_id:
  - 37101811
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
<span style="color: #ff0000;">주의사항 : key</span>**<span style="color: #ff0000;">c</span>**<span style="color: #ff0000;">ode 아니다. key</span>**<span style="color: #ff0000;">C</span>**<span style="color: #ff0000;">ode다.</span>

그리고 재밌는 곳을 발견했다. <a href="http://api.jquery.com/event.which/" target="_blank">jquery의 event 객체의 which 가 뭔지 설명하는 API 페이지의 Demo</a>다. 여기서는 키보드를 입력하면 키코드를 반환해 준다. 키코드를 빨리 찾고 싶을 때 사용하면 되겠다.

이 페이지에서도 사용할 수 있도록 만들어 뒀다.

<fieldset>
  <legend>키보드로 치면 키코드가 나옵니다</legend> <p>
    <input id="whichkey" style="border: 1px solid #dddddd;" type="text" value="아무거나 쳐보세요" />
  </p>
  
  <p id="log" style="background: #000000 none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous; padding: 10px; color: #fff; font-weight: border;">
    여기에 keyCode가 나옵니다.
  </p>
</fieldset>



<pre class="brush:js">←(백스패이스) = 8
TAB = 9
ENTER = 13
SHIFT = 16
CTRL = 17
ALT = 18
PAUSEBREAK = 19
CAPSLOOK = 20
한/영 = 21
한자 = 25
ESC = 27

스패이스 = 32
PAGEUP = 33
PAGEDN = 34
END = 35
HOME =36

←(중간) = 37
↑(중간) = 38
→(중간) = 39
↓(중간) = 40

0 = 48
1 = 49
2 = 50
3 = 51
4 = 52
5 = 53
6 = 54
7 = 55
8 = 56
9 = 57
INSERT = 45
DELETE = 46

A = 65
B = 66
C = 67
D = 68
E = 69
F = 70
G = 71
H = 72
I = 73
J = 74
K = 75
L = 76
M = 77
N = 78
O = 79
P = 80
Q = 81
R = 82
S = 83
T = 84
U = 85
V = 86
W = 87
X = 88
Y = 89
Z = 90

윈도우(왼쪽) = 91
윈도우(오른쪽) = 92
기능키 = 93
0(오른쪽) = 96
1(오른쪽) = 97
2(오른쪽) = 98
3(오른쪽) = 99
4(오른쪽) = 100
5(오른쪽) = 101
6(오른쪽) = 102
7(오른쪽) = 103
8(오른쪽) = 104
9(오른쪽) = 105
.(오른쪽) = 110
/(오른쪽) = 111
*(오른쪽) = 106
+(오른쪽) = 107
-(오른쪽) = 109
F1 = 112
F2 = 113
F3 = 114
F4 = 115
F5 = 116
F6 = 117
F7 = 118
F8 = 119
F9 = 120
F10 = 121
F11 = 122
F12 = 123
NUMLOCK = 144
SCROLLLOCK = 145
=(중간) = 187
-(중간) = 189
`(왼쪽콤마) = 192
(중간) = 220</pre>