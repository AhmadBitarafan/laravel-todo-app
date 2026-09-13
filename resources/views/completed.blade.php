<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>کارهای تکمیل‌شده | Todo Manager</title>

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
    @if(session('error'))
        <x-alert   message="{{session('error')}}"
                   type="error"/>
    @elseif(session('success'))
        <x-alert   message="{{session('success')}}"
                   type="success"/>
    @endif

    <!-- Page Header -->

    <section class="mb-8">

        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-600">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    انجام‌شده
                </div>

                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    کارهای تکمیل‌شده
                </h2>

                <p class="mt-2 max-w-xl text-sm leading-7 text-slate-500">
                    وظایفی که به پایان رسانده‌ای. در صورت نیاز می‌توانی هر کدام
                    را دوباره به حالت در حال انجام برگردانی.
                </p>

            </div>


            <!-- Stat -->

            <div class="min-w-[110px] rounded-2xl border border-slate-200 bg-white px-5 py-3 text-center shadow-sm">
                <div class="text-xl font-extrabold text-emerald-500">
                    {{$completed_count}}
                </div>
                <div class="mt-1 text-xs text-slate-400">
                    تکمیل‌شده
                </div>
            </div>

        </div>

    </section>


    <!-- ================= TODO LIST ================= -->

    <section class="space-y-3">

        <!-- Todo Card -->
        @forelse($completed_todos as $completed_todo)
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex gap-4">


                            <label
                                title="علامت‌گذاری به عنوان انجام‌نشده"
                                class="mt-1 flex h-7 w-7 shrink-0 cursor-pointer items-center justify-center rounded-full border-2 border-emerald-500 bg-emerald-500 text-sm font-bold text-white transition hover:bg-emerald-600"
                            >
                                <input type="checkbox" name="completed" value="1" checked onchange="this.form.submit()" class="sr-only">
                                ✓
                            </label>

                        <div class="min-w-0">
                            @if(session('error'))
                                <x-alert   message="{{session('error')}}"
                                           type="error"/>
                            @else
                                <x-alert   message="{{session('success')}}"
                                           type="success"/>
                            @endif
                            <div class="flex flex-wrap items-center gap-2">
                                <a href="{{route('todos.show' , $completed_todo->id)}}" class="min-w-0">
                                    <h3 class="text-base font-bold text-slate-400 line-through sm:text-lg">
                                        {{$completed_todo->title}}
                                    </h3>
                                </a>
                                <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-600">
                                انجام شده
                            </span>
                            </div>

                            <p class="mt-2 max-w-3xl text-sm leading-7 text-slate-400">
                                {{$completed_todo->description}}
                            </p>

                            <div class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-xs text-slate-400">
                                <span>ایجاد شده: {{$completed_todo->created_at}}</span>
                                <span>آخرین بروزرسانی: ۱{{$completed_todo->updated_at}}</span>
                            </div>

                        </div>

                    </div>

                    <div class="flex shrink-0 items-center gap-2">
                        <a
                            href="{{ route('todos.edit', $completed_todo['id']) }}"
                            class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700"
                        >
                            ویرایش
                        </a>
                        <form action="{{route('todos.destroy',$completed_todo->id)}}" method="POST" onsubmit="return confirm('آیا از حذف این Todo مطمئن هستید؟');">
                            @method('DELETE')
                            <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                                حذف
                            </button>
                        </form>
                    </div>

                </div>

            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-slate-400">
                هنوز هیچ کاری تکمیل نکرده‌ای.
            </div>
        @endforelse


    </section>

</main>

</body>
</html>
