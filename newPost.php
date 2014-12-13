<html>
    <head>
        <title>Create a new post</title>
    </head>
    <body>
    <?php
    include './phpScripts/connection.php';
    session_start();
    $_SESSION['is_logged'] = true;
    if ($_SESSION['is_logged'] === false) {
        die('You must be logged in in order to create a new post.');
    }
    ?>
        <form action="" method="post">
            <span>Heading:</span>
            <input type="text" name="heading" />
            <div>Content: <textarea rows="10" cols="30" name="content"></textarea></div>
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
            <input type="submit"/>
        </form>

    <?php
    include './phpScripts/createPost.php'
    ?>
    </body>
</html>