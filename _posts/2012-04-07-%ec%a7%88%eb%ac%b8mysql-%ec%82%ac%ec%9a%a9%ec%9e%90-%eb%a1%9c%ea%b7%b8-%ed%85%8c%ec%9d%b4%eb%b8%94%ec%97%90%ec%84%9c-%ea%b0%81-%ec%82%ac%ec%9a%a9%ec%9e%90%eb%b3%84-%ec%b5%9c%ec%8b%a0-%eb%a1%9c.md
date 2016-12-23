---
title: '[질문:MySQL] 사용자 로그 테이블에서, 각 사용자별 최신 로그만 1줄씩, 단 한 번의 쿼리로 가져오려면?'
author: 안형우
layout: post
permalink: /archives/2403
aktt_notify_twitter:
  - yes
daumview_id:
  - 36611184
categories:
  - 서버단
tags:
  - MySQL
---
아래와 같은 DB 테이블이 있다. id\_person과 id\_class를 연결하는 relation 테이블이다. 반이 변하는 것을 기록해 누적한다.

보면 알 수 있겠지만, 1번 id_person은 2반이었다가 4반이었다가 1반이 됐다.

2번 id_person은 3반이었다가 1반이 됐다.

<table width="360" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="22">
      id
    </td>
    
    <td>
      id_person
    </td>
    
    <td>
      id_class
    </td>
    
    <td>
      date_written
    </td>
  </tr>
  
  <tr>
    <td>
      53
    </td>
    
    <td>
      <strong><span style="color: #008000;">1</span></strong>
    </td>
    
    <td>
      <strong><span style="color: #008000;">1</span></strong>
    </td>
    
    <td>
      2012-04-05 16:40
    </td>
  </tr>
  
  <tr>
    <td>
      50
    </td>
    
    <td>
      <strong><span style="color: #008000;">1</span></strong>
    </td>
    
    <td>
      <strong><span style="color: #008000;">4</span></strong>
    </td>
    
    <td>
      2012-04-05 16:02
    </td>
  </tr>
  
  <tr>
    <td>
      1
    </td>
    
    <td>
      <strong><span style="color: #008000;">1</span></strong>
    </td>
    
    <td>
      <strong><span style="color: #008000;">2</span></strong>
    </td>
    
    <td>
      2012-03-30 17:56
    </td>
  </tr>
  
  <tr>
    <td>
      2
    </td>
    
    <td>
      <span style="color: #ff0000;"><strong>2</strong></span>
    </td>
    
    <td>
      <span style="color: #ff0000;"><strong>3</strong></span>
    </td>
    
    <td>
      2012-03-30 17:56
    </td>
  </tr>
  
  <tr>
    <td>
      51
    </td>
    
    <td>
      <span style="color: #ff0000;"><strong>2</strong></span>
    </td>
    
    <td>
      <span style="color: #ff0000;"><strong>1</strong></span>
    </td>
    
    <td>
      2012-04-05 16:36
    </td>
  </tr>
  
  <tr>
    <td>
      3
    </td>
    
    <td>
      3
    </td>
    
    <td>
      4
    </td>
    
    <td>
      2012-03-30 17:56
    </td>
  </tr>
  
  <tr>
    <td>
      52
    </td>
    
    <td>
      3
    </td>
    
    <td>
      1
    </td>
    
    <td>
      2012-04-04 16:37
    </td>
  </tr>
  
  <tr>
    <td>
      4
    </td>
    
    <td>
      4
    </td>
    
    <td>
      5
    </td>
    
    <td>
      2012-03-30 17:56
    </td>
  </tr>
  
  <tr>
    <td>
      5
    </td>
    
    <td>
      5
    </td>
    
    <td>
      6
    </td>
    
    <td>
      2012-03-30 17:56
    </td>
  </tr>
  
  <tr>
    <td>
      6
    </td>
    
    <td>
      6
    </td>
    
    <td>
      7
    </td>
    
    <td>
      2012-03-30 17:56
    </td>
  </tr>
  
  <tr>
    <td>
      7
    </td>
    
    <td>
      7
    </td>
    
    <td>
      1
    </td>
    
    <td>
      2012-03-30 17:56
    </td>
  </tr>
  
  <tr>
    <td>
      8
    </td>
    
    <td>
      8
    </td>
    
    <td>
      2
    </td>
    
    <td>
      2012-03-30 17:56
    </td>
  </tr>
  
  <tr>
    <td>
      9
    </td>
    
    <td>
      9
    </td>
    
    <td>
      3
    </td>
    
    <td>
      2012-03-30 17:56
    </td>
  </tr>
