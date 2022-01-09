import {Component, Input, OnChanges} from "@angular/core";
import {ICategory} from "../../category/category";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})

export class HeaderComponent implements OnChanges {
  @Input() categories: ICategory[] = [];

  ngOnChanges(): void {
    this.categories = this.buildCategoryTree(this.categories);
  }

  buildCategoryTree(categories: ICategory[], id = null): ICategory[] {
    let categoryTree = categories.filter(category => category.parent_category_id === id);
    categoryTree.map(category => category.sub_categories = this.buildCategoryTree(categories, category.id));

    return categoryTree;
  }
}
