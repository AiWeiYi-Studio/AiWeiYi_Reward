<?php
include("../system/core/core.php");
$title='聊天室';
$url='page_chat.php';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?url=".$url."';</script>");
?>
<style> 
p.test
{
word-break:break-all;
}
</style>

  <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
          
    <div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>聊天室</h4>
</div>
<div class="card-body">
    
<?php if($conf['chat_user_notice']!==NULL){?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong><?php echo $conf['chat_user_notice'];?></strong>
</div>
<?php }if($udata['active_chat']=='0'){?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>发言违规，已被封禁</strong>
</div>
<?php }?>

<div style="height:550px;overflow:auto;">
<ul class="media-list push">
<?php
$rs=$DB->query("SELECT * FROM reward_user_chat WHERE 1 order by id desc");
while($res = $DB->fetch($rs))
{
$row = $DB->get_row("SELECT * FROM reward_user WHERE uid='{$res['user']}' limit 1");

echo '<div class="media-body">
<a href="javascript:;" class="media-left" style="float: left;">
<img src="//q4.qlogo.cn/headimg_dl?dst_uin='.$row["qq"].'&spec=40" alt="头像" >
</a>';
echo '<div class="pad-btm">
      <p class="fontColor"><a href="javascript:;">'.$row["name"].'</a></p>';
echo'<span class="text-muted">'.$res["addtime"].'</span><br/>';
echo'<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<p class="test"><font color="'.$res['colour'].'">'.$res['message'].'</font></p>
</div>';
echo'</div><hr>';
}
?>
</ul>
</div>


<?php if($udata['active_chat']=='1'){?>
<div class="form-group">
<button type="button" class="btn-block btn-round btn btn-info" data-toggle="modal" data-target="#send_message">发送</button>
</div>
<div class="modal fade" id="send_message" tabindex="-1" role="dialog" aria-labelledby="send_message">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">新消息</h4>
                      </div>
                      <div class="modal-body">
                        <form>
                    <div class="form-group">
                <label for="text">字体颜色</label>
                <select class="form-control" id="colour" name="colour" default="">
                    <option value="black">黑色</option>
                    <option value="yellow">黄色</option>
                    <option value="red">红色</option>
                    <option value="blue">蓝色</option>
                </select>
                    </div>
                          <div class="form-group">
                  <label for="text">信息内容</label>
                         <textarea class="form-control" id="message" name="message" placeholder="信息内容" rows="4" cols="20"></textarea>
                   </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                         <div class="form-group">
<a href="javascript:send_message()" class="btn-block btn-round btn btn-info">发送</a>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
<?php }?>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
function send_message(){
	var colour=$("#colour").val();
	var message=$("#message").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=send_message",
			data : {colour:colour,message:message},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./page_chat.php";
						}, 1000); //延时1秒跳转
					  }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
};
</script>