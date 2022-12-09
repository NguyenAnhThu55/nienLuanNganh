
function Validator (options){
    var selectorRules = {};
    //Hàm thực hiện validate
     // Validator(inputElement.rule);
    function validate(inputElement,rule){
        var errorMessage ;
        var errorElement = inputElement.parentElement.querySelector('.form-message')
        
        var rules = selectorRules[rule.selector];

        // lặp quâ từng rule và kiểm tra
        for (var i =0; i< rules.length; i++){
            errorMessage = rules[i](inputElement.value);
            if(errorMessage) break;
        }
       

        if(errorMessage){
            errorElement.innerText = errorMessage;
            inputElement.parentElement.classList.add('invalid');

        }else{
            errorElement.innerText = '';
            inputElement.parentElement.classList.remove('invalid');
        }
        return !errorMessage;
        
    }
    // Lấy element của form cần validate
    // var formRules = {};

    var formElement = document.querySelector(options.form);

    if(formElement){

        // khi submit form
        formElement.onsubmit = function(e){
            e.preventDefault();

            var isFormValid = true;

            // lặp qua từng rule và validate
            options.rules.forEach(function(rule){
                var inputElement = formElement.querySelector(rule.selector);
                var isValid=validate(inputElement, rule); 
                if(!isValid){
                    isFormValid = false;
                }
            });
            

            if(isFormValid){
                if(typeof options.onsubmit === 'function'){

                    var enableInputs = formElement.querySelectorAll('[name]');
                    var formValues = Array.form(enableInputs).reduce(function(values, input){
                        return (values[input.name] = input.value) && values;
                    }, {});
                   
                    options.onsubmit(formValues);
                }
            }
        }

        // lặp qua mỗi rule và sử lý
        options.rules.forEach(function(rule) {

            // lưu các rule cho mỗi input
            if(Array.isArray(selectorRules[rule.selector])){
                selectorRules[rule.selector].push(rule.test);
            }else{
                selectorRules[rule.selector] = [rule.test];
            }
            
            var inputElement = formElement.querySelector(rule.selector);
           
            if(inputElement){
                // sử lý trường hợp blur ra ngoài
                inputElement.onblur = function(){
                    validate(inputElement, rule); 
                }

                // xử lý khi người dùng nhập vào input
                inputElement.Oninput = function(){
                    var errorElement = inputElement.parentElement.querySelector(options.errorSelector)
                    errorElement.innerText = '';
                    inputElement.parentElement.classList.remove('invalid');
                }
            }
        });
    }
}

Validator.isRequired = function(selector){
    return {
        selector: selector,
        test: function (value){
            return value.trim() ? undefined : 'Vui lòng nhập trường này !'
        }

    };
}

Validator.isEmail = function(selector){
    return {
        selector:selector,
        test: function (value){
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : 'Trường này phải là email !'
        }

    };
}

Validator.minLength = function(selector, min){
    return {
        selector:selector,
        test: function (value){    
            return value.length >= min ? undefined : `Vui lòng nhập tối thiểu ${min} ký tự !`;
        }

    };
}

Validator.isConfirmed = function(selector, getCofirmValue){
    return {
        selector:selector,
        test: function (value){
            return value === getCofirmValue() ? undefined :'Mật khẩu không chính xác !'
        }
    };
}