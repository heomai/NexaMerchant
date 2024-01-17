<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Webkul\Attribute\Models\Attribute;
use Webkul\Faker\Helpers\Product as ProductFaker;
use Webkul\Product\Models\Product as ProductModel;
use Webkul\Product\Models\ProductAttributeValue;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\get;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

afterEach(function () {
    /**
     * Clean up all the records.
     */
    ProductModel::query()->delete();
    Attribute::query()->whereNotBetween('id', [1, 28])->delete();
});

it('should return the create page of downloadable product', function () {
    // Arrange
    $product = (new ProductFaker())->getSimpleProductFactory()->create();

    $productId = $product->id + 1;

    // Act and Assert
    $this->loginAsAdmin();

    postJson(route('admin.catalog.products.store'), [
        'type'                => 'downloadable',
        'attribute_family_id' => 1,
        'sku'                 => $sku = fake()->slug(),
    ])
        ->assertOk()
        ->assertJsonPath('data.redirect_url', route('admin.catalog.products.edit', $productId));

    $this->assertDatabaseHas('products', [
        'id'   => $productId,
        'type' => 'downloadable',
        'sku'  => $sku,
    ]);

    $this->assertDatabaseHas('product_flat', [
        'url_key'           => $product->url_key,
        'type'              => 'simple',
        'name'              => $product->name,
        'short_description' => $product->short_description,
        'description'       => $product->description,
        'price'             => $product->price,
        'weight'            => $product->weight,
        'locale'            => app()->getLocale(),
        'product_id'        => $product->id,
        'channel'           => core()->getCurrentChannelCode(),
    ]);
});

it('should return the edit page of downloadable product', function () {
    // Arrange
    $product = (new ProductFaker())->getDownloadableProductFactory()->create();

    // Act and Assert
    $this->loginAsAdmin();

    get(route('admin.catalog.products.edit', $product->id))
        ->assertOk()
        ->assertSeeText(trans('admin::app.catalog.products.edit.title'))
        ->assertSeeText(trans('admin::app.account.edit.back-btn'))
        ->assertSeeText($product->url_key)
        ->assertSeeText($product->name)
        ->assertSeeText($product->short_description)
        ->assertSeeText($product->description);
});

it('should upload link the product upload link', function () {
    // Arrange
    $product = (new ProductFaker())->getDownloadableProductFactory()->create();

    // Act and Assert
    $this->loginAsAdmin();

    $response = postJson(route('admin.catalog.products.upload_link', $product->id), [
        'file' => $file = UploadedFile::fake()->create(fake()->word() . '.pdf', 100),
    ])
        ->assertOk()
        ->assertJsonPath('file_name', $file->getClientOriginalName());

    if (Storage::disk('private')->exists($response['file'])) {
        Storage::disk('private')->delete($response['file']);
    }
});

it('should upload the sample file', function () {
    // Arrange
    $product = (new ProductFaker())->getDownloadableProductFactory()->create();

    // Act and Assert
    $this->loginAsAdmin();

    $response = postJson(route('admin.catalog.products.upload_sample', $product->id), [
        'file' => $file = UploadedFile::fake()->create(fake()->word() . '.pdf', 100),
    ])
        ->assertOk()
        ->assertJsonPath('file_name', $file->name);

    if (Storage::disk('public')->exists($response['file'])) {
        Storage::disk('public')->delete($response['file']);
    }
});

it('should download the product which is downloadable', function () {
    // Arrange
    $attribute = Attribute::factory()->create([
        'type' => 'file',
    ]);

    $product = (new ProductFaker([
        'attributes' => [
            $attribute->id => $attribute->code,
        ],

        'attribute_value' => [
            $attribute->code => [
                'text_value' => $file = UploadedFile::fake()->create(fake()->word() . '.pdf', 100),
            ],
        ],
    ]))->getDownloadableProductFactory()->create();

    $fileName = $file->store('product/' . $product->id);

    $atttributeValues = ProductAttributeValue::where('product_id', $product->id)
        ->where('attribute_id', $attribute->id)->first();

    $atttributeValues->text_value = $fileName;
    $atttributeValues->save();

    // Act and Assert
    $this->loginAsAdmin();

    get(route('admin.catalog.products.file.download', [$product->id, $attribute->id]))
        ->assertOk();

    Storage::assertExists($fileName);
});

