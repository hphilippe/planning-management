(function() {

    function ajouter_seance(zone,mat,divHeure){//fonction qui envoi la seance ajoutée au script php pour son enregistrement dans
        var sem=zone.getAttribute('data-sem'),
            date=zone.getAttribute('data-date'),
            day=zone.getAttribute('data-day'),
            moment=zone.parentNode.getAttribute('class'),
            inter=mat.getAttribute('data-dir'),
            num=mat.getAttribute('data-mat'),
            heure=mat.getAttribute('data-heure'),
            annee=mat.getAttribute('data-an'),
            xhr= new XMLHttpRequest();
        //envoi de la requette AJAX
        xhr.open('GET','ajax/ajouter_seance.php?inter='+inter+'&mat='+num+'&heure='+heure+'&annee='+annee+'&sem='+sem+'&date='+date+'&day='+day+'&moment='+moment);
        xhr.onreadystatechange= function(){
          if (xhr.readyState==4 && xhr.status==200) {
            //traitement de la reponse de la requette par la fonction list()
            list(xhr.responseText,mat,divHeure); 
          }
        };

        xhr.send(null);
      }

      function list(reponse, el, div){
        
        if (reponse.length) {
            reponse=reponse.split('|');
        //on ajoute un attribut data-id_seance dans l'element dropé
          el.setAttribute('data-id_seance',reponse[0]);
        //on modifie le nombre d'heure restant
          div.innerHTML=reponse[1];
        }
      }

      function supprimer_seance(mat,divHeure){

        var seance=mat.getAttribute('data-id_seance'),
            inter=mat.getAttribute('data-dir'),
            num=mat.getAttribute('data-mat'),
            annee=mat.getAttribute('data-an'),
            xhr= new XMLHttpRequest();
        //envoi de la requette AJAX
        xhr.open('GET','ajax/supprimer_seance.php?id='+seance+'&mat='+num+'&inter='+inter+'&annee='+annee);
        xhr.onreadystatechange= function(){
          if (xhr.readyState==4 && xhr.status==200) {
            //traitement de la reponse de la requette par la fonction trait()
            //trait(xhr.responseText,divHeure);
            window.location.reload();
          }
        };

        xhr.send(null);

      }

    function trait(reponse, div){
        
        if (reponse.length) {

          //on modifie le nombre d'heure restant
          div.innerHTML=reponse[0];
        }
      }

    var dndHandler = {

        draggedElement: null, // Propriété pointant vers l'élément en cours de déplacement

        applyDragEvents: function(element) { //-------- évènement lorsque l'élément est prit ----------- 

            element.draggable = true; // lorsque l'élément est prit

            var dndHandler = this; // Cette variable est nécessaire pour que l'événement « dragstart » ci-dessous accède facilement au namespace « dndHandler »

            element.addEventListener('dragstart', function(e) {
                dndHandler.draggedElement = e.target; // On sauvegarde l'élément en cours de déplacement
                e.dataTransfer.setData('text/plain', ''); // Nécessaire pour Firefox
                //alert("okee");
            });

        },

        applyDropEvents: function(dropper) { //-------- évènement lorsque l'élément est déposer ou est dans la zone d'un container ----------- 

            dropper.addEventListener('dragover', function(e) { // lorsqu'on est au-dessus de la zone de drop
                e.preventDefault(); // On autorise le drop d'éléments
                // this.id = 'dropper drop_hover'; // Et on applique le style adéquat à notre zone de drop quand un élément la survole

                var target = e.target,
                draggedElement = dndHandler.draggedElement, // Récupération de l'élément concerné
                clonedElement = draggedElement.cloneNode(true); // On créé immédiatement le clone de cet élément

                while (target.id.indexOf('dropper') == -1) { // Cette boucle permet de remonter jusqu'à la zone de drop parente
                    target = target.parentNode;
                }

                if(target.className != "dropperOut"){ // si l'élément  n'est pas déposer dans une zone de container appeler dropperOut qui est la corbeille
                    target.id = 'dropper';
                    var nbDraggable = target.querySelectorAll('#dropper #draggableThrow').length; // on compte le nombre d'élément draggable dans la zone de container

                    if(nbDraggable == 0){ // on applique les id et class sur la zone de drop suivant le nombre d'élément présent dans la zone de drop
                        target.className = "none"; 
                        this.id = 'dropper';
                    } else if(nbDraggable == 1) {
                        target.className = "dragN1";
                        this.id = 'dropper';
                    } else if (nbDraggable == 2) {
                         target.className = "dragN2";
                         this.id = 'dropper2';
                    }
                }

            });

            dropper.addEventListener('dragleave', function(e) { // lorsque l'élément sort de la zone de drop
                //this.id = 'dropper'; // On revient au style de base lorsque l'élément quitte la zone de drop

                var target = e.target,
                draggedElement = dndHandler.draggedElement, // Récupération de l'élément concerné
                clonedElement = draggedElement.cloneNode(true); // On créé immédiatement le clone de cet élément

                while (target.id.indexOf('dropper') == -1) { // Cette boucle permet de remonter jusqu'à la zone de drop parente
                    target = target.parentNode;
                }

                if(target.className == "dragN2"){
                    target.id = 'dropper2'; 
                }else{
                     target.id = 'dropper'; 
                }

            });

            var dndHandler = this; // Cette variable est nécessaire pour que l'événement « drop » ci-dessous accède facilement au namespace « dndHandler »

            dropper.addEventListener('drop', function(e) { // lorsque l'élément est droper dans la zone de drop

                var target = e.target,
                draggedElement = dndHandler.draggedElement, // Récupération de l'élément concerné
                clonedElement = draggedElement.cloneNode(true); // On créé immédiatement le clone de cet élément
                clonedElement.id = "draggableThrow";
                clonedElement.className ="NoClass"

                while (target.id.indexOf('dropper') == -1) { // Cette boucle permet de remonter jusqu'à la zone de drop parente
                    target = target.parentNode;
                }

                if(target.className == "none" && draggedElement.id == "draggable" && target.getAttribute('data-cont') != "impossible")
                {

                target.id = 'dropper'; // Application du style par défaut
                target.className = "dragN1";

                var div=draggedElement.parentNode.nextSibling;
                //appel à la fonction d'ajout de seance(AJAX)
                ajouter_seance(target,clonedElement,div);

                clonedElement = target.appendChild(clonedElement); // Ajout de l'élément cloné à la zone de drop actuelle
                dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                }
                else if (target.className == "dragN1" && draggedElement.id == "draggable" && target.getAttribute('data-cont') != "impossible")
                {

                target.id = 'dropper2'; // Application du style par défaut
                target.className = "dragN2";

                var div=draggedElement.parentNode.nextSibling;
                //appel à la fonction d'ajout de seance(AJAX)
                ajouter_seance(target,clonedElement,div);

                clonedElement = target.appendChild(clonedElement); // Ajout de l'élément cloné à la zone de drop actuelle
                dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                }


                var radio = document.getElementsByClassName("intervenant");
                /*for (var i = 0; i <= 20; i++) {
                    alert(radio[i].checked);
                };*/
                for (var i = 0; i < radio.length; i++) { 
                    if(radio[i].checked == true){
                        //alert(i);
                        var id_inter = radio[i].getAttribute('data-inter');
                        //alert(id_inter);
                        //var numI  = i;
                        //alert(id_inter);
                    }
                }
                
                /*if(radio == true){
                    var id_inter = document.getAttribute("data-inter", "9");
                    alert(id_inter);
                    var check = this.getElementsByClassName("intervenant")[id_inter];
                    alert(check);
                }*/

                //alert(draggedElement.getAttribute('data-dir'));

                if(target.className == "none" && clonedElement.id == "draggableThrow" && draggedElement.id != "draggable" && target.getAttribute('data-cont') != "impossible" && draggedElement.getAttribute('data-dir') == id_inter)
                {

                target.id = 'dropper'; // Application du style par défaut
                target.className = "dragN1";

                var div=draggedElement.parentNode.nextSibling;
                //appel à la fonction d'ajout de seance(AJAX)
                ajouter_seance(target,clonedElement,div);

                clonedElement = target.appendChild(clonedElement); // Ajout de l'élément cloné à la zone de drop actuelle
                dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                 //appel de la fonction de suppression de seance
                supprimer_seance(draggedElement);

                draggedElement.parentNode.removeChild(draggedElement); // Suppression de l'élément d'origine

                }
                else if (target.className == "dragN1" && clonedElement.id == "draggableThrow" && draggedElement.id != "draggable" && target.getAttribute('data-cont') != "impossible" && draggedElement.getAttribute('data-dir') == id_inter)
                {

                target.id = 'dropper2'; // Application du style par défaut
                target.className = "dragN2";

                clonedElement = target.appendChild(clonedElement); // Ajout de l'élément cloné à la zone de drop actuelle
                dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                draggedElement.parentNode.removeChild(draggedElement); // Suppression de l'élément d'origine

                }

                //var dragSource = document.getElementById("draggable").parentNode.nodeName;
                //alert(dragSource);

                if(target.className == "dropperOut" && clonedElement.id == "draggableThrow" && draggedElement.id != "draggable")
                {   
                    //alert(clonedElement.id);
                    //alert(draggedElement.id);

                     //appel de la fonction de suppression de seance
                    supprimer_seance(draggedElement);
                    draggedElement.parentNode.removeChild(draggedElement); // Suppression de l'élément d'origine
                }

            });

        }

    };

    var elements = document.querySelectorAll('#draggable'),
        elementsLen = elements.length;

    for (var i = 0; i < elementsLen; i++) {
        dndHandler.applyDragEvents(elements[i]); // Application des paramètres nécessaires aux éléments déplaçables
    }

        var elements = document.querySelectorAll('#draggableThrow'),
        elementsLen = elements.length;

    for (var i = 0; i < elementsLen; i++) {
        dndHandler.applyDragEvents(elements[i]); // Application des paramètres nécessaires aux éléments déplaçables
    }

    var droppers = document.querySelectorAll('#dropper'),
        droppersLen = droppers.length;

    for (var i = 0; i < droppersLen; i++) {
        dndHandler.applyDropEvents(droppers[i]); // Application des événements nécessaires aux zones de drop
    }

})();


/*function check(name) {

   //var  labelName = name;

   var check = document.getElementById(name).checked;

   var className = document.getElementsByClassName(name);

   if(check == true)
   {
    className[0].setAttribute("id", "draggable");
    className[0].setAttribute("draggable", "true");
   }
   else
   {
    className[0].setAttribute("id", "NonDraggable");
    className[0].setAttribute("draggable", "false");
   }

}*/
