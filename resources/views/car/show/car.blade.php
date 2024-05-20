<div class="border rounded shadow-sm p-3">
    <div class="d-flex justify-content-between">
        <div>
            <div class="h5">
                <a href="{{ route('cars.index', ['brand' => $car->brand->id]) }}" class="link-dark fw-semibold text-decoration-none">
                    {{ $car->brand->name }}
                </a>
                <a href="{{ route('cars.index', ['color' => $car->color->id]) }}" class="link-dark text-decoration-none">
                    ∙ {{ $car->color->getName() }}
                </a>
                <a href="{{ route('cars.index', ['year' => [$car->year->id]]) }}" class="link-dark text-decoration-none">
                    ∙ {{ $car->year->name }}
                </a>
            </div>
        </div>
        <div class="text-end">
            @if($car->created_at >= \Carbon\Carbon::now()->subMonths(3)->toDateTimeString())
                <span class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded-pill">
                    @lang('app.new')
                </span>
            @endif
        </div>
    </div>
    <div class="text-secondary">
        <a href="{{ route('cars.index', ['location' => $car->location->id]) }}" class="link-dark text-decoration-none">
            {{ $car->location->getName() }}
        </a>
        ∙ {{ $car->description }} ({{ $car->created_at }})
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span class="text-primary">
                {{ round($car->price, 2) }} <small>TMT</small>
            </span>
            <span class="badge bg-warning-subtle border border-warning-subtle text-warning-emphasis rounded-pill {{ $car->active ? 'd-none':'' }}">
                <i class="bi-clock-fill"></i> @lang('app.pending')
            </span>
            @auth
                <button type="button" class="btn btn-{{ $car->active ? 'danger':'success' }} btn-sm btn-active" value="{{ $car->id }}">
                    {!! $car->active ? '<i class="bi-x-lg"></i>':'<i class="bi-check-lg"></i>' !!}
                </button>
            @endauth
        </div>
        <div>
            <i class="bi-eye-fill"></i> {{ $car->viewed }}
        </div>
    </div>
</div>