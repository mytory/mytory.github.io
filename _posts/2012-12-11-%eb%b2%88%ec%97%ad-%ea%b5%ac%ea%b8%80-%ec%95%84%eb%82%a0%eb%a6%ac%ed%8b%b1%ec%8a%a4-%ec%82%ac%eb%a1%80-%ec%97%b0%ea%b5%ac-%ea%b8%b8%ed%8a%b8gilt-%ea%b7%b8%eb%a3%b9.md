---
title: '[번역] 구글 아날리틱스 사례 연구 &#8211; 길트(Gilt) 그룹은 엔터프라이즈급 분석을 통해 통찰력을 얻었다'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/8794
daumview_id:
  - 37663946
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
구글 아날리틱스 공식 블로그에 올라온 [길트 그룹의 구글 아날리틱스 활용 사례 연구(Case Study)][1]를 봤다. 나름 도움이 될 듯해 번역했다. 난 영어에 서툴어서 오역은 당연히 가능하다.

&#8212;&#8212;

1년 좀더 전에 우리는 엔터프라이즈급 사용자들의 요구에 부응하기 위해 <a href="http://www.google.com/analytics/premium/index.html#utm_medium=blog&utm_source=gablog&utm_campaign=gilt" target="_blank">구글 아날리틱스 프리미엄</a>을 출시했다. 지금 우리는 따듯한 반응을 접하고 있다. 그리고 회사들이 데이터를 분석하기 위해 새로운 방식으로 구글 아날리틱스 프리미엄 버전을 사용하고 있다는 소식을 들었다. 아주 기쁘다. 아래는 길트의 사례 연구다. 이 연구는 구글 아날리틱스 프리미엄이 어떻게 회사 전체에 데이터에 대한 사랑을 퍼뜨렸는지, 예측 모델 구축을 위해 맞춤 변수 숫자 증가를 어떻게 확보했는지, 그리고 테스트 결과에서 불확실성을 제거하기 위해 샘플링되지 않은 데이터를 어떻게 사용했는지 보여 준다. (역주 &#8211; 전체 보고서는 아래 번역했다.)

<p style="text-align: center;">
  <img class="aligncenter" style="border: 0px none;" alt="" src="http://1.bp.blogspot.com/-gtncAMfiK3c/UMEnxcDAbOI/AAAAAAAAA3g/55OWdOXNvvs/s200/gilt_logo.jpg" width="200" height="112" border="0" />
</p>

&#8220;구글 아날리틱스 프리미엄은 길트에 사업 통찰력을 위한 빠르고 쉬운 접근을 모두 주었다. 회사 전반에 퍼진 &#8216;스스로 서비스되는&#8217; 데이터라는 말은 정말이지 진실이다.&#8221;

<p style="text-align: right;">
  <strong>- 아나 크라비츠, 길트 그룹 웹 분석 시니어 매니저</strong>
</p>

구글 아날리틱스 프리미엄은 더 많은 데이터, 유연성, 24/7 <a class="simple-footnote" title="역주 &#8211; 회사 이름인 듯" id="return-note-8794-1" href="#note-8794-1"><sup>1</sup></a>의 지원을 통해 엔터프라이즈급 분석을 제공한다. 프리미엄 버전의 이득은 데이터 수집, 보고, 처리 과정에서 SLA’s <a class="simple-footnote" title="Service Level Agreement&#8217;s" id="return-note-8794-2" href="#note-8794-2"><sup>2</sup></a>를 보장한다. 프리미엄 계정은 또한 월 히트수 제한이 줄어들고 추가로 50개의 맞춤 변수를 제공받는다. 샘플링되지 않은 데이터에도 접근할 수 있다. 프리미엄 계정은 또한 구현 리뷰, 품질 보증, 교육, 그리고 전속 계정 매니저를 포함하는 지원을 받을 수 있다.

구글 아날리틱스 프리미엄은 현재 미국, 영국, 캐나다에서 가능하다. 2013년에 구글 아날리틱스 프리미엄은 제품과 서비스를 엔터프라이즈급 고객들의 요구에 맞춰 더욱 확장할 것이다. 우리는 서비스를 곧 7개 국가에서도 시작할 것이다 : 일본, 브라질, 프랑스, 독일, 네덜란드, 이탈리아, 그리고 스페인.

구글 아날리틱스 프리미엄 버전에 대해 더 알고 싶고, 그게 어떻게 사업에 도움이 될지 궁금하다면 <a href="http://www.google.com/analytics/premium/contact.html#utm_medium=blog&utm_source=gablog&utm_campaign=gilt" target="_blank">구글 아날리틱스 판매 팀</a>이나 <a href="http://www.google.com/analytics/premium/partners.html#utm_medium=blog&utm_source=gablog&utm_campaign=gilt" target="_blank">구글 아날리틱스 프리미엄 공식 리셀러</a>에게 문의하면 된다.

클랜시 차일즈  
구글 아날리틱스 프리미엄 팀

[역주 : 아래는 <a href="http://services.google.com/fh/files/blogs/gilt_casestudy_final.pdf" target="_blank">길트 사례연구 전문</a>을 번역한 것이다. 아래 보고서는 상당히 성기다. 구체적인 이야기는 거의 없다. 그럼에도 불구하고 번역한 것은 분석의 개략을 알 수 있게 해 주기 때문이다. 예컨대 내가 이 보고서를 통해 얻은 것은 '클릭스트림 데이터를 얻기 위해 맞춤 변수를 활용해야 하는구나', 'ID 같은 걸 맞춤 변수에 넣는구나' 하는 것이었다. 그리고 '분석을 위해 맞춤 변수를 심지어 20여 개를 사용하는구나' 하는 것도 있었다. '기여 모델링을 한 번 써 봐야 겠다'는 생각도 했다. 여튼간에 이런 식으로 얻을 수 있는 게 있다. 그럼 읽어 보길.]

## 길트 그룹 살펴 보기

*   개인화된 <a class="simple-footnote" title="Private" id="return-note-8794-3" href="#note-8794-3"><sup>3</sup></a> 쇼핑 사이트
*   뉴욕에 기반
*   [www.gilt.com][2]

## 목표

*   사용자 수준에서 더 상세한 정보를 얻는다.
*   모든 방문과 접점에 대한 상세한 데이터를 얻는다.
*   웹사이트 데이터를 데이터 웨어하우스 <a class="simple-footnote" title="사내에 두는 데이터 센터" id="return-note-8794-4" href="#note-8794-4"><sup>4</sup></a>에 연결한다.
*   더 검증된 트래픽을 웹사이트로 끌어들여서 ROI <a class="simple-footnote" title="return on investment(투자 수익률)." id="return-note-8794-5" href="#note-8794-5"><sup>5</sup></a>를 개선한다.
*   사용자 구매 행동과 인구학적 데이터를 상호참조한다.

## 접근

*   대규모 데이터 집함의 통계적 신뢰성을 확보하기 위해 샘플링되지 않은 보고서 <a class="simple-footnote" title="역주 &#8211; 구글 아날리틱스 데이터 보고서를 말하는 듯" id="return-note-8794-6" href="#note-8794-6"><sup>6</sup></a>를 바탕으로 분석.
*   20개의 맞춤 변수를 설정하고, 이것을 세그멘테이션 <a class="simple-footnote" title="분석 결과에 조건을 달아서 좀더 세부적으로 나눈 것. 두 페이지 이상 방문한 방문자에가 가장 많이 본 페이지는? 이런 식으로 조건을 주고 분석하는 것을 세그멘테이션이라고 한다." id="return-note-8794-7" href="#note-8794-7"><sup>7</sup></a>과 분석에 적용함.
*   각기 다른 영역에 있는 마케팅 접점의 <a class="simple-footnote" title="touch point" id="return-note-8794-8" href="#note-8794-8"><sup>8</sup></a> 가치를 이해하기 위해 기여 모델링을 사용함.
*   전환 과정의 각 단계를 이해하기 위해 골 퍼널을 생성함. <a class="simple-footnote" title="역주 &#8211; 퍼널은 깔떼기다. 방문이 깔떼기 맨 위고 깔떼기 맨 아래는 구매자다. 정확히 말하면 목표 도달 방문자다. 방문자 전체 중 소수의 구매자가 도출되는 과정을 시각화하면 깔떼기 모양이 된다고 해서 퍼널이라고 부른다. 깔떼기로 번역하는 것은 어색하기 때문에 그냥 퍼널이라고 썼다." id="return-note-8794-9" href="#note-8794-9"><sup>9</sup></a>

## 결과

*   회사 전반에서 분석 활용이 증가했다. 예전엔 작은 그룹만이 분석을 사용했는데 100명 이상으로 늘었다.
*   특정 비즈니스 문제에 대해 매주 즉각적인 수많은 보고서가 나왔고, 이에 따라 각 부서를 위해 정규 대시보드가 개발됐다.
*   4시간마다 데이터가 최신으로 갱신되면서 더 책임성있는 결정을 내릴 수 있게 됐다.
*   직원들은 조사하고 분석할 수 있는 능력을 얻었으며, 세부적 결정들을 분석을 바탕으로 하게 됐다.

## 길트 그룹은 &#8216;구글 아날리틱스 프리미엄&#8217;의 고급 기능을 사용함으로써 회사 문화 전반을 데이터-주도적 의사결정을 하는 문화로 바꿔놓았다.

## 배경

<a href="http://www.gilt.com/" target="_blank">길트 그룹</a>은 회원들에게 가능한한 최고의 상품, 최고의 경험을 특별한 방법으로 제공해 주는 혁신적 온라인 쇼핑몰이다. 길트는 탑 디자이너 브랜드를 60% 할인된 가격으로 즉각 접할 수 있도록 하는 서비스를 가입자들에게 제공한다. <a class="simple-footnote" title="Gilt provides instant insider access to top designer brands at up to 60% off retail." id="return-note-8794-10" href="#note-8794-10"><sup>10</sup></a> 제품은 패션, 장식품, 공예 재료, 여행 경험, 그리고 다양한 도시에서의 특별한 활동 등을 포괄한다. <a class="simple-footnote" title="Products span fashion, décor, artisanal ingredients, travel experiences, and unique activities in a growing list of cities." id="return-note-8794-11" href="#note-8794-11"><sup>11</sup></a>

2007년에 창업한 이래, 길트는 가장 빠르고 멋진 온라인 쇼핑 경험을 만들어 내기 위해 노력해 왔다. 방문자가 현관 계단의 반짝이는 박스를 접하며 가상의 문에 들어선 순간부터 다른 데서는 느껴 보지 못한 서비스를 받을 수 있도록 길트는 노력해 왔다. 근본적으로, 이 디지털 회사는 성장뿐 아니라 사용자의 만족에 집중했다. 잘 준비된 포괄적 웹 분석 솔루션을 구축하는 게 길트에겐 사활적이다.

## 보고 증가 <a class="simple-footnote" title="Ramping up on reporting" id="return-note-8794-12" href="#note-8794-12"><sup>12</sup></a>

2011년, 길트 그룹은 분석 솔루션을 구글 아날리틱스로 대체했다. 모든 개별 방문자의 상호작용을 가능한한 많이 추적하기 위해 길트는 그 뒤 &#8216;구글 아날리틱스 프리미엄&#8217;을 도입했다. 업그레이드를 함으로써 얻은 주요한 이점은, 샘플링되지 않은 데이터에 접근할 수 있고, 사용자 수준에서 더 상세한 정보를 얻을 수 있다는 점이었다. 길트는 이를 바탕으로 통계적으로 확실한 의사결정을 하기를 바랐다. 구글 아날리틱스 스탠다드 버전을 이미 웹사이트와 백엔드 시스템에 통합해 놓고 있었기 때문에, 프리미엄 버전으로 업그레이드하는 것은 아주 제한된 구현, 서비스, 지원으로 가능했다. 현재 길트가 매일 사용하고 있는 고급 기능용 호스트[ 컴퓨터]를 구축하는 것만 노력이 좀 들었을 뿐이다.

## 샘플링되지 않은 데이터

구글 아날리틱스 스탠다드 버전은 길트가 50만 이상의 방문에 대한 분석을 할 때 커스텀 레포트에서 데이터를 가공하도록 했다. 하지만 &#8216;구글 아날리틱스 프리미엄&#8217;은 길트가 샘플링되지 않은 보고서에 접근할 수 있도록 했다. 더 정확한 데이터에 접근하는 것은, 테스트와 캠페인에서 명확한 관점을 얻는 데 있어 중요했다. 샘플링된 데이터만 보다가 구글 아날리틱스 인터페이스에서 샘플링되지 않은 데이터를 끌어옴으로써, 불확실성을 제거했으며, 테스트와 캠페인 결과에 따라 확신을 갖고 행동할 수 있게 됐다.

## 맞춤 변수 <a class="simple-footnote" title="Custom variables를 구글은 &#8216;맞춤 변수&#8217;로 번역한다." id="return-note-8794-13" href="#note-8794-13"><sup>13</sup></a>

구글 아날리틱스 스탠다드 버전은 다섯 개의 맞춤 변수를 만들 수 있도록 한다. 하지만 길트는 사용자들에 대해 더 전체적인 관점을 얻기 위해 더 다양한 분석 데이터를 수집하고 싶었다. <a class="simple-footnote" title="a wider variety of key metrics를 &#8216;더 다양한 분석 데이터&#8217;로 번역했다." id="return-note-8794-14" href="#note-8794-14"><sup>14</sup></a> 지금 길트는 20개 이상의 맞춤 변수를 사용하고 있다. 이를 통해 A/B 테스팅을 포함해 더 많은 비교와 분석이 가능하다. (역자 주 : A/B 테스팅은 같은 서비스를 A 인터페이스로 제공하고, B 인터페이스로도 제공해서 어떤 경우에 더 효과적으로 목표를 이루는지 확인하는 테스트다.) 측정값의 예는 사용자 아이디, 테스트 참여, 시각, 페이지 타입, 인구통계적 정보, 변조 테스트, 방문수 <a class="simple-footnote" title="hit times" id="return-note-8794-15" href="#note-8794-15"><sup>15</sup></a> 등등이다. 회사는 이 데이터를 통해 클릭스트림 <a class="simple-footnote" title="역주 &#8211; 한 방문자가 사이트를 어떤 순서로 얼마나 보고 갔는지 추적하는 데이터" id="return-note-8794-16" href="#note-8794-16"><sup>16</sup></a>을 구축하고, 각기 다른 도메인으로부터 유입된 방문 경로를 재구축하고, 자기 사이트와 외부 소스로부터 일어난 구매 모두를 분석하고, 사이트를 개인화하고, 구글 아날리틱스에서 테스트 결과를 보도록 했다. <a class="simple-footnote" title="The company takes all this data to construct a clickstream and to reconstruct visitor pathing across their different domains, analyze both onsite and external sources of traffic to sales, do site personalization, and view test results in Google Analytics." id="return-note-8794-17" href="#note-8794-17"><sup>17</sup></a>

## 예측 모델링 <a class="simple-footnote" title="Predictive modeling" id="return-note-8794-18" href="#note-8794-18"><sup>18</sup></a>

길트는 다음 단계로 가기 위해 구글 아날리틱스 프리미엄의 고급 기능들을 활용하는 데 힘을 쏟고 있다. 예를 들면, 길트는 구매 행위를 예측하고 그걸 바탕으로 결정하는 모델을 만들기 위해 구글 아날리틱스에서 클릭스트림 데이터를 사용한다. 구매 타이밍, 가격, 구매 위치 등과 연관된 각 세션의 상세 데이터를 모음으로써, 길트는 이 변수들을 모델에 제공할 수 있고, 구매 가능성을 예측할 수 있다. (역주 &#8211; 한 세션은 한 사람으로 생각하면 된다.) &#8216;구글 아날리틱스 프리미엄&#8217; 없이는 불가능한 일들이다. &#8216;구글 아날리틱스 프리미엄&#8217;은 추가적인 전자상거래 관련 정보들을 모을 수 있도록 45개의 추가 맞춤 변수를 제공한다.

## 기여 모델링 <a class="simple-footnote" title="Attribution modeling" id="return-note-8794-19" href="#note-8794-19"><sup>19</sup></a>

판매 경로 퍼널을 완전히 채우기 위해, 기여 모델링을 구축했다. &#8220;GA(구글 아날리틱스)는 이 지점에서 빛나죠.&#8221; 길트의 웹 분석 시니어 매니저인 아나 크라비츠의 설명이다. &#8220;구글 아날리틱스 스탠다드 버전은 몇 가지 멀티 채널 퍼널 분석을 제공해요. 그건 사용자들이 서로 다른 마케팅 수단을 통해 어떻게 들어왔는지 아주 직관적으로 이해할 수 있게 해 줘요. 구글 아날리틱스 프리미엄 버전은 서로 다른 기여 모델의 결과를 순식간에 보고 비교할 수 있도록 기여 모델링 툴을 제공해 줘요.&#8221; (역주 &#8211; 기여 모델(attribution model)은 웹 배너 광고, 전단지 광고, SNS 광고 등 다양한 광고 채널 중 어느 채널이 얼마나 기여를 했는지 분석하는 것을 말한다.) 아나의 설명을 들어 보면, 오늘날 사용 가능한 웹 분석 툴들 중 구글 아날리틱스가 이 기능을 가장 직관적이고 사용하기 쉽게 제공한다고 했다.

기여 모델링을 사용하면서, 길트는 최종 클릭 모델을 따르는 것이 제휴사 이익이 가장 높다는 것을 배웠다. 그러나, 최초 클릭 모델을 사용하면 제휴사 이익은 훨씬 낮았다. 이를 통해 최종 클릭 결과만으로 마케팅하는 것이 위험하는 것을 깨달았다. 기여 모델링 툴은 제휴 마케팅에 집중하기 위해 다른 마케팅 비용을 줄인 것이 새로운 사용자를 끌어들이는 능력을 감소시키고, 서서히 방문자를 잃게 할 수도 있다는 것을 보여 준다. <a class="simple-footnote" title="제대로 번역한 건지 모르겠다. 한 번 보시고, 어떤지 댓글로 달아 주셨으면 한다. &#8211; In using attribution modeling, Gilt learned that according to the last click model, affiliate revenue is very high. Using the first-click model, however, affiliate revenue is much lower. This highlights the danger of basing marketing efforts solely on last-click results. The attribution modeling tool shows that reducing other marketing expenditures to focus on affiliate marketing would reduce the ability to acquire new users and Gilt would slowly lose customers through attrition." id="return-note-8794-20" href="#note-8794-20"><sup>20</sup></a> 다른 한 편, 기존 사용자가 친구를 추천해서 가입시키는 추천 마케팅 프로그램 같은 것은, 최종 클릭 구매에 비해 수익에는 거의 도움이 안 되는 반면 새로운 방문을 만들어낸다는 것도 드러났다. 이런 식으로, 기여 모델은 길트가 그들의 마케팅 퍼널의 양 끝부분을 채우는 최고의 방법을 효과적이고 정확하게 찾아낼 수 있도록 했다.

## 학습이 신속하게 확산되다

길트가 예전에 사용하던 분석 툴은 소수만 우선 접근을 했고, 그 다음 이들이 데이터를 가공해서 회사의 다른 부문들이 볼 수 있도록 보고서를 내놨다. 구글 아날리틱스 프리미엄은 접근성이 좋고 이해하기가 아주 쉽기 때문에, [보고서로] 제공해야 하는 것 대부분을 정기적으로 만들어내는 참여자가 100명 이상으로 늘었다. 툴을 바꿔서 얻은 효과 중 하나는, 결정을 내리기 위해 데이터를 사용하는 모든 직급과 부서, 회사 전체에 웹 분석이 깊히 스며들었다는 점이다. 지금 준비된 서비스 레벨의 협정은 4시간마다 갱신된 데이터를 보장한다. 이것은 또한, 충분한 정보를 바탕으로 신속한 결정을 할 수 있는 능력이 한층 강화된다는 것을 의미한다.

이 사실들은 회사 문화에 명백한 효과를 가져왔다. 많은 사람들이 현재 길트의 웹 분석을 볼 수 있게 됐기 때문에, 새로운 기능이나 테스트가 출시되면 언제나 분석 태그를 달고, 구글 아날리틱스에서 모니터링한다. 제품 팀은 새로 출시된 것을 위해 아날리틱스에 대시보드를 만들고, 공유해서 회사 전체의 직원들이 성과를 측정할 수 있도록 한다. 현재, 아날리틱스는 회의와 토론에서 중심적 역할을 하고 있다. &#8220;GA는 세그멘테이션 조건, 마케팅 기여도 측정, 그리고 순간적인 아이디어를 바탕으로 살펴볼 수 있도록 하는 기능이 엄청나게 강력해요.&#8221; 아나의 설명이다. 사용하기 쉽기 때문에, 아나가 보기에는, 구글 아날리틱스 프리미엄을 도입하는 것은, 분석이 단지 보고서에 그치는 것이 아니라 진정한 분석이 된다는 것을 의미한다. 길트[ 사례 연구]의 결론[은 무엇일까]? [구글 아날리틱스 프리미엄이] 더 좋고, 더 빠른, 전 조직 차원의 모든 세세한 분야에서의 데이터 주도 결정[을 가능하게 한다는 것]이다.

<div class="simple-footnotes">
  <p class="notes">
    Notes:
  </p>
  
  <ol>
    <li id="note-8794-1">
      역주 &#8211; 회사 이름인 듯 <a href="#return-note-8794-1">&#8617;</a>
    </li>
    <li id="note-8794-2">
      Service Level Agreement&#8217;s <a href="#return-note-8794-2">&#8617;</a>
    </li>
    <li id="note-8794-3">
      Private <a href="#return-note-8794-3">&#8617;</a>
    </li>
    <li id="note-8794-4">
      사내에 두는 데이터 센터 <a href="#return-note-8794-4">&#8617;</a>
    </li>
    <li id="note-8794-5">
      return on investment(투자 수익률). <a href="#return-note-8794-5">&#8617;</a>
    </li>
    <li id="note-8794-6">
      역주 &#8211; 구글 아날리틱스 데이터 보고서를 말하는 듯 <a href="#return-note-8794-6">&#8617;</a>
    </li>
    <li id="note-8794-7">
      분석 결과에 조건을 달아서 좀더 세부적으로 나눈 것. 두 페이지 이상 방문한 방문자에가 가장 많이 본 페이지는? 이런 식으로 조건을 주고 분석하는 것을 세그멘테이션이라고 한다. <a href="#return-note-8794-7">&#8617;</a>
    </li>
    <li id="note-8794-8">
      touch point <a href="#return-note-8794-8">&#8617;</a>
    </li>
    <li id="note-8794-9">
      역주 &#8211; 퍼널은 깔떼기다. 방문이 깔떼기 맨 위고 깔떼기 맨 아래는 구매자다. 정확히 말하면 목표 도달 방문자다. 방문자 전체 중 소수의 구매자가 도출되는 과정을 시각화하면 깔떼기 모양이 된다고 해서 퍼널이라고 부른다. 깔떼기로 번역하는 것은 어색하기 때문에 그냥 퍼널이라고 썼다. <a href="#return-note-8794-9">&#8617;</a>
    </li>
    <li id="note-8794-10">
      Gilt provides instant insider access to top designer brands at up to 60% off retail. <a href="#return-note-8794-10">&#8617;</a>
    </li>
    <li id="note-8794-11">
      Products span fashion, décor, artisanal ingredients, travel experiences, and unique activities in a growing list of cities. <a href="#return-note-8794-11">&#8617;</a>
    </li>
    <li id="note-8794-12">
      Ramping up on reporting <a href="#return-note-8794-12">&#8617;</a>
    </li>
    <li id="note-8794-13">
      Custom variables를 구글은 &#8216;맞춤 변수&#8217;로 번역한다. <a href="#return-note-8794-13">&#8617;</a>
    </li>
    <li id="note-8794-14">
      a wider variety of key metrics를 &#8216;더 다양한 분석 데이터&#8217;로 번역했다. <a href="#return-note-8794-14">&#8617;</a>
    </li>
    <li id="note-8794-15">
      hit times <a href="#return-note-8794-15">&#8617;</a>
    </li>
    <li id="note-8794-16">
      역주 &#8211; 한 방문자가 사이트를 어떤 순서로 얼마나 보고 갔는지 추적하는 데이터 <a href="#return-note-8794-16">&#8617;</a>
    </li>
    <li id="note-8794-17">
      The company takes all this data to construct a clickstream and to reconstruct visitor pathing across their different domains, analyze both onsite and external sources of traffic to sales, do site personalization, and view test results in Google Analytics. <a href="#return-note-8794-17">&#8617;</a>
    </li>
    <li id="note-8794-18">
      Predictive modeling <a href="#return-note-8794-18">&#8617;</a>
    </li>
    <li id="note-8794-19">
      Attribution modeling <a href="#return-note-8794-19">&#8617;</a>
    </li>
    <li id="note-8794-20">
      제대로 번역한 건지 모르겠다. 한 번 보시고, 어떤지 댓글로 달아 주셨으면 한다. &#8211; In using attribution modeling, Gilt learned that according to the last click model, affiliate revenue is very high. Using the first-click model, however, affiliate revenue is much lower. This highlights the danger of basing marketing efforts solely on last-click results. The attribution modeling tool shows that reducing other marketing expenditures to focus on affiliate marketing would reduce the ability to acquire new users and Gilt would slowly lose customers through attrition. <a href="#return-note-8794-20">&#8617;</a>
    </li>
  </ol>
</div>

 [1]: http://analytics.blogspot.kr/2012/12/gilt-embraces-insights-from-analytics.html
 [2]: http://www.gilt.com/