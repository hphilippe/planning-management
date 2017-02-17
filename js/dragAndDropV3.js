(function() {

    var dndHandler = {

        draggedElement: null, // Propriété pointant vers l'élément en cours de déplacement

        applyDragEvents: function(element) {

            element.draggable = true;

            var dndHandler = this; // Cette variable est nécessaire pour que l'événement « dragstart » ci-dessous accède facilement au namespace « dndHandler »

            element.addEventListener('dragstart', function(e) {
                dndHandler.draggedElement = e.target; // On sauvegarde l'élément en cours de déplacement
                e.dataTransfer.setData('text/plain', ''); // Nécessaire pour Firefox
            });

        },

        applyDropEvents: function(dropper) {

            dropper.addEventListener('dragover', function(e) {
                e.preventDefault(); // On autorise le drop d'éléments
                // this.id = 'dropper drop_hover'; // Et on applique le style adéquat à notre zone de drop quand un élément la survole

                var target = e.target,
                draggedElement = dndHandler.draggedElement, // Récupération de l'élément concerné
                clonedElement = draggedElement.cloneNode(true); // On créé immédiatement le clone de cet élément

                while (target.id.indexOf('dropper') == -1) { // Cette boucle permet de remonter jusqu'à la zone de drop parente
                    target = target.parentNode;
                }

                if(target.className != "dropperOut"){
                    target.id = 'dropper';
                    var nbDraggable = target.querySelectorAll('#dropper #draggableThrow').length;

                    if(nbDraggable == 0){
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

            dropper.addEventListener('dragleave', function(e) {
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

            dropper.addEventListener('drop', function(e) {

                var target = e.target,
                draggedElement = dndHandler.draggedElement, // Récupération de l'élément concerné
                clonedElement = draggedElement.cloneNode(true); // On créé immédiatement le clone de cet élément
                clonedElement.id = "draggableThrow";

                while (target.id.indexOf('dropper') == -1) { // Cette boucle permet de remonter jusqu'à la zone de drop parente
                    target = target.parentNode;
                }

                if(target.className == "none" && draggedElement.id == "draggable")
                {

                target.id = 'dropper'; // Application du style par défaut
                target.className = "dragN1";

                clonedElement = target.appendChild(clonedElement); // Ajout de l'élément cloné à la zone de drop actuelle
                dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                }
                else if (target.className == "dragN1" && draggedElement.id == "draggable")
                {

                target.id = 'dropper2'; // Application du style par défaut
                target.className = "dragN2";

                clonedElement = target.appendChild(clonedElement); // Ajout de l'élément cloné à la zone de drop actuelle
                dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                }


                if(target.className == "none" && clonedElement.id == "draggableThrow" && draggedElement.id != "draggable")
                {

                target.id = 'dropper'; // Application du style par défaut
                target.className = "dragN1";

                clonedElement = target.appendChild(clonedElement); // Ajout de l'élément cloné à la zone de drop actuelle
                dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                draggedElement.parentNode.removeChild(draggedElement); // Suppression de l'élément d'origine

                }
                else if (target.className == "dragN1" && clonedElement.id == "draggableThrow" && draggedElement.id != "draggable")
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

    var droppers = document.querySelectorAll('#dropper'),
        droppersLen = droppers.length;

    for (var i = 0; i < droppersLen; i++) {
        dndHandler.applyDropEvents(droppers[i]); // Application des événements nécessaires aux zones de drop
    }

})();