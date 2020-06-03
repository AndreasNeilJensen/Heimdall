<?php
    require "header.php";
?>

<main>
    <div>
        <section class="centersection">
            <?php
                if (isset($_SESSION['id'])){
                    echo '<h1>You are currently logged in!</h1>';
                }
                else {
                    echo '<h1>You are NOT logged in!</h1>';
                }
            ?>
        </section>
    </div>
</main>

<?php
    require "footer.php";
?>