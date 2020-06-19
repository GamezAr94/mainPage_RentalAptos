<?php
function checkedLabel(){
    if(empty($_GET['searchAvailable'])){
        echo '<label><input type="radio" id="allAptos" name="searchAvailable" value="allAptos" checked onclick="advancedChecked()">
            All apartments</label>
        <label><input type="radio" id="now" name="searchAvailable" value="thisMonth" onclick="advancedChecked()">
            This month</label>
        <label><input type="radio" id="nextMonth" name="searchAvailable" value="advSearch" onclick="advancedChecked()">
            Other month <i>(advanced search)</i></label>';
    }else{
       $typeSearch = $_GET['searchAvailable'];
        if($typeSearch == 'allAptos'){
            echo '<label><input type="radio" id="allAptos" name="searchAvailable" value="allAptos" checked onclick="advancedChecked()">
            All apartments</label>
        <label><input type="radio" id="now" name="searchAvailable" value="thisMonth" onclick="advancedChecked()">
            This month</label>
        <label><input type="radio" id="nextMonth" name="searchAvailable" value="advSearch" onclick="advancedChecked()">
            Other month <i>(advanced search)</i></label>';
        }else if($typeSearch == 'thisMonth'){
            echo '<label><input type="radio" id="allAptos" name="searchAvailable" value="allAptos" onclick="advancedChecked()">
            All apartments</label>
        <label><input type="radio" id="now" name="searchAvailable" value="thisMonth" checked onclick="advancedChecked()">
            This month</label>
        <label><input type="radio" id="nextMonth" name="searchAvailable" value="advSearch" onclick="advancedChecked()">
            Other month <i>(advanced search)</i></label>';
        }else if($typeSearch == 'advSearch'){
            echo '<label><input type="radio" id="allAptos" name="searchAvailable" value="allAptos" onclick="advancedChecked()">
            All apartments</label>
        <label><input type="radio" id="now" name="searchAvailable" value="thisMonth" onclick="advancedChecked()">
            This month</label>
        <label><input type="radio" id="nextMonth" name="searchAvailable" value="advSearch" checked onclick="advancedChecked()">
            Other month <i>(advanced search)</i></label>';
        }
    }
    }
?>

    <div id="banner">
        <div class="img"></div>
    </div>
    <div id="options">
        <form id="form" action="search_results.php" method="GET">
            <h2>Availability: </h2>
            <fieldset>
                <div>
                    <?php
                        checkedLabel();
                    ?>
                </div>
            </fieldset>
            <fieldset id="advanced" class="default">
                <h3>Advanced Search: </h3>
                <div>
                    <label>Month: <input type="date" name="mes"></label>
                    <label>Price: <i>(All prices by default)</i><input type="text" name="price" placeholder="700"></label>
                </div>
            </fieldset> 
            <button type="submit" name="search-aptos">Search</button>
        </form>
    </div>