import {Component, OnDestroy, OnInit} from "@angular/core";
import {OwlOptions} from "ngx-owl-carousel-o";
import {CategoryService} from "../../category/services/category.service";
import {ProductService} from "../../product/services/product.service";
import {Subscription} from "rxjs";
import {ICategory} from "../../category/category";
import {IProduct} from "../../product/product";

@Component({
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})

export class HomeComponent implements OnInit, OnDestroy {
  categorySub!: Subscription;
  popularCategories: ICategory[] = [];

  productSub!: Subscription;
  popularProducts: IProduct[] = [];

  constructor(
    private categoryService: CategoryService,
    private productService: ProductService
  ) {}

  getOwlCarouselOptions(): OwlOptions {
    return {
      loop: true,
      dots: false,
      navSpeed: 700,
      responsive: {
        0: {
          items: 1
        },
        400: {
          items: 2
        },
        740: {
          items: 3
        },
        940: {
          items: 4
        }
      },
      nav: false
    }
  }

  ngOnInit(): void {
    this.categorySub = this.categoryService.getCategories({'per-page': 5}).subscribe({
      next: categories => this.popularCategories = categories,
      error: err => this.handleError(err)
    })

    this.productSub = this.productService.getProducts({'per-page': 5}).subscribe({
      next: products => this.popularProducts = products,
      error: err => this.handleError(err)
    })
  }

  ngOnDestroy(): void {
    this.categorySub.unsubscribe();
    this.productSub.unsubscribe();
  }

  handleError(err): void {
    console.log(err.m);
  }
}
