import {Component, OnDestroy, OnInit} from '@angular/core';
import {CategoryService} from '../category/services/category.service';
import {Subscription} from 'rxjs';
import {ICategory} from '../category/category';

@Component({
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css']
})

export class ShopComponent implements OnInit, OnDestroy {
  categorySub!: Subscription;
  categories: ICategory[] = [];

  constructor(
    private categoryService: CategoryService
  ) {}

  ngOnInit(): void {
    this.categorySub = this.categoryService.getCategories().subscribe({
      next: categories => this.categories = categories,
      error: err => this.handleError(err)
    });
  }

  ngOnDestroy(): void {
    this.categorySub.unsubscribe();
  }

  handleError(err): void {
    console.log(err.m);
  }
}
