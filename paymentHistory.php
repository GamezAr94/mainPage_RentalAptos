<?php
    require "header.php";
    include 'includes/userContent.inc.php';
?>
    <div class="contentHistory">
        <div class="title">
            <h5>History Payments</h5>
        </div>


        <div class="pagos">
            <div class="addressInfo">
                <p>Arturo Gamez Ortega.</p>
                <p>906-1875 Robson st., V6Z3C1, Vancouver BC, Canada</p>
            </div>
            <div class="placeRent">
                <div class="generalInfo">
                    <div>
                        <p><strong>Rent type:</strong> Room</p>
                        <p><strong>Address:</strong> 906-1875 Robson st., V6Z3C1, Vancouver BC, Canada</p>
                        <p><strong>Start contract:</strong> 1 Jan 2020</p>
                        <p><strong>End contract:</strong> 1 Jan 2021</p>
                    </div>
                </div>
                <div class="tableWrapper">
                    <table>
                        <tr class="headers">
                            <th>Type:</th>
                            <th>Date:</th>
                            <th>Amount:</th>
                            <th id="details">Details:</th>
                        </tr>
                        <tr>
                            <th>Rent</th>
                            <th>1 Jan 2020</th>
                            <th>$1500</th>
                            <th>-</th>
                        </tr>
                        <tr>
                            <th>Other</th>
                            <th>1 Jan 2020</th>
                            <th>$50</th>
                            <th>Penalty from the manager: noisy party</th>
                        </tr>
                        <tr>
                            <th>BCHydro</th>
                            <th>1 Jan 2020</th>
                            <th>$80</th>
                            <th>-</th>
                        </tr>
                        <tr>
                            <th>Shaw</th>
                            <th>1 Jan 2020</th>
                            <th>$90</th>
                            <th>-</th>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="button">
                <button onclick="printContent('placeRent')">Print Content</button>
            </div>
        </div>

        <div class="pagos">
            <div class="addressInfo">
                <p>Arturo Gamez Ortega.</p>
                <p>906-1875 Robson st., V6Z3C1, Vancouver BC, Canada</p>
            </div>
            <div class="placeRent">
                <div class="generalInfo">
                    <div>
                        <p><strong>Rent type:</strong> Room</p>
                        <p><strong>Address:</strong> 906-1875 Robson st., V6Z3C1, Vancouver BC, Canada</p>
                        <p><strong>Start contract:</strong> 1 Jan 2020</p>
                        <p><strong>End contract:</strong> 1 Jan 2021</p>
                    </div>
                </div>
                <div class="tableWrapper">
                    <table>
                        <tr class="headers">
                            <th>Type:</th>
                            <th>Date:</th>
                            <th>Amount:</th>
                            <th id="details">Details:</th>
                        </tr>
                        <tr>
                            <th>Rent</th>
                            <th>1 Jan 2020</th>
                            <th>$1500</th>
                            <th>-</th>
                        </tr>
                        <tr>
                            <th>Other</th>
                            <th>1 Jan 2020</th>
                            <th>$50</th>
                            <th>Penalty from the manager: noisy party</th>
                        </tr>
                        <tr>
                            <th>BCHydro</th>
                            <th>1 Jan 2020</th>
                            <th>$80</th>
                            <th>-</th>
                        </tr>
                        <tr>
                            <th>Shaw</th>
                            <th>1 Jan 2020</th>
                            <th>$90</th>
                            <th>-</th>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="button">
                <button onclick="printContent('placeRent')">Print Content</button>
            </div>
        </div>

    </div>
    <script>
        function printContent(el){
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementsByClassName(el)[0].innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>
<?php
    require "footer.php";
?>