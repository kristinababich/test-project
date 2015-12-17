window.onload=function(){
$(".activity-view-link").click(function() {
    $.get(
        'view',  
        {
            id: $(this).closest('tr').data('key')
        },
        function (data) {
            $('.modal-body').html(data);
            $('#activity-modal').modal();
        }  
    );
});
}
   


