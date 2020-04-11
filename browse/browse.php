<?php

require_once('browseConfig.inc.php'); 
require_once('lab14-db-functions.inc.php'); 

$result = null;

if (isset($_GET['title']) && $_GET['title'] != ""){
    $sql = makeSQL("title", $_GET['title']);
    $result = search($sql);

} else if (isset($_GET['yearRate']) && $_GET['yearRate'] != ""){
    $filterOption = $_GET['yearRate'];
    $value = $_GET[$filterOption];
    $sql = makeSQL($filterOption, $value);
    $result = search($sql);
} 

function makeSQL ($option, $value) {
    if ($option == "title"){
        return "select id from movie where title = '$value'";
    } else if ($option == 'yearBefore'){
        return "select id from movie where release_date < '$value'";
    } else if ($option == 'yearAfter'){
        return "select id from movie where release_date > '$value'";
    } else if ($option == "rateBelow"){
        return "select id from movie where popularity < '$value'";
    } else if ($option == "rateAbove"){
        return "select id from movie where popularity > '$value'";

    }
}

function getTitle ($value){
    $sql = "select title from movie where id = '$value'";
    return $result = search($sql);
}

function getReleaseDate ($value){
    $sql = "select release_date from movie where id = '$value'";
    return $result = search($sql);
}

function getRevenue ($value){
    $sql = "select revenue from movie where id = '$value'";
    return $result = search($sql);
}

function getRuntime ($value){
    $sql = "select runtime from movie where id = '$value'";
    return $result = search($sql);
}

function getTagline ($value){
    $sql = "select tagline from movie where id = '$value'";
    return $result = search($sql);
}

function getIMDB ($value){
    $sql = "select imdb_id from movie where id = '$value'";
    return $result = search($sql);
}

function getTMDB ($value){
    $sql = "select tmdb_id from movie where id = '$value'";
    return $result = search($sql);
}

function getOverview ($value){
    $sql = "select overview from movie where id = '$value'";
    return $result = search($sql);
}

function getPopularity ($value){
    $sql = "select popularity from movie where id = '$value'";
    return $result = search($sql);
}

function getCompanies ($value){
    $sql = "select production_companies from movie where id = '$value'";
    return $result = search($sql);
}

function getCountries ($value){
    $sql = "select title from movie where id = '$value'";
    return $result = search($sql);
}

function getKeywords ($value){
    $sql = "select keywords from movie where id = '$value'";
    return $result = search($sql);
}

function getGenres ($value){
    $sql = "select genres from movie where id = '$value'";
    return $result = search($sql);
}

function getCast ($value){
    $sql = "select cast from movie where id = '$value'";
    return $result = search($sql);
}

function getCrew ($value){
    $sql = "select crew from movie where id = '$value'";
    return $result = search($sql);
}


function search($sql){
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $pdo->query($sql);
        return $result;
    } catch (PDOException $e) {
        die( $e->getMessage() );
        }
    }
?>
<html>
<head>
    <script>
        const movies = <?php $result?>;
        function stepOne(movies){
            if (typeof(movies) == 'number'){
                    let movie = getFields(movies)
                    populateMovie(movie);
                } else {
                    foreach(movies as m){
                        let movie = getFields(m)
                        populateMovie(movie);
                    }
                }
            }

        }

        function populateMovie(movie){
            echo '<div class="left">';
                echo '<div id="movieTitle">';
                    echo '<h2>Movie Title</h2>';
                    echo '<p>' . movie[0] . '</p>';
                echo '</div>';
                echo '<hr>';
                echo '<div id = "movieInfo">';
                    echo '<label>Release date:</label>';
                    echo '<span id="release_date">' . movie[1] . '</span></br>';
                    echo '<label>Revenue:</label>';
                    echo '<span id="revenue">' . movie[2] . '</span></br>';

                    echo '<label>Runtime:</label>';
                    echo '<span id="runtime">' . movie [3] . '</span></br>';

                    echo '<label>Tagline:</label>';
                    echo '<span id="tagline">'.movie[4].'</span></br>';
                    echo'<hr>';
                    echo'<label>IMDB:</label>';
                    echo'<span class="link"><a href="'.movie[5].'" id="imdb_id"></a></span></br>';
                    echo '<label>TMDB:</label>';
                    echo'<span class="link"><a href="' . movie[6] . '" id="tmdb_id"></a></span></br>';
                    echo '<hr>';
                    echo '<label>Overview:</label><br>';
                    echo'<span id="overview">' . movie[7] . '</span></br>';
                    echo'<br>';
                    echo'<label id="ratings">Ratings</label><br>';
                    echo'<label >Popularity:' . movie[8] . '</label><span id="popularity"></span> <br>';
                echo '</div>';
                echo '<hr>';
                echo'<div id="companies">';
                    echo '<h3>Companies</h3>';
                    echo '<p id="companyName">' . movie[9] . '</p>';
                echo '</div>';

                echo '<div id="countries">';
                    echo '<h3>Countries</h3>';
                    echo '<p id="countryName">' . movie[10] . '</p>';
                echo '</div>';
                echo '<div id="keywords">';
                    echo '<h3>Keywords</h3>';
                    echo '<p id="keyword">' movie[11] . '</p>';
                echo '</div>';
                echo '<div id="genres">';
                    echo '<h3>Genres</h3>';
                    echo '<p id="genre">' . movie[12] . '</p>';
                echo '</div>';

            echo '</div>';
        }

        function getFields (title){
            let movie = [];
            movie.push(<?php echo json_encode(getTitle(title));?>);
            movie.push(<?php echo json_encode(getReleaseDate(title));?>);
            movie.push(<?php echo json_encode(getRevenue(title));?>);
            movie.push(<?php echo json_encode(getRuntime(title));?>);
            movie.push(<?php echo json_encode(getTagline(title));?>);
            movie.push(<?php echo json_encode(getIMDB(title));?>);
            movie.push(<?php echo json_encode(getTMDB(title));?>);
            movie.push(<?php echo json_encode(getOverview(title));?>);
            movie.push(<?php echo json_encode(getPopularity(title));?>);
            movie.push(<?php echo json_encode(getCompanies(title));?>);
            movie.push(<?php echo json_encode(getCountries(title));?>);
            movie.push(<?php echo json_encode(getKeywords(title));?>);
            movie.push(<?php echo json_encode(getGenres(title));?>);
            movie.push(<?php echo json_encode(getCast(title));?>);
            movie.push(<?php echo json_encode(getCrew(title));?>);
            return movie;
        }
        </script>
</head>
<body>
<div class="content">
           <script type="text/javescript">
           stepOne();
           </script>
            </div>
</body>
    </html>