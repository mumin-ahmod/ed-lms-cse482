$(document).ready(function() {
    $('#live_search').on('input', function() {
        let suggestion = $(this).val();

        if (suggestion.length > 0) {
            $.ajax({
                url: '../frontend/suggestion.php',
                method: 'POST',
                data: { suggestion: suggestion },
                success: function(response) {
                    $('#test').html(response);
                }
            });
        } else {
            $('#test').html('');
        }
    });
});
