<div v-for="column in available.columns">
    <div v-if="column.filterable">
        <!-- Boolean -->
        <div v-if="column.type === 'boolean'">
            <div class="flex items-center justify-between">
                <p
<<<<<<< HEAD
                    class="text-[14px] font-medium leading-[24px] dark:text-white text-gray-800"
=======
                    class="text-sm font-medium leading-6 dark:text-white text-gray-800"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    v-text="column.label"
                >
                </p>

                <div
<<<<<<< HEAD
                    class="flex items-center gap-x-[5px]"
                    @click="removeAppliedColumnAllValues(column.index)"
                >
                    <p
                        class="cursor-pointer text-[12px] font-medium leading-[24px] text-blue-600"
=======
                    class="flex items-center gap-x-1.5"
                    @click="removeAppliedColumnAllValues(column.index)"
                >
                    <p
                        class="cursor-pointer text-xs font-medium leading-6 text-blue-600"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-if="hasAnyAppliedColumnValues(column.index)"
                    >
                        @lang('admin::app.components.datagrid.filters.custom-filters.clear-all')
                    </p>
                </div>
            </div>

<<<<<<< HEAD
            <div class="mb-[8px] mt-[5px]">
=======
            <div class="mb-2 mt-1.5">
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                <x-admin::dropdown>
                    <!-- Dropdown Toggler -->
                    <x-slot:toggle>
                        <button
                            type="button"
<<<<<<< HEAD
                            class="inline-flex w-full cursor-pointer appearance-none items-center justify-between gap-x-[8px] rounded-[6px] border dark:border-gray-800 bg-white dark:bg-gray-900 px-[10px] py-[6px] text-center leading-[24px] text-gray-600 dark:text-gray-300 transition-all marker:shadow hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400"
                        >
                            <span 
                                class="text-[14px] text-gray-400 dark:text-gray-400" 
=======
                            class="inline-flex w-full cursor-pointer appearance-none items-center justify-between gap-x-2 rounded-md border dark:border-gray-800 bg-white dark:bg-gray-900 px-2.5 py-1.5 text-center leading-6 text-gray-600 dark:text-gray-300 transition-all marker:shadow hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400"
                        >
                            <span 
                                class="text-sm text-gray-400 dark:text-gray-400" 
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                                v-text="'@lang('admin::app.components.datagrid.filters.select')'"
                            >
                            </span>

<<<<<<< HEAD
                            <span class="icon-sort-down text-[24px]"></span>
=======
                            <span class="icon-sort-down text-2xl"></span>
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        </button>
                    </x-slot:toggle>

                    <!-- Dropdown Content -->
                    <x-slot:menu>
                        <x-admin::dropdown.menu.item
                            v-for="option in column.options"
                            v-text="option.label"
                            @click="filterPage(option.value, column)"
                        >
                        </x-admin::dropdown.menu.item>
                    </x-slot:menu>
                </x-admin::dropdown>
            </div>

<<<<<<< HEAD
            <div class="mb-[16px] flex gap-2">
                <p
                    class="flex items-center rounded-[4px] bg-gray-600 px-[8px] py-[4px] font-semibold text-white"
=======
            <div class="mb-4 flex gap-2 flex-wrap">
                <p
                    class="flex items-center rounded bg-gray-600 px-2 py-1 font-semibold text-white"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    v-for="appliedColumnValue in getAppliedColumnValues(column.index)"
                >
                    <!-- Retrieving the label from the options based on the applied column value. -->
                    <span v-text="column.options.find((option => option.value == appliedColumnValue)).label"></span>

                    <span
<<<<<<< HEAD
                        class="icon-cross cursor-pointer text-[18px] text-white ltr:ml-[5px] rtl:mr-[5px]"
=======
                        class="icon-cross cursor-pointer text-lg text-white ltr:ml-1.5 rtl:mr-1.5"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        @click="removeAppliedColumnValue(column.index, appliedColumnValue)"
                    >
                    </span>
                </p>
            </div>
        </div>

        <!-- Dropdown -->
        <div v-else-if="column.type === 'dropdown'">
            <!-- Basic -->
            <div v-if="column.options.type === 'basic'">
                <div class="flex items-center justify-between">
                    <p
<<<<<<< HEAD
                        class="text-[14px] font-medium leading-[24px] dark:text-white text-gray-800"
