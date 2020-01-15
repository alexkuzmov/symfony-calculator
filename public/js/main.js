$(document).ready(function () {
    $('[data-selected]').each(function(i, e){
        $(e).val($(e).attr('data-selected'));
    });
});

function filterNumbers(element){
	$(element).val($(element).val().replace(/[^0-9]/g, ''));
}