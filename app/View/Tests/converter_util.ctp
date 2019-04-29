<?php
$url = $this->request->base . '/tests/converterUtil';
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
    <?php echo __('ChooseLanguage') ;?>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="<?php echo $url.'/jpn' ?>">JPN</a>
    <a class="dropdown-item" href="<?php echo $url.'/eng' ?>">ENG</a>
    <a class="dropdown-item" href="<?php echo $url.'/idn' ?>">IDN</a>
  </div>
</div>

<div class="form-group">
 <label ><?php echo __('PickupDate') ;?></label>
 <input id="input-date" type="date" name="bday" max="3000-12-31" 
        min="1000-01-01" class="form-control" placeholder="">
</div>
<!-- <div class="form-group">
 <label >Einde voorverkoop periode</label>
 <input type="date" name="bday" min="1000-01-01"
        max="3000-12-31" class="form-control">
</div> -->
<div class="form-group">
 <label ><?php echo __('PutMoneyAmount') ;?></label>
 <input type="text" class="form-control">
</div>

<div class="text-right">
	<button type="button" class="btn btn-warning mr-2" onclick="cancelTest()"><?php echo __('Cancel') ;?></button>
	<button onclick="saveTest(); return false;" type="button" class="btn btn-primary"><?php echo __('Save') ;?></button>
</div>

<div>
	<table id="soap_table" style="margin-top: 80px; color: black;">
		<tr class="bg-info">
			<td style="text-align: center;"> <?php echo __('No') ;?> </td>
			<td style="text-align: center;"> <?php echo __('Date') ;?> </td>
			<td style="text-align: center;"> <?php echo __('Curreny') ;?> </td>
		</tr>
	<?php 
		$this->Converter->init($locale, $timezone, $curr);
		$no = 0;
		foreach ($test_data as $key => $data) {
			foreach ($data as $key => $core_data) {
			$no++;
	?>
		<tr>
			<td style="text-align: center;"> <?php echo $no ;?> </td>
			<td style="text-align: center;"> <?php echo $this->Converter->convertDate($core_data['date_input']) ;?> </td>
			<td style="text-align: center;"> <?php echo $this->Converter->convertCurrency($core_data['currency_amount']) ;?> </td>
		</tr>
	<?php		
			}		
		}
	?>
	</table>
</div>



<!-- ************************************** --->
<!-- <script type="text/javascript">
$( function() {
    $( "#datepicker" ).datepicker();
  	} 
  );
  
</script>
<div class="form-group">
 <p>Date example : <input type="text" id="datepicker"></p>
</div> -->

<!-- ************************************** --->


<script type="text/javascript">
	function changeLanguage(e, locale) {
		e.preventDefault();
		console.log(locale);

		var param = {
			'locale' : locale
		};
		$.ajax({
			type: "POST"
			, data: param
			, url: "<?php echo $this->request->base . '/tests/changeLanguage' ?>"
			// , dataType: "json"
			, success: function (res) {
				document.location.reload();	
				alert('ganti bahasa okie');
			}
			, error: function (err) {
				console.log(err);
				alert('Language failed to be changed.');
			}
			, cache: false
		});
	}


	function saveTest() {
		// e.preventDefault();
		alert('starting save');

		var param = {
			'date_input': $('#input-date').val(),
			'currency_amount': $("input:text").val()
		};
		$.ajax({
			type: "POST"
			, data: {'content': param}
			, url: "<?php echo $this->request->base.'/tests/saveTests'?>"
			// , dataType: "json"
			, success: function (res) {	
				alert('save okie');
			}
			, error: function (err) {
				console.log(err);
				alert('Gagal menyimpan data');
			}
			, cache: false
		});
	}
	
	function cancelTest() {
		$('input-date').val('');
		$( "input:text" ).val('');
	}
</script>