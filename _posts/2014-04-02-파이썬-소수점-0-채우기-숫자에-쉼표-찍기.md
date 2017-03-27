---
title: 파이썬 소수점 0 채우기, 숫자에 쉼표 찍기
author: 안형우
layout: post
permalink: /archives/12832
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12832-python-number-format.md
categories:
  - 서버단
tags:
  - Python
---
아래 예제는 《다이브 인투 파이썬》의 [챕터3][1]의 &#8220;3.5 문자열 형식화&#8221;에서 퍼온 것이다.

    print "Today's stock price: %f" % 50.4625
    # 50.462500
    print "Today's stock price: %.2f" % 50.4625
    # 50.46
    print "Change since yesterday: %+.2f" % 1.5
    # +1.50
    

뭐 이렇게 간단하다.

그리고 숫자에 쉼표를 찍는 코드는 아래와 같다.

    '{:,.2f}'.format(12333)
    # '12,333.00'
    '{:,}'.format(12333)
    # '12,333'
    

이 코드의 출처는 숫자에 쉼표를 어떻게 찍냐는 질문에 대한 [New in 2.7][2]이라는 답변이다.

 [1]: http://coreapython.hosting.paran.com/dive/chap03.html
 [2]: http://stackoverflow.com/a/3393776