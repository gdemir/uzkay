$(document).ready(function(){
  // Smart Wizard
  $('#wizard').smartWizard({transitionEffect:'slideleft',onLeaveStep:leaveAStepCallback,onFinish:onFinishCallback,enableFinishButton:true});
  function leaveAStepCallback(obj){
    var step_num=obj.attr('rel');
    return validateSteps(step_num);
  }
  function onFinishCallback(){
    if(validateAllSteps()){
      $('form').submit();
    }
  }
});
function validateAllSteps(){
  var isStepValid = true;

  if(validateStep1() == false){
    isStepValid = false;
    $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});
  }else{
    $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
  }
  if(validateStep2() == false){
    isStepValid = false;
    $('#wizard').smartWizard('setError',{stepnum:2,iserror:true});
  }else{
    $('#wizard').smartWizard('setError',{stepnum:2,iserror:false});
  }

  if(!isStepValid){
    $('#wizard').smartWizard('showMessage','Lütfen tüm adımlardaki hataları düzelterek devam edin');
  }

  return isStepValid;
}
function step_message(step, stepvalidate, section) {
  if(stepvalidate == false ){
    $('#wizard').smartWizard('showMessage',
        'Lütfen <b>'+section+'</b> bölümündeki hataları düzeltin '+
        've <b>Sonraki</b> tuşuna tıklayın.'
        );
    $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});
    return false;
  }else{
    $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
    return true;
  }
}

function error_message(message) {
  return '<div class="error">'+message+'</div>';
}
function control(verilen, tarif) {
  var hata;
  var un = $('#'+verilen).val();
  for (ne in tarif) {
    kosul = tarif[ne].shift();
    switch(ne){
      case 'dolu':     hata = kosul && (!un && un.length <= 0);break;
      case 'esit':     hata = un.length != kosul;break;
      case 'enkisa':   hata = un.length < kosul;break;
      case 'enuzun':   hata = un.length > kosul;break;
      case 'enaz':     hata = Number(un) < kosul;break;
      case 'enfazla':  hata = Number(un) > kosul;break;
      case 'basolmaz': hata = kosul == un[0];break;
      case 'tamsayi':  hata = kosul && !is_int(un);break;
      case 'ozel':     hata = !eval(kosul+"('"+un+"')");break;
    }
    if(hata)
      return tarif[ne].shift();
  }
}
function validateSteps(step){
  var isStepValid = true;
  if(step == 1) // validate step 1
    isStepValid = step_message(step, validateStep1(), "Kişisel Bilgiler");
  if(step == 2) // validate step 2
    isStepValid = step_message(step, validateStep2(), "İletişim Bilgiler");
  if(step == 3) // validate step 3
    isStepValid = step_message(step, validateStep3(), "İş Bilgiler");
  if(step == 4) // validate step 3
    isStepValid = step_message(step, validateStep4(), "Diğer Bilgiler");
  return isStepValid;
}
function validateStep1(){
  var state = true
    if (hata = control('tc',
          {
          'dolu':    [true,   'Tc Kimlik Numarası boş bırakılamaz'],
          'tamsayi': [true,   'Tc Kimlik Numarası tamsayı olmalıdır'],
          'esit':    [11,     'Tc Kimlik Numarası 11 haneli olmalıdır'],
          'ozel':    ['is_tc','Geçerli bir Tc Kimlik Numarası değil'],
          }
          ))
    {
      $('#msg_tc').html(error_message(hata)).show();
      state = false;
    } else
      $('#msg_tc').html('').hide();
    require = {
      'ad': '',
      'soyad': '',
      'kizliksoyad': 'Kızlık soyad',
      'anaad':       'Anne Adı',
      'babaad':      'Baba Adı',
      'dogumay':     'Doğum ay\'ı',
      'dogumyil':    'Doğum yıl\'ı',
      'dogumgun':    'Doğum gün\'ü',
      'dogumil':     'Doğum İli',
      'dogumilce':   'Doğum İlçe',
    };
    for(var item in require) {
      alan = require[item] == '' ? item.turkish2ucfirst() : require[item];
      if (hata = control(item,
            {
              'dolu': [true,  alan  + ' boş bırakılamaz'],
            }
            ))
      {
        $('#msg_'+item).html(error_message(hata)).show();
        state = false;
      }
      else
        $('#msg_'+item).html('').hide();
    }
    return state;
}
function validateStep2(){
  var state = true;
  if (hata = control('email',
        {
        'dolu':    [true,   'Email boş bırakılamaz'],
        'ozel':    ['is_email','Geçerli bir Email değil'],
        }
        ))
  {
    $('#msg_email').html(error_message(hata)).show();
    state = false;
  } else
    $('#msg_email').html('').hide();
  if (hata = control('ceptel',
        {
        'dolu':     [true,   'Cep telefonu boş bırakılamaz'],
        'tamsayi':  [true,   'Cep telefonu tamsayi olmalıdır'],
        'basolmaz': [0,      'Cep telefonu başta 0 olmadan yazınınz'],
        'esit':     [10,     'Cep telefonu 10 haneli olmalıdır'],
        }
        ))
  {
    $('#msg_ceptel').html(error_message(hata)).show();
    state = false;
  } else
    $('#msg_ceptel').html('').hide();

  require = {
    'evadres': 'Ev adresi',
    'il':      'İkametgah il',
    'ilce':    'İkametgah ilçe',
    'uni':     'Üniversite',
    'yokul':   'Yüksek okul',
  };
  for(var item in require) {
    alan = require[item] == '' ? item.turkish2ucfirst() : require[item];
    if (hata = control(item,
          {
            'dolu': [true,  alan  + ' boş bırakılamaz'],
          }
          ))
    {
      $('#msg_'+item).html(error_message(hata)).show();
      state = false;
    }
    else
      $('#msg_'+item).html('').hide();
  }
  return state;
}
function validateStep3(){
  var state = true;
  require = {
    'calismakurum': 'Çalışma kurum',
    'calismabirim': 'Çalışma birimi',
    'isadres':      'Çalışılan adres',
    'isil':         'Çalışılan il',
    'isilce':       'Çalışılan ilçe',
  };
  for(var item in require) {
    alan = require[item] == '' ? item.turkish2ucfirst() : require[item];
    if (hata = control(item,
          {
            'dolu': [true,  alan  + ' boş bırakılamaz'],
          }
          ))
    {
      $('#msg_'+item).html(error_message(hata)).show();
      state = false;
    }
    else
      $('#msg_'+item).html('').hide();
  }
  return state;
}
function validateStep4(){
  var state = true;
  require = {
    'captcha': 'Güvenlik kodu',
  };
  for(var item in require) {
    alan = require[item] == '' ? item.turkish2ucfirst() : require[item];
    if (hata = control(item,
          {
            'dolu': [true,  alan  + ' boş bırakılamaz'],
          }
          ))
    {
      $('#msg_'+item).html(error_message(hata)).show();
      state = false;
    }
    else
      $('#msg_'+item).html('').hide();
  }
  return state;
}
