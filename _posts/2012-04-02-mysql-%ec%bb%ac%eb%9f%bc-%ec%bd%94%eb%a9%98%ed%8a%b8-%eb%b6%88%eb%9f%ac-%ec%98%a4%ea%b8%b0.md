---
title: '[MySql] 컬럼 코멘트 불러 오기'
author: 안형우
layout: post
permalink: /archives/2395
aktt_notify_twitter:
  - yes
daumview_id:
  - 36612129
categories:
  - 서버단
tags:
  - MySQL
---
<pre class="brush: sql; gutter: true; first-line: 1">SELECT `COLUMN_COMMENT` FROM information_schema.COLUMNS WHERE `TABLE_NAME` = &#039;person&#039; AND `COLUMN_NAME` = &#039;mobilephone1&#039;;</pre>

MySql 5부터 컬럼에 코멘트를 달 수 있게 됐다. 이 코멘트를 활용하면 영문 컬럼명의 한계를 극복할 수 있을 것 같았다. 그래서 영문 컬럼명을 한글로 번역한 것을 Comment에 넣었다.

자, 그러면 어떻게 불러올까? 맨 앞에 써 놓은 것처럼 sql문을 날리면 컬럼 코멘트를 불러 온다.