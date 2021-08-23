function newPost() {
    let title = document.getElementById("titre").value
    let description = document.getElementById('description').value
    let lien = document.getElementById('lien').value

    console.log(title, description, lien)

    $.ajax({
        url: 'newPost',
        dateType: 'json',
        type: 'post',
        data: { title: title, description: description, lien: lien }

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