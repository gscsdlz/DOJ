<div class="row">
	<div class="col-md-8 col-md-offset-2">
	
<h4>1.Online Judge 评判结果分别表示什么意思？</h4>
<pre>
当你提交的程序被Online Judge成功加入判题队列后，通常结果会返回在状态页面上，你也可以在“状态”页看到评判结果。

常见的Online Judge将评判结果分为如下几类：
<span class="text-danger">Accepted</span>
程序的输出完全满足题意，通过了全部的测试数据的测试。
<span class="text-success">Wrong Answer</span>
你的程序顺利地运行完毕并正常退出，但是输出的结果却是错误的。
注意：有的题包含多组测试数据，你的程序只要有一组数据是错误的，结果就是WA。
<span class="text-warning">Presentation Error</span>
你的程序输出的答案是正确的，但输出格式不对，比如多写了一些空格、换行。
请注意，大部分程序的输出，都要求最终输出一个换行。
不过，计算机程序是很难准确判断PE错误的，所以，很多PE错误都会被评判成WA。
<span class="text-primary">Compilation Error</span>
你的程序因为有语法错误，或者编译超时而没有通过编译。你可以点击 Compilation Error 文字上的链接
查看详细的出错信息，对照此信息，可以找出出错原因。。
Queuing
你的程序系统已经收到正在redis队列中，<span class="text-danger">最大排队时间为3S</span>
<span class="text-success">Time Limit Exceeded</span>
你的程序运行的时间超过了该题规定的最大时间，你的程序被Online Judge强行终止。
注意：TE并不能说明你的程序的运行结果是对还是错，只能说明你的程序用了太多的时间。
<span class="text-success">Memory Limit Exceeded</span>
你的程序运行时使用的内存，超过了该题规定的最大限制，你的程序被Online Judge强行终止。
注意：ML并不能说明你的程序的运行结果是对还是错，只能说明你的程序用了太多的内存。
<span class="text-success">Output Limit Exceeded</span>
你的程序输出了太多的东西。
Online Judge规定提交的程序在运行的时候只能输出比标准答案多两倍的内容，如果你输出太多，将导致此错误。
<span class="text-success">Runtime Error</span>
你的程序出现了运行时错误。
大部分情况下，NOJ系统将返回给你一个Runtime Error的错误。可能的原因包括地址越界，栈溢出，除0, 数据读取问题等
不能使用打开文件操作例如freopen，fgets，fopen等
也不能使用了系统编程所需要的函数，例如fork，socket，pthread等
</pre> 
<hr/>

<h4>2.Online Judge 支持哪些编程语言？</h4>
<pre>
到目前为止我们支持C，C++，Java。
编译器版本如下
C       gcc (GCC) 4.8.5 20150623 (Red Hat 4.8.5-11) 支持C99
C++     g++ (GCC) 4.8.5 20150623 (Red Hat 4.8.5-11) 支持C++11
Java    openjdk version "1.8.0_65"
<span class="text-danger">请不要使用bits/stdc++.h头文件，否则会出现编译错误</span>
</pre>
<hr/>

<h4>3.如何使用64位数？</h4>
<pre>
NOJ的判题核心运行在Linux上，定义一个64位整数，请使用<span class="text-danger">long long</span>，printf和scanf时，请使用<span class="text-danger">%lld</span>
</pre>
<hr/>

<h4>4.为什么我的程序不能得到Accepted？</h4>
<pre>
1.Online Judge 要求C/C++程序符合ANSI标准，所以主函数必须使用<span class="text-danger">int main()</span>
  且主函数最后需要<span class="text-danger">return 0;</span>
2.你使用了一些和算法比赛无关的函数，比如文件操作，网络编程，多线程或者多进程
3.您提交的Java程序必须是单个文件的，也就是所有的类必须写在一个文件里。
  并且将主类申明为<span class="text-danger">public公有类</span>，这个类名必须是'<span class="text-danger">Main</span>'（区分大小写）
4.每个题目对于Java程序的时间和内存限制一般都会放宽的。
  但是即便如此，有些题目还是不适合用Java来解，对于这些题目我们建议您使用编译性语言来解。
5.每道题目都是有很多组数据的，请充分考虑所有情况，而不仅仅是题面给出的数据
</pre>
<hr/>

<h4>5.如果题目包含多组测试数据，我应该在何时输出我的结果？</h4>
<pre>
OnlineJudge中，你的程序的输入和输出是相互独立的. 
因此，每当处理完一组测试数据，就应当按题目要求进行相应的输出操作。而不必将所有结果储存起来一起输出。
</pre>
<hr/>

<h4>6.为什么我用scanf/printf的组合能得到'AC'的程序换成cin/cout就得到了'TLE'？</h4>
<pre>
一般情况下，C语言运行时I/O函数比C++的效率高一些，所以处理大数据量的时候，建议使用<span class="text-danger">scanf/printf</span>组合。
</pre>
<hr/>

<h4>7.Online Judge其他功能说明！</h4>
<pre>
1.在用户界面且处于登录的情况下，双击自己的头像即可修改，上传的图片大小在2M之内
  上传的头像不会压缩，也不会进行裁剪，请自己选择合适的图片
2.用户界面会显示已经解决的问题，和还未解决的问题，点击具体题目可进入当时的提交记录
3.登录状态下，用户界面会显示上次登录的地点，你可以确认自己是否被盗号，及时修改密码
4.QQ和电子邮箱默认只有你自己可以查看。
5.比赛过程中，点击排名可以按小组查看排名，排名页面每5分钟更新一次。
6.用户每次登陆默认时长为6小时，不用担心比赛过程中重新登陆。
</pre>
<hr />

<h4>8.系统说明</h4>
<pre>
系统基于CentOS 7

前端基于bootstrap
判题核心基于<a href="https://github.com/zhblue/hustoj/">hustOJ</a>
后端基于PHP + MySQL + redis

感谢<a href="http://echarts.baidu.com">echarts</a>提供图表组件
感谢<a href="http://ueditor.baidu.com">ueditor</a>提供编辑器组件
感谢<a href="http://github.com/davgothic/AjaxFileUpload">davgothic</a>提供AJAX文件上传组件
</pre>
	</div>
</div>