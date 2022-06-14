document.addEventListener('DOMContentLoaded', function() {

/********************Gestion du menu Hamburger*******************************/

let mynav = document.getElementById("my_navbar");
let openburger = document.getElementById("open_burger");
let closeburger = document.getElementById("close_burger");

openburger.addEventListener('click',function(){
    mynav.classList.add("status");
});
closeburger.addEventListener('click',function(){
    mynav.classList.remove("status");
});

//////////////////////////////Photo de profil User/////////////////////

let photo_profil = document.querySelector('.user_icon');
let input_profil = document.getElementById('photo_user');
if(photo_profil!== null){
photo_profil.addEventListener('click', function(){
    input_profil.click();
    input_profil.addEventListener('change', function(){
        document.getElementById('form_user').submit();
    });
});
}

/////////////Gestion du bouton de liste des defunts du menu fiche//////////////

let button = document.querySelector('.button_myDefuncts');
let container = document.querySelector('.list_defuncts');
if(button!==null){
button.addEventListener('click', function(){
    container.classList.toggle('hidden');
});
}

//////////////Gestion des photos dans l'espace environnement/////////
let camera = document.querySelector('.camera_env');
let file = document.getElementById('file_env');
if(camera!==null){
    camera.addEventListener('click', function(){
        file.click();
        file.addEventListener('change', function(){
            document.getElementById('form_env').submit();
        });
    });
}

/////////////// Gestion des commentaires /////////////////////////

let comment_env = document.querySelectorAll('.comment_env');

if(comment_env!=null) {
    for(i of comment_env) {
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
            formdata.append('lastname',lastname.value);
            formdata.append('firstname',firstname.value);

            let obj ={ 'method':'POST', 'body' :formdata};
            fetch('ajax/recordcomment.php',obj)
            .then(response => response.text()) 
            .then(data=>{
                let content = '<div class="container_com_user"><div class="profil"><a class ="env_user_name" title="'+lastname.value+' '+firstname.value+'"><img class="img" src="public/pictures/users/'+user_id.value+'/photo'+user_id.value+'.jpg" ></a></div><div class="comment_post">'+comment.value+'</div><div class="icon_delete"><a class ="env_user_name" href="" title="Supprimer"><i class="fas fa-trash-alt"></i></a></div>';
                if(comment.value != '') {
                    com_div.innerHTML += content;
                }
                comment.value = '';
            })
            .catch(err=>console.log(err)); 
            
        });
    }
}



/************************Recherche Insee***************************************/
/*
 
let monnom = document.getElementById('search_nom');
let madiv = document.querySelector('.madiv');
let ville = document.getElementById('ville');
let maville = document.querySelector('.maville');

monnom.addEventListener('keyup', ()=> {
    let result= monnom.value;
        if (result.length>2) {
        
            fetch('https://insee.arbre.app/persons?surname='+result)
            .then(response => response.json())
            .then(data=>{ 
                let nb = data.count;
                
                for(let i=0; i<nb; i+=10){
                    fetch('https://insee.arbre.app/persons?offset='+i+'&surname='+result)
                    .then(response => response.json())
                    .then(data=>{ 
                        for(let i of data.results) {
                            console.log(i.prenom);
                            console.log(i.birthDate);
                            console.log(i.deathDate);
                            console.log(i.deathPlace);
                            madiv.innerHTML="<select><option value="+i+">"+i.prenom+"</option></select>";
                        }
                    })
                    .catch(err=>console.error(err));
                }
                  
                })
            .catch(err=>console.error(err));
        }
});
*/

    
////////////////Slick////////////////////
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

///////////////Gestion des commentaires///////////////
/*
let comment = document.getElementById('comment');
if(comment!==null){
    comment.addEventListener('change',function(e){
        e.preventDefault();
    });
}else{
    comment='';
}
*/


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

////////////////Gestion des cartes////////////////////////////////

/////////////////Fonction Ajax Générique///////////////////////////
function ajax(container,url){
    const formdata = new FormData(form);
    let obj ={ 'method':'POST', 'body' :formdata};
    fetch(url,obj)
        .then(response => response.text()) 
        .then(data=>{
            container.innerHTML+= data;
        })
        .catch(err=>console.log(err)); 
}
*/
////////////Vérifiaction du code pour changer son mot de passe///////


});
  
		