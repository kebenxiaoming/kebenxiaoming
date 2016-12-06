<?php
require dirname(dirname(__FILE__))."/Public/header.php";
?>
    <div id="fh5co-about-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                    <h2><?php echo $this->vars['blog']['title'];?></h2>
                    <p><?php echo $this->vars['blog']['description'];?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-inner">
                                <?php echo $this->vars['blog']['content'];?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>

