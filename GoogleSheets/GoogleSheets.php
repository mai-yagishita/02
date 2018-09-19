<?php
const SHEET_ID = "11BCnspCt2Mut3nhc4WMY6CYTd0zF9C3eCzsk1AEpKLM";
const SHEET_NAME = "sales";
const RANGES = "!A1:E6";
const API_KEY = "AIzaSyDwxpicDSa3GBcLJmgE1yxdtjYpIJFogcA";

// スプレッドシートのデータを取得するためのURL
$url =
"https://sheets.googleapis.com/v4/spreadsheets/"
		. SHEET_ID . "/values/" . SHEET_NAME . RANGES
		. "?key=" . API_KEY;

$json = [];
$json = file_get_contents($url);
$sheet_params = json_decode($json);

// エラーが発生した場合
if (isset($sheet_params->error)) {
	$error_message =
	"Status : {$sheet_params->error->code} {$sheet_params->error->status}\n"
	. "Message: {$sheet_params->error->message}";
	echo $error_message;
	exit;
}

// 正常の場合
foreach($sheet_params->values as $value) {
	echo sprintf("'%s','%s','%s','%s','%s',\n", $value[0], $value[1], $value[2], $value[3], $value[4]);
}
