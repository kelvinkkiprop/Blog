<!------------------Messages---------------------->
@if(session('success'))
    <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-lebel="close">&times;</a>    
        {{session('success')}}
    </div>  
@endif
@if(session('info'))
    <div class="alert alert-info">    
    <a href="#" class="close" data-dismiss="alert" aria-lebel="close">&times;</a>    
        {{session('info')}}
    </div>        
@endif
@if(session('warning'))
    <div class="alert alert-warning">    
    <a href="#" class="close" data-dismiss="alert" aria-lebel="close">&times;</a>    
        {{session('warning')}}
    </div>        
@endif
@if(session('danger'))
    <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-lebel="close">&times;</a>    
        {{session('danger')}}
    </div>        
@endif
<!------------------./Messages---------------------->
