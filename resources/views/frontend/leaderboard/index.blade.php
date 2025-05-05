<x-frontend.layout>
    <h2 class="mb-4">Leaderboard</h2>
    
    <div class="row g-2 mb-4 align-items-center">
        <div class="col-auto">
            {{-- Todo: As the instruction were not clear on this --}}
            <button
                id="recalculateBtn"
                class="btn btn-primary"
                type="button"
            >
                Recalculate
            </button>
        </div>
    </div>

    <div class="row g-2 mb-4 align-items-center">
        <div class="col-auto">
            <input
                type="text"
                id="searchInput"
                class="form-control"
                placeholder="Search by ID"
                value="{{ request('search') }}"
            />
        </div>
        <div class="col-auto">
            <button
                id="searchBtn"
                class="btn btn-primary"
                type="button"
            >
                Search
            </button>
        </div>
        <div class="col-auto">
            <select id="sortSelect" class="form-select">
                <option value="" {{ request('filter') === null ? 'selected' : '' }}>Select</option>
                <option value="day" {{ request('filter') === 'day' ? 'selected' : '' }}>Day</option>
                <option value="month" {{ request('filter') === 'month' ? 'selected' : '' }}>Month</option>
                <option value="year" {{ request('filter') === 'year' ? 'selected' : '' }}>Year</option>
            </select>
        </div>
    </div>

    <div id="leaderboardContainer">
        <x-frontend.leaderboard-table :users="$users" />
    </div>

    @push('scripts')
        <script>
            (function() {
                const searchInput = document.getElementById('searchInput');
                const searchBtn   = document.getElementById('searchBtn');
                const sortSelect = document.getElementById('sortSelect');

                async function reload() {
                    const url = new URL(window.location);
                    url.searchParams.set('search', searchInput.value.trim());
                    url.searchParams.set('filter', sortSelect.value);
                    history.replaceState(null, '', url);

                    const params = new URLSearchParams({
                        search: searchInput.value.trim(),
                        filter: sortSelect.value,
                    });

                    const res = await fetch(`{{ route('leaderboard.index') }}?${params}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const json = await res.json();
                    document.getElementById('leaderboardContainer').innerHTML = json.html;
                }

                searchBtn.addEventListener('click', () => reload());
                sortSelect.addEventListener('change', () => reload());
            })();
        </script>
    @endpush
</x-frontend.layout>
