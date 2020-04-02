<?php
    require 'config.php';
    require 'db-functions.php';

    $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);

    $moviesInfo = getMovies($pdo);

    //return movie detail
    $returnedMovieData = array();

    foreach($moviesInfo as $mv){
        $singleMovieInfo = [
            "id"            => ($mv['id']),
            "tmdb_id"       => ($mv['tmdb_id']),
            "imdb_id"       => ($mv['imdb_id']),
            "release_date"  => ($mv['release_date']),
            "title"         => ($mv['title']),
            "runtime"       => ($mv['runtime']),
            "revenue"       => ($mv['revenue']),
            "tagline"       => ($mv['tagline']),
            "poster"        => ($mv['poster_path']),
            "overview"      => ($mv['overview']),
            "ratings"       => [
                "popularity"    => round($mv['popularity']),
                "average"       => ($mv['vote_average']),
                "count"         => ($mv['vote_count'])
            ]
        ];

        $returnedMovieData[] = $singleMovieInfo;
    }

    if(isset($_GET['id'])){
        $mv = getSingleMovie($pdo, $_GET['id']);
        if($mv == false) exit;
    
        $returnedMovieData = null;
            $singleMovieInfo = [
                "id"            => $mv['id'],
                "tmdb_id"       => $mv['tmdb_id'],
                "imdb_id"       => $mv['imdb_id'],
                "release_date"  => $mv['release_date'],
                "title"         => $mv['title'],
                "runtime"       => $mv['runtime'],
                "revenue"       => $mv['revenue'],
                "tagline"       => $mv['tagline'],
                "poster"        => $mv['poster_path'],
                "ratings"       => [
                    "popularity"    => $mv['popularity'],
                    "average"       => $mv['vote_average'],
                    "count"         => $mv['vote_count']
                ],
                "details"       => [
                    "overview"  => $mv['overview'],
                    "genres"    => $mv['genres'],
                    "keywords"  => $mv['keywords'],
                ],
                "production" => [
                    "crew"      => json_decode($mv['crew']),
                    "cast"      => json_decode($mv['cast']),
                    "companies" => json_decode($mv['production_companies']),
                    "countries" => json_decode($mv['production_countries'])
                ]
            ];
        $returnedMovieData = $singleMovieInfo;
    } 
    $pdo=null;
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    echo json_encode($returnedMovieData, JSON_NUMERIC_CHECK+JSON_PRESERVE_ZERO_FRACTION);
?>