=======
                        class="text-sm font-medium leading-6 dark:text-white text-gray-800"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-text="column.label"
                    >
                    </p>

                    <div
<<<<<<< HEAD
                        class="flex items-center gap-x-[5px]"
                        @click="removeAppliedColumnAllValues(column.index)"
                    >
                        <p
                            class="cursor-pointer text-[12px] font-medium leading-[24px] text-blue-600"
=======
                        class="flex items-center gap-x-1.5"
                        @click="removeAppliedColumnAllValues(column.index)"
                    >
                        <p
                            class="cursor-pointer text-xs font-medium leading-6 text-blue-600"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                            v-if="hasAnyAppliedColumnValues(column.index)"
                        >
                            @lang('admin::app.components.datagrid.filters.custom-filters.clear-all')
                        </p>
                    </div>
                </div>

<<<<<<< HEAD
                <div class="mb-[8px] mt-[5px]">
=======
                <div class="mb-2 mt-1.5">
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    <x-admin::dropdown>
                        <!-- Dropdown Toggler -->
                        <x-slot:toggle>
                            <button
                                type="button"
<<<<<<< HEAD
                                class="inline-flex w-full cursor-pointer appearance-none items-center justify-between gap-x-[8px] rounded-[6px] border dark:border-gray-800 bg-white dark:bg-gray-900 px-[10px] py-[6px] text-center leading-[24px] text-gray-600 dark:text-gray-300 transition-all marker:shadow hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400 "
                            >
                                <span 
                                    class="text-[14px] text-gray-400 dark:text-gray-400" 
=======
                                class="inline-flex w-full cursor-pointer appearance-none items-center justify-between gap-x-2 rounded-md border dark:border-gray-800 bg-white dark:bg-gray-900 px-2.5 py-1.5 text-center leading-6 text-gray-600 dark:text-gray-300 transition-all marker:shadow hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400 "
                            >
                                <span 
                                    class="text-sm text-gray-400 dark:text-gray-400" 
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                                    v-text="'@lang('admin::app.components.datagrid.filters.select')'"
                                >
                                </span>

<<<<<<< HEAD
                                <span class="icon-sort-down text-[24px]"></span>
=======
                                <span class="icon-sort-down text-2xl"></span>
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                            </button>
                        </x-slot:toggle>

                        <!-- Dropdown Content -->
                        <x-slot:menu>
                            <x-admin::dropdown.menu.item
                                v-for="option in column.options.params.options"
                                v-text="option.label"
                                @click="filterPage(option.value, column)"
                            >
                            </x-admin::dropdown.menu.item>
                        </x-slot:menu>
                    </x-admin::dropdown>
                </div>

<<<<<<< HEAD
                <div class="mb-[16px] flex gap-2">
                    <p
                        class="flex items-center rounded-[4px] bg-gray-600 px-[8px] py-[4px] font-semibold text-white"
=======
                <div class="mb-4 flex gap-2 flex-wrap">
                    <p
                        class="flex items-center rounded bg-gray-600 px-2 py-1 font-semibold text-white"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-for="appliedColumnValue in getAppliedColumnValues(column.index)"
                    >
                        <!-- Retrieving the label from the options based on the applied column value. -->
                        <span v-text="column.options.params.options.find((option => option.value == appliedColumnValue)).label"></span>

                        <span
<<<<<<< HEAD
                            class="icon-cross cursor-pointer text-[18px] text-white ltr:ml-[5px] rtl:mr-[5px]"
=======
                            class="icon-cross cursor-pointer text-lg text-white ltr:ml-1.5 rtl:mr-1.5"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                            @click="removeAppliedColumnValue(column.index, appliedColumnValue)"
                        >
                        </span>
                    </p>
                </div>
            </div>

            <!-- Searchable -->
            <div v-else-if="column.options.type === 'searchable'">
                <div class="flex items-center justify-between">
                    <p
<<<<<<< HEAD
                        class="text-[14px] font-medium leading-[24px] dark:text-white text-gray-800"
=======
                        class="text-sm font-medium leading-6 dark:text-white text-gray-800"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-text="column.label"
                    >
                    </p>

                    <div
