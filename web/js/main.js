$(function () {
    // this will get the full URL at the address bar
    var url = window.location.href;
    url = url.split('?')[0];
    // passes on every "a" tag
    $("#buttons a").each(function () {
        // checks if its the same on the address bar
        if ((url == (this.href))) {
            $(this).hide();
            if ($(this).attr('id') == "login") {
                $("#register").addClass("pull-right");
            }
        }
    });

    $datePublished = $('#book_datePublished');

    setDatePublishedType($datePublished);

    $datePublished.on('focus', function () {
        setDatePublishedType($datePublished, true);
    });

    $datePublished.on('focusout', function () {
        setDatePublishedType($datePublished);
    });
});

function setDatePublishedType($datePublished, force) {
    if($datePublished.val().length > 0 || force) {
        $datePublished.attr('type', 'date');
    } else {
        $datePublished.attr('type', 'text');
    }
}