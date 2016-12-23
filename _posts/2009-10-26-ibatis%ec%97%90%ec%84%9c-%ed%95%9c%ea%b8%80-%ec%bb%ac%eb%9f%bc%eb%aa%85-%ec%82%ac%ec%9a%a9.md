---
title: ibatis에서 한글 컬럼명 사용
author: 안형우
layout: post
permalink: /archives/80
aktt_notify_twitter:
  - yes
daumview_id:
  - 37233786
categories:
  - 서버단
tags:
  - JAVA
---
<pre title="code" class="brush: xhtml;highlight: [4]; ">&lt;!-- Local Apache Commons DBCP DataSource --&gt;
&lt;bean id="dataSource" class="org.apache.commons.dbcp.BasicDataSource" destroy-method="close"&gt;
	&lt;property name="driverClassName" value="com.mysql.jdbc.Driver"/&gt;
	&lt;property name="url" value="jdbc:mysql://localhost:3306/DBname?useUnicode=yes&amp;characterEncoding=UTF8"/&gt;
	&lt;property name="username" value="mysql_id"/&gt;
	&lt;property name="password" value="mysql_pass"/&gt;
&lt;/bean&gt;</pre>

4번째 줄에 보면 DBname 뒤편에

<pre title="code" class="brush: xhtml;">useUnicode=yes&amp;characterEncoding=UTF8</pre>

라는 문장이 보일 것이다. 유니코드를 켜고 UTF8로 설정을 하면 된다.

**<span style="color: rgb(255, 0, 0);">주의할 점!!! 대문자로 써야 한다.</span>**

**<span style="color: rgb(255, 0, 0);">주의할 점!!! 가운데 UTF-8이 아니라 UTF8이다.<br /> </span>**

EUCKR일 경우 해 보지는 않았지만, EUCKR로 써 넣으면 되지 않을까 한다.