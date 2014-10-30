---
title: javascript ArrayList() function
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/231
aktt_notify_twitter:
  - yes
daumview_id:
  - 37129617
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
자바스크립트 함수로 ArrayList를 구현해 놓은 것입니다.

필요할 때가 있을 지도 몰라서 링크합니다.

<http://www.koders.com/javascript/fid32ECAD6CCE114257D4044549E14ABCEC1332DF7E.aspx#L2>

이 페이지에서 제공하는 것은 ArrayList뿐 아니라 

<span class="Apple-style-span" style="font-family: Verdana, Helvetica, sans-serif; font-size: 11px; line-height: 12px; border-collapse: collapse; ">&nbsp; &nbsp;<a title="ArrayList.js" href="http://www.koders.com/javascript/fid32ECAD6CCE114257D4044549E14ABCEC1332DF7E.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">ArrayList.js<br /></a>&nbsp; &nbsp;<a title="AssertUtil.js" href="http://www.koders.com/javascript/fid110C5490AEBC7C3C036D494C5CFC59865690017E.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">AssertUtil.js<br /></a>&nbsp; &nbsp;<a title="Collection.js" href="http://www.koders.com/javascript/fid95B8D6C208ED3FF1384B4D3264D78A47E707FB43.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">Collection.js<br /></a>&nbsp; &nbsp;<a title="DomUtil.js" href="http://www.koders.com/javascript/fidBC000ECD64DCB94DDCA3E82D3A294907478508B8.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">DomUtil.js<br /></a>&nbsp; &nbsp;<a title="EventDispatcher.js" href="http://www.koders.com/javascript/fidB8EF5A6C4718CB28A51A3315D1691CB0D0A50DBC.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">EventDispatcher.js<br /></a>&nbsp; &nbsp;<a title="EventWrapper.js" href="http://www.koders.com/javascript/fidB8619D5ADDFC56C564805C30B0564D8C60C250BD.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">EventWrapper.js<br /></a>&nbsp; &nbsp;<a title="Exceptions.js" href="http://www.koders.com/javascript/fid19207FC296F9F83508DB9F520594CA7A3DFC68E9.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">Exceptions.js<br /></a>&nbsp; &nbsp;<a title="Logger.js" href="http://www.koders.com/javascript/fid997E0F4F02697F5EA043CFE854BC3337E00A70F4.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">Logger.js<br /></a>&nbsp; &nbsp;<a title="Map.js" href="http://www.koders.com/javascript/fid3A6CEA4E02E47898E855C7F82745019F54548240.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">Map.js<br /></a>&nbsp; &nbsp;<a title="StringUtil.js" href="http://www.koders.com/javascript/fidAD6A2D3030E4202577607E5704379EEAAFF20C50.aspx" style="color: rgb(51, 102, 153); text-decoration: none; ">StringUtil.js</a></span>

이렇게 다양합니다.

[#M_펼쳐두기..|접어두기..|

<pre class="brush:js">function ArrayList()
{
  this.array = new Array();
  this.add = function(obj){
    this.array[this.array.length] = obj;
  }
  this.iterator = function (){
    return new Iterator(this)
  }
  this.length = function (){
    return this.array.length;
  }
  this.get = function (index){
    return this.array[index];
  }
  this.addAll = function (obj)
  {
    if (obj instanceof Array){
      for (var i=0;i&lt;obj.length;i++)
      {
        this.add(obj[i]);
      }
    } else if (obj instanceof ArrayList){
      for (var i=0;i&lt;obj.length();i++)
      {
        this.add(obj.get(i));
      }
    }
  }
}

function Iterator (arrayList){
  this.arrayList;
  this.index = 0;
  this.hasNext = function (){
    return this.index &lt; this.arrayList.length();
  }
  this.next = function() {
    return this.arrayList.get(index++);
  }
}
</pre>

_M#]