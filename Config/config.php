<?php
$dbname = 'oj';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '1234';
define ( 'LOGINTIMEOUT', 6 * 60 * 60 ); // 5小时 ACM标准比赛时间
define ('PAGEMAXSIZE', 4); // 一页显示的题目数
$langArr = array(
		'All',
		'C',
		'C++',
		'G++',
		'Java',
		'Pascal'
);
$statusArr = array(
		'All',
		'Queuing',
		'Compiling',
		'Running',
		'Accepted',
		'Presentation Error',
		'Wrong Answer',
		'Runtime Error',
		'Time Limit Exceeded',
		'Memory Limit Exceeded',
		'Output Limit Exceeded',
		'Compilation Error',
		'Out of Contest Time',
);
?>