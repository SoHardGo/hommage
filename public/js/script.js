document.addEventListener('DOMContentLoaded', function() {

///////////////////Gestion du menu Hamburger////////////////////////////////////
//
// Ouverture et fermeture du Menu de navigation
// En ajoutant ou supprimant une class

let nav = document.getElementById("nav");
let navBarOpen = document.getElementById("nav__bar-open");
let navBarClose = document.getElementById("nav__bar-close");

navBarOpen.addEventListener('click',function(){
    nav.classList.add("status");
});
navBarClose.addEventListener('click',function(){
    nav.classList.remove("status");
});

///////////////////////Photo de profil utilisateur//////////////////////////////
//
// Soumission du formulaire après sélection d'une image
// En cliquant sur l'icone Camera

let photoProfil = document.querySelector('.user__icon');
let changeProfil = document.getElementById('photo_user');
if (photoProfil !== null){
    photoProfil.addEventListener('click', function(){
        changeProfil.click();
        changeProfil.addEventListener('change', function(){
            document.getElementById('form_user').submit();
        });
    });
}

///////////////////////Photo de profil defunt///////////////////////////////////
//
// Soumission du formulaire après sélection d'une image
// En cliquant sur l'icone Camera

let photoDef = document.querySelector('.user_icon_def');
let changeDef = document.getElementById('modify__photo');
if (photoDef !==null){
    photoDef.addEventListener('click', function(){
        changeDef.click();
        changeDef.addEventListener('change', function(){
            document.getElementById('modifydefform').submit();
        });
    });
}

////////////////Gestion du lien de l'adresse de chaque fiche////////////////////
//
// Vérification si l'élément existe dans le DOM et renvoi la valeur en Booléen
// Si elle n'existe pas, création dans le DOM de la "div" avec sa "class"
// Création du Texte que contiendra la "div"
// Insertion du texte dans la "div"
// Si elle existe, ajout de la class "hidden" pour la faire disparaître
//
let link = document.querySelector('.env__link_img');
let parentLink = document.querySelector('.env__link');

if (link!=null){
    link.addEventListener('click', (e)=>{
        e.preventDefault();
        let verify = !!document.querySelector('.env__new_link');
        if (verify === false){
            let linkDiv = document.createElement('div');
            linkDiv.setAttribute('class', 'env__new_link');
            let linkTxt =document.createTextNode('Adresse à copier pour vos proches :\n'+link.href);
            linkDiv.appendChild(linkTxt);
            parentLink.appendChild(linkDiv);
        } else {
            let link_p = document.querySelector('.env__new_link');
            link_p.classList.toggle('hidden');
        }
    });
}

///////////Gestion du bouton de liste des defunts du menu fiche/////////////////
//
// Affichage du sous menu du bouton "Fiche"

let button = document.querySelector('.user__myDefuncts');
let container = document.querySelector('.user__list_defuncts');
if (button !== null){
    button.addEventListener('click', function(){
        container.classList.toggle('hidden');
    });
}

//////////////Gestion des photos dans l'espace environnement////////////////////
//
// Soumission du formulaire après sélection d'une image
// En cliquant sur l'icone Appareil Photo

let camera = document.querySelector('.env__add_photo');
let file = document.getElementById('file_env');
if (camera !== null){
    camera.addEventListener('click', function(){
        file.click();
        file.addEventListener('change', function(){
            document.getElementById('form_env').submit();
        });
    });
}

//////////////// Gestion des commentaires //////////////////////////
//
// Gestion de l'ajout d'un commentaire dans l'environnement du défunt
// Soumission du formulaire après chaque appui sur la touche "Entrée"
// Identification du parent du formulaire
// Identification des différentes "class" contenu dans le formulaire
// Création d'une instance de l'objet Formdata
// Ajout des clés/valeurs dans le Formdata
// Création d'une requête "fetch"
// Récupération de la réponse au format texte
// Test si le fichier de profil existe ou pas
// Insertion du commentaire avec photo de profil de l'utilisateur dans le DOM

let commentEnv = document.querySelectorAll('.env__comment_form');

if (commentEnv != null) {
    for (let i of commentEnv) {
        i.addEventListener('submit', function(e) {
            e.preventDefault();
            let comDiv = this.parentNode.querySelector('.env__comment');
            let comment = this.querySelector('.env__comment_txt');
            let idDef = this.querySelector('.id_def');
            let photoId = this.querySelector('.photo_id');
            let userId = this.querySelector('.user_id');

            let formdata = new FormData();
            formdata.append('comment',comment.value);
            formdata.append('id_def',idDef.value);
            formdata.append('photo_id',photoId.value);
            formdata.append('user_id',userId.value);

            let obj ={ 'method':'POST', 'body' :formdata};
            fetch('ajax/recordComment.php',obj)
            .then(response => response.text()) 
            .then(data=>{

                let image='';
                let url='public/pictures/users/'+userId.value+'/photo'+userId.value+'.jpg';
                let http=new XMLHttpRequest();
                http.open("HEAD",url,false);
                http.send();
                if (http.status !== 404){                                   
                    image='public/pictures/users/'+userId.value+'/photo'+userId.value+'.jpg';
                } else {
                    image='public/pictures/site/noone.jpg'; 
                }
                http.onerror = console.clear();
                let content = '<div class="container_com_user"><div class="env__profil"><img class="img" src="'+image+'" ></div><div class="comment_post">'+comment.value+'</div><div class="icon_delete"><a class ="env__user_name" href="index.php?page=environment&id='+userId.value+'&idCom='+data+'" title="Supprimer"><i class="fas fa-trash-alt"></i></a></div>';
                if (comment.value != '') {
                    comDiv.innerHTML += content;
                }
                comment.value = '';
            })
            .catch(err=>console.error(err)); 
            
        });
    }
}

/////////////////Dossier des photos d'un defunt/////////////////////////////////

let listPhoto = document.querySelector('.env__folder_link');
let folder = document.querySelector('.env__photos_list');
if (listPhoto != null){
listPhoto.addEventListener('click', function(e){
    e.preventDefault();
    folder.classList.toggle('hidden');
});
}
/////////////////Gestion de l'éditeur de Cartes/////////////////////////////////
//
// Exécution d'un "addEventLister" sur chaque élement définit par 
// les class "card_edit" (les boutons de l'éditeur)
// Récupération de l'attribut correspondant au bouton sélectionné
// Exécution de la commande qui affectera l'élement texte sélectionné

const elements = document.querySelectorAll('.card__edit');

    elements.forEach( element =>{
        element.addEventListener('click', ()=>{
        let command = element.getAttribute('data-element');
        document.execCommand(command,false,null);
        });
    });


/////////////////////////Recherche Insee////////////////////////////////////////
//
// Utilisation de l'API de l'INSEE, point d'entrée (endpoint)->https://insee.arbre.app
// Avec retour au format JSON
// Retour de la requête effectué par "Nom" (min 3 lettres)
// Affichage dans un "select"


let name = document.getElementById('lastname_insee');
let myDiv = document.querySelector('.search__result_insee');

if ( name != null){
name.addEventListener('keyup', ()=> {
    let search = name.value;
        if (search.length>3) {
            fetch('https://insee.arbre.app/persons?surname='+search)
            .then(response => response.json())
            .then(data=>{ 
                let nb = data.count;
                for (let i=0; i<nb; i+=10){
                    fetch('https://insee.arbre.app/persons?offset='+i+'&surname='+search)
                    .then(response => response.json())
                    .then(data=>{ 
                        for (let i of data.results) {
                            myDiv.innerHTML += "<option value="+i+">"+i.prenom+"  -Né(e) le : "+i.birthDate+"<p>-Décédé(e) le : "+i.deathDate+"-  à : "+i.deathPlace+"</p></option>";
                        }
                    })
                    .catch(err=>console.error(err));
                }
                })
            .catch(err=>console.error(err));
        }
});
}

//////////////////Récupération du texte d'une carte ////////////////////////////

let editBtn = document.getElementById('card__val'); // bouton "confirmer"
let content = document.querySelector('.content');   // contenu du texte

if (editBtn != null){
    editBtn.addEventListener('click',()=>{
        let cardText = content.textContent;                               // contenu du texte
        let cardId = document.getElementById('card__id').innerHTML;       // id de la carte sélectionné
        let cardNb = document.getElementById('card__nb');                 // span où s'affiche le nombre de cartes
        let containerTab = document.getElementById('card__container_tab');// tableau
        let total = document.getElementById('card__total');                // total du tableau
        
        let formdata = new FormData();
        formdata.append('content', cardText);
        formdata.append('card_id', cardId);

        let obj = { 'method':'POST', 'body':formdata };
        fetch('ajax/recordCard.php', obj)                                  
                        .then(response => response.json())
                        .then(data=>{
                            cardNb.innerHTML = data.carte;
                            containerTab.innerHTML += data.tab;
                            total.innerHTML = data.total;
                        })
                        .catch(err=>console.error(err));
        });
}

////////////////////////Gestion des bouquets de fleurs//////////////////////////
// Stockage des choix validés par les "checkbox" dans le "sessionStorage"

sessionStorage.clear();

let flowerContent =document.getElementById('flower__container_tab');
let flowerId=document.querySelectorAll('.flower_id');
let divTotal = document.querySelector('.flower__total');

if (flowerId!=null){
    for (let i=0; i<flowerId.length;i++){               // bouton checkbox
       flowerId[i].addEventListener('click',detect);
    }
}
// fonction détection de la sélection des bouquets et stockage dans le localStorage
function detect(e){

    let local=JSON.parse(sessionStorage.getItem('bouquet')) || [];
    if (e.target.checked){
        local.push({'id':e.target.value});
        sessionStorage.setItem('bouquet',JSON.stringify(local));
    } else {
        let findId=local.find(key => e.target.value);  
        let newArray=local.filter((key)=>key.id !== findId.id);
        sessionStorage.setItem('bouquet',JSON.stringify(newArray));
    }
    
    let formdata = new FormData();
    formdata.append('flower_id', sessionStorage.getItem('bouquet'));
    let obj = { 'method':'POST', 'body':formdata };
    fetch('ajax/recordFlower.php', obj)
                    .then(response => response.json())
                    .then(data=>{
                        let total = 0;
                        flowerContent.innerHTML ='';
                        for (let i=0; i<data.length; i++){
                             flowerContent.innerHTML += '<tr><td>'+data[i].info+'</td><td>'+data[i].price+' €</td></tr>';
                             total += parseInt(data[i].price);
                        }
                        divTotal.innerHTML = total+'  €';
                    })
                    .catch(err=>console.error(err));
}


////////////////////////Gestion des nouvelles photos////////////////////////////

let newPhotos = document.querySelector('.new_photos');
let containerLastPhoto = document.querySelector('.container_lastP');
if (newPhotos != null){
    newPhotos.addEventListener('click',()=>{
    containerLastPhoto.classList.toggle('hidden');
    });
}

/////////////Message d'Alerte pour la suppression de photo/////////////////////////
// Utilisation de la boîte "confirm" du navigateur

let deletePhoto = document.getElementsByClassName('env__delete_photo');
if (deletePhoto!=null) {
    for (let d of deletePhoto) {
        d.addEventListener('click', function(e) {
            e.preventDefault();
            if (window.confirm("Attention les commentaires liés à cette photo seront également supprimés !!!")) {
                window.location.href = this.href;
            }
        });
    }
}

/////////////////////////Dossier des contacts///////////////////////////////////

let linkContact = document.getElementById('contacts');
let folderContact = document.querySelector('.home_user__contact_list');
if (linkContact!=null){
    linkContact.addEventListener('click',function(e){
        e.preventDefault;
        folderContact.classList.toggle('hidden');
    });
}


///////////////////////Gestion des demandes d'amis//////////////////////////////
// Affichage d'un formulaire pour chaque demande d'ami

let btnFriend = document.getElementById('newFriend');
let askFriend = document.querySelector('.user__ask_friend');

if (btnFriend!=null){
    btnFriend.addEventListener('click', (e)=>{
        e.preventDefault();
        let numberFriend = document.querySelector('.number_f').innerHTML;
        if (numberFriend !=0){
            let userId = document.querySelector('.user__ajax').innerHTML; // récupération de l'Id de l'utilisateur
            let test = document.getElementById('newFriend').getElementsByClassName('icon_anim');
            if (test){
                let formdata = new FormData();
                formdata.append('user_id', userId);
                let obj = { 'method':'POST', 'body':formdata };
                
                fetch('ajax/friendsList.php', obj)
                                .then(response => response.json())
                                .then(data=>{
                                let count = data.length;
                                if (count > 0 ) {
                                    for (let i=0; i<count; i++){
                                         if (data[i].validate === 3){
                                        askFriend.innerHTML += '<form method="POST" action="?page=home_user&id_friend='+data[i].user_id+'"><label>Acceptez-vous la demande d\'ami de '+data[i].lastname+' '+data[i].firstname+' ?</label>Oui<input type="radio" name="friend" value="1">Non<input type="radio" name="friend" value="2"><br><input class="button" type="submit" name="submit" value="Valider"></form>';
                                        }
                                    }
                                }
                                })
                                .catch(err=>console.error(err));
            }
        }
    });
}

///////////////////////Gestion des messages du chat/////////////////////////////
// Récupération et Réinjection des messsages

let form = document.querySelector('.tchat__form');

if (form != null){
    form.addEventListener('submit',(e)=>{
        e.preventDefault();
        let tchat = document.getElementById('content_tchat'); 
        let friendId = document.querySelector('.friend_id');
        let myContent = document.getElementById('tchat__my_content');
        let tchatContainer = document.querySelector('.tchat__container');
        
        let formdata = new FormData();
        if (tchat.value!==''){
            formdata.append('content', tchat.value); 
            formdata.append('friend_id',friendId.value);
            let obj = { 'method':'POST', 'body':formdata };
            
            fetch('ajax/recordTchat.php', obj)
                            .then(response => response.json())
                            .then(data=>{
                                tchat.value = '';
                                tchat.focus();
                                myContent.innerHTML = '';
                                let count = data.length;
                                if (count > 0) {
                                        for (let i=0; i<count; i++){
                                            if (data[0].user_id != data[i].friend_id){
                                                myContent.innerHTML += '<div class="tchat__return">'+data[i].content+'</div><p class="tchat__date">'+data[i].date_crea+'</p>';
                                            } else {
                                                myContent.innerHTML += '<div class="tchat__friend">'+data[i].content+'</div><p class="tchat__date">'+data[i].date_crea+'</p>';
                                            }
                                        }
                                }
                                tchatContainer.scrollTop=tchatContainer.scrollHeight;
    
                            }) 
                            .catch(err=>console.error(err));
        }
    });
}

/////////////////////////////Slider/////////////////////////////////////////////
// Slider en JQuery

$(document).ready(function(){
      $('.slider').slick({
        autoplay: true,
        autoplaySpeed:1500,
        dots: true,
        infinite: true,
        centerMode: true,
        vertical: false,
        arrows: false,
        mobileFirst: true,
          responsive: [
              {
              breakpoint: 1600,
              settings: {
                slidesToShow: 6,
                slidesToScroll: 6
              }
            },
              {
              breakpoint: 1280,
              settings: {
                slidesToShow: 5,
                slidesToScroll: 5
              }
            },
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3
              }
            },
            {
              breakpoint: 481,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            }]
        });
});




});
  
		