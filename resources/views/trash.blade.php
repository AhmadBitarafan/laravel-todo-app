<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>سطل زباله</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Vazirmatn', 'ui-sans-serif', 'system-ui']
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-800">

<<!-- ================= HEADER ================= -->

<x-header></x-header>

<!-- ================= MAIN ================= -->

<main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

    <!-- Page Header -->

    <section class="mb-8">

        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-1 text-xs font-bold text-red-500">
                    <span class="h-2 w-2 rounded-full bg-red-500"></span>
                    سطل زباله
                </div>

                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Todo های حذف‌شده
                </h2>

                <p class="mt-2 max-w-xl text-sm leading-7 text-slate-500">
                    این موارد حذف شده‌اند اما هنوز قابل بازگردانی‌اند. می‌توانید هر مورد را
                    انتخاب کنید و آن را بازگردانید یا برای همیشه حذف کنید.
                </p>

            </div>

            <!-- Stat -->

            <div class="min-w-[120px] rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center shadow-sm">
{{--                <!-- در بلید: {{ count($trashed_todos) }} -->--}}
                <div class="text-xl font-extrabold text-red-500">
                    {{$trashed_count}}
                </div>

                <div class="mt-1 text-xs text-slate-400">
                    مورد در سطل زباله
                </div>
            </div>

        </div>

    </section>


        <!-- ================= TRASH LIST ================= -->


        <section class="space-y-3">

            <!-- Items -->
            <form id="bulk-trash-form" action="#" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- ... toolbar بدون تغییر ... -->

                <section class="space-y-3">
                    @forelse($trashed_items as $trashed_item)
                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                                <div class="flex gap-4">
                                    <div class="min-w-0">
                                        <h3 class="text-base font-bold text-slate-400 line-through sm:text-lg">
                                            {{ $trashed_item->title }}
                                        </h3>
                                        <p class="mt-2 max-w-3xl text-sm leading-7 text-slate-400">
                                            {{ $trashed_item->description }}
                                        </p>
                                        <div class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-xs text-slate-400">
                                            <span>ایجاد شده: {{ $trashed_item->created_at }}</span>
                                            <span>حذف شده در: {{ $trashed_item->deleted_at }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- دیگه فرم نیست، فقط دکمه با attribute form -->
                                <div class="flex shrink-0 items-center gap-2">
                                    <button
                                        type="submit"
                                        form="restore-{{ $trashed_item->id }}"
                                        class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-600 transition hover:bg-emerald-100"
                                    >
                                        بازگردانی
                                    </button>

                                    <button
                                        type="submit"
                                        form="force-delete-{{ $trashed_item->id }}"
                                        class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100"
                                    >
                                        حذف همیشگی
                                    </button>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-slate-400">
                            سطل زباله خالی است.
                        </div>
                    @endforelse
                </section>
            </form>

            <!-- فرم‌های واقعی هر ردیف، بیرون از bulk-trash-form -->
            @foreach($trashed_items as $trashed_item)
                <form id="restore-{{ $trashed_item->id }}"
                      action="{{ route('todos.trashed.restore', $trashed_item->id) }}"
                      method="POST" class="hidden">
                    @csrf
                    @method('PATCH')
                </form>

                <form id="force-delete-{{ $trashed_item->id }}"
                      action="{{ route('todos.trashed.forceDelete', $trashed_item->id) }}"
                      method="POST" class="hidden"
                      onsubmit="return confirm('آیا از حذف همیشگی این Todo مطمئن هستید؟ این عمل غیرقابل بازگشت است.');">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach


        </section>

    </form>


    <!-- ================= فرم‌های تکی هر آیتم ================= -->
    <!-- عمداً بیرون از bulk-trash-form قرار گرفته‌اند چون تو در تو کردن form مجاز نیست؛
         دکمه‌های هر ردیف با attribute «form» به همین فرم‌ها وصل شده‌اند.
{{--         در بلید: action ها به route('todos.restore', $todo->id) و route('todos.forceDelete', $todo->id) تبدیل و @csrf/@method جایگزین می‌شوند -->--}}

    <form id="restore-12" action="#" method="POST" class="hidden">
        <input type="hidden" name="_token" value="CSRF_TOKEN_PLACEHOLDER"> <!-- @csrf -->
        <input type="hidden" name="_method" value="PUT"> <!-- @method('PUT') -->
    </form>

    <form
        id="force-delete-12"
        action="#"
        method="POST"
        class="hidden"
        onsubmit="return confirm('آیا از حذف همیشگی این Todo مطمئن هستید؟ این عمل غیرقابل بازگشت است.');"
    >
        <input type="hidden" name="_token" value="CSRF_TOKEN_PLACEHOLDER"> <!-- @csrf -->
        <input type="hidden" name="_method" value="DELETE"> <!-- @method('DELETE') -->
    </form>

    <form id="restore-9" action="#" method="POST" class="hidden">
        <input type="hidden" name="_token" value="CSRF_TOKEN_PLACEHOLDER">
        <input type="hidden" name="_method" value="PUT">
    </form>

    <form
        id="force-delete-9"
        action="#"
        method="POST"
        class="hidden"
        onsubmit="return confirm('آیا از حذف همیشگی این Todo مطمئن هستید؟ این عمل غیرقابل بازگشت است.');"
    >
        <input type="hidden" name="_token" value="CSRF_TOKEN_PLACEHOLDER">
        <input type="hidden" name="_method" value="DELETE">
    </form>

    <form id="restore-5" action="#" method="POST" class="hidden">
        <input type="hidden" name="_token" value="CSRF_TOKEN_PLACEHOLDER">
        <input type="hidden" name="_method" value="PUT">
    </form>

    <form
        id="force-delete-5"
        action="#"
        method="POST"
        class="hidden"
        onsubmit="return confirm('آیا از حذف همیشگی این Todo مطمئن هستید؟ این عمل غیرقابل بازگشت است.');"
    >
        <input type="hidden" name="_token" value="CSRF_TOKEN_PLACEHOLDER">
        <input type="hidden" name="_method" value="DELETE">
    </form>

</main>


<script>
    (function () {
        const selectAll = document.getElementById('select-all');
        const itemCheckboxes = document.querySelectorAll('.trash-item-checkbox');
        const selectedCountEl = document.getElementById('selected-count');
        const restoreBtn = document.getElementById('bulk-restore-btn');
        const forceDeleteBtn = document.getElementById('bulk-force-delete-btn');

        function updateBulkBar() {
            const checked = document.querySelectorAll('.trash-item-checkbox:checked');
            selectedCountEl.textContent = checked.length;

            const hasSelection = checked.length > 0;
            restoreBtn.disabled = !hasSelection;
            forceDeleteBtn.disabled = !hasSelection;

            selectAll.checked = itemCheckboxes.length > 0 && checked.length === itemCheckboxes.length;
        }

        selectAll.addEventListener('change', function () {
            itemCheckboxes.forEach(function (cb) {
                cb.checked = selectAll.checked;
            });
            updateBulkBar();
        });

        itemCheckboxes.forEach(function (cb) {
            cb.addEventListener('change', updateBulkBar);
        });

        forceDeleteBtn.addEventListener('click', function (e) {
            const checked = document.querySelectorAll('.trash-item-checkbox:checked').length;
            if (checked > 0 && !confirm('آیا از حذف همیشگی ' + checked + ' مورد انتخاب‌شده مطمئن هستید؟ این عمل غیرقابل بازگشت است.')) {
                e.preventDefault();
            }
        });

        updateBulkBar();
    })();
</script>

</body>
</html>
