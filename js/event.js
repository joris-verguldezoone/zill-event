function selectedImg(x) {
    let imageSrc = x.toUpperCase()
    var image = $('<img src="images/events/' + imageSrc + '.png"/>');
    if (image[0]['width'] > 0) {
        $('#shownPicture').css('background-image', 'url("images/events/' + imageSrc + '.png")')
    } else {
        $('#shownPicture').css('background-image', 'url("images/events/' + imageSrc + '.jpg")')
    }
}