<<<<<<< HEAD
                        class="flex items-center gap-x-[5px]"
                        @click="removeAppliedColumnAllValues(column.index)"
                    >
                        <p
                            class="cursor-pointer text-[12px] font-medium leading-[24px] text-blue-600"
=======
                        class="flex items-center gap-x-1.5"
                        @click="removeAppliedColumnAllValues(column.index)"
                    >
                        <p
                            class="cursor-pointer text-xs font-medium leading-6 text-blue-600"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                            v-if="hasAnyAppliedColumnValues(column.index)"
                        >
                            @lang('admin::app.components.datagrid.filters.custom-filters.clear-all')
                        </p>
                    </div>
                </div>

<<<<<<< HEAD
                <div class="mb-[8px] mt-[5px]">
=======
                <div class="mb-2 mt-1.5">
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    <v-datagrid-searchable-dropdown
                        :datagrid-id="available.id"
                        :column="column"
                        @select-option="filterPage($event, column)"
                    >
                    </v-datagrid-searchable-dropdown>
                </div>

<<<<<<< HEAD
                <div class="mb-[16px] flex gap-2">
                    <p
                        class="flex items-center rounded-[4px] bg-gray-600 px-[8px] py-[4px] font-semibold text-white"
=======
                <div class="mb-4 flex gap-2 flex-wrap">
                    <p
                        class="flex items-center rounded bg-gray-600 px-2 py-1 font-semibold text-white"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-for="appliedColumnValue in getAppliedColumnValues(column.index)"
                    >
                        <span v-text="appliedColumnValue"></span>

                        <span
<<<<<<< HEAD
                            class="icon-cross cursor-pointer text-[18px] text-white ltr:ml-[5px] rtl:mr-[5px]"
=======
                            class="icon-cross cursor-pointer text-lg text-white ltr:ml-1.5 rtl:mr-1.5"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                            @click="removeAppliedColumnValue(column.index, appliedColumnValue)"
                        >
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Date Range -->
        <div v-else-if="column.type === 'date_range'">
            <div class="flex items-center justify-between">
                <p
<<<<<<< HEAD
                    class="text-[14px] font-medium leading-[24px] dark:text-white"
=======
                    class="text-sm font-medium leading-6 dark:text-white"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    v-text="column.label"
                >
                </p>

                <div
<<<<<<< HEAD
                    class="flex items-center gap-x-[5px]"
                    @click="removeAppliedColumnAllValues(column.index)"
                >
                    <p
                        class="cursor-pointer text-[12px] font-medium leading-[24px] text-blue-600"
=======
                    class="flex items-center gap-x-1.5"
                    @click="removeAppliedColumnAllValues(column.index)"
                >
                    <p
                        class="cursor-pointer text-xs font-medium leading-6 text-blue-600"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-if="hasAnyAppliedColumnValues(column.index)"
                    >
                        @lang('admin::app.components.datagrid.filters.custom-filters.clear-all')
                    </p>
                </div>
            </div>

<<<<<<< HEAD
            <div class="mt-[5px] grid grid-cols-2 gap-[5px]">
                <p
                    class="cursor-pointer rounded-[6px] border px-[8px] py-[6px] text-center text-[14px] font-medium leading-[24px] text-gray-600 transition-all hover:border-gray-400 dark:border-gray-800 dark:text-gray-300"
=======
            <div class="mt-1.5 grid grid-cols-2 gap-1.5">
                <p
                    class="cursor-pointer rounded-md border px-3 py-2 text-center text-sm font-medium leading-6 text-gray-600 transition-all hover:border-gray-400 dark:hover:border-gray-400 dark:border-gray-800 dark:text-gray-300"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    v-for="option in column.options"
                    v-text="option.label"
                    @click="filterPage(
                        $event,
                        column,
                        { quickFilter: { isActive: true, selectedFilter: option } }
                    )"
                >
                </p>

                <x-admin::flat-picker.date ::allow-input="false">
                    <input
                        value=""
<<<<<<< HEAD
                        class="flex min-h-[39px] w-full rounded-[6px] border px-3 py-2 text-[14px] text-gray-600 transition-all hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