it('should update the downloadable product', function () {
    // Arrange
    $product = (new ProductFaker([
        'attributes' => [
            5  => 'new',
            26 => 'guest_checkout',
        ],

        'attribute_value' => [
            'new' => [
                'boolean_value' => true,
            ],

            'guest_checkout' => [
                'boolean_value' => true,
            ],
        ],
    ]))->getDownloadableProductFactory()->create();

    // Act and Asssert
    $this->loginAsAdmin();

    putJson(route('admin.catalog.products.update', $product->id), [
        'sku'                => $product->sku,
        'url_key'            => $product->url_key,
        'short_description'  => $shortDescription = fake()->sentence(),
        'description'        => $description = fake()->paragraph(),
        'name'               => $name = fake()->words(3, true),
        'price'              => $price = fake()->randomFloat(2, 1, 1000),
        'weight'             => $weight = fake()->numberBetween(0, 100),
        'channel'            => $channel = core()->getCurrentChannelCode(),
        'locale'             => $locale = app()->getLocale(),
        'downloadable_links' => [
            'link_0' => [
                'en' => [
                    'title' => fake()->title,
                ],
                'price'       => rand(10, 250),
                'downloads'   => '1',
                'sort_order'  => '0',
                'type'        => 'file',
                'file'        => $file1 = UploadedFile::fake()->create('ProductImageExampleForUpload1.jpg'),
                'file_name'   => $file1->getClientOriginalName(),
                'sample_type' => 'url',
                'sample_url'  => fake()->url(),
            ],

            'link_1' => [
                'en' => [
                    'title' => fake()->title,
                ],
                'price'            => rand(10, 250),
                'downloads'        => '1',
                'sort_order'       => '1',
                'type'             => 'file',
                'file'             => $file2 = UploadedFile::fake()->create('ProductImageExampleForUpload2.jpg'),
                'file_name'        => $file2->getClientOriginalName(),
                'sample_type'      => 'file',
                'sample_file'      => $file3 = UploadedFile::fake()->create('ProductImageExampleForUpload3.jpg'),
                'sample_file_name' => $file3->getClientOriginalName(),
            ],
        ],

        'downloadable_samples' => [
            'sample_0' => [
                'title'      => fake()->title(),
                'sort_order' => '0',
                'type'       => 'file',
                'file'       => $file4 = UploadedFile::fake()->create('ProductImageExampleForUpload4.jpg'),
                'file_name'  => $file4->getClientOriginalName(),
            ],

            'sample_1' => [
                'title'      => fake()->title(),
                'sort_order' => '1',
                'type'       => 'url',
                'url'        => fake()->url(),
            ],
        ],
    ])
        ->assertRedirect(route('admin.catalog.products.index'))
        ->isRedirection();

    $this->assertDatabaseHas('products', [
        'id'   => $product->id,
        'type' => $product->type,
        'sku'  => $product->sku,
    ]);

    $this->assertDatabaseHas('product_flat', [
        'product_id'        => $product->id,
        'type'              => 'downloadable',
        'sku'               => $product->sku,
        'url_key'           => $product->url_key,
        'name'              => $name,
        'short_description' => $shortDescription,
        'description'       => $description,
        'price'             => $price,
        'weight'            => $weight,
        'locale'            => $locale,
        'channel'           => $channel,
    ]);
});

it('should delete a downloadable product', function () {
    // Arrange
    $product = (new ProductFaker())->getDownloadableProductFactory()->create();

    // Act and Assert
    $this->loginAsAdmin();

    deleteJson(route('admin.catalog.products.delete', $product->id))
        ->assertOk()
        ->assertJsonPath('message', trans('admin::app.catalog.products.delete-success'));

    $this->assertDatabaseMissing('products', ['id' => $product->id]);

    $this->assertDatabaseMissing('product_flat', ['product_id' => $product->id]);

    $this->assertDatabaseMissing('product_downloadable_links', ['product_id' => $product->id]);

    $this->assertDatabaseMissing('product_downloadable_samples', ['product_id' => $product->id]);
});
