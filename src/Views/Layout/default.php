<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
        <title>Project</title>
    </head>
    <body>
    <nav class="navbar navbar-default navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header ">
                <a class="navbar-brand" href="/">Projects</a>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
        <div class="container">
            <?= $content ?>
        </div>
        
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
        <?= isset($footer) ? $footer : '' ?>
    </body>
</html>