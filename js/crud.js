
$(document).ready(function() {
    $(".supp").click(function(event) {
        event.preventDefault();
        send("POST","supp.php", {id: $(this).attr('data-id'), type:'POST'});
        $(this).parent().parent().remove();
    });

    function send(type, url,data) {
        $.ajax({
            type: type,
            url: url,
            data: data,
            dataType: 'json'
          })
            .done(function() {

            })
            .fail(function() {
              alert('error');
            });
    }
});


