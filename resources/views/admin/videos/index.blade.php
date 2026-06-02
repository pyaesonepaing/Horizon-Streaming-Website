@extends('layouts.admin')

@section('page_title', 'Manage Videos')
@section('page_description', 'Create, edit, and manage Horizon video content from the admin panel.')

@section('content')
    <style>
        .admin-head{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:16px;
            margin-bottom:22px;
            flex-wrap:wrap;
        }

        .admin-head-left h3{
            margin:0 0 8px;
            font-size:28px;
            font-weight:900;
            color:#fff;
        }

        .admin-head-left p{
            margin:0;
            color:#b6b6b6;
            font-size:14px;
            line-height:1.8;
        }

        .admin-btn-primary{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:12px 16px;
            border-radius:12px;
            background:#e50914;
            color:#fff;
            border:1px solid #e50914;
            font-size:14px;
            font-weight:700;
            transition:.3s ease;
        }

        .admin-btn-primary:hover{
            background:#b20710;
            border-color:#b20710;
        }

        .stats-row{
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:16px;
            margin-bottom:22px;
        }

        .stat-card{
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:18px;
            padding:18px;
        }

        .stat-label{
            color:#9ca3af;
            font-size:12px;
            text-transform:uppercase;
            letter-spacing:.8px;
            margin-bottom:8px;
        }

        .stat-value{
            color:#fff;
            font-size:28px;
            font-weight:900;
        }

        .filters-card{
            background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border:1px solid rgba(255,255,255,0.08);
            border-radius:22px;
            padding:18px;
            margin-bottom:22px;
        }

        .filters-grid{
            display:grid;
            grid-template-columns:2fr 1fr 1fr auto;
            gap:14px;
            align-items:end;
        }

        .filter-group{
            display:flex;
            flex-direction:column;
            gap:8px;
        }

        .filter-label{
            color:#a9a9a9;
            font-size:12px;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:.8px;
        }

        .filter-control{
            width:100%;
            padding:12px 14px;
            border-radius:12px;
            background:#0f0f0f;
            border:1px solid rgba(255,255,255,0.12);
            color:#fff;
            font-size:14px;
            outline:none;
        }

        .filter-control:focus{
            border-color:#e50914;
            box-shadow:0 0 0 3px rgba(229,9,20,0.12);
        }

        .filter-btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:12px 16px;
            border-radius:12px;
            background:transparent;
            color:#fff;
            border:1px solid rgba(255,255,255,0.14);
            font-size:14px;
            font-weight:700;
            cursor:pointer;
            transition:.3s ease;
        }

        .filter-btn:hover{
            background:rgba(255,255,255,0.08);
        }

        .filter-summary{
            margin-top:14px;
            color:#bdbdbd;
            font-size:13px;
        }

        .video-table-card{
            background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border:1px solid rgba(255,255,255,0.08);
            border-radius:22px;
            overflow:hidden;
        }

        .table-wrap{
            overflow-x:auto;
        }

        .admin-table{
            width:100%;
            border-collapse:collapse;
        }

        .admin-table thead{
            background:rgba(255,255,255,0.04);
        }

        .admin-table th{
            text-align:left;
            padding:16px;
            color:#a9a9a9;
            font-size:13px;
            font-weight:700;
            border-bottom:1px solid rgba(255,255,255,0.08);
            white-space:nowrap;
        }

        .admin-table td{
            padding:16px;
            border-bottom:1px solid rgba(255,255,255,0.06);
            color:#e5e5e5;
            font-size:14px;
            vertical-align:middle;
        }

        .video-row:hover{
            background:rgba(255,255,255,0.02);
        }

        .poster-box{
            width:110px;
            height:64px;
            border-radius:12px;
            overflow:hidden;
            border:1px solid rgba(255,255,255,0.08);
            background:#111;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#888;
            font-size:12px;
        }

        .poster-box img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
        }

        .video-title{
            color:#fff;
            font-size:15px;
            font-weight:800;
            line-height:1.6;
            margin-bottom:4px;
        }

        .video-subtitle{
            color:#9ca3af;
            font-size:12px;
            line-height:1.6;
        }

        .badge{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:7px 11px;
            border-radius:999px;
            font-size:11px;
            font-weight:700;
            white-space:nowrap;
        }

        .badge-published{
            background:rgba(34,197,94,0.16);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .badge-draft{
            background:rgba(239,68,68,0.16);
            border:1px solid rgba(239,68,68,0.35);
            color:#ffb4b4;
        }

        .badge-download{
            background:rgba(59,130,246,0.16);
            border:1px solid rgba(59,130,246,0.35);
            color:#bfd8ff;
        }

        .badge-no-download{
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.10);
            color:#d1d5db;
        }

        .actions{
            display:flex;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
        }

        .action-link{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:9px 12px;
            border-radius:10px;
            font-size:13px;
            font-weight:700;
            transition:.3s ease;
        }

        .action-edit{
            background:rgba(59,130,246,0.12);
            border:1px solid rgba(59,130,246,0.25);
            color:#bfd8ff;
        }

        .action-edit:hover{
            background:rgba(59,130,246,0.18);
        }

        .action-delete{
            background:rgba(239,68,68,0.12);
            border:1px solid rgba(239,68,68,0.25);
            color:#ffb4b4;
            cursor:pointer;
        }

        .action-delete:hover{
            background:rgba(239,68,68,0.18);
        }

        .empty-state{
            padding:48px 24px;
            text-align:center;
            color:#bdbdbd;
        }

        .empty-state h4{
            margin:0 0 8px;
            color:#fff;
            font-size:22px;
            font-weight:900;
        }

        .empty-state p{
            margin:0 0 18px;
            color:#a9a9a9;
            line-height:1.8;
        }

        .pagination-wrap{
            margin-top:18px;
        }

        .js-no-results{
            display:none;
            padding:32px 24px;
            text-align:center;
            color:#bdbdbd;
            border-top:1px solid rgba(255,255,255,0.06);
        }

        @media (max-width: 960px){
            .stats-row{
                grid-template-columns:1fr;
            }

            .filters-grid{
                grid-template-columns:1fr;
            }
        }
    </style>

    <div class="admin-head">
        <div class="admin-head-left">
            <h3>Manage Videos</h3>
            <p>
                Review your existing video library, update publishing status, and control downloadable content.
            </p>
        </div>

        <a href="{{ route('admin.videos.create') }}" class="admin-btn-primary">
            Add Video
        </a>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Videos</div>
            <div class="stat-value">{{ $videos->total() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Published On This Page</div>
            <div class="stat-value">{{ $videos->where('is_published', true)->count() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Downloadable On This Page</div>
            <div class="stat-value">{{ $videos->where('is_downloadable', true)->count() }}</div>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.videos.index') }}" class="filters-card">
    <div class="filters-grid" style="grid-template-columns:2fr 1fr 1fr 1fr auto;">
        <div class="filter-group">
            <label class="filter-label">Search</label>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="filter-control"
                placeholder="Search videos..."
            >
        </div>

        <div class="filter-group">
            <label class="filter-label">Published</label>
            <select name="published" class="filter-control">
                <option value="all">All</option>
                <option value="published" {{ request('published') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('published') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Downloadable</label>
            <select name="download" class="filter-control">
                <option value="all">All</option>
                <option value="yes" {{ request('download') === 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ request('download') === 'no' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Category</label>
            <select name="category" class="filter-control">
                <option value="all">All</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (string) request('category') === (string) $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">&nbsp;</label>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="admin-btn-primary">Filter</button>
                <a href="{{ route('admin.videos.index') }}" class="filter-btn">Reset</a>
            </div>
        </div>
    </div>
</form>

    <div class="video-table-card">
        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Poster</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Published</th>
                        <th>Downloadable</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="videosTableBody">
                    @forelse($videos as $video)
                        <tr
                            class="video-row"
                            data-title="{{ strtolower($video->title) }}"
                            data-description="{{ strtolower($video->description ?: 'no description available') }}"
                            data-published="{{ $video->is_published ? 'published' : 'draft' }}"
                            data-downloadable="{{ $video->is_downloadable ? 'yes' : 'no' }}"
                        >
                            <td>
                                @if($video->poster_path)
                                    <a href="{{ $video->poster_path }}" target="_blank" class="poster-box">
                                        <img
                                            src="{{ $video->poster_path }}"
                                            alt="{{ $video->title }}"
                                        >
                                    </a>
                                @else
                                    <div class="poster-box">
                                        No Image
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="video-title">{{ $video->title }}</div>
                                <div class="video-subtitle">
                                    {{ \Illuminate\Support\Str::limit($video->description ?: 'No description available.', 60) }}
                                </div>
                            </td>

                            <td>
                                {{ $video->categories->pluck('name')->implode(', ') ?: 'Uncategorized' }}
                            </td>

                            <td>
                                @if($video->is_published)
                                    <span class="badge badge-published">Published</span>
                                @else
                                    <span class="badge badge-draft">Draft</span>
                                @endif
                            </td>

                            <td>
                                @if($video->is_downloadable)
                                    <span class="badge badge-download">Yes</span>
                                @else
                                    <span class="badge badge-no-download">No</span>
                                @endif
                            </td>

                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.videos.edit', $video) }}" class="action-link action-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            onclick="return confirm('Delete this video?')"
                                            class="action-link action-delete"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="serverEmptyRow">
                            <td colspan="5">
                                <div class="empty-state">
                                    <h4>No videos found</h4>
                                    <p>Your Horizon video library is currently empty.</p>
                                    <a href="{{ route('admin.videos.create') }}" class="admin-btn-primary">
                                        Add Your First Video
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="jsNoResults" class="js-no-results">
            No videos match your current search/filter.
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $videos->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('videoSearch');
            const publishedFilter = document.getElementById('publishedFilter');
            const downloadFilter = document.getElementById('downloadFilter');
            const resetButton = document.getElementById('resetFilters');
            const visibleCount = document.getElementById('visibleVideoCount');
            const noResultsBox = document.getElementById('jsNoResults');
            const rows = Array.from(document.querySelectorAll('#videosTableBody .video-row'));

            function applyFilters() {
                const searchValue = searchInput.value.trim().toLowerCase();
                const publishedValue = publishedFilter.value;
                const downloadValue = downloadFilter.value;

                let matchedCount = 0;

                rows.forEach((row) => {
                    const title = row.dataset.title || '';
                    const description = row.dataset.description || '';
                    const published = row.dataset.published || '';
                    const downloadable = row.dataset.downloadable || '';

                    const matchesSearch =
                        searchValue === '' ||
                        title.includes(searchValue) ||
                        description.includes(searchValue);

                    const matchesPublished =
                        publishedValue === 'all' || published === publishedValue;

                    const matchesDownload =
                        downloadValue === 'all' || downloadable === downloadValue;

                    const shouldShow = matchesSearch && matchesPublished && matchesDownload;

                    row.style.display = shouldShow ? '' : 'none';

                    if (shouldShow) {
                        matchedCount++;
                    }
                });

                visibleCount.textContent = matchedCount;
                noResultsBox.style.display = matchedCount === 0 && rows.length > 0 ? 'block' : 'none';
            }

            searchInput.addEventListener('input', applyFilters);
            publishedFilter.addEventListener('change', applyFilters);
            downloadFilter.addEventListener('change', applyFilters);

            resetButton.addEventListener('click', function () {
                searchInput.value = '';
                publishedFilter.value = 'all';
                downloadFilter.value = 'all';
                applyFilters();
            });

            applyFilters();
        });
    </script>
@endsection