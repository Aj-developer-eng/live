<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chat Laravel Pusher | Edlin App</title>
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JavaScript -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- End JavaScript -->

    <!-- CSS -->
    <link rel="stylesheet" href="{{ URL::to('') }}/style.css">
    <!-- End CSS -->
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            width: 50%;
            height: 50%;
            border-radius: 5px;
            background-image: url('https://www.seiu1000.org/sites/main/files/main-images/camera_lense_0.jpeg');
            background-position: center;
            /* Center the background image horizontally and vertically */
            background-size: cover;
            /* Ensure the background image covers the entire element */
        }

        .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="chat">

        <!-- Header -->
        <div class="top">
            <img src="https://www.seiu1000.org/sites/main/files/main-images/camera_lense_0.jpeg" alt="Avatar"
                width="8%" height="8%">
            <div>
                <p>Ross Edlin</p>
                <small>Online</small>
            </div>
        </div>
        <!-- End Header -->

        <!-- Chat -->
        <div class="messages">
            @include('receive', ['message' => "Hey! What's up!  👋"])
            {{--  @include('receive', ['message' => "Ask a friend to open this link and you can chat with them!"])  --}}
            <button id="openModalButton">Chosse Image</button>
            <p class="Selected_image"></p>
            <form action="{{ URL::to('') }}/save_image" method="post" enctype="multipart/form-data">
                @csrf
                <input class="chossen_image" type="hidden" value="" name="img">
                <button type="submit">submit</button>
            </form>

            <!-- The modal -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <div class="row image_append_area">

                    </div>
                    <input type="file" class="selected_from_pc">
                </div>
            </div>



        </div>
        <!-- End Chat -->

        <!-- Footer -->
        <div class="bottom">
            <form>
                <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                <button type="submit"></button>
            </form>
        </div>
        <!-- End Footer -->

    </div>
</body>

<script>
    //open
    var btn = document.getElementById('openModalButton');
    var modal = document.getElementById('myModal');
    // When the button is clicked, open the modal
    btn.addEventListener('click', function() {

        $.get("{{ URL::to('') }}/retrive_images", {})
            .done(function(res) {

                for (var i = 0; i < res.length; i++) {
                    var imageUrl = res[i];
                    console.log(imageUrl);


                    var imageElement = $('<div class="col-sm" data-image-url="' + imageUrl +
                        '"><img src="' + imageUrl + '" alt="Avatar" width="100px" height="100px"></div>'
                    );
                    $('.image_append_area').append(imageElement);
                    imageElement.click(function() {

                        var selectedImageUrl = $(this).data('image-url');
                        console.log('Selected image URL:', selectedImageUrl);




                        $('.chossen_image').val(selectedImageUrl);
                        $('.Selected_image').text(selectedImageUrl);
                        $('.modal').hide();
                    });
                }
            });

        modal.style.display = 'block';


    });
    //close
    var closeBtn = document.getElementById('closeModal');
    var modalBackground = document.querySelector('.modal');

    // Close the modal when the close button is clicked
    closeBtn.addEventListener('click', function() {
        $('.image_append_area').html('');
        modal.style.display = 'none';
    });


    var fileInput = $('.selected_from_pc');

    fileInput.on('change', function() {
        // Get the selected file(s)
        var selectedFile = this.files[0];


        if (selectedFile) {
            var fileName = selectedFile.name;
            console.log('Selected file name:', fileName);
            $('.chossen_image').val(fileName);
            $('.Selected_image').text(fileName);
            $('.modal').hide();
        } else {
            // No file selected
        }
    });


    Pusher.logToConsole = true;
    var pusher = new Pusher('8a0808c4329361554dd6', {
        cluster: 'ap2',
    });

    const channel = pusher.subscribe('public');

    //Receive messages
    channel.bind('chat', function(data) {
        $.post("{{ URL::to('') }}/receive", {
                _token: '{{ csrf_token() }}',
                message: data.message,
            })
            .done(function(res) {
                $(".messages > .message").last().after(res);
                $(document).scrollTop($(document).height());
            });
    });

    //Broadcast messages
    {{--  $("form").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: "{{ URL::to('') }}/broadcast",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{ csrf_token() }}',
                message: $("form #message").val(),
            }
        }).done(function(res) {
            $(".messages > .message").last().after(res);
            $("form #message").val('');
            $(document).scrollTop($(document).height());
        });
    });  --}}
</script>

</html>
