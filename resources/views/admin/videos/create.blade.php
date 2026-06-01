@extends('layouts.admin')

@section('page_title', 'Add Video')
@section('page_description', 'Upload and publish new video content to Horizon.')

@section('content')
    <style>
        .form-card{
            background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border:1px solid rgba(255,255,255,0.08);
            border-radius:22px;
            padding:26px;
            max-width:900px;
        }

        .form-group{
            margin-bottom:18px;
        }

        .form-label{
            display:block;
            margin-bottom:8px;
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
            margin-top:10px;
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

        .btn-primary{
            margin-top:12px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:13px 18px;
            border-radius:12px;
            font-size:14px;
            font-weight:700;
            background:#e50914;
            color:#fff;
            border:1px solid #e50914;
            transition:.3s ease;
        }

        .btn-primary:hover{
            background:#b20710;
            border-color:#b20710;
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

        @media(max-width:768px){
            .categories-grid{
                grid-template-columns:1fr;
            }
        }
    </style>

    <div class="page-head">
        <h2>Add New Video</h2>
        <p>Upload a new video and configure its streaming and download settings.</p>
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

    <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf

        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Poster Image</label>
            <input type="file" name="poster" class="form-control file-input">
        </div>

        <div class="form-group">
            <label class="form-label">Trailer Video File</label>
            <input type="file" name="trailer_file" class="form-control file-input">
        </div>

        <div class="form-group">
            <label class="form-label">Stream Video File</label>
            <input type="file" name="stream_file" class="form-control file-input" required>
        </div>

        <div class="form-group">
            <label class="form-label">Download File</label>
            <input type="file" name="download_file" class="form-control file-input">
        </div>

        <div class="form-group">
            <label class="form-label">Categories</label>
            <div class="categories-grid">
                @foreach($categories as $category)
                    <label class="category-item">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="switch-group">
            <label class="switch-item">
                <input type="checkbox" name="is_published" value="1">
                Published
            </label>

            <label class="switch-item">
                <input type="checkbox" name="is_downloadable" value="1" checked>
                Downloadable
            </label>
        </div>

        <button type="submit" class="btn-primary">
            Save Video
        </button>
    </form>
@endsection