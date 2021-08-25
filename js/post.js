function newPost() {
    let title = document.getElementById("titre").value
    let description = document.getElementById('description').value
    let lien = document.getElementById('lien').value
    // let photo = document.getElementById('photo').value
    // let video = document.getElementById('video').value
    let type = document.getElementById('type_selected').value
    console.log(title, description, lien)

    // if (photo !== null) {
    //     type = photo
    //     console.log("grrrrrrrrrrrrrrrr")
    // }
    // else if (video !== null) {
    //     type = video
    //     console.log("nion")
    // }

    console.log(type)

    $.ajax({
        url: 'newPost',
        dateType: 'json',
        type: 'post',
        data: { title: title, description: description, lien: lien, type: type }

    }).done(function (data) {
        console.log(data)
    }).fail(function (doto) {
        console.log('newPost failure')
    })
}
function modifyPost() {
    let titre = document.getElementsByName('modifyPostTitle')[0].value
    let description = document.getElementsByName('modifyPostDescription')[0].value
    let lien = document.getElementsByName('modifyPostLink')[0].value
    let id = document.getElementsByName('hiddenPostID')[0].value
    console.log(titre, description, lien, id)


    $.ajax({
        url: 'admin_post_modify',
        dateType: 'json',
        type: 'get',
        data: { titre: titre, description: description, lien: lien, id: id }

    }).done(function (data) {
        console.log(data)
    }).fail(function (doto) {
        console.log('modifyPost failure')
    })

}
function deletePost() {
    let id = document.getElementById('hiddenPostID_del').value
    console.log(id)
    $.ajax({
        url: 'deletePost',
        dateType: 'json',
        type: 'get',
        data: { id: id }

    }).done(function (data) {
        console.log(data)
    }).fail(function (doto) {
        console.log('deletePost failure')
    })
}