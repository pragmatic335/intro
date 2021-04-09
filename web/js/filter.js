$(document).ready(function() {
    let form = 'filterform';
    let formHide = 'filter-hide-form';

    //По нажатию на поиск делаем сабмит скрытой формы поиска в Pjax-e, предварительно положив туда значения из вводимых данных
    $('#submit-filter').on('click', function ( ev ) {
        ev.preventDefault();
        $('#' + formHide + '-bdate').val($('#' + form + '-bdate').val())
        $('#' + formHide + '-edate').val($('#' + form + '-edate').val())
        $('#' + formHide + '-type').val($('#' + form + '-type').val())
        $('#' + formHide + '-category').val($('#' + form + '-category').val())
        $('#' + formHide + '-object').val($('#' + form + '-object').val())
        $('#' + formHide + '-currency').val($('#' + form + '-currency').val())

        console.log(     $('#' + formHide + '-currency').val() );

        // $('#' + search_form + '-fias2building').val($('#' + filter_form + '-fias2building option:selected').attr('value'))
        // // console.log( $('#' + search_form + '-fias2building').val())
        // $('#' + search_form + '-building_id').val($('#' + filter_form + '-building_id option:selected').attr('value'))
        // $('#' + search_form + '-flat_id').val($('#' + filter_form + '-flat_id option:selected').attr('value'))

        //сабмит формы
        $('#filter-hide-form').submit();
    })

});