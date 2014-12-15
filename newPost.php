<?php 
    $title = 'new post';
    $style = 'styles.css';

    require_once 'config/config.php';

    include './phpScripts/header.php';
    require_once './lib/database.php';
 ?>

 <? include './phpScripts/navigation.php'; ?>

<?php
    include './phpScripts/connection.php';
    session_start();
    $_SESSION['is_logged'] = true;
    if ($_SESSION['is_logged'] === false) {
        die('You must be logged in in order to create a new post.');
    }
?>
        <div id="right">
            <section>
                <header><h3>New post:</h3></header>
                <form action="" method="post">
                    <label>Heading</label>
                    <input type="text" name="heading" />
                    <label>Content</label>
                    <textarea rows="10" cols="30" name="content"></textarea>
                    <label>Category</label>
                    <select name="category">
                         <?php
                                $query = mysqli_query($connection, 'SELECT * FROM categories');

                                if (!$query) {
                                    die('Error in database.');
                                } else {
                                    while ($row = $query->fetch_assoc()) {
                                        echo '<option value="'.$row['Type'].'">'.$row['Type'].'</option>';
                                    }
                                }
                            ?>
                    </select>
                    <input type="submit" value="Add">
                </form>
            </section>
        </div>
    </body>
</html>