$(document).ready(function () {

    $(document).on("click", "[data-toggle='block']", function(){
        $(this).addClass('hide');
        $(this).next().removeClass('hide');
    });
    $('ul.lst-checks li a').click(function() {
        $('ul.lst-checks li').removeClass('active');
        $(this).parent().addClass('active');
        $('#register-form-rate').val($(this).parent().attr('id').slice(-1));
        return false;
    });
    $('a.open-map').click(function() {
        $(this).parent().next().show();
        return false;
    });
    $('i.plus').click(function() {
        if($(this).hasClass('glyphicon-plus')){
            $(this).removeClass('glyphicon-plus');
            $(this).addClass('glyphicon-minus');
            $(this).next().removeClass('hide');
        }else{
            $(this).removeClass('glyphicon-minus');
            $(this).addClass('glyphicon-plus');
            $(this).next().addClass('hide');
        }


        return false;
    });

    $('.maincheck').click(function() {
        if($(this).prop('checked')){
            $(this).parent().next().next().find('input').prop('checked',true);
        }
        else{
            $(this).parent().next().next().find('input').prop('checked',false);
        }
        //return false;       
    });

    $('ul.lst-checksboxs ul.lst-checksboxs input').click(function() {
        if($(this).prop('checked')){

        }
        else{
            $(this).parent().parent().parent().prev().prev().children().prop('checked',false);
        }
        //return false;       
    });

    $('.in-boxs input').click(function() {
        if($(this).prop('checked')){
            $('.in-boxs input').prop('checked',false);
            $(this).prop('checked',true);
            if($(this).hasClass('box')){
                $('.box-block').removeClass('hide');
            }else{
                $('.box-block').addClass('hide');
            }
        }
        else{
            $(this).prop('checked',true);
        }
        //return false;       
    });

});