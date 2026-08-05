<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prosedur Pelayanan · {{ $consultation->nama }} — MD Farma</title>
    @vite('resources/js/app.js')
    <style>
        :root {
            --blue:#1238cc; --blue-dark:#1735a6; --blue-soft:#eef2ff;
            --ink:#1f2937; --muted:#687080; --border:#d8dce5;
            --canvas:#f5f7fb; --surface:#fff; --danger:#b91c1c;
            --success:#0f766e; --warning:#92400e;
            --shadow:0 12px 34px rgba(31,41,55,.08);
        }
        * { box-sizing:border-box; }
        body { margin:0; color:var(--ink); background:var(--canvas); font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif; font-size:14px; line-height:1.55; }
        a { color:inherit; text-decoration:none; }
        button,input,select,textarea { font:inherit; }
        .workflow-topbar { position:sticky; top:0; z-index:50; min-height:68px; display:flex; align-items:center; gap:18px; padding:10px clamp(18px,4vw,54px); border-bottom:1px solid var(--border); background:rgba(255,255,255,.97); box-shadow:0 5px 22px rgba(31,41,55,.06); }
        .workflow-brand { display:flex; align-items:center; gap:10px; font-weight:900; }
        .workflow-brand img { width:44px; height:44px; padding:3px; object-fit:contain; border:1px solid var(--border); border-radius:12px; background:#fff; }
        .workflow-nav { display:flex; gap:6px; margin-left:auto; }
        .workflow-nav a { min-height:38px; display:inline-flex; align-items:center; gap:7px; padding:8px 12px; border-radius:10px; color:var(--muted); font-size:12px; font-weight:800; }
        .workflow-nav a:hover,.workflow-nav a.active { color:var(--blue); background:var(--blue-soft); }
        .workflow-logout { min-height:38px; padding:8px 13px; border:1px solid var(--border); border-radius:10px; color:var(--ink); background:#fff; font-weight:800; cursor:pointer; }
        .workflow-page { width:min(1440px,calc(100% - 36px)); margin:24px auto 56px; }
        .workflow-breadcrumb { display:flex; align-items:center; justify-content:space-between; gap:14px; margin-bottom:14px; }
        .workflow-back { display:inline-flex; align-items:center; gap:8px; color:var(--blue); font-weight:850; }
        .workflow-header { display:flex; align-items:center; justify-content:space-between; gap:20px; padding:22px 24px; border:1px solid var(--border); border-radius:18px; background:#fff; box-shadow:var(--shadow); }
        .workflow-header h1 { margin:0; font-size:clamp(24px,3vw,36px); letter-spacing:-.035em; }
        .workflow-header p { margin:6px 0 0; color:var(--muted); }
        .workflow-header-meta { display:flex; flex-wrap:wrap; justify-content:flex-end; gap:7px; }
        .chip { min-height:28px; display:inline-flex; align-items:center; padding:5px 9px; border-radius:999px; color:#334155; background:#f1f5f9; font-size:11px; font-weight:850; }
        .chip.blue { color:var(--blue); background:var(--blue-soft); }
        .workflow-grid { display:grid; grid-template-columns:minmax(0,1.45fr) minmax(340px,.72fr); gap:18px; margin-top:18px; align-items:start; }
        .workflow-main,.workflow-chat { min-width:0; border:1px solid var(--border); border-radius:18px; background:#fff; box-shadow:var(--shadow); overflow:hidden; }
        .section-title { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:17px 19px; border-bottom:1px solid var(--border); }
        .section-title h2 { margin:0; font-size:17px; }
        .section-title p { margin:3px 0 0; color:var(--muted); font-size:12px; }
        .workflow-content { display:grid; gap:14px; padding:18px; }
        .classification-form,.screening-panel,.outcome-panel,.classification-history,.status-history,.consultation-readonly-notice { margin:0!important; border:1px solid var(--border)!important; border-radius:14px!important; background:#fff!important; box-shadow:none!important; overflow:hidden; }
        .classification-form { padding:16px; }
        .classification-form > label,.screening-notes-field label,.outcome-field label { display:block; margin-bottom:7px; font-size:12px; font-weight:850; }
        .classification-control { display:grid; grid-template-columns:minmax(0,1fr) auto; gap:9px; }
        select,textarea,input[type="text"] { width:100%; min-height:42px; padding:10px 12px; border:1px solid var(--border); border-radius:10px; color:var(--ink); background:#fff; outline:none; }
        textarea { resize:vertical; }
        select:focus,textarea:focus,input:focus { border-color:var(--blue); box-shadow:0 0 0 4px rgba(18,56,204,.11); }
        .classification-control button,.screening-submit-area button,.outcome-submit-area button,.workflow-send { min-height:42px; padding:9px 15px; border:0; border-radius:10px; color:#fff; background:var(--blue); font-weight:850; cursor:pointer; }
        .classification-reason,.classification-notice-preview { margin-top:12px; }
        .classification-reason label,.classification-notice-toggle { font-size:12px; font-weight:800; }
        .classification-reason small,.classification-notice-card small { display:block; margin-top:5px; color:var(--muted); }
        .classification-notice-toggle { display:flex; align-items:center; gap:8px; }
        .classification-notice-card { margin-top:9px; padding:12px; border:1px solid #bfdbfe; border-radius:11px; background:#eff6ff; }
        .classification-notice-card p { margin:6px 0; }
        .screening-details>summary,.outcome-details>summary,.classification-history summary,.status-history>summary,.screening-history summary,.outcome-history summary { min-height:54px; display:flex; align-items:center; justify-content:space-between; gap:12px; padding:13px 15px; cursor:pointer; list-style:none; background:#f8fafc; }
        summary::-webkit-details-marker { display:none; }
        .screening-summary-copy,.outcome-summary-copy { display:grid; gap:3px; }
        .screening-summary-copy small,.outcome-summary-copy small { color:var(--muted); font-size:11px; }
        .screening-summary-progress,.outcome-summary-status { padding:5px 9px; border-radius:999px; color:var(--blue); background:var(--blue-soft); font-size:10px; font-weight:900; white-space:nowrap; }
        .screening-form,.outcome-form,.classification-history-body { padding:15px; }
        .screening-checklist { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:9px; }
        .screening-check-item { min-height:48px; display:grid; grid-template-columns:auto 18px 1fr; align-items:start; gap:8px; padding:10px; border:1px solid var(--border); border-radius:10px; background:#fbfcfe; cursor:pointer; }
        .screening-check-item input { margin-top:3px; }
        .screening-check-item b { font-size:11px; line-height:1.45; }
        .screening-notes-field,.outcome-field { margin-top:14px; }
        .screening-form-footer,.outcome-form-footer { display:flex; align-items:flex-end; justify-content:space-between; gap:16px; margin-top:14px; padding-top:14px; border-top:1px solid #edf0f5; }
        .screening-audit-meta,.outcome-audit-meta { display:grid; gap:3px; color:var(--muted); font-size:11px; }
        .screening-submit-area,.outcome-submit-area { display:flex; align-items:center; gap:9px; }
        .screening-empty,.outcome-empty,.consultation-readonly-notice { padding:16px; }
        .screening-empty p,.outcome-empty p,.consultation-readonly-notice p { margin:5px 0 0; color:var(--muted); }
        .screening-history,.outcome-history { border-top:1px solid var(--border); }
        .screening-history-list,.outcome-history-list,.classification-history-list,.status-history-list { display:grid; gap:9px; padding:12px; }
        .screening-history-entry,.outcome-history-entry,.classification-history-item,.status-history-item { padding:11px; border:1px solid var(--border); border-radius:10px; background:#fbfcfe; }
        .workflow-chat { position:sticky; top:86px; }
        .workflow-chat-head { display:flex; align-items:center; justify-content:space-between; gap:10px; padding:15px 16px; border-bottom:1px solid var(--border); }
        .workflow-chat-head h2 { margin:0; font-size:15px; }
        .workflow-chat-head a { color:var(--blue); font-size:11px; font-weight:850; }
        .workflow-message-list { height:min(58vh,560px); overflow:auto; display:flex; flex-direction:column; gap:9px; padding:15px; background:#f7f8fb; }
        .workflow-message { max-width:86%; padding:10px 12px; border:1px solid var(--border); border-radius:14px 14px 14px 4px; background:#fff; box-shadow:0 3px 11px rgba(31,41,55,.06); }
        .workflow-message.admin { align-self:flex-end; border-radius:14px 14px 4px 14px; border-color:#bfdbfe; background:#eef4ff; }
        .workflow-message.notice { max-width:96%; align-self:center; border-color:#bfdbfe; background:linear-gradient(135deg,#eef4ff,#ecfeff); }
        .workflow-message strong { display:block; margin-bottom:4px; font-size:10px; color:#475569; }
        .workflow-message p { margin:0; white-space:pre-wrap; word-break:break-word; }
        .workflow-message-footer { display:flex; align-items:center; justify-content:flex-end; gap:5px; margin-top:6px; color:#7f8795; font-size:9px; }
        .admin-read-receipt { font-size:11px; font-weight:900; letter-spacing:-2px; }
        .admin-read-receipt.is-delivered { color:#94a3b8; }
        .admin-read-receipt.is-read { color:#1687ff; }
        .workflow-attachment { display:inline-flex; margin-top:7px; color:var(--blue); font-size:11px; font-weight:800; }
        .workflow-reply { padding:12px; border-top:1px solid var(--border); background:#fff; }
        .workflow-reply textarea { min-height:78px; }
        .workflow-reply-actions { display:flex; align-items:center; justify-content:space-between; gap:9px; margin-top:8px; }
        .workflow-file { max-width:210px; font-size:11px; }
        .flash { margin:14px 0 0; padding:12px 14px; border:1px solid #bfdbfe; border-radius:11px; color:#1e3a8a; background:#eff6ff; }
        .flash.error { border-color:#fecaca; color:#991b1b; background:#fef2f2; }
        @media(max-width:1040px) { .workflow-grid { grid-template-columns:1fr; } .workflow-chat { position:static; } .workflow-message-list { height:420px; } }
        @media(max-width:720px) { .workflow-topbar { flex-wrap:wrap; } .workflow-nav { order:3; width:100%; overflow:auto; margin-left:0; } .workflow-nav a { flex:0 0 auto; } .workflow-page { width:min(100% - 22px,1440px); } .workflow-header { align-items:flex-start; flex-direction:column; } .workflow-header-meta { justify-content:flex-start; } .screening-checklist { grid-template-columns:1fr; } .screening-form-footer,.outcome-form-footer { align-items:stretch; flex-direction:column; } .classification-control { grid-template-columns:1fr; } }
    </style>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/md-farma-logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/md-farma-logo-theme.css') }}">
</head>
<body class="admin-page workflow-page-body">
<header class="workflow-topbar">
    <a class="workflow-brand" href="{{ route('admin.inbox') }}">
        <img src="{{ asset('images/md-farma-logo.jpeg') }}" alt="Logo MD Farma">
        <span>MD Farma Admin</span>
    </a>
    <nav class="workflow-nav" aria-label="Navigasi admin">
        <a class="active" href="{{ route('admin.inbox') }}">Inbox</a>
        <a href="{{ route('admin.archive-requests.index') }}">Permintaan Arsip</a>
        <a href="{{ route('admin.dashboard') }}">Analitik</a>
    </nav>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="workflow-logout" type="submit">Logout</button>
    </form>
</header>

<main class="workflow-page">
    <div class="workflow-breadcrumb">
        <a class="workflow-back" href="{{ route('admin.inbox.show', $consultation) }}">← Kembali ke percakapan</a>
        <span class="chip">Catatan internal apoteker</span>
    </div>

    <section class="workflow-header">
        <div>
            <h1>Prosedur pelayanan {{ $consultation->nama }}</h1>
            <p>Klasifikasi, skrining, hasil akhir, dan audit dikelola di halaman ini agar area chat tetap fokus.</p>
        </div>
        <div class="workflow-header-meta">
            <span class="chip blue">{{ $consultation->jenis_konsultasi === 'resep' ? 'Resep dokter' : 'Tanpa resep' }}</span>
            <span class="chip">{{ $consultation->serviceClassificationLabel() }}</span>
            <span class="chip">{{ $consultation->screeningProgress()['label'] }}</span>
            <span class="chip">{{ $consultation->outcomeProgress()['label'] }}</span>
        </div>
    </section>

    @if (session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="flash error">
            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    @php
        $classificationOptions = \App\Models\Consultation::serviceClassificationOptions();
        $classificationNoticeTemplates = \App\Models\Consultation::CLASSIFICATION_NOTICE_TEMPLATES;
        $isReadOnly = $consultation->status === 'selesai';
    @endphp

    <div class="workflow-grid">
        <section class="workflow-main">
            <header class="section-title">
                <div>
                    <h2>Prosedur dan dokumentasi</h2>
                    <p>Lengkapi tahapan sesuai percakapan sebelum konsultasi diselesaikan.</p>
                </div>
                <span class="chip {{ $isReadOnly ? '' : 'blue' }}">{{ $isReadOnly ? 'Hanya-baca' : 'Dapat diedit' }}</span>
            </header>
            <div class="workflow-content">
                @include('admin.inbox.partials.workflow-content', compact(
                    'consultation', 'timezone', 'classificationOptions',
                    'classificationNoticeTemplates', 'isReadOnly'
                ))
            </div>
        </section>

        <aside class="workflow-chat" aria-label="Percakapan terkait">
            <header class="workflow-chat-head">
                <div>
                    <h2>Percakapan terkait</h2>
                    <small>{{ $consultation->messages->count() }} pesan</small>
                </div>
                <a href="{{ route('admin.inbox.show', $consultation) }}">Buka chat penuh →</a>
            </header>
            <div
                class="workflow-message-list"
                id="workflowMessageList"
                data-messages-url="{{ route('admin.inbox.messages', $consultation) }}"
            >
                @forelse ($consultation->messages as $message)
                    @php
                        $local = $message->created_at->copy()->timezone($timezone);
                        $isRead = $message->sender === 'admin'
                            && $message->id <= (int) ($consultation->patient_last_read_message_id ?? 0);
                    @endphp
                    <article
                        class="workflow-message {{ $message->sender === 'admin' ? 'admin' : 'patient' }} {{ $message->isClassificationNotice() ? 'notice' : '' }}"
                        data-message-id="{{ $message->id }}"
                    >
                        <strong>{{ $message->isClassificationNotice() ? 'Pemberitahuan layanan' : ($message->sender === 'admin' ? 'Apoteker' : $consultation->nama) }}</strong>
                        @if ($message->message)<p>{{ $message->message }}</p>@endif
                        @if ($message->image)
                            <a class="workflow-attachment" href="{{ route('chat.attachment', ['consultation'=>$consultation,'message'=>$message]) }}" target="_blank" rel="noopener">Buka {{ $message->attachmentName() }} ↗</a>
                        @endif
                        <div class="workflow-message-footer">
                            <time>{{ $local->format('H.i') }} WIB</time>
                            @if ($message->sender === 'admin')
                                <span class="admin-read-receipt {{ $isRead ? 'is-read' : 'is-delivered' }}" data-admin-read-receipt data-message-id="{{ $message->id }}" title="{{ $isRead ? 'Sudah dibaca pasien' : 'Belum dibaca pasien' }}">✓✓</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <p>Belum ada pesan.</p>
                @endforelse
            </div>
            @if ($consultation->status === 'aktif')
                <form class="workflow-reply" action="{{ route('admin.chat.reply', $consultation) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="return_to" value="workflow">
                    <textarea name="message" maxlength="2000" placeholder="Tulis balasan singkat sambil meninjau prosedur..."></textarea>
                    <div class="workflow-reply-actions">
                        <input class="workflow-file" type="file" name="image" accept="image/jpeg,image/png,image/webp,application/pdf">
                        <button class="workflow-send" type="submit">Kirim balasan</button>
                    </div>
                </form>
            @endif
        </aside>
    </div>
</main>

<script>
(() => {
    const classificationSelect = document.querySelector('[data-classification-select]');
    const classificationForm = document.querySelector('[data-classification-form]');
    const reasonWrap = document.querySelector('[data-classification-reason]');
    const reasonInput = document.querySelector('[data-classification-reason-input]');
    const noticeWrap = document.querySelector('[data-classification-notice-preview]');
    const noticeText = document.querySelector('[data-classification-notice-text]');
    const noticeToggle = document.querySelector('[data-classification-notice-toggle]');
    const currentClassification = classificationForm?.dataset.currentClassification ?? '';

    function refreshClassificationControls() {
        if (!classificationSelect) return;
        const option = classificationSelect.selectedOptions[0];
        const changed = Boolean(currentClassification)
            && classificationSelect.value !== currentClassification;
        const message = option?.dataset.noticeMessage ?? '';

        if (reasonWrap) reasonWrap.hidden = !changed;
        if (reasonInput) reasonInput.required = changed;
        if (noticeWrap) noticeWrap.hidden = !message;
        if (noticeText) noticeText.textContent = message;
    }

    classificationSelect?.addEventListener('change', refreshClassificationControls);
    refreshClassificationControls();

    classificationForm?.addEventListener('submit', (event) => {
        if (noticeToggle?.checked && !window.confirm(
            'Simpan klasifikasi dan kirim pemberitahuan kepada pasien?'
        )) {
            event.preventDefault();
        }
    });

    const list = document.getElementById('workflowMessageList');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    function lastMessageId() {
        return Array.from(list?.querySelectorAll('[data-message-id]') ?? [])
            .reduce((max, node) => Math.max(max, Number(node.dataset.messageId) || 0), 0);
    }

    function updateReadReceipts(lastReadId) {
        const readId = Number(lastReadId) || 0;
        document.querySelectorAll('[data-admin-read-receipt]').forEach((node) => {
            const isRead = Number(node.dataset.messageId) <= readId;
            node.classList.toggle('is-read', isRead);
            node.classList.toggle('is-delivered', !isRead);
            node.title = isRead ? 'Sudah dibaca pasien' : 'Belum dibaca pasien';
        });
    }

    function appendMessage(message) {
        if (!list || !message?.id || list.querySelector(`[data-message-id="${message.id}"]`)) return;
        const article = document.createElement('article');
        const notice = message.message_kind === 'classification_notice';
        article.className = `workflow-message ${message.sender === 'admin' ? 'admin' : 'patient'}${notice ? ' notice' : ''}`;
        article.dataset.messageId = message.id;
        const sender = document.createElement('strong');
        sender.textContent = notice ? 'Pemberitahuan layanan' : (message.sender === 'admin' ? 'Apoteker' : 'Pasien');
        article.appendChild(sender);
        if (message.message) {
            const p = document.createElement('p'); p.textContent = message.message; article.appendChild(p);
        }
        const attachment = message.attachment_download_url ?? message.attachment_url;
        if (attachment) {
            const a = document.createElement('a'); a.className = 'workflow-attachment'; a.href = attachment; a.target = '_blank'; a.rel = 'noopener'; a.textContent = `Buka ${message.attachment_name ?? 'lampiran'} ↗`; article.appendChild(a);
        }
        const footer = document.createElement('div'); footer.className = 'workflow-message-footer';
        const time = document.createElement('time'); time.textContent = new Intl.DateTimeFormat('id-ID',{hour:'2-digit',minute:'2-digit',hour12:false,timeZone:@json($timezone)}).format(new Date(message.created_at)).replace('.',':') + ' WIB'; footer.appendChild(time);
        if (message.sender === 'admin') {
            const receipt = document.createElement('span'); receipt.className = `admin-read-receipt ${message.is_read_by_patient ? 'is-read' : 'is-delivered'}`; receipt.dataset.adminReadReceipt=''; receipt.dataset.messageId=message.id; receipt.textContent='✓✓'; footer.appendChild(receipt);
        }
        article.appendChild(footer); list.appendChild(article); list.scrollTop = list.scrollHeight;
    }

    async function syncMessages() {
        if (!list?.dataset.messagesUrl) return;
        const url = new URL(list.dataset.messagesUrl, window.location.origin);
        url.searchParams.set('after_id', String(lastMessageId()));
        try {
            const response = await fetch(url,{credentials:'same-origin',headers:{Accept:'application/json','X-Requested-With':'XMLHttpRequest','X-CSRF-TOKEN':csrfToken}});
            if (!response.ok) return;
            const data = await response.json();
            (data.messages ?? []).forEach(appendMessage);
            updateReadReceipts(data.patient_last_read_message_id);
        } catch (_) {}
    }

    if (list) { list.scrollTop = list.scrollHeight; window.setInterval(syncMessages, 4000); }
})();
</script>
</body>
</html>
