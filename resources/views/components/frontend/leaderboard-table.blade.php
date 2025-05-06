<table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Points</th>
        <th scope="col">Rank</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->ranks[0]->total_points ?? 0 }}</td>
                <td>#{{ $user->ranks[0]->rank ?? '' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No users found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div id="paginationLinks">
        {{ $users->links() }}
    </div>
@endif
