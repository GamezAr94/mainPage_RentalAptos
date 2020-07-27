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
        <p>Add a Tenant</p>
    </div>
    <div class="addContainer">
            
    </div>
</div>
<script>
    $(document).ready(function(){
        $(this).scrollTop(0);
    });
</script>
<?php
    require "footer.php";
?>