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

let comment = document.getElementById('comment');
let form = document.getElementById('comment_env');
if(comment!==null){
    comment.addEventListener('change',function(e){
        e.preventDefault();
    console.log(comment.value);
        //form.submit();
        // const formdata = new FormData(form);
        // let obj ={ 'method':'POST', 'body' :formdata};
        // fetch('controller/environnement.php',obj)
        //     .then(response => response.text()) 
        //     .then(data=>{
        //         comdiv.innerHTML+= data;
        //     })
        //     .catch(err=>console.log(err));  
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
            // const formdata = new FormData(form);
            // let obj ={ 'method':'POST', 'body' :formdata};
            // fetch('controller/environnement.php',obj)
            //     .then(response => response.text()) 
            //     .then(data=>{
            //         comdiv.innerHTML+= data;
            //     })
            //     .catch(err=>console.log(err));  
        });
    });
}
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

////////Vérification du code pour valider le changement de mot de passe/////////

let submit2 = document.getElementById('submit2');
let verif_code = document.querySelector('.verif_code');

submit2.addEventListener('click',()=>{

    const formdata = new FormData(form);
    let obj ={ 'method':'POST', 'body' :formdata};
    fetch('controller/lost.php',obj)
        .then(response => response.text()) 
        .then(data=>{
            verif_code.innerHTML+= data;
        })
        .catch(err=>console.log(err));  
    });

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

// let verif_code = getElementById('code');
// if(verif_code!==null){
//     verif_code.addEventListener("change", function() {
//       // Enregistrement de la saisie utilisateur dans le stockage de session
//       let user_code = sessionStorage.setItem("user_code", verif_code.value);
//       let ourcode =sessionStorage.getItem("code");
//       if(user_code==ourcode){
//           alert('code correct');
//       }else{
//           alert('code incorrect');
//       }
//     });
// }

});
  
		