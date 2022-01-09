import {Component, Input, OnDestroy, OnInit} from "@angular/core";
import {ICategory} from "../../category/category";
import {OwlOptions} from "ngx-owl-carousel-o";
import {ProductService} from "../../product/services/product.service";
import {Subscription} from "rxjs";
import {IProduct} from "../../product/product";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html'
})

export class HomeComponent implements OnInit, OnDestroy {
  @Input() popularCategories: ICategory[] = [];
  sub!: Subscription;
  popularProducts: IProduct[] = [];

  constructor(private productService: ProductService) {
  }

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
    this.sub = this.productService.getProducts({'per-page': 5}).subscribe({
      next: products => this.popularProducts = products,
      error: err => this.handleError(err)
    })
  }

  ngOnDestroy(): void {
    this.sub.unsubscribe();
  }

  handleError(err): void {
    console.log(err.m);
  }
}
