

<h2 class="text-center">Články</h2>

<div class="list-group">
    @foreach($references as $reference)
        <a href="{{ $reference->full_url }}" class="list-group-item">
            <img src="{{ $reference->thumbnail_url }}" width="100">
            <div style="display: inline-block;">
            <strong>{{ $reference->title }}</strong>
            <p>
                {{ $reference->perex }}
            </p>
            </div>
        </a>
    @endforeach
</div>