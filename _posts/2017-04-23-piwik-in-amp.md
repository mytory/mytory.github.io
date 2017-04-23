---
title: 'AMP에 Piwik 추적 코드 추가하기'
layout: post
author: 안형우
tags: 
  - analytics
  - code snippet
description: 'amp-pixel 태그를 사용하면 된다.'
image: /uploads/2017-04/piwik-amp-code.png 
---

AMP에 google analytics 추적 코드를 넣는 방법은 여러 군데 잘 나와 있다. Piwik은 그럼 어떻게 넣을까? 이미지 태그 기법을 사용하는 수밖에 없는데, AMP는 이미지 태그 기법 추적 코드를 위해 `amp-pixel`이라는 태그를 제공한다.

한 마디로 아래와 같은 코드를 AMP 페이지에 추가하면 된다. 

    <amp-pixel src="https://piwik.example.org/piwik.php?idsite=YOUR_SITE_ID&amp;rec=1&amp;action_name=TITLE&amp;urlref=DOCUMENT_REFERRER&amp;url=CANONICAL_URL&amp;rand=RANDOM&amp;_rcn=amp"></amp-pixel>

위에서 `piwik.example.org`를 Piwik의 올바른 주소로 교체하고, `YOUR_SITE_ID`를 Piwik이 관리하는 아이디 번호로 변경해 주면 된다. Piwik으로 통계 보러 들어가서 URL에 있는 `idSite` 값을 살펴 보면 된다. `_rcn`은 Campaign name을 적는 부분인데, 빼도 되고 임의로 적어도 된다. 난 amp라고 적었다.

그 외 `TITLE`, `DOCUMENT_REFERRER`, `CANONICAL_URL`, `RANDOM`이라고 넣은 값은 그대로 두면 된다. AMP가 알아서 처리한다고 한다. 그래서 실제 예시는 아래처럼 될 것이다.

    <amp-pixel src="https://piwik.wspaper.org/piwik.php?idsite=1&amp;rec=1&amp;action_name=TITLE&amp;urlref=DOCUMENT_REFERRER&amp;url=CANONICAL_URL&amp;rand=RANDOM&amp;_rcn=amp"></amp-pixel>

## 인자값 설명

인자값에 대한 자세한 설명은 <https://developer.piwik.org/api-reference/tracking-api>를 참고하면 된다.

- `idsite`(필수): Piwik에서 관리하는 사이트의 아이디 값
- `rec`(필수): 추적 필수 여부. 값은 1로 넣는다.
- `url`(필수): 현재 액션의 전체 URL.
- `action_name`(권장): 추적하는 액션의 제목. 카테고리를 표현하기 위해 `/`를 사용할 수 있다. 예컨대, `도움말/피드백`은 도움말이라는 카테고리의 피드백이라는 액션을 생성할 것이다. 하지만 그냥 페이지의 제목을 넣으면 되겠다.
- `rand`(권장): 추적 요청 캐시 방지를 위해서 사용하는 랜덤값.
- `urlref`(선택): 리퍼러 URL.
- `_rcn`(선택): 캠페인 이름. AMP에서 온 트래픽이라는 것을 구분하기 위해 넣었다.

이 정도면 설명은 됐을 듯하다.	

## PHP라면?

PHP라면 배열을 query string으로 변환해 주는 `http_build_query()` 함수를 사용하면 편하고 코드 가독성도 좋아진다. 아래는 예시다.

    <?php
    $params = array(
        'idsite' => 1,
        'rec' => 1,
        'action_name' => 'TITLE',
        'urlref' => 'DOCUMENT_REFERRER',
        'url' => 'CANONICAL_URL',
        'rand' => 'RANDOM',
        '_rcn' => 'amp', // The Campaign name. https://developer.piwik.org/api-reference/tracking-api
    );
    $http_query = http_build_query($params);
    ?>
    <amp-pixel src="https://piwik.wspaper.org/piwik.php?<?= $http_query ?>"></amp-pixel>

## 참고

<https://gist.github.com/tiefenb/50041bb1f99762587e0b>를 참고했다.
