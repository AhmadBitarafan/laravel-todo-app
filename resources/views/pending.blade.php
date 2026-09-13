<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>کارهای در حال انجام | Todo Manager</title>

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

                <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-600">
                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                    در انتظار انجام
                </div>

                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    کارهای در حال انجام
                </h2>

                <p class="mt-2 max-w-xl text-sm leading-7 text-slate-500">
                    این‌ها وظایفی هستند که هنوز تکمیل نشده‌اند. هر کدام را که
                    انجام دادی، از تیک کنار آن علامت بزن.
                </p>

            </div>


            <!-- Stat -->

            <div class="min-w-[110px] rounded-2xl border border-slate-200 bg-white px-5 py-3 text-center shadow-sm">
                <div class="text-xl font-extrabold text-amber-500">
                    {{$pending_count}}
                </div>
                <div class="mt-1 text-xs text-slate-400">
                    باقی‌مانده
                </div>
            </div>

        </div>

    </section>


    <!-- ================= TODO LIST ================= -->
{{--    <!-- در بلید: @forelse($todos as $todo) ... @empty ... @endforelse -->--}}
    <!-- کوئری این صفحه باید فقط completed = false را برگرداند -->

    <section class="space-y-3">

        <!-- Todo Card #1 -->
        @forelse($pending_todos as $pending_todo)
            <article class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-xl">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex gap-4">


                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2">
                                <a href="{{route('todos.show', $pending_todo->id)}}" class="min-w-0">
                                    <h3 class="text-base font-bold text-slate-900 sm:text-lg">
                                        {{$pending_todo->title}}
                                    </h3>
                                </a>
                                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-[11px] font-bold text-amber-600">
                                در حال انجام
                            </span>
                            </div>

                            <p class="mt-2 max-w-3xl text-sm leading-7 text-slate-500">
                                {{$pending_todo->description}}
                            </p>

                            <div class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-xs text-slate-400">
                                <span>ایجاد شده: {{$pending_todo->created_at}}</span>
                                <span>آخرین بروزرسانی: {{$pending_todo->updated_at}}</span>
                            </div>

                        </div>

                    </div>

                    <div class="flex shrink-0 items-center gap-2">
                        <a href="{{route('todos.edit' , $pending_todo->id)}}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                            ویرایش
                        </a>
                        <form action="{{route('todos.destroy',$pending_todo->id)}}" method="POST" onsubmit="return confirm('آیا از حذف این Todo مطمئن هستید؟');">
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
                هیچ کار در حال انجامی نداری. وقتشه یه Todo جدید اضافه کنی 🎉
            </div>
        @endforelse

    </section>

</main>

</body>
</html>
