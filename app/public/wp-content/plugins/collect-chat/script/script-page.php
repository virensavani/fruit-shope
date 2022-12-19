<?php 

function scriptPage(){
    global $wpdb;
    $table = $wpdb->prefix . "question_types";
    $result = $wpdb->get_results("SELECT * FROM $table" ,ARRAY_A );
    // pr_exit($result);
?>
<div class="wrapper">
    <div class="row">
        <div class="col col-xs-24 col-sm-24 col-md-24 col-lg-8">
            <div class="row">
                <?php foreach($result as $data) { 
                ?>
                <div class="col-12">
                    <div class="card-body">
                        <span class="anticon"><i class="<?php echo $data['icon'];?>"></i></span>
                       <span class="m-l-5"><?php echo $data['label']?></span>
                    </div>   
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<?php }
