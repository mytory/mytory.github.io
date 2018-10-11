---
title: [번역] 아무도 말하지 않는 PHP의 좋은 점
layout: post
tags: 
  - PHP
---

PHP에서 내가 좋아하는 점이 뭘까?

PHP는 실행후 죽도록 디자인됐다.

우리는 코드 중복, 혹은 나쁜 코드 포맷팅, 나쁜 변수명 등에 대해 두려워해선 안 된다. 앞서 언급한 것들은 나쁜 코드 냄새를 풍기는 것들이다. 하지만 코드를 오염시키는 측면에서 상태있음(statefulness)[^fn1]에 필적한 만한 것은 없다.

PHP의 가장 큰 제약중 하나고, 많은 사람들이 싫어하는 점이고, 동시에 신입 개발자가 작성한 관리하기 쉬운 형편없는 PHP 코드를 만드는 유일하고 거대한 요인이 이것이다. 대부분의 경우 상태(state)는 PHP 프로세스와 완전히 분리돼 있다. 상태는 (서버측) 데이터베이스에 저장되고, 존나 최악의 코드 샘플에선 데이터베이스만이 뭔가 우리가 의존할 수 있는 유일한 진리의 소스(source of truth)다. 그래서 버그 재연이 (대개) 쉽고, 점진적인 코드 재작성(같은 데이터베이스 — 즉, 상태 — 를 사용하는 옛 코드와 새 코드)이 가능하다. 그리고 배포가 아주 쉽다. 그냥 스크립트를 업로드하면 된다! 그리고 개발하고, 와우, 그냥 해당 줄을 수정하고, 파일을 저장하고... 그러면 작동한다! 생각해 보라.

- Stateless (this is trendy now, right?)
- Easy deployment
- Easy development
- Easy debugging
- All of this happiness is just there out of the box, because it dies every time.

Talking about this language design choice - I am even not sure this was intentional (UPD: [okay, Rasmus Lerdorf confirmed it was intentional on HN discussion of this article](https://news.ycombinator.com/item?id=17853755)), this might be a side effect. But this restriction, I think, is one of the reasons why PHP, historically full of bad code and strange architectural decisions, gained its popularity, and is still alive as a technology.

This simple concept of strict state separation was alien in JS world because it was not there by design, this is why most frontend frameworks of the first wave (like Angular 1) (and complex jQuery code, of course) were such a pain in the ass before Redux and other solutions were invented, which separated state from interface and finally made it manageable. In JS, you can separate state. In PHP, you have to.

Every time I see Node.js code of sample websocket chat which is a long-living process I can't help myself and shudder because of this global "subscribers" variable which holds all the open websocket connections - I just see how this async long-living complexity explodes in hands of young and fast-typing developer.

This is why Ajax, when it was introduced, while giving so much good stuff to end users, made the life of PHP developers so complex - state suddenly appeared on the frontend and we could not even imagine where this will lead us - jQuery, then Backbone, then Angular, then React, and here we go - now we have the frontend developer profession - separate people dealing with state and stateful interfaces there on the front.

This is why you should be careful when working with queues and daemons (and you will still need them in any mid-sized PHP project). They do not forgive, they are hard to debug and the memory leaks and OS kills them once in a while when your bad code is launched in production. Regular PHP script forgives you, please remember this and appreciate it the next time when you wish your old PHP framework to be better in async code and long-living threads support, or when you praise Docker for being stateless - PHP is stateless, too :)

UPD: 
HackerNews discussion: <https://news.ycombinator.com/item?id=17853755>




[^fn1]: 상태(state)라는 컴퓨터 용어를 이해할 필요가 있다. 단순하게 시스템 환경이라고 이해하면 된다. 시스템 환경은 다양한 층위가 있다. OS에도 상태가 있고, 웹서버에도 상태가 있고, 애플리케이션에도, 통신에도 상태가 있다. 무엇인지는 이 글을 읽으면서 생각해 보자. 

[^fn]: 아주 간단하게 말해서 PHP에 상태가 없다는 것은