---
title: '[mysql] 테이블 세 개 이상 outer join 하기'
author: 안형우
layout: post
permalink: /archives/132
aktt_notify_twitter:
  - yes
daumview_id:
  - 37197816
categories:
  - 서버단
tags:
  - MySQL
---
오늘 테이블을 세 개 이상 outer join 할 일이 생겼습니다.

google에서 검색을 해 보니 mysql outer join 3 tables 이라는 검색어가 자동완성기능으로 나왔습니다. 많은 사람들이 이걸 찾아 봤나 봅니다.

그래서 결국 발견했는데, 원문은 여기입니다 : <a href="http://www.experts-exchange.com/Databases/Mysql/Q_20829831.html" target="_blank">OUTER JOIN 2 (or more) tables at once</a>

뭐, 번역하면 &#8216;<a href="http://www.experts-exchange.com/Databases/Mysql/Q_20829831.html" target="_blank">한 번에 2개 (이상) OUTER JOIN 하기</a>&#8216; 정도 되겠네요.

코드는 아래와 같습니다.

<pre class="brush:sql">SELECT
transactions.ID,
transactions.ProdID,
transactions.RatePlan,
transactions.ServArea,
products.ID as prodID,
products.Name as prodName,
rateplans.ID as rateID,
rateplans.Name as rateName,
servarea.ID as servID,
servarea.Name as servName
FROM carts, transactions, products
/*----------------------------------------------*/
LEFT OUTER JOIN rateplans
ON rateplans.ID = transactions.RatePlan
LEFT OUTER JOIN servarea
ON servarea.ID = transactions.ServArea
/*----------------------------------------------*/
WHERE products.ID = transactions.ProdID
AND transactions.CartID = carts.ID
AND carts.ID = &#039;the cart id im tracking&#039;</pre>

핵심은 아래 코드입니다.

<pre class="brush:sql">LEFT OUTER JOIN rateplans
ON rateplans.ID = transactions.RatePlan
LEFT OUTER JOIN servarea
ON servarea.ID = transactions.ServArea</pre>

위 구문처럼 그냥 두 번 적어주면 되는 거였습니다.