@extends('layouts.admin')

@section('page_title', 'Manage Categories')
@section('page_description', 'Create, update, and organize video categories for the Horizon library.')

@section('content')
    <style>
        .page-head{
            margin-bottom:20px;
        }

        .page-head h2{
            font-size:30px;
            font-weight:900;
            color:#fff;
            margin:0 0 6px;
        }

        .page-head p{
            color:#9ca3af;
            font-size:14px;
            line-height:1.8;
            margin:0;
        }

        .stats-row{
            display:grid;
            grid-template-columns:repeat(2, 1fr);
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

        .form-card,
        .table-card{
            background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border:1px solid rgba(255,255,255,0.08);
            border-radius:22px;
            overflow:hidden;
        }

        .form-card{
            padding:22px;
            margin-bottom:22px;
        }

        .form-card h3{
            margin:0 0 8px;
            font-size:22px;
            font-weight:900;
            color:#fff;
        }

        .form-card p{
            margin:0 0 16px;
            color:#a9a9a9;
            font-size:14px;
            line-height:1.7;
        }

        .create-form{
            display:flex;
            gap:12px;
            flex-wrap:wrap;
        }

        .form-control{
            flex:1;
            min-width:220px;
            padding:12px 14px;
            border-radius:12px;
            background:#0f0f0f;
            border:1px solid rgba(255,255,255,0.12);
            color:#fff;
            font-size:14px;
            outline:none;
        }

        .form-control:focus{
            border-color:#e50914;
            box-shadow:0 0 0 3px rgba(229,9,20,0.12);
        }

        .btn-primary,
        .btn-secondary,
        .btn-danger,
        .btn-link{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:11px 14px;
            border-radius:10px;
            font-size:13px;
            font-weight:700;
            transition:.3s ease;
            cursor:pointer;
        }

        .btn-primary{
            background:#e50914;
            color:#fff;
            border:1px solid #e50914;
        }

        .btn-primary:hover{
            background:#b20710;
            border-color:#b20710;
        }

        .btn-link{
            background:rgba(59,130,246,0.12);
            border:1px solid rgba(59,130,246,0.25);
            color:#bfd8ff;
        }

        .btn-link:hover{
            background:rgba(59,130,246,0.18);
        }

        .btn-danger{
            background:rgba(239,68,68,0.12);
            border:1px solid rgba(239,68,68,0.25);
            color:#ffb4b4;
        }

        .btn-danger:hover{
            background:rgba(239,68,68,0.18);
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

        .category-row:hover{
            background:rgba(255,255,255,0.02);
        }

        .category-name-form{
            display:flex;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
        }

        .category-name-form .form-control{
            min-width:180px;
            padding:10px 12px;
            font-size:13px;
        }

        .slug-badge{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:7px 11px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
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
            margin:0;
            color:#a9a9a9;
            line-height:1.8;
        }

        .pagination-wrap{
            margin-top:18px;
        }

        @media (max-width: 768px){
            .stats-row{
                grid-template-columns:1fr;
            }
        }
    </style>

    <div class="page-head">
        <h2>Manage Categories</h2>
        <p>Keep your Horizon content organized with clear and manageable categories.</p>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Categories</div>
            <div class="stat-value">{{ $categories->total() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Categories On This Page</div>
            <div class="stat-value">{{ $categories->count() }}</div>
        </div>
    </div>

    <div class="form-card">
        <h3>Add New Category</h3>
        <p>Create a new category to organize your video content more effectively.</p>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="create-form">
            @csrf
            <input
                type="text"
                name="name"
                placeholder="Category name"
                class="form-control"
                required
            >
            <button type="submit" class="btn-primary">Add Category</button>
        </form>
    </div>

    <div class="table-card">
        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                        <tr class="category-row">
                            <td>
                                <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="category-name-form">
                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ $category->name }}"
                                        class="form-control"
                                    >

                                    <button type="submit" class="btn-link">Update</button>
                                </form>
                            </td>

                            <td>
                                <span class="slug-badge">{{ $category->slug }}</span>
                            </td>

                            <td>
                                <div class="actions">
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-danger"
                                            onclick="return confirm('Delete this category?')"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <h4>No categories found</h4>
                                    <p>Your Horizon library does not have any categories yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $categories->links() }}
    </div>
@endsection