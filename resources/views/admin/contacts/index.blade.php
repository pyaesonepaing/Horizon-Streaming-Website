@extends('layouts.admin')

@section('page_title', 'Contact Messages')
@section('page_description', 'Review user contact submissions and manage message status.')

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

        .table-card{
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
            vertical-align:top;
        }

        .contact-row:hover{
            background:rgba(255,255,255,0.02);
        }

        .person-name{
            color:#fff;
            font-size:15px;
            font-weight:800;
            line-height:1.5;
            margin-bottom:4px;
        }

        .person-email{
            color:#9ca3af;
            font-size:13px;
            line-height:1.6;
            word-break:break-word;
        }

        .subject-title{
            color:#fff;
            font-size:15px;
            font-weight:800;
            line-height:1.5;
            margin-bottom:8px;
        }

        .message-preview{
            color:#b8b8b8;
            font-size:13px;
            line-height:1.8;
            max-width:520px;
            white-space:pre-line;
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

        .badge-seen{
            background:rgba(34,197,94,0.16);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .badge-pending{
            background:rgba(245,158,11,0.16);
            border:1px solid rgba(245,158,11,0.35);
            color:#fde68a;
        }

        .action-btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:10px 13px;
            border-radius:10px;
            font-size:13px;
            font-weight:700;
            transition:.3s ease;
            cursor:pointer;
            background:rgba(59,130,246,0.12);
            border:1px solid rgba(59,130,246,0.25);
            color:#bfd8ff;
        }

        .action-btn:hover{
            background:rgba(59,130,246,0.18);
        }

        .muted-text{
            color:#8b8b8b;
            font-size:13px;
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

        @media (max-width: 960px){
            .stats-row{
                grid-template-columns:1fr;
            }
        }
    </style>

    <div class="page-head">
        <h2>Contact Messages</h2>
        <p>Review incoming user messages and update their status when handled.</p>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Messages</div>
            <div class="stat-value">{{ $contacts->total() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Messages On This Page</div>
            <div class="stat-value">{{ $contacts->count() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Unseen On This Page</div>
            <div class="stat-value">{{ $contacts->where('status', '!=', 'seen')->count() }}</div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($contacts as $contact)
                        <tr class="contact-row">
                            <td>
                                <div class="person-name">{{ $contact->name }}</div>
                                <div class="person-email">{{ $contact->email }}</div>
                            </td>

                            <td>
                                <div class="subject-title">{{ $contact->subject ?: 'No Subject' }}</div>
                                <div class="message-preview">{{ $contact->message }}</div>
                            </td>

                            <td>
                                @if($contact->status === 'seen')
                                    <span class="badge badge-seen">Seen</span>
                                @else
                                    <span class="badge badge-pending">{{ ucfirst($contact->status) }}</span>
                                @endif
                            </td>

                            <td>
                                @if($contact->status !== 'seen')
                                    <form method="POST" action="{{ route('admin.contacts.seen', $contact) }}">
                                        @csrf
                                        <button type="submit" class="action-btn">
                                            Mark Seen
                                        </button>
                                    </form>
                                @else
                                    <span class="muted-text">No action</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <h4>No contact messages found</h4>
                                    <p>There are no user contact submissions to display right now.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $contacts->links() }}
    </div>
@endsection