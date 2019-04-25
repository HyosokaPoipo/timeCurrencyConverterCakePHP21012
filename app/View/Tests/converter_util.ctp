<?php
// echo "Japan Currency : <br>";
// echo $jpCurr."<br>";
// echo $jpDate;
// echo "<br><br>";

// echo "IDR Currency : <br>";
// echo $idrCurr."<br>";
// echo $idrDate;
// echo "<br><br>";


// echo "US Currency : <br>";
// echo $usCurr."<br>";
// echo $usDate;
// echo "<br><br>";


?>

<div class="dropdown show text-right">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Choose Language
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="#">JPN</a>
    <a class="dropdown-item" href="#">ENG</a>
    <a class="dropdown-item" href="#">IDN</a>
  </div>
</div>

<div class="form-group">
 <label >Pickup Date :</label>
 <input type="date" name="bday" max="3000-12-31" 
        min="1000-01-01" class="form-control">
</div>
<!-- <div class="form-group">
 <label >Einde voorverkoop periode</label>
 <input type="date" name="bday" min="1000-01-01"
        max="3000-12-31" class="form-control">
</div> -->
<div class="form-group">
 <label >Put Money Amount :</label>
 <input type="text" class="form-control">
</div>

<div class="text-right">
	<button type="button" class="btn btn-warning mr-2">Cancel</button>
	<button type="button" class="btn btn-primary">Save</button>
</div>

