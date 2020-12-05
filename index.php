<?php 
    include 'inc/header.php'; 
    Session::CheckLogin();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])){
        $searchLog = $chat->Search($_POST);
    }
?>
<link rel="stylesheet" href="./assets/style/index.css">
<div class="outer">
    <div class="card">
        <!--<div class="grid-item item5 hide"></div>!-->
        <div class="grid-item item4">
            <div class="search show">
                <form action="" method="post" class="">
                    <div class="bar">
                        <input type="text" name="input" placeholder="Cerca un utente...">
                        <button type="submit" name="search">Cerca</button>
                    </div>
                </form>
                <div class="results" id="results">
                    <?php     
                        if(isset($searchLog)){
                            echo json_encode($searchLog);
                        }
                    ?>
                </div>
            </div>
        </div>
        <!--<div class="grid-item item3"></div> 
        <div class="grid-item item6"></div>!-->
    </div>
</div>
<?php include 'inc/footer.php'; ?>