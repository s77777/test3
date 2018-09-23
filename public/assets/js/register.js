document.addEventListener('DOMContentLoaded',function(){
    let f=d.forms[0];
    let email=f.email;
    let psw=f.psw;
    let psw2=f.psw2;
    psw2.addEventListener('blur',function(){
        if (psw.value.toUpperCase()===psw2.value.toUpperCase()) {
           let button=f.querySelector('[type=submit]');
           button.disabled='';
        } else {
           alert(arrMsg.psw);
           psw.focus();
        }
    });
    email.addEventListener('blur',getEmailAjax);
});

function getEmailAjax(e) {
    let f=d.forms[0];
    let data={'email':f.email.value}
    JsonRequest('/'+locale +'/' + Class + '/getEmailAjax',data,function (e) {
        if (e.target.status === 200) {
            var result=JSON.parse(e.target.responseText);
            if (result.success==false) {
                alert(arrMsg.emailExist);
                f.email.focus();
            }
        } else if (e.target.status !== 200) {
            console.log(arrMsg.errorRequest + e.target.status);
        }
    });
}