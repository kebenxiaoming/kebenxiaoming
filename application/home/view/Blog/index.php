<?php
require dirname(dirname(__FILE__))."/Public/header.php";
?>
<div id="fh5co-blog-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                <h2>我的博客</h2>
                <p>我的生活轨迹和我的存在方式</p>
            </div>
        </div>
        <div class="row blog">
            <?php foreach($this->vars['blogs'] as $key=>$blog){?>
                <?php if($key%2==0){?>
                    <div class="col-md-4 text-center">
                        <div class="blog-inner">
                    <?php }else{ ?>
                            <div class="row">
                            <?php } ?>
                    <a href="<?php echo url('Blog/show',array('id'=>$blog['id']));?>"><img class="img-responsive" src="<?php echo getImg($blog['pics']);?>" alt="Blog"></a>
                    <div class="desc">
                        <h3><a style="display:block;overflow: hidden;height:32px;" href="<?php echo url('Blog/show',array('id'=>$blog['id']));?>"><?php echo $blog['title'];?></a></h3>
                        <p style="height:30px;overflow: hidden;"><?php echo $blog['description'];?></p>
                        <p><a href="<?php echo url('Blog/show',array('id'=>$blog['id']));?>" class="btn btn-primary btn-outline with-arrow">Read More<i class="icon-arrow-right"></i></a></p>
                    </div>
                </div>
                <?php if($key%2!=0){?>
                </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
        <?php if($this->vars['has_more']){?>
        <div class="row text-center load-more">
            <input id="currentpage" type="hidden" value="<?php echo $this->vars['current_page']?>">
            <p><a href="javascript:void(0);" class="loaddata btn btn-primary btn-outline with-arrow">Load More<i class="icon-arrow-down"></i></a></p>
        </div>
        <?php } ?>
</div>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>
    <script>
    $('.loaddata').click(function(){
        var nextpage=parseInt($("#currentpage").val())+1;
        $.get("<?php echo url('Blog/ajaxLoadPage')?>",{p:nextpage},function(data){
            var dataarr=JSON.parse(data);
               if(dataarr.status==1){
                   var str="";
                    for(var i=0;i<dataarr.articles.length;i++){
                        if(i%2==0){
                            str+='<div class="col-md-4 text-center"><div class="blog-inner">';
                            }else{
                            str+='<div class="row">';
                            }
                            str+='<a href="'+dataarr.articles[i]['url']+'"><img class="img-responsive" src="'+dataarr.articles[i]['imageurl']+'" alt="Blog"></a><div class="desc">';
                            str+='<h3><a style="display:block;overflow: hidden;height:32px;" href="'+dataarr.articles[i]['imageurl']+'">'+dataarr.articles[i]['title']+'</a></h3>';
                            str+='<p style="height:30px;overflow: hidden;">'+dataarr.articles[i]['description']+'</p>';
                            str+='<p><a href="'+dataarr.articles[i]['url']+'" class="btn btn-primary btn-outline with-arrow">Read More<i class="icon-arrow-right"></i></a></p>';
                            str+='</div>';
                            str+='</div>';
                            if(i%2!=0){
                            str+='</div>';
                            }
                   }
                   $("#currentpage").val(dataarr.now_page);
                   $(".blog").append(str);
               }else{
                   $(".load-more").remove();
               }
        });
    });
    </script>