=======
                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 dark:hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        :type="column.input_type"
                        :name="`${column.index}[from]`"
                        :placeholder="column.label"
                        :ref="`${column.index}[from]`"
                        @change="filterPage(
                            $event,
                            column,
                            { range: { name: 'from' }, quickFilter: { isActive: false } }
                        )"
                    />
                </x-admin::flat-picker.date>

                <x-admin::flat-picker.date ::allow-input="false">
                    <input
                        type="column.input_type"
                        value=""
<<<<<<< HEAD
                        class="flex min-h-[39px] w-full rounded-[6px] border px-3 py-2 text-[14px] text-gray-600 transition-all hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
=======
                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 dark:hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        :name="`${column.index}[to]`"
                        :placeholder="column.label"
                        :ref="`${column.index}[from]`"
                        @change="filterPage(
                            $event,
                            column,
                            { range: { name: 'to' }, quickFilter: { isActive: false } }
                        )"
                    />
                </x-admin::flat-picker.date>

<<<<<<< HEAD
                <div class="mb-[16px] flex gap-2">
                    <p
                        class="flex items-center rounded-[4px] bg-gray-600 px-[8px] py-[3px] font-semibold text-white"
=======
                <div class="mb-4 flex gap-2 flex-wrap">
                    <p
                        class="flex items-center rounded bg-gray-600 px-2 py-1 font-semibold text-white"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-for="appliedColumnValue in getAppliedColumnValues(column.index)"
                    >
                        <span v-text="appliedColumnValue.join(' to ')"></span>

                        <span
<<<<<<< HEAD
                            class="icon-cross cursor-pointer text-[18px] text-white ltr:ml-[5px] rtl:mr-[5px]"
=======
                            class="icon-cross cursor-pointer text-lg text-white ltr:ml-1.5 rtl:mr-1.5"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                            @click="removeAppliedColumnValue(column.index, appliedColumnValue)"
                        >
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Date Time Range -->
        <div v-else-if="column.type === 'datetime_range'">
            <div class="flex items-center justify-between">
                <p
<<<<<<< HEAD
                    class="text-[14px] font-medium leading-[24px] dark:text-white"
=======
                    class="text-sm font-medium leading-6 dark:text-white"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    v-text="column.label"
                >
                </p>

                <div
<<<<<<< HEAD
                    class="flex items-center gap-x-[5px]"
                    @click="removeAppliedColumnAllValues(column.index)"
                >
                    <p
                        class="cursor-pointer text-[12px] font-medium leading-[24px] text-blue-600"
=======
                    class="flex items-center gap-x-1.5"
                    @click="removeAppliedColumnAllValues(column.index)"
                >
                    <p
                        class="cursor-pointer text-xs font-medium leading-6 text-blue-600"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-if="hasAnyAppliedColumnValues(column.index)"
                    >
                        @lang('admin::app.components.datagrid.filters.custom-filters.clear-all')
                    </p>
                </div>
            </div>

<<<<<<< HEAD
            <div class="my-[16px] grid grid-cols-2 gap-[5px]">
                <p
                    class="cursor-pointer rounded-[6px] border px-[8px] py-[6px] text-center text-[14px] font-medium leading-[24px] text-gray-600 transition-all hover:border-gray-400 dark:border-gray-800 dark:text-gray-300"
=======
            <div class="my-4 grid grid-cols-2 gap-1.5">
                <p
                    class="cursor-pointer rounded-md border px-3 py-2 text-center text-sm font-medium leading-6 text-gray-600 transition-all hover:border-gray-400 dark:hover:border-gray-400 dark:border-gray-800 dark:text-gray-300"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    v-for="option in column.options"
                    v-text="option.label"
                    @click="filterPage(
                        $event,
                        column,
                        { quickFilter: { isActive: true, selectedFilter: option } }
                    )"
                >
                </p>

                <x-admin::flat-picker.datetime ::allow-input="false">
                    <input
                        value=""
<<<<<<< HEAD
                        class="flex min-h-[39px] w-full rounded-[6px] border px-3 py-2 text-[14px] text-gray-600 transition-all hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
=======
                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 dark:hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        :type="column.input_type"
                        :name="`${column.index}[from]`"
                        :placeholder="column.label"
                        :ref="`${column.index}[from]`"
                        @change="filterPage(
                            $event,
                            column,
                            { range: { name: 'from' }, quickFilter: { isActive: false } }
                        )"
                    />
                </x-admin::flat-picker.datetime>

                <x-admin::flat-picker.datetime ::allow-input="false">
                    <input
                        type="column.input_type"
                        value=""
