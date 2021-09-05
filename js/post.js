
function newPost() {
    let titre = $('#titre').val()
    let description = $('#description').val()
    let lien = $('#lien').val()
    let type = $('#type_selected option:selected').val()
    let lien_externe = $('#lien_externe').val()

    $('#admin_response_nouvelArticle').hide()

    $.ajax({
        url: 'newPost',
        dateType: 'json',
        type: 'post',
        data: { title: titre, description: description, lien: lien, type: type, lien_externe: lien_externe }

    }).done(function (data) {
        let result = data
        console.log('good')
        $('#admin_response_nouvelArticle').show()
        $('#admin_response_nouvelArticle').empty()
        if (data === "success") {
            result = 'Nouveau post créé avec succès.'
            $('#titre').val('')
            $('#description').val('')
            $('#lien').val('')
        }
        $('#admin_response_nouvelArticle').append('<p>' + result + '</p>')
    }).fail(function (doto) {
        console.log('new Post failure')
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