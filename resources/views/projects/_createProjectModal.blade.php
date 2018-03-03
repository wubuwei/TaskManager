<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  +
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">新建项目</h4>
      </div>
          {!! Form::open(['route' => 'projects.store', 'method' => 'POST', 'files' => 'true']) !!}
      <div class="modal-body">
            <div class="form-group">
              {!! Form::label('name', '项目名称: ', ['class' => 'control-label']) !!}
              {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('thumbnail', '项目缩略图: ', ['class' => 'control-label']) !!}
              {!! Form::file('thumbnail') !!}
            </div>

            @include('errors/_errors')

      </div>
      <div class="modal-footer">
            {!! Form::submit('新建项目', ['class'=>'btn btn-primary']) !!}
      </div>
          {!! Form::close() !!}
    </div>
  </div>
</div>