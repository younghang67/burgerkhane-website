<!DOCTYPE html>
<?php

include('<config/DB_connect.php');

if (isset($_POST['delete'])) {

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM burgers2 WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('location: BurgerKhane.php');
    } {
        echo 'query error' . mysqli_error($conn);
    }
}

//check get request id parameter
if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    //make sql
    $sql = "SELECT * FROM burgers2 WHERE id = $id";
    // get the query result
    $result = mysqli_query($conn, $sql);
    //fetch result in array format
    $burger = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}


?>
<html>
<link rel="stylesheet" href="burger.css">
<?php include('phpForBurger/header.php'); ?>
<div class="detialContainer">
    <div class="container center det">
        <?php if ($burger) : ?>
            <h4><?php echo htmlspecialchars($burger['title']); ?></h4>
            <p><b>Created by</b> : <?php echo htmlspecialchars($burger['Fullname']); ?></p>
            <p><b>Created at</b> : <?php echo date($burger['created_at']); ?></p>
            <h5>Ingredients</h5>
            <p><?php echo htmlspecialchars($burger['ingredients']); ?> </p>
            <!-- delete form -->
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $burger['id'] ?>">
                <input type="submit" name="delete" value="delete" class="btn brand z-depth-0">
            </form>
        <?php else : ?>
            <P class="detEl"> The burger does not exist !</P>
        <?php endif ?>
    </div>
</div>
<?php include('phpForBurger/footer.php'); ?>

</html>