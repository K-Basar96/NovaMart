<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-to-cart-form').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    const successMessage = form.closest('.card-body').find(
                        '.success-message');
                    successMessage.text(response.message);
                    successMessage.show();

                    // Hide the success message after a few seconds
                    setTimeout(() => {
                        successMessage.hide();
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    });
</script>
