function selectedImg(x) {
    let imageSrc = x.toUpperCase()
    let extension = ['.png', '.jpg', '.jpeg', '.gif']

    console.log(x);

    for (let ext of extension) {
        var image = $('<img src="media/events/' + imageSrc + ext + '"/>');
        if (image[0]['width'] > 0) {
            $('#shownPicture').css('background-image', 'url("media/events/' + imageSrc + ext + '")')
        }
    }
}   