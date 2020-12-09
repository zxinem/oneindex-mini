<?php view::layout('layout')?>

<?php 
//仅支持教育版和企业版
if(strpos($item['downloadUrl'],"sharepoint.com") == false){
	header('Location: '.$item['downloadUrl']);exit();
}
$item['thumb'] = onedrive::thumbnail($item['path']);
$mpd =  str_replace("thumbnail","videomanifest",$item['thumb'])."&part=index&format=dash&useScf=True&pretranscode=0&transcodeahead=0";
?>

<?php view::begin('content');?>
<!-- <link class="dplayer-css" rel="stylesheet" href="//moeclub.org/embedded/static/DPlayer.min.css">
<script src="//moeclub.org/embedded/static/dash.all.min.js"></script>
<script src="//moeclub.org/embedded/static/DPlayer.min.js"></script> -->
<div class="mdui-container-fluid">
	<div class="nexmoe-item">
	<div class="mdui-center" id="dplayer"></div>
	<!-- 固定标签 -->
	<div class="mdui-row">
	  <select class="mdui-select" mdui-select="{position: 'top'}" id="sel">
	    <option value="<?php e($url);?>" selected>下载地址</option>
	    <option value="<video><source src='<?php e($url);?>' type='video/mp4'></video>">引用地址</option>
	  </select>
	  <textarea class="mdui-textfield-input" id="val" readonly><?php e($url);?></textarea>
	</div>
	<script type="text/javascript">
	    window.onload = function() {
	        var sel = document.getElementById("sel");
	        if(sel && sel.addEventListener){
	            sel.addEventListener('change',function(e){
	                var ev = e||window.event;
	                var target = ev.target||ev.srcElement;
	                document.getElementById("val").value = target.value;
	            },false)
	        }
	    }
	</script>
	</div>
</div>
<script>
const dp = new DPlayer({
	container: document.getElementById('dplayer'),
	lang:'zh-cn',
	video: {
	    url: '<?php echo $mpd;?>',
	    pic: '<?php @e($item['thumb']);?>',
	    type: 'dash'
	}
});
</script>
<a href="<?php e($url);?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>
<?php view::end('content');?>