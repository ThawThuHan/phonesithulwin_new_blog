const form = document.getElementById('form')
const yname = document.getElementById('yname')
const email = document.getElementById('email')
const yphone = document.getElementById('phone');
const messages = document.getElementById('messages')

form.addEventListener('submit', function(e){
    e.preventDefault();
    let result = checkInputs();
    console.log(result);
        if(!result){
            this.submit();
        }
});

function checkInputs(){
    const ynameValue = yname.value.trim();
    const emailValue = email.value.trim();
    const yphoneValue = yphone.value.trim();
    const messagesValue = messages.value;
    let error = false;

    if (ynameValue === ''){
        setErrorFor(yname,'သင်၏ နာမည်ကိုထည့်ရန် လိုအပ်ပါသည်');
        error = true;
    }else {
        setSuccessFor(yname);
    }    

    if(emailValue === '') {
		setErrorFor(email, 'သင်၏ အီးလ်မေးကိုထည့်ရန် လိုအပ်ပါသည်');
        error = true;
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'သင်၏ အီးလ်မေးမှာ မှားယွင်းနေပါသည်');
        error = true;
	} else {
		setSuccessFor(email);
	}

    if (yphoneValue === ''){
        setErrorFor(yphone,'သင်၏ ဖုန်းနံပါတ်ကိုထည့်ရန် လိုအပ်ပါသည်');
        error = true;
    }else {
        setSuccessFor(yphone);
    }

   if (messagesValue === ''){
       setErrorFor(messages,'သင် ပေးပို့လိုသောအကြောင်းအရာကို ထည့်ရန်လိုအပ်ပါသည်');
       error = true;
   }else {
       setSuccessFor(messages)
   }

   return error;
}

function setErrorFor(input, messageError) {
    const formGroup = input.parentElement;
    const small = formGroup.querySelector('small');

    formGroup.className = 'form-group error';
    small.innerText = messageError;
}

function setSuccessFor(input) {
    const formGroup = input.parentElement;
    formGroup.className = 'form-group success'
}

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}
