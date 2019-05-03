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

<style type="text/css">
	.red {
  		color: red;
	}

	.green {
		color: red;
	}

	input:focus { 
	  border-color: #ced4da;
	}
	
	a.ui-datepicker-next.ui-corner-all::after {
		content: ">";
		font-weight: bold;
	}

	a.ui-datepicker-prev.ui-corner-all::after {
		content: "<";
		font-weight: bold;
	}
	#sort-number:hover, #sort-date:hover{
		cursor: pointer;
	}
</style>

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
 <!-- <input id="input-date" type="date" name="bday" max="3000-12-31" 
        min="1000-01-01" class="form-control" placeholder=""> -->
  <input type='text' class="form-control" id='input-date' />
</div>
<!-- <div class="form-group">
 <label >Einde voorverkoop periode</label>
 <input type="date" name="bday" min="1000-01-01"
        max="3000-12-31" class="form-control">
</div> -->
<div class="form-group">
 <label ><?php echo __('PutMoneyAmount') ;?></label>
 <input type="text" class="form-control" id="money-amount">
</div>

<div class="text-right">
	<button type="button" class="btn btn-warning mr-2" onclick="cancelTest()"><?php echo __('Cancel') ;?></button>
	<button onclick="saveTest(); return false;" type="button" class="btn btn-primary"><?php echo __('Save') ;?></button>
</div>

<div>
	<table id="myTable" style="margin-top: 80px; color: black;">
		<tr class="bg-info">
			<td style="text-align: center;"> <?php echo __('No') ;?> <i class="fa fa-fw fa-sort" id="sort-number"></i></td>
			<td style="text-align: center;"> <?php echo __('Date') ;?> <i class="fa fa-fw fa-sort" id="sort-date"></i> </td>
			<td style="text-align: center;"> <?php echo __('Curreny') ;?> </td>
		</tr>
	<?php 
		$this->Converter->init($locale, $timezone, $curr);
		$no = 0;
		foreach ($test_data as $key => $data) {
			foreach ($data as $key => $core_data) {
			$no++;
	?>
		<tr data-number="<?php echo $no ;?>">
			<td style="text-align: center;"> <?php echo $no ;?> </td>
			<td style="text-align: center;"> <?php echo $this->Converter->convertDate($core_data['date_input']) ;?> </td>
			<td style="text-align: center;"> <?php echo $this->Converter->displayCurrencyWithRate($core_data['currency_amount']) ;?> </td>
		</tr>
	<?php		
			}		
		}
	?>
	</table>
</div>


<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modalTitle" class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="modalContent"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
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
    $(function () {
         
    });
</script>
    




