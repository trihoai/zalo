
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">Danh sách nhân viên</div>
    <div class="container">
        <table class="table">
            <tr>
                <th>Object_Id1</th>
                <th>Object_Id2</th>
                <th>Value</th>
            </tr>
            @foreach($value as $vl)
                <tr>

                    <td>{{$vl->object_id1}}</td>
                    <td>{{$vl->object_id2}}</td>
                    <td>{{$vl->value}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
