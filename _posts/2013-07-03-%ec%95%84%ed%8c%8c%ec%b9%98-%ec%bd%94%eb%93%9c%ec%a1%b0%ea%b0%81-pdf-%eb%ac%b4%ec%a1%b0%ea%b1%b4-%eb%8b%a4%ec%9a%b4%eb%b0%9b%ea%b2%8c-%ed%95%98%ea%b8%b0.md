---
title: '[아파치 코드조각] PDF 무조건 다운받게 하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10490
daumview_id:
  - 47364940
categories:
  - 서버단
tags:
  - apache
---
`.htaccess` 파일을 만들어 아래 내용을 넣고 FTP로 업로드 폴더에 넣으면 된다.

<pre>&lt;FilesMatch "\.(?i:doc|odf|pdf|rtf|txt)$"&gt;
  Header set Content-Disposition attachment
&lt;/FilesMatch&gt;</pre>

위처럼 하면 doc, odf, pdf, rtf, txt 파일을 브라우저가 보여 주지 않고 다운로드 받게 한다.

물론 꼭 이렇게까지 해야 하나 싶긴 하다. 브라우저에서 PDF를 보는 게 특별히 나쁘다고 생각하지 않기 때문이다. 사용자들도 그리 당황하지 않는다고 본다. 사용자들은 뒤로 가기 기능을 아주 잘 이해하고 있으니 말이다. 이제는 저장 기능도 나름대로 잘 사용하고.

물론 저장하는 걸 못해서 당황하는 사용자들도 좀 있을 텐데, PDF를 브라우저가 바로 보여 주게 된 지 꽤 돼서 이것도 많이 좋아지지 않았나 싶다. 이상.