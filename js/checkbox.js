function tempo() 
{
   var done = false;
   var start = new Date().getTime();
   var tempMax = 10;

   if(tempMax < start){
   //toggle(this);
      //document.getElementById('depart').checked = false;
      //document.getElementById(depart).onclick = toggle(this);
      toggle(this);
   }
}
window.onload = tempo;

function toggle(source) {
  
  checkboxes = document.getElementsByName('foo');
  var allCheck;

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
  for(var i=0, n=checkboxes.length;i<n;i++) {
    allCheck = checkboxes[i].getAttribute("id")
    check(allCheck);
  }
}

function check(namefunc) {
   var check = document.getElementById(namefunc).checked;
   //alert(check);

   var className = document.getElementsByClassName(namefunc);
   //alert(className.length);
   if(check == true)
   {
      for (var i =0; i < className.length; i++) {
        className[i].setAttribute("id", "draggable");
        className[i].setAttribute("draggable", "true");
        //className[i].setAttribute("style", "background-color:blue;");

      }
    }
   else
   {
    //for (var i = className.length; i >= 0; i--) {
    for (var i =0; i < className.length; i++) {
      //alert(className.length);
        className[i].setAttribute("id", "NonDraggable");
        className[i].setAttribute("draggable", "false");
        //className[i].setAttribute("style", " ");
      }
   }
}

/*
function check(name) {

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

}
*/

var OldRadioName = "undefined";
//alert(OldRadioName);

function radioToCheckbox(nameEns) {
   var RadioName = nameEns;
   //alert(RadioName);
  // alert(OldRadioName);
   if(RadioName !== OldRadioName) {
      document.getElementById(RadioName).checked = true;
      document.getElementById(RadioName).onclick = check(RadioName);
      //check(RadioName);
      
      if(OldRadioName === "undefined"){
        // alert("undefined");
      }
      else
      {
         document.getElementById(OldRadioName).checked = false;
         //alert(document.getElementById(OldRadioName).id);
         document.getElementById(OldRadioName).onclick = check(OldRadioName);
        
      }
   } 
   else 
   {

   }
   OldRadioName = nameEns;
}

function panel(cont) {
  var date = cont.getAttribute('data-date');
  var contrainte = cont.getAttribute('data-cont');
  var moment = cont.parentNode.className;

  if(moment == "a-midi"){
    moment = "après-midi";
  }
  if(moment == "matin"){
    moment = "matin";
  }

  var day = cont.getAttribute('data-day');

  /*var stringDay;

  switch (day) {
  case 1: stringDay = "Lundi";
    break;
  case 2: stringDay = "Mardi";
    break;
  case 3: stringDay = "Mercredi";
    break;
  case 4: stringDay = "Jeudi";
    break;
  case 5: stringDay = "Vendredi";
    break;
  case 6: stringDay = "Samedi";
    break;
  case 7: stringDay = "Dimanche";
    break;
  default: break;
  }*/

  //alert(date);

  
  var inter1 = cont.childNodes;
  /*for (var i = 0; i < inter1.length;  i++) {
    alert(inter1[i]);
  };*/
  var interName1 = "None";
  var interName2 = "None";
  var matName1 = "None";
  var matName2 = "None";
  //alert(inter1.length);

  if( inter1.length == 3){
    var inter1_1 = inter1[1].getAttribute('data-intername');
    var mat1_1 = inter1[1].innerHTML;
    //alert(mat1_1);
    //alert(inter1_1);
    matName1 = mat1_1;
    interName1 = inter1_1;
    //alert(matName1);
  } else if (inter1.length == 5){
    var inter1_1 = inter1[1].getAttribute('data-intername');
    interName1 = inter1_1;
    var mat1_1 = inter1[1].innerHTML;
    matName1 = mat1_1;
    //alert(matName1);

    var inter2_1 = inter1[3].getAttribute('data-intername');
    interName2 = inter2_1;
    var mat2_1 = inter1[3].innerHTML;
    matName2 = mat2_1;
  }


  document.getElementById("panel_date").innerHTML = date;
  document.getElementById("panel_date_entier").innerHTML = day + " " + decomposeDate(date);
  document.getElementById("panel_cont").innerHTML = contrainte;
  document.getElementById("panel_mom").innerHTML = moment;

  document.getElementById("panel_inter_1").innerHTML = interName1;
  document.getElementById("panel_inter_2").innerHTML = interName2;

  document.getElementById("panel_cour_1").innerHTML = matName1;
  document.getElementById("panel_cour_2").innerHTML = matName2;
}

function decomposeDate(date) {
  var date;
  //alert(date);
  var dateTab = [...date];
  //2015-10-19
  //alert(dateTab);

  var stringMonth = dateTab[5] + dateTab[6];
  //alert(stringMonth);

  var monthWrite;

  switch (stringMonth) {
  case '01': monthWrite = "Janvier";
    break;
  case '02': monthWrite = "Février";
    break;
  case '03': monthWrite = "Mars";
    break;
  case '04': monthWrite = "Avril";
    break;
  case '05': monthWrite = "Mai";
    break;
  case '06': monthWrite = "Juin";
    break;
  case '07': monthWrite = "Juillet";
    break;
  case '08': monthWrite = "Août";
    break;
  case '09': monthWrite = "Septembre";
    break;
  case '10': monthWrite = "Octobre";
    break;
  case '11': monthWrite = "Novembre";
    break;
  case '12': monthWrite = "Décembre";
    break;
  default: break;
  }

  //alert(monthWrite);
  var stringYear = dateTab[0] + dateTab[1] + dateTab[2] +dateTab[3]
  var stringDay = dateTab[8] + dateTab[9]

  var stringFinal = stringDay + " " + monthWrite + " " + stringYear;
  //alert(stringFinal);
  return stringFinal;
}