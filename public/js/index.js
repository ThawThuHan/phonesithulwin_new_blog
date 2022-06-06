// darkLight toggle
const chk = document.querySelector("#flexSwitchCheckDefault");
chk.addEventListener('change', function(){
    const body = document.querySelector("body");
    const copyright = document.querySelector("#copyright");
    if(body.classList.contains('bg-light')){
        body.classList.remove('bg-light');
        body.classList.add('bg-dark');
        copyright.classList.add('text-white');
    } else{
        body.classList.remove('bg-dark');
        body.classList.add('bg-light');
        copyright.classList.remove('text-white');
    }
})