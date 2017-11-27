document.addEventListener(
    "DOMContentLoaded", function(){
        show('politic', 'getApi.php');
    
        show('music', 'getApiMusic.php');
    
        show('sport', 'getApiSport.php');
    
        show('anything', 'getApiWeather.php');
    
    
        function show(what, file){
            $('#'+what).click(
                function(){
                    ifNotIs(what);
                    $.getJSON(
                        'http://irollup.co.uk/project/'+file+'/?pass=415d7fe0d9f4fff5977c50d786ca5b9871a7e778', { get_param: 'value' }, function(data) {
                            $.each(
                                data, function(index, element) {
                                    $('.'+what).append(
                                        '<img style="height:200px; width:200px" src="'+element.img+'"</img>',
                                        '<div class="title">'+element.title+'</div>',
                                        '<a  class="link" href=>'+element.link+'</div>',
                                        '<div class="description">'+element.description+'</div>'
                                    );

                                }
                            );
                        }
                    );

                }
            ); 
        }
    
        function ifNotIs(what){
        
            let music = $('.music');
            let politic = $('.politic');
            let sport = $('.sport');
            let anything = $('.anything');
        
            if('music' !== what) {
                music.css('display', 'none');
            }else{
                music.css('display', 'block');
            }
        
            if('politic' !== what) {
                politic.css('display', 'none');
            }else{
                politic.css('display', 'block');
            }
            
            if('sport' !== what) {
                sport.css('display', 'none');
            }else{
                sport.css('display', 'block');
            }
        
            if('anything' !== what) {
                anything.css('display', 'none');
            }else{
                anything.css('display', 'block');
            }
        }
    }

);

