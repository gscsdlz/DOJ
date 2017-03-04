<?php
/*
 * $args[0] 题目饼图数据 变量
 * $args[1] AC题目数量 数组
 * $args[2] 已提交没有AC题目数量 数组
 * $args[3] 用户基本数据信息 变量
 * $args[4] 比赛信息
 * $args[5] 小组信息
 */
?>
<div class="row">
	<div class="col-md-2 col-md-offset-2 text-center well"
		style="border-right-style: inset">
		<img
			src="/Src/Image/header/
		<?php
		extract ( $args [3] );
		echo $headerpath;
		?>
		"
			alt="" class="img-circle" width="200px" height="200px" id="header">
		<?php if (isset ( $_SESSION ['username'] ) && $_SESSION ['username'] == $username) {?>
		<form id="uploadImg" class="form-horizontal" role="form" method="post"
			action="" enctype="multipart/form-data">
			<label>请选择图片文件：<input class="form-control" type="file" name="file"
				id="uploadFile" /></label>
		</form>
		<script>
		$(document).ready(function() {
			$("#uploadImg").hide();
			$("#header").dblclick(function(){
				$("#uploadImg").show();	
			})
			
			$("#uploadFile").AjaxFileUpload({
				action: "/user/uploadHeader",
				onComplete: function(filename, response) {
					 var arg = eval(response);
					$("#header").attr("src", "\\Src\\Image\\header\\" + arg['status']);
					$("#uploadImg").hide();
				}
			});
		});
	</script>
	<?php }	?>
		<h1>
			<?php
			
			if (isset ( $username ))
				echo $username;
			?> 
			<small><?php if(isset($nickname)) echo $nickname;?></small>
		</h1>
		<h3>
			<small><?php if(isset($motto)) echo $motto;?></small>
		</h3>
		<?php
		if (isset ( $_SESSION ['username'] ) && $_SESSION ['username'] == $username) {
			?>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<button type="button" class="btn btn-primary btn-block"
					data-toggle="modal" data-target="#updateModal">修改信息</button>
			</div>
		</div>
		<div class="modal fade text-left" id="updateModal" tabindex="-1"
			role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
						</button>
						<h2 class="text-center modal-title" id="codeModalLabel">修改用户信息</h2>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label for="Username" class="col-sm-2 control-label">用户名</label>
								<div class="col-sm-10">
									<input type="text" class="form-control"
										value="<?php if(isset($username)) echo $username?>"
										readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label for="Nickname" class="col-sm-2 control-label">昵称</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="Nickname"
										name="newNickname" placeholder="Nickname"
										value="<?php  if(isset($nickname)) echo $nickname?>">
								</div>
							</div>
							<div class="form-group">
								<label for="Motto" class="col-sm-2 control-label">签名</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="Motto"
										placeholder="签名"
										value="<?php  if(isset($motto)) echo $motto?>"> <label
										id="mottoError" class="control-label text-danger">签名超过最大字数</label>
								</div>
							</div>
							<div class="form-group">
								<label for="QQ" class="col-sm-2 control-label">QQ</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="QQ"
										placeholder="QQ号"
										value="<?php  if(isset($qq) && $qq > 0) echo $qq?>">
								</div>
							</div>
							<div class="form-group">
								<label for="Group" class="col-sm-2 control-label">小组</label>
								<div class="col-sm-10">
									<select id="Gourp" class="form-cotrol">
								<?php
			
			foreach ( $args [5] as $row ) {
				echo '<option value="' . $row [0] . '">' . $row [1] . '</option>';
			}
			?>
							</select>
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">电子邮箱</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="Email"
										name="email" placeholder="email" value="<?php echo $email;?>">
									<label id="emailError" class="control-label text-danger">该电子邮箱已经被注册过了！</label>
								</div>
							</div>
							<div class="form-group">
								<label for="head" class="col-sm-2 control-label">头像</label>
								<div class="col-sm-10">
									<label class="control-label text-success">头像请双击图片修改</label>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-2 control-label">密码</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="Password"
										name="newPassword" placeholder="输入密码则表示修改密码">
								</div>
							</div>
							<div class="form-group">
								<label for="password2" class="col-sm-2 control-label">确认密码</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="Password2"
										name="newPassword2" placeholder="确认密码"> <label
										id="passwordError" class="control-label text-danger">两次输入的密码不一致</label>

								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						<button type="button" class="btn btn-primary" id="update">修改</button>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<hr />
		<table class="table text-left">
			<tr>
				<td>所在小组</td>
				<td><?php if(isset($group_name)) echo $group_name;?></td>
			</tr>
			<tr>
				<td>QQ</td>
				<td><?php if(isset($qq) && $qq > 0) echo $qq;?></td>
			</tr>
			<tr>
				<td>加入时间</td>
				<td><?php if(isset($regtime)) echo $regtime;?></td>
			</tr>
			<tr>
				<td>电子邮箱</td>
				<td><?php if(isset($email)) echo $email;?></td>
			</tr>
		</table>
	</div>

	<div class="col-md-3 well" id="AllStatus"
		style="height: 300px; margin-left: 10px;"></div>
	<div class="col-md-3" style="height: 300px; margin-left: 10px;">
		<div class=" panel panel-success">
			<div class="panel-heading">
				<h4 class="text-center">排名</h4>
			</div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<th>排名</th>
						<th>用户名</th>
						<th>通过数</th>
						<th>AC率</th>
					</tr>
					<?php
					$tmp = $args [6] [1];
					$args [6] [1] = $args [6] [0];
					$args [6] [0] = $tmp;
					foreach ( $args [6] as $row ) {
						if ($row) {
							echo '<tr>';
							echo '<td>'.$row[4].'</td>';
							echo '<td><a href="/user/show/'.$row[0].'">'.$row[0].'</a></td>';
							echo '<td>'.$row[2].'</td>';
							if($row[3] == 0)
								$row[3] = 1;
							echo '<td>'.number_format($row[2] / $row[3] * 100, 2, '.', '').'%</td>';
							echo "</tr>\n";
						}
					}
					?>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-6" style="margin-left: 15px;" id="contestList">
		<div class=" panel panel-danger">
			<div class="panel-heading">
				<h4 class="text-center">参加过的比赛</h4>
			</div>
			<div class="list-group panel-body">
			<?php
			if (isset ( $args [4] ) && count ( $args [4] )) {
				foreach ( $args [4] as $row ) {
					echo '<a href="/contest/show/' . $row [2] . '" class="list-group-item">' . $row [0] . '<span class="badge">' . $row [1] . '</span></a>';
					;
				}
			} else {
				echo '<a href="#" class="list-group-item text-center">还用户目前还未参加比赛</a>';
			}
			?>
	</div>
			<div class="panel-footer">
				<button type="button" class="btn btn-primary"
					style="margin-left: 40%;" id="prePage">上一页</button>
				<button type="button" class="btn btn-primary" id="nextPage">下一页</button>
			</div>
		</div>
	</div>
	<div class="col-md-5 col-md-offset-4">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form class="form-inline" role="form">
					<a href="#" class="btn btn-danger" data-toggle="modal"
						data-target="#ACModal">已经解决的问题 <span class="badge"><?php echo count($args[1])?></span></a>
					<a href="#" class="btn btn-success" data-toggle="modal"
						data-target="#nACModal">还未解决的问题 <span class="badge"><?php echo count($args[2])?></span></a>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ACModal" tabindex="-1" role="dialog"
	aria-labelledby="ACModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">已经解决的问题</h4>
			</div>
			<div class="modal-body">
				<table class="table">
						<?php
						if (isset ( $args [1] ) && count ( $args [1] )) {
							$i = 1;
							foreach ( $args [1] as $row ) {
								if ($i % 11 == 0 || $i == 1)
									echo '<tr>';
								echo '<td><a href="/status?rid=&pid=' . $row . '&Programmer=' . $username . '&lang=0&status=4">' . $row . '</a></td>';
								if ($i % 10 == 0)
									echo '</tr>';
								$i ++;
							}
						}
						?>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="nACModal" tabindex="-1" role="dialog"
	aria-labelledby="nACModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">还未解决的问题</h4>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
<?php
if (isset ( $args [2] ) && count ( $args [2] )) {
	$i = 1;
	foreach ( $args [2] as $row ) {
		if ($i % 11 == 0 || $i == 1)
			echo '<tr>';
		echo '<td><a href="/status?rid=&pid=' . $row . '&Programmer=' . $username . '&lang=0&status=0">' . $row . '</a></td>';
		if ($i % 10 == 0)
			echo '</tr>';
		$i ++;
	}
}
?>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$("#mottoError").hide();
		$("#emailError").hide();
		$("#passwordError").hide();
		
		$("#update").click(function(){
			$("#mottoError").hide();
			$("#emailError").hide();
			$("#passwordError").hide();
			
			var nickname = $("#Nickname").val();
			var motto = $("#Motto").val();
			var qq = $("#QQ").val();
			var email = $("#Email").val();
			var group = $("#Group").val();
			var password= $("#Password").val();
			var password2 = $("#Password2").val();
			if(password != password2)
				$("#passwordError").show();
			else if(motto.length > 30)
				$("#mottoError").show();
			else
			$.post("/login/update", {nickname:nickname, motto:motto, qq:qq, email:email, group:group, password:password, password2:password2}, function(data){
				var arr = eval("(" + data + ")");
				if (arr['status']) {
					window.location.reload();
				} else if(arr['status'] == 'email error'){
					$("#emailError").show();	
				}
			})
		})
		
		var currentValue = 0;
		$("a.list-group-item").hide();
		$("a.list-group-item:eq(0)").show();
		$("a.list-group-item:eq(1)").show();
		$("a.list-group-item:eq(2)").show();
		$("a.list-group-item:eq(3)").show();
		$("a.list-group-item:eq(4)").show();
		
		$("#prePage").click(function(){
			currentValue -= 5;
			if(currentValue < 0)
				currentValue = 0;
			$("a.list-group-item").hide();
			for(var i = currentValue; i < currentValue + 5; i++)
				$("a.list-group-item:eq("+ i + ")").fadeIn();
		})
		$("#nextPage").click(function(){
			currentValue += 5;
			if(currentValue > $("a.list-group-item").length)
				currentValue = $("a.list-group-item").length;
			$("a.list-group-item").hide();
			for(var i = currentValue; i < currentValue + 5; i++)
				$("a.list-group-item:eq("+ i + ")").fadeIn();
		})
	})
