<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Todo</title>

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


<!-- ================= HEADER ================= -->

<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">

    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

        <!-- Logo -->
        <a href="{{ route('todos.index') }}" class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-lg font-bold text-white shadow-lg shadow-indigo-600/20">
                ✓
            </div>

            <div class="hidden sm:block">
                <h1 class="font-bold text-slate-900">
                    Todo Manager
                </h1>

                <p class="text-xs text-slate-500">
                    مدیریت کارهای روزانه
                </p>
            </div>

        </a>

        <!-- Back -->
        <a
            href="{{ route('todos.index') }}"
            class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
        >
            بازگشت به Todoها
        </a>

    </div>

</header>

<!-- ================= MAIN ================= -->

<main class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    @if(session('error'))
        <x-alert   message="{{session('error')}}"
                   type="error"/>
    @elseif(session('success'))
        <x-alert   message="{{session('success')}}"
                   type="success"/>
    @endif

    <!-- Page Header -->

    <div class="mb-8">

        <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600">
            <span class="h-2 w-2 rounded-full bg-indigo-600"></span>
            ویرایش Todo
        </div>

        <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">
            ویرایش وظیفه
        </h1>

        <p class="mt-2 text-sm leading-7 text-slate-500">
            اطلاعات Todo را تغییر دهید و تغییرات را ذخیره کنید.
        </p>

    </div>


    <!-- ================= FORM ================= -->

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

        {{-- فقط عنوان و توضیحات داخل این فرم‌اند؛ باکس وضعیت و دکمه‌ها بیرون از آن‌اند
             چون تو در تو کردن form مجاز نیست. دکمه‌ی «ذخیره تغییرات» با
             attribute «form="edit-form"» به همین فرم وصل می‌شود --}}
        <form
            id="edit-form"
            action="{{ route('todos.update', $todo['id']) }}"
            method="POST"
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            <!-- Title -->

            <div>

                <label
                    for="title"
                    class="mb-2 block text-sm font-bold text-slate-700"
                >
                    عنوان
                </label>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title', $todo['title']) }}"
                    placeholder="مثلاً طراحی صفحه داشبورد"
                    maxlength="255"
                    required
                    autocomplete="off"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                >

                @error('title')
                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                @enderror

            </div>


            <!-- Description -->

            <div>

                <label
                    for="description"
                    class="mb-2 block text-sm font-bold text-slate-700"
                >
                    توضیحات
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    placeholder="توضیحات مربوط به این وظیفه..."
                    class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm leading-7 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                >{{ old('description', $todo['description']) }}</textarea>

                @error('description')
                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                @enderror

            </div>

        </form>


        <!-- ================= CURRENT STATUS (قابل تغییر از همین‌جا) ================= -->

        <div class="mt-6 rounded-2xl border border-slate-100 bg-slate-50 p-4">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <p class="text-sm font-bold text-slate-800">
                        وضعیت فعلی
                    </p>

                    <p class="mt-1 text-xs leading-6 text-slate-500">
                        با کلیک روی دکمه‌ی روبرو وضعیت این Todo را تغییر بده.
                    </p>

                </div>

                <form action="{{ route('todos.update', $todo['id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- title/description هم فرستاده می‌شن تا اگر UpdateTodoRequest این فیلدها را
                         required بداند، فرم toggle هم معتبر باشد --}}
                    <input type="hidden" name="title" value="{{ $todo['title'] }}">
                    <input type="hidden" name="description" value="{{ $todo['description'] }}">

                    {{-- اینپوت مخفیِ 0 قبل از چک‌باکس: وقتی چک‌باکس تیک نخورد (false) همین مقدار
                         ارسال می‌شود؛ وقتی تیک بخورد، مقدار چک‌باکس (1) آخرین مقدار و برنده است --}}
                    <input type="hidden" name="completed" value="0">

                    <label
                        class="inline-flex w-fit cursor-pointer items-center gap-2 rounded-full px-3 py-1.5 text-xs font-bold transition {{ $todo['completed'] ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' : 'bg-amber-50 text-amber-600 hover:bg-amber-100' }}"
                    >
                        <input
                            type="checkbox"
                            name="completed"
                            value="1"
                            {{ $todo['completed'] ? 'checked' : '' }}
                            onchange="this.form.submit()"
                            class="sr-only"
                        >

                        <span class="flex h-5 w-5 items-center justify-center rounded-full text-[10px] {{ $todo['completed'] ? 'bg-emerald-500 text-white' : 'border-2 border-amber-400 bg-white text-transparent' }}">
                            ✓
                        </span>

                        {{ $todo['completed'] ? 'تکمیل شده' : 'در حال انجام' }}
                    </label>
                </form>

            </div>

        </div>


        <!-- ================= META ================= -->

        <div class="mt-6 grid gap-3 sm:grid-cols-2">

            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                <p class="text-xs font-medium text-slate-400">
                    ایجاد شده در
                </p>

                <p class="mt-2 text-sm font-bold text-slate-700">
                    {{ $todo['created_at'] }}
                </p>

            </div>

            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                <p class="text-xs font-medium text-slate-400">
                    آخرین بروزرسانی
                </p>

                <p class="mt-2 text-sm font-bold text-slate-700">
                    {{ $todo['updated_at'] }}
                </p>

            </div>

        </div>


        <!-- ================= BUTTONS ================= -->

        <div class="mt-6 flex flex-col gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:items-center sm:justify-between">

            <!-- Cancel -->

            <a
                href="{{ route('todos.index') }}"
                class="rounded-xl border border-slate-200 px-6 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
            >
                انصراف
            </a>


            <div class="flex flex-col gap-3 sm:flex-row">

                <!-- Delete -->

                <form
                    action="{{ route('todos.destroy', $todo['id']) }}"
                    method="POST"
                    onsubmit="return confirm('آیا از حذف این Todo مطمئن هستید؟');"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="w-full rounded-xl border border-red-200 bg-red-50 px-6 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100 sm:w-auto"
                    >
                        حذف Todo
                    </button>
                </form>

                <!-- Update -->

                <button
                    type="submit"
                    form="edit-form"
                    class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 active:scale-95"
                >
                    ذخیره تغییرات
                </button>

            </div>

        </div>

    </div>

</main>

</body>
</html>
