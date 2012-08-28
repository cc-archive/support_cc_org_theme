<!-- One Click -->
<div id="moreOptions" style="display: none;">
	<form name="donateOptions">
		<div id="pcpOptions" style="display:none;">
			<h5>Choose your donation amount</h5>
			<select name="customAmountSelection" id="customAmountSelection" onchange="donationSelection(this);" size="1">
				<option value="">Choose your donation amount</option>
				<option value="25">$25</option>
				<option value="50">$50</option>
				<option value="150">$150</option>
				<option value="300">$300</option>
				<option value="1000">$1000</option>
				<option value="other">Other</option>
			</select>
			<span id="customAmount" style="display: none; margin-left: 10px;">
				<label for="customAmountEntry">Other Amount:</label> $<input type="text" size="5" name="customAmountEntry" value="" id="customAmountEntry">
			</span>
			<p id="pcpError"></p>
		</div>
		<div id="noPremiums" style="display:block;">
			<p><strong>Note:</strong> You will not receive any premiums, including the t-shirt, at this donation&nbsp;level.</p>
		</div>
		<div id="premiums" style="display:block;">
			<p style="float: right">
                <img src="/sites/default/files/cc_logo_tshirt.jpg" alt="CC logo t-shirt"/><br/>
				<small style="font-size:10px; line-height:1.2">CC logo t-shirt</small>
			</p>

			<p>
				<input id="giftCheck" name="giftCheck" type="checkbox" checked value="yes" class="form-checkbox" />
				<label for="giftCheck">I would like to receive a gift for my donation.</label>
			</p>
			<div id="tshirtSize">
				<h5>Tshirt Size</h5>
				<div style="font-size: x-small">
					<strong>Note:</strong> the shirt you receive may be different from the one pictured.
				</div>
				<select name="size">
					<option value="">-- Select Size --</option>
					<option value="Womens Small">Women's Small</option>
					<option value="Womens Medium">Women's Medium</option>
					<option value="Womens Large">Women's Large</option>
					<option value="Adult Small">Adult Small</option>
					<option value="Adult Medium">Adult Medium</option>
					<option value="Adult Large">Adult Large</option>
					<option value="Adult X-Large">Adult X-Large</option>
					<option value="Adult XX-Large">Adult XX-Large</option>
				</select>
				<span id="shirtError"></span>
			</div>
		</div>
		<div id="recurring" style="display:block;">
			<h5>Monthly Donation <small>(Optional)</small></h5>
			<p>
				<input type="radio" name="recur" value="1" id="recur_annual" /> I would like to give $<span class="recurringAmount"></span> per month <em>for the next year</em>.<br/>
				<input type="radio" name="recur" value="2" id="recur_infinite" />  I would like to give $<span class="recurringAmount"></span> per month <em>until I choose to cancel</em>.<br/>
				<input type="radio" name="recur" value="" id="recur_none" /> I would like to make a single donation of $<span class="amount"></span>.
			</p>
		</div>

		<h5>Mailing List Opt-in</h5>
		<p>
			<input id="newsletterGroup" name="groups" type="checkbox" value="CC Newsletter" class="form-checkbox" />
			<label for="newsletterGroup">Yes, I would like to receive CC Newsletters.</label>
			<br/>
			<input id="eventsGroup" name="groups" type="checkbox" value="CC Events" class="form-checkbox" />
			<label for="eventsGroup">Yes, I would like to be notified about CC events.</label>
		</p>
		<h5>Supporter Listing Opt-out</h5>
		<p>
			<input id="optout" name="optout" type="checkbox" value="Supporters" class="form-checkbox" />
			<label for="optout">Do not include my name in any supporter lists.</label>
		</p>
		<div class="paymentOptions">
			<h5>Payment Options</h5>
			<ul>
				<li><strong>PayPal</strong> &mdash; Use your credit card or PayPal account.</li>
				<li><strong>Google Checkout</strong> &mdash; Requires a Checkout account.</li>
			</ul>
		</div>
	</form>
</div>

