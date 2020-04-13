<?php 
	require_once('includes/data.php'); 
	require_once('includes/functions.php'); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,600,700|Oswald&display=swap&subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/reset.css" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="icon" href="assets/images/favicon.ico" />
	<title>La montage ça vous gagne</title>
</head>
<body>
	<header id="header" class="wrapper">
		<div id="logo">
			<a href="">
				<img src="assets/images/logo.png" alt="Logo" />
			</a>
		</div>
		<div id="search">
			<form action="index.php" autocomplete="off" method="get">
				<div>
					<label for="search-form">Rechercher une piste</label>
					<input type="text" placeholder="Rechercher une piste" id="search-form" name="search">
				</div>
				<div>
					<input type="submit" value="Rechercher">
				</div>
			</form>
		</div>
	</header>
	<div id="banner">
		<div class="wrapper">
			<h1>La montagne ça vous gagne</h1>
		</div>
	</div>
	<main id="primary" class="wrapper">
		<div id="title">
			<?php $infos = infoSlopes($slopes, $colors); ?>
			<h2>Ouverture des pistes</h2>
			<p>Le domaine skiable est ouvert à <?php echo $infos['percentOpen']; ?>%. <?php echo $infos['openSlopes']; ?> pistes ouvertes et <?php echo $infos['closeSlopes']; ?> pistes fermées.</p>
		</div>
		
		<ul id="colors">
			<?php foreach ($infos['colorsTotal'] as $key => $value) { ?>
				<li class="<?php echo $key; ?>">
					<div>
						<span><?php echo zeroFormat($infos['colorsOpen'][$key]); ?></span>
						/ <?php echo zeroFormat($value); ?>
					</div>
					<div>
						<p><?php echo $colors[$key]; ?></p>
					</div>
				</li>
			<?php } ?>
		</ul>

		<table id="slopes">
			<caption>Pistes de ski alpin</caption>
			<tbody>
				<?php foreach ($slopes as $value) { ?>
					<?php if (empty($_GET['search']) || stristr($value['name'], $_GET['search'])) { ?>
						<?php $result = true; ?>
						<tr>
							<td>
								<span class="circle <?php echo $value['color']; ?>">
									<?php echo $colors[$value['color']]; ?>
								</span>
							</td>
							<td><?php echo $value['name']; ?></td>
							<td class="<?php echo stateClass($value['state']); ?>">
								<?php echo stateDisplay($value['state']); ?>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
				<?php if (empty($result)) { ?>
					<tr>
						<td class="no-result" colspan="3">Aucun résultat</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

		<?php if (!empty($_GET['search'])) { ?>
			<a class="button" href="index.php#slopes" title="Afficher tous les résultats">
				Afficher tous les résultats
			</a>
		<?php } ?>

		<table>
			<caption>Remontées</caption>
			<tbody>
				<?php foreach ($lifts as $value) { ?>
					<tr>
						<td>
							<img src="assets/images/<?php echo $value['type']; ?>.png" alt="Image" />
						</td>
						<td><?php echo $value['name']; ?></td>
						<td class="<?php echo stateClass($value['state']); ?>">
							<?php echo stateDisplay($value['state']); ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</main>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
</body>
</html>
