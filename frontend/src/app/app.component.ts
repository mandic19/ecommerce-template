import {Component, OnDestroy, OnInit} from '@angular/core';
import {Subscription} from 'rxjs';
import {CategoryService} from './category/services/category.service';
import {ICategory} from './category/category';
import {TranslateService} from "@ngx-translate/core";
import {environment} from "../environments/environment";

@Component({
  selector: 'ecm-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent implements OnInit, OnDestroy {
  title = environment.appName;
  categories: ICategory[] = [];
  sub!: Subscription;

  constructor(private categoryService: CategoryService, private translate: TranslateService) {
    translate.setDefaultLang(environment.defaultLang);
    translate.use(environment.lang);
  }

  ngOnInit(): void {
    this.sub = this.categoryService.getCategories().subscribe({
      next: categories => this.categories = categories,
      error: err => this.handleError(err)
    });
  }

  ngOnDestroy(): void {
    this.sub.unsubscribe();
  }

  handleError(err): void {
    console.log(err.m);
  }
}
