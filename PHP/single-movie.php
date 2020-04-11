<?php
//https://www.runoob.com/php/php-json.html
//www.php.net/manual/zh/function.usort.php
//https://stackoverflow.com/questions/1545357/how-to-check-if-a-user-is-logged-in-in-php
//https://www.w3schools.com/css/css_rwd_viewport.asp
    require 'config.php';
    require 'db-functions.php';
    include 'header.php';
    $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
    $movie = null;
    if (isset($_GET["movie_id"])){
       $id = $_GET["movie_id"];
       $movie = getSingleMovie($pdo, $id);
    }

    function getCastInfo($ColumnFromDataBase){
        
        $castObjects = (array) json_decode( $ColumnFromDataBase);
        $castsArray = array();

        if (count($castObjects) != 0){
            foreach( $castObjects as $c){
                $eachCast = (array)$c;
                $castsArray[] = $eachCast;            
            }
            usort($castsArray, function($a, $b){
                return $a['order'] <=> $b['order'];
            });
        }
        return $castsArray;
    }
    function getCrewInfo($ColumnFromDataBase){
        $crewObjects = (array) json_decode( $ColumnFromDataBase);
        $crewArray = array();


        if(count($crewObjects) != 0){
            foreach( $crewObjects as $crewObject){
                $eachCrew = (array)$crewObject;
                $crewArray[] = $eachCrew;
    
            }
            usort($crewArray, function($a, $b){
                $result = $a['department'] <=> $b['department'];
                if($result == 0){
                    $result = $a['name'] <=> $b['name'];
                }
                return $result;
            });
        }

        return $crewArray;
    }
    
    function getArray($ColumnFromDataBase){

        $arrayOfObjects =  (array) json_decode($ColumnFromDataBase); 
        $targetArray = array();
        if(count($arrayOfObjects) != 0){
            foreach($arrayOfObjects as $object){

                $target = (array) $object; 
    
                $targetArray[] = $target;
            }
        }
        return $targetArray;
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/singlemovie.css">    
</head>

<body>
<div class="movieinfo">
    <div class="details">
        <div class="moheader">
		    <h2 ><?php  echo  $movie['title'] ; ?></h2>
        </div>
        <div class="overViewSession">
			<h3 >Overview</h3>
				<span ><?php echo $movie['overview'];?></span>
            </div>
            
        <div class="imdbSession">
			<h4>Release date:</h4><span><?php echo  $movie['release_date'] ?></span><br>
			<h4>Revenue($):</h4><span><?php echo  $movie['revenue']  ?></span><br>
			<h4>Runtime:</h4><span ><?php echo $movie['runtime'] ?></span><br>
			<h4>Tagline:</h4><span><?php echo $movie['tagline'] ?></span><br>
			<h4>Popularity:</h4><span><?php echo $movie['popularity']; ?></span><br>
			<h4>Average:</h4><span><?php echo  $movie['vote_average']; ?></span><br>
			<h4>Count:</h4><span><?php echo  $movie['vote_count']; ?></span><br><br>
            <h4>TMDB link:</h4><span><?php echo  "https://www.themoviedb.org/movie/" . $movie['tmdb_id'] ; ?></span><br>
			<h4>IMDB link:</h4><span><?php echo  "https://www.imdb.com/title/" . $movie['imdb_id']  ; ?></span><br><br>	
        </div>
        
        <div class="movieSession">
            <h3>Production Company</h3>
				<p><?php 
                    $companyArray=getArray( $movie['production_companies'] );
                    foreach($companyArray as $company ){
                        echo $company['name']."|";
                    };
                ?></p>
			<h3>Production Country</h3>
                <p><?php
                    $countryArray=getArray($movie['production_countries']);
                    foreach($countryArray as $country ){
                        echo $country['name']."|";
                    };
                ?></p>
            <h3>Movie Keywords</h3>
                <p><?php
                   $keywordArray=getArray($movie['keywords']);
                   foreach($keywordArray as $keyword){
                       echo $keyword['name']." | ";
                   };
                ?></p>
            <h3>Movie Genres</h3>
                <p><?php
                  $genreArray =getArray($movie['genres']);
                  foreach($genreArray as $genre){
                      echo $genre['name']. " | ";
                  };
                ?></p>
       </div>
    </div>
    
    <div class="moviePoster">
        <div class="hideButton">
        <?php 
            if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true)
            {
                echo"<button type = 'button' class='favoriteButton' data-id='". $_GET['movie_id']."'>Add Favourites</button>";
                echo"<div id='addedMessage'></div>";
            }
        ?>
        </div>
            <div class="poster">
                <div id="posterPic">
                <?php
                  echo "<img src='https://image.tmdb.org/t/p/w500/".$movie['poster_path'] ."'" . ">";
                ?>
				</div>
            </div>
    </div>
    <div class="actors">
        <div class="castCrewButtons">
                <button id="castButton">Cast</button>&nbsp<button id="crewColumn">Crew</button>
        </div>
                
			<div class="castClass">
                <table id="castList">
                <tbody id="castTable">
                <?php 
                   $castArray = getCastInfo($movie['cast']);
                   if (count($castArray) != 0){
                    foreach($castArray as $cast){
                        echo "<tr >" . '<th class="characterName">'.$cast['character'] .'</th>' . "<th class='castName'>" . $cast['name'] . "</th>"."</tr>";
                    }
                   }
                 ?>
                    </tbody>
                            </table>
                </div>
                
			<div class="crewClass">
				<table id="crewList">
				       <tbody id="crewBody">   
                           <?php
                           $crewArray = getCrewInfo($movie['crew']);
                           if(count( $crewArray) != 0){
                            foreach($crewArray as $crew){
                                echo "<tr>" . "<th>".$crew['department'] ."</th>" . "<th>" . $crew['job'] . "</th>"."<th class='crewName'>". $crew['name']."</th>"."</tr>";
                               }
                           }
                           ?>                      
                </tbody>
				</table>
			</div>
    </div>
</div>
   
</body>
<?php
     if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true)
     {
         echo '<script src ="../JS/favorite.js"></script>';
     }
     $pdo = null;
?> 
</html>
