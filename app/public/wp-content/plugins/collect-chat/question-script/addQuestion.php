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
                <input type="hidden" name="action" value="createquestion">
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
                    <div class="col-12 option">
                       <div class="form-group">
                            <label for="SkipButton" class="optionLabel">Option</label>
                            <label for="suggestions" class="listLabel">Auto suggestions</label>
                        </div>
                    </div>
                    <div class="col-12 option">
                       <div class="form-group">
                            <input class="form-control-inline optionVal" value="Sample Option" type="text" role="switch" id="option" name="option[]" placeholder="Enter option">
                            <button type="button" onclick="AddList()" id="addOption" class="btn btn-primary btn-icon-only action-btn">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <div id="optionList"></div>
                    </div>
                    <div class="col-12 email" >
                       <div class="form-group">
                            <label for="SkipButton">Reject email providers like Gmail, Yahoo and more</label>&nbsp;
                            <input class="form-check-input" type="checkbox" role="switch" id="RejectEmail" name="RejectEmail">
                        </div>
                    </div>
                    <div class="col-12 email">
                       <div class="form-group">
                            <label for="error">Error message when visitor enters invalid answer</label>
                            <input class="form-control" type="text" role="switch" id="EmailErrorMsg" name="EmailErrorMsg" value="Please enter a valid email address">
                        </div>
                    </div>
                    <div class="col-12 phoneNumber">
                        <div class="form-group">
                             <label for="error">Error message when visitor enters invalid answer</label>
                            <input class="form-control" type="text" id="PhoneErrorMsg" name="PhoneErrorMsg" value="Please enter a valid number">
                        </div>
                    </div>
                    <div class="col-12 phoneNumber">
                        <div class="form-group">
                            <label for="Validate">Validate phone number using SMS verification code</label>&nbsp;
                            <input class="form-check-input" type="checkbox" id="OPTValidation" name="OPTValidation">
                        </div>
                    </div>
                    <div class="row number">
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="MinDigit">Minimum digits</label>&nbsp;
                                <input class="form-control" type="text" id="MinDigit" name="MinDigit">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="MaxDigit">Maximum digits</label>&nbsp;
                                <input class="form-control"  type="text" id="MaxDigit" name="MaxDigit">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 number" style="display:none;">
                        <div class="form-group"> 
                            <label for="error">Error message when visitor enters invalid answer</label>
                            <input class="form-control" type="text" id="NumberErrorMsg" name="NumberErrorMsg" value="Please enter a valid email address">
                        </div>
                    </div>
                    <div class="row range" style="display:none;">
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Prefix">Prefix</label>&nbsp;
                                <input class="form-control" type="text" id="Prefix" name="Prefix">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Suffix">Suffix</label>&nbsp;
                                <input class="form-control"  type="text" id="Suffix" name="Suffix">
                            </div>
                        </div>
                    </div>
                    <div class="row range" style="display:none;">
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Minimum">Minimum</label>&nbsp;
                                <input class="form-control" value="0" type="text" id="Minimum" name="Minimum">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Maximum">Maximum</label>&nbsp;
                                <input class="form-control" value="100"  type="text" id="Maximum" name="Maximum">
                            </div>
                        </div>
                    </div>
                    <div class="row range" style="display:none;">
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Step">Step</label>&nbsp;
                                <input class="form-control" value="1" type="text" id="Step" name="Step">
                            </div>
                        </div>
                    </div>
                    <div class="row rating" style="display:none;"> 
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Rating-1">Rating-1</label>&nbsp;
                                <input class="form-control" value="Terrible" type="text" id="Rating_1" name="Rating[]">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Rating-2">Rating-2</label>&nbsp;
                                <input class="form-control"  value="Bad"  type="text" id="Rating_2" name="Rating[]">
                            </div>
                        </div>
                    </div>
                    <div class="row rating" style="display:none;">
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Rating-3">Rating-3</label>&nbsp;
                                <input class="form-control" value="Okay" type="text" id="Rating_3" name="Rating[]">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Rating-4">Rating-4</label>&nbsp;
                                <input class="form-control" value="Good"  type="text" id="Rating_4" name="Rating[]">
                            </div>
                        </div>
                    </div>
                    <div class="row rating">
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="Rating-5">Rating-5</label>&nbsp;
                                <input class="form-control" value="Awesome" type="text" id="Rating_5" name="Rating[]">
                            </div>
                        </div>
                    </div>
                    <div class="row opinion">
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="LeftLabel">Left label</label>&nbsp;
                                <input class="form-control" value="Less likely" type="text" id="LeftLabel" name="LeftLabel">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="RightLabel">Right label</label>&nbsp;
                                <input class="form-control" value="Very likely"  type="text" id="RightLabel" name="RightLabel">
                            </div>
                        </div>
                    </div>
                    <div class="row date" >
                        <div class="col-6">
                            <div class="form-group"> 
                                <label for="PastDate">Show past dates</label>
                                <input class="form-check-input" type="checkbox" role="switch" id="PastDate" name="PastDate">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="FutureDate">Show future dates</label>
                                <input class="form-check-input" type="checkbox" role="switch" id="FutureDate" name="FutureDate">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 file" style="display:none;">
                       <div class="form-group">
                            <label for="FileError">Message to show when file size exceeds 10 Mb</label>
                            <input class="form-control" type="text" role="switch" id="FileErrorMsg" name="FileErrorMsg" value="File size exceeded 10 Mb">
                        </div>
                    </div>
                    <div class="col-12 file" style="display:none;">
                        <div class="form-group">
                            <label for="FileUploadFail">Message to show when upload fails</label>
                            <input class="form-control" type="text" id="FileUploadFail" name="FileUploadFail" value="File Upload failed">
                        </div>
                    </div>
                    <div class="row link" style="display:none;">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="Type">Type</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="Title">Title</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="NameLink">Username / Link</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="Title">New tab?</label>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="row link" style="display:none;">
                        <div class="col-2">
                            <div class="form-group">
                                <select name="LinkType" id="LinkType" onchange="linkType(this);">
                                    <?php 
                                    $linkData = getLinksList();
                                    foreach($linkData as $link) {
                                        ?>
                                        <option value="<?php echo $link['type']?>" data-item="<?php echo htmlspecialchars(json_encode($link), ENT_QUOTES);?>"><?php echo $link['type']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <input type="text" class="from-control" name="Text[]" id="Text">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <input type="text" class="from-control" name="Link[]" id="Link">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                &nbsp;&nbsp;<input class="form-check-input" type="checkbox" role="switch" id="sameTab" name="sameTab[]">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <button type="button" onclick="addLink();" id="addLinks" class="btn btn-primary btn-icon-only action-btn">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div id="LinksList"></div>
                    </div>
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


<script>
    function linkType(obj){
        var linkType = $(obj).val();
        var linksData = $(obj).find(":selected").data('item');
        $(obj).closest('.row').find('input[name="Text[]"]').val(linksData.text);
        $(obj).closest('.row').find('input[name="Link[]"]').val(linksData.link);
    }
   
var $ = jQuery;
$('.option').hide();
    $(document).ready(function(){
        var editor =  ClassicEditor.create( document.querySelector( '#questionName' ) );
        $('.option').hide();
        $('.email').hide();
        $('.phoneNumber').hide();
        $('.list').hide();
        $('.listLabel').hide();
        $('.number').hide();
        $('.range').hide();
        $('.rating').hide();
        $('.opinion').hide();
        $('.date').hide();
        $('.file').hide();
        $('.link').hide();
        $('#questionType').on('change',function(){
            var questionType = $(this).val();
            if(questionType == "Message"){
                $(".skipBackBtn").hide();
            } else {
                $(".skipBackBtn").show();
            }
            if(questionType == "MultiChoice" || questionType == "Yes/No"  || questionType == "MultiSelect"
             || questionType == "List" ){
                if(questionType == "Yes/No"){
                    $('#option').attr('value','Yes');
                    AddList('No');
                } else{
                    $('.optionVal').attr('value','Sample Option');
                    $(".RemoveDiv").hide();
                }
                if(questionType == "List"){
                    $('.optionLabel').hide();
                    $('.listLabel').show();
                } else {
                    $('.optionLabel').show();
                    $('.listLabel').hide();
                }
                $(".option").show();
            } else {
                $(".option").hide();
            }
            if(questionType == "Email"){
                $(".email").show();
            } else {
                $(".email").hide();
            } 
            if(questionType == "PhoneNumber"){
                $(".phoneNumber").show();
            } else {
                $(".phoneNumber").hide();
            }
            if(questionType == "List"){
                $('input.deletable').wrap('<span class="deleteicon"></span>').after($('<span>x</span>').click(function() {
                    $(this).prev('input').val('').trigger('change').focus();
                }));
                $(".list").show();
            } else {
                $(".phoneNumber").hide();
            }
            if(questionType == "Number"){
                $(".number").show();
            } else {
                $(".number").hide();
            }
            if(questionType == "Range"){
                $(".range").show();
            } else {    
                $(".range").hide();
            }
            if(questionType == "Rating"){
                $(".rating").show();
            } else {    
                $(".rating").hide();
            }
            if(questionType == "Opinion"){
                $(".opinion").show();
            } else {    
                $(".opinion").hide();
            }
            if(questionType == "Date"){
                $(".date").show();
            } else {    
                $(".date").hide();
            }
            if(questionType == "File"){
                $(".file").show();
            } else {    
                $(".file").hide();
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
