<?php
	/**
	*	Invalid ID ID不合法 一般是由于序号过大过小造成的 
	* 	Invalid Key 查询使用的关键词不对造成的
	*	Invalid Index
	*	Invalid action
	*	Invalid User
	*/
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 text-center text-danger">
	
		<?php
			if($errorInfo == 'Invalid Id') {
				echo '<h1>拒绝提供这个页面 请求序号不合法</h1>';
				echo '<img src="/Src/Image/Invalid Id.jpg" alt="..." width="400px" class="img-rounded">';
 			} else if ($errorInfo == 'Invalid Action') {
				echo '<h1>你调用了尚未编写的方法</h1>';
				echo '<a href="/"><img src="/Src/Image/Invalid Action.jpg" alt="..." width="400px" class="img-rounded"></a>';
			} else if ($errorInfo == 'Invalid User') {
				echo '<h1>你要查看的用户还没有注册，所以：</h1>';
				echo '<img src="/Src/Image/Invalid User.jpg" alt="..."  width="400px" class="img-rounded">';
			} else if ($errorInfo == 'Privilege Error' || $errorInfo == 'Time Error') {
				echo '<h1>权限不足或者比赛还未开始，所以：</h1>';
				echo '<img src="/Src/Image/Invalid User.jpg" alt="..."  width="400px" class="img-rounded">';	
			}
		 ?>
	</div>
</div>
﻿<script>
$(document).ready(function(){
		<?php if ($errorInfo == 'Privilege Error') {?>
			var t=setTimeout("location.href='/contest/page';", 3000)
		<?php } else {?>
		var t=setTimeout("location.href='/';", 3000)
		<?php }?>
})
</script>
