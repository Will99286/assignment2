<?php

require_once('browseConfig.inc.php'); 
require_once('lab14-db-functions.inc.php'); 

$result = null;

if (isset($_GET['title']) && $_GET['title'] != ""){
    $sql = makeSQL("title", $_GET['title']);
    fillResults($sql);

} else if (isset($_GET['yearRate']) && $_GET['yearRate'] != ""){
    $filterOption = $_GET['yearRate'];
    $value = $_GET[$filterOption];
    $sql = makeSQL($filterOption, $value);
    fillResults($sql);
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

function fillResults($sql) {
    $connection=setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    $result = runQuery($connection, $sql, null);
}

function populateContents (){
    while ($row = $result->fetch()) {
        populateMovie($row);
        foreach ($row['production_companies'] as $c){
            populateCompanies($c);
        }
        foreach($row['production_countries'] as $country){
            populateCountries($country);
        }
        foreach($row['keywords'] as $k){
            populateKeywords($k);
        }
        foreach($row['genre'] as $g){
            populateGenres($g);
        }

    }
}

function populateMovie($row){
    echo '<div class="left">';
        echo '<div id="movieTitle">';
            echo '<h2>Movie Title</h2>';
            echo '<p>' . $row['title'] . '</p>';
        echo '</div>';
        echo '<hr>';
        echo '<div id = "movieInfo">';
            echo '<label>Release date:</label>';
            echo '<span id="release_date">' . $row['release_date'] . '</span></br>';
            echo '<label>Revenue:</label>';
            echo '<span id="revenue">' . $row['revenue'] . '</span></br>';

            echo '<label>Runtime:</label>';
            echo '<span id="runtime">' . $row['runtime'] . '</span></br>';

            echo '<label>Tagline:</label>';
            echo '<span id="tagline">'. $row['tagline'] .'</span></br>';
            echo'<hr>';
            echo'<label>IMDB:</label>';
            echo'<span class="link"><a href="imdb.com/title/'. $row['imdb_id'] .'" id="imdb_id"></a></span></br>';
            echo '<label>TMDB:</label>';
            echo'<span class="link"><a href="themoviedb.org/movie/' . $row['tmdb_id'] . '" id="tmdb_id"></a></span></br>';
            echo '<hr>';
            echo '<label>Overview:</label><br>';
            echo'<span id="overview">' . $row['overview'] . '</span></br>';
            echo'<br>';
            echo'<label id="ratings">Ratings</label><br>';
            echo'<label >Popularity:' . $row['popularity'] . '</label><span id="popularity"></span> <br>';
        echo '</div>';
        echo '<hr>';
}

    function populateCompanies ($row){
        echo'<div id="companies">';
        echo '<h3>Companies</h3>';
        echo '<p id="companyName">' .$row. '</p>';
        echo '</div>';
    }

    function populateCountries ($row){
        echo '<div id="countries">';
        echo '<h3>Countries</h3>';
        echo '<p id="countryName">' . $row . '</p>';
        echo '</div>';
    }

    function populateKeywords ($row){
        echo '<div id="keywords">';
        echo '<h3>Keywords</h3>';
        echo '<p id="keyword">' . $row . '</p>';
        echo '</div>';
    }
        
    function populateGenres ($row) {
        echo '<div id="genres">';
        echo '<h3>Genres</h3>';
        echo '<p id="genre">' . $row . '</p>';
        echo '</div>';

    echo '</div>';
    }

     
        
        


?>
<html>
<head>
</head>
<body>
<div class="content">
<?php populateContents();?>
            </div>
</body>
    </html>