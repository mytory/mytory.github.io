---
title: 트윗 검색
author: 녹풍
layout: page
---

저는 링크 저장 용도로 트위터를 사용합니다. 저장한 링크는 검색이 돼야 겠죠. 워드프레스를 사용할 때는 트윗을 긁어 모으는 플러그인을 만들어서 워드프레스에 긁어 모았는데, Jekyll로 옮기고 나서는 못 하고 있었습니다. 구글 앱 엔진으로 만들어서 `iframe`으로 넣을까 하고 생각하는 정도였죠. 

그런데 문득 구글 맞춤 검색을 이용하면 어떨까 싶어서 해 봤더니 잘 되네요. 검증해 본 건 아니라서 제 트윗이 전부 검색되는 건지까지는 모르겠습니다. 여튼간에 제가 사용할 용도로 달아 둡니다.

<script>
  (function() {
    var cx = '015481257105160606330:vxof5xakrb8';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>