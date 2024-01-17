<?php

namespace Webkul\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
<<<<<<< HEAD
use Webkul\Core\Rules\CommaSeparatedInteger;
=======
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61

class ConfigurationForm extends FormRequest
{
    /**
     * Determine if the Configuration is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
<<<<<<< HEAD
        $this->rules = [];

        if (
            request()->has('catalog.products.storefront.products_per_page')
            && ! empty(request()->input('catalog.products.storefront.products_per_page'))
        ) {
            $this->rules = [
                'catalog.products.storefront.products_per_page' => [new CommaSeparatedInteger],
            ];
        }

        if (
            request()->has('general.design.admin_logo.logo_image')
            && ! request()->input('general.design.admin_logo.logo_image.delete')
        ) {
            $this->rules = array_merge($this->rules, [
                'general.design.admin_logo.logo_image' => 'required|mimes:bmp,jpeg,jpg,png,webp|max:5000',
            ]);
        }

        if (
            request()->has('general.design.admin_logo.favicon')
            && ! request()->input('general.design.admin_logo.favicon.delete')
        ) {
            $this->rules = array_merge($this->rules, [
                'general.design.admin_logo.favicon' => 'required|mimes:bmp,jpeg,jpg,png,webp|max:5000',
            ]);
        }

        if (
            request()->has('sales.invoice_settings.invoice_slip_design.logo')
            && ! request()->input('sales.invoice_settings.invoice_slip_design.logo.delete')
        ) {
            $this->rules = array_merge($this->rules, [
                'sales.invoice_settings.invoice_slip_design.logo' => 'required|mimes:bmp,jpeg,jpg,png,webp|max:5000',
            ]);
        }

        return $this->rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'general.design.admin_logo.logo_image.mimes' => 'Invalid file format. Use only bmp, jpeg, jpg, png and webp.',
        ];
    }

    /**
     * Set the attribute name.
     */
    public function attributes()
    {
        return [
            'general.design.admin_logo.logo_image'             => 'Logo Image',
            'general.design.admin_logo.favicon'                => 'Favicon Image',
            'sales.invoice_settings.invoice_slip_design.logo'  => 'Invoice Logo',
            'catalog.products.storefront.products_per_page'    => 'Product Per Page',
        ];
=======
        return collect(request()->input('keys', []))->mapWithKeys(function ($item) {
            $data = json_decode($item, true);

            return collect($data['fields'])->mapWithKeys(function ($field) use ($data) {
                $key = $data['key'] . '.' . $field['name'];

                // Check delete key exist in the request
                if (! $this->has($key . '.delete')) {
                    $validation = isset($field['validation']) && $field['validation'] ? $field['validation'] : 'nullable';

                    return [$key => $validation];
                }

                return [];
            })->toArray();
        })->toArray();
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
    }
}