<<<<<<< HEAD
                        class="flex min-h-[39px] w-full rounded-[6px] border px-3 py-2 text-[14px] text-gray-600 transition-all hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
=======
                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 dark:hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        :name="`${column.index}[to]`"
                        :placeholder="column.label"
                        :ref="`${column.index}[from]`"
                        @change="filterPage(
                            $event,
                            column,
                            { range: { name: 'to' }, quickFilter: { isActive: false } }
                        )"
                    />
                </x-admin::flat-picker.datetime>

<<<<<<< HEAD
                <div class="mb-[16px] flex gap-2">
                    <p
                        class="flex items-center rounded-[4px] bg-gray-600 px-[8px] py-[3px] font-semibold text-white"
=======
                <div class="mb-4 flex gap-2 flex-wrap">
                    <p
                        class="flex items-center rounded bg-gray-600 px-2 py-1 font-semibold text-white"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-for="appliedColumnValue in getAppliedColumnValues(column.index)"
                    >
                        <span v-text="appliedColumnValue.join(' to ')"></span>

                        <span
<<<<<<< HEAD
                            class="icon-cross cursor-pointer text-[18px] text-white ltr:ml-[5px] rtl:mr-[5px]"
=======
                            class="icon-cross cursor-pointer text-lg text-white ltr:ml-1.5 rtl:mr-1.5"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                            @click="removeAppliedColumnValue(column.index, appliedColumnValue)"
                        >
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Rest -->
        <div v-else>
            <div class="flex items-center justify-between">
                <p
<<<<<<< HEAD
                    class="text-[14px] font-medium leading-[24px] dark:text-white"
=======
                    class="text-sm font-medium leading-6 dark:text-white"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    v-text="column.label"
                >
                </p>

                <div
<<<<<<< HEAD
                    class="flex items-center gap-x-[5px]"
                    @click="removeAppliedColumnAllValues(column.index)"
                >
                    <p
                        class="cursor-pointer text-[12px] font-medium leading-[24px] text-blue-600"
=======
                    class="flex items-center gap-x-1.5"
                    @click="removeAppliedColumnAllValues(column.index)"
                >
                    <p
                        class="cursor-pointer text-xs font-medium leading-6 text-blue-600"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-if="hasAnyAppliedColumnValues(column.index)"
                    >
                        @lang('admin::app.components.datagrid.filters.custom-filters.clear-all')
                    </p>
                </div>
            </div>

<<<<<<< HEAD
            <div class="mb-[8px] mt-[5px] grid">
                <input
                    type="text"
                    class="block w-full rounded-[6px] border dark:border-gray-800 bg-white dark:bg-gray-900 px-[8px] py-[6px] text-[14px] leading-[24px] text-gray-600 dark:text-gray-300 transition-all hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400"
=======
            <div class="mb-2 mt-1.5 grid">
                <input
                    type="text"
                    class="block w-full rounded-md border dark:border-gray-800 bg-white dark:bg-gray-900 px-2 py-1.5 text-sm leading-6 text-gray-600 dark:text-gray-300 transition-all hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    :name="column.index"
                    :placeholder="column.label"
                    @keyup.enter="filterPage($event, column)"
                />
            </div>

<<<<<<< HEAD
            <div class="mb-[16px] flex gap-2">
                <p
                    class="flex items-center rounded-[4px] bg-gray-600 px-[8px] py-[4px] font-semibold text-white"
=======
            <div class="mb-4 flex gap-2 flex-wrap">
                <p
                    class="flex items-center rounded bg-gray-600 px-2 py-1 font-semibold text-white"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    v-for="appliedColumnValue in getAppliedColumnValues(column.index)"
                >
                    <span v-text="appliedColumnValue"></span>

                    <span
<<<<<<< HEAD
                        class="icon-cross cursor-pointer text-[18px] text-white ltr:ml-[5px] rtl:mr-[5px]"
=======
                        class="icon-cross cursor-pointer text-lg text-white ltr:ml-1.5 rtl:mr-1.5"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        @click="removeAppliedColumnValue(column.index, appliedColumnValue)"
                    >
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>

