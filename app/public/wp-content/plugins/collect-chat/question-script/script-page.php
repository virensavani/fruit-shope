<?php 
function scriptPage(){
    global $wpdb;
    $table = $wpdb->prefix . "question_types";
    $result = $wpdb->get_results("SELECT * FROM $table" ,ARRAY_A );
?>
<!-- <section class="layout site-layout site-layout-collapsed site-layout-expanded "> -->
<main class="layout-content main-content">
    <!-- <div class="wrapper"> -->
        <div class="row">
            <div class="col sidebar col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <div class="question-name-wrapper">
                    <div class="row flex">
                        <?php foreach($result as $data) { 
                        ?>
                        <div class="col scr-col-12">
                            <div  draggable="true">
                                <div class="question-name" id="<?php echo $data['id'];?>">
                                    <div class="card card-bordered card-hoverable question-type">
                                        <div class="card-body">
                                            <span class="anticon"><i class="<?php echo $data['icon'];?>"></i></span>
                                            <span class="m-l-5"><?php echo $data['label']?></span>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>  
            </div>
            <div class="col script-preview p-t-5 col-xs-12 col-sm-12 col-md-12 col-lg-8" id="droppable">
                <div class="card card-bordered" style="min-height: 100%;">
                    <div class="card-body" style="height: calc(100vh - 85px); overflow-y: scroll; padding-bottom: 0px; scroll-behavior: smooth;">
                        <div class="script-editor-wrapper">
                            <div id="ADDA6C81-1F0F-4166-8F42-5ECA2F56E742" class="item">
                                <div draggable="true">
                                    <div class="card card-bordered card-hoverable"><div class="card-body">
                                            <div class="col question-wrapper">
                                                <span class="label">
                                                    <div class="label-icon">
                                                        <span role="img" aria-label="like" class="anticon anticon-like">
                                                            <i class="bi bi-hand-thumbs-up"></i>
                                                        </span> 
                                                        <span class="label-number">1.</span>
                                                    </div>
                                                    <div class="label-text">
                                                        <div>🙂📷</div>
                                                        <div>Nice chatting with you</div>
                                                    </div>
                                                </span>
                                                <div style="width: 270px;">
                                                    <span class="anticon">
                                                        <button type="button" class="btn btn-icon-only action-btn">
                                                            <span class="anticon"><i class="fa-regular fa-copy"></i></span>
                                                        </button>
                                                        <button type="button" class="btn btn-icon-only action-btn">
                                                            <span class="anticon"><i class="fa-light fa-code-fork"></i></span>
                                                        </button>
                                                        <button type="button" class="btn btn-icon-only action-btn">
                                                            <span class="anticon"><i class="fa-regular fa-pen-to-square"></i></span>
                                                        </button>
                                                        <button type="button" class="btn btn-icon-only action-btn">
                                                            <span class="anticon"><i class="fa-solid fa-arrows-up-down-left-right"></i></span>
                                                        </button>
                                                         <button type="button" class="btn btn-icon-only action-btn">
                                                            <span ><i class="fa-solid fa-trash-can"></i></span>
                                                        </button>
                                                    </span>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-answer">User's reply</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
</main>
<script type="text/javascript">
var $ = jQuery;
    $(document).ready(function(){
        $(".question-name-wrapper .question-name").draggable({
            helper: 'clone',
            cursor: 'move',
            tolerance: 'fit',
            revert: true
        });
        $("#droppable").droppable({
            accept: '.question-name',
            activeClass: "drop-area",
            drop: function (e, ui) {
                if ($(ui.draggable)[0].id != "") {
                
                x =ui.helper.clone();
                ui.helper.remove();
                x.draggable({
                    helper: 'original',
                    cursor: 'move',
                    //containment: '#droppable',
                    tolerance: 'fit',
                    drop: function (event, ui) {
                        $(ui.draggable).remove();
                    }
                });
                

                x.resizable({
                    maxHeight: 785,
                    maxWidth: 785
                });
                    var el = $("<div id='ADDA6C81-1F0F-4166-8F42-5ECA2F56E742' class='item'><div draggable='true'><div class='card card-bordered card-hoverable'><div class='card-body'><div class='col question-wrapper'><span class='label'><div class='label-icon'><span role='img' aria-label='like' class='anticon anticon-like'><i class='bi bi-hand-thumbs-up'></i></span> <span class='label-number'>1.</span></div><div class='label-text'><div>🙂📷</div><div>Nice chatting with you</div></div></span><div style='width: 270px;'><span class='anticon'><button type='button' class='btn btn-icon-only action-btn'><span class='anticon'><i class='fa-regular fa-copy'></i></span></button><button type='button' class='btn btn-icon-only action-btn'><span class='anticon'><i class='fa-light fa-code-fork'></i></span></button><button type='button' class='btn btn-icon-only action-btn'><span class='anticon'><i class='fa-regular fa-pen-to-square'></i></span></button><button type='button' class='btn btn-icon-only action-btn'><span class='anticon'><i class='fa-solid fa-arrows-up-down-left-right'></i></span></button><button type='button' class='btn btn-icon-only action-btn'><span ><i class='fa-solid fa-trash-can'></i></span></button></span></div></div></div></div><div class='item-answer'>User's reply</div></div></div>");
                    $(el).insertAfter($(x).find('#droppable'));
                    x.appendTo('#droppable');
                    $('.delete').on('click', function () {
                        $(this).parent().parent('span').remove();
                    });
                    $('.delete').parent().parent('span').dblclick(function () {
                        $(this).remove();
                    });
                }
            }
        });
    });
</script>
<?php }
