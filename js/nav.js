/*TOGGLE MENU*/
$('body').on('click', '#icone', function () {
    $('body').css('overflow', 'hidden');
    $('body').css('transform', 'translateY(-100vh)');
})


/*TRANSITION*/
$('body').on('click', '#headerNavSection li a', function (e) {
    e.preventDefault()
    let id = $(this).attr('id')
    $('body').css('overflow', 'hidden');
    $('body').css('transform', 'translateY(0vh)');
    setTimeout(function () {
        $('body').css('transform', 'translateY(-100vh)');
        setTimeout(function () {
        window.location = id;
        }, 400)
    }, 2000)
})