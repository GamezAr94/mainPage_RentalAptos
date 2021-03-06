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
            <p>Room added succesfully!</p>
        </div>
    </div>
</div>
<div class="add">
    <div class="title">
        <p>Add Tenant</p>
    </div>
    <div class="addContainer">
            <form action="#">
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Contract Information</p>
                        <ul>
                            <li>Information about the tenant's contract </li>
                        </ul>
                    </div>
                    <div class="long">
                        <p class="required"> Please select the type of contract:</p>
                        <input type="radio" id="rentApto" name="rentType" value="apto_true" required = "required">
                        <label for="rentApto">Renting an Apartment</label><br>
                        <input type="radio" id="rentRoom" name="rentType" value="apto_false" required = "required">
                        <label for="rentRoom">Renting a Room</label><br>
                    </div>
                    <div class="required hideSelection">
                        <label for="aptos">Select an apartaments:</label>
                        <select name="aptos" id="aptos" required="required">
                            <?php

                                $sql = "SELECT `apts_uniNum`, `apts_strtNum`, `apts_strtName`, `apts_id` 
                                FROM `apartaments` 
                                LEFT JOIN aptocontract
                                ON aptocontract.apts_fk = apartaments.apts_id
                                WHERE aptocontract.ac_endD > CURDATE();";

                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $GLOBALS['idApto'] = $row["apts_id"];
                                        echo '<option value='.$row["apts_id"].'>'.$row["apts_uniNum"].'-'.$row["apts_strtNum"].' '.$row["apts_strtName"].'</option>';
                                    }
                                }else{
                                    echo '<option value="0" disabled>Your list of Apartaments is empty</option>';
                                }

                            ?>
                        </select>
                    </div>
                    <div class="required" id="roomSelect">
                        <label for="room">Select a Room:</label>
                        <select name="room" id="room" required="required">
                        </select>
                    </div>
                    <div id="infoAptoDisp" class="long">
                    </div>
                    <div class="required hideSelection">
                        <label for="start">Start Contract:</label>
                        <!--++++++++++++++current date++++++++++++++++++++++++++-->
                        <input type="date" id="start" name="contrc-start" value="YYY-MM-DD" min="2008-01-01" max="2030-07-22" required="required">
                    </div>
                    <div class="required hideSelection">
                        <label for="end ">End Contract: </label>
                        <input type="date" id="end" name="contrc-end" value="MM/DD/YYYY" min="2010-01-01" max="2040-07-22" required="required">
                    </div>
                    <div class="required hideSelection">
                        <label for="rent">Rent: $</label>
                        <input type="number" placeholder="0.00" id="rent" min="1" step="0.01" required="required">
                    </div>
                    <div class="required hideSelection">
                        <label for="damageDeposit">Damage Deposit: $</label>
                        <input type="number" placeholder="0.00" id="damageDeposit" min="1" step="0.01" required="required">
                    </div>
                </section>
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Tenant Information</p>
                        <ul>
                            <li>Information about the tenant</li>
                            <li>Do not add simbols or spaces in "Tenant Phone", add only numbers</li>
                            <li>The password should be exactly the same as in the "repeat password" field</li>
                            <li>Tenant ID only accepts one file .jpg or .png format and it is not required</li>
                        </ul>
                    </div>
                    <div class="long">
                        <label for="tenantId">Select ID image</label>
                        <input type="file" id="tenantId" name="tenantId" accept="image/png, image/jpeg">
                    </div>
                    <div class="required">
                        <label for="tenantFName">Tenant First Name: </label>
                        <input type="text" id="tenantFName" name="tenantFName" placeholder="First Name" required="required">
                    </div>
                    <div class="required">
                        <label for="tenantLName">Tenant Last Name: </label>
                        <input type="text" id="tenantLName" name="tenantLName" placeholder="Last Name" required="required">
                    </div>
                    <div class="required">
                        <label for="tenantEmail">Tenant Email: </label>
                        <input type="email" id="tenantEmail" name="tenantEmail" placeholder="email@gmail.com" required="required">
                    </div>
                    <div>
                        <label for="tenantPhone">Tenant Phone: </label>
                        <input type="text" id="tenantPhone" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" name="tenantPhone" placeholder="2342342342">
                    </div>
                    <div class="required">
                        <label for="tenantPass">Tenant Password: </label>
                        <input type="password" id="tenantPass" name="tenantPass" placeholder="Password" required="required">
                    </div>
                    <div class="required">
                        <label for="tenantPassRep">Repeat Password: </label>
                        <input type="password" id="tenantPassRep" name="tenantPassRep" placeholder="Repeat Password" required="required">
                    </div>
                </section>
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Billing Information</p>
                        <ul>
                            <li>Skip this section in case you dont have the billing information of the tenant at this moment</li>
                            <li>This information is visible into each tenant account</li>
                            <li>This informations is not required at the moment but you should update this section every month if the tenant's bill info changes</li>
                            <li>They will see their total amount to pay every month </li>
                            <li>"Other Charges" field is used to add aditional charges that the tenant can generate such as penalties</li>
                        </ul>
                    </div>
                    <div>
                        <label for="bchydroBill">BCHydro: $</label>
                        <input type="number" placeholder="0.00" id="bchydroBill" min="1" step="0.01">
                    </div>
                    <div>
                        <label for="internetBill">Internet: $</label>
                        <input type="number" placeholder="0.00" id="internetBill" min="1" step="0.01">
                    </div>
                    <div>
                        <label for="gas">Gas: $</label>
                        <input type="number" placeholder="0.00" id="gas" min="1" step="0.01">
                    </div>
                    <div>
                        <label for="otherChargesBill">Other Charges: $</label>
                        <input type="number" placeholder="0.00" id="otherChargesBill" min="1" step="0.01">
                    </div>
                    <div>
                        <label for="otherCharDesc">Short Description Other Charges: </label>
                        <input type="text" id="otherCharDesc" minlength="5" maxlength="50" name="otherCharDesc" placeholder="Short Description">
                    </div>
                </section>
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Please, before to submit revise if the information provided is correct</p>
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                    <div>
                        <button type="submit" name="save-tenant">Save</button>
                    </div>
                </section>
            </form>
    </div>
</div>
<script src="scripts/checkMinDate.addSection.js"></script>
<script src="scripts/roomOrApto.addTenant.js"></script>
<script src="scripts/refreshingRooms.addTenant.js"></script>
<?php
    if(isset($_GET["successfull"])){
        echo '<script src="scripts/addApto.js"></script>';
    }
    require "footer.php";
?>