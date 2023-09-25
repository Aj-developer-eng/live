<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>

    <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            $(document).ready(function() {
                console.log("ready!");
                var msg = 'Hello, This is my first real time message';
                {{--  console.log(msg);  --}}
                $.ajax({
                    type: 'POST',
                    url: '{{URL::to('sendMessage')}}',
                    data: {_token: '{{ csrf_token() }}',
                    'message': msg
                    },
                    success: function(msg){
                      var data =  JSON.parse(msg['token']);
               var token = data['auth'];

               Pusher.logToConsole = true;
               var pusher = new Pusher('8a0808c4329361554dd6', {

                   cluster:'ap2',

               });

           // Subscribe to the channel we specified in our Laravel Event

           var channel = pusher.subscribe('chat_channel', {
               auth: {
                   headers: {
                       'Authorization': '8a0808c4329361554dd6:1972480c1ee088bc86f06c210b6f16b1a5ddf105fa66ff59682da4935d59b7fe', // Include the auth token here
                   },
               },
           });





           // Bind a function to a Event (the full Laravel class)
           channel.bind('App\\Events\\MessageSent', function(data) {

               alert(data.message);
           });
                    }
            });

            });

        </script>
</body>
</html>
