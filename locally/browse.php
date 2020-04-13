

<?php
//https://www.geeksforgeeks.org/php-explode-function/


require_once('browseConfig.inc.php'); 
require_once('lab14-db-functions.inc.php'); 

function myFunction () {
if (isset($_GET['title']) && $_GET['title'] != ""){
    $movieID = search($_GET['title']);
    $sql = makeSQL($movieID);
    $result = fillResults($sql);
    populateContents($result);

} else if (isset($_GET['yearRate']) && $_GET['yearRate'] != ""){

    if ($_GET['yearRate'] == "yearInBetween"){
        $values = getYearsInBetweens($_GET['yearBetweenStart'], $_GET['yearBetweenEnd']);
        $movies=[];
        foreach($values as $v){
            $movies = searchByYear($movies, $v, "inBetween");
        }
        foreach($movies as $m){
            $sql = makeSQL($m);
            $result = fillResults($sql);
            populateContents($result);
        } 

    } else if ($_GET['yearRate'] == 'rateInBetween'){
        $values = getRatingInBetweens($_GET['ratingBetweenStart'], $_GET['ratingBetweenEnd']);
        $movies = [];
        foreach($values as $v){
            $movies = searchByPopularity($movies, $v, "inBetween");
        }
        foreach($movies as $m){
            $sql = makeSQL($m);
            $result = fillResults($sql);
            populateContents($result);
        }

    } else if ($_GET['yearRate'] == 'yearAfter'){
            $year = $_GET['yearAfter'];
            $movies = [];
            $movies = searchByYear($movies, $year, "after");
            foreach ($movies as $m){
                $sql = makeSQL($m);
                $result = fillResults($sql);
                populateContents($result);
            }

    } else if ($_GET['yearRate'] == 'yearBefore'){
        $year = $_GET['yearBefore'];
        $movies = []; 
        $movies = searchByYear($movies, $year, "before");
        foreach($movies as $m){
            $sql = makeSQL($m);
            $result = fillResults($sql);
            populateContents($result);
        }

} else if ($_GET['yearRate'] == 'rateAbove'){
        $year = $_GET['rateAbove'];
        $movies = [];
        $movies = searchByPopularity($movies, $year, "above");
        foreach($movies as $m){
            $sql = makeSQL($m);
            $result = fillResults($sql);
            populateContents($result);
        }
} else if ($_GET['yearRate'] == 'rateBelow'){
    $year = $_GET['rateBelow'];
    $movies = [];
    $movies = searchByPopularity($movies, $year, "below");
    foreach ($movies as $m){
        $sql = makeSQL($m);
        $result = fillResults($sql);
        populateContents($result);
    }
}
     
    
     }
}

function makeSQL ($value) {
        return "select * from movie where id = '$value'";
}

function searchByYear($result, $year, $option){
    $sql = "select * from movie";
    $movies = fillResults($sql);
    foreach($movies as $row){
        $movieYear = getYear($row['release_date']);
        $id = $row['id'];
        if ($option == "after"){
            if ($movieYear >= $year){
                array_push($result, $id);
            }
        } else if ($option == "before"){
            if ($movieYear <= $year){
                array_push($result, $id);
            }
        } else if ($option == "inBetween"){
            if ($movieYear == $year){
                array_push($result, $id);
       
        }
    }
}
    return $result;
}

function searchByPopularity($result, $popularity, $option){
    $sql = "select * from movie";
    $movies = fillResults($sql);
    foreach($movies as $row){
        $moviePopularity = round($row['popularity'], 2);
        $title = $row['title'];
        if ($option == "above"){
            if ($moviePopularity >= $popularity){
                array_push($result, $title);
            }
        } else if ($option == "below"){
            if ($moviePopularity >= $popularity){
                array_push($result, $title);
            }
        } else if ($option == "inBetween"){
            if ($moviePopularity == $popularity){
                array_push($result, $title);
       
        }
    }
}
    return $result;
}

function getYear ($date){
    $year = explode("-", $date);
    return $year[0];
}

function getYearsInBetweens ($before, $after){
    $result=[];
    for ($i = $before; $i < $after; $i++){
        array_push($result, $i);
    }
    return $result;
}

function getRatingInBetweens ($before, $after){
    $result=[];
    $beforeRounded = round($before, 2);
    $afterRounded = round($after, 2);
    for ($i = $beforeRounded; $i < $afterRounded; $i+0.1){
        $result.push($i);
    }
    return $result;
}

function search ($title){
    $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "select title, id from movie";
    $movieTitles = runQuery($connection, $sql, null);
    foreach($movieTitles as $m){
        if (strtolower($m['title']) == strtolower($title)){
            return $m['id'];
        } 
    }
    echo "Movie Not Found";
    echo "<br/>";
    echo "<button onClick='goBack()'>back</button>";
}

function fillResults($sql) {
    $connection=setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    $result = runQuery($connection, $sql, null);
    $returnArray = [];
        foreach ($result as $r){
            array_push($returnArray, $r);
    }
    return $returnArray;

}

function populateContents ($result){
    foreach ($result as $row) {
        populateMovie($row);
    }
}


function populateMovie($row){
    $rating = round($row['popularity'], 2);
    echo '<div class="left">';
        echo '<div id="movieTitle">';
            echo '<h2>Movie Title</h2>';
            echo '<h2>' . $row['title'] . '</h2>';
        echo '</div>';
        echo '<a href="/single-movie.php/id=' . $row['id'] . '"><img src="http://image.tmdb.org/t/p/w500/' . $row['poster_path'] . '"></a>';
        echo '<hr>';
        echo '<div id = "movieInfo">';
            echo '<label>Release date: </label>';
            echo '<span id="release_date">' . $row['release_date'] . '</span></br>';
            echo'<label >Popularity:' . $rating . '</label><span id="popularity"></span> <br>';
        echo '</div>';
        echo '<hr>';
}
?>
<html>
<head>
<script type='text/javascript'>
// https://www.google.com/search?q=html+for+back+button&rlz=1C1CHBF_enCA813CA813&oq=html+for+back+button&aqs=chrome.0.0l8.3363j0j4&sourceid=chrome&ie=UTF-8
// go back to previous step function
function goBack(){
window.history.back();
}
</script>
</head>
<body>
<div class="content">
<?php 
myFunction();
?>
</div>
</body>
    </html>