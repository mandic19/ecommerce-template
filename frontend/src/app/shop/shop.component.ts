import {Component, OnDestroy, OnInit} from '@angular/core';
import {CategoryService} from '../category/services/category.service';
import {Subscription} from 'rxjs';
import {ICategory} from '../category/category';
import {IProduct} from "../product/product";

@Component({
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css']
})

export class ShopComponent implements OnInit, OnDestroy {
  categorySub!: Subscription;
  categories: ICategory[] = [];
  showImageViewer: boolean = false;
  imageViewerImageIds: number[] = [];

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

  openImageViewer(imageIds: number[]): void {
    this.showImageViewer = true;
    this.imageViewerImageIds = imageIds;
  }

  closeImageViewer(): void {
    this.showImageViewer = false;
    this.imageViewerImageIds = [];
  }
}
