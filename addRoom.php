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
        <p>Add a Room</p>
    </div>
    <div class="addContainer">
            <form action="#">
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Room Information</p>
                        <ul>
                            <li>You can upload up to 5 images simultaniously on "Select Room Images" field (files extensions must be .jpg or .png)</li>
                        </ul>
                    </div>
                    <div class="required">
                        <label for="aptos">Add a Room into:</label>
                        <select name="aptos" id="aptos" required="required">
                            <option value="id-apto">1875 Robson st.</option>
                            <option value="id-apto">939 Beatty st.</option>
                        </select>
                    </div>
                    <div class="long">
                        <p>This Apartament contains <strong>3</strong> room(s) at the moment.</p>
                    </div>
                    <div class="required">
                        <label for="roomTitle">Room Title: <i>(max 20 characters)</i></label>
                        <input type="text" minlength="1" maxlength="20" id="roomTitle" name="roomTitle" placeholder="Room Title" required="required">
                    </div>
                    <div class="required">
                        <label for="rent">Room Price: $</label>
                        <input type="number" placeholder="0.00" id="rent" min="1" step="0.01" required="required">
                    </div>
                    <div class="long required">
                        <label for="shortDesc">Short Description: </label>
                        <textarea id="shortDesc" minlength="5" maxlength="100" rows="2" name="shortDesc" required="required"></textarea>
                    </div>
                    <div class="long required">
                        <label for="longDesc">Room Long Description: </label>
                        <textarea id="longDesc" minlength="5" maxlength="1000"  rows="10" name="longDesc" required="required"></textarea>
                    </div>
                    <div class="long">
                        <label for="roomImg">Select Room images</label>
                        <input type="file" id="roomImg" multiple name="roomImg" accept="image/png, image/jpeg">
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
                        <button type="submit" name="save-room">Save</button>
                    </div>
                </section>
            </form>
    </div>
</div>
<?php
    require "footer.php";
?>