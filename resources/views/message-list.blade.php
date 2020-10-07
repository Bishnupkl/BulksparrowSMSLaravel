<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message List</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>

</head>
<body>

<div class="container">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Message Title</th>
            <th scope="col">Message</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $index=>$message)
            <tr>
                <th scope="row">{{++$index}}</th>
                <td>{{$message->title}}</td>
                <td>{{$message->message}}</td>
                <td><a href="" data-toggle="modal" data-target="#exampleModal">Send message</a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('send.sms')}}" method="post" id="message_sms_form">
                    {{csrf_field()}}
                    <input type="hidden" name="message_id">
                    <ul>
                        @foreach($users as $user)
                            <li><input type="checkbox" name="user_id[]" value="{{$user->id}}">{{$user->name}}</li>
                        @endforeach
                    </ul>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send Message</button>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function (){
        $('#exampleModal').on('shown.bs.modal', function (e) {
            var target = e.relatedTarget;
            var message_id = $(target).data('message-id');
            alert(message_id);
            $('input[name="message_id"]').prop('value',message_id);
            // $('#message_sms_form').submit();
        });

        $('.btn-primary').click(function (e) {
            e.preventDefault();
            $('#message_sms_form').submit();
        });
    });
</script>
</html>
