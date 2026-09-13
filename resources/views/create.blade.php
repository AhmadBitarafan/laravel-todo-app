<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Todo</title>

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

    <div class="mb-8">

        <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600">
            <span class="h-2 w-2 rounded-full bg-indigo-600"></span>
            Todo جدید
        </div>

        <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">
            ایجاد Todo
        </h1>

        <p class="mt-2 text-sm leading-7 text-slate-500">
            اطلاعات Todo جدید را وارد کنید.
        </p>

    </div>


    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

        <form
            action="{{ route('todos.store') }}"
            method="POST"
            class="space-y-6"
        >
            @csrf

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
                    value="{{ old('title') }}"
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
                >{{ old('description') }}</textarea>

                @error('description')
                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                @enderror

            </div>


            <!-- Buttons -->

            <div class="flex flex-col gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('todos.index') }}"
                    class="rounded-xl border border-slate-200 bg-white px-6 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    انصراف
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 active:scale-95"
                >
                    ایجاد Todo
                </button>

            </div>

        </form>

    </div>

</main>

</body>
</html>
