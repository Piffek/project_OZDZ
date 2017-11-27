
let href = window.location.href.split('/');

Notification.requestPermission();

function spawnNoti(){
    if(Notification.permission === 'granted' && href[3] === 'wyslij_maile'){
        this.showNotification();
    }
}


function showNotification(){
    var options = {
        body: 'Masz nowe wiadomosci',
    }
    const notification = new Notification('Nowosci!', options);
}

spawnNoti();