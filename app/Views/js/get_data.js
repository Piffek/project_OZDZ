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

                                    let date = element.date.substr(0, 10);
                                    let time = element.date.substr(11, 5);

                                    $('.' + what).append(
                                        '</br>' +
                                        '<a target="_blank" href="' + element.link + '">' +
                                        '<div class="tile">' +
                                        '<table>' +
                                        '<col class="imgCol">' +
                                        '<col class="contentCol">' +
                                        '<tr><td rowspan="5"><div class="img"><img src="' + element.img + '"/></div></td></tr>' +
                                        '<tr><td><div class="title">' + element.title + '</div></td></tr>' +
                                        '<tr><td><div class="description">' + element.description + '</div></td></tr>' +
                                        '<tr><td><div class="link">' + element.link + '</div></td></tr>' +
                                        '<tr><td><div class="date">' + date + ' ' + time + '</div></td></tr>' +
                                        '</table></div></a>'
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

