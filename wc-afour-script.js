(function($) {
    $(document).ready(function(){
        
        $('input[type="checkbox"]').each(function(){ // loop through each checkbox on page load
            var isChecked = $(this).attr('checked');
            var thisID = $(this).attr('id');
            if (typeof isChecked !== typeof undefined && isChecked !== false && (thisID.match(/address/) || thisID.match(/names/)) ) { // if checkbox is checked
                $(this).addClass('wc-afour-input-checked'); // add 'wc-afour-input-checked' class
            } else { // if it's not checked
                if (!thisID.match(/show/)) { // if thisID doesn't contain 'show'
                    var prevIsChecked = $(this).parent().parent().prev('tr').children('td').children('input[type="checkbox"]').attr('checked'); // see if the previous checkbox is checked
                    if (typeof prevIsChecked == typeof undefined || prevIsChecked == false) { // if the previous checkbox is not checked
                        $(this).attr({'checked':false,'disabled':'true'}); // disable this checkbox and uncheck it
                    }
                }
            }
        });
        
        $('input[type="checkbox"]').change(function(){
            var thisID = $(this).attr('id');
            if ($(this).hasClass('wc-afour-input-checked')){
                $(this).removeClass('wc-afour-input-checked');
                if (thisID.match(/show/)){
                    $(this).parent().parent().next('tr').children('td').children('input[type="checkbox"]').attr({'checked':false,'disabled':'true'});
                }
            } else {
                $(this).addClass('wc-afour-input-checked');
                if (thisID.match(/show/) && thisID.match(/address/) || thisID.match(/show/) && thisID.match(/names/)){
                    $(this).parent().parent().next('tr').children('td').children('input[type="checkbox"]').attr({'checked':false,'disabled':false});
                }
            }
        });
        
        // put text from the dummy css input in the real css input
        $('#wc_afour_custom_css_dummy').change(function(){
            var css = $(this).val();
            $('#wc_afour_custom_css').val(css);
        });
        
        // Make header rows stand out
        $('th').has('h3').each(function(){
                $(this).parent().css('background','#fff');
                $(this).css({'padding-left':'3px','width':'90%'});
        });
        
        // unify the row heights (desktop)
        $('td').has('input[type="text"]').each(function(){
            $(this).css('padding','7px 0 0 10px');
        });
        
        // hide the real css input row
        $('td').has('textarea').each(function(){
            $(this).parent().css('display','none');
        });
        
        $('input').focus(function(){
            var thisID = $(this).attr('id');
            if (!thisID.match(/address/) && !thisID.match(/names/)){
                $(this).click();
            }
        });
        
        $('input').click(function(){
            var thisID = $(this).attr('id');
            var thisType = $(this).attr('type');
            var thisParent = $(this).parent().parent();
            var thisParentPos = $(this).parent().parent().position();
            if (thisType!='submit'){
                if (!thisID.match(/address/) && !thisID.match(/names/)){
                    $('.wc-afour-upgrade-alert').hide().css({'left':(thisParentPos.left+1)+'px','top':(thisParentPos.top+1)+'px','width':thisParent.css('width'),'height':thisParent.css('height') }).fadeIn('fast');
                    if (thisType=='checkbox'){
                        $(this).removeAttr('checked').removeClass('wc-afour-input-checked');
                        $(this&'::before').css('display','none');
                    }
                    $(this).blur();
                }
            }
        });
        
    });
})( jQuery );