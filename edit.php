<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加画品</title>
	<link href="./static/css/common.css" type="text/css" rel="stylesheet">
        <link href="./static/css/add.css" type="text/css" rel="stylesheet">
</head>
<body>
	<div class="header">
			<div class="logo f1">
				<img src="./static/image/logo.png">
			</div>
			<div class="auth fr">
				<ul>
					<li><a href="login.php">登录</a></li>
					<li><a href="register.php">注册</a></li>
				</ul>
			</div>
	</div>
        <div class="content">
		<div class="addwrap">
			<div class="addl fl">
				<header>发布画品</header>
				<form name="publish-form" id="publish-form" action="publish.php" method="POST" enctype="multipart/form-data">
					<div class="additem">
						<label for="name">画品名称</label><input type="text" name="name" id="name" placeholder="请输入画品名称" autocomplete="off">
					</div>
					<div class="additem">
						<label for="price">价格</label><input type="text" name="price" id="price" placeholder="请输入画品价格" autocomplete="off">
					</div>
					<div class="additem">
						<label for="file">画品</label><input type="file" accept="image/png,image/jpeg,image/gif" name="file" id="file">
					</div>
					<div class="additem textwrap">
						<label for="des" class="ptop">画品简介</label><textarea name="des" id="des"></textarea>
					</div>
					<div class="additem textwrap" style="margin-bottom:20px">
						<label for="content" class="ptop">画品详情</label>
            <div class="" style="margin-left:120px">
              <textarea name="content" id="content">
              </textarea>
            </div>
					</div>
					<button type="submit" name="submit" value="submit">发布</button>
				</form>
			</div>
			<div class="addr fr">
				<img src="./static/image/index_banner.png">
			</div>
		</div>

	</div>
        <div class="footer">
            <p><span>M-GALLARY</span>©2017 POWERED BY IMOOC.INC</p>
        </div>
</body>
<script src="./static/js/jquery-1.10.2.min.js" charset="utf-8"></script>
<script src="./static/js/layer-v3.3.0/layer/layer.js" charset="utf-8"></script>
<script src="./static/js/kindeditor/kindeditor-all-min.js" charset="utf-8"></script>
<script src="./static/js/kindeditor/lang/zh-CN.js" charset="utf-8"></script>
<script type="text/javascript">
//富文本编辑器
$(function() {
    KindEditor.ready(function(K) {
                 window.editor = K.create('#content', {
                   width      : '475px',
                   height     : '250px',
                   minWidth   : '30px',
                   minHeight  : '50px',
                   items      : [
                       'undo', 'redo', '|',
                       'justifyleft', 'justifycenter', 'justifyright', 'clearhtml',
                       'fontsize', 'forecolor', 'bold',
                       'italic', 'underline', 'link', 'unlink', '|'
                       , 'fullscreen'
                   ]
                 });
              });
});

</script>
<script type="text/javascript">
</script>
</html>
