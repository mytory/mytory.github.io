---
title: 'QueryDSL에서 Inner Join하기'
layout: post
tags: 
    - Web Development
    - JAVA
description: 그냥 .from()을 두 번 하면 된다.
---

QueryDSL에서 join하는 법을 찾다가 엄청 헤맸는데, 결국 [문서에서 실마리][doc]를 찾을 수 있었다. QueryDSL이 HQL 쿼리를 타입에 무관한 방법으로 사용하기 위해 만들어졌다는 것을 알 수 있었고, 그래서 HQL 문법을 뒤져 보고 알았다. HQL에서는 `inner join`을 사용할 때 그냥 `from a, b` 하고 쓰는 것이다.

그래서 QueryDSL에서도 inner 조인은 아래와 같은 방식으로 사용하면 된다. 3째줄과 5-7째 줄을 보면 되는데, 그냥 `.from`을 두 번 써 줬다.

~~~ java
JPAQuery<?> query = new JPAQuery<Void>(entityManager);
QPayment qPayment = QPayment.payment;
query.from(qPayment);
QCompany qCompany = QCompany.company;
query.from(qCompany)
    .where(qPayment.companyId.eq(qCompany.companyId))
    .where(qCompany.companyNm.contains(q));
List<Payment> paymentList = (List<Payment>) query.fetch();
~~~

[doc]: http://www.querydsl.com/static/querydsl/4.4.0/reference/html_single/#d0e87
[1]: https://www.marcobehler.com/guides/java-databases