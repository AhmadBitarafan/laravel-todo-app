<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Todo Details</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-800">


<!-- ================= HEADER ================= -->
<x-header></x-header>


<!-- ================= MAIN ================= -->

<main class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">


    <!-- ================= PAGE HEADER ================= -->

    <div class="mb-8">

        <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600">

            <span class="h-2 w-2 rounded-full bg-indigo-600"></span>

            جزئیات Todo

        </div>


        <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
            مشاهده Todo
        </h1>


        <p class="mt-2 text-sm leading-7 text-slate-500">
            جزئیات کامل این Todo را مشاهده کنید.
        </p>

    </div>


    <!-- ================= TODO CARD ================= -->

    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


        <!-- Top Section -->

        <div class="p-6 sm:p-8">


            <!-- Status + Title -->

            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">


                <!-- Title -->

                <div class="min-w-0">

                    <div class="mb-3 flex flex-wrap items-center gap-2">

                        @if($todo->completed)
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-600">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                تکمیل شده
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-600">
                                <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                                در حال انجام
                            </span>
                        @endif

                    </div>


                    <h2 class="break-words text-2xl font-extrabold leading-relaxed sm:text-3xl {{ $todo->completed ? 'text-slate-400 line-through' : 'text-slate-900' }}">
                        {{ $todo->title }}
                    </h2>

                </div>


                <!-- Complete Toggle -->

                <form
                    action="{{ route('todos.update', $todo->id) }}"
                    method="POST"
                    class="shrink-0"
                >
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="title" value="{{ $todo->title }}">
                    <input type="hidden" name="description" value="{{ $todo->description }}">
                    <input type="hidden" name="completed" value="0">

                    <label
                        class="{{ $todo->completed
                            ? 'flex cursor-pointer items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-sm font-bold text-emerald-600 transition hover:border-slate-200 hover:bg-slate-50 hover:text-slate-600'
                            : 'flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-bold text-slate-600 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600' }}"
                    >
                        <input
                            type="checkbox"
                            name="completed"
                            value="1"
                            {{ $todo->completed ? 'checked' : '' }}
                            onchange="this.form.submit()"
                            class="sr-only"
                        >

                        <span class="flex h-6 w-6 items-center justify-center rounded-full text-xs {{ $todo->completed ? 'bg-emerald-500 text-white' : 'border-2 border-slate-300 bg-white text-transparent' }}">
                            ✓
                        </span>

                        {{ $todo->completed ? 'علامت‌گذاری به عنوان انجام‌نشده' : 'علامت‌گذاری به عنوان انجام شده' }}
                    </label>
                </form>

            </div>


            <!-- Divider -->

            <div class="my-8 border-t border-slate-100"></div>


            <!-- ================= DESCRIPTION ================= -->

            <div>

                <h3 class="mb-3 text-sm font-bold text-slate-700">
                    توضیحات
                </h3>


                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">

                    <p class="text-sm leading-8 text-slate-600">
                        {{ $todo->description }}
                    </p>

                </div>

            </div>


            <!-- ================= INFORMATION ================= -->

            <div class="mt-8">

                <h3 class="mb-4 text-sm font-bold text-slate-700">
                    اطلاعات Todo
                </h3>


                <div class="grid gap-4 sm:grid-cols-2">


                    <!-- Created At -->

                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"
                                    />
                                </svg>

                            </div>


                            <div>

                                <p class="text-xs text-slate-400">
                                    ایجاد شده در
                                </p>

                                <p class="mt-1 text-sm font-bold text-slate-700">
                                    {{ $todo->created_at }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Updated At -->

                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6v6l4 2m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>

                            </div>


                            <div>

                                <p class="text-xs text-slate-400">
                                    آخرین بروزرسانی
                                </p>

                                <p class="mt-1 text-sm font-bold text-slate-700">
                                    {{ $todo->updated_at }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Status -->

                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl {{ $todo->completed ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                @if($todo->completed)
                                    ✓
                                @else
                                    ⏳
                                @endif
                            </div>


                            <div>

                                <p class="text-xs text-slate-400">
                                    وضعیت
                                </p>

                                <p class="mt-1 text-sm font-bold {{ $todo->completed ? 'text-emerald-600' : 'text-amber-600' }}">
                                    {{ $todo->completed ? 'تکمیل شده' : 'در حال انجام' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- ID -->

                    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                                #
                            </div>


                            <div>

                                <p class="text-xs text-slate-400">
                                    شناسه Todo
                                </p>

                                <p class="mt-1 text-sm font-bold text-slate-700">
                                    #{{ $todo->id }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ================= ACTIONS ================= -->

        <div class="border-t border-slate-100 bg-slate-50/70 p-6 sm:px-8">

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">


                <!-- Back -->

                <a
                    href="{{ route('todos.index') }}"
                    class="rounded-xl border border-slate-200 bg-white px-6 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    بازگشت
                </a>


                <div class="flex flex-col gap-3 sm:flex-row">


                    <!-- Edit -->

                    <a
                        href="{{ route('todos.edit', $todo->id) }}"
                        class="rounded-xl border border-indigo-200 bg-indigo-50 px-6 py-3 text-center text-sm font-bold text-indigo-700 transition hover:bg-indigo-100"
                    >
                        ویرایش Todo
                    </a>


                    <!-- Delete -->

                    <form
                        action="{{ route('todos.destroy', $todo->id) }}"
                        method="POST"
                        onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این Todo را حذف کنید؟')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-xl border border-red-200 bg-red-50 px-6 py-3 text-sm font-bold text-red-600 transition hover:bg-red-100 sm:w-auto"
                        >
                            حذف Todo
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>

</main>

</body>
</html>
