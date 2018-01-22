document.addEventListener(
    "DOMContentLoaded", function () {
        show('politic', 'getApi.php');

        show('music', 'getApiMusic.php');

        show('sport', 'getApiSport.php');

        show('anything', 'getApiWeather.php');


        function show(what, file) {
            $('#' + what).click(
                function () {
                    ifNotIs(what);
                    $.getJSON(
                        'http://irollup.co.uk/project/' + file + '', {get_param: 'value'}, function (data) {
                            $.each(
                                data, function (index, element) {
                                    $('.' + what).append(
                                        '<div style="border: 1px solid #ccc; box-shadow: 3px 3px 3px #ccc; padding: 20px; width: 75%;">' +
                                        '<img style="height:200px;" src="' + element.img + '"/>' +
                                        '<div class="title">' + element.title + '</div>' +
                                        '<div><a  class="link" href=>' + element.link + '</a></div>' +
                                        '<div class="description">' + element.description + '</div>' +
                                        '<div class="date">' + element.date + '</div>' +
                                        '</div></br>'
                                    )
                                    ;

                                }
                            )
                        }
                    );

                }
            );
        }

        function ifNotIs(what) {

            let music = $('.music');
            let politic = $('.politic');
            let sport = $('.sport');
            let anything = $('.anything');

            if ('music' !== what) {
                music.css('display', 'none');
            } else {
                music.css('display', 'block');
            }

            if ('politic' !== what) {
                politic.css('display', 'none');
            } else {
                politic.css('display', 'block');
            }

            if ('sport' !== what) {
                sport.css('display', 'none');
            } else {
                sport.css('display', 'block');
            }

            if ('anything' !== what) {
                anything.css('display', 'none');
            } else {
                anything.css('display', 'block');
            }
        }
    }
);

