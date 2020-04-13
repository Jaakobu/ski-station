<?php
	// Display state
	function stateDisplay($state) {
		if ($state) {
			$result = 'Ouverte';
		}
		else {
			$result = 'Fermée';
		}

		return $result;
	}


	function stateClass($state) {
		if ($state) {
			$result = 'open';
		}
		else {
			$result = 'close';
		}

		return $result;
	}
 

	function infoSlopes($slopes, $colors) {
		$totalSlopes = count($slopes);
		$openSlopes = 0;

		$colorsTotal = [];
		$colorsOpen = [];
		foreach ($colors as $key => $value) {
			$colorsOpen[$key] = 0;
			$colorsTotal[$key] = 0;
		}

		foreach ($slopes as $value) {
			if ($value['state']) {
				$openSlopes++;
				$colorsOpen[$value['color']]++;
			}

			$colorsTotal[$value['color']]++;
		}

		$closeSlopes = $totalSlopes - $openSlopes;

		$percentOpen = ($openSlopes / $totalSlopes) * 100;
		$percentOpen = round($percentOpen);

		$results = [
			'percentOpen' => $percentOpen,
			'openSlopes' => $openSlopes,
			'closeSlopes' => $closeSlopes,
			'colorsOpen' => $colorsOpen,
			'colorsTotal' => $colorsTotal
		];

		return $results;
	}


	function zeroFormat($number) {
		if ($number < 10 && $number != 0) {
			$number = 0 . $number;
		}

		return $number;
	}
