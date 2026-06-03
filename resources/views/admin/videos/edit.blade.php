@extends('layouts.admin')

@section('page_title', 'Edit Video')
@section('page_description', 'Update video details, replace files, and manage publishing settings.')

@section('content')
    <style>
        .form-card{
            background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border:1px solid rgba(255,255,255,0.08);
            border-radius:22px;
            padding:26px;
            max-width:980px;
        }

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

        .form-grid{
            display:grid;
            grid-template-columns:1.15fr .85fr;
            gap:22px;
        }

        .form-left,
        .form-right{
            display:flex;
            flex-direction:column;
            gap:18px;
        }

        .form-group{
            display:flex;
            flex-direction:column;
            gap:8px;
        }

        .form-label{
            font-size:13px;
            font-weight:700;
            color:#d1d5db;
        }

        .form-control{
            width:100%;
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

        textarea.form-control{
            resize:none;
        }

        .file-input{
            padding:10px;
            background:#0f0f0f;
            border:1px dashed rgba(255,255,255,0.2);
            border-radius:12px;
            color:#aaa;
        }

        .preview-card{
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:18px;
            padding:18px;
        }

        .preview-card h3{
            margin:0 0 14px;
            color:#fff;
            font-size:18px;
            font-weight:900;
        }

        .poster-preview{
            width:100%;
            max-width:320px;
            height:190px;
            border-radius:16px;
            overflow:hidden;
            background:#111;
            border:1px solid rgba(255,255,255,0.08);
            display:flex;
            align-items:center;
            justify-content:center;
            color:#888;
            font-size:13px;
        }

        .poster-preview img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
        }

        .meta-list{
            display:flex;
            flex-direction:column;
            gap:12px;
            margin-top:16px;
        }

        .meta-item{
            padding:12px 14px;
            border-radius:14px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
        }

        .meta-item strong{
            display:block;
            color:#9ca3af;
            font-size:12px;
            margin-bottom:4px;
            text-transform:uppercase;
            letter-spacing:.5px;
        }

        .meta-item span{
            color:#fff;
            font-size:14px;
            line-height:1.6;
            word-break:break-word;
        }

        .categories-grid{
            display:grid;
            grid-template-columns:repeat(2, 1fr);
            gap:10px;
        }

        .category-item{
            display:flex;
            align-items:center;
            gap:10px;
            padding:10px 12px;
            border-radius:12px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.08);
            color:#e5e5e5;
            font-size:14px;
        }

        .category-item input{
            accent-color:#e50914;
        }

        .switch-group{
            display:flex;
            gap:24px;
            margin-top:4px;
            flex-wrap:wrap;
        }

        .switch-item{
            display:flex;
            align-items:center;
            gap:10px;
            font-size:14px;
            color:#d1d5db;
        }

        .switch-item input{
            accent-color:#e50914;
        }

        .btn-row{
            display:flex;
            gap:12px;
            margin-top:8px;
            flex-wrap:wrap;
        }

        .btn-primary,
        .btn-secondary{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:13px 18px;
            border-radius:12px;
            font-size:14px;
            font-weight:700;
            transition:.3s ease;
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

        .btn-secondary{
            background:transparent;
            color:#fff;
            border:1px solid rgba(255,255,255,0.14);
        }

        .btn-secondary:hover{
            background:rgba(255,255,255,0.08);
        }

        .error-box{
            margin-bottom:16px;
            padding:14px;
            border-radius:14px;
            background:rgba(239,68,68,0.12);
            border:1px solid rgba(239,68,68,0.35);
            color:#ffb4b4;
        }

        .error-box ul{
            margin:0;
            padding-left:18px;
        }

        @media(max-width:900px){
            .form-grid{
                grid-template-columns:1fr;
            }
        }

        @media(max-width:768px){
            .categories-grid{
                grid-template-columns:1fr;
            }
        }
    </style>

    <div class="page-head">
        <h2>Edit Video</h2>
        <p>Update your video information, replace assets, and control its publishing status.</p>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.videos.update', $video) }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-left">
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $video->title) }}"
                        class="form-control"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea
                        name="description"
                        rows="5"
                        class="form-control"
                    >{{ old('description', $video->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Replace Poster</label>
                    <input type="file" name="poster" class="form-control file-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Replace Trailer File</label>
                    <input type="file" name="trailer_file" class="form-control file-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Replace Stream File</label>
                    <input type="file" name="stream_file" class="form-control file-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Replace Download File</label>
                    <input type="file" name="download_file" class="form-control file-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Categories</label>
                    <div class="categories-grid">
                        @foreach($categories as $category)
                            <label class="category-item">
                                <input
                                    type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', $selected)) ? 'checked' : '' }}
                                >
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="switch-group">
                    <label class="switch-item">
                        <input
                            type="checkbox"
                            name="is_published"
                            value="1"
                            {{ old('is_published', $video->is_published) ? 'checked' : '' }}
                        >
                        Published
                    </label>

                    <label class="switch-item">
                        <input
                            type="checkbox"
                            name="is_downloadable"
                            value="1"
                            {{ old('is_downloadable', $video->is_downloadable) ? 'checked' : '' }}
                        >
                        Downloadable
                    </label>
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn-primary">
                        Update Video
                    </button>

                    <a href="{{ route('admin.videos.index') }}" class="btn-secondary">
                        Back to Videos
                    </a>
                </div>
            </div>

            <div class="form-right">
                <div class="preview-card">
                    <h3>Current Poster</h3>

                    <div class="poster-preview">
                        @if($video->poster_path)
                            <img
                                src="{{ $video->poster_path }}"
                                alt="{{ $video->title }}"
                            >
                        @else
                            No Poster
                        @endif
                    </div>

                    <div class="meta-list">
                        <div class="meta-item">
                            <strong>Title</strong>
                            <span>{{ $video->title }}</span>
                        </div>

                        <div class="meta-item">
                            <strong>Status</strong>
                            <span>{{ $video->is_published ? 'Published' : 'Draft' }}</span>
                        </div>

                        <div class="meta-item">
                            <strong>Download</strong>
                            <span>{{ $video->is_downloadable ? 'Enabled' : 'Disabled' }}</span>
                        </div>

                        <div class="meta-item">
                            <strong>Categories</strong>
                            <span>{{ $video->categories->pluck('name')->implode(', ') ?: 'Uncategorized' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection