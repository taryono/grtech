<div class="card card-primary card-outline">
    <div class="card-body box-profile">
      <div class="text-center"> 
        <img src="{{$company->logo?$company->logo:asset('assets/images/company.png')}}" class="profile-user-img img-fluid img-circle img-responsive image-logo" data-title="{{$company->name}}">
      </div>

      <h3 class="profile-username text-center">{{$company->name}}</h3>

      <p class="text-muted text-center">Website: {{$company->website}}</p> 
    </div>
    <!-- /.card-body -->
  </div>