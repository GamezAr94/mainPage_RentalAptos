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
<div id="requestSent">
    <div class="messageBox">
        <div class="checkMark" id="visible">
            <div></div>
            <div></div>
        </div>
        <div class="messageSent">
            <p>Apartament added succesfully!</p>
        </div>
    </div>
</div>
<div class="add">
    <div class="title">
        <p>Add an Apartment</p>
    </div>
    <div class="addContainer">
        <?php if(isset($_GET['errorSavingImage']) || isset($_GET['errorUploading']) || isset($_GET['errorSize']) || isset($_GET['errorProcess']) ||isset($_GET['errorExtension']) || isset($_GET['errorConnection'])){
            echo "<div id='errorHandler'>
                    <ul>";
                        if(isset($_GET['errorConnection'])){
                            echo "<li>You should fill the form before send it, try filling up the form and send it again</li>";
                        }
                        if(isset($_GET['errorSavingImage'])){
                            echo "<li>There is a problem saving the image(s) <i clas='blue'>".str_replace("-"," ".str_repeat('.', 3)." ",$_GET['errorSavingImage'])."</i>, please try to upload the image(s) again under apartaments configuration section</li>";
                        }
                        if(isset($_GET['errorUploading'])){
                            echo "<li>Problem uploading the image(s) <i clas='blue'>".str_replace("-"," ".str_repeat('.', 3)." ",$_GET['errorUploading'])."</i> to our servers, please try to upload the image(s) again under apartaments configuration section</li>";
                        }
                        if(isset($_GET['errorSize'])){
                            echo "<li>The image(s) <i clas='blue'>".str_replace("-"," ".str_repeat('.', 3)." ",$_GET['errorSize'])."</i> size is/are too big, please try to upload an image(s) less big under apartaments configuration section</li>";
                        }
                        if(isset($_GET['errorProcess'])){
                            echo "<li>Problem attaching the image(s) <i clas='blue'>".str_replace("-"," ".str_repeat('.', 3)." ",$_GET['errorProcess'])."</i>, please try to upload other image(s) again under apartaments configuration section</li>";
                        }
                        if(isset($_GET['errorExtension'])){
                            echo "<li><i clas='blue'>".str_replace("-"," ".str_repeat('.', 3)." ",$_GET['errorExtension'])."</i> has an invalid extension, please upload a valid extension to our servers under apartaments configuration section</li>";
                        }
                    echo "</ul>
                </div>";
        } 
        ?>
        
        <form action="includes/addApartment.inc.php" method="post" enctype="multipart/form-data" id="addAptoForm" >
            <section>
                    <div class="extraInfo">
                        <p class="subtitle">Contract Information</p>
                        <ul>
                            <li>Information about your contract with this apartment/house</li>
                            <li>Do not add simbols or spaces in "Landlord Phone", add only numbers</li>
                            <li>"Monthly Payment" field is the amount <strong>YOU</strong> are paying to the owner</li>
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
                        <input type="date" id="start" name="contrcStart" value="YYY-MM-DD" min="2008-01-01" max="2030-07-22" required="required">
                    </div>
                    <div class="required">
                        <label for="end ">End Contract: </label>
                        <input type="date" id="end" name="contrcEnd" value="MM/DD/YYYY" min="2010-01-01" max="2040-07-22" required="required">
                    </div>
                    <div class="required">
                        <label for="pay">Monthly Payment: $</label>
                        <input type="number" placeholder="0.00" name="pay" id="pay" min="1" step="0.01" required="required">
                    </div>
                </section>
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Apartament information</p>
                        <ul>
                            <li>Do not add <i>"st, str., street"</i> at the end of the field "Street Name", enter only the street name</li>
                            <li>"Monthly Tenant Rent" field is the amount your tenant has to pay in case they want to rent the full apartment</li>
                        </ul>
                    </div>
                    <div class="required">
                        <label for="unitNum">Unit Number: </label>
                        <input type="text" placeholder="906" name = "unitNum" id="unitNum" required="required">
                    </div>
                    <div class="required">
                        <label for="streetNum">Street Number: </label>
                        <input type="text" placeholder="1865" name="streetNum" id="streetNum" required="required">
                    </div>
                    <div class="required">
                        <label for="streetName">Street Name: </label>
                        <input type="text" maxlength="20" placeholder="Beatty" name="streetName" id="streetName" required="required">
                    </div>
                    <div class="required">
                        <label for="rent">Monthly Tenant Rent: $</label>
                        <input type="number" placeholder="0.00" name="rent" id="rent" min="1" step="0.01" required="required">
                    </div>
                    <div class="required">
                        <label for="postCode1">Postal Code: </label>
                        <input size="5" type="text" maxlength="3" pattern="[A-Za-z][0-9][A-Za-z]" placeholder="V6Z" name="postCode1" id="postCode1" required="required">
                
                        <label for="postCode2">-</label>
                        <input size="5" type="text" maxlength="3" pattern="[0-9][A-Za-z][0-9]" placeholder="3C1" name="postCode2" id="postCode2" required="required">
                    </div>
                </section>
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Extra Details</p>
                        <ul>
                            <li>You can upload up to 5 images simultaniously on "Select Apartament Images" field (files extensions must be .jpg or .png)</li>
                            <li>The long description will appear on the "Full Rent Appartment" description, it will be public</li>
                            <li>The short description will appear on the "Main Page", it will be public</li>
                            <li>Comments field is not required and is private, only you can see this information, you can add comments or additional notes in this field</li>
                        </ul>
                    </div>
                    <div class="long required">
                        <label for="aptoImages">Select Apartament Images</label>
                        <input type="file" id="aptoImages" name="aptoImages[]" multiple accept="image/png, image/jpeg" required="required">
                    </div>
                    <div class="long required">
                        <label for="shortDesc">Short Description: </label>
                        <textarea id="shortDesc" minlength="5" maxlength="100" rows="2" name="shortDesc" required="required"></textarea>
                    </div>
                    <div class="long required">
                        <label for="longDesc">Long Description: </label>
                        <textarea id="longDesc" minlength="5" maxlength="1000" rows="10" name="longDesc" required="required"></textarea>
                    </div>
                    <div class="long">
                        <label for="comments">Comments: </label>
                        <textarea id="comments" minlength="5" maxlength="200" rows="10" name="comments"></textarea>
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
                        <button type="submit" name="saveApto" >Save</button>
                    </div>
                </section>
        </form>
    </div>
</div>
<script src="scripts/checkMinDate.addSection.js"></script>
<?php
    if(isset($_GET["successfull"])){
        echo '<script src="scripts/addApto.js"></script>';
    }
        
?>
<?php
    require "footer.php";
?>