<div class="row">
	<div class="col-md-6 col-md-offset-3 text-center">
<?php
		if (isset ( $_GET ['pageid'] )) {
			$pageid = $_GET['pageid'];
		?>
		<nav>
			<ul class="pagination pagination-lg">
				<li><a
					href="/admin/problemM/page/<?php if($pageid == 0 ) echo 0; else echo $pageid - 1;?>">&laquo;</a></li>
				
				<?php
			echo '<li><a href="/admin/problemM/page/0">0</a></li>';
			echo '<li><a href="#">...</a></li>';
			
			$maxPage = ceil ( $args [0] [0] / $args [0] [1] );
			for($i = 1; $i < $maxPage - 1; ++ $i)
				echo '<li><a href="/admin/problemM/page/' . $i . '">' . $i . '</a></li>';
			
			echo '<li><a href="#">...</a></li>';
			echo '<li><a href="/admin/problemM/page/' . ($maxPage - 1) . '">' . ($maxPage - 1) . '</a></li>';
			?>
				<li><a
					href="/admin/problemM/page/<?php if($pageid + 1 == $maxPage) echo $pageid; else echo $pageid + 1; ?>">&raquo;</a></li>
			</ul>
		</nav>
		<?php } else {?>
		<h1 class="text-center text-danger">隐藏题目或许已经在计划比赛中，操作前请确认！</h1>
		<?php }?>
		<table class="table table-hover table-bordered text-left">
			<tr>
				<th>题目编号</th>
				<th>题目名</th>
				<th>操作</th>
			</tr>
			<?php
			/**
			 * $args => [0] => pms, maxSIZE
			 * $args => [1...n] => pro_id, pro_title;
			 */
			if (isset ( $args ) && count ( $args ) != 0) {
				foreach ( $args as $row ) {
					
					if (!isset($row[2]))
						continue;
					if($row[2] == 0)
						echo '<tr class="danger" height="55px" id="'.$row[0].'tr">';
					else
						echo '<tr height="55px" id="'.$row[0].'tr">';
					echo '<td>' . $row [0].'</td>';
					echo '<td align="left"><a href="/problem/show/' . $row [0] . '">&nbsp;' . $row [1] . '</a></td>';
					echo '<td width="300px"><button type="button" class="btn btn-success" id="'.$row[0].'edit">修改题目</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" id="'.$row[0].'del">删除题目</button>&nbsp;&nbsp;&nbsp;&nbsp;';
					if($row[2] == 0) //不可见
						echo '<button type="button" class="btn btn-primary" id="'.$row[0].'show">显示题目</button></td></tr>';
					else
						echo '<button type="button" class="btn btn-default" id="'.$row[0].'hide">隐藏题目</button></td></tr>';
				}
			} else {
				echo '<tr><td colspan="3" class="text-danger text-center">找不到题目</td></tr>';
			}
			?>
		</table>
		<?php
		if (isset ( $_GET ['pageid'] )) {
			$pageid = $_GET['pageid'];
		?>
		<nav>
			<ul class="pagination pagination-lg">
				<li><a
					href="/admin/problemM/page/<?php if($pageid == 0 ) echo 0; else echo $pageid - 1;?>">&laquo;</a></li>
				
				<?php
			echo '<li><a href="/admin/problemM/page/0">0</a></li>';
			echo '<li><a href="#">...</a></li>';
			
			$maxPage = ceil ( $args [0] [0] / $args [0] [1] );
			for($i = 1; $i < $maxPage - 1; ++ $i)
				echo '<li><a href="/admin/problemM/page/' . $i . '">' . $i . '</a></li>';
			
			echo '<li><a href="#">...</a></li>';
			echo '<li><a href="/admin/problemM/page/' . ($maxPage - 1) . '">' . ($maxPage - 1) . '</a></li>';
			?>
				<li><a
					href="/admin/problemM/page/<?php if($pageid + 1 == $maxPage) echo $pageid; else echo $pageid + 1; ?>">&raquo;</a></li>
			</ul>
		</nav>
		<?php }?>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("button").hide();
		$("tr").mousemove(function(){
			var id = parseInt($(this).attr("id"));
			$("button").hide();
			$("#" + id + "edit").show();
			$("#" + id + "del").show();
			$("#" + id + "show").show();
			$("#" + id + "hide").show();
		})

		$(".btn-primary").click(function(){
			var id = parseInt($(this).attr("id"));
			$.post("/admin/problemM/show_problem", {id:id}, function(data){
				var arr = eval("(" + data + ")");
				if(arr['status'] == true)
					window.location.reload();
			})
		})

		$(".btn-default").click(function(){
			var id = parseInt($(this).attr("id"));
			$.post("/admin/problemM/hide_problem", {id:id}, function(data){
				var arr = eval("(" + data + ")");
				if(arr['status'] == true)
					window.location.reload();
			})
		})
	})
</script>
﻿

