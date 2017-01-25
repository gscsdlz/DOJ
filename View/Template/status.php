
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form class="form-inline text-center" role="form" action=""
			method="get">
			<div class="form-group">
				<label>提交号</label> <input type="text" class="form-control"
					name="rid" />
			</div>
			<div class="form-group">
				<label>题目编号</label> <input type="text" class="form-control"
					name="pid" />
			</div>
			<div class="form-group">
				<label>用户名</label> <input type="text" class="form-control"
					name="Programmer" />
			</div>
			<div class="form-group">
				<label>语言</label> <select class="form-control" name="lang">
					<option value="0">C</option>
					<option value="1">G++</option>
					<option value="2">C++</option>
					<option value="3">Java</option>
				</select>
			</div>
			<div class="form-group">
				<label>状态</label> <select class="form-control" name="status">
					<option value="0">Accepted</option>
					<option value="1">Wrong Answer</option>
					<option value="2">Presentation Error</option>
					<option value="3">Time Limit Exceeded</option>
				</select>
			</div>
			<button type="submit" class="btn btn-default btn-primary">筛选</button>
		</form>
		<hr />
		<table class="table table-hover">
			<tr>
				<th>提交号</th>
				<th>提交时间</th>
				<th>题目编号</th>
				<th>运行时间</th>
				<th>运行内存</th>
				<th>代码长度</th>
				<th>语言</th>
				<th>状态</th>
				<th>用户名</th>
			</tr>
			<?php
			global $langArr;
			if ($args != null) {
				foreach ( $args as $row ) {
					echo '<tr>';
					echo '<td>' . $row [0] . '</td>';
					echo '<td>' . date ( "Y-m-d h:i:s", $row [1] ) . '</td>';
					echo '<td><a href="/problem/show/' . $row [2] . '">' . $row [2] . '</a></td>';
					echo '<td>' . $row [3] . 'MS</td>';
					echo '<td>' . $row [4] . 'KB</td>';
					echo '<td>' . $row [5] . 'B</td>';
					echo '<td>' . $langArr [$row [6]] . '</td>';
					echo '<td class="text-primary">Waiting</td>';
					echo '<td><a href="#">Daemon</a></td>';
					echo "</tr>\n";
				}
			} else {
				echo '<tr><td colspan="9" class="text-center text-danger">筛选条件不合法，找不到这样的数据，请重试</td></tr>';
			}
			?>
		</table>
		<nav>
			<ul class="pagination pagination-lg">
				<li><a href="#">&laquo;</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
		</nav>
	</div>
</div>