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
    function inscription() {
        let login = document.getElementById('login_create_admin').value
        let password = document.getElementById('password_create_admin').value
        let confirm_password = document.getElementById('confirmation_password_create_admin').value
        console.log(login)
        console.log(password)
        $.ajax({
            url: 'inscription_admin',
            dateType: 'json',
            type: 'get',
            data: { login: login, password: password, confirm_password }

        }).done(function (data) {
            console.log('good')
        }).fail(function (doto) {
            console.log('inscription_admin failure')
        })
    }


});