<script type="text/javascript">
	var fixDate = '';
	var sortNumberType = 'DESC';
	$( document ).ready(function() {
    	$( "input:text" ).focus(function() {
		  $( "input:text" ).css("border-color", '#ced4da');
		});
		$('#input-date').focus(function() {
		  $('#input-date').css("border-color", '#ced4da');
		});
	});
	$('#input-date').datepicker({ 
		onSelect: function(date) {
			$('#input-date').val(jicaDateFormat(date));
		}
	}); 

	function jicaDateFormat(date) {				
		var tempDate = new Date(date);
		var res = '';
		switch('<?php echo $locale; ?>') {
			case 'ja_jp':
				res = tempDate.getFullYear() + '/' + (tempDate.getMonth()+1) + '/'+ tempDate.getDate();
				break;
			case 'id_ID':
				res = tempDate.getDate() + '/' + (tempDate.getMonth()+1) + '/'+ tempDate.getFullYear();
				break;
			case 'en_us':
				res = (tempDate.getMonth()+1) + '/' + tempDate.getDate() + '/'+ tempDate.getFullYear();
				break;
			default:
				res = (tempDate.getMonth()+1) + '/' + tempDate.getDate() + '/'+ tempDate.getFullYear();
				break;
		}
		fixDate = tempDate.getFullYear() + '/' + (tempDate.getMonth()+1) + '/'+ tempDate.getDate();
		return res;
	}              
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
		var tempDate = new Date($('#input-date').val());
		var param = {
			'date_input': tempDate.getFullYear() + '/' + (tempDate.getMonth()+1) + '/'+ tempDate.getDate(),
			'currency_amount': $("#money-amount").val(),
			'locale': '<?php echo $locale; ?>',
			'timezone': '<?php echo $timezone; ?>',
			'curr': '<?php echo $curr; ?>' 
		};		
		$.ajax({
			type: "POST"
			, data: {'content': param}
			, url: "<?php echo $this->request->base.'/tests/saveTests'?>"
			, success: function (res) {	
				console.log('response di success');
				var sccMsg = JSON.parse(JSON.stringify(res));
				$('#modalTitle').text("<?php echo __('Success') ;?>");
				$('#modalContent').text("<?php echo __('SuccessMsg') ;?>");			
				$('#myModal').modal('show');
				var lastRow = $('#myTable tr:last');
				var number = lastRow.data('number');
				if (isNaN(number)) {
					number = 0;
				}
				lastRow.after(
					'<tr data-id='+ (number + 1) +'> ' + 
					' <td style="text-align: center;"> ' + (number + 1) +' </td> ' +
					' <td style="text-align: center;"> ' + sccMsg.date_input + ' </td>' +
					' <td style="text-align: center;"> ' + sccMsg.currency_amount + ' </td>' +
					'</tr>'
				);}
			, error: function (err) {
				var errorRaw = JSON.parse(JSON.stringify(err));
				var errMsg = JSON.parse(errorRaw.responseText);
				var displayedText = '';
				if (typeof(errMsg['date_input']) !== 'undefined') {
					$("#input-date").css("border-color", 'red');
					displayedText = "- " + "<?php echo __('DateError') ;?>"+"<br>";

				}

				if (typeof(errMsg['currency_amount']) !== 'undefined') {
					$("#money-amount").css("border-color", 'red');
					displayedText += "- " + "<?php echo __('CurrencyError') ;?>";
				}

				if (typeof(errMsg['save_error']) !== 'undefined') {
					displayedText += "- " + "<?php echo __('SaveError') ;?>";
				}
				console.log(displayedText);
				$('#modalTitle').text("<?php echo __('Error') ;?>");
				$('#modalContent').html(displayedText);	
				$('#myModal').modal('show');
			}
			, cache: false
		});
	}
	
	function cancelTest() {
		$('#input-date').val('');
		$( "#money-amount" ).val('');
	}

	$('#sort-number').click(function () {
		var param = {
			'sort_type': sortNumberType,
			'sort_param': 'id',			
			'locale': '<?php echo $locale; ?>',
			'timezone': '<?php echo $timezone; ?>',
			'curr': '<?php echo $curr; ?>' 
		}
		$.ajax({
			type: "POST"
			, data: {'content': param}
			, url: "<?php echo $this->request->base.'/tests/sortNumber'?>"
			, success: function (res) {
				var rawData = JSON.parse(JSON.stringify(res));
				console.log(rawData);
				$('#myTable').find("tr:gt(0)").remove();
				var size = rawData.length;
				console.log('size : ' + size);
				console.log('current sorting : ' + sortNumberType);
				if (sortNumberType == 'ASC') {
					for(var i = 0; i < size; i++) {
						var lastRow = $('#myTable tr:last');
						console.log(rawData[i].id);
						lastRow.after(
							'<tr data-id='+ (i + 1) +'> ' + 
							' <td style="text-align: center;"> ' + (i + 1) +' </td> ' +
							' <td style="text-align: center;"> ' + rawData[i].date_input + ' </td>' +
							' <td style="text-align: center;"> ' + rawData[i].currency_amount + ' </td>' +
							'</tr>'
						);

					}
					sortNumberType = 'DESC'
				} else {
					// TYPE HERE IS ONLY DESC
					for(var i = 0; i < size; i++) {
						var lastRow = $('#myTable tr:last');
						console.log(rawData[(size-1)].id);
						lastRow.after(
							'<tr data-id='+ (size - i) +'> ' + 
							' <td style="text-align: center;"> ' + (size - i) +' </td> ' +
							' <td style="text-align: center;"> ' + rawData[i].date_input + ' </td>' +
							' <td style="text-align: center;"> ' + rawData[i].currency_amount + ' </td>' +
							'</tr>'
						);

					}
					sortNumberType = 'ASC'
				}
			}
			, error: function (err) {
			}
		});
	});
</script>