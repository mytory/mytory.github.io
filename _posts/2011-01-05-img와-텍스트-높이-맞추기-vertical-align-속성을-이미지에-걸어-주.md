---
title: 'img와 텍스트 높이 맞추기 : vertical-align 속성을 이미지에 걸어 주기'
author: 안형우
layout: post
permalink: /archives/797
aktt_notify_twitter:
  - yes
daumview_id:
  - 36779320
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
<p style="font-family: 굴림; font-size: 9pt; line-height: 1.5; color: rgb(51, 51, 51); ">
  <font class="Apple-style-span" face="AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif" size="2"><span class="Apple-style-span" style="line-height: 20px;">텍스트 사이에 이미지를 넣을 때 골치아픈 문제가 있다. 텍스트 높이와 이미지 높이를 같게 해도 이미지가 꼭 위로 튀어 올라가는 문제가 있다.</span></font>
</p>

<p style="font-family: 굴림; font-size: 9pt; line-height: 1.5; color: rgb(51, 51, 51); ">
  <font class="Apple-style-span" face="AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif" size="2"><span class="Apple-style-span" style="line-height: 20px;"><div style="width: 263px" class="wp-caption aligncenter">
    <img src="/uploads/legacy/old-images/1/cfile25.uf.143F2D4A4D4BC96B3248BE.png" width="253" height="29" alt="" filename="cfile25.uf.143F2D4A4D4BC96B3248BE.png" filemime="" /><p class="wp-caption-text">
      △텍스트와 img를 그냥 한 줄에 넣으면 이렇게 높이가 어긋난다.
    </p>
  </div></span></font>
</p>

<p style="color: rgb(51, 51, 51); ">
  <font class="Apple-style-span" face="AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif" size="2"><span class="Apple-style-span" style="line-height: 20px;">이 때 과거에 사용했던 태그는 <img&nbsp;</span></font><span class="Apple-style-span" style="font-family: AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif; line-height: 20px; font-size: small; ">align=&#8221;absmiddle&#8221; src=&#8221;&#8230;&#8221;> 이었다고 한다.</span>
</p>

<p style="color: rgb(51, 51, 51); ">
  <span class="Apple-style-span" style="font-family: AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif; line-height: 20px; font-size: small; ">그러나&nbsp;</span><span class="Apple-style-span" style="font-family: AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif; line-height: 20px; font-size: small; ">align=&#8221;absmiddle&#8221; 태그는 비표준이라고 한다.</span>
</p>

<p style="color: rgb(51, 51, 51); ">
  <span class="Apple-style-span" style="font-family: AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif; line-height: 20px; font-size: small; ">따라서 앞으로는 css 속성인&nbsp;</span><span class="Apple-style-span" style="color: rgb(0, 0, 0); font-family: AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif; line-height: 20px; font-size: 13px; "><a href="http://www.w3schools.com/cssref/pr_pos_vertical-align.asp" target="_blank" title="[http://www.w3schools.com/css/pr_pos_vertical-align.asp]로 이동합니다.">vertical-align</a> 을 사용하자.</span>
</p>

<font class="Apple-style-span" color="#333333" face="AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif" size="2"><span class="Apple-style-span" style="line-height: 20px;"><span class="Apple-style-span" style="color: rgb(0, 0, 0); font-size: 13px; "><b>vertical-align 은 img 에 걸어 줘야 한다.</b> img의 부모에 걸어 줘 봤자 무용지물이다.</span></span></font>

<font class="Apple-style-span" face="AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif" size="2"><span class="Apple-style-span" style="line-height: 20px;">속성연 여러 가지가 있는데, top, middle, bottom 을 써 보면서 적당한 높이를 고르자.</span></font>

<font class="Apple-style-span" face="AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif" size="2"><span class="Apple-style-span" style="line-height: 20px;">top을 썼더니 텍스트와 높이가 일치하는 것을 확인했다. 아래는 각각을 적용했을 때 결과다.</span></font>

<font class="Apple-style-span" face="AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif" size="2"><span class="Apple-style-span" style="line-height: 20px;"><div style="width: 263px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile29.uf.19502B4F4D4BC96B278622.png" width="253" height="25" alt="" filename="cfile29.uf.19502B4F4D4BC96B278622.png" filemime="" /><p class="wp-caption-text">
    △ vertical-align: top
  </p>
</div></span></font>

<font class="Apple-style-span" face="AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif" size="2"><span class="Apple-style-span" style="line-height: 20px;"><div style="width: 264px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile23.uf.150FAE564D4BC96B2C99EF.png" width="254" height="32" alt="" filename="cfile23.uf.150FAE564D4BC96B2C99EF.png" filemime="" /><p class="wp-caption-text">
    △ vertical-align: middle
  </p>
</div></span></font>

<font class="Apple-style-span" face="AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif" size="2"><span class="Apple-style-span" style="line-height: 20px;"><div style="width: 259px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile22.uf.1570C4514D4BC96B1E8768.png" width="249" height="29" alt="" filename="cfile22.uf.1570C4514D4BC96B1E8768.png" filemime="" /><p class="wp-caption-text">
    △ vertical-align: bottom
  </p>
</div></span></font>

  
이 글을 쓰기 위해 참고한 글은&nbsp;<a href="http://forum.standardmag.org/viewtopic.php?pid=10245#p10245" target="_blank" style="color: rgb(51, 51, 51); font-family: AppleGothic, 애플고딕, 'Malgun Gothic', '맑은 고딕', 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Gulim, 굴림, sans-serif; font-size: small; line-height: 20px; ">http://forum.standardmag.org/viewtopic.php?pid=10245#p10245</a>&nbsp;다.