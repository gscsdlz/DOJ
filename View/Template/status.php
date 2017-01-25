
<div class="row">
	<div class="col-md-8 col-md-offset-2  text-center">
		<form class="form-inline" role="form" action="" method="get">
			<div class="form-group">
				<label>提交号</label> <input type="text" class="form-control"
					name="rid"
					value="<?php if(isset($_GET['rid'])) echo $_GET['rid']?>" />
			</div>
			<div class="form-group">
				<label>题目编号</label> <input type="text" class="form-control"
					name="pid"
					value="<?php if(isset($_GET['pid'])) echo $_GET['pid']?>" />
			</div>
			<div class="form-group">
				<label>用户名</label> <input type="text" class="form-control"
					name="Programmer"
					value="<?php if(isset($_GET['Programmer'])) echo $_GET['Programmer']?>" />
			</div>
			<div class="form-group">
				<label>语言</label> <select class="form-control" name="lang">
				<?php
				if (isset ( $_GET ['lang'] ))
					$id = ( int ) $_GET ['lang'];
				else
					$id = - 1;
				global $langArr;
				$i = 0;
				foreach ( $langArr as $row ) {
					if ($i == $id)
						echo '<option selected="selected" value="' . $i ++ . '">' . $row . '</option>';
					else
						echo '<option value="' . $i ++ . '">' . $row . '</option>';
				}
				?>
				</select>
			</div>
			<div class="form-group">
				<label>状态</label> <select class="form-control" name="status">
					<?php
					if (isset ( $_GET ['status'] ))
						$id = ( int ) $_GET ['status'];
					else
						$id = - 1;
					global $statusArr;
					$i = 0;
					foreach ( $statusArr as $row ) {
						if ($i == $id)
							echo '<option selected="selected" value="' . $i ++ . '">' . $row . '</option>';
						else
							echo '<option value="' . $i ++ . '">' . $row . '</option>';
					}
					?>
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
			if ($args != null) {
				global $loginStatus;
				if (isset ( $_SESSION ['username'] )) {
					$loginStatus = true;
				}
				foreach ( $args as $row ) {
					echo '<tr>';
					echo '<td>' . $row [0] . '</td>';
					echo '<td>' . date ( "Y-m-d h:i:s", $row [1] ) . '</td>';
					echo '<td><a href="/problem/show/' . $row [2] . '">' . $row [2] . '</a></td>';
					echo '<td>' . $row [3] . 'MS</td>';
					echo '<td>' . $row [4] . 'KB</td>';
					if ($loginStatus == true)
						echo '<td><a href="#">' . $row [5] . 'B</a></td>';
					else
						echo '<td>' . $row [5] . 'B</td>';
					echo '<td>' . $langArr [$row [6]] . '</td>';
					echo '<td class="text-';
					if ($row [7] == 4)
						echo 'danger';
					else if ($row [7] == 5)
						echo 'warning';
					else if ($row [7] >= 6 && $row [7] <= 10)
						echo 'success';
					else if ($row [7] == 11)
						echo 'primary';
					else
						echo 'muted';
					echo '">' . $statusArr [$row [7]] . '</td>';
					echo '<td><a href="#">' . $row [8] . '</a></td>';
					echo "</tr>\n";
				}
			} else {
				echo '<tr><td colspan="9" class="text-center text-danger">筛选条件不合法，找不到这样的数据，请重试</td></tr>';
			}
			?>
		</table>
		<nav>
			<ul class="pagination pagination-lg text-center">
				<li><a href="#">首页</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#">上一页</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#">下一页</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#">尾页</a></li>
			</ul>
		</nav>
	</div>
</div>