<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>  
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href=""/>
    </head>
    <body>
        <?php
        include "config.php";
        $conn = openCon();
        $counter = 0;
        $imagePath = "https://image.tmdb.org/t/p/w92";

        $favoriteSql = "SELECT id, poster_path FROM movie";
        $displayFavorite = $conn->query($favoriteSql);

        foreach ($_GET["movie_id"] as $id)
        {
            $_SESSION['favorites'][$id] = array();
        }

        if(array_key_exists('removeAll', $_POST))
        {
            removeAll();
        }
        if(array_key_exists('removeOne', $_POST))
        {
            removeOne();
        }
        function removeOne($id)
        {
            unset($_SESSION['favorites'][$id]);

            echo "Movie removed. Please refresh the page to see changes.";
        }

        function removeAll()
        {
            unset($_SESSION['favorites']);
            $_SESSION['favorites'] = array();

            echo "Movies removed. Please refresh the page to see changes.";
        }
        ?>
        <div>
            <?php
            if (isset($_SESSION['favorites']) && !empty($_SESSION['favorites']))
            {
                while (count($_SESSION['favorites']) > $counter)
                {
                    while ($row = $displayFavorite->fetch_assoc())
                    {
                        if (array_key_exists($row["id"], $_SESSION['favorites']))
                        {
                            $image = "\"". $imagePath. $row["poster_path"] ."\"";
                            $poster = "<img src=". $image ."/>";
                            echo "<a href=\"single-movie.php?id=". $row["id"] ."\">". $poster ."</a>";

                            echo "<form method=\"post\">";
                            echo "<input type=\"submit\" name=\"removeOne\" value=\"Remove this movie\"/>";
                            echo "</form>";
                            $counter++;
                        }
                    }
                }
                echo "<form method=\"post\">";
                echo "<input type=\"submit\" name=\"removeAll\" value=\"Remove all movies\"/>";
                echo "</form>";
            }
            else
            {
                echo "<div> Looks like you don't have any movies favorited yet. </div>";
            }
            ?>
        </div>
        <?php
        closeCon($conn);
        ?>
    </body>
</html>
