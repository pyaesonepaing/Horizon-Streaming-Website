@extends('layouts.admin')

@section('page_title', 'Subscription Requests')
@section('page_description', 'Manage all subscription payments and requests.')

@section('content')

    {{-- FILTER TABS --}}
    <div style="display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap;">
        <a href="{{ route('admin.subscription-requests.index') }}"
           class="top-pill {{ !$status ? 'active-tab' : '' }}">
            All
        </a>

        <a href="{{ route('admin.subscription-requests.index', ['status' => 'pending']) }}"
           class="top-pill {{ $status === 'pending' ? 'active-tab' : '' }}">
            Pending
        </a>

        <a href="{{ route('admin.subscription-requests.index', ['status' => 'paid']) }}"
           class="top-pill {{ $status === 'paid' ? 'active-tab' : '' }}">
            Approved
        </a>

        <a href="{{ route('admin.subscription-requests.index', ['status' => 'failed']) }}"
           class="top-pill {{ $status === 'failed' ? 'active-tab' : '' }}">
            Rejected
        </a>
    </div>

    <style>
        .active-tab{
            background:rgba(229,9,20,0.18) !important;
            border-color:rgba(229,9,20,0.4) !important;
            color:#ffb3b8 !important;
        }

        .admin-table{
            width:100%;
            border-collapse:collapse;
        }

        .admin-table th{
            text-align:left;
            padding:14px;
            font-size:13px;
            color:#bdbdbd;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .admin-table td{
            padding:14px;
            border-bottom:1px solid rgba(255,255,255,0.06);
            font-size:14px;
            color:#e5e5e5;
        }

        .badge{
            padding:6px 10px;
            border-radius:999px;
            font-size:11px;
            font-weight:700;
        }

        .badge-pending{
            background:rgba(234,179,8,0.18);
            color:#fde68a;
        }

        .badge-paid{
            background:rgba(34,197,94,0.18);
            color:#bbf7d0;
        }

        .badge-failed{
            background:rgba(239,68,68,0.18);
            color:#fecaca;
        }

        .btn{
            padding:8px 12px;
            border-radius:8px;
            font-size:12px;
            font-weight:700;
            border:none;
            cursor:pointer;
        }

        .btn-approve{
            background:#16a34a;
            color:#fff;
        }

        .btn-reject{
            background:#dc2626;
            color:#fff;
        }
    </style>

    @if($payments->count())
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Plan</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Reference</th>
                        <th>Receipt</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>
                                {{ $payment->user->name ?? '-' }}<br>
                                <small style="color:#999;">
                                    {{ $payment->user->email ?? '-' }}
                                </small>
                            </td>

                            <td>
                                {{ $payment->subscription->plan->name ?? '-' }}
                            </td>

                            <td>
                                {{ $payment->currency }}
                                {{ number_format($payment->amount_cents / 100, 2) }}
                            </td>

                            <td>{{ strtoupper($payment->payment_method ?? '-') }}</td>

                            <td>{{ $payment->transaction_reference ?? '-' }}</td>

                            <td>
                                @if($payment->receipt_path)
                                    <a href="{{ asset('storage/' . $payment->receipt_path) }}"
                                       target="_blank"
                                       style="color:#ffb3b8;">
                                        View
                                    </a>
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if($payment->status === 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @elseif($payment->status === 'paid')
                                    <span class="badge badge-paid">Approved</span>
                                @else
                                    <span class="badge badge-failed">Rejected</span>
                                @endif
                            </td>

                            <td>
                                @if($payment->status === 'pending')
                                    <div style="display:flex; gap:6px;">
                                        <form method="POST" action="{{ route('admin.subscription-requests.approve', $payment) }}">
                                            @csrf
                                            <button class="btn btn-approve">Approve</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.subscription-requests.reject', $payment) }}">
                                            @csrf
                                            <button class="btn btn-reject">Reject</button>
                                        </form>
                                    </div>
                                @else
                                    <span style="color:#888;">No action</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $payments->links() }}
        </div>
    @else
        <p style="color:#bbb;">No records found.</p>
    @endif

@endsection