</script>

<script type="text/javascript">

		// 基于准备好的dom，初始化echarts实例
		var myChartAllStatus = echarts.init(document
				.getElementById('AllStatus'));
		optionA = {
			 title: {
				text: '提交记录统计 总计<?php echo array_sum($args[0])?>次',
				left: 'center'
			},
			tooltip : {
				trigger : 'item',
				formatter : "{a} <br/>{b} : {c} ({d}%)"
			},
			legend : {
				orient : 'vertical',
				left : 'left',
				data : [ 'AC', 'PE', 'WA', 'RE', 'TLE', 'MLE', 'OLE', 'CE' ]
			},
			series : [ {
				name : '题数及百分比',
				type : 'pie',
				radius : [ '50%', '70%' ],
				avoidLabelOverlap : false,
				label : {
					normal : {
						show : false,
						position : 'center'
					},
					emphasis : {
						show : true,
						textStyle : {
							fontSize : '30',
							fontWeight : 'bold'
						}
					}
				},
				labelLine : {
					normal : {
						show : false
					}
				},
				data : [ {
					value : <?php echo $args[0][0];?>,
					name : 'AC'
				}, {
					value : <?php echo $args[0][1];?>,
					name : 'PE'
				}, {
					value : <?php echo $args[0][2];?>,
					name : 'WA'
				}, {
					value : <?php echo $args[0][3];?>,
					name : 'RE'
				}, {
					value : <?php echo $args[0][4];?>,
					name : 'TLE'
				}, {
					value : <?php echo $args[0][5];?>,
					name : 'MLE'
				}, {
					value : <?php echo $args[0][6];?>,
					name : 'OLE'
				}, {
					value : <?php echo $args[0][7];?>,
					name : 'CE'
				} ]
			} ]
		};

		myChartAllStatus.setOption(optionA);
	</script>
