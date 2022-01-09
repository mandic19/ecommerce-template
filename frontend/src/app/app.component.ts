import {Component, OnDestroy, OnInit} from '@angular/core'
import {Subscription} from "rxjs";
import {CategoryService} from "./category/services/category.service";
import {ICategory} from "./category/category";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent implements OnInit, OnDestroy {
  title: string = "Ecommerce Template"
  categories: ICategory[] = [];
  popularCategories: ICategory[] = [];
  sub!: Subscription;

  constructor(private categoryService: CategoryService) {}

  ngOnInit(): void {
    this.sub = this.categoryService.getCategories().subscribe({
      next: categories => {
        this.categories = categories;
        this.popularCategories = categories.slice(0, 5);
      },
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
