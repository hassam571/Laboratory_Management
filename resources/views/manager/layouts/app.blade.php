<!DOCTYPE html>
<html lang="en">
   
@include('manager.layouts.head')

    <body data-menu-color="light" data-sidebar="default">

        <div id="app-layout">
            @include('manager.layouts.header')
            @include('manager.layouts.sidebar')           
            <div class="content-page">
                <div class="content">
<!-- resources/views/admin/partials/alerts.blade.php -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="container-fluid">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
          
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">@yield('breadcrumb_parent', 'Labortary Management System')</a>
                    </li>
                    <li class="breadcrumb-item active">
                        @yield('breadcrumb_child', '(LMS)')
                    </li>
                </ol>
            </div>
        </div>

        @yield('content')
    </div>



                </div>
                    @include('manager.layouts.footer')
            </div>  
        </div>
        <script>
            window.onpageshow = function (event) {
                // If the page was restored from bfcache, force a reload:
                if (event.persisted) {
                    window.location.reload();
                }
            };
            </script>
             @yield('scripts')
            @include('manager.layouts.scripts')


           
                
                
    </body>

        
        
        
</html>