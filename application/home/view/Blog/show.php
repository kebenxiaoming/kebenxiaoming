<?php
require dirname(dirname(__FILE__))."/Public/header.php";
?>
<style>
    input[type='button']{
        outline: none;
        border: none;
        padding: 0;
        margin:0;
        -webkit-appearance: none;
        width:100%;height:100%;text-align:center;background:forestgreen;color:white;
    }
    .personinfo{
        width:10%;
        border:1px solid black;
        height:80px;
        float:left;
        text-align:center;
        padding-top: 20px;
        font-size:0.6rem;
    }
    .postdate{
        width:90%;
        height:20px;
        float:left;
        text-align:left;
        line-height: 20px;
        border-bottom: 1px dotted black;
    }
    #reply{
        width:90%;
        float:left;
        display: block;
        height:60px;
        border-bottom:1px solid blue;
    }
    #needreply{
        width:90%;
        float:left;
        display: block;
        height:80px;
        resize:none;
    }
    .buttondiv{
        float:right;
        width:10%;
        height:50px;
        border:1px solid gray;
    }
    .blank{
        float:left;
        width:90%;
        height:50px;
    }
    .commenttext{
        float:left;
        width:10%;
        height:50px;
        padding-top:10px;
        text-align: center;
        font-size:0.6rem;
    }
    .showcomments{
        float:left;
        margin:0 auto;
        width:100%;
    }
    .loadmore{
        width:100%;
        height:30px;
        float:left;
        text-align:center;
        line-height: 30px;
    }
    .showno{
        width:100%;
        height:30px;
        float:left;
        text-align:center;
        line-height: 30px;
    }
</style>
    <div id="fh5co-about-section">
        <div class="container">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                    <h2><?php echo $this->vars['blog']['title'];?></h2>
                    <p><?php echo $this->vars['blog']['description'];?></p>
                    <p style="float:right;">阅读数：<?php echo $this->vars['blog']['views'];?></p>
                </div>
            <div class="col-md-8 sunny" style="margin:0 auto;width: 100%;">
                    <?php echo $this->vars['blog']['content'];?>
            </div>
    </div>
        <div style="margin:0 auto;width:100%;max-width:1000px;top:10px;overflow: hidden;">
            <div class="personinfo">我是头像</div><textarea id="needreply"></textarea>
            <div class="blank"></div><div class="buttondiv"><input type="button" onclick="replyArticle(<?php echo $this->vars['blog']['id'];?>);" value="提交"/></div>
            <div class="commenttext">评论：</div>
            <div class="showcomments">
                <?php
                if(isset($this->vars['comments'])){
                    foreach($this->vars['comments'] as $k=>$val){
                ?>
                <div class="personinfo"><?php if($val['uid']==0){echo "游客";}?></div><div class="postdate"><?php echo date("Y-m-d H:i:s",$val['create_time']);?></div><div id="reply"><?php echo $val['content'];?></div>
                <?php }?>
                <?php if($this->vars['has_more']){?>
                <div class="loadmore" data-page="1">点击加载更多...</div>
                <?php }}else{ ?>
                    <div class="showno">暂时没有评论...</div>
                <?php } ?>
                </div>
        </div>
            <script>
            var article_id=<?php echo $this->vars['blog']['id'];?>;
            function replyArticle(id){
                var content=$("#needreply").val();
                if(content==""){
                    alert("请输入要评论的内容！");return;
                }
                $.post("<?php echo url('Blog/comment');?>",{id:id,content:content},function(data){
                    var newdata=JSON.parse(data);
                    if(newdata.status==1){
                        $(".showno").remove();
                        $str='<div class="personinfo">游客</div><div class="postdate">'+newdata.data.create_time+'</div><div id="reply">'+newdata.data.content+'</div>';
                        $(".showcomments").prepend($str);
                    }else{
                        alert(newdata.msg);
                        return;
                    }
                });
            }
            </script>
<?php
require dirname(dirname(__FILE__))."/Public/newfooter.php";
?>

