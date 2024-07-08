
<div class="d-flex justify-content-between align-items-center  main_navbar">
    <div class="d-flex align-items-center gap-3">
        @if(auth()->user()->type == 'admin')
            <h4 class="mb-0 fw-bold">Depot Dashboard</h4>
        @endif
        @if(auth()->user()->type == 'operative')
            <h4 class="mb-0 fw-bold"> Operative Dashboard</h4>
            
        @endif
    </div>
</div>
