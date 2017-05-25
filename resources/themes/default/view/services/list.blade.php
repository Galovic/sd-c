

<h2 class="text-center">Články</h2>

<div class="list-group">
    @foreach($services as $service)
        <a href="{{ $service->full_url }}" class="list-group-item">
            <img src="{{ $service->thumbnail_url }}" width="100">
            <div style="display: inline-block;">
            <strong>{{ $service->title }}</strong>
            <p>
                {{ $service->perex }}
            </p>
            </div>
        </a>
    @endforeach
</div>