</table>

자, 그런데 지금 뽑으려는 데이터는 각 id_person 이 **지금** 몇 반인가 하는 거다.

## 서브쿼리로 하면 되지만…

이 테이블만을 바탕으로 그걸 뽑을 수 있을까? 있었다. 아래처럼 쿼리를 사용하는 거다.

<pre class="brush: sql; gutter: true; first-line: 1">SELECT p.*
FROM `person_class_relation_table` AS p
WHERE date_written=(SELECT MAX(date_written) FROM person_class_relation_table WHERE id_person = p.id_person)</pre>

이렇게 서브쿼리를 사용하면 구할 수 있다. 그런데 목록이 많아지면 심각한 성능 저하 현상이 벌어질 거다.

## 질문 &#8211; 서브쿼리를 사용하지 않고 구할 수 있는 방법은?

서브쿼리를 사용하지 않고 구할 수 있는 방법은 뭐가 있을까?

내가 시도한 방법은 아래 쿼리다.

<pre class="brush: sql; gutter: true; first-line: 1">SELECT *, MAX(date_written)
FROM person_class_relation_table
GROUP BY id_person</pre>

이렇게 하니까 친절하게 id\_person으로 그룹이 지어져 나왔고, date\_written 항목은 다른 데이터들과 아무런 상관없이 그냥 최고값만 나왔다. 즉, id\_person 1번은 1반이어야 하는데 2반이라고 나왔다. 그런데 date\_written은 최신값. OTL;; 역시 GROUP BY는 id_person을 기준으로 그룹만 지어 주는 놈이었던 것이야…

다음으로는 이렇게 해 봤는데 작동하지 않았다.

<pre class="brush: sql; gutter: true; first-line: 1; highlight: [4]">SELECT *
FROM person_class_relation_table
GROUP BY id_person
WHERE date_written = MAX(date_written)</pre>

4번 줄이 오류 표시됐다. 저렇게 못 쓴다는 에러가 나온 거다 그냥.

여튼간에, 그래서 고수분들께 질문드린다. 내가 MySQL에 정말 취약하다는 것을 새삼 느끼면서 질문한다.

**이 경우 대체 어떻게 해야 할까?! **([같은 내용을 PHP School에 질문했다.][1])

## PHPSchool에서 풀잎 님이 해 준 [답변][2]

> 서브쿼리 없이 구하는 방법은 없을 것 같습니다.  
> 차라리 상태필드를 하나 더 입력하여  
> insert시 새로운 데이타는 상태 필드 = 1 로 입력하고,  
> 동일 id_person이 존재하면 과거 데이타의 상태필드 = 0으로  update 시키는 것이 바람직해 보입니다.  
> 그럼 굳이 group by를 하지 않더라도 where 상태필드 = 1 만으로도 원하는 효과를 얻을 수 있으리라 봅니다.
> 
> 물론 select가 더 빈번하게 일어나고 update?는 자주 일어나지 않는다는 조건하에서 이야기입니다.

이렇게 하는 게 나을 것 같다.

아래는 table 생성 쿼리다. 참고하면 된다.

<pre class="brush: sql; gutter: true; first-line: 1">--
-- 테이블 구조 `person_class_relation_table`
--

