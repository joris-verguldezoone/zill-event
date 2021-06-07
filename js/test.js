$('#paragraphe').onload (function() {
    $.post(
        'testcoucou',
        {},
        function (data) {
            console.log(data)
        })
})