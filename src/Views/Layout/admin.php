<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
		<link href="/css/admin.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/js/jquery.min.js"></script>
		<script type="text/javascript" src="/js/ckeditor.js"></script>
	</head>
	<body>
		<header>
			<h1>Administration</h1>
		</header>
		<nav class="menu center">
		    <div>
				<a href="/"><i class="icon-home"></i>Accueil</a>
				<a href="/admin/news/index"><i class="icon-doc-text"></i>News</a>
				<a href="/admin/images/index"><i class="icon-picture"></i>Images</a>
			</div>
		</nav>
		<section>
			<?= $content ?>
		</section>
		<footer>
		    <a href="/logout">Logout ( <?= $user['username'] ?> )</a><br />
			JASON BOURLARD
		</footer>
	</body>
</html>