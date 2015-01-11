@extends($layout)

@section('title')
Content - {{ ucfirst($type) }}
@stop

@section($contentSection)
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <a href="{{ route('content.admin.index', ['pages']) }}" class="btn btn-info">Pages</a>
            <a href="{{ route('content.admin.index', ['blocks']) }}" class="btn btn-info">Blocks</a>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <div class="form-group text-right">
            <a href="{{ route('content.admin.create', ['page']) }}" class="btn btn-primary">Add new page</a>
            <a href="{{ route('content.admin.create', ['block']) }}" class="btn btn-primary">Add new block</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                </tr>
            </thead>
            <tbody>
                @foreach($models as $model)
                <tr>
                    <td>{{ $model->id }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop