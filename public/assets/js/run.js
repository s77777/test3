(function (){
    d.addEventListener('DOMContentLoaded',function(){
        d.getElementById('btnlang').addEventListener('click',ShowLang);
    });
    var menu=d.querySelectorAll('.dropdown-menu a');
    for(var i=0;i<menu.length;i++) {
        menu[i].addEventListener('click',ReloadLang);
    }
})();

