<?php
define('INTERNAL_FORMAT', 'Y-m-d');
define('DISPLAY_MONTH_FORMAT', 'F Y');
define('DISPLAY_DAY_FORMAT', 'F j, Y');

function isWednesday($date) {
	return date('w', strtotime($date)) === '3';
}
function isThursday($date) {
	return date('w', strtotime($date)) === '4';
}

// types of classes
$classTypes = ['Filing', 'Searching'];
$reportColumns = ['Day', 'Name (Column A)', 'Start (Column E)', 'End (Column F)', 'Closes (Column I)'];
$reportRecords = [];
$start_date = date(INTERNAL_FORMAT);

// something to store months and days
$months_and_dates = [];

// loop over 365 days and look for wednesdays or thursdays not in the excluded list
foreach(range(0, 365) as $day) {
	$internal_date = date(INTERNAL_FORMAT, strtotime("{$start_date} + {$day} days"));
	$this_day = date(DISPLAY_DAY_FORMAT, strtotime($internal_date));
	$this_month = date(DISPLAY_MONTH_FORMAT, strtotime($internal_date));
	if ((isThursday($internal_date) || isWednesday($internal_date))) {
		$months_and_dates[$this_month][] = $this_day;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dates</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
</head>
<body>

	<?php foreach ($classTypes as $class) { ?>
	<div class="container">
		<div class="row">

			<div class="col">
				<br>
				<br>
				<br>

				<h2><span style='color: red;'><?= $class ?></span></h2>
				<p>Please see the below calculated dates for Wednesdays and Thursdays.</p>
				<table class="table table-bordered">
					<?php foreach($months_and_dates as $month => $days) { ?>
						<thead>
							<tr>
								<?php foreach ($reportColumns as $column) { ?>
									<th scope="col"><?= $column ?></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($days as $day) {

								// variables
								$dayStart = null;
								$dayEnd = null;
								$dayDesciption = $day . ' - iLien Beginners ' . $class;

								if ($class == 'Filing') {
									if (isWednesday($day)) {
										$dayStart = date('n/j/Y', strtotime($day)) . ' 2:30:00 PM';
										$dayEnd = date('n/j/Y', strtotime($day)) . ' 3:30:00 PM';
									}
									else if (isThursday($day)) {
										$dayStart = date('n/j/Y', strtotime($day)) . ' 10:30:00 AM';
										$dayEnd = date('n/j/Y', strtotime($day)) . ' 11:30:00 AM';
									}
								}
								else if ($class == 'Searching') {
									if (isWednesday($day)) {
										$dayStart = date('n/j/Y', strtotime($day)) . ' 10:30:00 AM';
										$dayEnd = date('n/j/Y', strtotime($day)) . ' 11:30:00 AM';
									}
									else if (isThursday($day)) {
										$dayStart = date('n/j/Y', strtotime($day)) . ' 2:30:00 PM';
										$dayEnd = date('n/j/Y', strtotime($day)) . ' 3:30:00 PM';
									}
								}
							?>
			<tr>
				<th scope="row"><?= date('l', strtotime($day)) ?></th>
				<td><?= $day . ' - iLien Beginners ' . $class ?></td>
				
				<?php if ($class == 'Filing') { ?>
					<?php if (isWednesday($day)) { ?>
						<td><?= $dayStart ?></td>
						<td><?= $dayEnd ?></td>
					<?php } else if (isThursday($day)) { ?>
						<td><?= $dayStart ?></td>
						<td><?= $dayEnd ?></td>
					<?php } ?>
				<?php } else if ($class == 'Searching') { ?>
					<?php if (isWednesday($day)) { ?>
						<td><?= $dayStart ?></td>
						<td><?= $dayEnd ?></td>
					<?php } else if (isThursday($day)) { ?>
						<td><?= $dayStart ?></td>
						<td><?= $dayEnd ?></td>
					<?php } ?>
				<?php } ?>
				<!-- CLOSING DATE -->
				<td><?= date('n/j/Y', strtotime($day)) . ' 12:00:00 AM' ?></td>
			</tr>
		<?php
			// push data to array
			array_push($reportRecords, [
				date('l', strtotime($day)),
					$dayDesciption,
					$dayStart,
					$dayEnd,
					date('n/j/Y', strtotime($day)) . ' 12:00:00 AM'
				]
			);
		} ?>
	  </tbody>
	  <?php } ?>
	</table>
</div>
</div>
</div>
<?php } 

// create file
$exportReport = fopen('date_report.csv', 'w') or die("Can't create report");

// put report columns
fputcsv($exportReport, $reportColumns);

// add report rows
foreach ($reportRecords as $r) {
	fputcsv($exportReport, $r);
}

?>
</body>
</html>