<?php
// $Id: back.inc.php,v 1.1.2.1 2003/02/28 02:42:57 panda Exp $
/*
 * PukiWiki back プラグイン
 * (C) 2002, Katsumi Saito <katsumi@jo1upk.ymt.prug.or.jp>
 *
 * [使用例]
 * #back(,,0)
 * #back(,left)
 * #back(,right,0)
 * #back(戻る,center,0,http://localhost)
 *
 * [引数]
 * 1 - 文言                  省略時:戻る
 * 2 - left, center, right   省略時:center
 * 3 - <hr> タグの有無       省略時:出力
 * 4 - 通常は、戻るなわけなんですが、どうしてもの場合の飛び先を指定可能
 */

function plugin_back_convert()
{
	$argv = func_get_args();

	// 初期値設定
	$word  = '戻る';
	$align = 'center';
	$hr    = 1;
	$href  = 'javascript:history.go(-1)';
	$ret   = '';

	// パラメータの判断
	if (func_num_args() > 0) {
		$word = htmlspecialchars(trim(strip_tags($argv[0])));
		if ($word == '') $word = '戻る';
	}
	if (func_num_args() > 1) {
		$align = htmlspecialchars(trim(strip_tags($argv[1])));
		if ($align == '') $align = 'center';
	}
	if (func_num_args() > 2) {
		$hr = trim(strip_tags($argv[2]));
	}
	if (func_num_args() > 3) {
		$href = rawurlencode(trim(strip_tags($argv[3])));
		if ($href == '') $href = 'javascript:history.go(-1)';
	}

	// <hr> タグを出力するかどうか
	if ($hr) {
		$ret = "<hr class=\"full_hr\">\n";
	}

	$ret.= "<div align=\"$align\">[ <a href=\"$href\">$word</a> ]</div>\n";

	return $ret;
}
?>
