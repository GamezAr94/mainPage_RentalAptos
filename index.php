<?php
    require "header.php";
?>


    <div id="banner">
        <div class="img"></div>
    </div>
    <div id="options">
        <form id="form">
            <h2>Availability: </h2>
            <fieldset>
                <div>
                    <label><input type="radio" id="now" name="searchAvaila" value="thisMonth" checked onclick="advancedChecked()">
                        This month</label>
                    <label><input type="radio" id="allAptos" name="searchAvaila" value="allAptos" onclick="advancedChecked()">
                        All apartments</label>
                    <label><input type="radio" id="nextMonth" name="searchAvaila" value="nextMonth" onclick="advancedChecked()">
                        Other month <i>(advanced search)</i></label>
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
    <div id="bodyContent">

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>
        

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>

        <a href="#" class="apto-card">
            <div class="aptos">
                <div class="img">
                    <div class="price">$2500</div>
                </div>
                <div class="info">
                    <p class="comments">(1875 Robson st.)</p>
                    <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                    <p class="date">Jun 11</p>
                    <p class="amount">$2500</p>
                </div>
            </div>
        </a>



    </div>


<?php
    require "footer.php";
?>