@extends('layout.dashboard')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">Profile</h2>
                </div>
                
                <div class="card-body">
                    <div class="mb-4">
                        
                        
                        <div class="row mb-3">
                            <div class="col-sm-3 fw-bold">Name:</div>
                            <div class="col-sm-9">{{ $user->name }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-3 fw-bold">Email:</div>
                            <div class="col-sm-9">{{ $user->email }}</div>
                        </div>
                        
                    </div>
                    
                  
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection