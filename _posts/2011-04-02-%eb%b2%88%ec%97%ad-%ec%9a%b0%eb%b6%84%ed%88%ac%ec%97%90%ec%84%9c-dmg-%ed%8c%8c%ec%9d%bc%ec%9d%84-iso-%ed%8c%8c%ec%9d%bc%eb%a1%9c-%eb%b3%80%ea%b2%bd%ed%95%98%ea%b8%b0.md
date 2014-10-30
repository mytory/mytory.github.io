---
title: '[번역] 우분투에서 dmg 파일을 iso 파일로 변경하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1057
Description:
  - 애플의 CD 이미지 파일 형식인 dmg 파일을 iso 이미지로 변환해 주는 perl 스크립트에 대한 설명입니다. 우분투 사용자들이 편하게 사용할 수 있도록 설명하고 있습니다. 물론 다른 운영체제 사용자들도 perl을 사용할 줄 안다면 역시 가져다 쓸 수 있을 것입니다.
aktt_notify_twitter:
  - no
daumview_id:
  - 36754303
categories:
  - 기타
tags:
  - Ubuntu Family
---
검색해서 발견했다. 그런데 내가 레드햇 리눅스에서 시도했을 때는 작동하지 않았다. 우분투 리눅스에서 시도하면 다를까 해서 번역해 옮긴다.

원문은 Ubuntu Quicktip – Converting Mac .dmg images into .iso images 다. [2012-07-16 원본 사이트가 사라졌다;;] 2007년 1월 23일에 작성된 글이다.

&#8212;&#8212;&#8212;&#8212;&#8212;-

최근에 유용한 스크립트를 발견했다. 맥 OSX나 애플 아이팟(이미지로 된 펌웨어)[의 CD 이미지 포맷인 dmg를] 표준 .iso 파일로 변환해 주는 스크립트다.

이걸 사용하려면 perl이 설치돼 있어야 한다. 그리고 perl의 zlib 모듈을 추가로 설치해 줘야 한다. 이렇게 설치한다:

<pre class="brush: bash; gutter: true; first-line: 1">sudo apt-get install libcompress-zlib-perl
cd /usr/bin
sudo wget http://www.blinkenlights.ch/gnupod/dmg2iso.pl</pre>

우분투에서 사용하려면 dmg2iso.pl 스크립트에서 변경해 줄 게 하나 있다.

<pre class="brush:shell">sudo gedit dmg2iso.pl</pre>

맨 윗 줄에 ‘`#!/usr/local/bin/perl`’ 하고 써 있을 거다. 이건 perl을 어디서 찾을 수 있는지 말해 주는 것이다. 내 경우에, perl은 ‘`/usr/bin/perl`’에 설치돼 있다. 필요하면 그렇게 고쳐 주자. (역자 주: 우분투 사용자들은 고치면 된다. ‘`#!/usr/bin/perl`’라고 고치면 된다.)

이제 실행할 수 있게 만들어 주자.

<pre class="brush:shell">sudo chmod 777 dmg2iso.pl</pre>

그다음 홈 디렉토리로 이동한다.

<pre>cd</pre>

`bloodspell.dmg` 라는 dmg 파일이 홈 디렉토리에 있다고 치자. iso 파일로 바꾸고 싶다면 아래와 같이 타이핑한다:

<pre class="brush:shell">dmg2iso.pl bloodspell.dmg bloodspell.iso</pre>

그러면 스크립트가 알아서 할 거다.

&#8212;&#8212;&#8212;&#8211; 역자의 추가 : dmg2iso.pl 스크립트의 내용을 옮긴다 &#8212;&#8212;&#8212;&#8212;-

<pre class="brush: perl; gutter: true; first-line: 1">#!/usr/bin/perl
#
# Downloaded from http://blinkenlights.ch/gnupod/dmg2iso.pl
#
# dmg2iso.pl was written by vu1tur, license ?!?
#
# Note: This doesn&#039;t look like the Version 0.2a provided at
#       http://vu1tur.eu.org/tools/ . But this version works with Apples iPod-Firmware dmg images..
# ...
#
#
use MIME::Base64;
use strict ;
local ($^W) = 1; #use warnings ;
use Compress::Zlib ;
my $x = inflateInit()
   or die "ERROR: Cannot create inflation stream. Is Compress::zlib installed?\n" ;
