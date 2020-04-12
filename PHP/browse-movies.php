<!DOCTYPE html>
<?php
    include 'header.php';
?>
<html>
    <head>
    <title>Browse Movies</title>
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../CSS/browse-movies.css" />
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            document.getElementById("clear").addEventListener("click",
        (e) => {
                location.reload();
            }
    );
        })
        
</script>
</head>
<body>
<aside class="MovieFilters">
            <h1>Browser</h1>
            <div class="container">
                <form class="sideBox" method="get" action="browse.php">
                    <div class="field">
                        <label> <strong>Title</strong> </label>
                    </div>
                    <div class="row"><input name="title" id="textField_Title" type="text"></div>
                    <div class="field"><br />
                        <label><strong>Year</strong></label>
                    </div>
                    <div class="row">
                        <div class="col-10"><input type="radio" name="yearRate" id="yearBefore" value="yearBefore">
                        </div>
                        <div class="col-15"><label>Before</label></div>
                        <div class="row"><input name="yearBefore" id="textField_yearBefore" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col-10"><input type="radio" name="yearRate" id="yearAfter" value="yearAfter" ></div>
                        <div class="col-15"><label>After</label></div>
                        <div class="row"><input name="yearAfter" id="textField_yearAfter" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col-10"><input type="radio" name="yearRate" id="yearInBetween"
                                value="yearInBetween"></div>
                        <div class="col-15"><label>Between</label></div>
                        <div class="row">
                            <input type="text" name="yearBetweenStart" id="yearInBetweenStart">
                            <input type="text" name="yearBetweenEnd" id="yearInBetweenEnd">
                        </div>
                    </div>
                    <div class="field"><br />
                        <label> <strong>Rating</strong> </label>
                    </div>
                    <div class="row">
                        <div class="col-10"><input type="radio" name="yearRate" value="rateBelow" id="rateBelow">
                        </div>
                        <div class="col-15"><label>Below</label></div>
                        <div class="row"><input type="range" name="rateBelow" id="sliderBelow" min="0" max="10" step="0.1"
                                value="5"><span id="numBelow">5</span></div>
                    </div>
                    <div class="row">
                        <div class="col-10"><input type="radio" name="yearRate" value="rateAbove" id="rateAbove">
                        </div>
                        <div class="col-15"><label>Above</label></div>
                        <div class="row"><input type="range" name="rateAbove" id="sliderAbove" min="0" max="10" step="0.1"
                                value="5"><span id="numAbove">5</span></div>
                    </div>

                    <div class="row">
                        <div class="col-10"><input type="radio" name="yearRate" value="rateInBetween"
                                id="rateInBetween"></div>
                        <div class="col-15"><label> Between </label></div>
                        <div class="row">
                            <input type="range" name="rateBetweenStart" id="ratingInBetweenLow" min="0" max="10" step="0.1" value="5"><span
                                id="numInBetweenStart">5</span>
                            <input type="range" name="rateBetweenEnd" id="ratingInBetweenHigh" min="0" max="10" step="0.1" value="5"><span
                                id="numInBetweenEnd">5</span>
                        </div>
                    </div><br />
                    <button id="filter">Filter</button>
                    <button id='clear'>Clear</button>
                </form>
                <div class="filterButton">

                </div>
</body>
    </html>