<?php
include(plugin_dir_path(__FILE__) .'question-helper.php');

function addQuestion() {
    global $wpdb;
    $table = $wpdb->prefix . "question_types";
    $result = $wpdb->get_results("SELECT * FROM $table" ,ARRAY_A );
    $linkData = getLinksList();
?>   
<div class="wrapper">
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary float-end" id="AddQuestion" name="AddQuestion" data-bs-toggle="modal" data-bs-target="#myModal">Add Question</button>
        </div> 
    </div>
</div>

<style>
.modal-body {
    /* height: calc(100vh - 5em); */
    overflow-x: auto;
}
</style>
<div class="modal" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
    
        <!-- Modal body -->
        <div class="modal-body">
            <form id="addQuestionForm" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')) ?>">
                <input type="hidden" name="action" value="createcollection">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <select name="questionType" id="questionType">
                                <option value="">Select Question Type</option>
                                <?php foreach($result as $data){
                                ?>
                                    <option value="<?php echo $data['question_type']?>"><?php echo $data['label']?> </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="questionName" id="questionName" placeholder="Enter Question" ></textarea>
                        </div>
                    </div>
                    <div class="col-6 skipBackBtn">
                        <div class="form-group"> 
                            <label for="BackButton">Back button</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="backButton" name="backButton">
                        </div>
                    </div>
                    <div class="col-6 skipBackBtn">
                       <div class="form-group ">
                            <label for="SkipButton">Skip button</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="skipButton" name="skipButton">
                            </div>
                        </div>
                    </div>
                    <div class="question-content"></div>
                    <div class="row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-end" name="submit" id="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>    
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
    var $ = jQuery;
    function linkType(obj){
        var linkType = $(obj).val();
        var linksData = $(obj).find(":selected").data('item');
        $(obj).closest('.row').find('input[name="Text[]"]').val(linksData.text);
        $(obj).closest('.row').find('input[name="Link[]"]').val(linksData.link);
    }
        
  
$('.option').hide();
    $(document).ready(function(){
        var editor =  ClassicEditor.create( document.querySelector( '#questionName' ) );

        $('#questionType').on('change',function(){
            var questionType = $(this).val();

            $.ajax({
                type: 'POST',
                url: 'http://localhost:10040/wp-json/chatbot/v1/fetch_ajax_content',
                data: {
                    'action' : 'fetch_ajax_content',
                    'id' : questionType
                },
                dataType: 'html',
                success:function(data) {
                   console.log(data);
                    $('.question-content').html('');
                    $('.question-content').html(data);
                }

            });
            if(questionType == "Message"){
                $(".skipBackBtn").hide();
            } else {
                $(".skipBackBtn").show();
            }
            if(questionType == "MultiChoice" || questionType == "Yes/No" ){
                if(questionType == "Yes/No"){
                    $('#option').attr('value','Yes');
                    AddList('No');
                } else{
                    $('.optionVal').attr('value','Sample Option');
                    $(".RemoveDiv").hide();
                }
                $(".option").show();
            } else {
                $(".option").hide();
            }
            if(questionType == "Links"){
                $('.skipBackBtn').hide();
                $(".link").show();
            } else { 
                $('.skipBackBtn').show();   
                $(".link").hide();
            }
            console.log(questionType);
        });
    });
    function AddList(option = ''){
        let random = Math.random(11,1111111111);
        random = random.toString().replace('.', '');
        $('#optionList').append(`
        <div id="id_`+random+`" class="form-group RemoveDiv">
            <input class="form-control-inline optionVal" value="Sample Option" type="text" role="switch" id="option_`+random+`"  name="option[]" placeholder="Enter option">
            <button type="button" onclick="AddList()" id="addOption" class="btn btn-primary btn-icon-only action-btn">
                <i class="fa-solid fa-plus"></i>
            </button>
            <button class="btn btn-danger" id="remove" onclick="RemoveList('id_`+random+`')">
                <i class="fa fa-close"></i>
            </button>
        </div>
        `);
        if(option){
            $('#option_'+random).attr('value',option);
        }
    }
    
    function addLink(){
        let random = Math.random(11,1111111111);
        random = random.toString().replace('.', '');
        $('#LinksList').append(`
            <div id="id_`+random+`" class="row link">
                <div class="col-2">
                    <select name="LinkType[]" id="LinkType_`+random+`" onchange="linkType(this);">
                        <?php 
                        foreach($linkData as $link) { ?>
                            <option value="<?php echo $link['type']?>" data-item="<?php  echo htmlspecialchars(json_encode($link), ENT_QUOTES);?>"><?php echo $link['type']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-3">
                    <input type="text" class="from-control" name="Text[]" id="Text_`+random+`">
                </div>
                <div class="col-3">
                    <input type="text" class="from-control" name="Link[]" id="Link_`+random+`">
                </div>
                <div class="col-2">
                    &nbsp;&nbsp;<input class="form-check-input" type="checkbox" role="switch" id="sameTab_`+random+`" name="sameTab[]">
                </div>
                <div class="col-2">
                    <button type="button" onclick="addLink();" id="addLinks" class="btn btn-primary btn-icon-only action-btn">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button class="btn btn-danger" id="remove" onclick="RemoveList('id_`+random+`')">
                        <i class="fa fa-close"></i>
                    </button>
            </div>
        `);
    }
 
    function RemoveList($id)
    {
        $('#'+$id).remove();
    }
</script>
<?php }
