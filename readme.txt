ver 1.9 更新说明
	增加找回密码和注册功能，修复作业界面公告位置问题
	更新文件：
		/index.php
		/article.php
		/article_detail.php
		/css/global.css
	新增文件
		/password_find.php
		/signup.php
		/css/form-elements.css
		/css/signup_style.css
		/js/placeholder.js
		/js/restina-1.1.0.min.js
		/js/signup.js
		/images/signup.jpg

ver 1.8 更新说明：
	增加资料模块
	更新文件：
		/teacher/material.php
		/student/material.php
		/include/material_teacher_header.html
	新增文件：
		/php/delete_material.php
		/php/delete_video.php
		/php/download_material.php
		/php/file_upload.php
		/php/video_upload.php
		/css/fileinput.css
		/css/material.css
		/js/fileinput.js
		/js/zh.js

ver 1.7 更新文件：
		bbs-thread.php 
		bbs.php 
		bbs-profile.php
	更新说明：给论坛用户添加了头像
		  解决了论坛主页，发新帖和用户名两个按键上文字消失的问题

ver 1.6 更新文件:
	
		bbs-thread.php
	
		bbs-reply.php
	
		bbs.php
	new-post.php
	
		bbs-group.php
	
		bbs-profile.php
	
		bbs-thread-profile.php

ver 

1.5 更新说明:
	更新文件:
		/student/homework.php
		/student/dohomework.php
		/teacher/homework.php
ver 1.4更细说明：
	增加文章搜索和教师文章删除功能
	更新文件：
		/article.php
		/teacher/article.php
		/student/article.php
		/include/article_index_header.html
		/teacher/article_detail.php	
	删除文件：
		/php/login.php
		/teacher/addarticle.php	


ver 1.3更新说明:
	更新了	/teacher/bbs.php
		/bbs_groups.php
		/bbs_reply.php
		/bbs_thread.php
		/new-post.php
		/student/bbs.php
		/bbs_reply.php
		/bbs_thread.php
		/new-post.php
		/include/bbs_student_header.html
		/bbs_teacher_header.html
		/css/bbs.css
	更新了sql.txt中的论坛相关3个表


ver 1.2更新说明:
	更新了/teacher/homework.php
		/teacher/homework_detail.php
		/teacher/homework_mark.php
		/include/homework_teacher_header.html
	   /php/randID.php  (用于对上传的作业和资料生成随机的10位ID)
	根目录下新建了homework文件夹，作业上传到这个目录
	更新了sql.txt中的student_homework和homework
	
ver 1.1更新说明：
	新增根目录文件夹/fonts/	修复页面图标无法显示的问题
	更新了教师manage.php页面，新增组号管理和公告管理
	更新页面使公告动态加载，更新的页面如下：
		/include/ 中所有header文件
		index.php
		article.php
		/teacher/index.php
		/teacher/bbs.php
		/student/index.php
	更新了数据库信息sql.txt，增加了小组表

ver 1.0
使用说明：
	首先需要建立数据库，数据库名、用户名和密码请按照'/php/mysqli_connect.php'配置进行数据库的建立
	数据库表请按照'sql/txt'文件建立
	如有因数据库配置问题导致网站出现错误，请及时联系
	
	用户的登录信息存放于cookie之中，用户可以通过登录保存cookie，通过注销登录清除cookie
	
	在表单提交涉及隐私时，请尽力使用post，避免使用set带来的不安全因素
	每个php文件应该在首部检查cookie中的信息，避免越级访问
	
	首页的留言默认没有数据，可以通过insert或者进行留言向数据库添加信息，也可从sql.zip文件导入
	文章默认没有数据，可以通过教师用户发表文章插入数据，也可从sql.zip文件导入
	
以下是各页面的负责人，如果需要更改页面信息，请及时联系负责人，负责人负责权衡信息并更新版本
	index.php 费治军
	article.php 费治军
	article_detail.php 费治军
	ckeditor/ 所有成员
	css/ 所有成员
	image/ 所有成员
	include/ 所有成员
	js/ 所有成员
	php/ 所有成员
	readme.md 所有成员
	sql.txt 所有成员
	
	student/article.php 费治军
	student/article_detail.php 费治军
	student/bbs.php 叶小刚and魏翔宇
	student/homework.php 缪晴朗and张兴宇
	student/index.php 费治军
	student/material.php 毛顺龙
	
	teacher/article.php 费治军
	teacher/article_detail.php  费治军
	teacher/addarticle.php 费治军
	teacher/newArticle.php 费治军
	teacher/bbs.php 叶小刚and魏翔宇
	teacher/homework.php 缪晴朗and张兴宇
	teacher/homework_detail.php 缪晴朗and张兴宇
	teacher/homework_mark.php 缪晴朗and张兴宇
	teacher/index.php 费治军
	teacher/material.php 毛顺龙
	teacher/manage.php 费治军
	
新文件的命名按照 一级_二级_三级.php 命名， 如article_detail.php，建立相应等级的新文件请通知上一级文件的负责人