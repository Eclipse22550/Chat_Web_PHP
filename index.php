<?php 
    include 'inc/header.php'; 
    Session::CheckLogin();
    //File della pagina principale al 25.11.2020
?>
    <link rel="stylesheet" href="./assets/style/index.css">
    <div class="outer">
        <div class="card">
            <div class="grid-item item5"><?php echo Session::get("email"); ?></div>
            <div class="grid-item item4"></div>
            <div class="grid-item item3"></div> 
            <div class="grid-item item6"></div>  
        </div>
    </div>
<?php include 'inc/footer.php'; ?>