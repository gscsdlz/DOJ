
<div class="row">
	<div class="col-md-8 col-md-offset-2  text-center">
		<form class="form-inline" role="form" action="" method="get">
			<div class="form-group">
				<input type="hidden" placeholder="提交号" class="form-control"
					name="rid"
					value="<?php if(isset($_GET['rid'])) echo $_GET['rid']?>" />
			</div>
			<div class="form-group">
				 <input type="text" placeholder="题目编号" class="form-control"
					name="pid"
					value="<?php if(isset($_GET['pid'])) echo $_GET['pid']?>" />
			</div>
			<div class="form-group">
				 <input type="text" placeholder="用户名" class="form-control"
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
			<input type="hidden" value="<?php if($contest) echo $contest;?>" name="cid">
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
				global $contest;
				if (isset ( $_SESSION ['username'] )) {
					$loginStatus = true;
				}
				foreach ( $args as $row ) {
					if (! isset ( $sid ))
						$sid = $row [0];
					$eid = $row [0];
					echo '<tr>';
					echo '<td>' . $row [0] . '</td>';
					echo '<td>' . date ( "Y-m-d H:i:s", $row [1] ) . '</td>';
					if ($contest) {
						echo '<td><a href="/contest/problem/' . $contest . '/' . $row [2] . '">' . $row [2] . '</a></td>';
					} else {
						echo '<td><a href="/problem/show/' . $row [2] . '">' . $row [2] . '</a></td>';
					}
					echo '<td>' . $row [3] . 'MS</td>';
					echo '<td>' . $row [4] . 'KB</td>';
					if ($loginStatus == true && ( $row [8] == $_SESSION ['username'] || $_SESSION['privilege'][0] == 1 || isset($_SESSION['privilege'][1][$contest]))) {
						if ($contest) {
							echo '<td><a href="/contest/code/' . $contest . '/' . $row [0] . '">' . $row [5] . 'B</a></td>';
						} else {
							echo '<td><a href="/code/show/' . $row [0] . '">' . $row [5] . 'B</a></td>';
						}
					} else
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
					if ($row [7] == '11' && isset ( $_SESSION ['username'] ) && ($_SESSION ['username'] == $row [8] || $_SESSION['privilege'][0] == 1 || isset($_SESSION['privilege'][1][$contest]))) {// CE
						if($contest) {
							echo '"><a href="/contest/ce/'  . $contest . '/' . $row [0] . '">' . $statusArr [$row [7]] .  '</a></td>';
						} else {
							echo '"><a href="/code/ce/' . $row [0] . '">' . $statusArr [$row [7]] . '</a></td>';
						}
					}
					else
						echo '">' . $statusArr [$row [7]] . '</td>';
					echo '<td><a href="/user/show/' . $row [8] . '">' . $row [8] . '</a></td>';
					echo "</tr>\n";
				}
			} else {
				echo '<tr><td colspan="9" class="text-center text-danger">筛选条件不合法，找不到这样的数据，请重试</td></tr>';
			}
			?>
		</table>
		<nav>
			<ul class="pagination pagination-lg text-center">
				<li><a
					href="/status?<?php
					if ($contest)
						echo '&cid=' . $contest;
					echo '&pid=' . get ( 'pid' );
					echo '&Programmer=' . get ( 'Programmer' );
					echo '&lang=' . get ( 'lang' );
					echo '&status=' . get ( 'status' );
					?>">首页</a></li>
				<li><a href="#">...</a></li>
				<li><a
					href="/status?end=
				<?php
				if (isset ( $sid ))
					echo ($sid + 1);
				if ($contest)
					echo '&cid=' . $contest;
				echo '&pid=' . get ( 'pid' );
				echo '&Programmer=' . get ( 'Programmer' );
				echo '&lang=' . get ( 'lang' );
				echo '&status=' . get ( 'status' );
				?>">上一页</a></li>
				<li><a href="#">...</a></li>
				<li><a
					href="/status?start=
				<?php
				if (isset ( $eid ))
					echo ($eid - 1);
				if ($contest)
					echo '&cid=' . $contest;
				echo '&pid=' . get ( 'pid' );
				echo '&Programmer=' . get ( 'Programmer' );
				echo '&lang=' . get ( 'lang' );
				echo '&status=' . get ( 'status' );
				?>">下一页</a></li>
				<li><a href="#">...</a></li>
				<li><a
					href="/status?end=1<?php
					if($contest)
						echo '&cid='.$contest;
					echo '&pid=' . get ( 'pid' );
					echo '&Programmer=' . get ( 'Programmer' );
					echo '&lang=' . get ( 'lang' );
					echo '&status=' . get ( 'status' );
					?>">尾页</a></li>
			</ul>
		</nav>
	</div>
</div>
<script>
$(document).ready(function(){
		var t=setTimeout("location.href='/status?<?php
		if($contest)
			echo '&cid='.$contest;
		echo 'pid=' . get ( 'pid' );
		echo '&Programmer=' . get ( 'Programmer' );
		echo '&lang=' . get ( 'lang' );
		echo '&status=' . get ( 'status' );
		?>';", 10000)
	})
	</script>