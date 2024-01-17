@props([
    'isActive' => false,
    'position' => 'right',
    'width'    => '500px',
])

<v-drawer
    {{ $attributes }}
    is-active="{{ $isActive }}"
    position="{{ $position }}"
    width="{{ $width }}"
>
    @isset($toggle)
        <template v-slot:toggle>
            {{ $toggle }}
        </template>
    @endisset

    @isset($header)
<<<<<<< HEAD
        <template v-slot:header>
            {{ $header }}
=======
        <template v-slot:header="{ close }">
            <div {{ $header->attributes->merge(['class' => 'grid gap-y-2.5 p-3 border-b dark:border-gray-800 max-sm:px-4']) }}>
                {{ $header }}

                <div class="absolute top-4 ltr:right-3 rtl:left-3">
                    <span
                        class="icon-cross text-3xl  cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-950 hover:rounded-md"
                        @click="close"
                    >
                    </span>
                </div>
            </div>
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
        </template>
    @endisset

    @isset($content)
        <template v-slot:content>
<<<<<<< HEAD
            <div {{ $content->attributes->merge(['class' => 'p-[11px] overflow-auto flex-1 max-sm:px-[15px]']) }}>
=======
            <div {{ $content->attributes->merge(['class' => 'p-3 overflow-auto flex-1 max-sm:px-4']) }}>
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                {{ $content }}
            </div>
        </template>
    @endisset

    @isset($footer)
        <template v-slot:footer>
<<<<<<< HEAD
            <div {{ $footer->attributes->merge(['class' => 'pb-[30px]']) }}>
=======
            <div {{ $footer->attributes->merge(['class' => 'pb-8']) }}>
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                {{ $footer }}
            </div>
        </template>
    @endisset
</v-drawer>

@pushOnce('scripts')
    <script type="text/x-template" id="v-drawer-template">
        <div>
            <!-- Toggler -->
            <div @click="open">
                <slot name="toggle">
                </slot>
            </div>

            <!-- Overlay -->
            <transition
                tag="div"
                name="drawer-overlay"
                enter-class="ease-out duration-300"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-class="ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    class="fixed inset-0  bg-gray-500 bg-opacity-50 transition-opacity z-[10001]"
                    v-show="isOpen"
                ></div>
            </transition>

            <!-- Content -->
            <transition
                tag="div"
                name="drawer"
                :enter-from-class="enterFromLeaveToClasses"
                enter-active-class="transform transition ease-in-out duration-200"
                enter-to-class="translate-x-0"
                leave-from-class="translate-x-0"
                leave-active-class="transform transition ease-in-out duration-200"
                :leave-to-class="enterFromLeaveToClasses"
            >
                <div
<<<<<<< HEAD
                    class="fixed z-[10002] bg-white dark:bg-gray-900 overflow-hidden max-sm:!w-full"
=======
                    class="fixed z-[10002] bg-white dark:bg-gray-900 max-sm:!w-full"
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                    :class="{
                        'inset-x-0 top-0': position == 'top',
                        'inset-x-0 bottom-0': position == 'bottom',
                        'inset-y-0 ltr:right-0 rtl:left-0': position == 'right',
                        'inset-y-0 ltr:left-0 rtl:right-0': position == 'left'
                    }"
                    :style="'width:' + width"
                    v-if="isOpen"
                >
                    <div class="w-full h-full overflow-auto bg-white dark:bg-gray-900 pointer-events-auto">
                        <div class="flex flex-col h-full w-full">
                            <div class="flex-1 min-h-0 min-w-0 overflow-auto">
                                <div class="flex flex-col h-full">
<<<<<<< HEAD
                                    <div class="grid gap-y-[10px] p-[12px] border-b-[1px] dark:border-gray-800 max-sm:px-[15px]">
                                        <!-- Content Slot -->
                                        <slot name="header"></slot>

                                        <div class="absolute top-5 ltr:right-3 rtl:left-3">
                                            <span
                                                class="icon-cross text-[30px] cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-950 hover:rounded-[6px]"
                                                @click="close"
                                            >
                                            </span>
                                        </div>
                                    </div>
=======
                                    <slot
                                        name="header"
                                        :close="close"
                                    >
                                        Default Header
                                    </slot>
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61

                                    <!-- Content Slot -->
                                    <slot name="content"></slot>

                                    <!-- Footer Slot -->
                                    <slot name="footer"></slot>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </script>

    <script type="module">
        app.component('v-drawer', {
            template: '#v-drawer-template',

            props: [
                'isActive',
                'position',
                'width'
            ],

            data() {
                return {
                    isOpen: this.isActive,
                };
            },

            watch: {
                isActive: function(newVal, oldVal) {
                    this.isOpen = newVal;
                }
            },

            computed: {
                enterFromLeaveToClasses() {
                    if (this.position == 'top') {
                        return '-translate-y-full';
                    } else if (this.position == 'bottom') {
                        return 'translate-y-full';
                    } else if (this.position == 'left') {
                        return 'ltr:-translate-x-full rtl:translate-x-full';
                    } else if (this.position == 'right') {
                        return 'ltr:translate-x-full rtl:-translate-x-full';
                    }
                }
            },

            methods: {
                toggle() {
                    this.isOpen = ! this.isOpen;

                    if (this.isOpen) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow ='scroll';
                    }

                    this.$emit('toggle', { isActive: this.isOpen });
                },

                open() {
                    this.isOpen = true;

                    document.body.style.overflow = 'hidden';

                    this.$emit('open', { isActive: this.isOpen });
                },

                close() {
                    this.isOpen = false;

                    document.body.style.overflow = 'auto';

                    this.$emit('close', { isActive: this.isOpen });
                }
            },
        });
    </script>
@endPushOnce
