<div class="pannel">
    <section class="threeDcontainer">
        <div id="cube">
            <figure class="accueil">
                <h3>Que faire ?</h3>
                <div class="deuxboutons">
                    <div class="bouton">
                        <a href="/" class="back"> Retourner sur le site </a>
                    </div>
                    <div class="bouton">
                        <a href="#" id="view_login"> Se connecter </a>
                    </div>
                </div>
            </figure>
            <figure class="login">
                <h3>Authentification : POKENEWS</h3>
                <form accept-charset="utf-8" method="POST" id="UsagerLoginForm" action="/login?arg=true">
                    <div class="ui form segment">
                        <div class="field">
                            <label>Username</label>
                            <div class="ui left labeled icon input">
                                <input placeholder="Username" name="username" type="text">
                                <i class="user icon"></i>
                                <div class="ui corner label">
                                    <i class="icon asterisk"></i>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Passe</label>
                            <div class="ui left labeled icon input">
                                <input placeholder="Passe" name="password" type="password">
                                <i class="lock icon"></i>
                                <div class="ui corner label">
                                    <i class="icon asterisk"></i>
                                </div>
                            </div>
                        </div>
                        <div class="deuxboutons">
                            <div class="bouton"><a href="#" class="back">Back</a></div>
                            <div class="submit bouton"><button type="submit" name="connexion">Login</button></div>
                        </div>
                        <div class="clear"></div>
                        <div class="error">
                            <p>Username ou Mot de passe invalide !</p>
                        </div>
                    </div>
                </form>
            </figure>
            <figure class="loading">
                <div class="up"></div>
            </figure>
            <figure class="loading_back">
            </figure>
        </div>
    </section>
</div>
<script>

function login() {
    $('#UsagerLoginForm').submit()
}
    
function resetForm() {
    var form = $('.form.segment').removeClass('error');
    form.find('.field').removeClass('error');
}

var loading = {
    timeout : null,
    index : 0,
    start : function() {
        loading.timeout = setInterval(
            function(){ loading.next() }, 
            100
        );
    },
    next : function() { 
        var block = $('figure.loading div');

        var up = block.hasClass('up');
        var down = block.hasClass('down');
        var left = block.hasClass('left');
        var right = block.hasClass('right');

        // top
        if(loading.index <= 2) {
            if(!up) block.addClass('up');
        } else {
            if(up) block.removeClass('up');
        }

        // right
        if(2 <= loading.index && loading.index <= 4) {
            if(!right) block.addClass('right');
        } else {
            if(right) block.removeClass('right');
        }

        // down
        if(4 <= loading.index && loading.index <= 6) {
            if(!down) block.addClass('down');
        } else {
            if(down) block.removeClass('down');
        }

        // left
        if(6 <= loading.index && loading.index <= 7 || loading.index == 0) {
            if(!left) block.addClass('left');
        } else {
            if(left) block.removeClass('left');
        }

        loading.index = (loading.index + 1) % 8;
    },
    stop : function() {
        clearInterval(loading.timeout);
        loading.timeout = null;
    }
}

function Connexion(form) {

    this.$form = form;
    
    this.loading = function() {
        $('#cube').addClass('down');
    }

    this.endloading = function() {
        $('#cube').removeClass('down');
    }

    this.connexion = function() {
        this.username = this.$form.find('input[name=username]').val();
        this.password = this.$form.find('input[name=password]').val();
        this.loading();
        loading.start();

        $.ajax({
            'type' : this.$form.attr('method'),
            'url'  : this.$form.attr('action'),
            'dataType' : 'json',
            'data' : {
                'username' : this.username,
                'password' : this.password
            }
        })
        .done(function(data) { con.afterConnexion(data); })
        .fail(function() { con.afterConnexionErr(); con.endloading(); });
    }

    this.afterConnexion = function(json) {
        if(json.result) {
            window.location.replace("/");
            if($('#cube form .segment').hasClass('error')) {
                $('#cube form .segment').removeClass('error');
            }
        }
        else {
            if(!$('#cube form .segment').hasClass('error')) {
                $('#cube form .segment').addClass('error');
            }
            con.endloading();
        }
        loading.stop();
    }

    this.afterConnexionErr = function() {
        alert('Une erreur est survenue. Contacter l\'administrateur !');
        loading.stop();
    }
}

var con = new Connexion($('form'));
    
$('.bouton a.back').on('click', function() {
    resetForm();
    $('#cube').removeClass('flipped');
});
    
$('#view_login').on('click', function() {
    $('#cube').addClass('flipped');
    $('form input[name=username]').focus();
});
    
$('input[name=username], input[name=password]').on('keydown', function(e) {
    if ( e.which == 13 ) {
        $('form').submit();
    }
});
    
$('form').submit(function(e) {
    e.preventDefault();
    con.connexion();
    return false;
});

//$('#cube').addClass('flipped').addClass('down');
</script>

