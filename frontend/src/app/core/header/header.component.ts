import {Component, OnDestroy, OnInit} from "@angular/core";
import {CategoryService} from "../../category/category.service";
import {ICategory} from "../../category/category";
import {Subscription} from "rxjs";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})

export class HeaderComponent implements OnInit, OnDestroy {
  categories: ICategory[] = [];
  sub!: Subscription;

  constructor(private categoryService: CategoryService) {}

  ngOnInit(): void {
    this.categoryService.getCategories().subscribe({
      next: categories => this.categories = this.buildCategoryTree(categories),
      error: err => this.handleError(err)
    })
  }

  ngOnDestroy(): void {
    this.sub.unsubscribe();
  }

  handleError(err): void {
    console.log(err.m);
  }

  buildCategoryTree(categories: ICategory[], id = null): ICategory[] {
    let categoryTree = categories.filter(category => category.parent_category_id === id);
    categoryTree.map(category => category.sub_categories = this.buildCategoryTree(categories, category.id));

    return categoryTree;
  }
}
