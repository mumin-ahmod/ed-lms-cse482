$(document).ready(function () {
    $('#input_box').on('input', function () {
        let suggestion = $(this).val();

        if (suggestion.length > 0) {
            $.ajax({
                url: '../frontend/suggestion.php',
                method: 'POST',
                data: { suggestion: suggestion },
                success: function (response) {
                    // Inject response into result-box
                    $('#result-box ul').html(response);
                    $('#result-box').slideDown(5); // Show dropdown
                },
                error: function () {
                    $('#result-box').slideUp(5); // Hide dropdown on error
                },
            });
        } else {
            $('#result-box').slideUp(5); // Hide dropdown when input is empty
        }
    });

    // Hide dropdown when clicking outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#result-box, #input_box').length) {
            $('#result-box').slideUp(5);
        }
    });

    // Handle click on suggestions
    $('#result-box').on('click', 'li', function () {
        $('#input_box').val($(this).text()); // Set input value to clicked suggestion
        $('#result-box').slideUp(5); // Hide dropdown
    });
});