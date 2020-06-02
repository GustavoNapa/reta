// validar cpf
$(document).ready(function() {  

// mascara de cpf
function formatar(mascara, documento){   
    var i = documento.value.length; 
    var saida = mascara.substring(0,1);   
    var texto = mascara.substring(i);

    if (texto.substring(0,1) != saida){    
        documento.value += texto.substring(0,1);
    }
};

//validador de CPF e CNPJ
function validator(){
    $('#cnpjcpf_form').bootstrapValidator({
        fields: {
           cpf: {
                validators: {
                    notEmpty: {
                        message: 'Não é possivel prosseguir com este campo vazio<br>'
                    },
                    stringLength: {
                        min: 11,
                        message: 'O CPF deve possui 11 números<br>'
                    },
                    callback: {
                        message: 'CPF Invalido<br>',
                        callback: function(value) {
                             //retira mascara e nao numeros       
                             cpf = value.replace(/[^\d]+/g,'');    
                             if(cpf == '') return false; 
                                 
                             if (cpf.length != 11) return false;
                             
                             // testa se os 11 digitos são iguais, que não pode.
                             var valido = 0; 
                             for (i=1; i < 11; i++){
                              if (cpf.charAt(0)!=cpf.charAt(i)) valido =1;
                             }
                             if (valido==0) return false;
                                   
                             //  calculo primeira parte  
                             aux = 0;    
                             for (i=0; i < 9; i ++)       
                              aux += parseInt(cpf.charAt(i)) * (10 - i);  
                              check = 11 - (aux % 11);  
                              if (check == 10 || check == 11)     
                               check = 0;    
                              if (check != parseInt(cpf.charAt(9)))     
                               return false;      
                       
                             //calculo segunda parte  
                             aux = 0;    
                             for (i = 0; i < 10; i ++)        
                              aux += parseInt(cpf.charAt(i)) * (11 - i);  
                             check = 11 - (aux % 11);  
                             if (check == 10 || check == 11) 
                              check = 0;    
                             if (check != parseInt(cpf.charAt(10)))
                              return false;       
                             return true; 
                        }
                   }
                }
           },
           cnpj: {
                validators: {
                    notEmpty: {
                        message: 'Não é possivel prosseguir com este campo vazio<br><br>'
                    },
                    stringLength: {
                        min: 14,
                        message: 'O CNPJ deve possui 14 números<br>'
                    },
                    callback: {
                        message: 'CNPJ Invalido<br>',
                        callback: function(value) {
                            cnpj = value.replace(/[^\d]+/g,'');

                            if(cnpj == '') return false;
                             
                            if (cnpj.length != 14)
                                return false;
                         
                            // Elimina CNPJs invalidos conhecidos
                            if (cnpj == "00000000000000" || 
                                cnpj == "11111111111111" || 
                                cnpj == "22222222222222" || 
                                cnpj == "33333333333333" || 
                                cnpj == "44444444444444" || 
                                cnpj == "55555555555555" || 
                                cnpj == "66666666666666" || 
                                cnpj == "77777777777777" || 
                                cnpj == "88888888888888" || 
                                cnpj == "99999999999999")
                                return false;
                                 
                            // Valida DVs
                            tamanho = cnpj.length - 2
                            numeros = cnpj.substring(0,tamanho);
                            digitos = cnpj.substring(tamanho);
                            soma = 0;
                            pos = tamanho - 7;
                            for (i = tamanho; i >= 1; i--) {
                              soma += numeros.charAt(tamanho - i) * pos--;
                              if (pos < 2)
                                    pos = 9;
                            }
                            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                            if (resultado != digitos.charAt(0))
                                return false;
                                 
                            tamanho = tamanho + 1;
                            numeros = cnpj.substring(0,tamanho);
                            soma = 0;
                            pos = tamanho - 7;
                            for (i = tamanho; i >= 1; i--) {
                              soma += numeros.charAt(tamanho - i) * pos--;
                              if (pos < 2)
                                    pos = 9;
                            }
                            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                            if (resultado != digitos.charAt(1))
                                  return false;
                                   
                            return true;
                        }
                   }
                }
           }
        }
    });

    $('#cpf_form').bootstrapValidator({
        fields: {
            cpf: {
                validators: {
                    notEmpty: {
                        message: 'Não é possivel prosseguir com este campo vazio<br>'
                    },
                    stringLength: {
                        min: 11,
                        max: 14,
                        message: 'O CPF deve possui 11 números<br>'
                    },
                    callback: {
                        message: 'CPF Invalido<br>',
                        callback: function(value) {
                         //retira mascara e nao numeros       
                         cpf = value.replace(/[^\d]+/g,'');    
                         if(cpf == '') return false; 
                             
                         if (cpf.length != 11) return false;
                         
                         // testa se os 11 digitos são iguais, que não pode.
                         var valido = 0; 
                         for (i=1; i < 11; i++){
                          if (cpf.charAt(0)!=cpf.charAt(i)) valido =1;
                         }
                         if (valido==0) return false;
                               
                         //  calculo primeira parte  
                         aux = 0;    
                         for (i=0; i < 9; i ++)       
                          aux += parseInt(cpf.charAt(i)) * (10 - i);  
                          check = 11 - (aux % 11);  
                          if (check == 10 || check == 11)     
                           check = 0;    
                          if (check != parseInt(cpf.charAt(9)))     
                           return false;      
                   
                         //calculo segunda parte  
                         aux = 0;    
                         for (i = 0; i < 10; i ++)        
                          aux += parseInt(cpf.charAt(i)) * (11 - i);  
                         check = 11 - (aux % 11);  
                         if (check == 10 || check == 11) 
                          check = 0;    
                         if (check != parseInt(cpf.charAt(10)))
                          return false;       
                         return true; 
      
       
                        }
                   }
                }
           }
        }
    });
}

$('#cpf_form').bootstrapValidator({
    fields: {
        cpf: {
            validators: {
                notEmpty: {
                    message: 'Não é possivel prosseguir com este campo vazio<br>'
                },
                stringLength: {
                    min: 11,
                    max: 14,
                    message: 'O CPF deve possui 11 números<br>'
                },
                callback: {
                    message: 'CPF Invalido<br>',
                    callback: function(value) {
                     //retira mascara e nao numeros       
                     cpf = value.replace(/[^\d]+/g,'');    
                     if(cpf == '') return false; 
                         
                     if (cpf.length != 11) return false;
                     
                     // testa se os 11 digitos são iguais, que não pode.
                     var valido = 0; 
                     for (i=1; i < 11; i++){
                      if (cpf.charAt(0)!=cpf.charAt(i)) valido =1;
                     }
                     if (valido==0) return false;
                           
                     //  calculo primeira parte  
                     aux = 0;    
                     for (i=0; i < 9; i ++)       
                      aux += parseInt(cpf.charAt(i)) * (10 - i);  
                      check = 11 - (aux % 11);  
                      if (check == 10 || check == 11)     
                       check = 0;    
                      if (check != parseInt(cpf.charAt(9)))     
                       return false;      
               
                     //calculo segunda parte  
                     aux = 0;    
                     for (i = 0; i < 10; i ++)        
                      aux += parseInt(cpf.charAt(i)) * (11 - i);  
                     check = 11 - (aux % 11);  
                     if (check == 10 || check == 11) 
                      check = 0;    
                     if (check != parseInt(cpf.charAt(10)))
                      return false;       
                     return true; 
  
   
                    }
               }
            }
        }
    }
});
validator();

	$(".somenteNumero").bind("keyup blur focus", function(e) {
        e.preventDefault();

        var expre = /[^\d.-]/g;
        $(this).val($(this).val().replace(expre,''));

        $(this).val($(this).val().substring(0, 14));
	});
});
              