---
title: '웹사이트에 페이팔 결제 붙이기'
layout: post
tags: 
    - paypal checkout
---

[페이팔 결제는 한국 내 거래를 허용하지 않는다.][not-in-korea]

페이팔 결제 두 종류. 개인, 법인. 법인이 결제를 받기 위해 웹사이트에 결제 API를 통합하는 과정을 설명한다. 자세한 내용은 [페이팔 체크아웃][doc]에 설명돼 있다.

## 결제 과정 요약

1. 웹페이지에 페이팔 스마트 결제 버튼을 추가한다.
2. 구매자가 버튼을 누른다.
3. 버튼이 트랜잭션을 준비하기 위해 페이팔 주문 API를 호출한다.
4. 버튼이 페이팔 계산 절차를 실행한다.
5. 구매자가 결제를 승인한다.
6. 버튼이 트랜잭션을 완료하기 위해 페이팔 주문 API를 호출한다.
7. 당신이 구매자에게 결제 내용을 보여 준다.

## 주요 개념

샌드박스: 결제 테스트 환경이다.

라이브: 실제 환경이다.

샌드박스는 기본앱(Default Application)에 들어가서 API 키를 받아야 한다. 앱을 추가로 만들 수도 있다.

라이브는 앱을 만들어야 한다.

앱에는 Merchant(Seller)와 Platform이 있다. 차이는 모르겠다.

[결제시 넘겨줄 파라미터 목록][parameters]

결제를 받을 때 즉시 돈을 받는 capture와 인증만 하고 돈은 나중에 받는 [authorization][auth-capture]이 있다. authorization은 계약을 먼저 체결하고 실행은 나중에 하는 사업 모델에 적합하다. authorization은 배송비, 세금, 봉사료 등에 따라 금액을 조정하는 게 가능하다. 페이팔은 3일 안에 받기를 권하지만, 29일까지 설정할 수 있다.

페이팔이 보내 주는 [웹훅][webhook]이 여러 개 있다. 10개까지 웹훅을 만들 수 있다.

javascript SDK로 버튼을 렌더링한다. 버튼 컨테이너를 지정하면 된다.

버튼을 생성할 때. 

- createOrder key에 함수를 넘겨줘야 하는데, 옵션값들은 [주문 API][order-api]를 참고한다.
- onApprove key에 결제 완료시 작동을 넣어 준다.

[샌드박스 계정][sandbox-accounts]과 비밀번호를 복사한다. 계정 보기를 하면 시스템이 생성한 비밀번호를 볼 수 있다. 이 계정으로 버튼을 클릭해서 결제 테스트를 한다.

Vue 예제는 잘 작동하지 않았다. 컴포넌트의 콜백함수에서 에러가 났다.


[not-in-korea]: https://www.paypal.com/kr/webapps/mpp/system-enhancement-faq?locale.x=ko_KR
[doc]: https://developer.paypal.com/docs/checkout/
[webhook]: https://developer.paypal.com/docs/api-basics/notifications/webhooks/
[auth-capture]: https://developer.paypal.com/docs/admin/auth-capture/
[parameters]: https://developer.paypal.com/docs/checkout/reference/customize-sdk/
[order-api]: https://developer.paypal.com/docs/api/orders/v2/#orders_create
[sandbox-accounts]: https://developer.paypal.com/developer/accounts/



## 결제 완료 obj

