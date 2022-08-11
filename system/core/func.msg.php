<?php
function sysmsg($msg = '未知的异常', $die = true){
	echo "  \r\n    <!DOCTYPE html>\r\n    <html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"zh-CN\">\r\n    <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n        <title>站点提示信息</title>\r\n        <style type=\"text/css\">\r\nhtml{background:#eee}body{background:#fff;color:#333;font-family:\"微软雅黑\",\"Microsoft YaHei\",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px \"微软雅黑\",\"Microsoft YaHei\",,sans-serif;margin:30px 0 0 0;padding:0;padding-bottom:7px}#error-page{margin-top:50px}h3{text-align:center}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333}\r\n        </style>\r\n    </head>\r\n    <body id=\"error-page\">\r\n        ";
	echo "<h3>站点提示信息</h3>";
	echo $msg;
	echo "    </body>\r\n    </html>\r\n    ";
	if ($die == true) {
		exit(0);
	}
}
function showmsg($content = '未知的异常',$type = 4,$back = false){
	switch($type){
		case 1:
			$panel="success";
		break;
		case 2:
			$panel="info";
		break;
		case 3:
			$panel="warning";
		break;
		case 4:
			$panel="danger";
		break;
	}

echo '<main class="lyear-layout-content">
      <div class="container-fluid">';
echo '<div class="row">
      <div class="col-lg-12">
      <div class="card">
      <div class="card-header bg-'.$panel.'"><h4>提示信息</h4></div>
      <div class="card-body">';
echo '<h4>'.$content.'</h4>';

	if($back){
		echo '<hr/><a href="'.$back.'"><< 返回上一页</a>';
	}else{

echo '<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a>';
echo '</div></div></div></div>';
echo '<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
      <script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
      <script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
      <script src="../assets/Layer/layer.js"></script>
      </body>
      </html>';
	exit;
    }
}
?>