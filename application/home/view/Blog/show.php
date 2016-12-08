<?php
require dirname(dirname(__FILE__))."/Public/header.php";
?>
    <div id="fh5co-about-section">
        <div class="container">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                    <h2><?php echo $this->vars['blog']['title'];?></h2>
                    <p><?php echo $this->vars['blog']['description'];?></p>
                </div>
            <div class="col-md-8 sunny" style="margin:0 auto;width: 100%;">
                    <?php echo $this->vars['blog']['content'];?>
            </div>
            <!-- UY BEGIN -->
            <div id="uyan_frame"></div>
            <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js"></script>
            <!-- UY END -->
    </div>
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>

