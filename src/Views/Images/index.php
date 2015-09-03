<h1>Voici nos images !!!</h1>

<div class="images">
    <div id="image_show">
        <p>Chargement des images ...</p>
    </div>
    <div class="bouton">
        <a href="#" onClick="return ImagesViewer.boutonPrev();">Précédente</a>
        <a href="#" onClick="return ImagesViewer.boutonNext();">Suivante</a>
</div>
<script>
    /**
     * Ajout d'une fonction show à la classe Image
     * @param Object elem 
     */
    Image.prototype.show = function(elem) {
        // Si elem est null ou indéfini, on quite la fonction.
        if(elem == undefined || elem == null) return;

        // On remplace le contenu HTML par un titre
        elem.innerHTML = '<h2>' + this.title + '</h2>';
        // On ajoute ensuite l'image.
        elem.appendChild(this);
    }

    ImagesManager = {
        // Liste d'images
        images : [],

        type : 'xml', // Type de la réponse AJAX

        url : '/images/getListe', // URL où sera envoyer la requête AJAX

        // Fonction à executer après la requête ajax
        // et l'instanciation de toutes les Images.
        afterLoad : function() {},

        /* 
         * Lance une requête ajax et fait appel à la fonction
         * initImages en utilisant le résultat de la requête
         * comme paramètre.
         * @param Function func Fonction a appeler après avoir
         *        instancier les images.
         */
        load : function(func) {
            if(func !== undefined) ImagesManager.afterLoad = func;

            $.ajax({
                'type' : 'GET',
                'url'  : ImagesManager.url,
                'dataType' : ImagesManager.type,
                'data' : {}
            })
            .done(ImagesManager.initImages)
            .fail(function(){ alert('Une erreur est survenue !') } );
        },

        /**
         * Récupère la réponse et instance chaque image
         * une par une en les ajoutant dans le tableau
         * images.
         * @param JSON data Contient les données.
         */
        initImages : function(data) {
            ImagesManager.images = [];
            if(ImagesManager.type == 'json') ImagesManager.parseJSON(data);
            else ImagesManager.parseXML(data);
            ImagesManager.afterLoad();
        },

        /**
         * Décompose la réponse de type JSON afin d'instancier
         * les images qu'elle contient
         */
        parseJSON : function(jason) {
            for(var i in jason) {
                var image = new Image();
                image.src = jason[i].lien;
                image.name = jason[i].titre;
                image.title = jason[i].titre;
                ImagesManager.images.push(image);
            }
        },

        /**
         * Décompose la réponse de type XML afin d'instancier
         * les images qu'elle contient.
         */
        parseXML : function (xml) {
            var images = xml.getElementsByTagName('image')

            for(var i in images) {
                if(images[i].childNodes == undefined) continue;

                var image = new Image();
                image.src = images[i].childNodes[1].textContent;
                image.name = images[i].childNodes[0].textContent;
                image.title = images[i].childNodes[0].textContent;
                ImagesManager.images.push(image);
            }
        }
    }

    ImagesViewer = {
        // Image en train d'être regardée.
        current : 0,
        // Pointeur sur le timer.
        timeout : null,
        // Bloc où doit être affiché l'image.
        bloc : null,
        // Temps d'attente avant le changement de l'image.
        timeToWait : 5, // 5 seconds


        /**
         * Par défaut, la réponse sera de type xml.
         * @arg type Contient le type de réponse à utiliser.
         */
        init : function(type) {
            if(type != 'json') {
                ImagesViewer.initXML();
            } else {
                ImagesViewer.initJSON();
            }
        },

        initXML : function() {
            // Type de la réponse AJAX
            ImagesManager.type = 'xml';
            // URL où sera envoyer la requête AJAX
            ImagesManager.url =  '/images/liste.xml';
        },
        initJSON : function() {
            // Type de la réponse AJAX
            ImagesManager.type = 'json'; 
            // URL où sera envoyer la requête AJAX
            ImagesManager.url = '/images/liste.json';
        },

        /**
         * Chargement et affichage des images.
         */
        show : function() {
            ImagesManager.load(ImagesViewer.start);
        },

        /**
         * Affichage des images
         */
        start : function() {
            if(ImagesViewer.timeout !== null) ImagesViewer.clearTimeout();

            if(ImagesManager.images.length == 0) {
                alert('Aucune image n\'existe dans la base de données'); return;
            }

            ImagesViewer.current = ImagesManager.images.length - 1;
            ImagesViewer.next();
            ImagesViewer.initTimeout();
        },

        /**
         * Supprime le timer
         */
        clearTimeout : function() {
            clearInterval(ImagesViewer.timeout);
            ImagesViewer.timeout = null;
        }, 

        /**
         * Réinitialise le time
         */
        initTimeout : function() {
            if(ImagesViewer.timeout != null) ImagesViewer.clearTimeout();
            ImagesViewer.timeout = setInterval(
                function(){ ImagesViewer.next() }, 
                ImagesViewer.timeToWait * 1000
            );
        },

        /**
         * Stop le changement d'image automatique
         */
        stop : function() {
            ImagesViewer.clearInterval();
        },

        /**
         * Affiche l'image suivante.
         */
        next : function() {
            ImagesViewer.current = (ImagesViewer.current + 1) % ImagesManager.images.length;
            ImagesManager.images[ImagesViewer.current].show(ImagesViewer.bloc);
        },

        /**
         * Affiche l'image précédante.
         */
        prev : function() {
            ImagesViewer.current = (ImagesViewer.current - 1) % ImagesManager.images.length;
            if(ImagesViewer.current < 0) ImagesViewer.current = (ImagesViewer.current + ImagesManager.images.length) % ImagesManager.images.length
            ImagesManager.images[ImagesViewer.current].show(ImagesViewer.bloc);
        },

        /**
         * Affiche l'image suivante et réinitialise le timer.
         */
        boutonNext : function() {
            ImagesViewer.clearTimeout();
            ImagesViewer.next();
            ImagesViewer.initTimeout();
            
            return false;
        },

        /**
         * Affiche l'image précédente et réinitialise le timer.
         */
        boutonPrev : function() {
            ImagesViewer.clearTimeout();
            ImagesViewer.prev();
            ImagesViewer.initTimeout();

            return false;
        }
    }

    // Utilisation du XML
    ImagesViewer.init(false ? 'xml' : 'json');

    // Pointeur sur le bloc où sera afficher les images.
    ImagesViewer.bloc = document.getElementById('image_show');

    // On lance le chargement et l'affichage des images.
    ImagesViewer.show();
</script>