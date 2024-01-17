<?php

namespace Webkul\Admin\Http\Controllers\Reporting;

<<<<<<< HEAD
use Webkul\Admin\Helpers\Reporting;

class ProductController extends Controller
{
    /**
     * Request param functions
=======
class ProductController extends Controller
{
    /**
     * Request param functions.
     *
     * @var array
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
     */
    protected $typeFunctions = [
        'total-sold-quantities'            => 'getTotalSoldQuantitiesStats',
        'total-products-added-to-wishlist' => 'getTotalProductsAddedToWishlistStats',
        'top-selling-products-by-revenue'  => 'getTopSellingProductsByRevenue',
        'top-selling-products-by-quantity' => 'getTopSellingProductsByQuantity',
        'products-with-most-reviews'       => 'getProductsWithMostReviews',
        'products-with-most-visits'        => 'getProductsWithMostVisits',
<<<<<<< HEAD
    ];

    /**
     * Create a controller instance.
     * 
     * @param  \Webkul\Admin\Helpers\Reporting  $reportingHelper
     * @return void
     */
    public function __construct(protected Reporting $reportingHelper)
    {
    }

    /**
=======
        'last-search-terms'                => 'getLastSearchTerms',
        'top-search-terms'                 => 'getTopSearchTerms',
    ];

    /**
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::reporting.products.index')->with([
            'startDate' => $this->reportingHelper->getStartDate(),
            'endDate'   => $this->reportingHelper->getEndDate(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function view()
    {
        return view('admin::reporting.view')->with([
            'entity'    => 'products',
            'startDate' => $this->reportingHelper->getStartDate(),
            'endDate'   => $this->reportingHelper->getEndDate(),
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
