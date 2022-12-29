<!DOCTYPE html>

<?php
//MySQLi or PDO. PDO is upper level connecting method using objects 

include('config/DB_connect.php');

//write query for all pizza (query is a request or an action for database).
$sql = 'SELECT FullName, title, ingredients, id FROM burgers2 ORDER BY created_at';

// make query and get result no.2
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$burgers = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory or lets delete no.2
mysqli_free_result($result);

//closing connection no.1
mysqli_close($conn);
?>
<html>

<?php include('phpForBurger/header.php');
?>

<h4 class="center grey-text"> Burgers </h4>

<div class="container">
    <div class="row">
        <?php foreach ($burgers as $burger) : ?>
            <div class="col s6 md6">
                <div class="card z-depth-0">
                    <img src="img/burger.png" class="burgerL">
                    <div class="card-content center">
                        <h6> <?php echo htmlspecialchars($burger['title']) ?></h6>
                        <ul> Ingredient :
                            <?php foreach (explode(',', $burger['ingredients']) as $ing) { ?>
                                <li><?php echo htmlspecialchars($ing) ?></li>
                            <?php } ?>
                        </ul>
                        <div class="for-name right-align">For :
                            <?php echo htmlspecialchars($burger['FullName']) ?></div>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details.php?id=<?php echo $burger['id']; ?>"> More Info </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('phpForBurger/footer.php');
?>



</html>