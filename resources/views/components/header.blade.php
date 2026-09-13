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


        <!-- Navigation -->
        <nav class="hidden items-center gap-1 md:flex">

            {{-- همه Todoها --}}

            <a href="{{ route('todos.index') }}"
            class="rounded-xl px-4 py-2 text-sm font-medium transition
            {{ request()->routeIs('todos.index')
                ? 'bg-indigo-50 text-indigo-700'
                : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'
            }}"
            >
            همه Todoها
            </a>


            {{-- در حال انجام --}}

            <a href="{{ route('todos.pending') }}"
            class="rounded-xl px-4 py-2 text-sm font-medium transition
            {{ request()->routeIs('todos.pending')
                ? 'bg-indigo-50 text-indigo-700'
                : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'
            }}"
            >
            در حال انجام
            </a>


            {{-- تکمیل شده --}}

            <a href="{{ route('todos.completed') }}"
            class="rounded-xl px-4 py-2 text-sm font-medium transition
            {{ request()->routeIs('todos.completed')
                ? 'bg-indigo-50 text-indigo-700'
                : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'
            }}"
            >
            تکمیل شده
            </a>


            {{-- سطل زباله --}}

            <a href="{{ route('todos.trashed') }}"
            class="rounded-xl px-4 py-2 text-sm font-medium transition
            {{ request()->routeIs('todos.trashed')
                ? 'bg-indigo-50 text-indigo-700'
                : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900'
            }}"
            >
            سطل زباله
            </a>

        </nav>



        <!-- Add Button -->


        <a href="{{ route('todos.create') }}"
        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 active:scale-95"
        >

        <span class="text-xl leading-none">
                    +
                </span>

        <span class="hidden sm:inline">
                    Todo جدید
                </span>

        </a>

    </div>

</header>
