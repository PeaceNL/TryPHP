<!DOCTYPE html>
<html>
<head>
    <title>Phone Number Validation</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">  
</head>
<body>
    <form id="phoneForm" method="post">
        @csrf
        <label for="phoneNumber">Phone Number:</label>
        <input type="text" id="phoneNumber" name="phoneNumber" required>
        <button type="submit" id="validateButton">Validate</button> 
    </form>
    <div id="message"></div>

    <script>
        $(document).ready(function() {
            $('#phoneForm').submit(function(event) {
                event.preventDefault(); 

                var formData = $('#phoneForm').serialize(); 
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: 'http://forma.com',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken 
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.success) {
                            $('#message').text(response.message);
                        } else {
                            $('#message').text(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#message').text("ZALUPA");
                    }
                });
            });
        });
    </script>
</body>
</html>