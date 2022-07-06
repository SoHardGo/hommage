document.addEventListener('DOMContentLoaded', function() {

///////////////////Gestion du menu Hamburger/////////////////////////////////

let mynav = document.getElementById("my_navbar");
let openburger = document.getElementById("open_burger");
let closeburger = document.getElementById("close_burger");

openburger.addEventListener('click',function(){
    mynav.classList.add("status");
});
closeburger.addEventListener('click',function(){
    mynav.classList.remove("status");
});

///////////////////////Photo de profil utilisateur////////////////////////////

let photo_profil = document.querySelector('.user_icon');
let input_profil = document.getElementById('photo_user');
if(photo_profil !== null){
photo_profil.addEventListener('click', function(){
    input_profil.click();
    input_profil.addEventListener('change', function(){
        document.getElementById('form_user').submit();
    });
});
}

///////////Gestion du bouton de liste des defunts du menu fiche//////////////

let button = document.querySelector('.button_myDefuncts');
let container = document.querySelector('.list_defuncts');
if(button !== null){
button.addEventListener('click', function(){
    container.classList.toggle('hidden');
});
}

//////////////Gestion des photos dans l'espace environnement/////////

let camera = document.querySelector('.camera');
let file = document.getElementById('file_env');
if(camera !== null){
    camera.addEventListener('click', function(){
        file.click();
        file.addEventListener('change', function(){
            document.getElementById('form_env').submit();
        });
    });
}

/////////////// Gestion des commentaires //////////////////////////

let comment_env = document.querySelectorAll('.comment_env');

if(comment_env != null) {
    for(let i of comment_env) {
        i.addEventListener('submit', function(e) {
            e.preventDefault();
            let com_div = this.parentNode.querySelector('.com_div');
            let comment = this.querySelector('.comment');
            let id_def = this.querySelector('.id_def');
            let photo_id = this.querySelector('.photo_id');
            let user_id = this.querySelector('.user_id');
            let lastname = this.querySelector('.lastname');
            let firstname = this.querySelector('.firstname');

            let formdata = new FormData();
            formdata.append('comment',comment.value);
            formdata.append('id_def',id_def.value);
            formdata.append('photo_id',photo_id.value);
            formdata.append('user_id',user_id.value);

            let obj ={ 'method':'POST', 'body' :formdata};
            fetch('ajax/recordComment.php',obj)
            .then(response => response.text()) 
            .then(data=>{
                let content = '<div class="container_com_user"><div class="profil"><a class ="env_user_name"><img class="img" src="public/pictures/users/'+user_id.value+'/photo'+user_id.value+'.jpg" ></a></div><div class="comment_post">'+'&emsp;'+comment.value+'</div><div class="icon_delete"><a class ="env_user_name" href="index.php?page=environnement&id='+user_id.value+'&idCom='+data+'" title="Supprimer"><i class="fas fa-trash-alt"></i></a></div>';
                if(comment.value != '') {
                    com_div.innerHTML += content;
                }
                comment.value = '';
            })
            .catch(err=>console.log(err)); 
            
        });
    }
}

/////////////////Dossier des photos d'un defunt/////////////////////////////////

let listPhoto = document.querySelector('.folder_link');
let folder = document.querySelector('.photos_list');
if(listPhoto != null){
listPhoto.addEventListener('click', function(e){
    e.preventDefault();
    folder.classList.toggle('hidden');
});
}
/////////////////Gestion de l'éditeur de Cartes/////////////////////////////////

const elements = document.querySelectorAll('.button_edit');

    elements.forEach( element =>{
        element.addEventListener('click', ()=>{
        let command = element.getAttribute('data-element');
        document.execCommand(command,false,null);
        });
    });


/************************Recherche Insee***************************************/
// recherche par le nom de famille
let nom = document.getElementById('lastname_insee');
let madiv = document.querySelector('.result_insee');

if ( nom != null){
nom.addEventListener('keyup', ()=> {
    let search = nom.value;
        if (search.length>3) {
            fetch('https://insee.arbre.app/persons?surname='+search)
            .then(response => response.json())
            .then(data=>{ 
                let nb = data.count;
                for(let i=0; i<nb; i+=10){
                    fetch('https://insee.arbre.app/persons?offset='+i+'&surname='+search)
                    .then(response => response.json())
                    .then(data=>{ 
                        for(let i of data.results) {
                            madiv.innerHTML += "<option value="+i+">"+i.prenom+"  -Né(e) le : "+i.birthDate+"  -Décédé(e) le : "+i.deathDate+"-  à : "+i.deathPlace+"</option>";
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

let edit_btn = document.getElementById('card_val'); // bouton confirmer
let content = document.querySelector('.content');   // contenu du texte

if (edit_btn != null){
    edit_btn.addEventListener('click',()=>{
        
        let card_text = content.textContent;                         // contenu du texte
        let card_id = document.getElementById('card_id').innerHTML;  // id de la carte sélectionné
        let card_nb = document.getElementById('card_nb');            // span où s'affiche le nombre de cartes
        let container_tab = document.getElementById('container_tab');// tableau
        let total = document.getElementById('total');                // total du tableau
        
        let formdata = new FormData();
        formdata.append('content', card_text);
        formdata.append('card_id', card_id);

        let obj = { 'method':'POST', 'body':formdata };
        
        fetch('ajax/recordCard.php', obj)
                        .then(response => response.json())
                        .then(data=>{
                            card_nb.innerHTML = data.carte;
                            container_tab.innerHTML += data.tab;
                            total.innerHTML = data.total;
                        })
                        .catch(err=>console.error(err));
        });
}

////////////////////////Gestion des nouvelles photos////////////////////////////

let new_photos = document.querySelector('.new_photos');
let container_lastP = document.querySelector('.container_lastP');
if (new_photos != null){
new_photos.addEventListener('click',()=>{
    container_lastP.classList.toggle('hidden');
});
}

/////////////Message d'Alerte pour la suppression de photo/////////////////////////

let delete_p = document.getElementsByClassName('delete_photo');
if(delete_p!=null) {
    for(d of delete_p) {
        d.addEventListener('click', function(e) {
            e.preventDefault();
            if (window.confirm("Attention les commentaires liés à cette photo seront également supprimés !!!")) {
                window.location.href = this.href;
            }
        });
    }
}

/////////////////////////Dossier des contacts///////////////////////////////////

let link_contact = document.getElementById('contacts');
let folder_contact = document.querySelector('.contacts_list');
if(link_contact!=null){
    link_contact.addEventListener('click',function(e){
        e.preventDefault;
        folder_contact.classList.toggle('hidden');
    });
}

///////////////////////Gestion des demandes d'amis//////////////////////////////

let btn_friend = document.getElementById('newFriend');
let ask_friend = document.querySelector('.ask_friend');

if(btn_friend!=null){
    btn_friend.addEventListener('click', (e)=>{
        e.preventDefault();
        let user_id = document.querySelector('.ajax_id').innerHTML; // récupération de l'Id de l'utilisateur
        let test = document.getElementById('newFriend').getElementsByClassName('icon_anim');
        if (test){
            let formdata = new FormData();
            formdata.append('user_id', user_id);
            let obj = { 'method':'POST', 'body':formdata };
            
            fetch('ajax/friendList.php', obj)
                            .then(response => response.json())
                            .then(data=>{
                                console.log(data);
                                let count = data.length;
                                console.log(count);
                                if (count > 0 ) {
                                    for (let i=0; i<count; i++){
                                        ask_friend.innerHTML='<form method="POST" action="?page=home_user&id_friend='+data[i].user_id+'"><label>Acceptez-vous la demande d\'ami de '+data[i].lastname+' '+data[i].firstname+' ?</label>Oui<input type="radio" name="friend" value="1">Non<input type="radio" name="friend" value="0"><br><input class="button" type="submit" name="submit" value="Valider"></form>';
                                    }
                                }
                            })
                            .catch(err=>console.error(err));
        }
    });
}

///////////////////////Gestion des messages du chat/////////////////////////////

let form = document.querySelector('.form_tchat');

if (form != null){
    form.addEventListener('submit',(e)=>{
        e.preventDefault();
        let tchat = document.getElementById('content_tchat'); 
        let mycontent = document.querySelector('.my_content');
        let friend_id = document.querySelector('.friend_id');
        
        let formdata = new FormData();
        formdata.append('content', tchat.value); 
        formdata.append('friend_id',friend_id.value);
        let obj = { 'method':'POST', 'body':formdata };
        
        fetch('ajax/recordChat.php', obj)
                        .then(response => response.text())
                        .then(data=>{
                            console.log(data);
                            tchat.value = '';
                            tchat.focus();
                            mycontent.innerHTML='<p>'+data+'</p>';
                       
                        })
                        .catch(err=>console.error(err));
        });
}

/////////////////////////////Slider/////////////////////////////////////////////
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
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            }]
        });
});

////////////////Gestion des bouquets de fleurs///////////////////
/*
let container_flower = document.querySelector('.container_flower');
let checkboxs = container_flower.querySelectorAll('input[type="checkbox"]');
let input_flower = document.querySelector('.submit_flower');
let select_flower = document.getElementById('select_flower');

input_flower.addEventListener('click', getFlower);

let result = [];

function getFlower() {
    checkboxs.forEach(item =>{   //récup toutes les checkboxes
        if(item.checked) {   // celles sélectionnées vont être stocké dans un obj data
            let data = {
                    item: item.value,
                    selected: item.checked
                    }
                    result.push(data); //push l'obj dans un tableau
                
        }
    });
    select_flower.innerHTML = JSON.stringify(result); // récupère le JSON 
};
*/

});
  
		