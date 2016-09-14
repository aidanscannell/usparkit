<div class="modal fade" id="requestFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Sponsorship Request</h4>
      </div>
      <div class="modal-body" style="padding-left:10%;">
        <div class="row">
          <div class="col-md-11 col-sm-11 col-xs-11">
      			<form name="postRequestForm" id="postRequestForm" onsubmit="return false;" class="form-horizontal" role="form">
      				<div class="form-group has-feedback">
      					<label for="inputLastName" class="col-sm-5 control-label" style="text-align:left;">Type of Sponsorship <span class="text-danger small">*</span></label>
      					<div class="col-sm-6">
      					<select id="sponsorship_typeR" class="form-control" onfocus="emptyElement(\'status\')">
      						<option value="any">Any</option>
      						<option value="custom_stashR">Custom Stash/Clothing</option>
      						<option value="donationR">Donation</option>
      						<option value="gift_cardR">Gift Card</option>
      						<option value="voucherR">Voucher</option>
      					</select>
      					<i class="form-control-feedback"></i>
      					</div>
      				</div>

      				<div id="custom_stashR" class="inv">
      					<div class="form-group has-feedback">
      						<label for="" class="col-sm-5 control-label" style="text-align:left;">Maximum amount (£): <span class="text-danger small">*</span></label>
      						<div class="col-sm-6">
      							<input id="custom_stash_amountR" class="form-control" type="number" step="0.01" placeholder="Maximum amount" onfocus="emptyElement(\'status\')" maxlength="88" required>
      							<i class="fa fa-gbp form-control-feedback"></i>
      						</div>
      					</div>
      				</div>
      				<div id="donationR" class="inv">
      					<div class="form-group has-feedback">
      						<label for="" class="col-sm-5 control-label" style="text-align:left;">Maximum amount (£): <span class="text-danger small">*</span></label>
      						<div class="col-sm-6">
      							<input id="donation_amountR" class="form-control" type="number" step="0.01" placeholder="Maximum amount" onfocus="emptyElement(\'status\')" maxlength="88" required>
      							<i class="fa fa-gbp form-control-feedback"></i>
      						</div>
      					</div>
      				</div>
      				<div id="gift_cardR" class="inv">
      					<div class="form-group has-feedback">
      						<label for="" class="col-sm-5 control-label" style="text-align:left;">Maximum amount (£): <span class="text-danger small">*</span></label>
      						<div class="col-sm-6">
      							<input id="gift_card_amountR" class="form-control" type="number" step="0.01" placeholder="Maximum amount" onfocus="emptyElement(\'status\')" maxlength="88" required>
      							<i class="fa fa-gbp form-control-feedback"></i>
      						</div>
      					</div>
      				</div>
      				<div id="voucherR" class="inv">
      					<div class="form-group has-feedback">
      						<label for="" class="col-sm-4 control-label" style="text-align:left;">Maximum amount: <span class="text-danger small">*</span></label>
      						<div class="col-sm-6">
      							<input id="voucher_amountR" class="form-control" type="number" placeholder="Maximum amount" onfocus="emptyElement(\'status\')" maxlength="88" required>
      						</div>
      						<div class="col-sm-2">
      						<select id="voucherTypeR" class="form-control" onfocus="emptyElement(\'status\')">
      							<option value="amount">&#163;</option>
      							<option value="percent">&#37;</option>
      						</select>
      						</div>
      					</div>
      				</div>

              <div class="form-group has-feedback">
      					<label class="col-sm-5 control-label" style="text-align:left;">Eligible Sponsors<span class="text-danger small">*</span></label>
      					<div class="col-sm-6">
      			          <select data-placeholder="Whose Eligible" style="width:200px;" id="eligibleGroupsR">
                        <option value="AllTypes">All Types</option>
    			              @include('includes.lists.organisation-list')
      			          </select>
      	    			</div>
      				</div>

              <div class="form-group has-feedback">
      					<label for="" class="col-sm-12" style="text-align:left;">Details of Sponsorship <span class="text-danger small">*</span></label>
                  <div id="wysiwyg_cpRequest" style="width:100%;">
                    <a onClick="iHeadingRequest()" value="H" id="H" class="wysiwygBtn" title="Heading">Heading</a>
                    <a onClick="iSubHeadingRequest()" value="SH" id="H" class="wysiwygBtn" title="Sub Heading">Sub Heading</a>
                    <a onClick="iBoldRequest()" value="B" id="B" class="wysiwygBtn" title="Bold">Bold</a>
                    <a onClick="iUnderlineRequest()" value="U" id="U" class="wysiwygBtn" title="Underline">Underline</a>
                    <a onClick="iItalicRequest()" value="Italic" id="I" class="wysiwygBtn" title="Italic">Italic</a>
                    <a onClick="iHorizontalRuleRequest()" value="HR" id="HR" class="wysiwygBtn" title="Horizontal Line">Insert Horizontal Line</a>
                    <a onClick="iUnorderedListRequest()" value="UL" id="numericalList" class="wysiwygBtn" title="Numerical List">Numerical List</a>
                    <a onClick="iOrderedListRequest()" value="OL" id="bulletList" class="wysiwygBtn" title="Bullet List">Bullet List</a>
                    <a onClick="iLinkRequest()" value="Link" id="Link" class="wysiwygBtn" title="Insert Link">Link</a>
                  </div>
                  <iframe onload="iFrameOnRequest()" src="requestDetailsTemplate.html" class="form-control" name="richTextFieldRequest" id="richTextFieldRequest" style="border:#000000 1px solid; width:100%; height:200px;" scrolling="yes"></iframe>
              </div>


                <div class="form-group">
        					<div class=" col-sm-12">
        						<button type="submit" id="postRequestBtn" name="postRequestBtn" class="btn btn-group btn-default btn-animated" onclick="postRequest()">Post Request<i class="fa fa-check"></i></button>
        						<span id="postRequestStatus"></span>
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
