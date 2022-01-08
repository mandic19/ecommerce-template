import {Component, OnDestroy, OnInit} from "@angular/core";
import {OwlOptions} from "ngx-owl-carousel-o";
import {ICategory} from "../category/category";
import {environment} from "../../environments/environment";
import {CategoryService} from "../category/category.service";
import {Subscription} from "rxjs";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html'
})

export class HomeComponent implements OnInit, OnDestroy{
  popularCategories: ICategory[] = [];
  sub!: Subscription;

  constructor(private categoryService: CategoryService) {
  }

  getImageUrl(image_id: number): string {
    return environment.apiUrl + '/image/' + image_id;
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
    this.categoryService.getCategories().subscribe({
      next: categories => this.popularCategories = categories,
      error: err => {}
    })
  }

  ngOnDestroy(): void {
    this.sub.unsubscribe();
  }
}
