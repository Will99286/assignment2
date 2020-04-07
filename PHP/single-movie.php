<?php

    require 'config.php';
    include 'header.php';
    require 'db-functions.php';
    require 'helper.inc.php';

    $pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);

    $movie = null;

    if (isset($_GET["movie_id"])){
       
       $id = $_GET["movie_id"];
       $movie = getSingleMovie($pdo, $id);
    }
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../CSS/singlemovie.css">

</head>

<body>
<div class="movie-infor">
    <div class="details">
        <div class="movie-header">
		    <h2 ><?php  echo  $movie['title'] ; ?></h2>
        </div>
        <div class="detail-1">
			<h3 >Overview</h3>
				<span ><?php echo $movie['overview'];?></span>
            </div>
            
        <div class="detail-2">
			<h4>Release date:</h4><span><?php echo  $movie['release_date'] ?></span><br>
			<h4>Revenue($):</h4><span><?php echo  $movie['revenue']  ?></span><br>
			<h4>Runtime:</h4><span ><?php echo $movie['runtime'] ?></span><br>
			<h4>Tagline:</h4><span><?php echo $movie['tagline'] ?></span><br>
			<h4>TMDB link:</h4><span><?php echo  "https://www.themoviedb.org/movie/" . $movie['tmdb_id'] ; ?></span><br>
			<h4>IMDB link:</h4><span><?php echo  "https://www.imdb.com/title/" . $movie['imdb_id']  ; ?></span><br><br>
			<h3>Ratings</h3>
			<h4>Popularity:</h4><span><?php echo $movie['popularity']; ?></span><br>
			<h4>Average:</h4><span><?php echo  $movie['vote_average']; ?></span><br>
			<h4>Count:</h4><span><?php echo  $movie['vote_count']; ?></span><br><br>	
			
        </div>
        
        <div class="detail-3">
        <h3>Compaines</h3>
				<p><?php 
           $companyArray = getArr( $movie['production_companies'] );
           
            foreach($companyArray as $company ){
            echo $company['name']."|";
         };?></p>
			<h3>Countries</h3>
                <p><?php
                    $countryArray=getArr($movie['production_countries']);

                    foreach($countryArray as $country ){
                        echo $country['name']."|";
            
                    };

                ?></p>
            <h3>Keywords</h3>
                <p><?php
                   $keywordArray =getArr($movie['keywords']);
                   foreach($keywordArray as $keyword){
                       echo $keyword['name']." | ";
                   };
                ?></p>
            <h3>Genres</h3>
                <p><?php
                  $genreArray =getArr($movie['genres']);
                  foreach($genreArray as $genre){
                      echo $genre['name']. " | ";
                  };

                ?></p>

       </div>
     

    </div>
    <div class="movie-poster">
              
        <div class="vanishingButton">
        <?php 
            
            if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true)
            {
                echo"<button type = 'button' class='favoriteButton' data-id='". $_GET['movie_id']."'>Add Favourites</button>";
                echo"<div id='addedMessage'></div>";
                
            }

        ?>
        </div>
            
            <div class="poster">

				<div id="smallPoster">
                <?php
           
                  echo "<img src='https://image.tmdb.org/t/p/w342/".$movie['poster_path'] ."'" . ">";

                ?>
				
                </div>
                
                <div id="largePoster">
                <?php
           
                  echo "<img src='https://image.tmdb.org/t/p/w500/".$movie['poster_path'] ."'" . ">";

                ?>
				
				</div>

            </div>

            

    </div>
    <div class="actors">
        <div class="option-buttons">
                <button id="cast-button">Cast</button>&nbsp<button id="crew-button">Crew</button>
            
            
        </div>
                
			<div class="cast-list">

                <table id="cast-table">
                <tbody id="cast-body">
                <?php 
                   $castArray = getCastSortedArray($movie['cast']);
                   if (count($castArray) != 0){
                    foreach($castArray as $cast){
                        echo "<tr >" . '<th class="characterName">'.$cast['character'] .'</th>' . "<th class='castName'>" . $cast['name'] . "</th>"."</tr>";
                    }
                   }


                 ?>


                    </tbody>

                            </table>
            

                </div>
                
			<div class="crew-list">
				<table id="crew-table">
				       <tbody id="crew-body">   
                           <?php
                           $crewArray = getCrewSortedArray($movie['crew']);
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

<script src="../JS/single-movie.js"></script>   
</html>
