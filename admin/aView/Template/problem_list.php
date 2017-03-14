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
					echo '<td width="300px"><button type="button" class="btn btn-success" id="'.$row[0].'edit">修改题目</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" id="'.$row[0].'del">删除题目</button>&nbsp;&nbsp;&nbsp;&nbsp;';
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
	aria-labelledby="deleteModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h3 class="modal-title" id="codeModalLabel">删除不可逆！确认删除吗？</h3>
			</div>
			<div class="model-body text-center" id="errorInfo"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="closeModel">关闭</button>
				<button type="button" class="btn btn-danger" id="deleteProblem">删除</button>
			</div>
		</div>
	</div>
</div>
<script>
	var deleteId;
	$(document).ready(function(){
		$("button").hide();
		$("#deleteProblem").show();
		$("#closeModel").show();
		$("tr").mousemove(function(){
			var id = parseInt($(this).attr("id"));
			$("button").hide();
			$("#deleteProblem").show();
			$("#closeModel").show();
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

		$(".btn-success").click(function(){
			var id = parseInt($(this).attr("id"));
			window.location.href= "/admin/problemM/edit/" + id;
		})

		$(".btn-danger").click(function(){
			if($(this).attr("id") != 'deleteProblem')
				deleteId = parseInt($(this).attr("id"));
		})

		$("#deleteProblem").click(function(){
			$.post("/admin/problemM/del_problem", {pro_id:deleteId}, function(data){
				var arr = eval("(" + data + ")");
				if(arr['status'] == true) {
					window.location.reload();
				} else {
					$("#errorInfo").html("");
					$("#errorInfo").append('<h2 class="text-danger">'+arr['status']+"</h2>");
				}
			})
		})
	})
</script>
﻿

