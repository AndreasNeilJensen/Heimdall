<?php
    require "header.php"
?>

<main>
    <div>
        <section class="centersection">
            <h1>Sign up</h1><br>
            <form action="invisible/signup.invisible.php" method="POST">
                <input type="text" name="username" placeholder="Username"><br>
                <input type="text" name="email" placeholder="Email"><br>
                <input type="password" name="password" placeholder="Password"><br>
                <input type="password" name="passwordConfirmer" placeholder="Repeat password"><br>
                <input type="submit" name="signup" value="Sign up!">
            </form>
        </section>
    </div>
</main>

<?php
    require "footer.php"
?>