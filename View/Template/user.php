<?php
/*
 * $args[0] 题目饼图数据 变量
 * $args[1] AC题目数量 数组
 * $args[2] 已提交没有AC题目数量 数组
 * $args[3] 用户基本数据信息 变量
 */
?>
<div class="row">
	<div class="col-md-2 col-md-offset-2 text-center well"
		style="border-right-style: inset">
		<img src="/Src/Image/header.jpg" alt="" class="img-circle"
			width="200px">
		<h1>
			<?php extract($args[3]); if(isset($username)) echo $username;?> 
			<small><?php if(isset($nickname)) echo $nickname;?></small>
		</h1>
		<h3>
			<small><?php if(isset($motto)) echo $motto;?></small>
		</h3>
		<?php
		if (isset ( $_SESSION ['username'] )) {
			?>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<button type="button" class="btn btn-primary btn-block">修改信息</button>
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
				<td><?php if(isset($qq)) echo $qq;?></td>
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
	<div class="col-md-6 well" id="AllStatus"
		style="height: 300px; margin-left: 10px;"></div>
	<div class="col-md-6 well list-group" style="height: 350px; margin-left: 10px;" id="contestList">
		<h4 class="text-center">参加过的比赛</h4>
		<a href="#" class="list-group-item">第四届国际大学生程序设计竞赛<span class="badge">3</span></a> 
		<a href="#" class="list-group-item">第一届中国大学生程序设计竞赛<span class="badge">1</span></a> 
		<a href="#" class="list-group-item">ACM-ICPC 。。。。。<span class="badge">4</span></a> 
		<a href="#" class="list-group-item">第一届国际大学生程序设计竞赛<span class="badge">5</span></a> 

		<p></p>
		<button type="button" class="btn btn-primary" style="margin-left:40%;" id="prePage">上一页</button>
		<button type="button" class="btn btn-primary" id="nextPage">下一页</button>
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
								echo '<td><a href="/problem/show/' . $row . '">' . $row . '</a></td>';
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
		echo '<td><a href="/problem/show/' . $row . '">' . $row . '</a></td>';
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
