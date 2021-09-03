$('main').css('background-color', 'black')
$('footer').css('background-color', 'black')
$('#footer p').css('color', 'white')
$('#footer a').css('color', 'grey')
$('#footer h3').css('color', 'white')
$('#footer li').css('color', 'white')

$("#footer a").hover(function(){
    $(this).css("color", "white");
}, function (){
    $(this).css("color", "grey");
})

$('.barre').css('border', '2px solid white')