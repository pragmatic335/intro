$(document).ready(function() {
    let form = 'filterform';
    let formHide = 'filter-hide-form';

    //По нажатию на поиск делаем сабмит скрытой формы поиска в Pjax-e, предварительно положив туда значения из вводимых данных
    $('#submit-filter').on('click', function ( ev ) {
        ev.preventDefault();
        $('#' + formHide + '-bdate').val($('#' + form + '-bdate').val())
        $('#' + formHide + '-edate').val($('#' + form + '-edate').val())
        $('#' + formHide + '-category').val($('#' + form + '-category').val())
        $('#' + formHide + '-object').val($('#' + form + '-object').val())
        $('#' + formHide + '-currency').val($('#' + form + '-currency').val())

        //сабмит формы
        $('#filter-hide-form').submit();
    })

});