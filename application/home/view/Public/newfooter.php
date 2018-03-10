<footer id="fh5co-footer" role="contentinfo">

    <div class="container">
        <div class="col-md-3 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
            <h3>关于我</h3>
            <p>怂 </p>
        </div>
        <div class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">


        </div>

        <div class="col-md-2 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
            <h3>关注我</h3>
            <ul class="fh5co-social">
                <li><a href="http://weibo.com/u/1601890381"><i class="icon-weibo"></i> 微博</a></li>
                <li><a href="https://github.com/kebenxiaoming"><i class="icon-github"></i> Github</a></li>
            </ul>
        </div>


        <div class="col-md-12 fh5co-copyright text-center">
            <p>&copy; 2016-2018 SUNNY. All Rights Reserved. <span>Designed with <i class="icon-heart"></i> by <a href="https://github.com/kebenxiaoming/kebenxiaoming" target="_blank">kebenxiaoming</a></span></p>
        </div>

    </div>
</footer>
</div>
<!-- jQuery -->
<script src="<?php echo config('PUBLIC');?>/Home/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="<?php echo config('PUBLIC');?>/Home/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="<?php echo config('PUBLIC');?>/Home/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="<?php echo config('PUBLIC');?>/Home/js/jquery.waypoints.min.js"></script>
<!-- MAIN JS -->
<script src="<?php echo config('PUBLIC');?>/Home/js/main.js"></script>
<script>
    $(document).on("click",".loadmore", function() {
        var page=parseInt($(".loadmore").data("page"));
        nextpage=page+1;
        $.get("<?php echo url('Blog/ajaxLoadComments')?>",{id:article_id,p:nextpage},function(data){
            var newdata=JSON.parse(data);
            $(".loadmore").remove();
            if(newdata.status==1) {
                var str = "";
                newdata.data.comments.map(function (item, index, input) {
                    str+='<div class="personinfo">游客</div><div class="postdate">'+item.create_time+'</div><div id="reply">'+item.content+'</div>';
                });
                if(newdata.data.has_more){
                    str+='<div class="loadmore" data-page="'+newdata.data.now_page+'">点击加载更多...</div>';
                }
                $(".showcomments").append(str);
            }else{
                alert(newdata.msg);
                return;
            }
        })
    });
</script>
<div class="back-to-top" id="to_top" style="display: block;
    position: fixed;
	bottom: 10px;
	right: 25%;
	z-index: 10;" onclick="document.documentElement.scrollTop = document.body.scrollTop =0;">
    <a style="cursor: pointer;
	width: 35px;
	height: 35px;
	text-indent: -20000px;
	display: block;
    border-radius: 100%;
    background-color: #D43638;
    border-color: #910101;
    background-image: -moz-linear-gradient(center top , #EB5367, #E04751 50%, #DE404A 50%, #D43638);">回到顶部</a></div>

</body>
</html>