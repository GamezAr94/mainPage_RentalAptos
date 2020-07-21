<footer>
<!-- this is the footer for the ret of the subpages-->
        <div id="conteiner">
            <div class="logo">
                <h2>GZ</h2>
                <p>Vancouver, BC, Canada</p>
                <p>July 6, 2020</p>
                <p>copyright&copy;</p>
            </div>
            <div>
                <?php

                    if(isset($_SESSION['userId']) || isset($_SESSION['memberId'])){
                        //ingresar datos que quiero que se muesten en vez de la forma de contacto 
                    }else{
                        echo '<p>Contact us</p>
                            <form action="#" method="post">
                                <input type="text" name="name" placeholder="Name...">
                                <input type="text" name="email" placeholder="Emal...">
                                <input type="text" name="subject" placeholder="Subject...">
                                <textarea name="message" placeholder="Message..."></textarea>
                                <button type="submit" name="send-message">Send</button>
                            </form>';
                    }

                ?>
                
            </div>
            <div class="items">
                <p class="extInfo">Social:</p>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fas fa-envelope"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </footer>

    <script src="scripts/printingBtn.js"></script>
    <script src="scripts/menu_btn.js"></script>
    <script src="scripts/searchTool.js"></script>
    <script src="scripts/carousel_img.js"></script>
    <script src="scripts/sentRequestButton.js"></script>
</body>

</html>