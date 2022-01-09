import {Component, Input} from "@angular/core";
import {ICategory} from "../category";
import {ImageService} from "../../shared/image/image.service";

@Component({
  selector: 'app-category-card',
  templateUrl: './category-card.component.html',
  styleUrls: ['./category-card.component.css']
})
export class CategoryCardComponent {
  @Input() category: ICategory;

  constructor(private imageService: ImageService) {
  }

  getImageUrl(image_id: number): string {
    return this.imageService.createUrl(image_id, 'w250_h300_fs1');
  }
}
