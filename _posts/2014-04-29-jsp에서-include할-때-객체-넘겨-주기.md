---
title: jsp에서 include할 때 객체 넘겨 주기
author: 안형우
layout: post
permalink: /archives/12985
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12985-java-object-param-when-include.md
categories:
  - 서버단
tags:
  - JAVA
  - jsp
---
PHP 같은 경우는 include하면 그냥 부모 파일과 변수를 공유한다. 물론 jsp에서도 `<%@include file="..." %>`를 사용하면 마찬가지로 변수를 공유하게 된다. 그런데 문제는 jsp는 이렇게 하면 이클립스에서 에러 표시가 왕창 뜨고 자동완성도 안 된다는 거다. 난 이런 꼴이 보기 싫어서 다른 방법을 찾았다.

`request` 객체에 `setAttribute`하면 같은 request 안에서는 항목을 공유할 수 있다. 객체도 세팅할 수 있다.

    <h2>Uplink Status</h2>
    <%
    request.setAttribute("item", item);
    request.setAttribute("type", type);
    request.setAttribute("configuration", configuration);
    if(configuration.getOption_mode().equals("local")){ %>
        <jsp:include page="include/bridge_view_uplink_status_local.jsp" />  
    <% }else{ %>
        <jsp:include page="include/bridge_view_uplink_status_remote.jsp" />
    <% } %>
    

이렇게 하고, include된 파일 안에서는 아래처럼 쓰면 된다.

    // include/bridge_view_uplink_status_local.jsp
    <jsp:useBean id="item" scope="request" type="bridge.datamodel.DMBridgeInfo" />
    <jsp:useBean id="type" scope="request" type="java.lang.Integer" />
    <jsp:useBean id="configuration" scope="request" type="bridge.datamodel.DMConfiguration" />
    

이렇게 하면 이클립스 에러도 안 나고, 자동완성 기능도 잘 작동한다.