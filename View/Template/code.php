<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-success">
			<div class="panel-heading">
<?php
if (isset ( $_SESSION ['username'] ) && $_SESSION ['user_id'] == $user_id) {
	global $statusArr;
	global $langArr;
	echo '<h3 class="text-success">用户<a href="#">' . $_SESSION ['username'] . '</a>的提交记录  记录号：' . $submit_id . '</h3>';
	echo '<h4 class="text-muted">题目编号：<a href="/problem/show/' . $pro_id . '">' . $pro_id . '</a></h4>';
	echo '<h4 class="text-muted">提交时间：' . date ( "Y-m-d h:s:i", $submit_time ) . '</h4>';
	echo '<h4 class="text-muted">运行时间：' . $run_time . 'MS 运行内存：' . $run_memory . 'KB</h4>';
	echo '<h4 class="text-danger">语言：' . $langArr [$lang] . '</h4>';
	echo '<h4 class="text-danger">状态：' . $statusArr [$status] . '</h4>';
} else {
	echo '<h3 class="text-danger text-center">权限不足，或者未登录 3秒后自动跳转<a href="/status">立即跳转</a></h3>';
	echo <<<EOD
<script>
	$(document).ready(function(){
		var t=setTimeout("location.href='/status';", 3000)
	})
</script>;
EOD;
}
?>
		</div>
			<div class="panel-body">
<?php if(isset($_SESSION['username']) && $_SESSION['user_id'] == $user_id) {?>
<pre class="line-numbers command-line data-line"><code class="language-<?php
	if ($lang == 1)
		echo 'c';
	else if ($lang <= 3)
		echo 'cpp';
	else if ($lang == 4)
		echo 'java';
	?>"
style="font-size: 18px;"><?php if(isset($code)) echo htmlspecialchars($code); else echo htmlspecialchars($info);?></code></pre>
<?php }?>
		</div>
		</div>
	</div>
</div>