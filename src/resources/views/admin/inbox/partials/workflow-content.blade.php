{{-- Shared service workflow content. Used on the dedicated procedure page. --}}
@if (! $isReadOnly)
<form
    class="classification-form"
    action="{{ route(
        'admin.inbox.classification',
        $consultation
    ) }}"
    method="POST"
    data-classification-form
    data-current-classification="{{
        $consultation->service_classification ?? ''
    }}"
>
    @csrf

    <label for="serviceClassification">
        Ubah klasifikasi
    </label>

    <div class="classification-control">
        <select
            id="serviceClassification"
            name="service_classification"
            required
            data-classification-select
        >
            <option value="" disabled {{
                $consultation->service_classification
                    ? ''
                    : 'selected'
            }}>
                Pilih kategori pelayanan
            </option>

            @foreach ($classificationOptions as $value => $label)
                <option
                    value="{{ $value }}"
                    data-notice-message="{{
                        $classificationNoticeTemplates[$value]['message']
                            ?? ''
                    }}"
                    @selected(
                        $consultation->service_classification
                            === $value
                    )
                >
                    {{ $label }}
                </option>
            @endforeach
        </select>

        <button
            type="submit"
            data-classification-submit
        >
            Simpan
        </button>
    </div>

    <div
        class="classification-reason"
        data-classification-reason
        hidden
    >
        <label for="classificationReason">
            Alasan perubahan
            <span>Wajib</span>
        </label>

        <textarea
            id="classificationReason"
            name="classification_reason"
            rows="2"
            maxlength="1000"
            placeholder="Jelaskan alasan kategori pelayanan diubah."
            data-classification-reason-input
        ></textarea>

        <small>
            Alasan tersimpan pada audit internal dan tidak dikirim
            kepada pasien.
        </small>
    </div>

    <div
        class="classification-notice-preview"
        data-classification-notice-preview
        hidden
    >
        <label class="classification-notice-toggle">
            <input
                type="checkbox"
                name="send_classification_notice"
                value="1"
                @checked($consultation->status === 'aktif')
                @disabled($consultation->status !== 'aktif')
                data-classification-notice-toggle
            >
            <span>
                {{
                    $consultation->status === 'aktif'
                        ? 'Kirim pemberitahuan ini kepada pasien'
                        : 'Aktifkan kembali konsultasi untuk mengirim pemberitahuan'
                }}
            </span>
        </label>

        <div class="classification-notice-card">
            <strong>
                Pratinjau pesan otomatis
            </strong>
            <p data-classification-notice-text></p>
            <small>
                Pesan dikirim sebagai pemberitahuan berdasarkan
                keputusan petugas yang menangani dan disimpan sebagai
                snapshot audit. Isi pratinjau tidak dapat diedit.
            </small>
        </div>
    </div>

    <span
        class="classification-feedback"
        data-classification-feedback
        aria-live="polite"
    ></span>
</form>
@else
    <div class="consultation-readonly-notice">
        <strong>Konsultasi selesai — hanya-baca</strong>
        <p>
            Klasifikasi, skrining, dan hasil akhir dikunci untuk menjaga
            integritas catatan. Aktifkan kembali konsultasi dengan alasan
            yang jelas sebelum melakukan perubahan.
        </p>
    </div>
@endif

<div
    class="screening-slot"
    data-screening-slot
>
    @include(
        'admin.inbox.partials.screening-panel',
        compact('consultation', 'timezone')
    )
</div>

<div
    class="outcome-slot"
    data-outcome-slot
>
    @include(
        'admin.inbox.partials.outcome-panel',
        compact('consultation', 'timezone')
    )
</div>

<div
    class="classification-history-slot"
    data-classification-history-slot
>
    @include(
        'admin.inbox.partials.classification-history',
        compact('consultation', 'timezone')
    )
</div>

@include(
    'admin.inbox.partials.status-history',
    compact('consultation', 'timezone')
)
