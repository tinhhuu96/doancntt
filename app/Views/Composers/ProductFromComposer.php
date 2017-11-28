<?php
namespace App\Http\Views\Composers;
use App\Category;
use App\Brand;
use App\Product;
use Illuminate\Contracts\View\View;
Class ProductFromComposer {
  protected $categories;
  protected $brands;
  protected $apple;
  protected $asus;
  protected $dell;
  protected $hp;
  protected $lenovo;
  protected $acer;
  protected $sony;
  protected $samsung;
  public function __construct(Category $categories, Brand $brands)
  {
    $this->categories = $categories;
    $this->brands = $brands;
  }
  public function compose(View $view)
  {
    $tinh = "abc"
    $view->with("tinh" => $tinh);
    dd($tinh)
    // dd($this->breeds->pluck('name', 'id'));
  }
}
