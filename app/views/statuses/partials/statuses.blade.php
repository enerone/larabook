@forelse($statuses as $status)
    @include('statuses.partials.status')
@empty
    <p>This user hasn yet posted a status.</p>
@endforelse

