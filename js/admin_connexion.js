$(document).ready(function () {
    //NAVIGATION ADMIN
    $('.adminSection').hide()
    $(document).on('click', '.navAdmin', function () {
        $('.adminSection').hide()
        $('.navAdmin').css('color', 'grey')
        $(this).css('color', 'white')
        // console.log($(this).attr('id'))
        switch ($(this).attr('id')) {
            case 'creerAdminButton':
                $('#adminInscriptionSection').show()
                break;
            case 'creerArticleButton':
                $('#postCreationSection').show()
                break;
            case 'modifierArticlesButton':
                $('#postModifSection').show()
                break;
            case 'modifierImageEventButton':
                $('#eventModifSection').show()
                break;
            case 'modifierAdminButton':
                $('#adminModifSection').show()
                break;
        }
    });


    // function connexion() {
    //     let login = document.getElementById('login_admin').value
    //     let password = document.getElementById('password_admin').value
    //     console.log(login)
    //     console.log(password)
    //     $.ajax({
    //         url: 'connexion_admin',
    //         dateType: 'json',
    //         type: 'post',
    //         data: { login: login, password: password }

    //     }).done(function (data) {
    //         console.log('good')
    //         console.log(data)
    //     }).fail(function (doto) {
    //         console.log('connexion_admin failure')
    //     })
    // }


});

function inscription() {
    let login = document.getElementById('login_create_admin').value
    let password = document.getElementById('password_create_admin').value
    let confirm_password = document.getElementById('confirmation_password_create_admin').value
    console.log(login)
    console.log(password)
    $('#admin_response_inscription').hide()

    $.ajax({
        url: 'inscription_admin',
        dateType: 'json',
        type: 'get',
        data: { login: login, password: password, confirm_password }

    }).done(function (data) {
        let result = data
        console.log('good')
        $('#admin_response_inscription').show()
        $('#admin_response_inscription').empty()
        if (data === "success") {
            $('#login_create_admin').val('')
            $('#password_create_admin').val('')
            $('#confirmation_password_create_admin').val('')
            result = 'Inscription réussie !'
        }
        $('#admin_response_inscription').append('<p>' + result + '</p>')
    }).fail(function (doto) {
        console.log('inscription_admin failure')
    })
}
function modifAdmin(log, pass, id_admin, response) {
    console.log(log, pass)
    let user_name = $('#' + log).val()
    let password = $('#' + pass).val()
    let id = $('#' + id_admin).val();
    $('#' + response).hide()
    console.log(user_name, password, id, response)

    $.ajax({
        url: 'modifAdmin',
        dateType: 'json',
        type: 'GET',
        data: { user_name: user_name, password: password, id: id }

    }).done(function (data) {
        console.log(data)
        console.log('good')
        $('#' + response).show()
        $('#' + response).empty()
        $('#' + response).append('<p>' + data + '</p>')
        $('#' + user_name).append('<p>' + data + '</p>')

    }).fail(function (doto) {
        console.log('modifAdmin failure')
    })
}
function deleteAdmin(id_admin, response) {
    let id_delete = $('#' + id_admin).val();
    // console.log(id_delete)
    $('#' + response).hide()
    // console.log(id, response)

    $.ajax({
        url: 'deleteAdmin',
        dateType: 'json',
        type: 'GET',
        data: { id_delete: id_delete }

    }).done(function (data) {
        console.log(data)
        console.log('good')
        $('.modifUser[value='+ id_delete +']').hide()
        $('#' + response).show()
        $('.affichageReponseFormulaire').empty()
        $('#' + response).append('<p>' + data + '</p>')

    }).fail(function (doto) {
        console.log('deleteAdmin failure')
    })
}

function modifyArticle(title, lien, description, id, response) {
    let id_val = $('#' + id).val();
    let titre_val = $('#' + title).val();
    let description_val = $('#' + description).val();
    let lien_val = $('#' + lien).val();
    $('#' + response).hide()
    // console.log(id, response)

    $.ajax({
        url: 'modifyArticle',
        dateType: 'json',
        type: 'GET',
        data: { id: id_val, titre: titre_val, description: description_val, lien: lien_val }

    }).done(function (data) {
        console.log(data)
        console.log('good')
        $('#' + response).show()
        $('.affichageReponseFormulaire').empty()
        $('#' + response).append('<p>' + data + '</p>')

    }).fail(function (doto) {
        console.log('modifyArticle failure')
    })
}
function deleteArticle(id_article, response) {
    let id_delete = $('#' + id_article).val();
    $('#' + response).hide()
    // console.log(id, response)

    $.ajax({
        url: 'deleteArticle',
        dateType: 'json',
        type: 'GET',
        data: { id_delete: id_delete }

    }).done(function (data) {
        console.log(data)
        console.log('good')
        $('#' + response).show()
        $('.affichageReponseFormulaire').empty()
        $('#' + response).append('<p>' + data + '</p>')
        $('.postCardAdmin[value='+ id_delete +']').hide()

    }).fail(function (doto) {
        console.log('deleteAdmin failure')
    })
}


