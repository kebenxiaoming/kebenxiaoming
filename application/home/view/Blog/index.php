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
        <div class="row">
            <?php foreach($this->vars['blogs'] as $key=>$blog){?>
                <?php if($key%2==0){?>
                    <div class="col-md-4 text-center">
                        <div class="blog-inner">
                    <?php }else{ ?>
                            <div class="row">
                            <?php } ?>
                    <a href="<?php echo url('Blog/show',array('id'=>$blog['id']));?>"><img class="img-responsive" src="<?php echo getImg($blog['pics']);?>" alt="Blog"></a>
                    <div class="desc">
                        <h3><a href="<?php echo url('Blog/show',array('id'=>$blog['id']));?>"><?php echo $blog['title'];?></a></h3>
                        <p><?php echo $blog['description'];?></p>
                        <p><a href="<?php echo url('Blog/show',array('id'=>$blog['id']));?>" class="btn btn-primary btn-outline with-arrow">Read More<i class="icon-arrow-right"></i></a></p>
                    </div>
                </div>
                <?php if($key%2!=0){?>
                </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>


