<?php
    require "header.php";
?>
    <div class="contentRequest">
        <div class="title">
            <h5>Request</h5>
        </div>
        <div class="formContent">
            <p class="icon"><i class="far fa-envelope"></i></p>
            <div class="information">
                <p>Please,</p>
                <p class="detail"> Be sure to be specific in your request description, this will help us process your request quickly.</p>
            </div>
            <div class="form">
                <form action="#" method="post">
                    <label for="request">Type of request:</label>
                    <select name="request" id="request">
                        <optgroup label="Maintenance Request">
                            <option value="Cleanning">Clean</option>
                            <option value="fixing">Reparate</option>
                            <option value="replace">Replace</option>
                            <option value="paint">Paint</option>
                            <option selected="selected" value="otherMaintenance">Other Maintenance</option>
                        </optgroup>
                        <optgroup label="Payment Information">
                            <option value="bills">My billing information</option>
                            <option value="extraCharges">Additional charges info</option>
                        </optgroup>
                        <optgroup label="Other Inquiries">
                            <option value="extension">Extend my contract</option>
                            <option value="otherInquiry">Other inquiry</option>
                        </optgroup>
                    </select>
                    
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" placeholder="Subject...">

                    <label for="message">Specify your request:</label>
                    <textarea name="message" placeholder="Message..."></textarea>

                    <button type="submit" name="send-message">Send</button>
                </form>
            </div>
        </div>
    </div>
<?php
    require "footer.php";
?>