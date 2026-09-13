@props([ 'message' => session('success'), 'type' => 'success', ])
<div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-4 shadow-sm">
            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                    ✓
                </div>

                <div>
                    <h4 class="text-sm font-bold text-emerald-700">
                        عملیات موفق بود
                    </h4>

                    <p class="mt-1 text-sm text-emerald-600">
                        {{ session('success') }}
                    </p>
                </div>

            </div>
        </div>
    @endif


    @if(session('error'))
        <div class="mb-6 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-4 shadow-sm">
            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                    !
                </div>

                <div>
                    <h4 class="text-sm font-bold text-amber-700">
                        توجه
                    </h4>

                    <p class="mt-1 text-sm text-amber-600">
                        {{ session('error') }}
                    </p>
                </div>

            </div>
        </div>
    @endif
</div>
