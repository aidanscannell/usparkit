<div class="modal fade" id="advertFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Create Sponsorship Advert</h4>
        </div>
        <div class="modal-body" style="padding-left:10%;">
          <div class="row">
            <div class="col-md-11 col-sm-11 col-xs-11">
        			<form name="postAdvertForm" id="postAdvertForm" onsubmit="return false;" class="form-horizontal" role="form">
        				<div class="form-group has-feedback">
        					<label for="inputLastName" class="col-sm-6 control-label">Select Type of Sponsorship <span class="text-danger small">*</span></label>
        					<div class="col-sm-6">
        					<select id="sponsorship_type" class="form-control" onfocus="emptyElement(\'status\')">
        						<option value="">All</option>
        						<option value="custom_stash">Custom Stash/Clothing</option>
        						<option value="donation">Donation</option>
        						<option value="gift_card">Gift Card</option>
        						<option value="voucher">Voucher</option>
        					</select>
        					<i class="form-control-feedback"></i>
        					</div>
        				</div>

        				<div id="custom_stash" class="inv">
        					<div class="form-group has-feedback">
        						<label for="" class="col-sm-6 control-label">Maximum stash amount (£): <span class="text-danger small">*</span></label>
        						<div class="col-sm-6">
        							<input id="custom_stash_amount" class="form-control" type="number" step="0.01" placeholder="Enter maximum value of stash" onfocus="emptyElement(\'status\')" maxlength="88" required>
        							<i class="fa fa-gbp form-control-feedback"></i>
        						</div>
        					</div>
        				</div>
        				<div id="donation" class="inv">
        					<div class="form-group has-feedback">
        						<label for="" class="col-sm-6 control-label">Maximum donation amount (£): <span class="text-danger small">*</span></label>
        						<div class="col-sm-6">
        							<input id="donation_amount" class="form-control" type="number" step="0.01" placeholder="Enter maximum donation amount" onfocus="emptyElement(\'status\')" maxlength="88" required>
        							<i class="fa fa-gbp form-control-feedback"></i>
        						</div>
        					</div>
        				</div>
        				<div id="gift_card" class="inv">
        					<div class="form-group has-feedback">
        						<label for="" class="col-sm-6 control-label">Maximum gift card amount (£): <span class="text-danger small">*</span></label>
        						<div class="col-sm-6">
        							<input id="gift_card_amount" class="form-control" type="number" step="0.01" placeholder="Enter maximum value of gift card" onfocus="emptyElement(\'status\')" maxlength="88" required>
        							<i class="fa fa-gbp form-control-feedback"></i>
        						</div>
        					</div>
        				</div>
        				<div id="voucher" class="inv">
        					<div class="form-group has-feedback">
        						<label for="" class="col-sm-4 control-label">Max voucher amount: <span class="text-danger small">*</span></label>
        						<div class="col-sm-6">
        							<input id="voucher_amount" class="form-control" type="number" placeholder="Enter maximum value of voucher" onfocus="emptyElement(\'status\')" maxlength="88" required>
        						</div>
        						<div class="col-sm-2">
        						<select id="voucherType" class="form-control" onfocus="emptyElement(\'status\')">
        							<option value="amount">&#163;</option>
        							<option value="percent">&#37;</option>
        						</select>
        						</div>
        					</div>
        				</div>

                <div class="form-group has-feedback">
        					<label class="col-sm-6 control-label">Eligible Groups<span class="text-danger small">*</span><br />(Select multiple if neccessary)</label>
        					<div class="col-sm-6">
        			          <select data-placeholder="Whose Eligible" style="width:200px;" id="eligibleGroups">
        			            <option value=""></option>
        			            <option value="AllTypes">All Types</option>
        			            <option value="AllSports">All Sport Groups</option>
                          <optgroup label="Sports">
        			              @include('includes.lists.sports-list')
        			            </optgroup>
        			            <optgroup label="Other">
        			              @include('includes.lists.others-list')
        			            </optgroup>
        			          </select>
        	    			</div>
        				</div>

                <div class="form-group has-feedback">
        					<label for="" class="col-sm-12">Sponsorship Proposal <span class="text-danger small">*</span></label>
                    <div id="wysiwyg_cpAdvert" style="width:100%;">
                      <a onClick="iHeadingAdvert()" value="H" id="H" class="wysiwygBtn" title="Heading">Heading</a>
                      <a onClick="iSubHeadingAdvert()" value="SH" id="H" class="wysiwygBtn" title="Sub Heading">Sub Heading</a>
                      <a onClick="iBoldAdvert()" value="B" id="BAdvert" class="wysiwygBtn" title="Bold">Bold</a>
                      <a onClick="iUnderlineAdvert()" value="U" id="U" class="wysiwygBtn" title="Underline">Underline</a>
                      <a onClick="iItalicAdvert()" value="Italic" id="I" class="wysiwygBtn" title="Italic">Italic</a>
                      <a onClick="iHorizontalRuleAdvert()" value="HR" id="HR" class="wysiwygBtn" title="Horizontal Line">Insert Horizontal Line</a>
                      <a onClick="iUnorderedListAdvert()" value="UL" id="numericalList" class="wysiwygBtn" title="Numerical List">Numerical List</a>
                      <a onClick="iOrderedListAdvert()" value="OL" id="bulletList" class="wysiwygBtn" title="Bullet List">Bullet List</a>
                      <a onClick="iLinkAdvert()" value="Link" id="Link" class="wysiwygBtn" title="Insert Link">Link</a>
                    </div>
                    <iframe onload="iFrameOnAdvert()" src="/src/html/advert-details-template.html" class="form-control" name="richTextFieldAdvert" id="richTextFieldAdvert" style="border:#000000 1px solid; width:100%; height:200px;" scrolling="yes"></iframe>
                </div>


                  <div class="form-group">
          					<div class=" col-sm-12">
          						<button type="submit" id="postAdvertBtn" name="postAdvertBtn" class="btn btn-group btn-default btn-animated" onclick="postAdvert()">Post Advert<i class="fa fa-check"></i></button>
          						<span id="postAdvertStatus"></span>
          					</div>
          				</div>

        			</form>

            </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
