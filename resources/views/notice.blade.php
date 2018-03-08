<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @foreach ($userList as $record)
        {{ "uuid : " . $record['uuid'] }}<br />
        {{ "writer : " . $record['writer'] }}<br />
        {{ "title : " . $record['title'] }}<br />
        {{ "content : " . $record['content'] }}<br />
        {{ "hits : " . $record['hits'] }}<br /><br />
    @endforeach
    <button onclick="createNotice()">Create Notice</button>
    <button onclick="updateNotice()">Update Notice</button>
    <button onclick="deleteNotice()">Delete Notice</button>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;

        // 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        function createNotice(){
            $.ajax({
                method: 'post',
                url: '/be/notice',
                dataType: 'json',
                data: {
                    uuid: 'dump',
                    writer: '010f7f88-f181-3646-9ed3-ff108e8c6505',
                    content: 'Notice create test',
                    notice_range: 'group',
                    notice_for: '010f7f88-f181-3646-9ed3-ff108e8c6505',
                }
            }).done(() => {
                console.log('Create request sended');
            });
        }

        function updateNotice(){
            $.ajax({
                method: 'patch',
                url: '/be/notice/35e5dfc8-1fa9-11e8-a8b7-c8d3ffedbe28',
                dataType: 'json',
                data: {
                    writer: '010f7f88-f181-3646-9ed3-ff108e8c6505',
                    content: 'Modified contnet',
                    notice_range: 'group',
                    notice_for: '010f7f88-f181-3646-9ed3-ff108e8c6505',
                }
            }).done(() => {
                console.log('Update request sended');
            });
        }

        function deleteNotice(){
            $.ajax({
                method: 'delete',
                url: '/be/notice/4addcdb5-1fa9-11e8-a8b7-c8d3ffedbe28',
            }).done(() => {
                console.log('Delete request sended');
            });
        }
    </script>
</body>
</html>
