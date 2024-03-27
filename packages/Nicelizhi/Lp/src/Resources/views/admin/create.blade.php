<x-admin::layouts>
    {{--Page title --}}
    <x-slot:title>
        @lang('lp::app.admin.create.title')
    </x-slot:title>

    {{--Create Page Form --}}
    <x-admin::form
        :action="route('admin.lp.store')"
        enctype="multipart/form-data"
    >

        {!! view_render_event('bagisto.admin.lp.pages.create.create_form_controls.before') !!}

        <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
            <p class="text-[20px] text-gray-800 dark:text-white font-bold">
                @lang('lp::app.admin.create.title')
            </p>


            <div class="flex gap-x-[10px] items-center">
                {{-- Back Button --}}
                <a
                    href="{{ route('admin.lp.index') }}"
                    class="transparent-button hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-white "
                >
                    @lang('admin::app.account.edit.back-btn')
                </a>

                {{--Save Button --}}
                <button
                    type="submit"
                    class="primary-button"
                >
                    @lang('lp::app.admin.create.save-btn')
                </button>
            </div>
        </div>

        {{-- body content --}}
        <div class="flex gap-[10px] mt-[14px] max-xl:flex-wrap">
            {{-- Left sub-component --}}
            <div class=" flex flex-col gap-[8px] flex-1 max-xl:flex-auto">

                {!! view_render_event('bagisto.admin.cms.pages.create.card.description.before') !!}

                {{--Content --}}
                <div class="p-[16px] bg-white dark:bg-gray-900 rounded-[4px] box-shadow">
                    <p class="text-[16px] text-gray-800 dark:text-white font-semibold mb-[16px]">
                        @lang('lp::app.admin.create.description')
                    </p>

                    <x-admin::form.control-group class="mb-[10px]">
                        <x-admin::form.control-group.label class="required">
                            @lang('lp::app.admin.create.content')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="html_content"
                            :value="old('html_content')"
                            id="content"
                            rules="required"
                            :label="trans('lp::app.admin.create.content')"
                            :placeholder="trans('lp::app.admin.create.content')"
                            :tinymce="true"
                        >
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error
                            control-name="html_content"
                        >
                        </x-admin::form.control-group.error>
                    </x-admin::form.control-group>
                </div>

                {!! view_render_event('bagisto.admin.cms.pages.create.card.description.after') !!}

                {!! view_render_event('bagisto.admin.cms.pages.create.card.seo.before') !!}

                {{-- SEO Input Fields --}}
                <div class="p-[16px] bg-white dark:bg-gray-900 rounded-[4px] box-shadow">
                    <p class="text-[16px] text-gray-800 dark:text-white font-semibold mb-[16px]">
                        @lang('lp::app.admin.create.seo')
                    </p>

                    {{-- SEO Title & Description Blade Componnet --}}
                    <x-admin::seo/>

                    <div class="mb-[30px]">
                        

                        <x-admin::form.control-group class="mb-[10px]">
                            <x-admin::form.control-group.label class="required">
                                @lang('lp::app.admin.create.slug')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                name="slug"
                                :value="old('slug')"
                                id="slug"
                                rules="required"
                                :label="trans('lp::app.admin.create.slug')"
                                :placeholder="trans('lp::app.admin.create.slug')"
                            >
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error
                                control-name="slug"
                            >
                            </x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                    </div>
                </div>

                {!! view_render_event('bagisto.admin.cms.pages.create.card.seo.after') !!}
            </div>

            {{-- Right sub-component --}}
            <div class="flex flex-col gap-[8px] w-[360px] max-w-full max-sm:w-full">
                {{-- General --}}

                {!! view_render_event('bagisto.admin.cms.pages.create.card.accordion.general.before') !!}

                <x-admin::accordion>
                    <x-slot:header>
                        <div class="flex items-center justify-between">
                            <p class="p-[10px] text-gray-600 dark:text-gray-300 text-[16px] font-semibold">
                                @lang('lp::app.admin.create.general')
                            </p>
                        </div>
                    </x-slot:header>

                    <x-slot:content>
                        <div class="mb-[10px]">
                            <x-admin::form.control-group class="mb-[10px]">
                                <x-admin::form.control-group.label class="required">
                                    @lang('lp::app.admin.create.page-title')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="page_title"
                                    :value="old('page_title')"
                                    id="page_title"
                                    rules="required"
                                    :label="trans('lp::app.admin.create.page-title')"
                                    :placeholder="trans('lp::app.admin.create.page-title')"
                                >
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error
                                    control-name="page_title"
                                >
                                </x-admin::form.control-group.error>
                            </x-admin::form.control-group>

                            
                        </div>
                    </x-slot:content>
                </x-admin::accordion>

                {!! view_render_event('bagisto.admin.cms.pages.create.card.accordion.general.after') !!}

            </div>
        </div>

        {!! view_render_event('bagisto.admin.cms.pages.create.create_form_controls.after') !!}

    </x-admin::form>
</x-admin::layouts>
