<?php
//url参数处理，1操作成功，2操作失败
$type = isset($_GET['type']) && in_array(intval($_GET['type']), array(1, 2)) ? intval($_GET['type']) : 2;

$title = $type == 1 ? '操作成功':'操作失败';

if ($type == 1) {
    $msg = !empty($_GET['msg']) ? trim($_GET['msg']) : '操作成功';
} else {
    $msg = !empty($_GET['msg']) ? trim($_GET['msg']) : '操作失败';
}

$url = !empty($_GET['url']) ? trim($_GET['url']) : '';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="static/css/common.css" />
    <link rel="stylesheet" type="text/css" href="static/css/done.css" />
</head>
<body>
    <div class="header">
        <div class="logo f1">
            <img src="static/image/logo.png">
        </div>
    </div>
    <div class="content">
        <div class="center">
            <div class="image_center">
               <?php if($type == 1): ?>
                <span class="smile_face">:) </span>
               <?php else: ?>
                <span class="smile_face">:( </span>
               <?php endif; ?>
            </div>
            <div class="code">
                <?php echo $msg; ?>
            </div>
            <div class="jump">
                页面在 <strong id="time" style="color: black">3</strong> 秒后跳转
            </div>
        </div>



    </div>
    <div class="footer">
        <p><span>M-GALLARY</span>©2017 POWERED BY IMOOC.INC</p>
    </div>
</body>
<script src="./static/js/jquery-1.10.2.min.js" charset="utf-8"></script>
<script type="text/javascript">
    $(function() {
        var url = "<?php echo $url; ?>";
        var time = $("#time").html();
        setInterval(function() {
            if (time > 1) {
                time--;
              $("#time").html(time);
            } else {
              if(url) {
                location.href = url;
              } else {
                history.go(-1);
              }
            }
        },1000);
    });
</script>
</html>