@pushOnce('scripts')
    <script type="text/x-template" id="v-datagrid-searchable-dropdown-template">
        <x-admin::dropdown ::close-on-click="false">
            <!-- Dropdown Toggler -->
            <x-slot:toggle>
                <button
                    type="button"
<<<<<<< HEAD
                    class="inline-flex w-full cursor-pointer appearance-none items-center justify-between gap-x-[8px] rounded-[6px] border dark:border-gray-800 bg-white dark:bg-gray-900 px-[10px] py-[6px] text-center leading-[24px] text-gray-600 dark:text-gray-300 transition-all marker:shadow hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400 "
                >
                    <span
                        class="text-[14px] text-gray-400 dark:text-gray-400" 
=======
                    class="inline-flex w-full cursor-pointer appearance-none items-center justify-between gap-x-2 rounded-md border dark:border-gray-800 bg-white dark:bg-gray-900 px-2.5 py-1.5 text-center leading-6 text-gray-600 dark:text-gray-300 transition-all marker:shadow hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400"
                >
                    <span
                        class="text-sm text-gray-400 dark:text-gray-400" 
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        v-text="'@lang('admin::app.components.datagrid.filters.select')'"
                    >
                    </span>

<<<<<<< HEAD
                    <span class="icon-sort-down text-[24px]"></span>
=======
                    <span class="icon-sort-down text-2xl"></span>
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                </button>
            </x-slot:toggle>

            <!-- Dropdown Content -->
            <x-slot:menu>
                <div class="relative">
                    <div class="relative rounded">
                        <ul class="list-reset">
                            <li class="p-2">
                                <input
<<<<<<< HEAD
                                    class="block w-full rounded-[6px] border dark:border-gray-800 bg-white dark:bg-gray-900 px-[8px] py-[6px] text-[14px] leading-[24px] text-gray-600 dark:text-gray-300 transition-all hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400"
=======
                                    class="block w-full rounded-md border dark:border-gray-800 bg-white dark:bg-gray-900 px-2 py-1.5 text-sm leading-6 text-gray-600 dark:text-gray-300 transition-all hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                                    @keyup="lookUp($event)"
                                >
                            </li>

                            <ul class="p-2">
                                <li v-if="!isMinimumCharacters">
                                    <p
                                        class="block p-2 text-gray-600 dark:text-gray-300"
                                        v-text="'@lang('admin::app.components.datagrid.filters.dropdown.searchable.atleast-two-chars')'"
                                    >
                                    </p>
                                </li>

                                <li v-else-if="!searchedOptions.length">
                                    <p
                                        class="block p-2 text-gray-600 dark:text-gray-300"
                                        v-text="'@lang('admin::app.components.datagrid.filters.dropdown.searchable.no-results')'"
                                    >
                                    </p>
                                </li>

                                <li
                                    v-for="option in searchedOptions"
                                    v-else
                                >
                                    <p
<<<<<<< HEAD
                                        class="text-[14px] text-gray-600 dark:text-gray-300 p-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-950"
=======
                                        class="text-sm text-gray-600 dark:text-gray-300 p-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-950"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                                        v-text="option.label"
                                        @click="selectOption(option)"
                                    >
                                    </p>
                                </li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </x-slot:menu>
        </x-admin::dropdown>
    </script>

    <script type="module">
        app.component('v-datagrid-searchable-dropdown', {
            template: '#v-datagrid-searchable-dropdown-template',

            props: ['datagridId', 'column'],

            data() {
                return {
                    isMinimumCharacters: false,

                    searchedOptions: [],
                };
            },

            methods: {
                lookUp($event) {
                    let params = {
                        datagrid_id: this.datagridId,
                        column: this.column.index,
                        search: $event.target.value,
                    };

                    if (!(params['search'].length > 1)) {
                        this.searchedOptions = [];

                        this.isMinimumCharacters = false;

                        return;
                    }

                    this.$axios
                        .get('{{ route('admin.datagrid.look_up') }}', {
                            params
                        })
                        .then(({
                            data
                        }) => {
                            this.isMinimumCharacters = true;

                            this.searchedOptions = data;
                        });
                },

                selectOption(option) {
                    this.searchedOptions = [];

                    this.$emit('select-option', {
                        target: {
                            value: option.value
                        }
                    });
                },
            }
        });
    </script>
@endpushOnce