my $zfblock="\x00"; for (0..8) { $zfblock.=$zfblock; }
my $indxbeg=0;
my $indxend=0;
my @plist;
print "dmg2iso v0.2a by vu1tur (vu1tur\@gmx.de)\n\n";
if (@ARGV."" != 2) { die "Syntax: dmg2iso.pl filename.dmg filename.iso\n"; }
my $zeroblock = "\x00";
for (0..8) { $zeroblock.=$zeroblock; }
my $tmp;
my ($output,$status);
my $buffer;
open(FINPUT,$ARGV[0]) or die "ERROR: Can&#039;t open input file\n";

binmode FINPUT;
sysseek(FINPUT,-0x200000,2);
print "reading property list...";
my $fpos = sysseek(FINPUT,0,1);
while(my $ar = sysread(FINPUT,$buffer,0x10000))
{
	my $fpos = sysseek(FINPUT,0,1)-$ar;
	if ($buffer =~ /(.*)/s)
	{
		$indxbeg = $fpos+length($1);
	}
	if ($buffer =~ /(.*)&lt;\/plist&gt;/s)
	{
		$indxend = $fpos+length($1)+8;
	}
}
open(FOUTPUT,"&gt;".$ARGV[1]) or die "ERROR: Can&#039;t open output file\n";
binmode FOUTPUT;
my $indxcur = $indxbeg + 0x28;
sysseek(FINPUT,$indxbeg,0);
sysread(FINPUT,$tmp,$indxend-$indxbeg);

if ($tmp =~ s/.*blkx&lt;\/key&gt;.*?\s*(.*?)&lt;\/array&gt;.*/$1/s)
{
	while ($tmp =~ s/.*?(.*?)&lt;\/data&gt;//s)
	{
		my $t = $1;
		$t =~ s/\t//g;
		$t =~ s/^\n//g;
		push @plist,decode_base64($t);
	}
} else {
die "PropertyList is corrupted\n";
}
print "found ".@plist." partitions\n";
print "decompressing:\n";

my $t=0;
my $zoffs = 0;
my $tempzoffs = 0;
foreach (@plist)
{
	print "partition ".$t++."\n";
	s/^.{204}//s;
	while (s/^(.{8})(.{8})(.{8})(.{8})(.{8})//s)
	{
		$x = inflateInit();
		my $block_type = unpack("H*",$1);
		my $out_offs = 0x200*hex(unpack("H*",$2));
		my $out_size = 0x200*hex(unpack("H*",$3));
		my $in_offs = hex(unpack("H*",$4));
		my $in_size = hex(unpack("H*",$5));
		# $1 - block type, $2 - output offs $3 - output size $4 input offset $5 - input size
		sysseek(FINPUT,$in_offs+$zoffs,0);
		sysread(FINPUT,$tmp,$in_size);

		if ($block_type =~ /^80000005/)
		{
			($output,$status) = $x-&gt;inflate($tmp);
			if ($status == Z_OK or $status == Z_STREAM_END)
			{
				syswrite(FOUTPUT,$output,$out_size);
			} else { die "\nConversion failed. File may be corrupted.\n"; }
		}
		if  ($block_type =~ /^00000001/)
		{
			sysseek(FINPUT,$in_offs+$zoffs,0);
			sysread(FINPUT,$tmp,$in_size);
			syswrite(FOUTPUT,$tmp,$out_size);
		}
		if ($block_type =~ /^00000002/)
		{
			for(1..$out_size/0x200)
			{
				syswrite(FOUTPUT,$zeroblock,0x200);
			}
		}
		if ($block_type =~ /^FFFFFFFF/i)
		{
			$zoffs += $tempzoffs;
		}
		$tempzoffs = $in_offs+$in_size;
	}
}

print "\nconversion successful\n";</pre>