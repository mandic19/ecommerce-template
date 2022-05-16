import {Component, Input} from '@angular/core';
import {ICategory} from '../category';
import {ImageService} from '../../shared/image/image.service';

@Component({
  selector: 'ecm-category-card',
  templateUrl: './category-card.component.html',
  styleUrls: ['./category-card.component.css']
})

export class CategoryCardComponent {
  @Input() category: ICategory;

  constructor(private imageService: ImageService) {
  }

  getImageUrl(imageId: number): string {
    return this.imageService.createUrl(imageId, 'w250_h300_fs1');
  }
}
