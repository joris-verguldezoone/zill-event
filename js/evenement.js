let test = document.getElementById("papa");

function sendPicture(event) {

    console.log(event)
    // console.log(event)
    // let imageUpperCase = event.toUpperCase()
    // console.log(imageUpperCase)
    // let imgSrc = 'media/events/' + imageUpperCase
    // console.log(imgSrc)
    let pictureChanging = "triggered"
    let pictureName = event
    $.ajax({
        url: "admin",
        type: 'POST',
        data: { pictureChanging: pictureChanging, pictureName: pictureName }
    }).done(function (data) {
        // pictureChanging est un trigger php 
        console.log(data)
    })

}

// tamere()
function tamere() {
    $.ajax({
        url: 'request_path',
        dateType: 'json',
        type: 'GET',

    }).done(function (data) {
        console.log(data)
    }).fail(function (doto) {
        console.log('request_path failure')
    })
}

// function selectedImg(x) {

//     switch (x) {
//         case 'seminaire':
//             console.log('Oranges are $0.59 a pound.');
//             document.getElementById("picture").style.backgroundImage = 'url("../src/..//images/image1.png")';
//             break;
//         case 'soiree':
//             console.log("xd")
//         case 'ceremonie':
//             console.log('Mangoes and papayas are $2.79 a pound.');
//             // expected output: "Mangoes and papayas are $2.79 a pound."
//             break;
//     }

//     document.getElementById('shownPicture').style.backgroundImage = 'url("https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRcw0lJ630LXIxAetlErusMeJuCkyfbOMbfv6dq9G676iIkVCfG")';
//     console.log(window.location.protocol)
//     console.log(document.getElementById('photo'))

// }

// function unSelectedImg(x) {
//     document.getElementById('shownPicture').style.backgroundImage = 'url("https://site.groupe-psa.com/content/uploads/sites/9/2016/12/white-background-2-768x450.jpg")';
//     console.log('arv')

// }
// SÉMINAIRE   SOIRÉE D’ENTREPRISE  CÉRÉMONIE DE REMISE

// CONFÉRENCE

// CONGRÈS

// CAPTATION VIDÉO

// HYBRIDE

// DIGITAL

// LANCEMENT PRODUIT

// EXPOSITION

// ASSEMBLEE GENERALE

// OPENING

// VERNISSAGE

// SPORTIF

// PARTENAIRE

// INAUGURATION

// CRAZY BIRTHDAY

// CONCERT

// SALON

// CLASSIQUE

// DANSE

