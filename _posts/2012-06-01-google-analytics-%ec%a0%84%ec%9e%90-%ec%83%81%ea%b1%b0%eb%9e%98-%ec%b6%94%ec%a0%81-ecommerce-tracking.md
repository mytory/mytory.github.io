---
title: '[Google Analytics] 전자 상거래 추적 Ecommerce Tracking'
author: 안형우
layout: post
permalink: /archives/2503
aktt_notify_twitter:
  - yes
daumview_id:
  - 36603568
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
구글 아날리틱스에서 실제로 어떤 방문자가 얼마의 수익을 발생시켰는지 확인할 수 있다는 것을 알고 놀랐다. 뭔가를 잘 사용하려면 매뉴얼을 충실히 봐야 한다. 그래서 번역을 결정했다. 원문은 [Ecommerce Tracking][1]이다. 아래부터 번역 시작.

&#8212;&#8212;

구글 아날리틱스가 웹사이트의 전자 상거래 활동을 리포트할 수 있게 하려면, 프로필 세팅 페이지에서 전자 상거래 추적을 활성화해야 한다. [Google Analytics  최신 버전의 경우, **관리(우측 상단) > 프로필 > 프로필 설정 탭 > 전자상거래 설정** 선택 - 녹풍] 그리고 나서, 장바구니 페이지나 전자상거래 소프트웨어에 `ga.js` 전자 상거래 추적 메서드를 구현해야 한다. 상거래가 일어났을 때, 전자 상거래 메서드 집합은 함께 작동해서 사용자 각각의 트랜잭션 정보[뒤의 설명 참고 - 녹풍]를 구글 아날리틱스의 데이터베이스에 보내는 일을 한다. 이런 방식으로 아날리틱스는 전환이나 구매를  특정 추천(referral) 경로와  연결할 수 있다. 대부분의 템플릿 방식 전자 상거래 엔진은 주문 완료 페이지에 이 코드를 보이지 않게 넣을 수 있다.

[트랜잭션이란 낱낱의 행위가 모여서 하나의 구성을 이루는 단위를 이르는 말이다. 예를 들면 '결제하기' 버튼을 누른 뒤, 실제 결제를 하지 않으면 '결제하기' 버튼을 누른 행위는 무의미하다. **몇 개의 아이템을 장바구니에 담는다 > 결제하기 버튼 클릭 > 배송 정보 입력 > 결제 정보 입력 > 결제 완료**에 이르는 과정을 '결제'라고 할 텐데, 이 과정을 바로 하나의 트랜잭션이라고 부른다. - 녹풍]

1.  일반적 처리 과정
2.  가이드라인
3.  완성 예제

## 일반적 처리 과정(General Process) {#General}

구글 아날리틱스의 전자 상거래 추적 기본 처리 과정은 세 가지 메서드로 요약된다. 이 메서드들은 사이트에서 전자 상거래 트랜잭션을 추적하는 데 필수적인 것들이다. 이 메서드들은 주문에서 설명된다. 이 메서드들은 장바구니나 전자 상거래 소프트웨어에서 불러와야 한다.

