<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>  
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="userPage.css" />
    </head>
    <body>
        <?php
        include "db_connection.php";
        $conn = openCon();

        $imagePath = "https://image.tmdb.org/t/p/w92";

        $userSql = "SELECT id, firstname, lastname, city, country FROM users WHERE id='". $_SESSION["userid"] ."'";
        $userResult = $conn->query($userSql);
        $userInfo = $userResult->fetch_assoc();

        $movieSql = "SELECT release_date, popularity, poster_path FROM movie";
        $movieResult = $conn->query($movieSql);
        $movieInfo = $movieResult->fetch_assoc();
        ?>
        <div id="info">
            <?php
            echo "Name: ". $userInfo["firstname"] . " " . $userInfo["lastname"]. "<br>";
            echo "City: ". $userInfo["city"] . "<br>";
            echo "Country: ". $userInfo["country"];
            ?>
        </div>
        <div id="favorites">
            <?php
            $favoritesArray = array();/*loads movie ID based on stored session data from favorites*/
            $total = count($favoritesArray);
            $counter = 0;

            while($total > $counter)
            {
                $favSql = "SELECT id, poster_path FROM movie WHERE id ='". $favoritesArray[$counter] ."'";
                $displayFav = $conn->query($favSql);
                $favData = $displayFav->fetch_assoc();

                $image = "\"". $imagePath. $favData["poster_path"] ."\"";
                $poster = "<img src=". $image ."/>";
                echo "<a href=\"single-movie.php?id=". $favData["id"] ."\">". $poster ."</a>";
            }
            ?>
        </div>
        <div id="possibleLikes">
            <?php
            $ratingArray = array("6.0");
            $yearArray = array("2004-08-06");

            while($row = $movieResult->fetch_assoc())
            {
                array_push($ratingArray, $row["popularity"]);
                array_push($yearArray, $row["release_date"]);
            }

            sort($ratingArray);
            $highestRatingLocation = count($ratingArray) - 1;
            sort($yearArray);
            $highestYearLocation = count($yearArray) - 1;

            $totalMovies = 0;
            while($totalMovies != 15)
            {
                $movieDisplay = "SELECT id, poster_path FROM movie WHERE popularity ='". $ratingArray[$highestRatingLocation] ."'";
                $displayResult = $conn->query($movieDisplay);
                $movie = $displayResult->fetch_assoc();

                $yearDisplay = "SELECT id, poster_path FROM movie WHERE release_date ='". $yearArray[$highestYearLocation] ."'";
                $displayResultYear = $conn->query($yearDisplay);
                $year = $displayResultYear->fetch_assoc();

                if (count($favoritesArray) != 0)
                {
                    while(count($favoritesArray) > $totalMovies)
                    {
                        $favoriteDisplay = "SELECT id, poster_path, release_date FROM movie WHERE id ='". $favoritesArray[$totalMovies] ."'";
                        $displayResultFavorites = $conn->query($favoritesDisplay);

                        while($row = $displayResultFavorites->fetch_assoc())
                        {
                            $image = "\"". $imagePath. $row["poster_path"] ."\"";
                            $poster = "<img src=". $image ."/>";
                            echo "<a href=\"single-movie.php?id=". $row["id"] ."\">". $poster ."</a>";
                            $totalMovies++;
                        }
                    }
                }

                if($totalMovies != 15)
                {
                    if (count($favoritesArray) != 0)
                    {
                        while ($row = $displayResultFavorites->fetch_assoc())
                        {
                            $favYearDisplay = "SELECT id, poster_path FROM movie WHERE release_date='". $row["release_date"] ."'";
                            $favYearResult = $conn->query($favYearDisplay);
                            
                            while ($year = $favYearResult->fetch_assoc())
                            {
                                $image = "\"". $imagePath. $year["poster_path"] ."\"";
                                $poster = "<img src=". $image ."/>";
                                echo "<a href=\"single-movie.php?id=". $year["id"] ."\">". $poster ."</a>";

                                $totalMovies++;
                            }
                        }
                    }
                    else
                    {
                        $image = "\"". $imagePath. $movie["poster_path"] ."\"";
                        $poster = "<img src=". $image ."/>";
                        echo "<a href=\"single-movie.php?id=". $movie["id"] ."\">". $poster ."</a>";

                        $totalMovies++;
                        $highestRatingLocation--;
                    }
                }
                elseif ($totalMovies > 15)
                {
                    break;
                }
            }

            closeCon($conn);
            ?>
        </div>
    </body>
</html>