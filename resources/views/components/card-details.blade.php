<style>
    .card {
        border: 4px solid rgba(255, 242, 242, .3);
        border-radius: .5rem;
    }
</style>
<div class="card text-center">
    <div class="card-header ">
        {{ $title }}
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    <div class="card-footer text-muted">
       {{$footer}}
    </div>
</div>