1.  **트랜잭션 객체를 만든다 **[`_addTrans()`][2] 메서드를 사용해 트랜잭션 객체를 초기화(intialize)한다. 트랜잭션 객체는 단일 트랜잭션에 관련된 모든 정보를 저장한다. 예를 들면, 주문번호(order ID), 배송료, 청구서 수신 주소 같은 것들이 있다. 트랜잭션 객체에 있는 정보들은 주문번호를 통해 서로 연관맺는다. 한 트랜잭션에 있는 모든 아이템은 주문번호가 같아야 한다.(The information in the transaction object is associated with its items by means of the order IDs for the transaction and all items, which should be the same ID.)
2.  **아이템을 트랜잭션에 담는다 **`<a href="https://developers.google.com/analytics/devguides/collection/gajs/methods/gaJSApiEcommerce#_gat.GA_Tracker_._addItem">_addItem()</a>` 메서드는 각 트랜잭션에 있는 `orderId` 필드를 매개로 사용자의 장바구니에 있는 각각의 아이템과 그에 관한 정보를 추적한다. [한 사람이 4개의 아이템을 장바구니에 담고 결제하기 버튼을 눌렀다고 하자. 주문번호(orderId)가 342번이라고 하자. 이 트랜잭션은 orderId가 342인 트랜잭션이며, 각 아이템은 orderId가 342인 트랜잭션에 속한 아이템인 것이다.] 이 메서드는 특정 아이템의 상세 정보를 추적한다. 예를 들면, SKU[재고 관리 코드], 가격, 카테고리, 수량 등.
3.  **트랜잭션을 아날리틱스 서버에 전송한다. `<a href="https://developers.google.com/analytics/devguides/collection/gajs/methods/gaJSApiEcommerce#_gat.GA_Tracker_._trackTrans">_trackTrans()</a>`** 메서드는 구매가 일어났다는 걸 확정한다. 그리고 트랜잭션 객체에 담아 둔 모든 데이터는 트랜잭션으로서 완료된다.

전자 상거래 엔진에서 정보가 검색될 수 있는 여러 방법이 있다. 어떤 전자 상거래 엔진은 구매 정보를 우리가 사용할 수 있는 hidden form에 넣는다. [hidden form은 <input type="hidden"> 식의 코드를 말하는 것이다 - 녹풍] 어떤 것은 우리가 검색할 수 있는 데이터베이스에 정보를 넣어 둔다. 그리고 어떤 것들은 정보를 쿠키에 저장한다. 좀더 유명하고, 구글 아날리틱스를 인식하는 어떤 전자 상거래 엔진은 구글 아날리틱스를 위해 주문 추적을 간단하게 할 수 있도록 모듈을 제공해 주기도 한다.

## 가이드라인 {#Guidelines}

전자 상거래 추적을 할 때 다음을 염두에 둬라.

*   **SKU code[재고 관리 코드]는 트랜잭션에 추가되는 모든 아이템에 필요한 필수 파라미터다.**  
    만약 트랜잭션에 여러 아이템이 있는데 SKU가 없는 아이템이 있다면, GIF 요청은 SKU가 있는 아이템 중 트랜잭션에 마지막으로 추가된 것에 대한 정보만 전송한다. [GIF request란, GIF 이미지 파일을 요청하는 척하면서 정보를 전송하는 cross domain 통신 기법인 듯하다 - 녹풍] (a GIF request is sent only for the last item added to the transaction for which a SKU is provided.) 덧붙여, 같은 SKU를 가진 서로 다른 아이템이 물품 목록에 있고, 손님이 그걸 동시에 구입하게 되면, 나중에 추가된 것에 대한 정보만 받게 될 것이다. 따라서, 각 아이템에는 유일한 SKU를 붙여야 한다.
*   **`_addTrans()` 와 `_addItem()` 의 인자값은 위치에 맞게 넣는다  
    **모든 인자값이 필수는 아니기 때문에, 오류를 피하기 위해서는 없는 인자값에 대해서는 빈 값을 집어 넣어야 한다. 예를 들면, 주문번호와 sku, 가격, 수량만 있는 아이템을 추가할 때는 이렇게 쓴다.</p> 
    <pre>_addItem("54321", "12345", "", "", "55.95", "1");</pre>

*   **`price` 와 `total` 파라미터는 어떤 통화 단위도 무시한다.**  
    두 파라미터의 경우, 쉼표나 점은 소수를 의미하게 된다. 따라서, 예를 들면, 만약 `1,996.00` 를 `total `파라미터의 값으로 넣었다면, `1.996으로 기록되며`, $1,996.00 로 기록되지 않는다. 값이 어떤 통화와도 연계되지 않기 때문에, 전자 상거래 소프트웨어 쪽에서 데이터를 구글 아날리틱스로 넘기기 전에 반드시 숫자를 조정해야 한다.