CREATE TABLE IF NOT EXISTS `person_class_relation_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT &#039;id&#039;,
  `id_person` int(11) NOT NULL COMMENT &#039;id_person&#039;,
  `id_class` int(11) NOT NULL COMMENT &#039;id_class&#039;,
  `date_written` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT &#039;입력일시&#039;,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- 테이블의 덤프 데이터 `person_class_relation_table`
--

INSERT INTO `person_class_relation_table` (`id`, `id_person`, `id_class`, `date_written`) VALUES
(1, 1, 2, &#039;2012-03-30 17:56:58&#039;),
(2, 2, 3, &#039;2012-03-30 17:56:58&#039;),
(3, 3, 4, &#039;2012-03-30 17:56:58&#039;),
(4, 4, 5, &#039;2012-03-30 17:56:58&#039;),
(5, 5, 6, &#039;2012-03-30 17:56:58&#039;),
(6, 6, 7, &#039;2012-03-30 17:56:58&#039;),
(7, 7, 1, &#039;2012-03-30 17:56:58&#039;),
(8, 8, 2, &#039;2012-03-30 17:56:58&#039;),
(9, 9, 3, &#039;2012-03-30 17:56:58&#039;),
(10, 10, 4, &#039;2012-03-30 17:56:58&#039;),
(11, 11, 5, &#039;2012-03-30 17:56:58&#039;),
(12, 12, 6, &#039;2012-03-30 17:56:58&#039;),
(13, 13, 7, &#039;2012-03-30 17:56:58&#039;),
(14, 14, 1, &#039;2012-03-30 17:56:58&#039;),
(15, 15, 2, &#039;2012-03-30 17:56:58&#039;),
(16, 16, 3, &#039;2012-03-30 17:56:58&#039;),
(17, 17, 4, &#039;2012-03-30 17:56:58&#039;),
(18, 18, 5, &#039;2012-03-30 17:56:58&#039;),
(19, 19, 6, &#039;2012-03-30 17:56:58&#039;),
(20, 20, 7, &#039;2012-03-30 17:56:58&#039;),
(21, 21, 1, &#039;2012-03-30 17:56:58&#039;),
(22, 22, 2, &#039;2012-03-30 17:56:58&#039;),
(23, 23, 3, &#039;2012-03-30 17:56:58&#039;),
(24, 24, 4, &#039;2012-03-30 17:56:58&#039;),
(25, 25, 5, &#039;2012-03-30 17:56:58&#039;),
(26, 26, 6, &#039;2012-03-30 17:56:58&#039;),
(27, 27, 7, &#039;2012-03-30 17:56:58&#039;),
(28, 28, 1, &#039;2012-03-30 17:56:58&#039;),
(29, 29, 2, &#039;2012-03-30 17:56:58&#039;),
(30, 30, 3, &#039;2012-03-30 17:56:58&#039;),
(31, 31, 4, &#039;2012-03-30 17:56:58&#039;),
(32, 32, 5, &#039;2012-03-30 17:56:58&#039;),
(33, 33, 6, &#039;2012-03-30 17:56:58&#039;),
(34, 34, 7, &#039;2012-03-30 17:56:58&#039;),
(35, 35, 1, &#039;2012-03-30 17:56:58&#039;),
(36, 36, 2, &#039;2012-03-30 17:56:58&#039;),
(37, 37, 3, &#039;2012-03-30 17:56:58&#039;),
(38, 38, 4, &#039;2012-03-30 17:56:58&#039;),
(39, 39, 5, &#039;2012-03-30 17:56:58&#039;),
(40, 40, 6, &#039;2012-03-30 17:56:58&#039;),
(41, 41, 7, &#039;2012-03-30 17:56:58&#039;),
(42, 42, 1, &#039;2012-03-30 17:56:58&#039;),
(43, 43, 2, &#039;2012-03-30 17:56:58&#039;),
(44, 44, 3, &#039;2012-03-30 17:56:58&#039;),
(45, 45, 4, &#039;2012-03-30 17:56:58&#039;),
(46, 46, 5, &#039;2012-03-30 17:56:58&#039;),
(47, 47, 6, &#039;2012-03-30 17:56:58&#039;),
(48, 48, 7, &#039;2012-03-30 17:56:58&#039;),
(49, 49, 1, &#039;2012-03-30 17:56:58&#039;),
(50, 1, 4, &#039;2012-04-05 16:02:07&#039;),
(51, 2, 1, &#039;2012-04-05 16:36:49&#039;),
(52, 3, 1, &#039;2012-04-04 16:37:09&#039;),
(53, 1, 1, &#039;2012-04-05 16:40:25&#039;);</pre>

&nbsp;

 [1]: http://phpschool.com/link/qna_db/186559
 [2]: http://www.phpschool.com/gnuboard4/bbs/board.php?bo_table=qna_db&wr_id=186559#c_186560