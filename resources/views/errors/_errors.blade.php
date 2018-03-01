{{-- any()验证存在错误就继续 --}}
@if($errors->any())
  <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
@endif