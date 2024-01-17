<<<<<<< HEAD
{{-- Top Customers Vue Component --}}
<v-reporting-customers-top-customer-groups>
    {{-- Shimmer --}}
=======
<!-- Top Customers Vue Component -->
<v-reporting-customers-top-customer-groups>
    <!-- Shimmer -->
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
    <x-admin::shimmer.reporting.customers.top-customer-groups/>
</v-reporting-customers-top-customer-groups>

@pushOnce('scripts')
    <script type="text/x-template" id="v-reporting-customers-top-customer-groups-template">
        <!-- Shimmer -->
        <template v-if="isLoading">
            <x-admin::shimmer.reporting.customers.top-customer-groups/>
        </template>
        
        <!-- Top Customers Section -->
        <template v-else>
<<<<<<< HEAD
            <div class="flex-1 relative p-[16px] bg-white dark:bg-gray-900 rounded-[4px] box-shadow">
                <!-- Header -->
                <div class="flex items-center justify-between mb-[16px]">
                    <p class="text-[16px] text-gray-600 dark:text-white font-semibold">
=======
            <div class="flex-1 relative p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <p class="text-base text-gray-600 dark:text-white font-semibold">
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                        @lang('admin::app.reporting.customers.index.top-customer-groups')
                    </p>

                    <a
                        href="{{ route('admin.reporting.customers.view', ['type' => 'top-customer-groups']) }}"
<<<<<<< HEAD
                        class="text-[14px] text-blue-600 cursor-pointer transition-all hover:underline"
=======
                        class="text-sm text-blue-600 cursor-pointer transition-all hover:underline"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    >
                        @lang('admin::app.reporting.customers.index.view-details')
                    </a>
                </div>

                <!-- Content -->
<<<<<<< HEAD
                <div class="grid gap-[16px]">
                    <!-- Top Customers -->
                    <template v-if="report.statistics.length">
                        <!-- Customers -->
                        <div class="grid gap-[27px]">
=======
                <div class="grid gap-4">
                    <!-- Top Customers -->
                    <template v-if="report.statistics.length">
                        <!-- Customers -->
                        <div class="grid gap-7">
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                            <div
                                class="grid"
                                v-for="customer in report.statistics"
                            >
                                <p class="dark:text-white">@{{ customer.group_name }}</p>

<<<<<<< HEAD
                                <div class="flex gap-[20px] items-center">
                                    <div class="w-full h-[8px] relative bg-slate-100">
                                        <div
                                            class="h-[8px] absolute left-0 bg-emerald-500"
=======
                                <div class="flex gap-5 items-center">
                                    <div class="w-full h-2 relative bg-slate-100">
                                        <div
                                            class="h-2 absolute left-0 bg-emerald-500"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                                            :style="{ 'width': customer.progress + '%' }"
                                        ></div>
                                    </div>

<<<<<<< HEAD
                                    <p class="text-[14px] text-gray-600 dark:text-gray-300 font-semibold">
=======
                                    <p class="text-sm text-gray-600 dark:text-gray-300 font-semibold">
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                                        @{{ customer.total }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Empty State -->
                    <template v-else>
                        @include('admin::reporting.empty')
                    </template>

                    <!-- Date Range -->
<<<<<<< HEAD
                    <div class="flex gap-[20px] justify-end">
                        <div class="flex gap-[4px] items-center">
                            <span class="w-[14px] h-[14px] rounded-[3px] bg-emerald-400"></span>

                            <p class="text-[12px] dark:text-gray-300">
=======
                    <div class="flex gap-5 justify-end">
                        <div class="flex gap-1 items-center">
                            <span class="w-3.5 h-3.5 rounded-md bg-emerald-400"></span>

                            <p class="text-xs dark:text-gray-300">
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                                @{{ report.date_range.current }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </script>

    <script type="module">
        app.component('v-reporting-customers-top-customer-groups', {
            template: '#v-reporting-customers-top-customer-groups-template',

            data() {
                return {
                    report: [],

                    isLoading: true,
                }
            },

            mounted() {
                this.getStats({});

                this.$emitter.on('reporting-filter-updated', this.getStats);
            },

            methods: {
                getStats(filtets) {
                    this.isLoading = true;

                    var filtets = Object.assign({}, filtets);

                    filtets.type = 'top-customer-groups';

                    this.$axios.get("{{ route('admin.reporting.customers.stats') }}", {
                            params: filtets
                        })
                        .then(response => {
                            this.report = response.data;

                            this.isLoading = false;
                        })
                        .catch(error => {});
                }
            }
        });
    </script>
@endPushOnce