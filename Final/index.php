<?php

include 'header.php';
include 'functions.php';

?>
    
    <div class="jumbotron">
    <h1> SpaceX Flight Search</h1>
    <h2> The unofficial SpaceX flight database of CSUMB </h2>
    </div>
    <br>
    
    <div id="carouselExampleIndicators" class="carousel slide" data-interval="3000" style="width: 600px; margin: 0 auto">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="https://coubsecure-s.akamaihd.net/get/b173/p/coub/simple/cw_timeline_pic/c50a890e7b6/704602b0ecd120ba2fa19/big_1498300032_image.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="https://cdn.arstechnica.net/wp-content/uploads/2018/05/38056454431_706e1e5a68_k-1-800x533.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="http://www.latimes.com/resizer/Hd-Z0TwQlrViOYivM3yUmPbFju8=/1400x0/arc-anglerfish-arc2-prod-tronc.s3.amazonaws.com/public/RK7KOW6FO5ATFMNRCYZUQCIPVQ.jpg" alt="Third slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://qz.com/wp-content/uploads/2018/04/tesla-spacex-elon-musk-starman-falcon-roadster-model-3-production.jpg?quality=80&strip=all&w=1920" alt="Fourth slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
</div>
        
    <div class='searchForm'>
        <form>
        <fieldset>
            <strong>Locations: </strong><br>
            <?=getUniqueLocations()?>
            <br>
            
            <strong>Year: </strong><br>
            <select name="year">
                <option name="select" value="select">Select One</option>
                <?=getUniqueFlightYears()?>
            </select> 
            
            <br>
            <strong>Rockey Type:</strong><br>
            <?=getUniqueFlightRockets()?>
            
            <br>
            <strong>Sort by: </strong>
            <select name="orderBy">
                <option name="oldest" value="oldest">Oldest</option>
                <option name="newest" value="newest">Newest</option>
            </select>
            <br>
            <br>
            <!--<input type="submit" name="searchForm" value="Submit"/>-->
            <input type='submit' name='searchForm' class='btn btn-success btn-sm' value='Search' />
            
            </fieldset>
        </form>
    </div>
    
    <?=displaySearchResults()?>

<?php
include 'footer.php';
?>