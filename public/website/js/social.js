
window.fbAsyncInit = function () {
    FB.init({
        appId: '983505582214482',
        xfbml: true,
        version: 'v12.0'
    });
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function genericSocialShare(url) {
    var x = screen.width / 2 - 648 / 2;
    var y = screen.height / 2 - 395 / 2;
    window.open(url, 'sharer', 'toolbar=0,status=0,width=648,height=395,left=' + x + ',top=' + y);
    return true;
}