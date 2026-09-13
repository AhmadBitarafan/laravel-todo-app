<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Todo Manager</title>

    <!-- Tailwind CDN -->
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

    <!-- Persian Font -->
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-800">

<!-- ================= HEADER ================= -->
<x-header></x-header>

<!-- ================= MAIN ================= -->

<main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">


    <!-- Page Header -->

    <section class="mb-8">

        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <div
                    class="mb-3 inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600">
                    <span class="h-2 w-2 rounded-full bg-indigo-600"></span>
                    مدیریت وظایف
                </div>

                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    کارهای من
                </h2>

                <p class="mt-2 max-w-xl text-sm leading-7 text-slate-500">
                    وظایف روزانه‌ات را مدیریت کن، کارهای انجام‌شده را علامت بزن
                    و همیشه مرتب بمان.
                </p>

            </div>


            <!-- Stats -->

            <div class="grid grid-cols-3 gap-3">

                <div class="min-w-[90px] rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center shadow-sm">
                    <div class="text-xl font-extrabold text-slate-900">
                        {{$total_todos_count}}
                    </div>

                    <div class="mt-1 text-xs text-slate-400">
                        کل
                    </div>
                </div>

                <div class="min-w-[90px] rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center shadow-sm">
                    <div class="text-xl font-extrabold text-amber-500">
                        {{$total_todos_count-$total_done_todos_count}}
                    </div>

                    <div class="mt-1 text-xs text-slate-400">
                        باقی‌مانده
                    </div>
                </div>

                <div class="min-w-[90px] rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center shadow-sm">
                    <div class="text-xl font-extrabold text-emerald-500">
                        {{$total_done_todos_count}}
                    </div>

                    <div class="mt-1 text-xs text-slate-400">
                        انجام‌شده
                    </div>
                </div>

            </div>

        </div>

    </section>


    <!-- ================= TODO LIST ================= -->

    <section class="space-y-3">

        @forelse($todos as $todo)

            {{-- یک کارت واحد؛ فقط وقتی completed === false باشد کلاس‌ها/برچسب فرق می‌کنند --}}
            <article class="{{ $todo['completed']
                ? 'rounded-2xl border border-slate-200 bg-white p-5 shadow-sm'
                : 'group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-xl' }}">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                    <!-- Content -->

                    <div class="flex gap-4">

                        <!-- Complete / Toggle Checkbox -->

                        <form
                            action="{{ route('todos.update', $todo['id']) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')

                            <label
                                title="{{ $todo['completed'] ? 'علامت‌گذاری به عنوان انجام‌نشده' : 'علامت‌گذاری به عنوان انجام‌شده' }}"
                                class="{{ $todo['completed']
                                    ? 'mt-1 flex h-7 w-7 shrink-0 cursor-pointer items-center justify-center rounded-full border-2 border-emerald-500 bg-emerald-500 text-sm font-bold text-white transition hover:bg-emerald-600'
                                    : 'mt-1 flex h-7 w-7 shrink-0 cursor-pointer items-center justify-center rounded-full border-2 border-slate-300 text-sm text-transparent transition hover:border-indigo-500 hover:bg-indigo-50' }}"
                            >
                                <input
                                    type="checkbox"
                                    name="completed"
                                    value="1"
                                    {{ $todo['completed'] ? 'checked' : '' }}
                                    onchange="this.form.submit()"
                                    class="sr-only"
                                >
                                ✓
                            </label>
                        </form>


                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2">

                                <a href="{{ route('todos.show', $todo['id']) }}" class="min-w-0">
                                    <h3 class="{{ $todo['completed']
                                        ? 'text-base font-bold text-slate-400 line-through sm:text-lg'
                                        : 'text-base font-bold text-slate-900 sm:text-lg' }}">
                                        {{ $todo['title'] }}
                                    </h3>
                                </a>

                                @if($todo['completed'])
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-600">
                                        انجام شده
                                    </span>
                                @else
                                    <span class="rounded-full bg-amber-50 px-2.5 py-1 text-[11px] font-bold text-amber-600">
                                        در حال انجام
                                    </span>
                                @endif

                            </div>


                            <p class="mt-2 max-w-3xl text-sm leading-7 {{ $todo['completed'] ? 'text-slate-400' : 'text-slate-500' }}">
                                {{ $todo['description'] }}
                            </p>


                            <!-- Meta -->

                            <div class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-xs text-slate-400">

                                <span>
                                    ایجاد شده:
                                    {{ $todo['created_at'] }}
                                </span>

                                <span>
                                    آخرین بروزرسانی:
                                    {{ $todo['updated_at'] }}
                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- Actions -->

                    <div class="flex shrink-0 items-center gap-2">

                        <a
                            href="{{ route('todos.edit', $todo['id']) }}"
                            class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700"
                        >
                            ویرایش
                        </a>

                        <form
                            action="{{ route('todos.destroy', $todo['id']) }}"
                            method="POST"
                            onsubmit="return confirm('آیا از حذف این Todo مطمئن هستید؟');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100"
                            >
                                حذف
                            </button>
                        </form>

                    </div>

                </div>

            </article>

        @empty

            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-slate-400">
                هنوز هیچ Todoای ثبت نشده است.
            </div>

        @endforelse

    </section>


</main>

</body>
</html>
