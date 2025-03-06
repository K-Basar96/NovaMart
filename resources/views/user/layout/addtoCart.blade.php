<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-to-cart-form').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const formData = form.serialize();
            const messageContainer = form.closest('.card-body').find('.success-message');


            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                success(response) {
                    showMessage(messageContainer, response.message, 'green');
                },
                error(xhr) {
                    if (xhr.status === 401) {
                        alert(xhr.responseJSON.message);
                        window.location.href = "/login";
                    } else if (xhr.status === 400) {
                        showMessage(messageContainer, xhr.responseJSON.message, 'red');
                    } else {
                        alert("An error occurred. Please try again.");
                    }
                }
            });
        });

        function showMessage(container, message, color) {
            container.text(message).css('color', color).fadeIn();

            // Hide message after 3 seconds
            setTimeout(() => {
                container.fadeOut();
            }, 3000);
        }
    });
</script>
