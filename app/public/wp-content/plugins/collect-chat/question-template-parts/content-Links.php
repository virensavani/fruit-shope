<div class="row link" >
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
<div class="row link" >
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