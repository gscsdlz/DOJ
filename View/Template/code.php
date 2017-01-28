<div class="row">
	<div class="col-md-8 col-md-offset-2 panel panel-default">
		<div class="panel-heading">
<?php
if (isset ( $_SESSION ['username'] )) {
	echo '用户' . $_SESSION ['username'] . '的代码，提交记录号：' . $submit_id . '，题目编号:' . $pro_id.'，提交时间：' . date ( "Y-m-d h:s:i", $submit_time );
} else {
	echo '权限不足，或者未登录';
}
?>
		</div>
		<div class="panel-body">
<?php if(isset($_SESSION['username'])) {?>
<pre class="line-numbers command-line data-line"><code class="language-c" style="font-size: 18px;"><?php echo htmlspecialchars($code)?></code></pre>
<?php }?>
		</div>
	</div>
</div>