*   **만약 전자 상거래 추적을 구현해 놨고, 써드파티 장바구니를 사용하고 있다면, 크로스 도메인 추적 설정도 해야 할 것이다.(If you are implementing ecommerce tracking and using a 3rd-party shopping cart, you will likely need to configure cross-domain tracking as well.)**  
    자세한 내용은 &#8220;[Cross Domain Tracking][3]&#8220;을 참고하라.
*   **반드시 필요한 건 아니지만, 만약 특정 페이지와 트랜잭션 데이터를 연동하고 싶다면, 주문 완료 페이지에서 `_trackPageview()` 를 호출하는 것도 방법이다.**

## 완성 예제 {#Example}

다음 예제는 세가지 메서드를 모두 이용해 주문 완료 페이지에서 전자 상거래 추적을 설정하는 것을 구현하고 있다. `_trackPageview()` 를 사용해서 &#8216;Acme 의류 구매 영수증&#8217;이라는 제목의 페이지와 트랜잭션을 연관짓는다.

**비동기식 문법(권장)**

<pre class="brush: javascript; gutter: true; first-line: 1">&lt;html&gt;
&lt;head&gt;
&lt;title&gt;Receipt for your clothing purchase from Acme Clothing&lt;/title&gt;
&lt;script type="text/javascript"&gt;

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXX-X']);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_addTrans',
    '1234',           // order ID - required
    'Acme Clothing',  // affiliation or store name
    '11.99',          // total - required
    '1.29',           // tax
    '5',              // shipping
    'San Jose',       // city
    'California',     // state or province
    'USA'             // country
  ]);

  // 장바구니에 있는 모든 아이템을 추가해야 할 것이다. 
  // 전자상거래 엔진이 장바구니에 있는 각 아이템을 돌 때
  // 각각 _addItem을 출력하면 될 거다.
  _gaq.push(['_addItem',
    '1234',           // order ID - required
    'DD44',           // SKU/code - required
    'T-Shirt',        // product name
    'Green Medium',   // category or variation
    '11.99',          // unit price - required
    '1'               // quantity - required
  ]);
  _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

&lt;/script&gt;
&lt;/head&gt;
&lt;body&gt;

  Thank you for your order.  You will receive an email containing all your order details.

&lt;/body&gt;
&lt;/html&gt;</pre>

**구식 문법**

<pre class="brush: javascript; gutter: true; first-line: 1">&lt;html&gt;
&lt;head&gt;
&lt;title&gt;Receipt for your clothing purchase from Acme Clothing&lt;/title&gt;
&lt;/head&gt;

&lt;body&gt;

  Thank you for your order.  You will receive an email containing all your order details.

&lt;script type="text/javascript"&gt;
  var gaJsHost = (("https:" == document.location.protocol ) ? "https://ssl." : "http://www.");
  document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
&lt;/script&gt;
&lt;script type="text/javascript"&gt;
try{
  var pageTracker = _gat._getTracker("UA-xxxxx-x");
  pageTracker._trackPageview();
  pageTracker._addTrans(
      "1234",            // order ID - required
      "Womens Apparel",  // affiliation or store name
      "11.99",           // total - required
      "1.29",            // tax
      "15.00",           // shipping
      "San Jose",        // city
      "California",      // state or province
      "USA"              // country
    );

   // add item might be called for every item in the shopping cart
   // where your ecommerce engine loops through each item in the cart and
   // prints out _addItem for each
   pageTracker._addItem(
      "1234",           // order ID - necessary to associate item with transaction
      "DD44",           // SKU/code - required
      "T-Shirt",        // product name
      "Olive Medium",   // category or variation
      "11.99",          // unit price - required
      "1"               // quantity - required
   );

   pageTracker._trackTrans(); //submits transaction to the Analytics servers
} catch(err) {}
&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>

 [1]: https://developers.google.com/analytics/devguides/collection/gajs/gaTrackingEcommerce
 [2]: https://developers.google.com/analytics/devguides/collection/gajs/methods/gaJSApiEcommerce#_gat.GA_Tracker_._addTrans
 [3]: https://developers.google.com/analytics/devguides/collection/gajs/gaTrackingSite