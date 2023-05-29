$(document).ready(function() {
    $(document).on('click', '#update_image', function(e) {
        e.preventDefault();
        if (!$("#photo").length) {
            $("#update_image").hide();
            $("#cancel_update_image").show();
            $("#oldimage").html('<br><input type="file" onchange="readURL(this)"  name="photo" id="photo" > ');
        }
        return false;
    });
    $(document).on('click', '#cancel_update_image', function(e) {
        e.preventDefault();
        $("#update_image").show();
        $("#cancel_update_image").hide();
        $("#oldimage").html('');
        return false;
    });
}); 