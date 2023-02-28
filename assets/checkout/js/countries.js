var country_flags = {"sv-SE":"se","ta":"tal","co":"cor","eo":"eo","zh-TW":"zh-CN","zh-CN":"zh-CN","ceb":"ceb","la":"va","pt":"pt","lb":"lu","ps":"af","ts":"za","sk":"sk","lo":"la","ln":"cg","ti":"er","th":"th","tk":"tm","lu":"cd","lt":"lt","to":"to","lv":"lv","ta":"sg","pl":"pl","tg":"tj","st":"za","hy":"cy","da":"dk","ht":"ht","de":"de","hr":"me","dz":"bt","hi":"in","he":"il","ss":"za","oc":"es","dv":"mv","uz":"uz","qu":"bo","mg":"mg","ur":"pk","mk":"mk","mh":"mh","mi":"nz","mn":"mn","ms":"sg","mt":"mt","my":"mm","af":"za","ve":"za","zh":"tw","en":"gb","el":"gr","it":"it","am":"et","is":"is","vi":"vn","ar":"sa","pa":"cw","id":"id","az":"az","et":"ee","ay":"bo","no":"sj","nn":"no","nl":"sx","rw":"rw","ru":"ru","ne":"np","nd":"zw","nb":"no","na":"nr","tn":"za","ny":"mw","ro":"ro","nr":"za","bg":"bg","fr":"fr","be":"by","ga":"ie","bi":"vu","bn":"bd","uk":"ua","rn":"bi","bs":"me","ff":"gn","fa":"ir","fo":"fo","ja":"jp","fj":"fj","fi":"fi","tr":"tr","kg":"cd","ka":"ge","kl":"gl","km":"kh","sv":"se","ko":"kr","sq":"xk","sr":"xk","kk":"kz","sl":"si","ku":"iq","sn":"zw","so":"so","si":"lk","es":"es","sg":"cf","ky":"kg","sw":"ug","ch":"mp","xh":"za","gv":"im","sm":"ws","ca":"es","hu":"hu","zu":"za","eu":"es","gl":"es","gn":"py","cs":"cz"};

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage:'en',
    layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT,
    includedLanguages: 'en,sv,zh-TW,es,ar,pt,ja,ru,fr,de,it,ko,hi,bn,th,vi,tr,fa,pl,uk'
  }, 'google_translate_element');

  $('.skiptranslate.goog-te-gadget').children().not('div').remove();

  setTimeout(function(){
    var _lang = $('select.goog-te-combo').val();
    var _lang_text = $('select.goog-te-combo option:selected').text();
    var ul = '<ul class="languagelist">';

     ul+='<li class="init" data-click-state="1">\
        <a href="#googtrans(en|'+_lang+')" class="lang-'+_lang+' lang-select" data-lang="'+_lang+'">\
        <img src="https://kzofswedenstripe.com/flags/64x64/'+(country_flags[_lang] ? country_flags[_lang] : country_flags['en'])+'.png" /> \
        <i class="fa fa-chevron-down" aria-hidden="true"></i></a>\
        </li>';

    $('select.goog-te-combo option').each(function(i,option){
      if($(option).val() != ''){
        ul+='<li>\
        <a href="#googtrans(en|'+$(option).val()+')" class="lang-'+$(option).val()+' lang-select" data-lang="'+$(option).val()+'">\
        <img src="https://kzofswedenstripe.com/flags/64x64/'+country_flags[$(option).val()]+'.png" />\
        </a>\
        </li>';
      }
    });

    ul += '</ul>';
    $('select.goog-te-combo').after(ul);

    $('li:not(.init) .lang-select').click(function(e) {
      var theLang = $(this).attr('data-lang');
      $('.goog-te-combo').val(theLang);
      window.location = $(this).attr('href');
      location.reload();
    });

    $('.reset-lang-btn').click(function(){
      $('#\\:1\\.container').contents().find('#\\:1\\.restore').click();
      $('.goog-te-combo').val('');
      window.location.href = 'https://kzofsweden.com/pages/checkout';
    });

    var allOptions = $("ul.languagelist").children('li:not(.init)');
    $('li.init').click(function(e){
      e.preventDefault();
      var css = {};
      if($(this).attr('data-click-state') == 1) {
        $(this).attr('data-click-state', 0)
        css = {
          "height":"300px",
          "overflow-x":"hidden",
          "overflow-y":"scroll",
          "width": "80px"
        };
      } else {
        $(this).attr('data-click-state', 1)
        css ={
          "height":"42px",
          "overflow":"hidden",
          "width": "80px"
        };
      }
      $("ul.languagelist").css(css);
      $(this).parents("ul.languagelist").children('li:not(.init)').toggle();
    });

    $("ul.languagelist li").not('.init').click( function() {
      allOptions.removeClass('selected');
      $(this).addClass('selected');
      $("ul.languagelist").children('.init').html($(this).html()).attr('data-click-state', 1).find('label').append('<i class="fa fa-chevron-down" aria-hidden="true"></i>');
      $("ul.languagelist").css({
        "overflow":"hidden"
      });
      allOptions.toggle();
    });

  },2000);
}

window.onbeforeunload = function(){
  alert('Are you sure you want to leave?');
};
