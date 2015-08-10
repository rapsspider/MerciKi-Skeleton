

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
		<link href="/css/defaut.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/js/jquery.min.js"></script>
	</head>
	<body>
		<header>
			<h1>Mon site</h1>
		</header>
		<nav class="menu center">
		    <div>
				<a href="/">Accueil</a>
				<a href="/images">Images</a>
			</div>
		</nav>
		<section>
			<?= $content ?>
		</section>
		<footer>
		    <a href="/Admin">Panel Admin</a><br />
			JASON BOURLARD
		</footer>
	</body>
</html>
