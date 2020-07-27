<?php
    require "header.php";
    if(!isset($_SESSION['memberId'])){
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?error=not-session-member");
    }else{
    }
?>
<div class="add">
    <div class="title">
        <p>Add an Apartment</p>
    </div>
    <div class="addContainer">
            <form action="#">
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Contract Information</p>
                        <ul>
                            <li>Information about your contract with this apartment/house</li>
                            <li>Add only numbers in "Landlord Phone" field</li>
                        </ul>
                    </div>
                    <div class="long">
                        <label for="company">Company Name <i>(if applicable)</i>: </label>
                        <input type="text" id="company" name="company" autofocus="on" placeholder="Company Name">
                    </div>
                    <div class="required">
                        <label for="landlordFName">Landlord First Name: </label>
                        <input type="text" id="landlordFName" name="landlordFName" placeholder="First Name" required="required">
                    </div>
                    <div class="required">
                        <label for="landlordLName">Landlord Last Name: </label>
                        <input type="text" id="landlordLName" name="landlordLName" placeholder="Last Name" required="required">
                    </div>
                    <div>
                        <label for="landlordEmail">Landlord Email: </label>
                        <input type="email" id="landlordEmail" name="landlordEmail" placeholder="email@gmail.com">
                    </div>
                    <div>
                        <label for="landlordPhone">Landlord Phone: </label>
                        <input type="text" id="landlordPhone" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" name="landlordPhone" placeholder="2342342342">
                    </div>
                    <div class="required">
                        <label for="start">Start Contract:</label>
                        <!--++++++++++++++current date++++++++++++++++++++++++++-->
                        <input type="date" id="start" name="contrc-start" value="YYY-MM-DD" min="2008-01-01" max="2030-07-22" required="required">
                    </div>
                    <div class="required">
                        <label for="end ">End Contract: </label>
                        <input type="date" id="end" name="contrc-end" value="MM/DD/YYYY" min="2010-01-01" max="2040-07-22" required="required">
                    </div>
                    <div class="required">
                        <label for="rent">Rent: $</label>
                        <input type="number" placeholder="0.00" id="rent" min="1" step="0.01" required="required">
                    </div>
                </section>
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Address</p>
                        <ul>
                            <li>Do not add <i>"st, str., street"</i> at the end of the field "Street Name", enter only the street name</li>
                        </ul>
                    </div>
                    <div>
                        <label for="unitNum">Unit Number: </label>
                        <input type="text" placeholder="906" id="unitNum">
                    </div>
                    <div class="required">
                        <label for="streetNum">Street Number: </label>
                        <input type="text" placeholder="1865" id="streetNum" required="required">
                    </div>
                    <div class="required">
                        <label for="streetName">Street Name: </label>
                        <input type="text" maxlength="20" placeholder="Beatty" id="streetName" required="required">
                    </div>
                    <div class="required">
                        <label for="postCode1">Postal Code: </label>
                        <input size="5" type="text" maxlength="3" pattern="[A-Za-z][0-9][A-Za-z]" placeholder="V6Z" id="postCode1" required="required">
                
                        <label for="postCode2">-</label>
                        <input size="5" type="text" maxlength="3" pattern="[0-9][A-Za-z][0-9]" placeholder="3C1" id="postCode2" required="required">
                    </div>
                </section>
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Extra Details</p>
                        <ul>
                            <li>You can select multiple images (minimum 1, maximum 5 per apartment)</li>
                            <li>The long description will appear on the "Full Rent Appartment" description, it will be public</li>
                            <li>The short description will appear on the "Main Page", it will be public</li>
                            <li>Comments field is not required and is private, only you can see this information, you can add comments or additional notes in this field</li>
                        </ul>
                    </div>
                    <div class="long required">
                        <label for="images">Select Images</label>
                        <input type="file" id="images" name="image1" multiple accept="image/png, image/jpeg" required="required">
                    </div>
                    <div class="long required">
                        <label for="shortDesc">Short Description: </label>
                        <textarea id="shortDesc" rows="2" name="shortDesc" required="required"></textarea>
                    </div>
                    <div class="long required">
                        <label for="longDesc">Long Description: </label>
                        <textarea id="longDesc" rows="10" name="longDesc" required="required"></textarea>
                    </div>
                    <div class="long">
                        <label for="comments">Comments: </label>
                        <textarea id="comments" rows="10" name="comments"></textarea>
                    </div>
                </section>
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Please, before to submit revise if the information provided is correct</p>
                        <ul>
                            <li>Also, you can edit the information latter on the apartaments section</li>
                        </ul>
                    </div>
                    <div>
                        <button type="submit" name="send-message">Send</button>
                    </div>
                </section>
            </form>
    </div>
</div>
<script>
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
    var month = (new Date().getMonth()+1) < 10 ? "0"+(new Date().getMonth()+1):(new Date().getMonth()+1);
    var date = new Date().getFullYear() + "-" + month + "-" + new Date().getDate();
    
    document.getElementById('end').min = date;
</script>
<?php
    require "footer.php";
?>