```json
{
    "create_time": "2021-04-06T03:06:47Z",
    "update_time": "2021-04-06T03:07:14Z",
    "id": "5PU07881WC5933543",
    "intent": "CAPTURE",
    "status": "COMPLETED",
    "payer": {
        "email_address": "sb-nbc0o5825857@business.example.com",
        "payer_id": "2Y52EQPUMB2T8",
        "address": {
            "country_code": "KR"
        },
        "name": {
            "given_name": "John",
            "surname": "Doe"
        }
    },
    "purchase_units": [
        {
            "reference_id": "svkBLg9qOO9J05bSZ2BSgvWrBo8p7lttRIdC0z0Myw0G5uTcoF",
            "amount": {
                "value": "44.81",
                "currency_code": "USD"
            },
            "payee": {
                "email_address": "sb-mrwkp5765830@personal.example.com",
                "merchant_id": "T523D5YGDKT8J"
            },
            "shipping": {
                "name": {
                    "full_name": "John Doe"
                },
                "address": {
                    "address_line_1": "Sajik-ro-3-gil 23",
                    "admin_area_2": "Jongno-gu",
                    "admin_area_1": "Seoul",
                    "postal_code": "01001",
                    "country_code": "KR"
                }
            },
            "payments": {
                "captures": [
                    {
                        "status": "COMPLETED",
                        "id": "54B75737613676525",
                        "final_capture": true,
                        "create_time": "2021-04-06T03:07:14Z",
                        "update_time": "2021-04-06T03:07:14Z",
                        "amount": {
                            "value": "44.81",
                            "currency_code": "USD"
                        },
                        "seller_protection": {
                            "status": "ELIGIBLE",
                            "dispute_categories": [
                                "ITEM_NOT_RECEIVED",
                                "UNAUTHORIZED_TRANSACTION"
                            ]
                        },
                        "links": [
                            {
                                "href": "https://api.sandbox.paypal.com/v2/payments/captures/54B75737613676525",
                                "rel": "self",
                                "method": "GET",
                                "title": "GET"
                            },
                            {
                                "href": "https://api.sandbox.paypal.com/v2/payments/captures/54B75737613676525/refund",
                                "rel": "refund",
                                "method": "POST",
                                "title": "POST"
                            },
                            {
                                "href": "https://api.sandbox.paypal.com/v2/checkout/orders/5PU07881WC5933543",
                                "rel": "up",
                                "method": "GET",
                                "title": "GET"
                            }
                        ]
                    }
                ]
            }
        }
    ],
    "links": [
        {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/5PU07881WC5933543",
            "rel": "self",
            "method": "GET",
            "title": "GET"
        }
    ]
}
```

## access token API

```bash
http -v --form https://api-m.sandbox.paypal.com/v1/oauth2/token \
  grant_type=client_credentials \
  "Accept: application/json" \
  "Accept-Language: en_US" \
  --auth "AXvn8T76zdrs-xHH63m9-NM0Tu2UW6rMp8zEVNgMQba3nlcYYYX03-ZrE4G4psiHXcZkw3o-NB4l1tlB:EKC_gCCFXxP1RZdQHQ7mFFhNAG8Pci4S9Qz8iyKhaI0ngAGdDgBpaC8P6bc3xYYE2edZn4PAx4JX8mVc"
```

```json
{
    "access_token": "A21AAJNEXMWrDpg5Za1curfbSDDJlCWI5t-52JnElf49e4dci41peH_cB8dtFLPWGNBB0TFHoSpjv0kSzRA3k7gCzGFyHhaMg",
    "app_id": "APP-80W284485P519543T",
    "expires_in": 32399,
    "nonce": "2021-04-06T08:17:28ZQsAl7Un8I02FQqAbpFXvjgSrKjlkZhtUXkM-egDopbw",
    "scope": "https://uri.paypal.com/services/invoicing https://uri.paypal.com/services/vault/payment-tokens/read https://uri.paypal.com/services/disputes/read-buyer https://uri.paypal.com/services/payments/realtimepayment https://uri.paypal.com/services/disputes/update-seller https://uri.paypal.com/services/payments/payment/authcapture openid https://uri.paypal.com/services/disputes/read-seller Braintree:Vault https://uri.paypal.com/services/payments/refund https://api.paypal.com/v1/vault/credit-card https://api.paypal.com/v1/payments/.* https://uri.paypal.com/payments/payouts https://uri.paypal.com/services/vault/payment-tokens/readwrite https://api.paypal.com/v1/vault/credit-card/.* https://uri.paypal.com/services/subscriptions https://uri.paypal.com/services/applications/webhooks",
    "token_type": "Bearer"
}
```

## 결제 완료 obj의 link 호출

access token을 사용해야 한다.

```bash
http -v https://api.sandbox.paypal.com/v2/checkout/orders/9LD9278185915435H \
	'Authorization: Bearer A21AALVRc36leGhp9DRAWdwVBtA1vqL3n1ZU_8tcpbSKLOpWr_LTmtBSmp_pUCMLBkWebFq4kkiefd81SOUIFvC9HlwDyvwvA' \
	'Content-Type: application/json'

http -v post https://api.sandbox.paypal.com/v2/payments/captures/54B75737613676525/refund \
	'Authorization: Bearer A21AAKuswWQnZnaZJe58X9KfswWt7GiDThgDbPN-CSXibqZrepB29A_r8QMuxElS-MXlcVyOVGxsOLtBp857I1ktzqM_j7ffQ' \
	'Content-Type: application/json'

http -v https://api.sandbox.paypal.com/v2/payments/refunds/7W896351PW1887918 \
	'Authorization: Bearer A21AAKuswWQnZnaZJe58X9KfswWt7GiDThgDbPN-CSXibqZrepB29A_r8QMuxElS-MXlcVyOVGxsOLtBp857I1ktzqM_j7ffQ' \
	'Content-Type: application/json'
```