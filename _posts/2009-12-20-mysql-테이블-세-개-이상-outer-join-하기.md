---
title: '[mysql] 테이블 세 개 이상 outer join 하기'
author: 안형우
layout: post
permalink: /archives/132
categories:
  - 서버단
tags:
  - MySQL
---
오늘 테이블을 세 개 이상 outer join 할 일이 생겼다.

google에서 검색을 해 보니 mysql outer join 3 tables 이라는 검색어가 자동완성기능으로 나왔다. 많은 사람들이 이걸 찾아 봤나 보다.

아래처럼 그냥 조인 구문을 두 번 써 주면 되는 것이었다.

``` sql
LEFT OUTER JOIN rateplans
	ON rateplans.ID = transactions.RatePlan
LEFT OUTER JOIN servarea
	ON servarea.ID = transactions.ServArea
```

전체 쿼리는 아래와 같다.

``` sql
SELECT transactions.ID,
       transactions.ProdID,
       transactions.RatePlan,
       transactions.ServArea,
       products.ID AS prodID,
       products.Name AS prodName,
       rateplans.ID AS rateID,
       rateplans.Name AS rateName,
       servarea.ID AS servID,
       servarea.Name AS servName
FROM carts,
     transactions,
     products
LEFT OUTER JOIN rateplans ON rateplans.ID = transactions.RatePlan
LEFT OUTER JOIN servarea ON servarea.ID = transactions.ServArea
WHERE products.ID = transactions.ProdID
  AND transactions.CartID = carts.ID
  AND carts.ID = 'the cart id im tracking'
```

참고: [OUTER JOIN 2 (or more) tables at once][1]

[1]: http://www.experts-exchange.com/Databases/Mysql/Q_20829831.html