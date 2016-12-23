---
title: '[php] EXIF, IPTC 데이터 &#8211; 사진 메타데이터 뽑는 함수'
author: 안형우
layout: post
permalink: /archives/531
aktt_notify_twitter:
  - yes
daumview_id:
  - 36964550
categories:
  - 서버단
tags:
  - PHP
---
일단, EXIF와 IPTC를 뽑는 함수는 대부분의 PHP에 설치돼 있는 것 같다. 버전 4도 지원하는 듯하다.

php 공식 홈페이지의 설명을 보자.

<a target="_blank" href="http://kr.php.net/manual/en/book.exif.php">exif 관련 함수 설명</a>

<a target="_blank" href="http://php.net/manual/en/function.iptcparse.php">iptcparse 설명</a>

그리고 위의 설명과 댓글을 참고해 내가 만든 함수다.

<pre class="brush:php">function viewPhotoInfoArray($image_filename){
	/**
	 * exif 뽑아서 출력
	 * @var unknown_type
	 */
	echo &#039;&lt;h2&gt;EXIF data&lt;/h2&gt;&#039;;
	
	$exif = exif_read_data($image_filename, &#039;IFD0&#039;);
	echo $exif===false ? "No header data found.&lt;비알/&gt;\n" : "Image contains headers&lt;비알/&gt;\n";

	$exif = exif_read_data($image_filename, 0, true);
	echo "$image_filename :&lt;비알/&gt;\n";
	foreach ($exif as $key =&gt; $section) {
		foreach ($section as $name =&gt; $val) {
			echo "$key.$name: $val&lt;비알/&gt;\n";
		}
	}

	/**
	 * iptc 뽑아서 출력
	 * @var unknown_type
	 */
	$size = GetImageSize ("$image_filename",&$info);
	$iptc = iptcparse ($info["APP13"]);
	if (isset($info["APP13"])) {
		$iptc = iptcparse($info["APP13"]);
		if (is_array($iptc)) {
			/**
			 * 저장된 그대로 뽑아서 보여준다.
			 */
			echo &#039;&lt;h2&gt;IPTC raw data&lt;/h2&gt;&#039;;
			foreach ($iptc as $key =&gt; $section) {
				foreach ($section as $name =&gt; $val) {
					echo "$key.$name: $val&lt;비알/&gt;\n";
				}
			}

			/**
			 * 나름대로 문자열로 설명을 달아서 보여 준다.
			 */
			$photo_info_array[description] = $iptc["2#120"][0];
			$photo_info_array[headline] = $iptc["2#105"][0];
			$photo_info_array[description_writer] = $iptc[&#039;2#122&#039;][0];
			$photo_info_array[creator] = $iptc["2#080"][0];
			$photo_info_array[copyright_notice] = $iptc["2#116"][0];
			$photo_info_array[source] = $iptc["2#110"][0];
			$photo_info_array[keyword] = $iptc[&#039;2#025&#039;];
			$photo_info_array[graphic_name] = $iptc["2#005"][0];
			$photo_info_array[urgency] = $iptc["2#010"][0];
			$photo_info_array[category] = $iptc["2#015"][0];
			// note that sometimes supp_categories contans multiple entries
			$photo_info_array[supp_categories] = $iptc["2#020"][0];
			$photo_info_array[spec_instr] = $iptc["2#040"][0];
			$photo_info_array[creation_date] = $iptc["2#055"][0];
			$photo_info_array[credit_byline_title] = $iptc["2#085"][0];
			$photo_info_array[city] = $iptc["2#090"][0];
			$photo_info_array[state] = $iptc["2#095"][0];
			$photo_info_array[country] = $iptc["2#101"][0];
			$photo_info_array[otr] = $iptc["2#103"][0];
			$photo_info_array[photo_source] = $iptc["2#115"][0];
			$photo_info_array = $iptc["2#120"][0];
		}

		echo &#039;&lt;h2&gt;IPTC to String&lt;/h2&gt;&#039;;
		foreach ($photo_info_array as $key =&gt; $val) {
			if(!is_array($val)){
				echo "$key: $val&lt;비알/&gt;\n";
			}else{
				foreach ($val as $section =&gt; $keyword_val){
					echo "$key.$section: $keyword_val&lt;비알/&gt;\n";
				}
			}
		}
	}
}
</pre>

<br/>이 자꾸 코드 그대로 안 나와서 <비알/>로 썼다.

뭐 굳이 구절구절 설명 달 필요 없을 것 같다. 위 함수는 보여 주는 함수니까 알아서 잘 사용하기 바란다.

그리고 $miage_filename은 경로를 포함해서 써야 한다는 걸 잊지 말고.