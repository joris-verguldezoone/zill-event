$('body').on('click', '#icone', function () {
    if (!($(this).is('.toggleOn'))) {
        $(this).addClass('toggleOn')
        $('main').css('transform', 'translateY(0vh)');
        $('header').css('transform', 'translateY(0vh)');
    } else {
        $(this).removeClass('toggleOn')
        $('main').css('transform', 'translateY(-100vh)');
        $('header').css('transform', 'translateY(-100vh)');

    }
})
