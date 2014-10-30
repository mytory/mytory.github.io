---
title: '[Eclipse PDT] &lt;?php 에서 php 안 나오게 하고 &lt;?만 나오게 하기(헬리오스 &#8211; 3.6버전만 됨)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1073
aktt_notify_twitter:
  - yes
daumview_id:
  - 36751698
categories:
  - 개발 툴
tags:
  - Eclipse
---
<del datetime="2012-06-29T15:14:03+00:00">*2011-07-09 추가 : 새로 알게 된 사실인데, <code>&lt;?</code> 형태는 나중에 사용하지 않을 계획이라고 한다. 따라서 <code>&lt;?php</code> 라고 써야 한다. 또한 <code>&lt;?=</code> 역시 <code>&lt;?php echo</code> 형태로 쓰는 게 낫다고 한다.</del>

*0212-06-30 추가 : PHP 5.4부터는 다시 `<?`와 `<?=`가 기본 옵션으로 활성화돼 있다는 이야기를 들었다. 걍 원래대로 쓰면 된다.

이클립스 PDT를 사용하면 참 편한데,  **Ctrl+클릭** 하면 함수가 어딨는지 척척 찾아 주기 때문이다.

그런데 `<?` 하고 타자를 치면 `<?php` 라고 자동으로 들어가 버리는 것이다.

이게 그냥 할 때는 상관 없는데, `<?=` 형태로 사용할 때는 늘 거슬린다.

그래서 없애는 방법을 찾았고, 금세 찾을 수 있었다.(단, 갈릴레오 &#8211; 3.5버전에서는 찾을 수 없었다.)

**Window > Preference > PHP > Editor > Typing** 에서 **&#8220;Add php after <?&#8221;** 뭐 이런 항목이 있는데 그놈을 체크 해제한다.

난 갈릴레오를 잘 사용하고 있었는데, 이것 때문에 헬리오스로 넘어갈 지도 모르겠다.