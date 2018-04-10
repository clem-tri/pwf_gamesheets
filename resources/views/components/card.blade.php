<style>
    .card {
        border: 4px solid rgba(255, 242, 242, .3);
        border-radius: .5rem;
    }
</style>
<div class="card text-white bg-darkblue mb-3">
    <h4 class="card-header">
        {{ $title }}
    </h4>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>